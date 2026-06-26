<?php
// Enable runtime error diagnostics to catch any hidden issues instantly
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../core_files/init_core_files.php';
require_once __DIR__ . '/../components/defined_code_admin.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Guard Request Method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Routing Error: This controller exclusively responds to HTTP POST transmission methods.");
}

// 2. Authentication Guard
if (!check_logged_in()) {
    die("Security Rejection: Session authentication verification failed. Please sign in again.");
}

// 3. CSRF Verification
if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die("Security Validation Failed: Cryptographic CSRF mismatch. Please refresh the library workspace and try again.");
}

global $dbconn;

// 4. Sanitize Incoming Parameters
$poem_id = isset($_POST['poem_id']) ? intval($_POST['poem_id']) : 0;
$moderation_action = isset($_POST['moderation_action']) ? trim($_POST['moderation_action']) : '';

if ($poem_id <= 0 || $moderation_action !== 'reject') {
    die("Validation Error: Invalid parameters submitted.");
}

// 5. Look up Author and Image from DB to match your schema
$poem_author = '';
$image_path = '';

$auth_stmt = mysqli_prepare($dbconn, "SELECT poem_author, poem_image FROM poems WHERE id = ?");
if ($auth_stmt) {
    mysqli_stmt_bind_param($auth_stmt, "i", $poem_id);
    mysqli_stmt_execute($auth_stmt);
    $auth_res = mysqli_stmt_get_result($auth_stmt);
    if ($row = mysqli_fetch_assoc($auth_res)) {
        $poem_author = $row['poem_author'];
        $image_path  = $row['poem_image'];
    }
    mysqli_stmt_close($auth_stmt);
} else {
    die("Database Processing Error: Failed to prepare data lookup statement.");
}

if (empty($poem_author)) {
    die("Data Lookup Failure: Target poem record index #{$poem_id} does not exist.");
}

$current_session_user = $_SESSION['user_name'] ?? '';
$current_account_level = $_SESSION['account_level'] ?? 'user';

// Flexible Security Check: Case-insensitive trim comparison to prevent space mismatches
$is_author = (strcasecmp(trim($current_session_user), trim($poem_author)) === 0);
$is_admin  = ($current_account_level === 'admin');

if (!$is_admin && !$is_author) {
    die("Access Forbidden: You do not own this record. Poem Author: '{$poem_author}', Your Session Identity: '{$current_session_user}'.");
}

// 6. Clean Up Associated Disk Assets (Unlink Uploaded Cover Image)
if (!empty($image_path)) {
    // Looks for the asset folder relative to this file's position
    $absolute_image_target = realpath(__DIR__ . '/../../../assets/poem_uploaded_images/' . $image_path);
    
    // Safely check and delete the file if it exists, without halting if it doesn't
    if ($absolute_image_target && file_exists($absolute_image_target) && is_file($absolute_image_target)) {
        @unlink($absolute_image_target);
    }
}

// 7. Execute Database Record Deletion
$del_stmt = mysqli_prepare($dbconn, "DELETE FROM poems WHERE id = ?");
if (!$del_stmt) {
    die("Database Transaction Error: Prepared statement generation failed for deletion script.");
}

mysqli_stmt_bind_param($del_stmt, "i", $poem_id);
$execution_success = mysqli_stmt_execute($del_stmt);
mysqli_stmt_close($del_stmt);

// 8. Redirect Back with Success Flag
if ($execution_success) {
    $redirect_url = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : BASE_URL_ADMIN . "/pages/my_poems.php";
    $clean_redirect = strtok($redirect_url, '?'); // Strip out old query strings
    
    header("Location: " . $clean_redirect . "?status=delete_success");
    exit();
} else {
    die("Critical SQL Execution Error: Database rejected row deletion instructions.");
}