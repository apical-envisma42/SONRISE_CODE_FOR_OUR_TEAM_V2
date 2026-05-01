<?php if(ob_get_level() === 0) ob_start(); 
require_once __DIR__ . '/../../defined_code.php';
require_once __DIR__ . '/../../../core_files/session_init.php';
require_once __DIR__ . '/../../../core_files/config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Son-Rise | Welcome</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>./assets/CSS/home.css">
    <link rel="shortcut icon" href="./assets/Logos/sonrise.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>