<?php require_once __DIR__ . '/../../components/universal_components/head_home.inc.php';
 require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; 
?>
<link rel="stylesheet" href="../../assets/CSS/user_inbox.css">

    <div class="container">
        <section class="welcome-header">
            <h1>Personal Inbox</h1>
            <p>Track your reading streaks and explore our collection.</p>
        </section>

        <div class="dashboard-grid">
            <div class="outline-card">
                <h2 class="card-title">Daily Streak</h2>
                <div class="streak-display">
                    <span id="streak-num">0</span>
                    <p>Days Reading</p>
                </div>
                <div class="action-area">
                    <button id="streak-btn" class="btn-outline full-width" style="color: #000;">Mark as Read Today</button>
                    <p id="completion-msg" class="hidden-msg">Daily goal reached! See you tomorrow.</p>
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

    <script>
        // Streak Logic
        const streakNum = document.getElementById('streak-num');
        const streakBtn = document.getElementById('streak-btn');
        const completeMsg = document.getElementById('completion-msg');

        function initStreak() {
            const today = new Date().toDateString();
            let count = parseInt(localStorage.getItem('sr_streak')) || 0;
            let lastDate = localStorage.getItem('sr_lastDate');

            if (lastDate) {
                const last = new Date(lastDate);
                const curr = new Date(today);
                const dayDiff = Math.floor((curr - last) / (1000 * 60 * 60 * 24));
                if (dayDiff > 1) count = 0;
            }

            streakNum.innerText = count;

            if (lastDate === today) {
                toggleUI();
            }

            streakBtn.addEventListener('click', () => {
                count++;
                localStorage.setItem('sr_streak', count);
                localStorage.setItem('sr_lastDate', today);
                streakNum.innerText = count;
                toggleUI();
            });
        }

        function toggleUI() {
            if(streakBtn) streakBtn.style.display = 'none';
            if(completeMsg) completeMsg.style.display = 'block';
        }

        // Click logic for Genres to redirect
        document.querySelectorAll('.interactive-genre').forEach(item => {
            item.addEventListener('click', () => {
                window.location.href = 'literature.php';
            });
        });

        window.onload = initStreak;
    </script>