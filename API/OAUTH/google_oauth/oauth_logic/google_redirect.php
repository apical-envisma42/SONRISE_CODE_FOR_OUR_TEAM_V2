<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../core_files/config.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../core_files/session_init.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../core_files/functions.php';

// MAILING LIBRARY CODE
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../site_logic/MAIL_PHP/email_send.php';


$google_client = new Google\Client;
$oauth_provider = "google";

use Google\Service\Oauth2;
use Google\Service\Exception;

// VERIFY OAUTH CSRF TOKEN
check_oauth_state_parameter();

try {
    // IMPORTANT VALIDATION FOR API
    $google_client->setClientId($google_client_ID ?? '');
    $google_client->setClientSecret($google_client_secret ?? '');
    $google_client->setRedirectUri($google_client_URI ?? '');
    $google_client->setAccessType($google_access_type ?? '');
    $google_client->setPrompt($google_set_prompt ?? '');

} catch(Google\Service\Exception $e) {
    $error_code_api    = $e->getCode();
    $error_message_api = $e->getMessage();

    error_log("GOOGLE API FAILURE (" . xss_protect($error_code_api) . "): " . xss_protect($error_message_api));

    $_SESSION['error_title'] = "Service Status";
    $_SESSION['error_msg']   = "We couldn't connect to Google Services. Please try again or use a different login method.";
    header("Location: ../pages/display_error.php");
    exit();
}

        
    check_oauth_given_verfication_code();

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if(isset($token['error'])):
    error_log("Google SDK Error: " . xss_protect($token['error_description']));
    $_SESSION['error_title'] = "Login Status";
    $_SESSION['error_msg']   = "Authentication service temporarily unavailable.";
    header("Location: ../pages/display_error.php");
    exit();
    endif;

    $google_client->setAccessToken($token["access_token"]);

    $access_token  = $token["access_token"];
    $refresh_token = isset($token["refresh_token"]) ? $token["refresh_token"] : null;
    $expires_in    = $token['expires_in'];

    $oauth = new Google\Service\Oauth2($google_client);

    $google_userinfo  = $oauth->userinfo->get();

    $oauth_uid        =     $google_userinfo->id;
    $oauth_email      =     $google_userinfo->email;
    $oauth_familyname =     $google_userinfo->familyName;
    $oauth_givenname  =     $google_userinfo->givenName;
    $oauth_name       =     $google_userinfo->name;
    $oauth_picture    =     $google_userinfo->picture;
    $ip_address       =     $_SERVER['REMOTE_ADDR'];

// CHECKING/INSERTION OF USER DATA
    $sql_find = "SELECT acc_user_level FROM oauth_users WHERE oauth_uid = ?";
    $stmt_find = mysqli_prepare($dbconn, $sql_find);
    mysqli_stmt_bind_param($stmt_find, "s", $oauth_uid);
    mysqli_stmt_execute($stmt_find);
    mysqli_stmt_bind_result($stmt_find, $fetched_user_level);
    mysqli_stmt_store_result($stmt_find);
    $user_exists = mysqli_stmt_num_rows($stmt_find) > 0;

    if($user_exists):
        mysqli_stmt_fetch($stmt_find);
    endif;

    mysqli_stmt_close($stmt_find);


if(!$user_exists) {
    $oauth_insert = "INSERT INTO oauth_users (oauth_provider, oauth_uid, oauth_full_name, oauth_given_name, user_family_name, oauth_email, user_picture, ip_address) 
    VALUES (?,?,?,?,?,?,?,?);";
    $ouath_insert_stmt = mysqli_prepare($dbconn, $oauth_insert);
    mysqli_stmt_bind_param($ouath_insert_stmt, "ssssssss", $oauth_provider, $oauth_uid, $oauth_name, $oauth_givenname, $oauth_familyname, $oauth_email, $oauth_picture, $ip_address);

    if(mysqli_stmt_execute($ouath_insert_stmt)) {
        try {
            sendWelcomeEmail($oauth_email, $oauth_name, $oauth_provider, $ip_address);
        } catch(PHPMAILER\PHPMailer\Exception $e) {
            error_log("WELCOME EMAIL FAILED: ERROR_CODE: " . xss_protect($e->getCode()) . xss_protect($e->getMessage()));
        }
    }
    
    mysqli_stmt_close($ouath_insert_stmt);
    $fetched_user_level = "user";
}

session_regenerate_id(true);

$_SESSION['logged_in']      = true;
$_SESSION['user_email']     = $oauth_email;
$_SESSION['ip_address']     = $ip_address;
$_SESSION['full_name']      = $oauth_name;
$_SESSION['user_picture']   = $oauth_picture;
$_SESSION['oauth_provider'] = $oauth_provider;
$_SESSION['account_level']  = $fetched_user_level;

session_write_close(); 
mysqli_close($dbconn);
header("Location: ../../../../pages/user_pages/profile.php");
exit();

?>