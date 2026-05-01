<?php require_once __DIR__ . '/config.php';

// $fixmyareaghana_tag = '<span style="color: #004b23;"><strong>FIXMYAREAGHANA</strong></span>';


function generate_csrf_token($bytes_length = 36) {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes($bytes_length));
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function form_validiate_post_csrf($csrf_post_token) {
    if(empty($csrf_post_token) || !validate_csrf_token($csrf_post_token)): 
    header("Location: ../pages/security_pages/csrf_invalid.php");
    exit();
    endif;
}

function check_logged_in() {
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php");
    exit();
}
}


function check_account_level_for_admin() {
if(!isset($_SESSION['account_level']) || $_SESSION['account_level'] === "user") {
    header("Location: profile_sess.php");
    exit();
}
}

function block_admin_button_for_user() {
    global $hide_class;
    if(isset($_SESSION['account_level']) && $_SESSION['account_level'] === "user") {
    $hide_class = "hidden_page"; 
}
}

function checkuserloginsendbacktohome() {
    if(!empty($_SESSION['logged_in'])):
  header("Location: ../../index.php");
  exit();
endif;
}

function check_maintenance_mode() {
    global $APP_MAINTENANCE_MODE;
    if(isset($_GET['maintenance_status']) && $_GET['maintenance_status'] === 'check_maintenance'){
    if($APP_MAINTENANCE_MODE === 'OFF') {
        header("Location: ../../../index.php");
        exit();
    } elseif($APP_MAINTENANCE_MODE === 'ON') {
        header("Location: maintenance_page.php?maintenance_status=active_maintenance");
        exit();
    }
}
}

function check_oauth_state_parameter() {
    $get_oauth_state     = $_GET['state'] ?? null;
    $session_oauth_state = $_SESSION['oauth_state'] ?? null;

    if($get_oauth_state === null || $session_oauth_state === null || !hash_equals($session_oauth_state, $get_oauth_state)) {
        unset($_SESSION['oauth_state']);

        $user_ip = $_SERVER['REMOTE_ADDR'];
        error_log("CSRF TOKEN MISMATCH IN OAUTH LOGIN. " . "USER IP ADDRESS: " . $user_ip);

        header("Location: ../pages/csrf_invalid.php");
        exit();
    }
    // SECOND ONE HELPS AVOID REPLAY ATTACKS
    unset($_SESSION['oauth_state']);
}

function check_oauth_given_verfication_code() {
    if(!isset($_GET["code"]) || empty($_GET['code'])) {
    error_log("OAuth Attempt Blocked: Missing Auth Code from Google.");
    header("Location: ../index.php?auth_status=failed");
    exit();
    }
}

function get_account_colour($acc_Status) {
global $badgeClass;
if($acc_Status == 'active') {
    $badgeClass = "active";
} elseif($acc_Status == 'inactive') {
    $badgeClass = "inactive";
} elseif($acc_Status == 'pending') {
    $badgeClass = "pending";
}
return $badgeClass;
}


function xss_protect($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5 | ENT_DISALLOWED, 'UTF-8');
}



function error_message($error_code_api_func, $dbconnection) {

    $mysqli_error_actual = mysqli_error($dbconnection);
    $mysqli_error_code   = mysqli_errno($dbconnection);

    error_log("OAUTH DB FAILURE (" . xss_protect($mysqli_error_code) . "): " . xss_protect($mysqli_error_actual));

        if($error_code_api_func === 1062) {
        return "This social account is already connected to an existing profile. Please log in using your original method.";
    } elseif($error_code_api_func === 1406) {
        return "We are unable to complete your secure login at this time. Please try again later or contact support.";
    } elseif($error_code_api_func === 1136 || $error_code_api_func === 1366) {
        return "An internal configuration error occurred. Our team has been notified.";
    } elseif($error_code_api_func === 1205) {
        return "The server is currently busy. Please refresh the page to finish signing in.";
    } else {
        die("We are currently experiencing trouble pls try again later.");
    }
}


?>
<?php 

function check_then_insert_user($dbconn) {
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
}

?>