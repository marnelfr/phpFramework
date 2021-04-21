<?php


namespace Core;


class Config {

    private static $_instance;

    private $settings = [];

    public function __construct($file) {
        $this->settings = require($file);
    }

    public static function getConfig ($file) {
        if(self::$_instance === null){
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }

    public function get($key){
        return isset($this->settings[$key]) ? $this->settings[$key] : null;
    }

}