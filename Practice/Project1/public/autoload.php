<?php

use App\Database\MySQL\Connection;

spl_autoload_register(function($class) {
    $rootDirectory =  dirname( __DIR__ ). '/';
    $file = $rootDirectory. str_replace('\\', '/', $class) . '.php';
    if(file_exists($file)) {
        require_once $file;
    }
    echo $file ;
});

$connection = new Connection();
