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
    private $get;
    private $post;

    public function __construct()
    {
        $this->user = new User();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        $this->request = new Request();
        $this->get = $this->request->get('query');
        $this->post = $this->request->get('post');
    }

    public function addUser()
    {
        $this->user = new User();
        // si retour de formulaire transfert vers $user
        if ($this->request->isPostSubmit()) {
                $this->user->setLogin($this->post[login]);
                $this->user->setName($this->post[name]);
                $this->user->setPass($this->post[pass]);
                $this->user->setEmail($this->post[email]);
            }
        $formBuilder = new AddUserForm($this->user);
        $formBuilder->build();
        $form = $formBuilder->form();
        if ($this->request->isPostSubmit() && $form->isValid()){
            //enregistrement en base
            $this->request->set('post', 'admin', 0);
            if(!$this->userDAO->saveUser($this->post)){
                    $url = "../public/index.php?route=addUser";
                    header("location:".$url);
                    return;
                };
            $user = $this->post[login];
            $this->request->set('session', 'login', $user);
            $this->request->set('session', 'role', 'membre');
            $text1 = "<p>L'utilisateur '".$this->user->getName()."' a été créé en tant que membre, pour devenir administrateur, voir avec un administrateur déjà en place</p>";
            $this->request->set('session', 'error', $text1);

            if ($this->request->isBack())
            {
                $this->adminUsers();
                return;
            }
            $url = "../public/index.php?route=login#begin";
            header("location:".$url);
            return;
        }
        $this->view = new View();
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('addUser',true, ['formulaire' => $data]);
    }
    public function updateUser()
    {
        if (!$this->request->isLoged()){
            $text1 = 'modification impossible pas de connexion en cours';
            $this->request->set('session', 'error', $text1);
            $url = "../public/index.php?route=login";
            header("location:".$url);
            return false;
        }
        $user = new User();
        // si retour de formulaire transfert vers $user
        if ($this->request->isPostSubmit())
        {
            $this->user->setLogin($this->post[login]);
            $this->user->setName($this->post[name]);
            $this->user->setPass($this->post[pass]);
            $this->user->setEmail($this->post[email]);
            $admin = $this->post[admin];
            $this->request->set('post', 'admin', 0);
            if ($admin==="on"){
                $this->request->set('post', 'admin', 1);
            }
        }
        else{
            //récupère l'user a modifier.
            $user = $this->userDAO->getUser($this->get['login']);
        }
        $formBuilder = new UpdateUserForm($user);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($this->request->isPostSubmit() && $form->isValid()){
            //enregistrement en base
            $this->userDAO->updateUser($this->post);
            $text1 = 'Données utilisateur "'.$user->getName().'" mises à jour !';
            $this->request->set('session', 'error', $text1);
            if ($this->request->isFront())
            {   //affiche single article
                $this->frontController->article($this->get['idArt']);
            }
            if ($this->request->isBack())
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
        $text1="Utilisateurs + ses articles supprimés.";
        $this->request->set('session', 'error', $text1);
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