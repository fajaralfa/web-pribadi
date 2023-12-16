<?php

use App\App;
use App\Controller\MyController;

require_once __DIR__ . "/../vendor/autoload.php";

$app = new App();

$app->route('GET', '/invoke', MyController::class);
$app->route('GET', '/method', [MyController::class, 'index']);
$app->route('GET', '/callable', function () {
    return 'This is from callable';
});

$app->set_not_found_view();

$app->run();
