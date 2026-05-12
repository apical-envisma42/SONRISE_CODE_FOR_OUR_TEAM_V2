<?php
require_once __DIR__ . '/../../../core_files/functions.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_poem'])) {
    echo "SENT";
}
?>