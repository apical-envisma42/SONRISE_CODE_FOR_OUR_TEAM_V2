<footer class="modern-footer">
    <div class="footer-top">
        <div class="footer-brand">
            <img src="http://<?= xss_protect($_SERVER['HTTP_HOST']) ?>/sonrise/assets/Logos/sonrise.png" alt="Sonrise" class="footer-logo">
            <p>The new dawn of Ghanaian literature.</p>
        </div>
        
        <nav class="footer-nav">
            <a href="../../index.php">Home</a>
            <a href="./poems.php">Library</a>
            <a href="#">Join</a>
            <a href="#">Legal</a>
            <a href="<?= xss_protect(BASE_URL); ?>./pages/HTML/credits.php">Credits</a>
        </nav>

        <div class="footer-socials">
            <a href="#" aria-label="Github"><i class="fa-brands fa-github"></i></a>
            <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
        </div>
    </div>

    <div class="footer-divider"></div>

    <div class="footer-bottom">
        <div class="legal-stack">
            <span>&copy; 2026 Son-Rise.</span>
            <span class="dot"></span>
            <a href="https://www.gnu.org/licenses/agpl-3.0.en.html" target="_blank" class="license-link">AGPL-3.0</a>
        </div>
        <p class="credits"><span style="color: #fff;">Crafted by </span><span style="color: #dc3545;"><strong>THE CODERS GROVE INITIATIVE</strong></span></p>
    </div>
</footer>