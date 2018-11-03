<?php

namespace App\src\controller;
if(!isset($_SESSION))
{
    session_start();
}

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\FORM\ArticleForm;
use App\src\FORM\CommentForm;
use App\src\model\Article;
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
    private $article;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
        $this->frontController = new FrontController();
    }
    //1- Création article
    public function addArticle($post)
    {
        if (!isset($_SESSION['role']) or $_SESSION['role']<>'admin'){
            $_SESSION['error']='Création d\'article réservé aux administrateurs';
            $this->frontController->login();
            return false;
        }
        $article = new Article();
        $article->setDateAdded(date("d-m-Y"));
        $article->setAuthor($_SESSION['login']);

        if (isset($_POST['submit']))
        {
            if (isset($_POST['title']) && !empty($_POST['title']))
            {
                $article->setTitle($_POST['title']);
            }
            if (isset($_POST['content']) && !empty($_POST['content']))
            {
                $article->setContent($_POST['content']);
            }
        }
        $formBuilder = new ArticleForm($article);
        $formBuilder->build();
        $form = $formBuilder->form();
        if(isset($post['submit']) && $form->isValid())
        {
            $articleDAO = new ArticleDAO();
            $articleDAO->saveArticle($post);
            session_start();
            $_SESSION['add_article'] = 'Le nouvel article a bien été ajouté';
            header('Location: ../public/index.php');
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('admin_addarticle', ['formulaire' => $data]);

    }
    public function admin_gestion()
    {
        if (!isset($_SESSION['role']) or $_SESSION['role']<>'admin'){
            $_SESSION['error']="L'accès réservé aux administrateurs";
            $this->frontController->login();
            return false;
        }
        else{
            $this->view->render('admin_gestion', []);
        }
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
            $this->commentDAO->updateComment($_GET['idComment'],$_POST);
            //affiche single article
            $this->frontController->article($_GET['idArt']);
            return;
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('update_comment', ['formulaire' => $data]);
    }
    //6-Afficher liste article
    public function admin_articles()
    {
        $articles = $this->articleDAO->getArticles();
        $this->view->render('admin_blogs',['articles'=> $articles]);
    }
    public function updateArticle($idArt)
    {
        $article = new Article();
        $article = $this->articleDAO->getArticle($idArt);
        if (isset($_POST['submit']))
        {
            //reprends les données ayant pu être modifiées
            if (isset($_POST['title']) && !empty($_POST['title'])) {
                $article->setTitle($_POST['title']);
            }
            if (isset($_POST['content']) && !empty($_POST['content'])) {
                $article->setContent($_POST['content']);
            }
        }
        $formBuilder = new ArticleForm($article);
        $formBuilder->build();
        $form = $formBuilder->form();
        if (isset($_POST['submit'])&& $form->isValid() )
            {
                $this->articleDAO->updateArticle($idArt,$_POST);
                $_SESSION['error']='Modification effectuées sur l\'article '.$idArt ;
                $this->admin_articles();
                return;
            }

        $data = $form->createView();
        $this->view->render('admin_updatearticle', [
            'article'=> $article,
            'formulaire' => $data
        ]);
    }
    public function deleteArticle($idArt)
    {
        if ($this->articleDAO->deleteArticle($idArt))
        {
            $_SESSION['error'] = 'Article + commentaire correspondants effacés';
        }
        else
        {
            $_SESSION['error'] = 'Suppression impossible';
        }
        $this->admin_articles();
    }


}