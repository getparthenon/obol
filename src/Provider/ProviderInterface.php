<?php

declare(strict_types=1);

/*
 * Copyright Iain Cambridge 2023.
 *
 * Use of this software is governed by the Business Source License included in the LICENSE file and at https://github.com/getparthenon/obol/blob/main/LICENSE.
 *
 * Change Date: TBD ( 3 years after 1.0 release )
 *
 * On the date above, in accordance with the Business Source License, use of this software will be governed by the open source license specified in the LICENSE file.
 */

namespace Obol\Provider;

use Obol\ChargeBackServiceInterface;
use Obol\CreditServiceInterface;
use Obol\CustomerServiceInterface;
use Obol\Exception\UnsupportedFunctionalityException;
use Obol\HostedCheckoutServiceInterface;
use Obol\InvoiceServiceInterface;
use Obol\PaymentMethodServiceInterface;
use Obol\PaymentServiceInterface;
use Obol\PriceServiceInterface;
use Obol\ProductServiceInterface;
use Obol\RefundServiceInterface;
use Obol\SubscriptionServiceInterface;
use Obol\WebhookServiceInterface;

interface ProviderInterface
{
    /**
     * @throws UnsupportedFunctionalityException
     */
    public function payments(): PaymentServiceInterface;

    // Billing System
    /**
     * @throws UnsupportedFunctionalityException
     */
    public function hostedCheckouts(): HostedCheckoutServiceInterface;

    /**
     * @throws UnsupportedFunctionalityException
     */
    public function customers(): CustomerServiceInterface;

    // Billing System
    /**
     * @throws UnsupportedFunctionalityException
     */
    public function prices(): PriceServiceInterface;

    // Billing System
    /**
     * @throws UnsupportedFunctionalityException
     */
    public function products(): ProductServiceInterface;

    /**
     * @throws UnsupportedFunctionalityException
     */
    public function refunds(): RefundServiceInterface;

    // Billing System
    public function subscriptions(): SubscriptionServiceInterface;

    public function webhook(): WebhookServiceInterface;

    // Billing System
    public function invoices(): InvoiceServiceInterface;

    public function chargeBacks(): ChargeBackServiceInterface;

    public function paymentMethods(): PaymentMethodServiceInterface;

    public function credit(): CreditServiceInterface;

    public function getName(): string;
}
