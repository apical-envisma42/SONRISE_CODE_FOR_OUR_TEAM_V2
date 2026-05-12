<?php

// THIS IS FOR ALL RBAC STUFFF

function check_logged_in($header_location) {
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: " . $header_location);
    exit();
}
}


function check_account_level_for_admin($location_header) {
if(!isset($_SESSION['account_level']) || $_SESSION['account_level'] === "user") {
    header("Location: " . $location_header);
    exit();
}
}

function block_admin_button_for_user() {
    global $hide_class;
    if(isset($_SESSION['account_level']) && $_SESSION['account_level'] === "user") {
    $hide_class = "hidden_page"; 
}
}

function checkuserloginsendbacktohome($user_back_header_location) {
    if(!empty($_SESSION['logged_in'])):
    header("Location: " . $user_back_header_location);
    exit();
endif;
}

?>

