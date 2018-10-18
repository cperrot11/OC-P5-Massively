<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 17/10/2018
 * Time: 13:40
 */

namespace App\src\controller;

use App\src\view\View;
use App\src\FORM\AddUserForm;

class UserController
{
    private $view;

    public function addUser()
    {
        $this->view = new View();
        $this->view->render('AddUserForm', []);
    }

}