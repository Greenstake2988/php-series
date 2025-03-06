<?php

$routes = require "routes.php";

function abort($code)
{
    http_response_code($code);
    require("views/{$code}.php");
    die();
}

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    abort(404);
}