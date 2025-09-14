<?php
declare(strict_types=1); // Must be the very first statement

namespace App\Config;

use App\Controllers\{HomeController, AboutController, AuthController};
use Framework\App;

function RegisterRoutes(App $app): void
{
    // Public pages
    $app->getRoute('/', [HomeController::class, 'home']);
    $app->getRoute('/about', [AboutController::class, 'about']);

    // Registration
    $app->getRoute('/register', [AuthController::class, 'registerView']);
    $app->postRoute('/register', [AuthController::class, 'register']);
}
