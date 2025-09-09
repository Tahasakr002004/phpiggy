<?php
declare (strict_types= 1);
// Load the App class
include __DIR__ . '/../../vendor/autoload.php';


// Create and return the App instance
use Framework\App;
$app = new App();


return $app;