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

namespace Obol\Exception;

use Obol\Models\ValidationError;

class ValidationFailureException extends \Exception
{
    /**
     * @var ValidationError[]
     */
    protected array $errors = [];

    /**
     * @var ValidationError[]
     */
    public static function createWithErrors(array $errors): static
    {
        $self = new static();
        $self->errors = $errors;

        return $self;
    }

    /**
     * @return ValidationError[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
