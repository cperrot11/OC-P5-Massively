<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 16/11/2018
 * Time: 20:28
 */
namespace App\src\controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        //Server settings
        $this->mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host = 'SSL0.OVH.NET';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = 'contact@perrotin.eu';                 // SMTP username
        $this->mail->Password = 'Mecani4306';                           // SMTP password
        $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587;                                    // TCP port to connect to
    }
    public function envoi($post)
    {
        extract($post);
        try
        {
            $this->mail->setFrom($mail,$nom);
            $this->mail->addAddress('contact@perrotin.eu', 'Blog');     // Add a recipient
            $this->mail->addReplyTo('contact@perrotin.eu', 'Blog');

            //Attachments
            $this->mail->addAttachment('../public/img/avatar.jpg', 'new.jpg');    // Optional name

            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Message du blog';
            $this->mail->Body    = $content;

            $this->mail->send();
            $_SESSION = 'Le message a été envoyé';
            return true;
        }
        catch (Exception $e)
        {
            $_SESSION = "Le Message n'a pas pu être envoyé : ".$this->mail->ErrorInfo;
            return false;
        }
    }
}

