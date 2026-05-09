<?php
// Ensure session_start() has been called in your header or session_init.php
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

<?php

    use phpseclib3\Crypt\EC\BaseCurves\Base;
$current_page = basename($_SERVER['SCRIPT_NAME']); 
?>
<style>
.nav-profile-img {
    width: 45px;
    height: 45px;
    object-fit: cover;
    border-radius: 50%; /* Makes the image circular */
    border: 2px solid var(--crimson-red);
    cursor: pointer;
    transition: all 0.3s ease;
    display: block; /* Removes any unwanted whitespace below the image */
}

.nav-profile-img:hover {
    transform: scale(1.1);
    border-color: var(--accent-gold);
    box-shadow: 0 0 10px rgba(220, 53, 69, 0.3);
}

/* Ensure the list item aligns vertically with text links */
.nav-links li {
    display: flex;
    align-items: center;
}

/* RESPONSIVE TWEAK: Center the image in the mobile menu */
@media (max-width: 880px) {
    .nav-profile-img {
        margin: 1rem 0;
        width: 60px;
        height: 60px;
    }
}

.hidden_img, .hidden_login {
    display: none !important;
}
</style>

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
        <a href="<?= xss_protect(BASE_URL); ?>./pages/user_pages/user_inbox.php" class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">Your Inbox</a>
    </li>

<li class="<?= xss_protect($login_link_class); ?>">
        <a href="<?= xss_protect(BASE_URL); ?>./API/OAUTH/google_oauth/index.php">Login</a>  
    </li>

    <li class="<?= xss_protect($profile_img_class); ?>">
        <a href="<?= xss_protect(BASE_URL); ?>./API/OAUTH/google_oauth/pages/user_pages/profile.php">
            <img src="<?= xss_protect($_SESSION['user_picture'] ?? ''); ?>" alt="User Profile" class="nav-profile-img">
        </a>
    </li>

    <li>
        <button class="btn_primary mobile-only">READ WITH US</button>
    </li>
</ul>

        <button class="btn_primary desktop-only">
            <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" style="color: #000000">READ WITH US</a>
        </button>

    </nav>
</header>