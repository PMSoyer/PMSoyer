<?php

    /**
     * Copyright 2023 mantvmass
     */


    session_start();
    date_default_timezone_set("Asia/Bangkok");
    error_reporting(E_ALL); // show all error  | E_ALL = Show all / 0 off show


    require __DIR__.'/../vendor/autoload.php';


    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../routes'));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            require $file->getPathname();
        }
    }


    // load env
    Dotenv\Dotenv::createImmutable(__DIR__ . "/../")->load();
    $_ENV["HOME_PATH"] = __DIR__ . "/../";


    /*
    |--------------------------------------------------------------------------
    | Run The Application
    |--------------------------------------------------------------------------
    */

    use Soyer\PMSoyer;
    use Soyer\Http\Request;

    Request::handleRequest();
    PMSoyer::listen(Request::$path, Request::$method);