<?php

use TurgunboyevUz\SPDO\Core\Config;
use TurgunboyevUz\SPDO\Core\Translations;

function dd(...$args): void
{
    echo "<pre>";
    var_dump(...$args);
    echo "</pre>";

    die();
}

function pd(...$args): void
{
    echo "<pre>";
    print_r(...$args);
    echo "</pre>";
    die();
}

function config($key, $default = null){
    return Config::get($key, $default);
}

function locale($value){
    return Translations::locale($value);
}

function lang($key, $vars = [], $default = null){
    return Translations::get($key, $vars, $default);
}