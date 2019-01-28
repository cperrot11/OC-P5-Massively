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
            $article->setAuthor($this->request->get('session', 'login'));
            $post = $this->request->get('post');
            $file = $this->request->get('file');
            $article->hydrate($post, $file);

            $formBuilder = new ArticleForm($article);
            $formBuilder->build();
            $form = $formBuilder->form();
            if ($this->request->isPostSubmit() && $form->isValid()) {
                $destination = 'C:/wamp64/www/OC/P5-Blog PHP/3-POO/App/uploads/';
                $destination.= basename($file['picture']['name']);
                $fileName = $file['picture']['tmp_name'];
                move_uploaded_file($fileName, $destination );
                $_articleDAO = new ArticleDAO();
                if ($_articleDAO->saveArticle($post, $article->getPicture())!='false') {
                    $text1 = 'Le nouvel article a bien été ajouté';
                    $this->request->set('session', 'error', $text1);
                }
                else {
                    $text1 = 'Création article impossible : ';
                    $text1 = $text1.$this->request->get('session', 'error');
                    $this->request->set('session', 'error', $text1);
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
        $post = $this->request->get('post');
        $get = $this->request->get('get');
        if ($this->request->isAdmin()) {
            $this->frontController->login($get);
            $text1 = 'modification impossible';
            $this->request->set('session', 'error', $text1);
            return false;
        }
        $comment = new Comment();
        // si retour de formulaire transfert vers $comment
        if ($this->request->isPostSubmit()) {
            $comment->setPseudo($post['pseudo']);
            $comment->setContent($post['content']);
        }
        else {
            //récupère le commentaire a modifier.
            $comment = $this->commentDAO->getComment($get['idComment']);
        }
        $formBuilder = new CommentForm($comment);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($this->request->isPostSubmit() && $form->isValid()) {
            //enregistrement en base
            $this->commentDAO->updateComment($get['idComment'], $post);
            $text1 = "Commentaire mis à jour !";
            $this->request->set('session', 'error', $text1);
            if (isset($get['appel']) && $get['appel']==="front") {
                $url = "../public/index.php?route=article&idArt=".$get['idArt']."#begin";
                header("location:".$url);
                return;

            }
            if (isset($get['appel']) && $get['appel']==="back") {
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
        $texta = 'Modification impossible';
        $textb = 'Modification effectuée.';
        $text1 = (!$this->commentDAO->valideComment($get)) ? $texta : $textb;
        $this->request->set('session', 'error', $text1);


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