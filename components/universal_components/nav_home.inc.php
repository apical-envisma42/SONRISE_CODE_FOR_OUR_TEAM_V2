<header class="header">
    <nav class="nav_container">

        <div class="logo">
             <!-- DURING PROD MAKE 'HTP' to 'HTTPS' -->
            <img src="http://<?= xss_protect($_SERVER['HTTP_HOST']) ?>/sonrise/assets/Logos/sonrise.png" alt="logo">
        </div>

        <!-- Mobile Menu -->
        <input type="checkbox" id="menu-bar">
        <label for="menu-bar"><i class="fas fa-bars"></i></label>

<?php 
$current_page = basename($_SERVER['SCRIPT_NAME']); 
?>

<ul class="nav-links">
    <li>
        <a href="../../index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a>
    </li>
    <li>
        <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" class="<?= ($current_page == 'poems.php') ? 'active' : '' ?>">Our Literature</a>
    </li>
    <li>
        <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/about.php" class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">About Us</a>
    </li>
    <li>
        <a href="<?= xss_protect(BASE_URL); ?>./API/OAUTH/google_oauth/index.php" class="">Login</a>
    </li>
    <li>
        <button href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" class="btn_primary mobile-only">READ WITH US</button>
    </li>
</ul>

        <button class="btn_primary desktop-only">
            <a href="#" style="color: #000000">READ WITH US</a>
        </button>

    </nav>
</header>