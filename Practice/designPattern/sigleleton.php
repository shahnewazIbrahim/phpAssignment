<?php

class SomeClass{
    static $instance;

    public function __construct()
    {
        echo "New instance created\n";
    }

    static function getInstance($params = null) {
        if (!self::$instance) {
            self::$instance = new SomeClass($params);
        } else {
            echo "Old instance provided\n";
        }

        return self::$instance;
    }
}


$new_class1 = SomeClass::getInstance();
$new_class2 = SomeClass::getInstance();
$new_class3 = SomeClass::getInstance();