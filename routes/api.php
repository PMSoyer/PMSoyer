<?php

    use Soyer\PMSoyer as app;
    use Soyer\Http\Request as request;

    function Query(string $address){
        if ($address == "127.0.0.1") {
            return true;
        }
        return false;
    }

    app::route("/ping", ["POST"], function(){
        return jsonify(["msg" => "pong"], 200);
    });