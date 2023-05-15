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

use Obol\Exception\NoResultFoundException;
use Obol\Model\Subscription;
use Obol\Model\Subscription\UpdatePaymentMethod;

interface SubscriptionServiceInterface
{
    public function updatePaymentMethod(UpdatePaymentMethod $updatePaymentMethod): void;

    /**
     * @return Subscription[]
     */
    public function list(int $limit = 10, ?string $lastId = null): array;

    /**
     * @throws NoResultFoundException
     */
    public function get(string $id, string $subId): Subscription;
}
