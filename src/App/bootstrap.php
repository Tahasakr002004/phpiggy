<?php
declare(strict_types=1);

namespace Framework;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/Config/RegisterRoutes.php';

use Framework\App;
use function App\Config\{RegisterRoutes, registerMiddleware};
use App\Config\Paths;

// Initialize the application with container definitions
$app = new App(Paths::CONTAINER_DEFINITIONS);

// Register application routes
RegisterRoutes($app);

// Register global middlewares
registerMiddleware($app);

return $app;
