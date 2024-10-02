<?php

define('BASE_PATH', dirname(__FILE__));

function base_path($path)
{
    return BASE_PATH . '/' . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/{$path}.php");
}
