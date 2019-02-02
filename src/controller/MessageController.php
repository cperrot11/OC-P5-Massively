<?php
/**
 * Manage contact mail
 *
 * PHP version 7.2
 *
 * @category MessageController
 * @package App\src\controller
 * @author Christophe PERROTIN
 * @copyright 2018
 * @license MIT License
 * @link http://wwww.perrotin.eu
 */

namespace App\src\controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\config\Request;

/**
 * Class MessageController
 * @package App\src\controller
 */
class MessageController
{
    private $request;
    private $get;
    private $post;
    private $session;
    /**
     * MessageController constructor.
     */
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        //Server settings
        $this->mail->SMTPDebug = 0;
        $this->mail->isSMTP();
        $this->mail->Host = 'SSL0.OVH.NET';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'contact@perrotin.eu';
        $this->mail->Password = 'Mecani4306';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
        $this->request = new Request();
        $this->session = $this->request->get('session');

    }
    public function envoi($post)
    {
        extract($post);
        try
        {
            $this->mail->setFrom($mail, $nom);
            $this->mail->addAddress('c.perrotin@mecanicsud.com', 'Blog');
            $this->mail->addReplyTo('c.perrotin@mecanicsud.com', 'Blog');

            //Attachments
            //$this->mail->addAttachment('../public/img/avatar.jpg', 'new.jpg');

            //Content
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Message du blog';
            $this->mail->Body    = $content;

            $this->mail->send();
            $text1 = 'Le message a été envoyé';
            $this->request->set('session', 'error', $text1);
            return true;
        }
        catch (Exception $e)
        {
            $text1 = "Le Message n'a pas pu être envoyé : ".$this->mail->ErrorInfo;
            $this->request->set('session', 'error', $text1);
            return false;
        }
    }
}

