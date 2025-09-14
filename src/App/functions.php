<?php
declare(strict_types=1);

/**
 * Debug helpers - global namespace
 */

if (!function_exists('dd')) {
    function dd(mixed $data): void
    {
        echo '<pre>';
        if (is_array($data) || is_object($data)) {
            var_dump($data);
        } else {
            echo htmlspecialchars((string)$data);
        }
        echo '</pre>';
        die();
    }
}

if (!function_exists('d')) {
    function d(mixed $data): void
    {
        echo '<pre>';
        if (is_array($data) || is_object($data)) {
            var_dump($data);
        } else {
            echo htmlspecialchars((string)$data);
        }
        echo '</pre>';
    }
}

if (!function_exists('redirectTo')) {
    function redirectTo(string $path): void
    {
        http_response_code(302); // send status code first
        header("Location: {$path}");
        exit;
    }
}
