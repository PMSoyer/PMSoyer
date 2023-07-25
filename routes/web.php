<?php

    use Soyer\PMSoyer;
    use Soyer\Http\Request;


    use App\Http\Controllers\Login;
    use App\Http\Middleware\Authenticate;



    PMSoyer::route('/', ["GET", "POST"], function() {
        return render_template('welcome.html', ['title' => 'The PMSoyer Framework.']);
    });


    PMSoyer::route('/logout', ["GET", "POST"], function() {
        unset($_SESSION["name"]);
        redirect("/login");
    });


    PMSoyer::route('/login', ["GET", "POST"], function() {
        if (Authenticate::isLogin()) redirect("/dashboard");
        if (Request::$method == "POST") Login::request();
        return render_template('login.html');
    });


    PMSoyer::route("/dashboard", ["GET"], function(){
        return render_template("dashboard.html", ['name' => $_SESSION["name"]]);
    }, [ Authenticate::class ]);

    
    PMSoyer::errorHandler(401, function(){
        return render_template('error/401.html');
    });

    
    PMSoyer::errorHandler(404, function(){
        return render_template('error/404.html');
    });