<?php

    namespace App\Http\Controllers;

    use Soyer\Http\Request;


    class Example {

        public static function handle(){ // you can define function name anyting for controllers class and call class & function in request or route
            return jsonify(["server" => "pong"]);
        }

    }