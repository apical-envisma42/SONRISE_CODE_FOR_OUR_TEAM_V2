<?php require_once __DIR__ . '/../../../core_files/config.php';
require_once __DIR__ . '/../../../core_files/functions.php';
global $dbconn;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['user_acc_level'] !== "admin") {
        header("Location: ../../../pages/user_pages/profile.php?user_deny_admin_status=denied_from_admin");
    }

    form_validate_post_csrf($_POST['csrf_token']);
    if(isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $sql = "DELETE FROM oauth_users WHERE id = ?";
        $stmt = mysqli_prepare($dbconn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        if(mysqli_stmt_execute($stmt)) {
            header("Location: ../../pages/all_users.php?user_delete_status=success");
        } else {
            error_log("USER DELETION ERROR IN MANAGE_USERS.PHP. ERROR CODE:" . mysqli_errno($dbconn) . "ERROR MESSAGE: " . mysqli_error($dbconn));
        }
    }
}
?>