<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!check_logged_in() || !is_admin()) {
    header("Location: " . BASE_URL . "/pages/HTML/poems.php?error=unauthorized");
    exit();
}

global $dbconn;

if ($dbconn && !empty($_SESSION['user_email'])) {
    $stmt = mysqli_prepare($dbconn, "SELECT acc_user_level, account_status FROM oauth_users WHERE oauth_email = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['user_email']);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($res);
        mysqli_stmt_close($stmt);

        if (!$user || strtolower($user['acc_user_level']) !== 'admin' || strtolower($user['account_status']) !== 'active') {
            $_SESSION['account_level'] = $user['acc_user_level'] ?? 'user';

            header("Location: " . BASE_URL . "/pages/HTML/poems.php?error=access_denied");
            exit();
        }
    }
}
?>