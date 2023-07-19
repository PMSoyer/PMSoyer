<?php

    use Soyer\PMSoyer;
    use Soyer\Http\Request;


    use App\Http\Controllers\Login;

    use App\Http\Middleware\Authenticate;

    
    PMSoyer::route('/basic', ["GET", "POST"], function() {
        // you can use page.php by
        return basic_render_template("basic_page.php");
    });


    PMSoyer::route('/', ["GET", "POST"], function() {
        return render_template('welcome.twig', ['title' => 'The PMSoyer Framework.']);
    });


    PMSoyer::route('/logout', ["GET", "POST"], function() {
        unset($_SESSION["name"]);
        redirect("/login");
    });


    PMSoyer::route('/login', ["GET", "POST"], function() {
        if (Authenticate::isLogin()) redirect("/dashboard");
        if (Request::$method == "POST") Login::request();
        return render_template('login.twig');
    });


    PMSoyer::route("/dashboard", ["GET"], function(){
        return render_template("dashboard.twig", ['name' => $_SESSION["name"]]);
    }, [ Authenticate::class ]);

    
    PMSoyer::errorHandler(401, function(){
        return render_template('error/401.twig');
    });

    
    PMSoyer::errorHandler(404, function(){
        return render_template('error/404.twig');
    });