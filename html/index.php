<?php

use Base\Application;

require '../src/config.php';

require '../vendor/autoload.php';
require '../src/eloquent.php' ;

$app = new Application();
$app->run();
