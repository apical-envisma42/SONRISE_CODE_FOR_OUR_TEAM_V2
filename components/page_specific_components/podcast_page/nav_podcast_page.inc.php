<?php
$current_page = basename($_SERVER['SCRIPT_NAME']); 
$login_link_class = "";
$profile_img_class = "";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $login_link_class = "hidden"; // Changed to modern 'hidden' utility syntax
    $profile_img_class = "flex items-center"; 
} else {
    $login_link_class = "block";
    $profile_img_class = "hidden";
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<header class="w-full bg-gray-950 border-b border-gray-900 sticky top-0 z-50 selection:bg-[#dc3545] selection:text-white">
    <nav class="max-w-6xl mx-auto px-4 h-20 flex items-center justify-between sm:px-6 lg:px-8 relative">

        <div class="flex-shrink-0 flex items-center">
            <img src="http://<?= xss_protect($_SERVER['HTTP_HOST']) ?>/sonrise/assets/Logos/sonrise.png" alt="logo" class="h-10 w-auto object-contain" height="250px">
        </div>

        <input type="checkbox" id="menu-bar" class="peer hidden">
        <label for="menu-bar" class="text-gray-400 hover:text-[#dc3545] text-xl cursor-pointer md:hidden transition transition-colors duration-200 z-50">
            <i class="fas fa-bars peer-checked:hidden"></i>
        </label>

        <ul class="
            fixed inset-y-0 right-0 w-64 bg-gray-950 border-l border-gray-900 p-8 pt-24 space-y-6 flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out
            peer-checked:translate-x-0 
            md:static md:w-auto md:p-0 md:space-y-0 md:flex-row md:items-center md:gap-x-8 md:translate-x-0 md:border-none md:bg-transparent
            text-sm font-medium tracking-wide
        ">
            <li>
                <a href="../../index.php" class="block py-2 transition-colors duration-200 <?= ($current_page == 'index.php') ? 'text-[#dc3545] font-semibold' : 'text-gray-400 hover:text-gray-200' ?>">Home</a>
            </li>
            <li>
                <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" class="block py-2 transition-colors duration-200 <?= ($current_page == 'poems.php') ? 'text-[#dc3545] font-semibold' : 'text-gray-400 hover:text-gray-200' ?>">Our Literature</a>
            </li>
            <li>
                <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/podcasts.php" class="block py-2 transition-colors duration-200 <?= ($current_page == 'podcasts.php') ? 'text-[#dc3545] font-semibold' : 'text-gray-400 hover:text-gray-200' ?>">Our Podcasts</a>
            </li>
        <li>
        <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/gallery.php" class="<?= ($current_page == 'gallery.php') ? 'active' : '' ?>">The Gallery</a>
        </li>
            <li>
                <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/about.php" class="block py-2 transition-colors duration-200 <?= ($current_page == 'about.php') ? 'text-[#dc3545] font-semibold' : 'text-gray-400 hover:text-gray-200' ?>">About Us</a>
            </li>

            <li class="<?= xss_protect($profile_img_class); ?>">
                <a href="<?= xss_protect(BASE_URL); ?>./pages/user_pages/user_inbox.php" class="block py-2 transition-colors duration-200 w-full <?= ($current_page == 'user_inbox.php') ? 'text-[#dc3545] font-semibold' : 'text-gray-400 hover:text-gray-200' ?>">Your Inbox</a>
            </li>

            <li class="<?= xss_protect($login_link_class); ?> border-t border-gray-900 pt-4 md:border-none md:pt-0">
                <a href="<?= xss_protect(BASE_URL); ?>./API/OAUTH/google_oauth/index.php" class="block py-2 text-gray-400 hover:text-[#dc3545] font-semibold transition-colors duration-200">Login</a>  
            </li>

            <li class="<?= xss_protect($profile_img_class); ?> border-t border-gray-900 pt-4 md:border-none md:pt-0">
                <a href="<?= xss_protect(BASE_URL); ?>./pages/user_pages/profile.php" class="inline-block relative rounded-full p-0.5 hover:ring-2 hover:ring-[#dc3545] transition-all duration-200">
                <img src="<?= xss_protect($_SESSION['user_picture'] ?? '../../assets/Images/defaultavatar.svg'); ?>" alt="User Profile" class="w-8 h-8 rounded-full object-cover border border-gray-800">                </a>
            </li>

            <li class="md:hidden pt-4">
                <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" class="block w-full text-center py-2.5 rounded-lg bg-[#dc3545] text-white font-bold text-xs uppercase tracking-wider hover:bg-red-700 transition duration-200 shadow-md">
                    READ WITH US
                </a>
            </li>
        </ul>

        <div class="hidden md:block flex-shrink-0">
            <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-[#dc3545] text-white font-bold text-xs uppercase tracking-widest hover:bg-red-600 transition-all duration-200 transform hover:scale-[1.03] active:scale-[0.98] shadow-lg">
                READ WITH US
            </a>
        </div>

    </nav>
</header>