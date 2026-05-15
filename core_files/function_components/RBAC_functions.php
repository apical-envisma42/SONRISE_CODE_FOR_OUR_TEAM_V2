<?php

// THIS IS FOR ALL RBAC STUFFF

function check_logged_in() {
    return (isset($_SESSION['logged_in'])  && $_SESSION['logged_in'] === true);
}


function is_admin() {
    return (isset($_SESSION['account_level']) && $_SESSION['account_level'] === 'admin');
}

function is_user() {
    return (isset($_SESSION['account_level']) && $_SESSION['account_level'] === 'user');
}

function is_moderator() {
    return (isset($_SESSION['account_level']) && $_SESSION['account_level'] === 'moderator');
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

