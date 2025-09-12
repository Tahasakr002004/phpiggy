<?php
<<<<<<< HEAD


declare(strict_types=1);
namespace Framework;
include  __DIR__ . '/../../vendor/autoload.php';



use Framework\App;
$app = new App();
=======
declare (strict_types= 1);
// Load the App class
include __DIR__ . '/../../vendor/autoload.php';


// Create and return the App instance
use Framework\App;
$app = new App();


return $app;
>>>>>>> 91ade10650cb824bd89e12d98e25d9ed88a8e7c4
