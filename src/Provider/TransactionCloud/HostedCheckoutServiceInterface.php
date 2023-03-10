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

namespace Obol\Provider\TransactionCloud;

use Obol\Model\CheckoutCreation;
use Obol\Model\Subscription;

class HostedCheckoutServiceInterface implements \Obol\HostedCheckoutServiceInterface
{
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function createCheckoutForSubscription(Subscription $subscription): CheckoutCreation
    {
        $url = sprintf('%s/payment/product/%s', $this->config->getDefaultUrl(), $subscription->getPriceId());

        $checkoutCreation = new CheckoutCreation();
        $checkoutCreation->setCheckoutUrl($url);

        return $checkoutCreation;
    }
}
