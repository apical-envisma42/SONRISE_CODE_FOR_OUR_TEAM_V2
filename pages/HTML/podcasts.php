<?php require_once __DIR__ . '/../../components/universal_components/head_home.inc.php'; global $dbconn; ?>
<head>
    <link rel="canonical" href="https://sonrise.infinityfree.me/pages/HTML/podcasts.php" />
</head>
<?php require_once __DIR__ . '/../../components/page_specific_components/podcast_page/nav_podcast_page.inc.php';?>
    <style>
        .brand-crimson { color: #dc3545; }
        .bg-brand-crimson { background-color: #dc3545; }
        .border-brand-crimson { border-color: #dc3545; }
        
        ::selection {
            background-color: #dc3545;
            color: #ffffff;
        }

.podcast-progress-bar::-webkit-slider-runnable-track {
    width: 100%;
    height: 4px;
    cursor: pointer;
}

.podcast-progress-bar::-webkit-slider-thumb {
    height: 12px;
    width: 12px;
    border-radius: 50%;
    background: #ffffff;
    cursor: pointer;
    -webkit-appearance: none;
    margin-top: -4px; 
    box-shadow: 0 0 8px rgba(220, 53, 69, 0.8);
    transition: transform 0.1s ease;
}

.podcast-progress-bar::-webkit-slider-thumb:hover {
    transform: scale(1.3);
    background: #dc3545;
}
    </style>
    
<body class="bg-gray-950 text-gray-100 font-sans antialiased">

    <main class="max-w-6xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        
        <header class="mb-16 text-center">
            <span class="text-xs font-bold tracking-widest uppercase px-3 py-1 rounded-full border border-[#dc3545]/30 bg-[#dc3545]/10 text-[#dc3545]">
                Audio Logs
            </span>
            <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                SONRISE <span class="bg-gradient-to-r from-[#dc3545] to-red-400 bg-clip-text text-transparent">Podcast</span>
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-base sm:text-lg text-gray-400">
                Story Overviews, architectural deep dives, and chill, interactive podcasts.
            </p>
        </header>

<section class="mb-16">
    <h2 class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-4 flex items-center gap-2">
        <span class="w-2 h-2 rounded-full bg-[#dc3545] animate-pulse"></span>
        Latest Season
    </h2>
    <?php 
    $sql = "SELECT title, slug, summary, season_number, episode_number, duration_seconds, audio_url, published_at 
            FROM podcast_episodes 
            WHERE is_published = 1 
            LIMIT 5";
    $query = mysqli_query($dbconn, $sql);

    if (!$query) {
        die("Database Query Failed: " . mysqli_error($dbconn));
    }

    while($row = mysqli_fetch_assoc($query)):
        $timestamp_podcast = strtotime($row['published_at']);
        $formatted_time_podcast = date("F j, Y", $timestamp_podcast);
        $minutes = floor($row['duration_seconds'] / 60);
        $seconds = $row['duration_seconds'] % 60;
        $duration_display = sprintf('%02d:%02d', $minutes, $seconds);
        
        $escaped_title = addslashes($row['title']);
    ?>
    <div class="relative overflow-hidden bg-gradient-to-br from-gray-900 to-gray-950 rounded-2xl border border-gray-800 p-6 sm:p-8 lg:p-10 shadow-2xl transition hover:border-[#dc3545]/40 group mb-6" data-podcast-slug="<?= xss_protect($row['slug']); ?>">
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-[#dc3545]/10 rounded-full blur-3xl pointer-events-none group-hover:bg-[#dc3545]/15 transition-all duration-500"></div>
        
        <div class="relative flex flex-col md:flex-row md:items-center gap-6 lg:gap-8">
            <div class="w-full md:w-44 h-44 bg-gradient-to-tr from-[#dc3545] to-red-700 rounded-xl flex flex-col items-center justify-center shadow-lg shrink-0 border border-red-400/20">
                <i class="fa-solid fa-microphone text-4xl text-white/90 mb-2"></i>
                <span class="text-xs font-bold tracking-wider text-red-100 uppercase">SONRISE FM</span>
            </div>

            <div class="flex-1 flex flex-col justify-between h-full">
                <div>
                    <div class="flex items-center gap-3 text-xs font-semibold text-[#dc3545] mb-2">
                        <span><?= "Season " . xss_protect($row['season_number']) . ", Episode " . xss_protect($row['episode_number']); ?></span>
                        <span>&bull;</span>
                        <time><?= xss_protect($formatted_time_podcast); ?></time>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-bold text-white tracking-tight leading-tight mb-3">
                        <?= xss_protect($row['title'] ?? 'SONRISE PODCAST'); ?>
                    </h3>
                    <p class="text-gray-400 text-sm sm:text-base leading-relaxed line-clamp-2 max-w-3xl mb-6">
                        <?= xss_protect($row['summary']); ?>
                    </p>
                </div>

<div class="flex flex-col sm:flex-row sm:items-center gap-4 justify-between w-full max-w-2xl border-t border-gray-900 pt-4">
                    
    <div class="flex flex-col gap-3 bg-gray-950 p-4 rounded-xl border border-gray-800/80 w-full max-w-sm">
        
        <div class="flex items-center gap-4">
            <button type="button" class="podcast-btn w-12 h-12 rounded-full bg-[#dc3545] flex items-center justify-center text-white hover:bg-red-500 transition transform hover:scale-105 active:scale-95 shadow-md shrink-0" data-episode="ep_<?php echo xss_protect($row['slug']); ?>">
                <i class="fa-solid fa-play ml-0.5 text-lg btn-icon"></i>
            </button>
            
            <div class="text-sm">
                <p class="font-bold text-gray-200 whitespace-nowrap tracking-wide">Stream Episode</p>
                <p class="text-gray-400 font-mono text-xs mt-0.5">
                    <span class="current-time-display font-bold text-[#dc3545]">00:00</span> / <span class="total-duration-display"><?php echo xss_protect($duration_display); ?> mins</span>
                </p>
            </div>
            
            <audio id="ep_<?php echo xss_protect($row['slug']); ?>" src="../../assets/audio/uploaded_podcast_section_audios/<?php echo xss_protect($row['audio_url']); ?>" preload="none"></audio>
        </div>

        <div class="w-full flex items-center gap-2 px-1 opacity-60 hover:opacity-100 transition-opacity duration-200">
            <input 
                type="range" 
                class="podcast-progress-bar w-full h-1 bg-gray-800 rounded-lg appearance-none cursor-pointer accent-[#dc3545] focus:outline-none"
                value="0" 
                min="0" 
                max="100"
                step="0.1"
                data-target="ep_<?php echo xss_protect($row['slug']); ?>"
            >
        </div>

    </div>

<div class="flex items-center gap-2.5 self-end sm:self-center bg-gray-950/90 p-2 px-3 rounded-xl border border-gray-800/60 shadow-lg backdrop-blur-sm">
    <span class="text-gray-400 text-[11px] font-extrabold tracking-widest uppercase pr-1 select-none border-r border-gray-800/80 mr-1 py-1">Share:</span>
    
    <button type="button" 
            onclick="copyPodcastLink('<?php echo xss_protect($row['slug']); ?>', this)" 
            class="share-btn share-btn-link w-9 h-9 rounded-lg flex items-center justify-center text-gray-400 bg-gray-900/60 border border-gray-800/40 transition-all duration-200 hover:-translate-y-0.5" 
            title="Copy Episode Link">
        <i class="fa-solid fa-link text-xs"></i>
    </button>
    
    <button type="button" 
            onclick="sharePodcastWhatsApp('<?php echo xss_protect($row['slug']); ?>', '<?php echo xss_protect($escaped_title); ?>')" 
            class="share-btn share-btn-wa w-9 h-9 rounded-lg flex items-center justify-center text-gray-400 bg-gray-900/60 border border-gray-800/40 transition-all duration-200 hover:-translate-y-0.5" 
            title="Share via WhatsApp">
        <i class="fa-brands fa-whatsapp text-sm"></i>
    </button>
    
    <button type="button" 
            onclick="sharePodcastTwitter('<?php echo xss_protect($row['slug']); ?>', '<?php echo xss_protect($escaped_title); ?>')" 
            class="share-btn share-btn-x w-9 h-9 rounded-lg flex items-center justify-center text-gray-400 bg-gray-900/60 border border-gray-800/40 transition-all duration-200 hover:-translate-y-0.5" 
            title="Share on X">
        <i class="fa-brands fa-x-twitter text-sm"></i>
    </button>
</div>

</div>
    </div>
</section>
    <?php endwhile; ?>




        <!-- DEV NOTE:  INTERGARATE THIS PART WHEN PART 2 COMES OUT -->
        
        <!-- <section>
            <h2 class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-6">
                Past Broadcasts
            </h2>
            <div class="space-y-4">
                
                <div class="bg-gray-900/40 hover:bg-gray-900 rounded-xl p-5 border border-gray-900 hover:border-gray-800 transition shadow-md flex flex-col md:flex-row md:items-center justify-between gap-6 group">
                    <div class="flex items-start gap-4 max-w-2xl">
                        <div class="w-12 h-12 rounded-lg bg-gray-900 flex items-center justify-center text-gray-500 shrink-0 mt-1 font-mono text-xs font-bold border border-gray-800 group-hover:border-[#dc3545]/40 group-hover:text-[#dc3545] transition-all">
                            E4
                        </div>
                        <div>
                            <div class="flex items-center gap-2 text-xs font-medium text-gray-600 mb-1">
                                <span>Season 1</span>
                                <span>&bull;</span>
                                <time>May 08, 2026</time>
                            </div>
                            <h3 class="text-lg font-bold text-white group-hover:text-[#dc3545] transition cursor-pointer">
                                Database Migrations & Multi-user Environments
                            </h3>
                            <p class="text-gray-400 text-sm mt-1 line-clamp-1">
                                Reviewing the recent normalization steps, foreign key cascade strategies, and locking issues experienced under team concurrency tests.
                            </p>
                        </div>
                    </div>
                    
                    <div class="shrink-0 flex items-center gap-4 bg-gray-950 px-4 py-2.5 rounded-xl border border-gray-900/60 w-full md:w-auto md:min-w-[180px] justify-between md:justify-start">
                        <button class="podcast-btn w-9 h-9 rounded-full bg-gray-800 flex items-center justify-center text-gray-200 hover:bg-[#dc3545] hover:text-white transition transform active:scale-95 shadow-sm shrink-0" data-episode="ep4">
                            <i class="fa-solid fa-play ml-0.5 text-sm btn-icon"></i>
                        </button>
                        <div class="text-right md:text-left">
                            <p class="text-xs font-medium text-gray-400">Listen</p>
                            <span class="text-xs font-mono text-gray-500 block">19:45</span>
                        </div>
                        <audio id="ep4" src="path/to/your/audio-file-4.mp3" preload="none"></audio>
                    </div>
                </div>

                <div class="bg-gray-900/40 hover:bg-gray-900 rounded-xl p-5 border border-gray-900 hover:border-gray-800 transition shadow-md flex flex-col md:flex-row md:items-center justify-between gap-6 group">
                    <div class="flex items-start gap-4 max-w-2xl">
                        <div class="w-12 h-12 rounded-lg bg-gray-900 flex items-center justify-center text-gray-500 shrink-0 mt-1 font-mono text-xs font-bold border border-gray-800 group-hover:border-[#dc3545]/40 group-hover:text-[#dc3545] transition-all">
                            E3
                        </div>
                        <div>
                            <div class="flex items-center gap-2 text-xs font-medium text-gray-600 mb-1">
                                <span>Season 1</span>
                                <span>&bull;</span>
                                <time>Apr 24, 2026</time>
                            </div>
                            <h3 class="text-lg font-bold text-white group-hover:text-[#dc3545] transition cursor-pointer">
                                Initializing Git Workflow & Repository Strategy
                            </h3>
                            <p class="text-gray-400 text-sm mt-1 line-clamp-1">
                                Setting standard branch policies, dealing with merge conflicts effectively, and structuring our main staging deployment pipelines.
                            </p>
                        </div>
                    </div>
                    
                    <div class="shrink-0 flex items-center gap-4 bg-gray-950 px-4 py-2.5 rounded-xl border border-gray-900/60 w-full md:w-auto md:min-w-[180px] justify-between md:justify-start">
                        <button class="podcast-btn w-9 h-9 rounded-full bg-gray-800 flex items-center justify-center text-gray-200 hover:bg-[#dc3545] hover:text-white transition transform active:scale-95 shadow-sm shrink-0" data-episode="ep3">
                            <i class="fa-solid fa-play ml-0.5 text-sm btn-icon"></i>
                        </button>
                        <div class="text-right md:text-left">
                            <p class="text-xs font-medium text-gray-400">Listen</p>
                            <span class="text-xs font-mono text-gray-500 block">26:10</span>
                        </div>
                        <audio id="ep3" src="path/to/your/audio-file-3.mp3" preload="none"></audio>
                    </div>
                </div>

            </div>
        </section> -->

    </main>

    <?php include_once __DIR__ . '/../../components/page_specific_components/podcast_page/footer_podcast_page.inc.php'; ?>
    
    <script src="https://cdn.tailwindcss.com"></script>
<script src="../../assets/JS/play_podcast_audio.js?v=2.0.0"></script>
<script src="../../assets/JS/podcast_progress_bar.js"></script>
<script src="../../assets/JS/podcast_share_url.js"></script>
</body>
</html>