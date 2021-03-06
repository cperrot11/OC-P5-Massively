<?php
/**
 * Avoid using directly super global variables
 *
 *  @link http://wwww.perrotin.eu
 */
namespace App\config;

use App\src\controller\FrontController;

/**
 * Class Request
 * @package App\config
 */
class Request
{
    private $post;
    private $session;
    private $frontcontroller;
    private $file;

    /**
     * Request constructor.
     *
     * @param $query
     * @param $post
     * @param $session
     * @param $cookie
     */
    public  function __construct()
    {
        $this->update();
    }

    public function update(){
        $this->query = $_GET;
        $this->post = $_POST;
        $this->session = $_SESSION;
        $this->file = $_FILES;
    }

    /**
     * Return the value if exist
     *
     * @param $name
     * @param $type
     * @return object or string
     */
    public function get($type, $name= null){
        $this->update();
        if (!isset($name)){
            return $this->$type;
        }
        if (isset($this->$type[$name])){
            return ($this->$type[$name]);
        }

        return null;
    }

    /**
     * Affect the global variable
     *
     * @param $name
     * @param $value
     * @param $type
     */
    public function set($type, $name, $value){
        $this->$type[$name]=$value;
        if ($type==='session'){
            $_SESSION[$name]=$value;
        }
        if ($type==='post'){
            $_POST[$name]=$value;
        }
    }

    public function unsetSession($name){
        unset($_SESSION[$name]);
    }

    /**
     * @param $frontController
     * @return bool
     */
    public function checkSession($frontController)
    {
        if (!isset($this->session['role']) or $this->session['role']<>'admin') {
            $texte = 'Création d\'article réservé aux utilisateurs inscrits';
            $_SESSION['error']=$texte;
            $this->frontcontroller = $frontController;
            $this->frontcontroller->login();
            return false;
        }
        return true;
    }
    public function isError(){
        return (isset($this->session['error']));
    }

    /**
     * User is Membre ?
     *
     * @return bool
     */
    public function isMember()
    {
        if (isset($this->session['role'])){
            return $this->session['role']==="membre";
        }
        return false;
    }

    /**
     * User is Admin ?
     *
     * @return bool
     */
    public function isAdmin()
    {
        if (isset($this->session['role'])) {
            return $this->session['role'] === "admin";
        }
        return false;
    }

    /**
     * Check if form is posted
     *
     * @return bool
     */
    public function isPostSubmit(){
        return isset($this->post['submit']);
    }
    /**
     * User is loged ?
     *
     * @return bool
     */
    public function isLoged()
    {
        return (isset($this->session['login']) && $this->session['login']<>"");
    }
    public function getRequest(){
        return $this;
    }
    public function isBack(){
        return (isset($this->query['appel']) && $this->query['appel']==="back");
    }
    public function isFront(){
        return (isset($this->query['appel']) && $this->query['appel']==="front");
    }



}

