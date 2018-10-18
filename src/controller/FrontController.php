<?php

namespace App\src\controller;
//todo virer de là !!!
if(!isset($_SESSION))
{
    session_start();
}

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
use App\src\FORM\CommentForm;
use App\src\FORM\ConnexionForm;
use App\src\FORM\MaxLengthValidator;
use App\src\FORM\NotNullValidator;
use App\src\model\Comment;
use App\src\view\View;
use App\src\model\user;
use Zend\Validator\StringLength;
use App\src\FORM\Form;
use App\src\FORM\StringField;
use App\src\FORM\TextField;

class FrontController
{
    private $articleDAO;
    private $commentDAO;
    private $user;
    private $userDAO;
    private $view;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->user = new User();
        $this->userDAO = new UserDAO();
        $this->view = new View();
    }
    //1- Création article
    public function addArticle($post)
    {
        if(isset($post['submit'])) {
            $articleDAO = new ArticleDAO();
            $articleDAO->saveArticle($post);
            session_start();
            $_SESSION['add_article'] = 'Le nouvel article a bien été ajouté';
            header('Location: ../public/index.php');
        }
        $this->view->render('form_article', [
            'post' => $post
        ]);

    }
    //3- Création commentaire
    public function addComment($get)
    {
        $comment = new Comment();
        // si retour de formulaire transfert vers $comment
        //todo : rajouter une boucle pour tester et alimenter la présence des champs du post
        if (isset($_POST['submit'])) {
            $comment->setPseudo($_POST['pseudo']);
            $comment->setContent($_POST['content']);
        }
        $formBuilder = new CommentForm($comment);
        $formBuilder->build();
        $form = $formBuilder->form();

        if (isset($_POST['submit']) && $form->isValid()){
            //enregistrement en base
            {$this->commentDAO->addComment($_GET['idArt'],$_POST);}
            //affiche single article
            $this->article($_GET['idArt']);
            return;
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('add_comment', ['formulaire' => $data]);
    }

    //5- Supprimer commentaire
    public function deleteComment($get)
    {
        extract($get);
        $this->commentDAO->deleteComment($get['idComment']);
        $this->article($get['idArt']);
    }
    //6-Afficher liste article
    public function articles()
    {
        $articles = $this->articleDAO->getArticles();
        $this->view->render('blogs',['articles'=> $articles]);
    }
    //7-Afficher 1 article
    public function article($idArt)
    {
        $article = $this->articleDAO->getArticle($idArt);
        $comments = $this->commentDAO->getCommentsFromArticle($idArt);

        $this->view->render('single', [
            'article'=> $article,
            'comments' => $comments
        ]);
//        $this->view->render('form_comment', []);
    }

    public function login(){
        if (isset($_SESSION['login']))
        {
            $user = $this->userDAO->getUser($_SESSION['login']);
        }
        else $user = $this->user;
        $formBuilder = new ConnexionForm($user);
        $formBuilder->build();
        $form = $formBuilder->form();

        $this->view = new View();
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('connexion', ['formulaire' => $data]);
        unset($_SESSION['error']);

        return false;
    }

    public function check()
    {
        if (isset($_POST['submit']))
        {
            if ($this->userDAO->CheckUser($_POST['login'],$_POST['pass']))
                {
                    $_SESSION['login']= $_POST['login'];
                    $_SESSION['role'] = 'admin';
                }
            else
                {
                    $_SESSION['error']="pseudo ou mot de passe incorrect";
                    $url = "../public/index.php?route=login";
                }
            header("location:".$url);
        }
        if (isset($_POST['logout']))
        {
            //$_SESSION = array();
            session_destroy();
            $url = "../public/index.php";
            header("location:".$url);
        }
    }
}