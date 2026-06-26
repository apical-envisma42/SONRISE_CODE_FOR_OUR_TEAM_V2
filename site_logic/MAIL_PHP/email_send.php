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
            global $my_email_user, $php_mailer_app_password; 

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

        /**
 * Sends a notification email when a poem is approved and published live.
 */
function sendPoemApprovedEmail($to_email, $author_name, $poem_title, $poem_slug) {
                global $my_email_user, $php_mailer_app_password; 

    // Bring in your SMTP constants defined inside config files
    $email_user = $my_email_user;
    $mail_app_password = $php_mailer_app_password;

    $mail = new PHPMailer(true);

    try {
        connect_to_mail_smtp($mail, $email_user, $mail_app_password);

        // Recipients
        $mail->setFrom($email_user, 'SonRise Editorial');
        $mail->addAddress($to_email, $author_name);

        // Content Extraction
        ob_start();
        include __DIR__ . '/../../pages/email_template_pages/approved_poems.php';
        $email_body = ob_get_clean();

        $mail->isHTML(true);
        $mail->Subject = "Your Poem has been Approved & Published Live! 🎉";
        $mail->Body    = $email_body;
        $mail->AltBody = "Greetings {$author_name}, your poem '{$poem_title}' has passed moderation and is live on SonRise! View it here: " . BASE_URL . "/poems/" . $poem_slug;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("POEM APPROVAL EMAIL FAILED: ERROR_CODE: " . xss_protect($e->getCode()) . " " . xss_protect($e->getMessage()));
        return false;
    }
}

/**
 * Sends a notification email when a poem submission is rejected.
 */
function sendPoemRejectedEmail($to_email, $author_name, $poem_title) {
    global $my_email_user, $php_mailer_app_password; 

    $email_user = $my_email_user;
    $mail_app_password = $php_mailer_app_password;

    $mail = new PHPMailer(true);

    try {
        connect_to_mail_smtp($mail, $email_user, $mail_app_password);

        // Recipients
        $mail->setFrom($email_user, 'SonRise Editorial');
        $mail->addAddress($to_email, $author_name);

        // Content Extraction
        ob_start();
        include __DIR__ . '/../../pages/email_template_pages/rejected_poems.php';
        $email_body = ob_get_clean();

        $mail->isHTML(true);
        $mail->Subject = "SonRise Submission Status Update";
        $mail->Body    = $email_body;
        $mail->AltBody = "Hello {$author_name}, thank you for submitting '{$poem_title}'. Regrettably, we are unable to publish your piece on our main feeds at this time.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("POEM REJECTION EMAIL FAILED: ERROR_CODE: " . xss_protect($e->getCode()) . " " . xss_protect($e->getMessage()));
        return false;
    }
}
?>