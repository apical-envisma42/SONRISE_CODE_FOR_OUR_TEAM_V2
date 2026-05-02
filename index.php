<?php require_once __DIR__ . '/components/universal_components/head_home.inc.php';
      require_once __DIR__ . '/components/universal_components/nav_home.inc.php';
?>
<main>
    <section class="hero">
        <div class="hero-left">
            <h1>Welcome to <span>Son-Rise</span></h1>
            <p>
               Son-Rise is an organization dedicated to publishing articles, poems and stories. Our poems and stories range from different genres and topics.
            </p>
            <br>
            <button class="btn_learn_more" type="button">Learn More</button>
            
            <div class="hero-main-img">
                <img src="./assets/Images/reading_teenager.jpg" alt="welcome image">
            </div>

            <div class="form_for_Oauth">
                <h3>Join the Conversation</h3>
                <form action="">
                    <!-- <a type="submit" class="social-btn">
                        <i class="fa-brands fa-google"></i>
                        <span>Continue with Google</span>
                    </a> -->
                     <a href="./pages/HTML/login.html" type="submit" class="social-btn">
                        <i class="fas fa-user"></i>
                        <span>GO TO LOGIN PAGE</span>
                    </a>
                    
                    <!-- <button type="submit" class="social-btn">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Continue with Email</span>
                    </button> -->
                </form>
            </div>
        </div>

        <aside class="hero-right">
            <div class="card">
                <h2>Poetic Writing</h2>
                <p>Read soul capturing poems that will take you on a journey of emotions and self-discovery.</p>
                <img src="./assets/Images/background_images.jpg" alt="Poetry">
            </div>

            <div class="card">
                <h2>Stories</h2>
                <p>Immerse yourself in captivating stories that will transport you to different worlds.</p>
                <img src="./assets/Images/student_doing_assignment.jpg" alt="Stories">
            </div>

            <div class="card">
                <h2>Community</h2>
                <p>Join our community to start publishing your own Writings!</p>
                <img src="./assets/Images/girl_husband_wih_bookt.jpg" alt="Community">
            </div>
        </aside>
    </section>
</main>
<?php include_once __DIR__ . '/components/universal_components/footer.inc.php' ?>
</body>
</html>