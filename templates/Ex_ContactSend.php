<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 16/11/2018
 * Time: 20:28
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try
{
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'SSL0.OVH.NET';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contact@perrotin.eu';                 // SMTP username
    $mail->Password = 'Mecani4306';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('contact@perrotin.eu', 'Mailer');
    $mail->addAddress($_POST['mail'],$_POST['nom']);     // Add a recipient
    $mail->addReplyTo('contact@perrotin.eu', 'Mailer');
//    $mail->addCC('');
//    $mail->addBCC('');

    //Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('../public/img/avatar.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Message du blog';
    $mail->Body    = $_POST['content'];

    $mail->send();
    echo 'Le message a été envoyé';
}
catch (Exception $e)
    {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }