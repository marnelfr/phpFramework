<?php


namespace Core;


class Autoload {

    public static function autoloader ($class) {
        $parts = explode('\\', $class);
        $dir = '/' . strtolower($parts[0]) . '/';
        $class = str_replace($parts[0] . '\\', '', $class);
        $class = str_replace('\\', '/', $class);
        require dirname(__DIR__) . $dir . $class . '.php';
    }

    public static function register () {
        spl_autoload_register([__CLASS__, 'autoloader']);
    }

}