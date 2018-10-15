<?php


namespace App\src\controller;

use App\src\view\View;

class ConnexionController
{
    private $view;
    public function userOk()
    {
        if (isset($_POST['submit'])) {
            if ($_POST['login']==='admin' && $_POST['password']==='pass'){
                session_start();
                $_SESSION['pseudo'] = 'admin';
                return true;
            }
        }
        else
        {
            $this->view = new View();
            $this->view->render('ConnexionView');
            return false;
        }
    }

}