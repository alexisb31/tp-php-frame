<?php

function dump(...$vars){
    echo '<pre>';
    foreach($vars as $var){
        var_dump($var);
    }
    echo '</pre>';
}

function getClassBasename($class){
    $lastBackslash = strripos($class, '\\');
    return substr($class, $lastBackslash + 1);
}

function getNamespace($class){
    $lastBackslash = strripos($class, '\\');
    return substr($class, 0, $lastBackslash);
}

function slugify($string){
    return str_replace(' ', '-', strtolower(trim($string)));
}

function flash($key, $value){
    $_SESSION['__FLASH__'][$key] = $value;
}


function unFlash($key, $default = null): mixed {
    $value = $_SESSION['__FLASH__'][$key] ?? $default;
    unset($_SESSION['__FLASH__'][$key]);
    return $value;
}