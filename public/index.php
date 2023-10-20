<?php

    /**
     * Copyright 2023 mantvmass
     */


    session_start();
    date_default_timezone_set("Asia/Bangkok");
    error_reporting(E_ALL); // show all error  | E_ALL = Show all / 0 off show


    require __DIR__.'/../vendor/autoload.php';


    // set env
    $_ENV["HOME_PATH"] = __DIR__ . "/../";
    Dotenv\Dotenv::createImmutable($_ENV["HOME_PATH"])->load();


    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_ENV["HOME_PATH"] . 'routes'));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            require $file->getPathname();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Run The Application
    |--------------------------------------------------------------------------
    */

    use Soyer\PMSoyer;
    use Soyer\Http\Request;

    Request::handleRequest();
    PMSoyer::listen(Request::$path, Request::$method);