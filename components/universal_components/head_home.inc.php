<?php if(ob_get_level() === 0) ob_start(); 
require_once __DIR__ . '/../../core_files/config.php'; 
require_once __DIR__ . '/../../core_files/session_init.php';require_once __DIR__ . '/../../core_files/functions.php';
require_once __DIR__ . '/../defined_code.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Son-Rise | Welcome</title>
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>./assets/CSS/home.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>./assets/CSS/blog.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>./assets/CSS/login.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>./assets/CSS/about.css">
    <link rel="shortcut icon" href="http://<?= xss_protect($_SERVER['HTTP_HOST']) ?>/sonrise/assets/Logos/sonrise.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>