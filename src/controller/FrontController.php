<?php
/**
 * Display List blog, display blog and login
 *
 * @link http://wwww.perrotin.eu
 */

namespace App\src\controller;


use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
use App\src\FORM\CommentForm;
use App\src\FORM\ConnexionForm;
use App\src\FORM\ContactForm;
use App\src\model\Comment;
use App\src\model\Message;
use App\src\view\View;
use App\src\model\user;
use App\config\Request;

/**
 * Class FrontController
 *
 * @package App\src\controller
 */
class FrontController
{
    private $articleDAO;
    private $commentDAO;
    private $user;
    private $userDAO;
    private $view;
    private $request;

    /**
     * FrontController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->user = new User();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        $this->request = new Request();
    }



    /**
     * New comment
     *
     * @param $get
     */
    public function addComment($get)
    {
        $text1 = "Attention : L'ajout de commentaire est réservé aux membres";
        if (!$this->request->isMember() and !$this->request->isAdmin()){
            $this->request->set('session', 'error', $text1);
            $this->request->set('session', 'login', "");
        }
        $comment = new Comment();
        $comment->setPseudo($this->request->get('session', 'login'));
        // si retour de formulaire transfert vers $comment
        if ($this->request->isPostSubmit()) {
            $comment->setPseudo($this->request->get('post', 'pseudo'));
            $comment->setPseudo($this->request->get('post', 'content'));
        }
        $formBuilder = new CommentForm($comment);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($this->request->isPostSubmit() && $form->isValid()) {
            //enregistrement en base
            {$this->commentDAO->addComment($get['idArt'], $this->request->get('post'));}
            //affiche single article
            $text2='Commentaire ajouté et en attente de validation';
            $this->request->set('session', 'error', $text2);
            $url = "../public/index.php?route=article&idArt=";
            $url.=$get['idArt']."#begin";
            header("location:".$url);
            return;
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->request->set('session', 'error', $this->request->get('session', 'error'));
        $this->view->render('AddComment', true, ['formulaire' => $data]);
    }

    /**
     * Send message
     *
     * @return void
     */
    public function contact()
    {
        $message = new Message();
        $contact = new MessageController();
        if ($this->request->isPostSubmit()) {
            $message->setNom($this->request->get('post', 'nom'));
            $message->setContent($this->request->get('post', 'content'));
            $message->setMail($this->request->get('post', 'mail'));
        }
        $formBuilder = new ContactForm($message);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($this->request->isPostSubmit() && $form->isValid()) {
            $contact->envoi($this->request->get('form'));
        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('contact', true,['formulaire' => $data]);
    }

    /**
     * Display enter page
     */
    public function accueil()
    {
        $this->view->render('accueil', false);
        $this->contact();
    }



    /**
     * Delete comment
     *
     * @param $get
     * @return void
     */
    public function deleteComment($get)
    {
        extract($get);
        $this->commentDAO->deleteComment($get['idComment']);
        $this->article($get['idArt']);
    }

    /**
     * Display blog list
     *
     * @return void
     */
    public function articles()
    {
        $articles = $this->articleDAO->getArticles();
        $this->view->render('blog', true, ['articles'=> $articles]);
    }

    /**
     * Display single post
     *
     * @param $idArt
     * @return void
     */
    public function article($idArt)
    {
        $article = $this->articleDAO->getArticle($idArt);
        $comments = $this->commentDAO->getCommentsFromArticle($idArt);

        $this->view->render('Single', false, [
            'article'=> $article,
            'comments' => $comments
            ]
        );
    }

    /**
     * Use to connect user
     *
     * @return bool
     */
    public function login(){
        $user_log = $this->request->get('login','session');
        if ($user_log<>"") {
            $user = $user_log;
        } else {
            $user = $this->user;
        }
        $formBuilder = new ConnexionForm($user);
        $formBuilder->build();
        $form = $formBuilder->form();

        $this->view = new View();
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('Connexion', true, ['formulaire' => $data]);
        $this->request->set('session', 'error', null);

        return false;
    }

    /**
     * Check the user password
     *
     * @return void
     */
    public function checkLogin()
    {
        if (isset($_POST['submit'])) {
            $test = $this->userDAO->CheckUser($this->request->get('post', 'login'), $this->request->get('post', 'pass'));
            if ($test<>false) {
                $this->request->set('session', 'login', $test->getLogin());
                $this->request->set('session', 'role', ($test->getAdmin())? "admin":"membre");
                $text1 = "Vous êtes à présent connecté et pouvez commenter les articles.";
                $this->request->set('session', 'error', $text1);
                $url = "../public/index.php?route=articles#begin";
            } else {
                $text1 = "pseudo ou mot de passe incorrect";
                $this->request->set('session', 'error', $text1);
                $url = "../public/index.php?route=login";
            }
            header("location:".$url);
        }
    }

    /**
     *  Display error page
     *
     * @return void
     */
    public function page404()
    {
        $this->view->render('error', true);
    }

}