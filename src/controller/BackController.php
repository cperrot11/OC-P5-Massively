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
    private $get;
    private $post;
    private $session;
    private $file;
    private $file_treat;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        $this->frontController = new FrontController();
        $this->request = new Request();
        $this->get = $this->request->get('query');
        $this->post = $this->request->get('post');
        $this->session = $this->request->get('session');
        $this->file = $this->request->get('file');
        $this->file_treat = new File();
    }

    public function adminGestion()
    {
        if (!$this->request->isAdmin()) {
            $text1 = "L'accès réservé aux administrateurs";
            $this->request->set('session', 'error', $text1);
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
        if (!$this->request->isAdmin()) {
            $this->frontController->login($this->get);
            $text1 = 'modification impossible';
            $this->request->set('session', 'error', $text1);
            return false;
        }
        $comment = new Comment();
        // si retour de formulaire transfert vers $comment
        if ($this->request->isPostSubmit()) {
            $comment->setPseudo($this->post['pseudo']);
            $comment->setContent($this->post['content']);
        }
        else {
            //récupère le commentaire a modifier.
            $comment = $this->commentDAO->getComment($this->get['idComment']);
        }
        $formBuilder = new CommentForm($comment);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($this->request->isPostSubmit() && $form->isValid()) {
            //enregistrement en base
            $this->commentDAO->updateComment($this->get['idComment'], $this->post);
            $text1 = "Commentaire mis à jour !";
            $this->request->set('session', 'error', $text1);
            if ($this->request->isFront()) {
                $url = "../public/index.php?route=article&idArt=".$this->get['idArt']."#begin";
                header("location:".$url);
                exit();
            }
            if ($this->request->isBack()) {
                $url = "../public/index.php?route=adminCommentaires#begin";
                header("location:".$url);
                exit();
            }

        }
        $data = $form->createView(); // On passe le formulaire généré à la vue.
        $this->view->render('AdminUpdateComment',true, ['formulaire' => $data]);
    }
    public function valideComment()
    {
        $texta = 'Modification impossible';
        $textb = 'Modification effectuée.';
        $text1 = (!$this->commentDAO->valideComment($this->get)) ? $texta : $textb;
        $this->request->set('session', 'error', $text1);

        $url = "../public/index.php?route=adminCommentaires#begin";
        header("location:".$url);
        exit();
    }
    public function deleteComment()
    {
        $this->commentDAO->deleteComment($this->get['idComment']);
        if ($this->request->isFront()) {
            $url = "../public/index.php?route=article&idArt=".$this->get['idArt']."#begin";
            header("location:".$url);
        }
        if ($this->request->isback()) {
            $url = "../public/index.php?route=adminCommentaires#begin";
            header("location:".$url);
        }
        $text1 = "Commentaire supprimé";
        $this->request->set('session', 'error', $text1);
        return;
    }
    public function adminArticles()
    {
        $articles = $this->articleDAO->getArticles();
        $this->view->render('AdminBlog',true, ['articles'=> $articles]);
    }
    public function addArticle()
    {
        if ($this->request->checkSession($this->frontController)) {
            $article = new Article();
            $article->setDateAdded(date("d-m-Y"));
            $article->setAuthor($this->session['login']);

            $file = $this->file;
            $article->hydrate($this->post, $file);

            $formBuilder = new ArticleForm($article);
            $formBuilder->build();
            $form = $formBuilder->form();
            if ($this->request->isPostSubmit() && $form->isValid()) {
                $destination = 'C:/wamp64/www/OC/P5-Blog PHP/3-POO/App/uploads/';
                $destination.= basename($file['picture']['name']);
                $fileName = $file['picture']['tmp_name'];
                move_uploaded_file($fileName, $destination );
                $_articleDAO = new ArticleDAO();
                if ($_articleDAO->saveArticle($this->post, $article->getPicture())!='false') {
                    $text1 = 'Le nouvel article a bien été ajouté';
                    $this->request->set('session', 'error', $text1);
                }
                else {
                    $text1 = 'Création article impossible : ';
                    $text1 = $text1.$this->session['error'];
                    $this->request->set('session', 'error', $text1);
                }
                header('Location: ../public/index.php?route=articles');
                return;
            }
            $data = $form->createView(); // On passe le formulaire généré à la vue.
            $this->view->render('AdminAddArticle',true, ['formulaire' => $data]);
        }

    }
    public function updateArticle()
    {
        $idArt = $this->get['idArt'];
        $article = new Article();
        $article = $this->articleDAO->getArticle($idArt);
        //reprends les données ayant pu être modifiées
        $article->hydrate($this->post, $this->file);
        $formBuilder = new ArticleForm($article);
        $formBuilder->build();
        $form = $formBuilder->form();
        if ($this->request->isPostSubmit() && $form->isValid()) {
                $this->file_treat->movePicture($this->file);
                $this->articleDAO->updateArticle($idArt, $this->post,$article->getPicture());
                $text1 = 'Modification effectuées sur l\'article '.$idArt ;
                $this->request->set('session', 'error', $text1);
                $url = "../public/index.php?route=adminArticles#begin";
                header("location:".$url);
                exit();
            }

        $data = $form->createView();
        $this->view->render('AdminUpdateArticle',true, [
            'article'=> $article,
            'formulaire' => $data
        ]);
    }
    public function deleteArticle()
    {
        $idArt = $this->request->get('query', 'idArt');
        if ($this->articleDAO->deleteArticle($idArt)) {
            $text1 = 'Article + commentaires correspondants effacés';
        }
        else {
            $text1 = 'Suppression impossible';
        }
        $this->request->set('session', 'error', $text1);
        $url = "../public/index.php?route=adminArticles#begin";
        header("location:".$url);
        exit();
    }
}