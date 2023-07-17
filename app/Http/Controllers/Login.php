<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;

class Login {

    public static function request(){
        return json_encode(["service" => "login"]);
    }

}