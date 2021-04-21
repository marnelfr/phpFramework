<?php
require dirname(__DIR__) . '/app/App.php';

$parts = App::load();

if(!isset($parts[1])) {
    $parts[0] = 'welcome';
    $parts[1] = 'notFound';
}

if(!methods($parts)){
    $parts[0] = 'welcome';
    $parts[1] = 'notFound';
}

$action = $parts[1];

$controller = 'App\Controller\\' . ucfirst($parts[0]) . 'Controller';
$controller = new $controller();

$controller->$action();
