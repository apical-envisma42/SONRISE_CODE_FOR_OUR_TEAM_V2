<?php if(ob_get_level() === 0) ob_start(); 
require_once __DIR__ . '/../../core_files/functions.php';

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="SONRISE | A Sanctuary for Poetry, Stories and Literature">
    <meta name="description" content="Explore a world of dark gothic thrillers, nature-inspired poems, and stories of self-discovery. Join our community of writers on SONRISE, a secure platform for creative literature.">
    <meta name="keywords" content="poetry, creative writing, short stories, gothic thrillers, literature platform, self-discovery, SONRISE, Ghana poets">
    <meta name="author" content="Gideon Akomea Peprah">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= xss_protect(BASE_URL); ?>">
    <meta property="og:title" content="SON-RIZE | A Sanctuary for Poetry, Stories & Literature">
    <meta property="og:description" content="A collaborative, open-source sanctuary for writers to publish stories and poems. Experience a modern, responsive design and secure community content.">
    <meta property="og:image" content="<?= xss_protect(BASE_URL); ?>/assets/Logos/sonrise.png">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= xss_protect(BASE_URL); ?>">
    <meta property="twitter:title" content="SONRISE | A Sanctuary for Poetry, Stories & Literature">
    <meta property="twitter:description" content="Join the SONRISE community. A responsive, secure platform for dark gothic thrillers and poetic writing.">
    <meta property="twitter:image" content="<?= xss_protect(BASE_URL); ?>/assets/Logos/sonrise.png">
    <meta charset="UTF-8">
    <meta name="theme-color" content="#dc3545"> <link rel="canonical" href="https://sonrise.infinityfree.me/index.php">
    
    <!-- DYNAMIC TITLE -->
    <title><?= xss_protect(get_dynamic_title()); ?></title>
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>/assets/CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="login-page-bg">

    <div class="login-container">
        <div class="login-card">
            <h1 style="font-size: 5rem; color: var(--crimson-red); margin-bottom: 10px;">404</h1>
            <h2>Oops! Lost in the Story?</h2>
            <p>The page you are looking for doesn't exist or has been moved to a different chapter.</p>
            
            <a href="./poems.php" class="social-btn" style="text-decoration: none; border-color: var(--crimson-red); color: var(--crimson-red);">
                <i class="fa-solid fa-book-open"></i> Explore Our Literature
            </a>

            <a href="./podcasts.php" class="social-btn" style="text-decoration: none; border-color: var(--crimson-red); color: var(--crimson-red);">
                <i class="fa-solid fa-microphone-lines"></i> Listen To Our Podcasts
            </a>
        </div>
    </div>

</body>
</html>