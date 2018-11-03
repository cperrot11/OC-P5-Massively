<?php

namespace App\src\DAO;

use App\src\model\Article;

class ArticleDAO extends DAO
{
    public function getArticles()
    {
        $sql = 'SELECT id, title, content, author, date_added FROM article ORDER BY id DESC';
        $result = $this->sql($sql);
        $articles = [];
        foreach ($result as $row) {
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        return $articles;
    }

    public function getArticle($idArt)
    {
        $sql = 'SELECT id, title, content, author, date_added FROM article WHERE id = ?';
        $result = $this->sql($sql, [$idArt]);
        $row = $result->fetch();
        if($row) {
            return $this->buildObject($row);
        } else {
            echo 'Aucun article existant avec cet identifiant';
        }
    }

    public function saveArticle($article)
    {
        //Permet de récupérer les variables $title, $content et $author
        extract($article);
        $sql = 'INSERT INTO article (title, content, author, date_added) VALUES (?, ?, ?, NOW())';
        $this->sql($sql, [$title, $content, $author]);
    }

    public function updateArticle($idArt,$post)
    {
        extract($post);
        $sql = 'UPDATE article set title=?,content=?,date_added=NOW() WHERE id= ?';
        $this->sql($sql, [$title,$content,intval($idArt)]);
    }
    public function deleteArticle($idArt)
    {
        $sql = 'DELETE FROM article WHERE id=?';
        $result = $this->sql($sql,[intval($idArt)]);
        //$result->fetch();
    }

    private function buildObject(array $row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setDateAdded($row['date_added']);
        $article->setAuthor($row['author']);
        return $article;
    }
}
