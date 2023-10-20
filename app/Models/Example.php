<?php

    namespace App\Models;

    use App\Models\BaseModel;

    class Example extends BaseModel {

        public $__table__ = "my_table_name";

        function __construct() {
            parent::__construct($this -> __table__);
        }

    }