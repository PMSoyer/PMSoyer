<?php

    // setting project
    session_start(); // use session
    date_default_timezone_set("Asia/Bangkok");
    error_reporting(E_ALL); // show all error  | E_ALL = Show all / 0 off show

    // Load Composer's autoloader
    require __DIR__.'/vendor/autoload.php';

    // Load Web router | default | can load router file in "__DIR__ . /routes/*.php" only
    $routers = glob(__DIR__ . '/routes/*.php');
    foreach ($routers as $router) {
        require $router;
    }

    // // Load Web router | load from subfolder | can load router file in "__DIR__ . /routes/*.php" or "__DIR__ . /routes/other_dir/*.php"
    // $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/routes'));
    // foreach ($iterator as $file) {
    //     if ($file->isFile() && $file->getExtension() === 'php') {
    //         require $file->getPathname();
    //     }
    // }



    /*
    |--------------------------------------------------------------------------
    | Run The Application
    |--------------------------------------------------------------------------
    */

    use Soyer\PMSoyer;
    use Soyer\Http\Request;

    Request::handleRequest();
    PMSoyer::listen(request::$path, request::$method);