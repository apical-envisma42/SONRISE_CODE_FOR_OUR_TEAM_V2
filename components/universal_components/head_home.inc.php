<?php if(ob_get_level() === 0) ob_start(); 
require_once __DIR__ . '/../../core_files/config.php'; 
require_once __DIR__ . '/../../core_files/session_init.php';
require_once __DIR__ . '/../../core_files/functions.php';
require_once __DIR__ . '/../defined_code.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="SONRISE | A Sanctuary for Poetry, Stories & Literature">
    <meta name="description" content="Explore a world of dark gothic thrillers, nature-inspired poems, and stories of self-discovery. Join our community of writers on SONRISE, a secure platform for creative literature.">
    <meta name="keywords" content="poetry, creative writing, short stories, gothic thrillers, literature platform, self-discovery, SONRISE, Ghana poets">
    <meta name="author" content="Gideon Akomea Peprah">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://son-rize.com/">
    <meta property="og:title" content="SON-RIZE | A Sanctuary for Poetry, Stories & Literature">
    <meta property="og:description" content="A collaborative, open-source sanctuary for writers to publish stories and poems. Experience a modern, responsive design and secure community content.">
    <meta property="og:image" content="https://SON-RIZE/assets/Logos/sonrise.png">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://son-rize.com/">
    <meta property="twitter:title" content="SONRISE | A Sanctuary for Poetry, Stories & Literature">
    <meta property="twitter:description" content="Join the SONRISE community. A responsive, secure platform for dark gothic thrillers and poetic writing.">
    <meta property="twitter:image" content="https://SON-RIZE/assets/Logos/sonrise.png">
    <meta charset="UTF-8">
    <meta name="theme-color" content="#dc3545"> <link rel="canonical" href="https://son-rize.com/index.php">
    
    <!-- DYNAMIC TITLE -->
    <title><?= xss_protect(get_dynamic_title()); ?></title>

    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>/assets/CSS/home.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>/assets/CSS/poems.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>/assets/CSS/login.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>/assets/CSS/about.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>./assets/CSS/maintenance_page.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>./assets/CSS/credits.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>./API/OAUTH/google_oauth/assets/CSS/oauth_profile.css">
    <link rel="shortcut icon" href="http://<?= xss_protect($_SERVER['HTTP_HOST']) ?>/sonrise/assets/Logos/sonrise.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>