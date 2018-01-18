<?php

session_start();

use App\RouterController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;   

require "vendor/autoload.php";

define('__ROOT__', __DIR__); 


// require './vendor/phpmailer/phpmailer/src/Exception.php';
// require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require './vendor/phpmailer/phpmailer/src/SMTP.php';

$router = new RouterController($_GET['url']); // création d'un routeur
 
$router->get('/', "\AuthenticationController::indexAction");
$router->post('/', "\AuthenticationController::indexPostAction");
$router->get('/logout', "\AuthenticationController::logoutAction");
$router->get('/admin', "\AdminController::indexAction");
$router->post('/admin', "\AdminController::validerPostsAction");
$router->get('/admin/nursings', "\AdminController::nursingsAction");
$router->post('/admin/nursings', "\AdminController::nursingsPostsAction");
$router->get('/admin/tasks', "\AdminController::tasksAction");
$router->post('/admin/tasks', "\AdminController::tasksPostsAction");
$router->get('/admin/reset', "\AdminController::resetAction");
$router->post('/admin/reset', "\AdminController::resetPostsAction");
$router->get('/admin/tasksNotDid', "\AdminController::didAction");

$router->run();

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    
    //Server settings
    $mail->SMTPDebug = 3;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp-mail.outlook.com';     
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;    

    $mail->SMTPAuth = true;                                  // Enable SMTP authentication
    $mail->Username = 'nursing95@outlook.fr';                 // SMTP username
    $mail->Password = 'momo123456';                // SMTP password
    
    $mail->setFrom('nursing95@outlook.fr', 'Mailer');
    $mail->addAddress('mossab.kaimouni.75@gmail.com');               // Name is optional

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}