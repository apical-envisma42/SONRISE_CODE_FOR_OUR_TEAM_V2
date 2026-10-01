<?php
$current_page = basename($_SERVER['SCRIPT_NAME']); 
$login_link_class = "";
$profile_img_class = "";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $login_link_class = "hidden_login";
    $profile_img_class = ""; 
} else {
    $login_link_class = "";
    $profile_img_class = "hidden_img";
}
?>
<header class="header">
    <nav class="nav_container">

        <div class="logo">
            <a href="<?= xss_protect(BASE_URL); ?>/index.php">
                <img src="http://<?= xss_protect($_SERVER['HTTP_HOST']) ?>/sonrise/assets/Logos/sonrise.png" alt="SonRise Logo">
            </a>
        </div>

        <!-- Mobile Toggle Switch -->
        <input type="checkbox" id="menu-bar">
        <label for="menu-bar" class="menu-icon"><i class="fas fa-bars"></i></label>

        <ul class="nav-links">
            <li>
                <a href="../../index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle <?= in_array($current_page, ['poems.php', 'podcasts.php', 'gallery.php', 'video_projects.php']) ? 'active' : '' ?>">
                    Explore Sonrise<i class="fas fa-chevron-down drop-icon"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" class="<?= ($current_page == 'poems.php') ? 'active' : '' ?>">Literature</a></li>
                    <li><a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/podcasts.php" class="<?= ($current_page == 'podcasts.php') ? 'active' : '' ?>">Podcasts</a></li>
                    <li><a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/gallery.php" class="<?= ($current_page == 'gallery.php') ? 'active' : '' ?>">Gallery</a></li>
                    <li><a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/video_projects.php" class="<?= ($current_page == 'video_projects.php') ? 'active' : '' ?>">Video Projects</a></li>
                </ul>
            </li>

            <li>
                <a href="<?= xss_protect(BASE_URL); ?>./pages/user_pages/add_poem.php" class="<?= ($current_page == 'add_poem.php') ? 'active' : '' ?>">Add Poem</a>
            </li>

            <li>
                <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/about.php" class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">About Us</a>
            </li>

            <li class="<?= xss_protect($profile_img_class); ?>">
                <a href="<?= xss_protect(BASE_URL); ?>./pages/user_pages/user_inbox.php" class="<?= ($current_page == 'user_inbox.php') ? 'active' : '' ?>">Inbox</a>
            </li>

            <li class="<?= xss_protect($login_link_class); ?>">
                <a href="<?= xss_protect(BASE_URL); ?>./API/OAUTH/google_oauth/index.php" class="login-link">Login</a>  
            </li>

            <li class="<?= xss_protect($profile_img_class); ?>">
                <a href="<?= xss_protect(BASE_URL); ?>./pages/user_pages/profile.php">
                    <img src="<?= xss_protect($_SESSION['user_picture']) ?? '../../assets/Images/default_avatar.svg'; ?>" alt="User Profile" class="nav-profile-img">
                </a>
            </li>

            <li class="mobile-only">
                <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" class="btn_primary text-center">READ WITH US</a>
            </li>
        </ul>

        <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" class="btn_primary desktop-only">READ WITH US</a>
    </nav>
</header>