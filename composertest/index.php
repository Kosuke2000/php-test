<?php

require_once __DIR__ . "/vendor/autoload.php";

use APP\Controllers\TestController;

$app = new TestController;
$app->run();
