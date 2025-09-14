<?php

declare(strict_types=1);

namespace Framework\Contracts;

/**
 * Interface for validation rules.
 */
interface RuleInterface
{
    /**
     * Validate a field in the provided data.
     *
     * @param array  $data   The full input data.
     * @param string $field  The field name to validate.
     * @param array  $params Optional parameters for the rule.
     *
     * @return bool True if validation passes, false otherwise.
     */
    public function validate(array $data, string $field, array $params): bool;

    /**
     * Return the error message for this rule.
     *
     * @param array  $data   The full input data.
     * @param string $field  The field name.
     * @param array  $params Optional parameters for the rule.
     *
     * @return string Error message.
     */
    public function getMessage(array $data, string $field, array $params): string;
}
