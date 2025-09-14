<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface MiddlewareInterface
{
    /**
     * Handle the middleware logic.
     *
     * @param callable $next The next middleware/controller in the chain
     */
    public function process(callable $next): void;
}
