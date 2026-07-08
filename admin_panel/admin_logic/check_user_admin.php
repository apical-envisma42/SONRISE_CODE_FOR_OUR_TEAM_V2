<?php

if(!is_admin()) {
    header("Location: " . BASE_URL . "/pages/user_pages/profile.php");
    exit();
}

if(!check_logged_in()) {
    header("Location: " . BASE_URL . "/pages/user_pages/profile.php");
    exit();
}

?>