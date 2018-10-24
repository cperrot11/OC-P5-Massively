<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 17/10/2018
 * Time: 13:40
 */

namespace App\src\controller;

use App\src\view\View;
use App\src\FORM\NewUserForm;
use App\src\model\User;
use App\src\DAO\UserDAO;
use App\src\FORM\ConnexionForm;

class UserController
{
    private $view;
    private $user;
    private $userDAO;

    public function __construct()
    {
        $this->user = new User();
        $this->userDAO = new UserDAO();
    }

    public function addUser()
    {
        $formBuilder = new NewUserForm($this->user);
        $formBuilder->build();
        $form = $formBuilder->form();

        $this->view = new View();
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('newUser', ['formulaire' => $data]);
    }

    public function checkUser()
    {
        if ($this->userDAO->getUser($_POST['login'])<>false)
        {
            $_SESSION['error']= 'Adresse e-mail déjà utilisée';
            $url = "../public/index.php?route=login";
        }
        else{
            $_POST['name']='jef';
            $_POST['admin']=1;
            $this->userDAO->saveUser($_POST);
            $url = "../public/index.php";
        }
        header("location:".$url);
    }


}