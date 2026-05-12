<?php
if (extension_loaded('mysqli')) {
    echo "MySQLi is ACTIVE ✅";
} else {
    echo "MySQLi is STILL DISABLED ❌";
}

echo "SAPI: " . php_sapi_name() . "<br>";
echo "PHP Version: " . PHP_VERSION . "<br>";
echo "Thread Safety: " . (ZEND_THREAD_SAFE ? 'Yes (TS)' : 'No (NTS)') . "<br>";
echo "MySQLi Loaded: " . (extension_loaded('mysqli') ? 'YES' : 'NO') . "<br>";
?>
