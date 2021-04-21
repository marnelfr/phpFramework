<?php

namespace Core\Controller;

class Controller {

    //doit se terminer par '/'
    protected $viewPath;

    protected $template;

    public function view ($name, $variables = []) {
        $model_name = str_replace('.', '/', $name);
        extract($variables, true);
        ob_start();
        require $this->viewPath . $model_name . '.php';
        $content = ob_get_clean();
        require $this->viewPath . 'templates/' . $this->template . '.php';
    }

    public function notFound () {
        //On pourra faire une page plus jolie mais pour le moment:
        header('HTTP//1.0 404 Not Found');
        echo 'Not found. Go back to the <a href="/">homePage</a>';
    }

    public function forbidden(){
        header('HTTP/1.0 403 Forbidden');
        die('Accès interdit');
    }
}