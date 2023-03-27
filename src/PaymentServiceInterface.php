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

namespace Obol;

use Obol\Exception\ProviderFailureException;
use Obol\Model\BillingDetails;
use Obol\Model\CardOnFileResponse;
use Obol\Model\Charge;
use Obol\Model\ChargeCardResponse;
use Obol\Model\FrontendCardProcess;
use Obol\Model\Subscription;
use Obol\Model\SubscriptionCreationResponse;

interface PaymentServiceInterface
{
    /**
     * @throws ProviderFailureException
     */
    public function startSubscription(Subscription $subscription): SubscriptionCreationResponse;

    /**
     * @throws ProviderFailureException
     */
    public function stopSubscription(Subscription $subscription): void;

    /**
     * @throws ProviderFailureException
     */
    public function createCardOnFile(BillingDetails $billingDetails): CardOnFileResponse;

    /**
     * @throws ProviderFailureException
     */
    public function deleteCardFile(BillingDetails $cardFile): void;

    /**
     * @throws ProviderFailureException
     */
    public function chargeCardOnFile(Charge $cardFile): ChargeCardResponse;

    /**
     * @throws ProviderFailureException
     */
    public function startFrontendCreateCardOnFile(BillingDetails $billingDetails): FrontendCardProcess;
}
