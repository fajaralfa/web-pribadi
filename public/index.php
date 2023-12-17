<?php

use App\App;
use App\Controller\AuthController;
use App\Middleware\AuthMw;
use Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$app = new App();

$app->route('GET', '/login', [AuthController::class, 'login_page'], [AuthMw::class, 'unauthenticated']);
$app->route('POST', '/login', [AuthController::class, 'login_act'], [AuthMw::class, 'unauthenticated']);
$app->route('GET', '/register', [AuthController::class, 'register_page'], [AuthMw::class, 'unauthenticated']);
$app->route('POST', '/register', [AuthController::class, 'register_act'], [AuthMw::class, 'unauthenticated']);
$app->route('GET', '/home', fn () => view('home'), [AuthMw::class, 'authenticated']);
$app->route('POST', '/logout', [AuthController::class, 'logout_act'], [AuthMw::class, 'authenticated']);
$app->set_not_found_view();

$app->run();
