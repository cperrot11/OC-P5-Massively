<?php

namespace App\src\model;

class Comment extends Entity
{
    private $id;
    private $pseudo;
    private $content;
    private $dateAdded;
    private $articleId;

    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @param mixed $articleId
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }
    private $valide;

    /**
     * @return mixed
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * @param mixed $valide
     */
    public function setValide($valide)
    {
        $this->valide = $valide;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo='')
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getContent($length=0)
    {
        if ($length===0 or strlen($this->content)<$length)
        {
            return $this->content;
        }
        else
        {
            return substr($this->content,0,$length).'...';
        }

    }

    /**
     * @param mixed $content
     */
    public function setContent($content='')
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * @param mixed $dateAdded
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }
}