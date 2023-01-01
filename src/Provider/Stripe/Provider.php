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

use Obol\HostedCheckoutService;
use Obol\PaymentServiceInterface;
use Obol\Provider\ProviderInterface;

class Provider implements ProviderInterface
{
    public const NAME = 'stripe';

    public function __construct(
        private PaymentServiceInterface $paymentService,
        private HostedCheckoutService $hostedCheckoutService,
    ) {
    }

    public function payments(): PaymentServiceInterface
    {
        return $this->paymentService;
    }

    public function hostedCheckouts(): HostedCheckoutService
    {
        return $this->hostedCheckoutService;
    }
}
