<?php

namespace App\src\controller;

use App\src\view\View;

class ErrorController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function unknown()
    {
//        require '../templates/unknown.php';
          echo 'error';
//          $this->view->render('base', ['erreur']);
    }

    public function error()
    {
        require '../templates/Error.php';
    }


}