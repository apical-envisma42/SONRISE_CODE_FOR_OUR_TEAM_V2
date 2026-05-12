<?php 
define('BASE_URL', 'http://localhost/sonrise/');
define('ROOT_PATH_CORE_FILES', '/../');
$app_dev_mode            = ""; // WILL ADD VALUE LATER
$APP_MAINTENANCE_MODE    = "";

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
    header("Location: ./pages/HTML/maintenance_page.php");
    exit();
}

?>