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

class SubscriptionCancellation
{
    private Subscription $subscription;

    private ?Refund $refund = null;

    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }

    public function setSubscription(Subscription $subscription): void
    {
        $this->subscription = $subscription;
    }

    public function getRefund(): ?Refund
    {
        return $this->refund;
    }

    public function setRefund(?Refund $refund): void
    {
        $this->refund = $refund;
    }

    public function hasRefund()
    {
        return isset($this->refund);
    }
}
