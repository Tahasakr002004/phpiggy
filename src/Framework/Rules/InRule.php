<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class InRule implements RuleInterface
{
    /**
     * Validate that the field value is one of the allowed options.
     */
    public function validate(array $data, string $field, array $params): bool
    {
        if (!isset($data[$field])) {
            return false;
        }

        return in_array($data[$field], $params, true); // strict comparison
    }

    /**
     * Return the validation error message.
     */
    public function getMessage(array $data, string $field, array $params): string
    {
        $allowed = implode(', ', $params);
        return "The '{$field}' field must be one of the following: {$allowed}.";
    }
}
