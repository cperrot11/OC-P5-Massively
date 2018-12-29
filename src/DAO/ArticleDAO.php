<?php

namespace App\src\DAO;

use App\src\model\Article;

class ArticleDAO extends DAO
{
    public function getArticles()
    {
        $sql = 'SELECT id, title, chapo, content, author, date_added, picture FROM article ORDER BY date_added DESC';
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
        $sql = 'SELECT id, title, chapo, content, author, date_added, picture FROM article WHERE id = ?';
        $result = $this->sql($sql, [$idArt]);
        $row = $result->fetch();
        if($row) {
            return $this->buildObject($row);
        } else {
            echo 'Aucun article existant avec cet identifiant';
        }
    }

    public function saveArticle($article,$picture)
    {
        //Permet de récupérer les variables $title, $content et $author
        extract($article);
        $sql = 'INSERT INTO article (title, chapo, content, author, picture, date_added) VALUES (?, ?, ?, ?, ?,NOW())';
        $this->sql($sql, [$title, $chapo, $content, $author, $picture]);
    }

    public function updateArticle($idArt,$post,$picture)
    {
        extract($post);
        $sql = 'UPDATE article set title=?,chapo=?, content=?,date_added=NOW(),picture=? WHERE id= ?';
        $this->sql($sql, [$title,$chapo,$content,$picture,intval($idArt)]);
    }
    public function deleteArticle($idArt)
    {
        $sql = 'DELETE FROM article WHERE id=?';
        $result = $this->sql($sql,[intval($idArt)]);
        if ($result->rowCount())
                {return true;}
                else {return false;}
    }

    private function buildObject(array $row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setChapo($row['chapo']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setPicture($row['picture']);
        $article->setPicture_File($row['picture']);
        $article->setDateAdded($row['date_added']);
        $article->setAuthor($row['author']);
        return $article;
    }
}
