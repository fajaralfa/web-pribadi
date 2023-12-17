<?php

use App\Service\Session;

function view(string $name): string
{
    $session = new Session();
    ob_start();
    require_once __DIR__ . "/../views/$name.php";
    return ob_get_clean();
}

function db(): \PDO
{
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASS'];
    $host = $_ENV['DB_HOST'];
    $name = $_ENV['DB_NAME'];

    return new \PDO("mysql:host=$host;dbname=$name", $user, $pass, [
        \PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}
