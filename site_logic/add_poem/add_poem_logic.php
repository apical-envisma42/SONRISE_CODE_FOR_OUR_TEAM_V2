<?php
require_once __DIR__ . '/../../core_files/init_core_files.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASE_URL . "/pages/HTML/poems.php");
    exit();
}

if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php");
    exit();
}

global $dbconn;

$poem_title = trim($_POST['poem_title'] ?? '');
$poem_genre = trim($_POST['poem_genre'] ?? '');
$poem_content = trim($_POST['poem_content'] ?? '');
$poem_author = $_SESSION['full_name'] ?? 'Anonymous';
$author_email = $_SESSION['user_email'] ?? 'Anonymous';

if (empty($poem_title) || empty($poem_genre) || empty($poem_content)) {
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php");
    exit();
}

$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $poem_title), '-')) . '-' . bin2hex(random_bytes(4));
$image_destination_path = null;

if (isset($_FILES['poem_image']) && $_FILES['poem_image']['error'] === UPLOAD_ERR_OK) {
    
    $file_tmp_path = $_FILES['poem_image']['tmp_name'];
    
    if ($_FILES['poem_image']['size'] > 5 * 1024 * 1024) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php");
        exit();
    }
    
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($file_tmp_path);
    
    if (!in_array($mime_type, ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php");
        exit();
    }
    
    $image_data = file_get_contents($file_tmp_path);
    $source_image = @imagecreatefromstring($image_data);
    
    if (!$source_image) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php");
        exit();
    }
    
    $upload_directory = __DIR__ . '/../../uploads/poem_images/';
    if (!is_dir($upload_directory)) {
        mkdir($upload_directory, 0755, true);
    }
    
    $cleaned_filename = bin2hex(random_bytes(32)) . '.webp';
    $final_absolute_path = $upload_directory . $cleaned_filename;
    
    imagealphablending($source_image, false);
    imagesavealpha($source_image, true);
    $save_success = imagewebp($source_image, $final_absolute_path, 80);
    imagedestroy($source_image);
    
    if (!$save_success) {
        header("Location: " . BASE_URL . "/pages/error_pages/display_error.php");
        exit();
    }
    
    $image_destination_path = 'uploads/poem_images/' . $cleaned_filename;
}

$insert_statement = mysqli_prepare(
    $dbconn, 
    "INSERT INTO poems (poem_title, poem_slug, poem_author, poem_genre, poem_content, poem_image, author_email, is_published, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, 0, NOW())"
);

if (!$insert_statement) {
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php");
    exit();
}

mysqli_stmt_bind_param(
    $insert_statement, 
    "sssssss", 
    $poem_title, 
    $slug, 
    $poem_author, 
    $poem_genre, 
    $poem_content, 
    $image_destination_path,
    $author_email
);

if (mysqli_stmt_execute($insert_statement)) {
    mysqli_stmt_close($insert_statement);
    $_SESSION['POEMS_ADDED']++;
    header("Location: " . BASE_URL . "/pages/HTML/poems.php?status=submitted_for_review");
    exit();
} else {
    mysqli_stmt_close($insert_statement);
    header("Location: " . BASE_URL . "/pages/error_pages/display_error.php");
    exit();
}