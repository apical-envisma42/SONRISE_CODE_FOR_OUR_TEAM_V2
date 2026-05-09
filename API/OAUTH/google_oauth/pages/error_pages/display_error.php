<?php 
require_once __DIR__ . DIRECTORY_SEPARATOR .'../../../../core_files/config.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .'../../../../core_files/session_init.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .'../../../../core_files/functions.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR OCCURED | FIXMYAREAGHANA</title>
    <link rel="stylesheet" href="../assets/CSS/display_error.css">
</head>
<body>
    


<div class="error-wrapper">
    <div class="glass-card error-card">
<div class="icon-box">
    <img src="../images/fixmyareaghana-high-resolution-logo.png" 
         alt="Fix My Area Ghana" 
         style="max-width: 100%; max-height: 100%; border-radius: 50%; object-fit: contain;">
</div>
        
        <h1 style="color: #004b23;"><?php echo xss_protect($_SESSION['error_title'] ?? 'System Notice'); ?></h1>
        <p style="color: #004b23;"><?php echo xss_protect($_SESSION['error_msg'] ?? 'An unexpected event has occurred. Please try again later.'); ?></p>
        
        <div class="action-bar">
            <a href="javascript:history.back()" class="btn-action btn-secondary-err">
                <i class="icofont-arrow-left mr-2"></i> <span style="color: #004b23">Go Back</span>
            </a>
            <a href="../index.php" style="background-color: #004b23;" class="btn-action btn-primary-err">
                Return Home
            </a>
        </div>

        <div class="auto-redirect">
            Redirecting to home in <span id="countdown">15</span> seconds...
        </div>
    </div>
</div>

<script src="../assets/JS/error_countdown_redirect.js"></script>

</body>
</html>