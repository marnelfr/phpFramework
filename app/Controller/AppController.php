<?php


namespace App\Controller;

use App;
use Core\Controller\Controller;

class AppController extends Controller {

    protected $template = 'default';

    public function __construct() {
        $this->viewPath = dirname(__DIR__) . '/Views/';
    }

    public function loadModel ($model) {
        $this->$model = App::getApp()->getModel($model);
    }

}