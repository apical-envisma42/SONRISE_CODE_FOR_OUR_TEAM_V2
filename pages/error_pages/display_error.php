<?php 
require_once __DIR__ . '/../../core_files/session_init.php';
include_once __DIR__ . '/../../core_files/config.php';
include_once __DIR__ . '/../../core_files/functions.php'; 

// Procedural extraction and sanitization of session errors
$error_title = isset($_SESSION['error_title']) 
    ? xss_protect($_SESSION['error_title']) 
    : 'Lost in the Verses';

$error_msg = isset($_SESSION['error_msg']) 
    ? xss_protect($_SESSION['error_msg']) 
    : 'The parchment you are looking for has been burned to ash. This path leads nowhere.';

// Clear the session variables after assigning them so they don't persist on reload
unset($_SESSION['error_title']);
unset($_SESSION['error_msg']);

$redirect_seconds = 15;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost in Verses | SONRISE</title>
    <link rel="stylesheet" href="../../assets/CSS/display_error.css">
</head>
<body>

<div class="error-wrapper">
    <div class="glass-card error-card">
        <div class="icon-box">
            <img src="../../assets/Logos/sonrise.png" alt="SONRISE">
        </div>
        
        <h1><?= xss_protect($error_title)?></h1>
        <p><?= xss_protect($error_msg); ?></p>
        
        <div class="action-bar">
            <a href="javascript:history.back()" class="btn-action btn-secondary-err">
                <span>Retrace Steps</span>
            </a>
            <a href="../../index.php" class="btn-action btn-primary-err">
                Return Home
            </a>
        </div>

        <div class="auto-redirect">
            Awakening back to reality in <span id="countdown"><?= $redirect_seconds; ?></span> seconds...
        </div>
    </div>
</div>
<!-- 
<script>
    let timeLeft = <?= $redirect_seconds; ?>;
    const countdownElement = document.getElementById('countdown');
    const redirectUrl = "../../index.php";

    const timer = setInterval(function() {
        timeLeft--;
        countdownElement.textContent = timeLeft;

        if (timeLeft <= 0) {
            clearInterval(timer);
            window.location.href = redirectUrl;
        }
    }, 1000);
</script> -->

</body>
</html>