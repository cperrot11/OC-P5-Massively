<?php

namespace App\src\controller;
if(!isset($_SESSION))
{
    session_start();
}

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
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
    private $userDAO;
    private $view;
    private $frontController;
    private $route;
    private $article;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
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
            if (isset($_FILES['picture']) && !empty($_FILES['picture']['name']))
            {
                $article->setPicture($_FILES['picture']['name']);
            }

        }
        $formBuilder = new ArticleForm($article);
        $formBuilder->build();
        $form = $formBuilder->form();
        if(isset($post['submit']) && $form->isValid())
        {
            move_uploaded_file($_FILES['picture']['tmp_name'], 'C:/wamp64/www/OC/P5-Blog PHP/3-POO/App/uploads/' . basename($_FILES['picture']['name']));
            $articleDAO = new ArticleDAO();
            $articleDAO->saveArticle($post,$article->getPicture());
            $_SESSION['add_article'] = 'Le nouvel article a bien été ajouté';
            header('Location: ../public/index.php');
            return true;
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('AdminAddArticle',true, ['formulaire' => $data]);

    }
    public function adminGestion()
    {
        if (!isset($_SESSION['role']) or $_SESSION['role']<>'admin'){
            $_SESSION['error']="L'accès réservé aux administrateurs";
            $this->frontController->login();
            return false;
        }
        else{
            $this->view->render('AdminGestion',true, []);
            }
    }

    public function adminCommentaires()
    {
        $comments = $this->commentDAO->getCommentAll();
        $this->view->render('AdminComment',['comments'=> $comments]);
    }
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
            $_SESSION['error']="Commentaire mis à jour !";
            if (isset($_GET['appel']) && $_GET['appel']==="front")
            {
                //affiche single article
                $this->frontController->article($_GET['idArt']);
            }
            if (isset($_GET['appel']) && $_GET['appel']==="back")
            {
                //affiche single article
                $this->adminCommentaires();
            }
            return;
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('AdminUpdateComment', ['formulaire' => $data]);
    }
    public  function valideComment($get)
    {
        if (!$this->commentDAO->valideComment($get))
        {
            $_SESSION['error'] = 'Validation impossible';
        }
        $this->adminCommentaires();

    }
    public function deleteComment($get)
    {
        extract($get);
        $this->commentDAO->deleteComment($get['idComment']);
        if (isset($_GET['appel']) && $_GET['appel']==="front")
        {
            $this->frontController->article($get['idArt']);
        }
        if (isset($_GET['appel']) && $_GET['appel']==="back")
        {
            $this->adminCommentaires();
        }
    }

    public function adminArticles()
    {
        $articles = $this->articleDAO->getArticles();
        $this->view->render('AdminBlog',['articles'=> $articles]);
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
                $this->adminArticles();
                return;
            }

        $data = $form->createView();
        $this->view->render('AdminUpdateArticle', [
            'article'=> $article,
            'formulaire' => $data
        ]);
    }

    public function deleteArticle($idArt)
    {
        if ($this->articleDAO->deleteArticle($idArt))
        {
            $_SESSION['error'] = 'Article + commentaires correspondants effacés';
        }
        else
        {
            $_SESSION['error'] = 'Suppression impossible';
        }
        $this->adminArticles();
    }





}