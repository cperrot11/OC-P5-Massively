<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 16/08/2018
 * Time: 19:33
 */
namespace App\src\DAO;

use PDO;

abstract class DAO
{
//    const DB_HOST = 'mysql:host=localhost;dbname=blog;charset=utf8';
//    const DB_USER = 'root';
//    const DB_PASS = '';


    private $connection;

    private function checkConnection()
    {
        //Vérifie si la connexion est nulle et fait appel à getConnection()
        if($this->connection === null) {
            return $this->getConnection();
        }
        //Si la connexion existe, elle est renvoyée, inutile de refaire une connexion
        return $this->connection;
    }

    public function getConnection()
    {
        try{
            $connection = new
            PDO(DB_HOST,DB_USER,DB_PASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //renvoi de la connexion
            return $connection;
        }
        catch (Exception $errorConnection)
        {
            die('Erreur de connection:'.$errorConnection->getMessage());
        }

    }

    protected function sql($sql, $parameters = null)
    {
        if($parameters)
        {
            $result = $this->getConnection()->prepare($sql);
            try
            {
                $result->execute($parameters);
                return $result;
            }
            catch (\PDOException $e)
            {
                $_SESSION['error'] = $e->getMessage();
                return false;
            }
        }
        else{
            $result= $this->getConnection()->query($sql);
            return $result;
        }
    }
}