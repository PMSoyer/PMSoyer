<?php

    namespace App\Http\Middleware;
    use Closure;

    use Soyer\Http\Request;


    class Example {

        public static function handle(Closure $next){ // 'handle method' call from router | please define function name is "handle" only
            if (true) { // example condition
                return $next();
            }
            return abort(500, "Server error."); // return response error with status code: 500
        }

    }