<?php

// THIS IS FOR DYNAMIC UI CHANGES 

function get_dynamic_title() {
    $current_file = basename($_SERVER['SCRIPT_NAME']); 

    $titles = [
        'index.php'  => 'A Sanctuary for Poetry, Stories & Literature',
        'poems.php'  => 'Our Literature',
        'about.php'  => 'About Us',
        'login.php'  => 'Login',
        'login.html' => 'Login'
    ];

    $page_name = isset($titles[$current_file]) ? $titles[$current_file] : 'Welcome';

    return "Son-Rize | " . xss_protect($page_name);
}

function get_account_colour($acc_Status) {
    $status = strtolower($acc_Status);
    if($status == 'active') {
        return "active";
    } elseif($status == 'inactive' || $status == 'banned') {
        return "inactive";
    } elseif($status == 'pending') {
        return "pending";
    }
    return "pending"; // Default
}

function get_recent_active_users_for_admin($dbconnection) {
    try {
    $recent_users_sql = "SELECT oauth_full_name, oauth_email, created_at, account_status 
                     FROM oauth_users 
                     WHERE created_at >= NOW() - INTERVAL 14 DAY 
                     ORDER BY created_at DESC 
                     LIMIT 5";

$recent_query = mysqli_query($dbconnection, $recent_users_sql);
return mysqli_fetch_all($recent_query, MYSQLI_ASSOC); // EXPLAIN WHAT THIS DOES
    } catch(mysqli_sql_exception $e) {
        $error_code    = $e->getCode();
        $error_message = $e->getMessage();

        error_log("ERROR GETTING RECENT ACTIVE USERS IN ADMIN PAGE INDEX.PHP. ERROR CODE: " . xss_protect($error_code) . " ERROR MESSAGE: " . xss_protect($error_message));
        return [];
    }

}
?>