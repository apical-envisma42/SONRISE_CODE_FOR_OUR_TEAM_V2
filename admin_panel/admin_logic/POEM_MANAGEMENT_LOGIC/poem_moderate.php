<?php
require_once __DIR__ . '/../../../core_files/init_core_files.php';
require_once __DIR__ . '/../../components/defined_code_admin.php';
// Include your mailing file where sendPoemApprovedEmail and sendPoemRejectedEmail are defined
require_once __DIR__ . '/../../../site_logic/MAIL_PHP/email_send.php'; 

// 1. Strict Request Method Guard
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASE_URL_ADMIN . "/pages/review_poem.php");
    exit();
}

// 2. Authentication and Administrative Role Validation Guard
if (!check_logged_in() || !isset($_SESSION['account_level']) || $_SESSION['account_level'] !== 'admin') {
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=unauthorized_access");
    exit();
}

// 3. Cryptographic CSRF Token Alignment Check
if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=csrf_invalid");
    exit();
}

global $dbconn;

// 4. Sanitize and Extract Request Parameters
$poem_id = intval($_POST['poem_id'] ?? 0);
$moderation_action = trim($_POST['moderation_action'] ?? '');

if ($poem_id <= 0 || !in_array($moderation_action, ['approve', 'reject'])) {
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=invalid_parameters");
    exit();
}

// =========================================================================
// CRITICAL STEP: Fetch Author & Poem Metadata BEFORE modifying the record
// =========================================================================
$author_email = '';
$author_name = '';
$poem_title = '';
$poem_slug = '';

$meta_stmt = mysqli_prepare($dbconn, "SELECT poem_title, poem_slug, poem_author, author_email FROM poems WHERE id = ?");
if ($meta_stmt) {
    mysqli_stmt_bind_param($meta_stmt, "i", $poem_id);
    mysqli_stmt_execute($meta_stmt);
    $meta_res = mysqli_stmt_get_result($meta_stmt);
    if ($meta_row = mysqli_fetch_assoc($meta_res)) {
        $poem_title   = $meta_row['poem_title'];
        $poem_slug    = $meta_row['poem_slug'];
        $author_name  = $meta_row['poem_author'];
        $author_email = $meta_row['author_email']; // Assumes your schema uses 'author_email'
    }
    mysqli_stmt_close($meta_stmt);
}

// Fallback to avoid breaking email processing variables if email field is null
if (empty($author_email)) {
    error_log("MODERATION WARNING: Target email not found for poem ID " . $poem_id);
}

// =========================================================================
// ACTION: APPROVE & PUBLISH LIVE
// =========================================================================
if ($moderation_action === 'approve') {
    $stmt = mysqli_prepare($dbconn, "UPDATE poems SET is_published = 1 WHERE id = ?");
    if (!$stmt) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=db_prepare_failed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "i", $poem_id);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($success) {
        // Safe Email Delivery Try-Catch Matrix
        if (!empty($author_email)) {
            try {
                sendPoemApprovedEmail($author_email, $author_name, $poem_title, $poem_slug);
            } catch (Exception $e) {
                error_log("MAIL EXCEPTION: Approved notification failed. Msg: " . xss_protect($e->getMessage()));
            }
        }
        
        header("Location: " . BASE_URL_ADMIN . "/pages/review_poem.php?status=approved_success");
        exit();
    } else {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=execution_failed");
        exit();
    }

// =========================================================================
// ACTION: REJECT & DESTRUCT RECORD
// =========================================================================
} else if ($moderation_action === 'reject') {
    
    $img_stmt = mysqli_prepare($dbconn, "SELECT poem_image FROM poems WHERE id = ?");
    if ($img_stmt) {
        mysqli_stmt_bind_param($img_stmt, "i", $poem_id);
        mysqli_stmt_execute($img_stmt);
        $res = mysqli_stmt_get_result($img_stmt);
        
        if ($row = mysqli_fetch_assoc($res)) {
            $image_path = $row['poem_image'];

            if (!empty($image_path)) {
                $absolute_target = realpath(__DIR__ . '/../../../' . $image_path);
                
                // Confirm asset file truly rests on disk and is completely safe to clean up
                if ($absolute_target && file_exists($absolute_target) && is_file($absolute_target)) {
                    // Mute with @ to prevent path leaking if access permissions shift
                    @unlink($absolute_target);
                }
            }
        }
        mysqli_stmt_close($img_stmt);
    }

    // Step B: Atomically drop the database entity signature 
    $del_stmt = mysqli_prepare($dbconn, "DELETE FROM poems WHERE id = ?");
    if (!$del_stmt) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=db_prepare_failed");
        exit();
    }
    
    mysqli_stmt_bind_param($del_stmt, "i", $poem_id);
    $success = mysqli_stmt_execute($del_stmt);
    mysqli_stmt_close($del_stmt);

    if ($success) {
        // Safe Email Delivery Try-Catch Matrix
        if (!empty($author_email)) {
            try {
                sendPoemRejectedEmail($author_email, $author_name, $poem_title);
            } catch (Exception $e) {
                error_log("MAIL EXCEPTION: Rejection notification failed. Msg: " . xss_protect($e->getMessage()));
            }
        }

        header("Location: " . BASE_URL_ADMIN . "/pages/review_poem.php?status=reject_success");
        exit();
    } else {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=execution_failed");
        exit();
    }
}