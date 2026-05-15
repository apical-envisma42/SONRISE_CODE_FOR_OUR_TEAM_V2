<?php
// Ensure session_start() has been called in your header or session_init.php
$current_page = basename($_SERVER['SCRIPT_NAME']); 
$login_link_class = "";
$profile_img_class = "";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is logged in: Hide Login, Show Profile
    $login_link_class = "hidden_login";
    $profile_img_class = ""; 
} else {
    // User is a guest: Show Login, Hide Profile
    $login_link_class = "";
    $profile_img_class = "hidden_img";
}
?>
<header class="header">
    <nav class="nav_container">

        <div class="logo">
             <!-- DURING PROD MAKE 'HTTP' to 'HTTPS' -->
            <img src="http://<?= xss_protect($_SERVER['HTTP_HOST']) ?>/sonrise/assets/Logos/sonrise.png" alt="logo">
        </div>

        <!-- Mobile Menu -->
        <input type="checkbox" id="menu-bar">
        <label for="menu-bar"><i class="fas fa-bars"></i></label>

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

    <li class="<?= xss_protect($profile_img_class); ?>">
        <a href="<?= xss_protect(BASE_URL); ?>./pages/user_pages/user_inbox.php" class="<?= ($current_page == 'user_inbox.php') ? 'active' : '' ?>">Your Inbox</a>
    </li>

<li class="<?= xss_protect($login_link_class); ?>">
        <a href="<?= xss_protect(BASE_URL); ?>./API/OAUTH/google_oauth/index.php">Login</a>  
    </li>

    <li class="<?= xss_protect($profile_img_class); ?>">
        <a href="<?= xss_protect(BASE_URL); ?>./pages/user_pages/profile.php">
            <img src="<?= xss_protect($_SESSION['user_picture']) ?? '../../assets/Images/default_avatar.svg'; ?>" alt="User Profile" class="nav-profile-img">
        </a>
    </li>

    <li>
        <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php"><button class="btn_primary mobile-only">READ WITH US</button></a>
    </li>
</ul>

        <button class="btn_primary desktop-only">
            <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" style="color: #000000">READ WITH US</a>
        </button>

    </nav>
</header>