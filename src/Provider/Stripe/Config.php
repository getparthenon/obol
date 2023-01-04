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

use Obol\Exception\MissingConfigFieldException;

class Config
{
    protected array $paymentMethods = ['card'];
    private bool $pciMode = false;

    private string $apiKey;

    private string $successUrl;

    private string $cancelUrl;

    public function isPciMode(): bool
    {
        return $this->pciMode;
    }

    public function setPciMode(bool $pciMode): static
    {
        $this->pciMode = $pciMode;

        return $this;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): static
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function getSuccessUrl(): string
    {
        if (isset($this->successUrl)) {
            throw new MissingConfigFieldException('success_url needs to be configured');
        }

        return $this->successUrl;
    }

    public function setSuccessUrl(string $successUrl): static
    {
        $this->successUrl = $successUrl;

        return $this;
    }

    public function getCancelUrl(): string
    {
        if (isset($this->cancelUrl)) {
            throw new MissingConfigFieldException('cancel_url needs to be configured');
        }

        return $this->cancelUrl;
    }

    public function setCancelUrl(string $cancelUrl): static
    {
        $this->cancelUrl = $cancelUrl;

        return $this;
    }

    /**
     * @return []string
     */
    public function getPaymentMethods(): array
    {
        return $this->paymentMethods;
    }

    public function setPaymentMethods(array $paymentMethods): static
    {
        $this->paymentMethods = $paymentMethods;

        return $this;
    }
}
