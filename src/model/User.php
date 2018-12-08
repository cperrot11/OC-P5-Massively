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
    private $email;
    private $admin;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


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
    public function setRoute($route)
    {
        $this->route = $route;
    }

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
    public function setLogin($login)
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
    public function setPass($pass)
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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return ($this->admin)==1?'Oui':'Non';
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        if ($admin=="on"||$admin==1)
        {
            $this->admin=1;
        }
        else
        {
            $this->admin=0;
        }
    }



}