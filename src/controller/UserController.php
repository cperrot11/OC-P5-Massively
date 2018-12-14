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
use App\src\FORM\UpdateUserForm;
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
        $this->view =new View();
    }

    public function addUser()
    {
        $this->user = new User();
        // si retour de formulaire transfert vers $user
        if (isset($_POST['submit']))
            {
                //todo : rajouter une boucle pour tester et alimenter la présence des champs du post
                $this->user->setLogin($_POST['login']);
                $this->user->setName($_POST['name']);
                $this->user->setPass($_POST['pass']);
                $this->user->setEmail($_POST['email']);
            }
        $formBuilder = new AddUserForm($this->user);
        $formBuilder->build();
        $form = $formBuilder->form();
        if (isset($_POST['submit']) && $form->isValid()){
            //enregistrement en base
            $_POST['admin']=0;
            if($this->userDAO->saveUser($_POST))
                {
                    $_SESSION['login']= $_POST['login'];
                    $_SESSION['role'] = "membre";
                    $_SESSION['error']="<p>L'utilisateur '".$this->user->getName()."' a été créé en tant que membre !</p><p>Pour devenir administrateur, voir avec un administrateur en place</p>";
                }
            else
                {
                    $url = "../public/index.php?route=addUser";
                    header("location:".$url);
                    return;
                };
            if (isset($_GET['appel']) && $_GET['appel']==="back")
            {
                $this->adminUsers();
            }
            else
            {
                $url = "../public/index.php?route=login#begin";
                header("location:".$url);
            }
            return;
        }
        $this->view = new View();
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('addUser',true, ['formulaire' => $data]);
    }
    public function updateUser()
    {
        if (!isset($_SESSION['role'])){
            $this->frontController->login($_GET);
            $_SESSION['error']='modification impossible pas de connexion en cours';
            return false;
        }
        $user = new User();
        // si retour de formulaire transfert vers $user
        if (isset($_POST['submit']))
        {
            //todo : rajouter une boucle pour tester et alimenter la présence des champs du post
            $user->setLogin($_POST['login']);
            $user->setName($_POST['name']);
            $user->setPass($_POST['pass']);
            $user->setEmail($_POST['email']);
            if (isset($_POST['admin'])){$_POST['admin']=($_POST['admin']=="on")?1:0;}
            else $_POST['admin']=0;
        }
        else{
            //récupère l'user a modifier.
            $user = $this->userDAO->getUser($_GET['login']);
        }
        $formBuilder = new UpdateUserForm($user);
        $formBuilder->build();
        $form = $formBuilder->form();

        if (isset($_POST['submit']) && $form->isValid()){
            //enregistrement en base
            $this->userDAO->updateUser($_POST);
            $_SESSION['error']='Données utilisateur "'.$user->getName().'" mises à jour !';
            if (isset($_GET['appel']) && $_GET['appel']==="front")
            {   //affiche single article
                $this->frontController->article($_GET['idArt']);
            }
            if (isset($_GET['appel']) && $_GET['appel']==="back")
            {
                $this->adminUsers();
            }
            return;
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('AdminUpdateUser', true,['formulaire' => $data]);
    }
    public function deleteUser($get)
    {
        extract($get);
        $this->userDAO->deleteUser($get['login']);
        $this->adminUsers();
    }

    public function adminUsers()
    {
        $users = $this->userDAO->getUsers();
        $this->view->render('AdminUsers',true,['users'=>$users]);
    }
    public function logout()
    {
        session_destroy();
        $url = "../public/index.php";
        header("location:".$url);
    }

}