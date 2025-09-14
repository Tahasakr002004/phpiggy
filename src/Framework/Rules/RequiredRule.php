<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class RequiredRule implements RuleInterface
{
    /**
     * Validate that the field is present and not empty.
     */
    public function validate(array $data, string $field, array $params): bool
    {
        return isset($data[$field]) && trim((string)$data[$field]) !== '';
    }

    /**
     * Return a friendly error message.
     */
    public function getMessage(array $data, string $field, array $params): string
    {
        return "The '{$field}' field is required.";
    }
}
