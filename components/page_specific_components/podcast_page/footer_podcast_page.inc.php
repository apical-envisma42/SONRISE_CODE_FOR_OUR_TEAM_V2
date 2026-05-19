<footer class="w-full bg-gray-950 border-t border-gray-900 pt-12 pb-6 selection:bg-[#dc3545] selection:text-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8 pb-8">
            
            <div class="flex flex-col items-start gap-2 max-w-xs">
                <img src="http://<?= xss_protect($_SERVER['HTTP_HOST']) ?>/sonrise/assets/Logos/sonrise.png" alt="Sonrise" class="h-9 w-auto object-contain">
                <p class="text-xs text-gray-500 font-medium tracking-wide mt-1">
                    The new dawn of Ghanaian literature.
                </p>
            </div>
            
            <nav class="flex flex-wrap items-center gap-x-6 gap-y-2 text-xs font-semibold tracking-wider uppercase text-gray-400">
                <a href="../../index.php" class="hover:text-[#dc3545] transition-colors duration-200">Home</a>
                <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/poems.php" class="hover:text-[#dc3545] transition-colors duration-200">Library</a>
                <a href="<?= xss_protect(BASE_URL); ?>./API/OAUTH/google_oauth/index.php" class="hover:text-[#dc3545] transition-colors duration-200">Join</a>
                <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/about.php" class="hover:text-[#dc3545] transition-colors duration-200">Legal</a>
                <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/credits.php" class="hover:text-[#dc3545] transition-colors duration-200">Credits</a>
            </nav>

            <div class="flex items-center gap-4 text-lg">
                <a href="#" aria-label="Github" class="text-gray-500 hover:text-[#dc3545] transition-colors duration-200 transform hover:scale-105">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="#" aria-label="Twitter" class="text-gray-500 hover:text-[#dc3545] transition-colors duration-200 transform hover:scale-105">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
            </div>
        </div>

        <div class="w-full h-px bg-gray-900 my-4"></div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-4 text-xs font-medium tracking-wide text-gray-500">
            
            <div class="flex items-center gap-2">
                <span>&copy; 2026 Son-Rise.</span>
                <span class="w-1 h-1 rounded-full bg-gray-800"></span>
                <a href="https://www.gnu.org/licenses/agpl-3.0.en.html" target="_blank" class="text-gray-400 hover:text-[#dc3545] hover:underline transition-all duration-200">
                    AGPL-3.0
                </a>
            </div>
            
            <p class="text-gray-400">
                Crafted by <span class="text-white font-bold tracking-wider">THE CODERS GROVE INITIATIVE</span>
            </p>
        </div>

    </div>
</footer>