<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class EmailRule implements RuleInterface
{
    /**
     * Validate that the field is a valid email.
     */
    public function validate(array $data, string $field, array $params): bool
    {
        return isset($data[$field]) && filter_var($data[$field], FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Return the validation error message.
     */
    public function getMessage(array $data, string $field, array $params): string
    {
        return "The '{$field}' must be a valid email address.";
    }
}
