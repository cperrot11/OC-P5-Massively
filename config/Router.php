<?php

namespace App\config;

use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\FrontController;
use App\src\controller\ConnexionController;
use App\src\controller\UserController;

class Router
{
    private $frontController;
    private $backController;
    private $userController;
    private $errorController;
    private $connexionController;
    private $get;

    public function __construct()
    {
        $this->backController = new BackController();
        $this->frontController = new FrontController();
        $this->errorController = new ErrorController();
        $this->connexionController = new ConnexionController();
        $this->userController = new UserController();
    }

    public function run()
    {
        try{
            if(isset($_GET['route']))
            {
//              Connexion
                if($_GET['route'] === 'login'){
                    $this->frontController->login();
                }
//              Article précis
                else if ($_GET['route'] === 'article'){
                    $this->frontController->article($_GET['idArt']);
                }
//              Créer Article
                else if($_GET['route'] === 'addArticle') {
                    $this->backController->addArticle($_POST);
                }
//              3-Créer commentaire
                else if($_GET['route'] === 'addComment') {
                    $this->frontController->addComment($_GET);
                }
//              4-Modifier commentaire
                else if($_GET['route'] === 'updateComment') {
                    $this->backController->updateComment();
                 }
//              Supprimer commentaire
                else if($_GET['route'] === 'deleteComment') {
                    $this->frontController->deleteComment($_GET);
                }
//              Valider commentaire
                else if($_GET['route'] === 'valideComment') {
                    $this->backController->valideComment($_GET);
                }
                else if($_GET['route'] === 'check') {
                    $this->frontController->check();
                }
                else if($_GET['route'] === 'adminGestion') {
                    $this->backController ->adminGestion();
                }
                else if($_GET['route'] === 'newUser') {
                    $this->userController ->addUser();
                }
                else if($_GET['route'] === 'checkUser') {
                    $this->userController ->checkUser();
                }
                else if($_GET['route'] === 'adminArticles') {
                    $this->backController ->adminArticles();
                }
                else if($_GET['route'] === 'adminCommentaires') {
                    $this->backController ->adminCommentaires();
                }
                else if($_GET['route'] === 'updateArticle') {
                    $this->backController ->updateArticle($_GET['idArt']);
                }
                else if($_GET['route'] === 'deleteArticle') {
                    $this->backController ->deleteArticle($_GET['idArt']);
                }
                else{
                    $this->errorController->unknown();
                }
            }
            else{
                $this->frontController->articles();
            }
        }
        catch (Exception $e)
        {
            $this->errorController->error();
        }
    }
}
