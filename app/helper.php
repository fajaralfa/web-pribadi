<?php

function view(string $name): string
{
    ob_start();
    require_once __DIR__ . "/../views/$name.php";
    return ob_get_clean();
}
