<?php
/**
 * Use for autoload class without declaration
 */

namespace App\config;

use App\src\controller\BackController;
use App\src\controller\FrontController;
use App\src\controller\UserController;
use App\config\request;

/**
 * Class Router
 * @package App\config
 */
class Router
{
    private $_frontController;
    private $_backController;
    private $_userController;
    private $_request;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->_backController = new BackController();
        $this->_frontController = new FrontController();
        $this->_userController = new UserController();
    }

    /**
     * Analyze url and redirect to the concerned controller
     */
    public function run()
    {
        $this->_request = new Request();
        $route=null;
        if(isset($this->_request->get["route"])){
            $route =$this->_request->get["route"];
        }
        try{
            if(isset($route)) {
                //Accueil & Connexion
                switch ($route)
                {
                    case 'accueil' :
                        $this->_frontController->accueil();
                        break;
                    case 'login' :
                        $this->_frontController->login();
                        break;
                    case 'logout' :
                        $this->_userController->logout();
                        break;
                    case 'contact' :
                        $this->_frontController->contact();
                        break;
                    //Zone article
                    case 'article' :
                        $this->_frontController->article($_GET['idArt']);
                        $this->_frontController->addComment($_GET['idArt']);
                        break;
                    case 'articles' :
                        $this->_frontController->articles();
                        break;
                    case 'addArticle' :
                        $this->_backController->addArticle($_POST);
                        break;
                    case 'adminArticles' :
                        $this->_backController ->adminArticles();
                        break;
                    case 'updateArticle' :
                        $this->_backController ->updateArticle($_GET['idArt']);
                        break;
                    case 'deleteArticle' :
                        $this->_backController ->deleteArticle($_GET['idArt']);
                        break;
                    case 'addComment' :
                        $this->_frontController->addComment($_GET);
                        break;
                    case 'updateComment' :
                        $this->_backController->updateComment();
                        break;
                    case 'deleteComment' :
                        $this->_backController->deleteComment($_GET);
                        break;
                    case 'valideComment' :
                        $this->_backController->valideComment($_GET);
                        break;
                    case 'adminCommentaires' :
                        $this->_backController ->adminCommentaires();
                        break;
                    //Zone connexion
                    case 'checkLogin' :
                        $this->_frontController->checkLogin();
                        break;
                    case 'adminGestion' :
                        $this->_backController ->adminGestion();
                        break;
                    //zone User
                    case 'adminUsers' :
                        $this->_userController->adminUsers();
                        break;
                    case 'addUser' :
                        $this->_userController ->addUser();
                        break;
                    case 'checkUser' :
                        $this->_userController ->checkUser();
                        break;
                    case 'updateUser' :
                        $this->_userController->updateUser();
                        break;
                    case 'deleteUser' :
                        $this->_userController->deleteUser($_GET);
                        return;
                    default :
                        $this->_frontController->page404();
                }
                return;
            }
            $this->_frontController->accueil();
        }
        catch (Exception $e)
        {
            $this->_frontController->page404();
        }

    }
}
