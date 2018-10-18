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
        $sql = 'SELECT login,pass,name,admin FROM user ORDER BY name asc ';
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
        $sql = 'SELECT login, pass, name, admin FROM user WHERE login = ?';
        $result = $this->sql($sql, [$login]);
        $row = $result->fetch();
        return password_verify($pass, $row['pass']);
    }
    public function getUser($login)
    {
        $sql = 'SELECT login, pass, name, admin FROM user WHERE login = ?';
        $result = $this->sql($sql, [$login]);
        $row = $result->fetch();
        if($row)
        {
            return $this->buildObject($row);
        } else {
            //todo  : rajouter $_session['error']
            echo 'Aucun ustilisateur existant avec ce login';
        }
    }
    public function saveUser($user)
    {
        extract($user);
        $sql = 'INSERT INTO user (login, name, pass, admin) VALUES (?, ?, ?, ?)';
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $this->sql($sql, [$login,$name,$pass_hache,$admin]);
    }

    private function buildObject(array $row)
    {
        $user = new User();
        $user->setLogin($row['login']);
        $user->setName($row['name']);
        $user->setPass($row['pass']);
        $user->setAdmin($row['admin']);

        return $user;
    }

}