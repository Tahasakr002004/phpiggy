<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class UrlRule implements RuleInterface
{
    /**
     * Validate that the field is a valid URL.
     */
    public function validate(array $data, string $field, array $params): bool
    {
        return isset($data[$field]) && filter_var($data[$field], FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Return a friendly error message.
     */
    public function getMessage(array $data, string $field, array $params): string
    {
        return "The '{$field}' field must be a valid URL.";
    }
}
