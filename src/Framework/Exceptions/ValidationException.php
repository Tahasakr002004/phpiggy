<?php

declare(strict_types=1);

namespace Framework\Exceptions;

use RuntimeException;

class ValidationException extends RuntimeException
{
    public function __construct(public array $errors, int $code = 422)
    {
        // Provide a default message for RuntimeException
        parent::__construct('Validation failed.', $code);
    }
}
