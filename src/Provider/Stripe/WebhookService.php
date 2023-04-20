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

namespace Obol\Provider\Stripe;

use Obol\Model\Events\AbstractCharge;
use Obol\Model\Events\AbstractDispute;
use Obol\Model\Events\DisputeClosed;
use Obol\Model\Events\DisputeCreation;
use Obol\Model\Events\EventInterface;
use Obol\Model\WebhookPayload;
use Obol\Provider\ProviderInterface;
use Obol\WebhookServiceInterface;
use Stripe\Charge;
use Stripe\Dispute;
use Stripe\StripeClient;

class WebhookService implements WebhookServiceInterface
{
    protected StripeClient $stripe;

    protected Config $config;

    protected ProviderInterface $provider;

    /**
     * @param StripeClient $stripe
     */
    public function __construct(ProviderInterface $provider, Config $config, ?StripeClient $stripe = null)
    {
        $this->provider = $provider;
        $this->config = $config;
        $this->stripe = $stripe ?? new StripeClient($this->config->getApiKey());
    }

    public function process(WebhookPayload $payload): ?EventInterface
    {
        $event = \Stripe\Webhook::constructEvent($payload->getPayload(), $payload->getSignature(), $payload->getSignature());
        switch ($event->type) {
            case 'charge.dispute.created':
                return $this->processDisputeCreated($event->object);
            case 'charge.dispute.closed':
                return $this->processDisputeClosed($event->object);
            default:
                return null;
        }
    }

    private function populateDisputeEvent(Dispute $dispute, AbstractDispute $event): void
    {
        $datetime = new \DateTime();
        $datetime->setTimestamp($dispute->created);
        $event->setDisputedPaymentId($dispute->charge);
        $event->setReason($dispute->reason);
        $event->setAmount($dispute->amount);
        $event->setCurrency($dispute->currency);
        $event->setCreatedAt($datetime);
        $event->setStatus($dispute->status);
    }

    private function populateChargeEvent(Charge $charge, AbstractCharge $event): void
    {
        $datetime = new \DateTime();
        $datetime->setTimestamp($charge->created);
        $event->setAmount($charge->amount);
        $event->setCurrency($charge->currency);
        $event->setExternalCustomerId($charge->customer);
        $event->setExternalPaymentId($charge->id);
        $event->setExternalPaymentMethodId($charge->payment_method);

        if (true === $charge->livemode) {
            $url = sprintf('https://dashboard.stripe.com/payments/%s', $charge->id);
        } else {
            $url = sprintf('https://dashboard.stripe.com/test/payments/%s', $charge->id);
        }
        $event->setDetailsLink($url);
    }

    private function processDisputeCreated(Dispute $dispute): DisputeCreation
    {
        $event = new DisputeCreation();
        $this->populateDisputeEvent($dispute, $event);

        return $event;
    }

    private function processDisputeClosed(Dispute $dispute): DisputeClosed
    {
        $event = new DisputeClosed();
        $this->populateDisputeEvent($dispute, $event);

        return $event;
    }
}
