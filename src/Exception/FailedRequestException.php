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

use Psr\Http\Message\RequestInterface;

class FailedRequestException extends \Exception
{
    protected RequestInterface $request;

    /**
     * @param array $fields
     */
    public function __construct(RequestInterface $request, string $message = '', int $code = 0, \Throwable|null $exception = null)
    {
        $this->request = $request;
        parent::__construct($message, $code, $exception);
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
