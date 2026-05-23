<?php 

// ============================================================================
// FILE ROLE: APPLICATION SECURITY GATEWAY & CRYPTOGRAPHIC VALIDATION LAYER
// ============================================================================
// Purpose: This module serves as a centralized cryptographic security utility
// for the application. It provides runtime protection mechanisms including:
//   1. Cross-Site Request Forgery (CSRF) mitigation for standard HTML forms.
//   2. Cross-Site Scripting (XSS) defensive sanitization for template rendering.
//   3. State token lifecycle management for OAuth 2.0 federated identity flows.
// All string comparisons are strictly performed via side-channel-resistant APIs.
// ============================================================================


// ============================================================================
// SECTION 1: CORE STANDARD FORM CSRF SECURITY UTILITIES
// ============================================================================

/**
 * Generates an encrypted, cryptographically secure pseudo-random token for state validation.
 * Saves the resulting token in the user's session cache if an active string does not exist.
 * * @param int $bytes_length The amount of entropy (bytes) to feed the random number generator.
 * @return string The hex-encoded token string used to seed HTML form fields.
 */


/**
 * GENERATES A CSPRNG FOR FORMS THAT IS SENT TO LOGIC WHENEVER THERE IS INFO SENT
 */
function generate_csrf_token($bytes_length) {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes($bytes_length));
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf_token(mixed $token): bool {
    if (!isset($_SESSION['csrf_token'])) {
        return false;
    }

    
    $user_token = is_string($token) ? $token : '';

    return hash_equals($_SESSION['csrf_token'], $user_token);
}


function form_validate_post_csrf(mixed $csrf_post_token): bool {
    if (empty($csrf_post_token)) {
        return false;
    }
    
    return validate_csrf_token($csrf_post_token);
}

//XSS PROTECTION FUNCTION (FOR HTML CODES ONLY)
function xss_protect($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5 | ENT_DISALLOWED, 'UTF-8');
}

// OAUTH STATE GENERATION
function generate_oauth_state_token($google_client, $bytes_length) {
    $state_token = bin2hex(random_bytes($bytes_length));
    $_SESSION['oauth_token_state'] = $state_token;
    $google_client->setState($state_token);
    return $state_token;
}

function check_oauth_state() {
    $session_state = $_SESSION['oauth_token_state'] ?? null;
    $get_State     = $_GET['state'] ?? null;

    
    if(empty($session_state) || empty($get_State)):
    $_SESSION['error_title'] = "Security Violation";
    $_SESSION['error_msg']   = "Session Expired! Please try again later!";

    header("Location: ../../pages/security_pages/csrf_invalid.php");
    exit();
    endif;

    if(!hash_equals($session_state, $get_State)):
    error_log("USER OAUTH SECURITY BREACH OF STATE MISMATCH." . " IP ADDRESS: " . $_SERVER['REMOTE_ADDR']);
    $_SESSION['error_title'] = "Oauth Security Violation";
    $_SESSION['error_msg']    = "Authentication state mismatch. Unauthorised request detected";
    header("Location: ../../pages/error_pages/display_error.php");
    exit();
    endif;

    unset($_SESSION['oauth_token_state']);
}


function check_oauth_token_error($token) {
    if(is_array($token) && isset($token['error'])):

      error_log("Google SDK Error: " . $token['error_description']);

      $_SESSION['error_title'] = "Login Status";
      $_SESSION['error_msg']   = "Authentication service temporarily unavailable.";

      header("Location: ../../pages/error_pages/display_error.php");
      exit();
    endif;
}

function check_oauth_id_token($token) {
    if(!is_array($token) || !isset($token['id_token'])): 

       $error_description = $token['error_description'] ?? 'None Provided';

       error_log("GOOGLE ID TOKEN NOT SET. IP ADDRESS: " . $_SERVER['REMOTE_ADDR'] . " ERROR_MSG: " . $error_description);

       $_SESSION['error_title'] = "Login Failure";
       $_SESSION['error_msg']   = "Invalid data recieved.";

    header("Location: ../../../../pages/error_pages/display_error.php");
    exit();
    endif;
}

function verify_id_token($payload, $token) {
    if (!is_array($payload) || !$payload) {

        $error_description = isset($token['error_description']) ? $token['error_description'] : 'Cryptographic Verification Failed';

        error_log("Oauth Payload ERROR: " . $error_description);
        
        $_SESSION['error_title'] = "Login Failure";
        $_SESSION['error_msg']   = "Invalid data received.";
        
        header("Location: ../../../../pages/error_pages/display_error.php");
        exit();
    }
}

function check_oauth_given_verfication_code() {
    if(!isset($_GET["code"]) || empty($_GET['code'])) {
    error_log("OAuth Attempt Blocked: Missing Auth Code from Google." . " IP ADDRESS: " . $_SERVER['REMOTE_ADDR']);
    require_once __DIR__ . '//check_important_roles_functions.php';
    header("Location: " . BASE_URL . "index.php?auth_status=failed");
    exit();
    }
}

function sync_oauth_user_identity($dbconn, $oauth_uid, $oauth_email, $oauth_name, $oauth_givenname, $oauth_familyname, $oauth_picture, $ip_address, $oauth_provider = "google") {
    
    $sql_find = "SELECT acc_user_level, created_at FROM oauth_users WHERE oauth_uid = ?";
    $stmt_find = mysqli_prepare($dbconn, $sql_find);
    mysqli_stmt_bind_param($stmt_find, "s", $oauth_uid);
    mysqli_stmt_execute($stmt_find);
    mysqli_stmt_bind_result($stmt_find, $fetched_user_level, $account_creation);
    mysqli_stmt_store_result($stmt_find);
    $user_exists = mysqli_stmt_num_rows($stmt_find) > 0;

    if ($user_exists) {
        mysqli_stmt_fetch($stmt_find);
    }
    mysqli_stmt_close($stmt_find);

    if (!$user_exists) {
        $oauth_insert = "INSERT INTO oauth_users (oauth_provider, oauth_uid, oauth_full_name, oauth_given_name, user_family_name, oauth_email, user_picture, ip_address) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $oauth_insert_stmt = mysqli_prepare($dbconn, $oauth_insert);
        mysqli_stmt_bind_param($oauth_insert_stmt, "ssssssss", $oauth_provider, $oauth_uid, $oauth_name, $oauth_givenname, $oauth_familyname, $oauth_email, $oauth_picture, $ip_address);

        if (mysqli_stmt_execute($oauth_insert_stmt)) {
            try {
                sendWelcomeEmail($oauth_email, $oauth_name, $oauth_provider, $ip_address);
            } catch (PHPMAILER\PHPMailer\Exception $e) {
                // Using standard, simple error_log syntax as requested
                error_log("WELCOME EMAIL FAILED: ERROR_CODE: " . $e->getCode() . " " . $e->getMessage());
            }
        }
        mysqli_stmt_close($oauth_insert_stmt);
        
        $fetched_user_level = "user";
        $account_creation   = date("Y-m-d H:i:s");
    }

    return [
        'account_level'    => $fetched_user_level,
        'account_creation' => $account_creation
    ];
}
?>