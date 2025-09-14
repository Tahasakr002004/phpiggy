<?php

declare(strict_types=1);


// include helper functions BEFORE anything else so functions are globally available
require_once __DIR__ . '/../src/App/functions.php';

// Composer autoloader (if you use composer)
require_once __DIR__ . '/../vendor/autoload.php';

include __DIR__ . '/../src/App/bootstrap.php';
$app->run();
