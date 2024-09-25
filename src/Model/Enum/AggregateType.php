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

namespace Obol\Model\Enum;

enum AggregateType
{
    case LAST_DURING_PERIOD;
    case LAST_EVER;
    case MAX;
    case SUM;

    public static function fromStripe(string $value): AggregateType
    {
        return match ($value) {
            'last_during_period' => self::LAST_DURING_PERIOD,
            'last_ever' => self::LAST_EVER,
            'max' => self::MAX,
            default => self::SUM,
        };
    }
}