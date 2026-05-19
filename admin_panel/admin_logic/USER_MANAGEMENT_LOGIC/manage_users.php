<?php require_once __DIR__ . '/../../../core_files/config.php';
global $dbconn;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
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