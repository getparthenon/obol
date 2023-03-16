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

class CustomerCreation
{
    protected string $reference;

    protected ?string $detailsUrl;

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    public function getDetailsUrl(): ?string
    {
        return $this->detailsUrl;
    }

    public function setDetailsUrl(?string $detailsUrl): void
    {
        $this->detailsUrl = $detailsUrl;
    }
}
