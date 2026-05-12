<?php 

// FOR ALL SECURITY CHECKS LIKE CSRF TOKENS AND MORE


// CSRF TOKENS FUNCTION
function generate_csrf_token($bytes_length) {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes($bytes_length));
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function form_validiate_post_csrf($csrf_post_token, $location_header) {
    if(empty($csrf_post_token) || !validate_csrf_token($csrf_post_token)): 
    header("Location: ../pages/oauth_security_pages/csrf_invalid.php");
    exit();
    endif;
}

//XSS PROTECTION FUNCTION (FOR HTML CODES ONLY)

function xss_protect($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5 | ENT_DISALLOWED, 'UTF-8');
}

// OAUTH STATE FUNCTIONS
function generate_oauth_state() { 
    if(empty($_SESSION['oauth_state'])) {
        $oauth_state = bin2hex(random_bytes(35));
        $_SESSION['oauth_state'] = $oauth_state;
    }
    return $_SESSION['oauth_state'];
}

function check_oauth_state_parameter() {
    static $already_validated = false;
    if($already_validated) return true;
    $get_oauth_state     = $_GET['state'] ?? null;
    $session_oauth_state = $_SESSION['oauth_state'] ?? null;

    if($get_oauth_state === null || $session_oauth_state === null || !hash_equals($session_oauth_state, $get_oauth_state)) {
        unset($_SESSION['oauth_state']);

        $user_ip = $_SERVER['REMOTE_ADDR'];
        error_log("CSRF TOKEN MISMATCH IN OAUTH LOGIN. " . " USER IP ADDRESS: " . xss_protect($user_ip));

        header("Location: ../pages/oauth_security_pages/csrf_invalid.php");
        exit();
    }
    // SECOND ONE HELPS AVOID REPLAY ATTACKS
    unset($_SESSION['oauth_state']);
    $already_validated = true;
    return true;
}

function check_oauth_given_verfication_code() {
    if(!isset($_GET["code"]) || empty($_GET['code'])) {
    error_log("OAuth Attempt Blocked: Missing Auth Code from Google.");
    header("Location: ../index.php?auth_status=failed");
    exit();
    }
}

?>