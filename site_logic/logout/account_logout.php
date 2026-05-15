<?php require_once __DIR__ . '/../../core_files/functions.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['account_logout'])) {
    
if (!form_validate_post_csrf($_POST['csrf_token'] ?? null)) {
        header("Location: ../../pages/security_pages/csrf_invalid.php"); //
        exit(); 
    }

    $_SESSION = [];
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(), 
            '', 
            time() - 42000, 
            $params["path"], 
            $params["domain"],
            $params["secure"], 
            $params["httponly"]
        );
    }

    session_destroy();

    header("Location: ../../index.php");
    exit();
}