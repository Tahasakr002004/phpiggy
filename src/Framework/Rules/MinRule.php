<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class MinRule implements RuleInterface
{
    /**
     * Validate that the value meets the minimum requirement.
     * For strings, it checks length; for numbers, it checks value.
     */
    public function validate(array $data, string $field, array $params): bool
    {
        if (!isset($params[0])) {
            throw new InvalidArgumentException("Minimum value or length not specified for '{$field}'.");
        }

        $min = (int)$params[0];

        if (!isset($data[$field])) {
            return false; // field not provided
        }

        $value = $data[$field];

        if (is_numeric($value)) {
            return $value >= $min;
        }

        if (is_string($value)) {
            return mb_strlen($value) >= $min;
        }

        return false; // unsupported type
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "The '{$field}' must be at least {$params[0]}.";
    }
}
