<?php

    namespace App\Http\Controllers;

    use Soyer\Http\Request;


    class Login {

        public static function request(){
            $_SESSION["name"] = (Request::$form["input_name"] == null ? "PMSoyer" : Request::$form["input_name"]);
            redirect("/dashboard");
        }

    }