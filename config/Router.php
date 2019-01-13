<?php
/**
 * Use for autoload class without declaration
 *
 * PHP version 7.2
 *
 * @category Routeur
 * @package config
 * @author Christophe PERROTIN
 * @copyright 2018
 * @license MIT License
 * @link http://wwww.perrotin.eu
 */

namespace App\config;

use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\FrontController;
use App\src\controller\UserController;

/**
 * Class Router
 * @package App\config
 */
class Router
{
    private $_frontController;
    private $_backController;
    private $_userController;
    private $_errorController;
    private $_request;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->_backController = new BackController();
        $this->_frontController = new FrontController();
        $this->_errorController = new ErrorController();
//        $this->connexionController = new ConnexionController();
        $this->_userController = new UserController();
    }

    /**
     * Analyze url and redirect to the concerned controller
     */
    public function run()
    {
        $_request = new Request($_GET, $_POST, $_SESSION, $_COOKIE);
        $route = $_request->get["route"];
        try{
            if(isset($route)) {
                //Accueil & Connexion
                if($route === 'accueil') {
                    $this->_frontController->accueil();
                }
                if($route === 'login') {
                    $this->_frontController->login();
                }
                if($route === 'logout') {
                    $this->_userController->logout();
                }
                else if ($route === 'contact') {
                    $this->_frontController->contact();
                }
                //Zone article
                else if ($route === 'article') {
                    $this->_frontController->article($_GET['idArt']);
                    $this->_frontController->addComment($_GET['idArt']);
                }
                else if ($route === 'articles') {
                    $this->_frontController->articles();
                 }
                else if ($route === 'addArticle') {
                    $this->_backController->addArticle($_POST);
                }
                else if ($route === 'adminArticles') {
                    $this->_backController ->adminArticles();
                }
                else if ($route === 'updateArticle') {
                    $this->_backController ->updateArticle($_GET['idArt']);
                }
                else if ($route === 'deleteArticle') {
                    $this->_backController ->deleteArticle($_GET['idArt']);
                }
                //Zone Comment
                else if ($route === 'addComment') {
                    $this->_frontController->addComment($_GET);
                }
                else if ($route === 'updateComment') {
                    $this->_backController->updateComment();
                 }
                else if ($route === 'deleteComment') {
                    $this->_backController->deleteComment($_GET);
                }
                else if ($route === 'valideComment') {
                    $this->_backController->valideComment($_GET);
                }
                else if ($route === 'adminCommentaires') {
                    $this->_backController ->adminCommentaires();
                }
                //Zone connexion
                else if ($route === 'checkLogin') {
                    $this->_frontController->checkLogin();
                }
                else if ($route === 'adminGestion') {
                    $this->_backController ->adminGestion();
                }
                //zone User
                else if ($route === 'adminUsers') {
                    $this->_userController->adminUsers();
                }
                else if ($route === 'addUser') {
                    $this->_userController ->addUser();
                }
                else if ($route === 'checkUser') {
                    $this->_userController ->checkUser();
                }
                else if ($route === 'updateUser') {
                    $this->_userController->updateUser();
                }
                else if ($route === 'deleteUser') {
                    $this->_userController->deleteUser($_GET);
                }
                else{
                    $this->_errorController->unknown();
                }
            }
            else{
                $this->_frontController->accueil();
            }
        }
        catch (Exception $e)
        {
            $this->_errorController->error();
        }
    }
}
