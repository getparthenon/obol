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

namespace Obol\Model\Events;

use Obol\Model\Enum\ChargeFailureReasons;

class ChargeFailed extends AbstractCharge implements EventInterface
{
    protected ChargeFailureReasons $reason;

    public function getReason(): ChargeFailureReasons
    {
        return $this->reason;
    }

    public function setReason(ChargeFailureReasons $reason): void
    {
        $this->reason = $reason;
    }
}
