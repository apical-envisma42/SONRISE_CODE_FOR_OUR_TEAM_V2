<?php if(ob_get_level() === 0) ob_start();
//THIS SENDS FROM OAUTH_API_FOLDER TO ROOT
define('ROOT_PATH_CORE_FILES', '/../');
require_once __DIR__ . '/session_init.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../vendor/autoload.php';
// CHANGE TO DOMAIN NAME DURING PROD
define('BASE_URL', 'http://localhost/SONRISE/');

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . ROOT_PATH_CORE_FILES);
$dotenv->load();


// $dotenv->required(['DB_HOSTNAME', 'DB_USERNAME', 'DB_NAME']);


$app_dev_mode            = strtolower($_ENV['APP_ERR_MODE']);
$APP_MAINTENANCE_MODE    = strtoupper($_ENV['APP_MAINTENANCE_MODE']);

// ERROR LOG SETTINGS
ini_set('log_errors', 'On');
ini_set('error_log', __DIR__ . '/../index_logs/index_logs.log');

if($app_dev_mode === 'local'):
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
elseif($app_dev_mode === 'production'):
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(E_ALL);
endif;

$current_page = basename($_SERVER['PHP_SELF']);

if($APP_MAINTENANCE_MODE === 'ON' && $current_page !== 'maintenance_page.php') {
    header("Location: ./pages/maintenance_page.php");
    exit();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// DB CONNECTION TRY_CATCH BLOCK

try {
    $db_host = $_ENV['DB_HOSTNAME'];
    $db_user = $_ENV['DB_USERNAME'];
    $db_pass = $_ENV['DB_PASSWORD'];
    $db_name = $_ENV['DB_NAME'];

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

    header("Location: ./display_error.php");
    exit();
}

// GOOGLE OAUTH CRED
$google_client_ID     = $_ENV['GOOGLE_CLIENT_ID']     ;
$google_client_secret = $_ENV['GOOGLE_CLIENT_SECRET'] ;
$google_client_URI    = $_ENV['GOOGLE_REDIRECT_URI']  ;
$google_access_type   = $_ENV['GOOGLE_ACCESS_TYPE']   ;
$google_set_prompt    = $_ENV['GOOGLE_SET_PROMPT']    ;


?>