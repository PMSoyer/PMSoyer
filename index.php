<?php

    // setting project
    session_start(); // use session
    date_default_timezone_set("Asia/Bangkok");
    error_reporting(E_ALL); // show all error  | E_ALL = Show all / 0 off show

    // Load Configs ENV
    require __DIR__.'/config/env.php';

    // Load Composer's autoloader
    require __DIR__.'/vendor/autoload.php';

    // Load Web router //
    $routers = glob(__DIR__ . '/routes/*.php');
    foreach ($routers as $router) {
        require $router;
    }


    /*
    |--------------------------------------------------------------------------
    | Run The Application
    |--------------------------------------------------------------------------
    */

    use Illuminati\Auduct as app;
    use Illuminati\Http\Request as request;

    request::handleRequest();
    app::listen(request::$path, request::$method);