<?php require_once __DIR__ . '/../../components/universal_components/head_home.inc.php' ?>
<head>
    <link rel="canonical" href="https://sonrise.infinityfree.me/pages/HTML/poems.php" />
</head>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Lora:ital,wght@0,400;0,500;1,400&family=Inter:wght@400;500&display=swap" rel="stylesheet">
<?php require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; ?>

<style>
.modal-tabs {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.tab-btn {
    background: none;
    border: none;
    padding: 10px 5px;
    font-weight: 700;
    cursor: pointer;
    color: #555;
    transition: 0.3s;
}

.tab-btn.active {
    color: #dc3545; 
    border-bottom: 2px solid #dc3545;
}

.analysis-section {
    margin-bottom: 20px;
}

.analysis-section h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    color: #111;
    margin-bottom: 8px;
}

.analysis-tag {
    display: inline-block;
    background: rgba(220, 53, 69, 0.05);
    color: #dc3545;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    margin: 4px;
    font-weight: 500;
}

.analysis-wrapper {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid rgba(0,0,0,0.05);
    text-align: center;
}

.btn-analysis-toggle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #dc3545;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    padding: 10px 20px;
    border: 1px solid transparent;
}

.btn-analysis-toggle:hover {
    color: #111;
    letter-spacing: 1.5px;
}

.analysis-content-area {
    margin-top: 20px;
    text-align: left;
    background: rgba(0, 0, 0, 0.02);
    padding: 45px;
    border-radius: 8px;
    border-left: 3px solid #dc3545;
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.analysis-modal-theme {
    width: 85% !important; 
    max-width: 950px !important; 
    max-height: 85vh;
    overflow-y: auto;
    padding: 40px !important;
    background: #fff;
    border-radius: 12px;
    position: relative;
}
@media (max-width: 768px) {
    .analysis-modal-theme {
        width: 95% !important; 
        padding: 20px !important;
        max-height: 90vh;
    }
}

.share-container {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    padding-top: 10px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.share-btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f4f4f4;
    color: #555;
    font-size: 0.9rem;
}

.share-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.share-btn.copy:hover { background: #dc3545; color: #fff; }
.share-btn.whatsapp:hover { background: #25D366; color: #fff; }
.share-btn.twitter:hover { background: #000; color: #fff; }
.share-btn.email:hover { background: #444; color: #fff; }

.share-btn i.fa-check {
    animation: scaleIn 0.3s ease;
}

@keyframes scaleIn {
    from { transform: scale(0); }
    to { transform: scale(1); }
}

.close-modal {
    position: sticky;
    z-index: 10000;
    left: 100%;
    margin: -18px;
    color: #dc3545;
    font-size: 45px;
}

.close-modal:hover {
    animation: rotateclosemodal 3000ms linear infinite alternate;
}

@keyframes rotateclosemodal {
    0% {
        transform: scale(1.0);
        transform: rotate(0deg);
    }
    100% {
        transform: scale(1.15);
        transform: rotate(360deg);
    }
}

.sr-maintenance-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(22, 3, 5, 0.75); 
    backdrop-filter: blur(5px);          
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 99999; 
}

.sr-maintenance-card {
    background-color: #ffffff;
    padding: 28px 24px 24px 24px;
    border-radius: 12px;
    box-shadow: 0 15px 35px rgba(220, 53, 69, 0.2); 
    border-top: 4px solid #dc3545; 
    max-width: 380px; 
    position: relative;
    text-align: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: srPopIn 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.sr-maintenance-close-x {
    position: absolute;
    top: 12px;
    right: 16px;
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: #aaaaaa;
    transition: color 0.2s;
    line-height: 1;
}

.sr-maintenance-close-x:hover {
    color: #dc3545; 
}

.sr-maintenance-title-area h3 {
    margin-top: 0;
    margin-bottom: 14px;
    color: #dc3545; 
    font-size: 1.35rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.sr-maintenance-message-area p {
    color: #495057;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 8px;
}

.sr-maintenance-appreciation {
    font-weight: 600;
    color: #111111; 
    margin-top: 14px;
}

.sr-maintenance-action-area {
    margin-top: 22px;
}

.sr-maintenance-confirm-btn {
    background-color: #dc3545; 
    color: #ffffff;
    border: none;
    padding: 11px 24px;
    font-size: 0.95rem;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s, transform 0.1s;
    width: 100%; 
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.sr-maintenance-confirm-btn:hover {
    background-color: #bd2130; 
}

.sr-maintenance-confirm-btn:active {
    transform: scale(0.98); 
}

@keyframes srPopIn {
    from {
        opacity: 0;
        transform: scale(0.92);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

<?php
$show_maintenance_modal = isset($_GET['check_maintenance']) && $_GET['check_maintenance'] === 'active_maintenance';
?>

<?php if ($show_maintenance_modal): ?>
<div id="srMaintenanceOverlay" class="sr-maintenance-backdrop">
    <div class="sr-maintenance-card">
        <button class="sr-maintenance-close-x" onclick="dismissMaintenanceNotice()">&times;</button>
        <div class="sr-maintenance-title-area">
            <h3>SONRISE Update</h3>
        </div>
        <div class="sr-maintenance-message-area">
            <p>We just completed a brief system maintenance to improve your experience.</p>
            <p class="sr-maintenance-appreciation">Thank you for your patience and cooperation!</p>
        </div>
        <div class="sr-maintenance-action-area">
            <button class="sr-maintenance-confirm-btn" onclick="dismissMaintenanceNotice()">Continue</button>
        </div>
    </div>
</div>
<?php endif; ?>

<section class="search-section">
    <h1>Explore Our Poems & Stories</h1>
    <div class="search-container">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="searchBar" placeholder="Find the perfect Poem through 𝗚𝗲𝗻𝗿𝗲, 𝗔𝘂𝘁𝗵𝗼𝗿 & 𝗧𝗶𝘁𝗹𝗲..." onkeyup="searchPoems()">
    </div>
</section>

<section class="blog-container" id="SECTION_POEMS">

<?php
global $dbconn;

$sql = "SELECT id, poem_title, poem_slug, poem_genre, poem_author, poem_image, poem_content, created_at FROM poems ORDER BY id DESC";
$result = mysqli_query($dbconn, $sql);

if ($result && mysqli_num_rows($result) > 0):
while ($row = mysqli_fetch_assoc($result)): 
        $publishDate = date("F j, Y", strtotime($row['created_at']));
        $current_id = $row['id'];
        
        $full_poem_content = xss_protect($row['poem_content']);
        
        $preview_content = xss_protect(substr(strip_tags($row['poem_content']), 0, 150)) . "...";

        // Fetch analysis logic
        $analysis_data = [];
        $analysis_sql = "SELECT stanza_title, stanza_quote, analysis_text FROM poem_analysis WHERE poem_id = ? ORDER BY stanza_number ASC";
        $stmt = mysqli_prepare($dbconn, $analysis_sql);
        mysqli_stmt_bind_param($stmt, "i", $current_id);
        mysqli_stmt_execute($stmt); 
        $ana_result = mysqli_stmt_get_result($stmt);
        
            if ($ana_result) {
            while($a_row = mysqli_fetch_assoc($ana_result)) {
                $analysis_data[] = [
                    'stanza_title' => xss_protect($a_row['stanza_title']),
                    'stanza_quote' => xss_protect($a_row['stanza_quote']),
                    'analysis_text' => xss_protect($a_row['analysis_text'])
                ];
            }
        }
        
        
        $json_raw_string = json_encode($analysis_data, JSON_UNESCAPED_UNICODE);
        if ($json_raw_string === false) {
            $json_raw_string = json_encode([]);
        }
?>

    <div class="blog-card poem-card" 
         data-genre="<?= xss_protect($row['poem_genre']); ?>" 
         data-slug="<?= xss_protect($row['poem_slug']); ?>" 
         data-analysis="<?= htmlspecialchars($json_raw_string, ENT_QUOTES, 'UTF-8'); ?>" 
         onclick="openPoem(this)">


        
        <div class="full-poem-hidden" style="display:none;"><?= xss_protect($full_poem_content); ?></div>

        <div class="blog-img">
            <img src="../../assets/poem_uploaded_images/<?= xss_protect($row['poem_image']); ?>" alt="<?= xss_protect($row['poem_title']); ?>">
        </div>

        

        <div class="blog-content">
            <div class="card-top-row">
                <span class="genre"><?= xss_protect($row['poem_genre'] ?? 'Genre'); ?></span>
                </div>
<div class="share-wrapper">
                <span class="share-label" style="color: #dc3545; font-size:15px;">SHARE THIS PIECE</span>

    <div class="share-container">
        <button class="share-btn copy" title="Copy Link" onclick="event.stopPropagation(); copyPoemLink('<?= xss_protect($row['poem_slug']); ?>', this)">
            <i class="fa-solid fa-link"></i>
        </button>
        <button class="share-btn whatsapp" title="Share on WhatsApp" onclick="event.stopPropagation(); shareWhatsApp('<?= xss_protect($row['poem_slug']); ?>', '<?= xss_protect($row['poem_title']); ?>')">
            <i class="fa-brands fa-whatsapp"></i>
        </button>
        <button class="share-btn twitter" title="Share on X" onclick="event.stopPropagation(); shareTwitter('<?= xss_protect($row['poem_slug']); ?>', '<?= xss_protect($row['poem_title']); ?>')">
            <i class="fa-brands fa-x-twitter"></i>
        </button>
        <button class="share-btn email" title="Share via Email" onclick="event.stopPropagation(); shareGmail('<?= xss_protect($row['poem_slug']); ?>', '<?= xss_protect($row['poem_title']); ?>')">
            <i class="fa-solid fa-envelope"></i>
        </button>
    </div>
</div><br>
            <h2><?= xss_protect($row['poem_title']); ?></h2>

            
            <p><?= nl2br($full_poem_content); ?></p>

            <span class="read-more-text"><strong>READ MORE <i class="fa-solid fa-chevron-right"></strong></i></span>
            <br><br>
            <small>By <?= xss_protect($row['poem_author']); ?> • Published on <?= xss_protect($publishDate); ?></small>
            <br>
            <small style="color: #dc3545;">Click To Read More</small>
        </div>
    </div>

<?php endwhile; ?>


<?php  ?>
<?php else: ?>
    <div id="noResults" style="display: block;">
        <i class="fa-solid fa-magnifying-glass"></i>
        <p>No poems have been published yet.</p>
    </div>
<?php endif; ?>

<div id="poemModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" style="color: #dc3545; font-size: 45px;">&times;</span>
        <div id="modalImageContainer"></div> 
        <div id="modalBody"></div>
        <div class="analysis-wrapper">
            <div id="modalAnalysis" style="display: none; text-align: left; margin-top: 15px; padding: 15px; background: #f9f9f9; border-left: 3px solid #dc3545;"></div>
        </div>
    </div>
</div>

<div id="analysisModal" class="modal-overlay" style="z-index: 2000;">
    <div class="modal-content analysis-modal-theme">
        <span class="close-analysis" onclick="closeAnalysisModal()" style="color: #dc3545; float: right; cursor: pointer; font-size: 28px; font-weight: bold;">&times;</span>
        <div class="analysis-header">
            <h2 style="font-family: 'Playfair Display', serif; color: #111;">Stanza-by-Stanza Analysis</h2>
            <hr style="border: 0; height: 1px; background: #eee; margin: 15px 0;">
        </div>
        <div id="analysisContent" class="analysis-scroll-body"></div>
        <div style="text-align: center; margin-top: 20px;">
            <button onclick="closeAnalysisModal()" class="btn-profile" style="background: #111; color: #fff; padding: 10px 25px; border-radius: 50px; cursor: pointer;">
                Return to Poem
            </button>
        </div>
    </div>
</div>

</section>

<?php require_once __DIR__ . '/../../components/universal_components/footer.inc.php' ?>

<script src="./../../assets/JS/search_poems.js"></script>
<script src="./../../assets/JS/open_poem.js"></script>
<script src="../../assets/JS/copy_and_share_link.js"></script>
<script>
    function dismissMaintenanceNotice() {
    const noticeOverlay = document.getElementById('srMaintenanceOverlay');
    if (noticeOverlay) {
        noticeOverlay.style.display = 'none';
        
        if (window.history.replaceState) {
            const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.replaceState({ path: cleanUrl }, '', cleanUrl);
        }
    }
}
</script>
</body>
</html>