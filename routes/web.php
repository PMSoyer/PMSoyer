<?php

    use Soyer\PMSoyer as app;

    app::route('/', ["GET"], function() {
        return render_template('welcome.twig.html', ['title' => 'The PMSoyer Framework.']);
    });

    app::errorHandler(404, function(){
        echo "404 Page not found!."; 
    });