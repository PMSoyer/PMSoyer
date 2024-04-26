<?php

    use Soyer\PMSoyer;
    use Soyer\Http\Request;

    use App\Http\Middleware\Example as MidExample;

    PMSoyer::route('/', ["GET", "POST"], function() {
        return render_template('welcome.html', ['title' => 'The PMSoyer Framework.']);
    }, [ MidExample::class ]);

    PMSoyer::route('/php-info', ["GET"], function() {
        return phpinfo();
    });

    // // custom error response
    // PMSoyer::errorHandler(404, function(){
    //     return render_template("404.html"); // please create 404.html file in templates directory
    // });