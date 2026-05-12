<?php 

// THIS IS FOR FUNCTIONS THAT HANDLE ERRORS

function error_message($error_code_api_func, $dbconnection) {

    $mysqli_error_actual = mysqli_error($dbconnection);
    $mysqli_error_code   = mysqli_errno($dbconnection);

    error_log("OAUTH DB FAILURE (" . xss_protect($mysqli_error_code) . "): " . xss_protect($mysqli_error_actual));

        if($error_code_api_func === 1062) {
        return "This social account is already connected to an existing profile. Please log in using your original method.";
    } elseif($error_code_api_func === 1406) {
        return "We are unable to complete your secure login at this time. Please try again later or contact support.";
    } elseif($error_code_api_func === 1136 || $error_code_api_func === 1366) {
        return "An internal configuration error occurred. Our team has been notified.";
    } elseif($error_code_api_func === 1205) {
        return "The server is currently busy. Please refresh the page to finish signing in.";
    } else {
        die("We are currently experiencing trouble pls try again later.");
    }
}

?>