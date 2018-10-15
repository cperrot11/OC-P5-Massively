<?php

namespace App\src\controller;
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
    private $userDAO;
    private $view;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
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
        $user = $this->userDAO->getUser("admin");
        if (isset($_GET['idArt'])){
            $user->setRoute($_GET['route']);
            $user->setIdArt($_GET['idArt']);
            $user->setIdComment($_GET['idComment']);
        }
        $formBuilder = new ConnexionForm($user);
        $formBuilder->build();
        $form = $formBuilder->form();

        $this->view = new View();
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('connexion', ['formulaire' => $data]);

        return false;
    }

    public function check()
    {
        if (isset($_POST['submit']))
        {
            if ($_POST['login']==='admin' && $_POST['pass']==='pass')
            {

                $_SESSION['pseudo'] = 'admin';
                $url = "../public/index.php?";
                if (isset($_POST['route']) && !empty($_POST['route'])){
                    $url.="route=".htmlspecialchars($_POST['route']);
                }
                if (isset($_POST['idArt']) && !empty($_POST['idArt'])){
                    $url.="&idArt=".htmlspecialchars($_POST['idArt']);
                }
                if (isset($_POST['idComment']) && !empty($_POST['idComment'])){
                    $url.="&idComment=".htmlspecialchars($_POST['idComment']);
                }
                header("location:".$url);
            }
            else{
                //todo : géré l'erreur
                $url = "../public/index.php";
                if (isset($_POST['route']) && !empty($_POST['route'])){
                    $url.="?route=article";
                }
                if (isset($_POST['idArt']) && !empty($_POST['idArt'])){
                    $url.="&idArt=".htmlspecialchars($_POST['idArt']);
                }
                header("location:".$url);
            }
        }
        if (isset($_POST['logout']))
        {
            $_SESSION = array();
            session_destroy();
            $url = "../public/index.php";
            header("location:".$url);
        }
    }
}