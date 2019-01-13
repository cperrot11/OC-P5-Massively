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

class Request
{
    public $get;
    public $post;
    public $session;
    public $cookie;

    /**
     * request constructor.
     * @param $get
     * @param $post
     * @param $session
     * @param $cookie
     */
    public function __construct($get, $post, $session, $cookie)
    {
        $this->get = $get;
        $this->post = $post;
        $this->session = $session;
        $this->cookie = $cookie;
    }
}

