<?php

declare(strict_types=1);

/*
 * Copyright (C) 2020-2024 Iain Cambridge
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Obol\Model;

class Tier
{
    private int $flatAmount;

    private int $unitAmount;

    private int $upTo;

    public function getFlatAmount(): int
    {
        return $this->flatAmount;
    }

    public function setFlatAmount(int $flatAmount): void
    {
        $this->flatAmount = $flatAmount;
    }

    public function getUnitAmount(): int
    {
        return $this->unitAmount;
    }

    public function setUnitAmount(int $unitAmount): void
    {
        $this->unitAmount = $unitAmount;
    }

    public function getUpTo(): int
    {
        return $this->upTo;
    }

    public function setUpTo(int $upTo): void
    {
        $this->upTo = $upTo;
    }
}