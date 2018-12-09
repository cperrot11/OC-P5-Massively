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
use App\src\controller\ContactController;
use App\src\FORM\CommentForm;
use App\src\FORM\ConnexionForm;
use App\src\FORM\ContactForm;
use App\src\FORM\MaxLengthValidator;
use App\src\FORM\NotNullValidator;
use App\src\model\Comment;
use App\src\model\Message;
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
    private $contact;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->user = new User();
        $this->userDAO = new UserDAO();
        $this->view = new View();
    }

    //3- Création commentaire
    public function addComment($get)
    {
        if (!isset($_SESSION['role']))
        {
            echo "<p>L'ajout de commentaire est réservé aux membres</p>";
            echo "<a class='btn btn-warning btn-sm' href='../public/index.php?route=login'>Connexion</a>";
            return false;
        }
        $comment = new Comment();
        $comment->setPseudo($_SESSION['login']);
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
            $_SESSION['error']='Commentaire ajouté et en attente de validation';
            $url = "../public/index.php?route=article&idArt=".$_GET['idArt'];
            header("location:".$url);
            return;
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('AddComment',true, ['formulaire' => $data]);
    }

    public function contact()
    {
        $message = new Message();
        $contact = new ContactController();
        if (isset($_POST['submit'])) {
            $message->setNom($_POST['nom']);
            $message->setMail($_POST['mail']);
            $message->setContent($_POST['content']);
        }
        $formBuilder = new ContactForm($message);
        $formBuilder->build();
        $form = $formBuilder->form();

        if (isset($_POST['submit']) && $form->isValid())
        {
            $contact->envoi($_POST);
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('contact', true,['formulaire' => $data]);
    }
    public function accueil()
    {
        $this->view->render('accueil',false);
        $this->contact();
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
        $this->view->render('blog',true,['articles'=> $articles]);
    }
    //7-Afficher 1 article
    public function article($idArt)
    {
        $article = $this->articleDAO->getArticle($idArt);
        $comments = $this->commentDAO->getCommentsFromArticle($idArt);

        $this->view->render('Single',false, [
            'article'=> $article,
            'comments' => $comments
        ]);
//        $this->view->render('form_comment',true, []);
    }

    public function login(){
        if (isset($_SESSION['login']))
        {
            $user = $this->userDAO->getUser($_SESSION['login']);
        }
        else {
            $user = $this->user;
        }
        $formBuilder = new ConnexionForm($user);
        $formBuilder->build();
        $form = $formBuilder->form();

        $this->view = new View();
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('Connexion',true , ['formulaire' => $data]);
        unset($_SESSION['error']);

        return false;
    }
    public function checkLogin()
    {
        if (isset($_POST['submit']))
        {
            $test = $this->userDAO->CheckUser($_POST['login'],$_POST['pass']);
            if ($test<>false)
            {
                $_SESSION['login']= $test->getLogin();
                $_SESSION['role'] = ($test->getAdmin())? "admin":"membre";
                $url = "../public/index.php";
            }
            else
            {
                $_SESSION['error']="pseudo ou mot de passe incorrect";
                $url = "../public/index.php?route=login";
            }
            header("location:".$url);
        }
    }

}