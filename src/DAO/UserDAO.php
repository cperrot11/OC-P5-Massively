<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 14/10/2018
 * Time: 10:57
 */

namespace App\src\DAO;

use App\src\model\User;

class UserDAO extends DAO
{
    public function getUsers()
    {
        $sql = 'SELECT * FROM user ORDER BY name asc ';
        $result = $this->sql($sql);
        $users = [];
        foreach ($result as $row) {
            $login = $row['login'];
            $users[$login] = $this->buildObject($row);
        }
        return $users;
    }
    public function CheckUser($login, $pass)
    {
        $sql = 'SELECT * FROM user WHERE login = ?';
        $result = $this->sql($sql, [$login]);
        $row = $result->fetch();
        if (password_verify($pass, $row['pass'])) {
            return $this->buildObject($row);
        }
        else return false;
    }
    public function getUser($login)
    {
        $sql = 'SELECT * FROM user WHERE login = ?';
        $result = $this->sql($sql, [$login]);
        $row = $result->fetch();
        if($row)
        {
            return $this->buildObject($row);
        } else {
            //todo  : rajouter $_session['error']
            echo 'Aucun ustilisateur existant avec ce login';
            return false;
        }
    }
    public function saveUser($user)
    {
        extract($user);
        //vériif si utilisateur existant
        if ($this->CheckUser($login,$pass)<>false)
        {
            $_SESSION['error'] = "L'utilisateur existe déjà";
            return false;
        }
        $sql = 'INSERT INTO user (login, name, pass, email, admin) VALUES (?, ?, ?, ?, ?)';
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $result=$this->sql($sql, [$login,$name,$pass_hache,$email,$admin]);
        if ($result)
            {return true;}
        else
            {return false;}
    }
    public function updateUser($user)
    {
        extract($user);
        $sql = 'UPDATE user set name=?,email=?,pass=?,admin=? WHERE login= ?';
        if ($this->CheckUser($login,$pass))
            {
                $pass_hache = $pass;
            }
        else
            {
                $pass_hache = password_hash($pass, PASSWORD_DEFAULT);
            }
        $this->sql($sql, [$name,$email,$pass_hache,intval($admin),$login]);
    }
    public function deleteUser($login)
    {
        $sql = 'DELETE FROM user WHERE login=?';
        $this->sql($sql,[$login]);
    }
    private function buildObject(array $row)
    {
        $user = new User();
        $user->setLogin($row['login']);
        $user->setName($row['name']);
        $user->setPass($row['pass']);
        $user->setEmail($row['email']);
        $user->setAdmin($row['admin']);
        return $user;
    }

}