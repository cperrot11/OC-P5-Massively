<?php
/**
 * Manage the user
 *
 * @link http://wwww.perrotin.eu
 */

namespace App\src\controller;

use App\src\view\View;
use App\src\FORM\AddUserForm;
use App\src\FORM\UpdateUserForm;
use App\src\model\User;
use App\src\DAO\UserDAO;
use App\config\Request;

/**
 * Class UserController
 * @package App\src\controller
 */
class UserController
{
    private $view;
    private $user;
    private $userDAO;
    private $request;
    private $get;
    private $post;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->user = new User();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        //avoid using global variables
        $this->request = new Request();
        $this->get = $this->request->get('query');
        $this->post = $this->request->get('post');
    }

    /**
     * Manages the user addition
     *
     * @return void
     */
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
                    exit();
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
            exit();
        }
        $this->view = new View();
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('addUser',true, ['formulaire' => $data]);
    }

    /**
     * Update user
     *
     * @return bool|void
     */
    public function updateUser()
    {
        $user = new User;
        if (!$this->request->isAdmin()){
            $text1 = 'modification impossible pas de connexion administrateur';
            $this->request->set('session', 'error', $text1);
            $url = "../public/index.php?route=login";
            header("location:".$url);
            exit();
        }
        // si retour de formulaire transfert vers $user
        if ($this->request->isPostSubmit())
        {
            $user->setLogin($this->post['login']);
            $user->setName($this->post['name']);
            $user->setPass($this->post['pass']);
            $user->setEmail($this->post['email']);
            $admin = $this->post['admin'];
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
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('AdminUpdateUser', true,['formulaire' => $data]);
    }

    /**
     * Delete user
     *
     * @param $get
     * @return void
     */
    public function deleteUser($get)
    {
        extract($get);
        $this->userDAO->deleteUser($get['login']);
        $text1="Utilisateurs + ses articles supprimés.";
        $this->request->set('session', 'error', $text1);
        $url = "../public/index.php?route=adminUsers#begin";
        header("location:".$url);
        exit();
    }

    /**
     * Direct to user administration page
     *
     */
    public function adminUsers()
    {
        $users = $this->userDAO->getUsers();
        $this->view->render('AdminUsers',true,['users'=>$users]);
    }

    /**
     * Logout user
     */
    public function logout()
    {
        session_destroy();
        $url = "../public/index.php";
        header("location:".$url);
    }

}