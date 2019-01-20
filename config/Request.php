<?php
/**
 * Avoid using directly super global variables
 *
 * PHP version 7.2
 *
 * @category request
 * @package config
 * @author Christophe PERROTIN
 * @copyright 2018
 * @license MIT License
 * @link http://wwww.perrotin.eu
 */
namespace App\config;

use App\src\controller\FrontController;

class Request
{
    public $get;
    public $post;
    public $session;
    public $cookie;
    public $frontcontroller;
    public $file;

    /**
     * request constructor.
     * @param $get
     * @param $post
     * @param $session
     * @param $cookie
     */
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->session = $_SESSION;
        $this->cookie = $_COOKIE;
        $this->file = $_FILES;
    }
    public function checkSession($frontController)
    {
        if (!isset($this->session['role']) or $this->session['role']<>'admin') {
            $_SESSION['error']='Création d\'article réservé aux utilisateurs inscrits';
            $this->frontcontroller = $frontController;
            $this->frontcontroller->login();
            return false;
        }
    }
}

