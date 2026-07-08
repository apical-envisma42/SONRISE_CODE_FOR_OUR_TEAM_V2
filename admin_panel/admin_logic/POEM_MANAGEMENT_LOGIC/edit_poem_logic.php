<?php
require_once __DIR__ . '/../../../core_files/init_core_files.php';
require_once __DIR__ . '/../../components/defined_code_admin.php';

// 1. Strict Request Method Guard Checking
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASE_URL_ADMIN . "/pages/review_poem.php");
    exit();
}

// 2. Authentication and Administrative Role Validation Guard
if (!check_logged_in() || !isset($_SESSION['account_level']) || $_SESSION['account_level'] !== 'admin') {
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=unauthorized_access");
    exit();
}

if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=csrf_invalid");
    exit();
}

global $dbconn;

$poem_id        = intval($_POST['poem_id'] ?? 0);
$poem_title     = trim($_POST['poem_title'] ?? '');
$selected_genre = trim($_POST['poem_genre'] ?? '');
$poem_content   = trim($_POST['poem_content'] ?? '');

if ($poem_id <= 0 || empty($poem_title) || empty($selected_genre) || empty($poem_content)) {
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=invalid_parameters");
    exit();
}

$final_genre = '';
if ($selected_genre === 'OTHER_CUSTOM') {
    $custom_input = isset($_POST['custom_genre']) ? trim($_POST['custom_genre']) : '';
    if (empty($custom_input)) {
        die("Validation Failure: Custom category value missing parameters field entry validation mapping line.");
    }
    $final_genre = ucwords(strtolower($custom_input));
} else {
    $final_genre = $selected_genre;
}

if (mb_strlen($final_genre) > 50) {
    die("Validation Error: Please keep the custom category tracking label sequence inside the 50 characters threshold restriction limits.");
}

// 6. Generate fresh URL slugs matching structural string specifications
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $poem_title), '-')) . '-' . bin2hex(random_bytes(4));

// 7. Define Unified Absolute Paths Based on Folder Infrastructure Mapping Matrix
$root_directory   = realpath(__DIR__ . '/../../../'); // Lands inside /sonrise/ root
$upload_subfolder = '/uploads/poem_uploaded_images/'; 
$upload_directory = $root_directory . $upload_subfolder; // Full path to target asset directory

$image_destination_path = null;

// Determine if a new file payload was passed through multipart requests channel arrays 
if (isset($_FILES['poem_image']) && $_FILES['poem_image']['error'] === UPLOAD_ERR_OK) {
    $file_tmp_path = $_FILES['poem_image']['tmp_name'];
    
    if ($_FILES['poem_image']['size'] > 5 * 1024 * 1024) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=file_oversized");
        exit();
    }
    
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($file_tmp_path);
    if (!in_array($mime_type, ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=invalid_mime");
        exit();
    }
    
    $image_data = file_get_contents($file_tmp_path);
    $source_image = @imagecreatefromstring($image_data);
    if (!$source_image) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=image_corrupted");
        exit();
    }
    
    // --- FIXED OLD IMAGE UNLINK PROCESSOR ---
    $old_img_stmt = mysqli_prepare($dbconn, "SELECT poem_image FROM poems WHERE id = ?");
    if ($old_img_stmt) {
        mysqli_stmt_bind_param($old_img_stmt, "i", $poem_id);
        mysqli_stmt_execute($old_img_stmt);
        $res = mysqli_stmt_get_result($old_img_stmt);
        if ($row = mysqli_fetch_assoc($res)) {
            $old_filename = $row['poem_image'];
            if (!empty($old_filename)) {
                // Point directly inside the proper subfolder where assets are housed
                $absolute_old_target = $upload_directory . $old_filename;
                if (file_exists($absolute_old_target) && is_file($absolute_old_target)) {
                    @unlink($absolute_old_target);
                }
            }
        }
        mysqli_stmt_close($old_img_stmt);
    }
    
    // Ensure the target upload structure directory is built safely
    if (!is_dir($upload_directory)) {
        mkdir($upload_directory, 0755, true);
    }
    
    $cleaned_filename = bin2hex(random_bytes(32)) . '.webp';
    $final_absolute_path = $upload_directory . $cleaned_filename; // Properly appends filename within subfolder bound rules
    
    imagealphablending($source_image, false);
    imagesavealpha($source_image, true);
    $save_success = imagewebp($source_image, $final_absolute_path, 80);
    imagedestroy($source_image);
    
    if (!$save_success) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=save_failed");
        exit();
    }
    
    $image_destination_path = $cleaned_filename;
}

// 8. Execute Database Engine Entity Signature Mapping Updates
if ($image_destination_path !== null) {
    // Structural update containing explicit graphic data modification row
    $update_query = "UPDATE poems SET poem_title = ?, poem_slug = ?, poem_genre = ?, poem_content = ?, poem_image = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($dbconn, $update_query);
    if ($update_stmt) {
        mysqli_stmt_bind_param($update_stmt, "sssssi", $poem_title, $slug, $final_genre, $poem_content, $image_destination_path, $poem_id);
    }
} else {
    // Structural update preserving existing media asset paths
    $update_query = "UPDATE poems SET poem_title = ?, poem_slug = ?, poem_genre = ?, poem_content = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($dbconn, $update_query);
    if ($update_stmt) {
        mysqli_stmt_bind_param($update_stmt, "ssssi", $poem_title, $slug, $final_genre, $poem_content, $poem_id);
    }
}

if ($update_stmt && mysqli_stmt_execute($update_stmt)) {
    mysqli_stmt_close($update_stmt);
    header("Location: " . BASE_URL_ADMIN . "/pages/review_poem.php?status=edit_success");
    exit();
} else {
    if ($update_stmt) { mysqli_stmt_close($update_stmt); }
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php?msg=execution_failed");
    exit();
}