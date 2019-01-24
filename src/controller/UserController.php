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
use App\config\Request;

class UserController
{
    private $view;
    private $user;
    private $userDAO;
    private $request;

    public function __construct()
    {
        $this->user = new User();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        $this->request = new Request();
    }

    public function addUser()
    {
        $this->user = new User();
        // si retour de formulaire transfert vers $user
        if ($this->request->get( 'post', 'submit')) {
                $this->user->setLogin($this->request->get( 'post', 'login'));
                $this->user->setName($this->request->get( 'post', 'name'));
                $this->user->setPass($this->request->get( 'post', 'pass'));
                $this->user->setEmail($this->request->get( 'post', 'mail'));
            }
        $formBuilder = new AddUserForm($this->user);
        $formBuilder->build();
        $form = $formBuilder->form();
        if ($this->request->get('submit', 'post') && $form->isValid()){
            //enregistrement en base
            $_POST['admin']=0;
            $this->request->set('admin', 0, 'post');
            if($this->userDAO->saveUser($this->request->get('post')))
                {
                    $_SESSION['login']= $_POST['login'];
                    $_SESSION['role'] = "membre";
                    $_SESSION['error']="<p>L'utilisateur '".$this->user->getName()."' a été créé en tant que membre, pour devenir administrateur, voir avec un administrateur déjà en place</p>";
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
        $_SESSION['error']="Utilisateurs + ses articles supprimés.";
        $url = "../public/index.php?route=adminUsers#begin";
        header("location:".$url);
        return;
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