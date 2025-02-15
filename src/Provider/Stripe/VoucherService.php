<?php

declare(strict_types=1);

/*
 * Copyright (C) 2020-2025 Iain Cambridge
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU LESSER GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation, either version 2.1 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Obol\Provider\Stripe;

use Obol\Model\Voucher\Amount;
use Obol\Model\Voucher\Voucher;
use Obol\Model\Voucher\VoucherApplicationResponse;
use Obol\Model\Voucher\VoucherCreation;
use Obol\Provider\ProviderInterface;
use Obol\VoucherServiceInterface;
use Psr\Log\LoggerAwareTrait;
use Stripe\StripeClient;

class VoucherService implements VoucherServiceInterface
{
    use LoggerAwareTrait;

    protected StripeClient $stripe;

    protected Config $config;

    protected ProviderInterface $provider;

    public function __construct(ProviderInterface $provider, Config $config, ?StripeClient $stripe = null)
    {
        $this->provider = $provider;
        $this->config = $config;
        $this->stripe = $stripe ?? new StripeClient($this->config->getApiKey());
    }

    public function createVoucher(Voucher $voucher): VoucherCreation
    {
        $couponPayload = [
            'name' => $voucher->getName(),
            'duration' => $voucher->getDuration(),
        ];

        if ('repeating' === $voucher->getDuration()) {
            $couponPayload['duration_in_months'] = $voucher->getDurationInMonths();
        }

        if ('percentage' === $voucher->getType()) {
            $couponPayload['percent_off'] = $voucher->getPercentage();
        } else {
            $couponPayload['currency_options'] = [];
            $amounts = $voucher->getAmounts();
            $amount = array_shift($amounts);
            $couponPayload['amount_off'] = $amount->getAmount();
            $couponPayload['currency'] = strtolower($amount->getCurrency());

            foreach ($amounts as $amount) {
                $couponPayload['currency_options'][$amount->getCurrency()] = ['amount_off' => $amount->getAmount()];
            }
        }

        $stripeCoupon = $this->stripe->coupons->create($couponPayload);

        $response = new VoucherCreation();
        $response->setId($stripeCoupon->id);
        if ($voucher->getCode()) {
            $promoCodePayload = [
                'coupon' => $stripeCoupon->id,
                'code' => $voucher->getCode(),
            ];

            $stripePromo = $this->stripe->promotionCodes->create($promoCodePayload);
            $response->setPromoId($stripePromo->id);
        }

        return $response;
    }

    public function list(int $limit = 10, ?string $lastId = null): array
    {
        $payload = ['limit' => $limit];
        if (isset($lastId) && !empty($lastId)) {
            $payload['starting_after'] = $lastId;
        }

        $result = $this->stripe->coupons->all($payload);
        $output = [];
        foreach ($result->data as $coupon) {
            $type = null === $coupon->percent_off ? 'fixed_credit' : 'percentage';

            $voucher = new Voucher();
            $voucher->setId($coupon->id);
            $voucher->setType($type);
            $voucher->setDuration($coupon->duration);
            $voucher->setDurationInMonths($coupon->duration_in_months);
            if ('percentage' === $type) {
                $voucher->setPercentage($coupon->percent_off);
            } else {
                $amounts = [];
                $amount = new Amount();
                $amount->setAmount($coupon->amount_off);
                $amount->setCurrency($coupon->currency);
                $amounts[] = $amount;

                $voucher->setAmounts($amounts);
            }

            $createdAt = new \DateTime();
            $createdAt->setTimestamp($coupon->created);
            $voucher->setCreatedAt($createdAt);
            $output[] = $voucher;
        }

        return $output;
    }

    public function applyCoupon(string $customerReference, string $couponReference): VoucherApplicationResponse
    {
        $stripeCustomer = $this->stripe->customers->retrieve($customerReference);
        $stripeCustomer->coupon = $couponReference;
        $stripeCustomer->save();

        $response = new VoucherApplicationResponse();
        $response->setSuccess(true);

        return $response;
    }
}
