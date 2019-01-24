<?php
/**
 * Manage blog, comment and login
 *
 * PHP version 7.2
 *
 * @category BackController
 * @package App\src\controller
 * @author Christophe PERROTIN <christophe@perrotin.eu>
 * @copyright 2018 c.perrotin
 * @license MIT License
 * @link http://wwww.perrotin.eu
 */

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
use App\src\FORM\ArticleForm;
use App\src\FORM\CommentForm;
use App\src\model\Article;
use App\src\view\View;
use App\src\model\Comment;
use App\config\Request;
use App\config\File;

/**
 * Class BackController
 * @package App\src\controller
 */
class BackController
{
    private $articleDAO;
    private $commentDAO;
    private $userDAO;
    private $view;
    private $frontController;
    private $request;
    private $file;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        $this->frontController = new FrontController();
        $this->request = new Request();
        $this->file = new File();
    }
    //1- Création article
    public function addArticle($post)
    {

        if ($this->request->checkSession($this->frontController)) {
            $article = new Article();
            $article->setDateAdded(date("d-m-Y"));
            $article->setAuthor($_SESSION['login']);
            $article->hydrate($this->request->post, $this->request->file);

            $formBuilder = new ArticleForm($article);
            $formBuilder->build();
            $form = $formBuilder->form();
            if (isset($post['submit']) && $form->isValid()) {
                $destination = 'C:/wamp64/www/OC/P5-Blog PHP/3-POO/App/uploads/';
                $destination.= basename($_FILES['picture']['name']);
                move_uploaded_file($_FILES['picture']['tmp_name'], $destination );
                $_articleDAO = new ArticleDAO();
                if ($_articleDAO->saveArticle($post, $article->getPicture())!='false') {
                    $_SESSION['error'] = 'Le nouvel article a bien été ajouté';
                }
                else {
                    $_SESSION['error'] = 'Création article impossible : '.$_SESSION['error'];
                }
                header('Location: ../public/index.php?route=articles');
                return;
            }
            $data = $form->createView(); // On passe le formulaire généré à la vue.
            $this->view->render('AdminAddArticle',true, ['formulaire' => $data]);
        }

    }
    public function adminGestion()
    {
        if (!isset($_SESSION['role']) or $_SESSION['role']<>'admin') {
            $_SESSION['error']="L'accès réservé aux administrateurs";
            $this->frontController->login();
            return false;
        }
        else {
            $this->view->render('AdminGestion',true, []);
            }
    }

    public function adminCommentaires()
    {
        $comments = $this->commentDAO->getCommentAll();
        return $this->view->render('AdminComment',true, ['comments'=> $comments]);
    }
    public function updateComment()
    {
        if (!isset($_SESSION['role']) or $_SESSION['role']<>'admin') {
            $this->frontController->login($_GET);
            $_SESSION['error']='modification impossible';
            return false;
        }
        $comment = new Comment();
        // si retour de formulaire transfert vers $comment
        if (isset($_POST['submit'])) {
            $comment->setPseudo($_POST['pseudo']);
            $comment->setContent($_POST['content']);
        }
        else {
            //récupère le commentaire a modifier.
            $comment = $this->commentDAO->getComment($_GET['idComment']);
        }
        $formBuilder = new CommentForm($comment);
        $formBuilder->build();
        $form = $formBuilder->form();

        if (isset($_POST['submit']) && $form->isValid()) {
            //enregistrement en base
            $this->commentDAO->updateComment($_GET['idComment'], $_POST);
            $_SESSION['error']="Commentaire mis à jour !";
            if (isset($_GET['appel']) && $_GET['appel']==="front") {
                $url = "../public/index.php?route=article&idArt=".$_GET['idArt']."#begin";
                header("location:".$url);
                return;

            }
            if (isset($_GET['appel']) && $_GET['appel']==="back") {
                $url = "../public/index.php?route=adminCommentaires#begin";
                header("location:".$url);
                return;
            }

        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('AdminUpdateComment',true, ['formulaire' => $data]);
    }
    public function valideComment($get)
    {
        if (!$this->commentDAO->valideComment($get)) {
            $_SESSION['error'] = 'Modification impossible';
        }
        else {
            $_SESSION['error'] = 'Modification effectuée.';
        }
        $url = "../public/index.php?route=adminCommentaires#begin";
        header("location:".$url);
        return;

    }
    public function deleteComment($get)
    {
        extract($get);
        $this->commentDAO->deleteComment($get['idComment']);
        if (isset($_GET['appel']) && $_GET['appel']==="front") {
            $url = "../public/index.php?route=article&idArt=".$get['idArt']."#begin";
            header("location:".$url);
        }
        if (isset($_GET['appel']) && $_GET['appel']==="back") {
            $url = "../public/index.php?route=adminCommentaires#begin";
            header("location:".$url);
        }
        $_SESSION['error']="Commentaire supprimé";
        return;
    }

    public function adminArticles()
    {
        $articles = $this->articleDAO->getArticles();
        $this->view->render('AdminBlog',true, ['articles'=> $articles]);
    }

    public function updateArticle($idArt)
    {
        $article = new Article();
        $article = $this->articleDAO->getArticle($idArt);
        //reprends les données ayant pu être modifiées
        $article->hydrate($this->request->post, $this->request->file);
        $formBuilder = new ArticleForm($article);
        $formBuilder->build();
        $form = $formBuilder->form();
        if (isset($_POST['submit']) && $form->isValid()) {
                $this->file->movePicture($this->request->file);
                $this->articleDAO->updateArticle($idArt, $_POST,$article->getPicture());
                $_SESSION['error']='Modification effectuées sur l\'article '.$idArt ;
                $url = "../public/index.php?route=adminArticles#begin";
                header("location:".$url);
                return;
            }

        $data = $form->createView();
        $this->view->render('AdminUpdateArticle',true, [
            'article'=> $article,
            'formulaire' => $data
        ]);
    }

    public function deleteArticle($idArt)
    {
        if ($this->articleDAO->deleteArticle($idArt)) {
            $_SESSION['error'] = 'Article + commentaires correspondants effacés';
        }
        else {
            $_SESSION['error'] = 'Suppression impossible';
        }
        $url = "../public/index.php?route=adminArticles#begin";
        header("location:".$url);
    }
}