<?php


use Core\Autoload;
use Core\Config;
use Core\Database\MysqlDatabase;

class App {

    private static $_instance;

    private static $config;

    private $base;

    public static function getApp () {
        if(self::$_instance === null){
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public static function getConfig() {
        if (!self::$config) {
            self::$config = new Config(dirname(__DIR__) . '/config/config.php');
        }
        return self::$config;
    }

    public function getDb () {
        if($this->base === null){
            $config = self::getConfig();
            $this->base = new MysqlDatabase(
                $config->get('db_name'),
                $config->get('db_user'),
                $config->get('db_pass'),
                $config->get('db_host')
            );
            return $this->base;
        }
    }

    public static function load () {
        session_start();
        require dirname(__DIR__) . '/core/Autoload.php';
        Autoload::register();

        $page = trim(strip_tags($_SERVER['REQUEST_URI']));
        $page = substr($page, 1);
        if (!$page) {
            $page = 'welcome/index';
        }

        return explode('/', $page);
    }

    public function getModel($table) {
        $model = 'App\Model\\' . ucfirst($table) . 'Model';
        return new $model($this->getDb());
    }

}

function asset($link) {
    return App::getConfig()->get('asset_link') . $link;
}

function d (...$args) {
    echo '<pre style="background-color: #d3d3d3; margin: 10px; padding: 10px">';
    foreach($args as $arg){
        var_dump($arg);
    }
    echo '</pre>';
}

function dd (...$args) {
    d($args);
    die();
}

function methods ($data = ['a', 'b']) {
    $controller = 'App\Controller\\' . ucfirst($data[0]) . 'Controller';
    $config = new Config(dirname(__DIR__) . '/config/config.php');
    if(!in_array($controller, $config->get('controllers'), false)) {
        return false;
    }
    if(!in_array($data[1], get_class_methods($controller), false)) {
        return false;
    }
    return true;
}









