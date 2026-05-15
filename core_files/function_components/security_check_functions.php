<?php 

// FOR ALL SECURITY CHECKS LIKE CSRF TOKENS AND MORE


// CSRF TOKENS FUNCTION
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
function generate_oauth_state(bool $force_refresh = false): string {
    if (!$force_refresh && !empty($_SESSION['oauth_state']) && is_string($_SESSION['oauth_state'])) {
        return $_SESSION['oauth_state'];
    }

    $raw_bytes   = random_bytes(35);
    $oauth_state = bin2hex($raw_bytes);

    $_SESSION['oauth_state'] = $oauth_state;
    return $oauth_state;
}

function check_oauth_state_parameter(): bool {
    static $already_validated = false;
    if ($already_validated) {
        return true;
    }

    $get_oauth_state     = $_GET['state'] ?? null;
    $session_oauth_state = $_SESSION['oauth_state'] ?? null;

    if ($get_oauth_state === null || $session_oauth_state === null || !hash_equals($session_oauth_state, $get_oauth_state)) {
        
        unset($_SESSION['oauth_state']);

        $user_ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN_IP';
        
        $safe_ip = filter_var($user_ip, FILTER_VALIDATE_IP) ? $user_ip : 'INVALID_IP_FORMAT';
        error_log("SECURITY ALERT: OAuth state parameter mismatch or CSRF attempt intercepted. Originating IP: " . $safe_ip);

        header("Location: ../../pages/security_pages/csrf_invalid.php");
        exit();
    }

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