<?php

namespace App\src\DAO;

use App\src\model\Comment;

class CommentDAO extends DAO
{
    public function getCommentsFromArticle($idArt)
    {
        $sql = 'SELECT id, pseudo, content, date_added FROM comment WHERE valide=1 and article_id = ?';
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
        $sql = 'SELECT id, pseudo, content, date_added, valide, article_id FROM comment WHERE id = ?';
        $result = $this->sql($sql, [$idComment]);
        $row = $result->fetch();
        if($row) {
            return $this->buildObject($row);
        } else {
            echo 'Aucun commentaire existant avec cet identifiant';
        }
    }
    public function getCommentAll()
    {
        $sql = 'SELECT id, pseudo, content, date_added, valide, article_id FROM comment';
        $result = $this->sql($sql);
        $comment=[];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comment[$commentId] = $this->buildObject($row);
        }
        return $comment;
    }
    public function addComment($idArt,$comment)
    {
        extract($comment);
        $sql = 'INSERT INTO comment (pseudo,content,article_id, date_added, valide) VALUES (?, ?, ?, NOW(),0)';
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
    public function valideComment($get)
    {
        extract($get);
        $valide = ($valide==="0")?1:0;  //valider-dévalider
        $sql = 'UPDATE comment set valide=? WHERE id=?';
        $result = $this->sql($sql,[intval($valide),intval($idComment)]);

        if ($result->rowCount())
        {return true;}
        else {return false;}
    }

    private function buildObject(array $row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setDateAdded($row['date_added']);
        if (isset($row['valide'])) {$comment->setValide($row['valide']);}
        if (isset($row['article_id'])) {$comment->setArticleId($row['article_id']);}
        return $comment;
    }

}
