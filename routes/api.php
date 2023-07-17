<?php

    use Illuminati\Auduct as app;
    use Illuminati\Http\Request as request;

    function Query(string $address){
        if ($address == "127.0.0.1") {
            return true;
        }
        return false;
    }

    app::route("/check", ["POST"], function(){


        if (!isset(request::$args["address"])) abortWithJson(404, [ "status" => "error", "message" => "Params Not Found." ]);
        

        if (Query(request::$args["address"])) {
            return jsonify(["status" => "ok", "message" => "IP is valid"], 200);
        }

        return jsonify(["status" => "error", "message" => "IP is not valid"], 401);

    });