<?php
declare(strict_types=1);

namespace App\Config;

use Framework\App;

// This function will register all middlewares for the app
function registerMiddleware(App $app): void
{
    $middlewares = [
        \App\MiddleWares\SessionMiddleware::class,
        \App\MiddleWares\ValidationExceptionMiddleware::class,
        \App\MiddleWares\FlashMiddleware::class,
        \App\MiddleWares\TemplateDataMiddleware::class
    ];

    foreach ($middlewares as $middleware) {
        $app->addMiddleware($middleware);
    }
}
