<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 

        function sendWelcomeEmail($recepient_email, $recepient_name, $api_provider, $ip_address) { 
            global $php_mailer_app_password;
            global $my_email_user;
        $mail = new PHPMailer(true);


        try {
            
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = $my_email_user;
            $mail->Password   = $php_mailer_app_password;   
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom($my_email_user, 'Jay Agbaga');
            $mail->addAddress($recepient_email, $recepient_name); 
            $mail->addReplyTo($my_email_user, 'Support');

            $mail->isHTML(true);
            $mail->Subject = "SONRISE SIGN IN WITH GOOGLE OAUTH 2.0";
            
            ob_start(); 
            require_once __DIR__ . '/welcome_email.php'; 
            $mail->Body = ob_get_clean(); // NOTE TO SELF: THIS CAPTURES THE TEMPLATE FOR EMAIL

            $mail->send();
            
        } catch (Exception $e) {
            $mailer_error_msg  = $e->getMessage();
            $mailer_error_code = $e->getCode();
            error_log("PHPMAILER ERROR: (" . xss_protect($mailer_error_code) . "): " . xss_protect($mailer_error_msg));
        }
        }
?>