<?php require_once __DIR__ . '/components/universal_components/head_home.inc.php';
      require_once __DIR__ . '/components/universal_components/nav_home.inc.php';
?>
<head>
    <link rel="canonical" href="https://sonrise.infinityfree.me/index.php" />
</head>
<style>
    a {
        text-decoration: none;
    }
</style>
<main>
    <section class="hero">
        <div class="hero-left">
            <h1>Welcome to <span>Son-Rise</span></h1>
            <p>
               Son-Rise is an organization dedicated to publishing articles, poems and stories. Our poems and stories range from different genres and topics.
            </p>
            <br>
            <a href="<?= xss_protect(BASE_URL); ?>/pages/HTML/poems.php"><button class="btn_learn_more" type="button">Learn More</button></a>
            
            <div class="hero-main-img">
                <img src="./assets/Images/Reading_Teenager_student.jpg" alt="welcome image">
            </div>

            <div class="form_for_Oauth">
                <h3>Join the Conversation</h3>
                <form action="">
                    <!-- <a type="submit" class="social-btn">
                        <i class="fa-brands fa-google"></i>
                        <span>Continue with Google</span>
                    </a> -->
                     <a href="<?= xss_protect(BASE_URL); ?>./API/OAUTH/google_oauth/index.php" class="social-btn">
                        <i class="fas fa-user"></i>
                        <span>Click To Login To <span style="color:#dc3545;">SONRISE</span></span>
                    </a>
                    
                    <!-- <button type="submit" class="social-btn">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Continue with Email</span>
                    </button> -->
                </form>
            </div>
        </div>

        <aside class="hero-right">
            <a href="./pages/HTML/poems.php">
            <div class="card">
                <h2 style="color: black;">Poetic Writing</h2>
                <p style="color: black;">Read soul capturing poems that will take you on a journey of emotions and self-discovery. <br> 
                <span style="color: #dc3545;"><strong>Click to explore!</strong></span></p>
                <img src="./assets/Images/background_images.jpg" alt="Poetry">
            </div>
            </a>

            <a href="./pages/HTML/podcasts.php">
            <div class="card">
                <h2 style="color: black;">Our Podcast</h2>
                <p style="color: black;">Immerse yourself in our library of captivating podcast overviews on your favourite books that will transport you to different worlds. <br>
                <span style="color: #dc3545;"><strong>Click to explore!</strong></span></p>
                <img src="./assets/Images/student_doing_assignment.jpg" alt="Stories">
            </div>
            </a>

            <div class="card">
                <h2>Community</h2>
                <p>Join our community to start publishing your own Writings!</p>
                <img src="./assets/Images/share_your_voice.jpg" alt="Community">
            </div>
        </aside>
    </section>
</main>
<?php include_once __DIR__ . '/components/universal_components/footer.inc.php' ?>
</body>
</html>