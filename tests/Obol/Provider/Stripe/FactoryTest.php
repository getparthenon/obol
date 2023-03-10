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

namespace Obol\Tests\Provider\Stripe;

use Obol\Exception\InvalidConfigException;
use Obol\Provider\ProviderInterface;
use Obol\Provider\Stripe\Factory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testInvalidProvider()
    {
        $this->expectException(InvalidConfigException::class);

        Factory::create([]);
    }

    public function testInvalidProviderApiKeyEmptyString()
    {
        $this->expectException(InvalidConfigException::class);

        Factory::create(['provider' => 'stripe', 'api_key' => '']);
    }

    public function testInvalidProviderApiKeyNotString()
    {
        $this->expectException(InvalidConfigException::class);

        Factory::create(['provider' => 'stripe', 'api_key' => true]);
    }

    public function testValid()
    {
        $actual = Factory::create(['provider' => 'stripe', 'api_key' => 'test']);

        $this->assertInstanceOf(ProviderInterface::class, $actual);
    }
}
