<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;   

class EmailController {
    
    static function sendCode($mailTo, $code)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp-mail.outlook.com';     
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;    
        
            $mail->SMTPAuth = true;                                  // Enable SMTP authentication
            $mail->Username = 'nursing95@outlook.fr';                 // SMTP username
            $mail->Password = 'momo123456';                // SMTP password
            
            $mail->setFrom('nursing95@outlook.fr', 'Nursing Mailer');
            $mail->addAddress($mailTo);               // Name is optional
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Création d\'un compte aide soignante';
            $mail->Body    = "Votre code d'accès est <b>" . $code ."</b>";
            $mail->AltBody    = "Votre code d'accès est <b>" . $code ."</b>";
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }   
    }

    static function generateCode(): string {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $code = '';
        for ($i = 0; $i < 5; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }
        return $code;
    }

}