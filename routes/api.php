<?php

    use Soyer\PMSoyer;

    PMSoyer::route("/ping", ["POST"], function(){
        return jsonify(["msg" => "pong"], 200);
    });