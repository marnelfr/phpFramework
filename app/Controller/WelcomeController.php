<?php


namespace App\Controller;

use App\Controller\AppController;

class WelcomeController extends AppController {

    public function index () {
        return $this->view('home.index');
    }

    public function example () {
        return $this->view('home.example');
    }

}