<?php

    use Illuminati\Auduct as app;
    use Illuminati\Http\Request as request;

    use App\Http\Controllers\Login;

    app::route('/', ["GET"], function() {
        return render_template('welcome.twig.html', ['title' => 'Auduct Framework']);
    });

    // app::route('/<gkkhg>', ["GET"], function() { // Bug
    //     return basic_render_template("xxx.php");
    // });

    app::route('/aborttest', ["GET"], function() {
        // abort(404);
        // print_r(request::$args);
        abortWithJson(403, ['key' => 'value']);
        echo "hkghuk";
    });

    app::route('/user/<name>', ["GET"], function($name) {
        return jsonify(["status" => "ok", "message" => "Hi"]);
    });

	app::route('/version', ["GET", "POST"], function(){
        return phpinfo();
    });

	app::route('/redirect', ["GET", "POST"], function(){
        return redirect("/");
    });

    app::route('/login', ["GET", "POST"], function(){
        // echo App\Http\Controllers\Login::request();
        echo Login::request();
    });

    app::errorHandler(404, function(){
        echo "404 Page not found!."; 
    });


?>