<?php 
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../core_files/config_components/API_CONFIG_COMPONENTS/mail_api_config_components/mail_config.php';
require_once __DIR__ . '/../../core_files/function_components/MAIL_FUNCTIONS/mail_funtions.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 

        function sendWelcomeEmail($recepient_email, $recepient_name, $api_provider, $ip_address) {
            global $my_email_user, $php_mailer_app_password; 
        $mail = new PHPMailer(true);
        connect_to_mail_smtp($mail, $my_email_user, $php_mailer_app_password); 

        try {

            $mail->setFrom($my_email_user, 'SONRISE EMAIL SYSTEM');
            $mail->addAddress($recepient_email, $recepient_name); 
            $mail->addReplyTo($my_email_user, 'SONRISE SUPPORT');

            $mail->isHTML(true);
            $mail->Subject = "SONRISE SIGN IN WITH GOOGLE OAUTH 2.0";
            
            ob_start(); 
            require_once __DIR__ . '/../../pages/email_template_pages/signin_email_page.php'; 
            $mail->Body = ob_get_clean(); // NOTE TO SELF: THIS CAPTURES THE TEMPLATE FOR EMAIL

            $mail->send();
            
        } catch (Exception $e) {
            $mailer_error_msg  = $e->getMessage();
            $mailer_error_code = $e->getCode();
            error_log("PHPMAILER ERROR: (" . $mailer_error_code . "): " . $mailer_error_msg);
        }
        }
?>