<?php

namespace App\src\model;

use App\config\File;

class Article extends Entity
{
    private $id;
    private $title;
    private $chapo;
    private $content;
    private $author;
    private $picture;
    private $picture_file;
    private $file;

    /**
     * @return mixed
     */
    public function getPicture_file()
    {
        return $this->picture_file;
    }

    /**
     * @param mixed $picture_file
     */
    public function setPicture_file($picture_file): void
    {
        $this->picture_file = $picture_file;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
    private $date_added;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * @return mixed
     */
    public function getChapo($length=0)
    {
        return ($length===0)?$this->chapo:substr($this->chapo,0,$length);
    }

    /**
     * @param mixed $chapo
     */
    public function setChapo($chapo): void
    {
        $this->chapo = $chapo;
    }

    /**
     * @return mixed
     */
    public function getContent($length=0)
    {
        return ($length===0)?$this->content:substr($this->content,0,$length);
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getDateAdded()
    {
        return $this->date_added;
    }

    /**
     * @param mixed $date_added
     */
    public function setDateAdded($date_added)
    {
        $this->date_added = $date_added;
    }

    public function hydrate($post, $picture)
    {
        $file = new File();
        if (isset($post['submit'])) {
            foreach ($post as $field => $val) {
                if (isset($field) && !empty($val)) {
                    $set = 'set' . ucfirst($field);
                    if (method_exists($this, $set)) {
                        $this->$set($val);
                    }
                }
            }
            $file->addPicture($picture['picture'],$this);
        }
    }
}