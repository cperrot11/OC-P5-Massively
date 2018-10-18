<?php

namespace App\src\controller;
if(!isset($_SESSION))
{
    session_start();
}

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\FORM\CommentForm;
use App\src\view\View;
use App\src\model\Comment;
use App\src\controller\FrontController;

class BackController
{
    private $articleDAO;
    private $commentDAO;
    private $view;
    private $frontController;
    private $route;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
        $this->frontController = new FrontController();
    }

    public function addComment($post)
    {
        if(isset($post['submit'])) {
            $commentDAO = new CommentDAO();
            $commentDAO->saveComment($post);
            header('Location: ../public/index.php');
        }
        $this->view->render('form_comment', [
            'post' => $post
        ]);

    }

    //4- modification commentaire
    public function updateComment()
    {
        if (!isset($_SESSION['role']) or $_SESSION['role']<>'admin'){
            $this->frontController->login($_GET);
            $_SESSION['error']='modification impossible';
            return false;
        }
        $comment = new Comment();
        // si retour de formulaire transfert vers $comment
        if (isset($_POST['submit'])) {
            //todo : rajouter une boucle pour tester et alimenter la présence des champs du post
            $comment->setPseudo($_POST['pseudo']);
            $comment->setContent($_POST['content']);
        }
        else{
            //récupère le commentaire a modifier.
            $comment = $this->commentDAO->getComment($_GET['idComment']);
        }
        $formBuilder = new CommentForm($comment);
        $formBuilder->build();
        $form = $formBuilder->form();

        if (isset($_POST['submit']) && $form->isValid()){
            //enregistrement en base
            {$this->commentDAO->updateComment($_GET['idComment'],$_POST);}
            //affiche single article
            $this->frontController->article($_GET['idArt']);
            return;
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('update_comment', ['formulaire' => $data]);
    }

}