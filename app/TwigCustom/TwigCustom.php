<?php

    namespace App\TwigCustom;

    use Soyer\View\Custom\UserCustomView;

    use App\TwigCustom\Example;

    class TwigCustom {

        public static function init() {

            UserCustomView::defineGlobalVariable("you_key", "you_value");
            // HTML: {{ you_key }}

            UserCustomView::defineFunction("you_function_name", [Example::class, "plusInt"]);
            // HTML: {{ you_function_name(100) }}

        }

    }