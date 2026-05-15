<?php ob_start();
require_once __DIR__ . '/../../components/universal_components/head_home.inc.php';
 require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; 

//  check_logged_in(__DIR__ . '/../../API/OAUTH/google_oauth/index.php');
?>
<link rel="stylesheet" href="../../assets/CSS/user_inbox.css">
<style>
    .hidden-msg {
    color: var(--crimson-red);
    font-weight: 600;
    margin-top: 15px;
    animation: fadeIn 0.5s ease;
}

.streak-display #streak-num {
    font-size: 3rem;
    color: var(--crimson-red);
    font-weight: bold;
}
</style>
    <div class="container">
        <section class="welcome-header">
            <h1>Personal Inbox</h1>
            <p>Track your reading streaks and explore our collection.</p>
        </section>

        <div class="dashboard-grid">
           <div class="outline-card">
    <h2 class="card-title">Daily Streak</h2>
    <div class="streak-display">
        <p>Days Reading</p>
        <span id="streak-num">0</span>
    </div>
    <div class="action-area">
        <p id="completion-msg" class="hidden-msg" style="display:none;">
            <i class="fa-solid fa-circle-check" style="color: var(--crimson-red);"></i> 
            Daily goal reached! Keep it up.
        </p>
        <p id="pending-msg" class="muted-text">
            Read a story today to increase your streak!
        </p>
        <div class="action-area">
    <button id="reset-streak-btn" class="btn-outline" style="margin-top: 20px; font-size: 0.7rem; opacity: 1; color: #000">
        Reset My Progress
    </button>
</div>
    </div>
</div>


                <div class="outline-card discover-card">
                    <h2 class="card-title">Story Genres</h2>
                    <p class="muted-text">Select a genre to browse our library:</p>
                    
                    <div class="genre-grid interactive">
                        <span class="genre-item interactive-genre"><a href="../HTML/poems.php" style="color: crimson;">Poetic Writing</a></span>
                        <span class="genre-item interactive-genre"><a href="../HTML/poems.php" style="color: crimson;">Stories</a></span>
                        <span class="genre-item interactive-genre"><a href="../HTML/poems.php" style="color: crimson;">Nature</a></span>
                        <span class="genre-item interactive-genre"><a href="../HTML/poems.php" style="color: crimson;">Self-Discovery</a></span>
                        <span class="genre-item interactive-genre"><a href="../HTML/poems.php" style="color: crimson;">Sad</a></span>
                        <span class="genre-item interactive-genre"><a href="../HTML/poems.php" style="color: crimson;">Love</a></span>
                    </div>

                    <div class="literature-cta">
                        <p style="color: crimson;">Looking for more?</p>
                        <a href="../HTML/poems.php" class="btn-outline" style="color: #000">View Our Literature Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="../../assets/JS/update_user_streak.js"></script>