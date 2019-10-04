<?php

  require PLUGIN_PATH_BM.'/vendor/autoload.php';
  use PHPMailer\PHPMailer\PHPMailer;
        
  class Emailer{
  
      public static function send_email($to_email, $subject, $message,$newpass){
                        
        $mail = new PHPMailer(true);

        try {
    //Server settings
         $mail->SMTPDebug = 0;                                       // Enable verbose debug output
         $mail->isSMTP();                                            // Set mailer to use SMTP
         $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
         $mail->Username   = 'neharika0111@gmail.com';                     // SMTP username
         $mail->Password   = 'Neha@012';                               // SMTP password
         $mail->SMTPSecure = 'tls'; 
         $mail->IsHTML(true);                                 // Enable TLS encryption, `ssl` also accepted
         $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
         $mail->setFrom('from@example.com', 'Mailer');
         $mail->addAddress($to_email);      // Add a recipient
         //$mail->addAddress('ellen@example.com');               // Name is optional
         //$mail->addReplyTo('info@example.com', 'Information');
         //$mail->addCC('cc@example.com');
         //$mail->addBCC('bcc@example.com');

    // Content
         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject = subject;
         $mail->Body    = $message.$newpass;
         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

         if(!$mail->send()){
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            return false;
        }
        return true;
        
        }catch (Exception $e) { 
          return false;
        }
       }
       
    
  }

 ?>
