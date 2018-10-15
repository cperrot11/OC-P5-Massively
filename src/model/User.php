<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 14/10/2018
 * Time: 10:43
 */

namespace App\src\model;


class User extends Entity
{
    private $login;
    private $pass;
    private $name;
    private $admin;
    //Trouver une meilleure solution !
    private $route;

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route): void
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

    /**
     * @param mixed $idArt
     */
    public function setIdArt($idArt): void
    {
        $this->idArt = $idArt;
    }

    /**
     * @return mixed
     */
    public function getIdComment()
    {
        return $this->idComment;
    }

    /**
     * @param mixed $idComment
     */
    public function setIdComment($idComment): void
    {
        $this->idComment = $idComment;
    }
    private $idArt;
    private $idComment;

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass): void
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin): void
    {
        $this->admin = $admin;
    }



}