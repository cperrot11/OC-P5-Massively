<?php

namespace App\src\DAO;

use App\src\model\Comment;

class CommentDAO extends DAO
{
    public function getCommentsFromArticle($idArt)
    {
        $sql = 'SELECT id, pseudo, content, date_added FROM comment WHERE article_id = ?';
        $result = $this->sql($sql, [$idArt]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        return $comments;
    }
    public function getComment($idComment)
    {
        $sql = 'SELECT id, pseudo, content, date_added FROM comment WHERE id = ?';
        $result = $this->sql($sql, [$idComment]);
        $row = $result->fetch();
        if($row) {
            return $this->buildObject($row);
        } else {
            echo 'Aucun commentaire existant avec cet identifiant';
        }
    }
    public function addComment($idArt,$comment)
    {
        extract($comment);
        $sql = 'INSERT INTO comment (pseudo,content,article_id, date_added) VALUES (?, ?, ?, NOW())';
        $this->sql($sql, [$pseudo, $content, $idArt]);
    }

    public function updateComment($idComment,$comment)
    {
        extract($comment);
        $sql = 'UPDATE comment set pseudo=?,content=?,date_added=NOW() WHERE id= ?';
        $this->sql($sql, [$pseudo,$content,intval($idComment)]);
    }
    public function deleteComment($id)
    {
        $sql = 'DELETE FROM comment WHERE id=?';
        $this->sql($sql,[intval($id)]);
    }

    private function buildObject(array $row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setDateAdded($row['date_added']);
        return $comment;
    }

}
