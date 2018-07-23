<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class InvalidDigitalIdException extends BadRequestHttpException
{
    public function __construct(string $message = null, \Exception $previous = null, int $code = 0, array $headers = [])
    {
        if (is_null($message)) {
            $message = 'Invalid QR code';
        }

        parent::__construct($message, $previous, $code, $headers);
    }
}