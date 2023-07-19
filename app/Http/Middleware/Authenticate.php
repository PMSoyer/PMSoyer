<?php

    namespace App\Http\Middleware;
    use Closure;


    class Authenticate {

        public static function isLogin(){
            return isset($_SESSION["name"]);
        }

        public static function handle(Closure $next){ // 'handle method' call from match router
            if (self::isLogin()) {
                return $next();
            }
            return abort(401, "Unauthorized");
        }

    }