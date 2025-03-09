<?php

function abort($code)
{
    http_response_code($code);
    view("{$code}.php");
    die();
}

$routes = require base_path("routes.php");
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

if (array_key_exists($uri, $routes)) {
    require base_path($routes[$uri]);
} else {
    abort(404);
}