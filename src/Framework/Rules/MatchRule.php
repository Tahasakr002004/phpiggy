<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class MatchRule implements RuleInterface
{
    /**
     * Validate that the value of one field matches another field.
     */
    public function validate(array $data, string $field, array $params): bool
    {
        if (!isset($data[$field], $data[$params[0]])) {
            return false; // one of the fields is missing
        }

        return $data[$field] === $data[$params[0]]; // strict comparison
    }

    /**
     * Return the validation error message.
     */
    public function getMessage(array $data, string $field, array $params): string
    {
        return "The '{$field}' field does not match the '{$params[0]}' field.";
    }
}
