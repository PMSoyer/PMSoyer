<?php

    use Soyer\PMSoyer;

    use App\Http\Middleware\Example as MidExample;
    use App\Http\Controllers\Example as ConExample;

    PMSoyer::route("/ping", ["GET", "POST"], function(){
        return ConExample::handle();
    }, [ MidExample::class ]);