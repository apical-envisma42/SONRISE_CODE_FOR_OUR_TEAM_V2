<?php 

// THIS PAGE IS DATABASE CONNECTION

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// DB CONNECTION TRY_CATCH BLOCK

try {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "sonrisedb";

    $dbconn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

} catch(mysqli_sql_exception $e) {
    $error_code    = $e->getCode();
    $error_message = $e->getMessage();

    error_log("DATABASE CONNECTION ERROR (" . xss_protect($error_code) . "): " . xss_protect($error_message));

    $error_title = "System Note";
    $error_msg   = "An unexpected condition occurred. Please try again shortly.";

    if ($error_code === 1045) {
        $error_title = "Access Status";
        $error_msg   = "Account verification failed. We are unable to authenticate your session at this time. Please try again later.";
    } elseif ($error_code === 1049) {
        $error_title = "Service Status";
        $error_msg   = "System Configuration Error. The requested resource is temporarily unavailable. Our team has been notified.";
    } elseif ($error_code === 2002) {
        $error_title = "Server Status";
        $error_msg   = "Server is currently under maintenance. We are working to restore service as quickly as possible.";
    } elseif ($error_code === 1040) {
        $error_title = "Traffic Status";
        $error_msg   = "High traffic detected. Please refresh the page in a few moments to continue.";
    } elseif ($error_code === 2006) {
        $error_title = "Connection Status";
        $error_msg   = "The connection was interrupted. Please check your internet stability and try again.";
    }

    $_SESSION['error_title'] = $error_title;
    $_SESSION['error_msg']   = $error_msg;

    header("Location: ../../pages/error_pages/display_error.php");
    exit();
}

?>