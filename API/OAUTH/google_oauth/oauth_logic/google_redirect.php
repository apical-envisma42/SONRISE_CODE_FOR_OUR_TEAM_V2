<?php
require_once __DIR__ . '/../../../../core_files/config.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../core_files/session_init.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../core_files/functions.php';

// MAILING LIBRARY CODE
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../site_logic/MAIL_PHP/email_send.php';

global $dbconn;

$google_client = new Google\Client;
$oauth_provider = "google";

use Google\Service\Oauth2;
use Google\Service\Exception;

// VERIFY OAUTH CSRF TOKEN
    check_oauth_state();  
    check_oauth_given_verfication_code();

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    check_oauth_token_error($token);
    check_oauth_id_token($token);

    $google_client->setAccessToken($token);
    $payload_verify_id = $google_client->verifyIdToken($token["id_token"]);

    verify_id_token($payload_verify_id, $token);

$access_token     = $token["access_token"];
$expires_in       = $token['expires_in'];
$oauth_uid        = $payload_verify_id['sub'];
$oauth_email      = isset($payload_verify_id['email']) ? $payload_verify_id['email'] : null;
$oauth_name       = isset($payload_verify_id['name']) ? $payload_verify_id['name'] : null;
$oauth_givenname  = isset($payload_verify_id['given_name']) ? $payload_verify_id['given_name'] : null;
$oauth_familyname = isset($payload_verify_id['family_name']) ? $payload_verify_id['family_name'] : null;
$oauth_picture    = isset($payload_verify_id['picture']) ? $payload_verify_id['picture'] : null;
$ip_address       = $_SERVER['REMOTE_ADDR'];
    

$user_profile_data = sync_oauth_user_identity(
 $dbconn,
 $oauth_uid,
 $oauth_email,
 $oauth_name,
 $oauth_givenname,
 $oauth_familyname,
 $oauth_picture,
 $ip_address,
 $oauth_provider
);

session_regenerate_id(true);

$_SESSION['logged_in']        = true;
$_SESSION['user_email']       = $oauth_email;
$_SESSION['ip_address']       = $ip_address;
$_SESSION['full_name']        = $oauth_name;
$_SESSION['user_picture']     = $oauth_picture;
$_SESSION['oauth_provider']   = $oauth_provider;
$_SESSION['account_level']    = $user_profile_data['account_level'];
$_SESSION['account_creation'] = $user_profile_data['account_creation'];

session_write_close(); 
mysqli_close($dbconn);
header("Location: " . BASE_URL .  "/pages/HTML/poems.php");
exit();

?>