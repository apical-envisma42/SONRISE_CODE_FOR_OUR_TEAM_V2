<?php
require_once __DIR__ . '/../../../../core_files/config.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../core_files/session_init.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../core_files/functions.php';
include_once __DIR__ . '/../../../../core_files/config_components/API_CONFIG_COMPONENTS/google_api_config.php';

// Ensure the security utility functions are explicitly included
// (Adjust this path if security_check_functions.php is located elsewhere)
require_once __DIR__ . '/../../../../core_files/function_components/security_check_functions.php';

// MAILING LIBRARY CODE
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../site_logic/MAIL_PHP/email_send.php';

global $dbconn;

$google_client = new Google\Client();
$oauth_provider = "google";


$google_client->setClientId($google_client_ID);
$google_client->setClientSecret($google_client_secret);
$google_client->setRedirectUri($google_client_secret);

use Google\Service\Oauth2;
use Google\Service\Exception;

try {
    if (!isset($_GET['state']) || !isset($_GET['code'])) {
        error_log("OAuth callback triggered missing mandatory GET parameters. State present: " . (isset($_GET['state']) ? 'Yes' : 'No') . ", Code present: " . (isset($_GET['code']) ? 'Yes' : 'No'));
        header("Location: " . BASE_URL . "index.php?auth_status=missing_params");
        exit();
    }

    check_oauth_state();  
    check_oauth_given_verfication_code();

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    check_oauth_token_error($token);
    check_oauth_id_token($token);

    $google_client->setAccessToken($token);
    $payload_verify_id = $google_client->verifyIdToken($token["id_token"]);

    verify_id_token($payload_verify_id, $token);

    // Extraction
    $access_token     = $token["access_token"];
    $expires_in       = $token['expires_in'];
    $oauth_uid        = $payload_verify_id['sub'];
    $oauth_email      = $payload_verify_id['email'] ?? null;
    $oauth_name       = $payload_verify_id['name'] ?? null;
    $oauth_givenname  = $payload_verify_id['given_name'] ?? null;
    $oauth_familyname = $payload_verify_id['family_name'] ?? null;
    $oauth_picture    = $payload_verify_id['picture'] ?? null;
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

    if (session_status() === PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }

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
    
    header("Location: " . BASE_URL . "pages/HTML/poems.php");
    exit();

} catch (Exception $e) {
    error_log("Google API SDK Exception: " . $e->getMessage());
    $_SESSION['error_title'] = "Authentication Error";
    $_SESSION['error_msg']   = "An error occurred during communication with Google services.";
    header("Location: " . BASE_URL . "pages/error_pages/display_error.php");
    exit();
} catch (\Exception $e) {
    error_log("General Runtime Exception during OAuth process: " . $e->getMessage());
    header("Location: " . BASE_URL . "pages/error_pages/display_error.php");
    exit();
}