<?php

    use Soyer\PMSoyer as app;

    app::route("/ping", ["POST"], function(){
        return jsonify(["msg" => "pong"], 200);
    });