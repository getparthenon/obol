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

namespace Obol\Model;

class SubscriptionCreationResponse
{
    protected string $subscriptionId;

    protected PaymentDetails $paymentDetails;

    public function getPaymentDetails(): PaymentDetails
    {
        return $this->paymentDetails;
    }

    public function setPaymentDetails(PaymentDetails $paymentDetails): static
    {
        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

    public function setSubscriptionId(string $subscriptionId): static
    {
        $this->subscriptionId = $subscriptionId;

        return $this;
    }
}
