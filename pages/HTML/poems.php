<?php require_once __DIR__ . '/../../components/universal_components/head_home.inc.php' ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Lora:ital,wght@0,400;0,500;1,400&family=Inter:wght@400;500&display=swap" rel="stylesheet">
<?php require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; ?>
<style>
    /* Analysis Modal Styling */
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
    color: #dc3545; /* Crimson Red */
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

/* Styled to look like a clean anchor tag button */
.btn-analysis-toggle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #dc3545; /* Your brand red */
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
/* Analysis Modal - Responsive Sizing */
.analysis-modal-theme {
    width: 85% !important; /* Large on Desktop */
    max-width: 950px !important; 
    max-height: 85vh;
    overflow-y: auto;
    padding: 40px !important;
    background: #fff;
    border-radius: 12px;
    position: relative;
}

/* Mobile Adjustments */
@media (max-width: 768px) {
    .analysis-modal-theme {
        width: 95% !important; /* Smaller margins for phones */
        padding: 20px !important;
        max-height: 90vh;
    }
    
    .stanza-block p {
        font-size: 0.95rem;
    }
}
</style>
<!-- SEARCH BAR -->
<section class="search-section">

    <h1>Explore Our Poems & Stories</h1>

    <div class="search-container">
        <i class="fa-solid fa-magnifying-glass"></i>

        <input 
            type="text" 
            id="searchBar" 
            placeholder="Find the perfect Poem through 𝗚𝗲𝗻𝗿𝗲, 𝗔𝘂𝘁𝗵𝗼𝗿 & 𝗧𝗶𝘁𝗹𝗲..."
            onkeyup="searchPoems()"
        >
    </div>

</section>
<!-- BLOG CARDS -->
<section class="blog-container" id="SECTION_POEMS">

<?php
global $dbconn;

$sql = "SELECT poem_title, poem_slug, poem_genre, poem_author, poem_image, poem_content, created_at 
        FROM poems ";

$result = mysqli_query($dbconn, $sql);

if ($result && mysqli_num_rows($result) > 0):
    while ($row = mysqli_fetch_assoc($result)): 
        $publishDate = date("F j, Y", strtotime($row['created_at']));
?>

<div class="blog-card poem-card" 
     data-genre="<?= xss_protect($row['poem_genre']); ?>" 
     data-slug="<?= xss_protect($row['poem_slug']); ?>" 
     onclick="openPoem(this)">
    
    <img src="<?= xss_protect($row['poem_image']); ?>" alt="<?= xss_protect($row['poem_title']); ?>">

    <div class="blog-content">
        <div class="card-top-row">
            <span class="genre"><?= xss_protect($row['poem_genre']); ?></span>
            <div class="share-actions" onclick="event.stopPropagation();">
                <button title="Copy Link" onclick="copyPoemLink('<?= xss_protect($row['poem_slug']); ?>', this)"><i class="fa-solid fa-link"></i></button>
                <button title="Share on WhatsApp" onclick="shareWhatsApp('<?= xss_protect($row['poem_slug']); ?>', '<?= xss_protect($row['poem_title']); ?>')"><i class="fa-brands fa-whatsapp"></i></button>
                <button title="Share on Facebook" onclick="shareFacebook('<?= xss_protect($row['poem_slug']); ?>')"><i class="fa-brands fa-facebook-f"></i></button>
                
                <button title="Gmail" onclick="shareGmail('<?= xss_protect($row['poem_slug']); ?>', '<?= xss_protect($row['poem_title']); ?>')"><i class="fa-solid fa-envelope"></i></button>        
              </div>
        </div>

        <h2><?= xss_protect($row['poem_title']); ?></h2>

        <p><?= nl2br(xss_protect($row['poem_content'])); ?></p>

        <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
        <br><br>

        <small>By <?= xss_protect($row['poem_author']); ?> • Published on <?= xss_protect($publishDate); ?></small>
    </div>
</div>

<?php 
    endwhile; 
else: 
?>
    <div id="noResults" style="display: block;">
        <i class="fa-solid fa-magnifying-glass"></i>
        <p>No poems have been published yet.</p>
    </div>
<?php 
endif; 
?>

<!-- POEM MODAL OVERLAY -->
<div id="poemModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" style="color: #dc3545;">&times;</span>
        
        <div id="modalImageContainer"></div> 
        
        <div id="modalBody"></div>

        <div class="analysis-wrapper" style="margin-top: 20px; text-align: center;">
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

        <div id="analysisContent" class="analysis-scroll-body">
            </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <button onclick="closeAnalysisModal()" class="btn-profile" style="background: #111; color: #fff; padding: 10px 25px; border-radius: 50px; cursor: pointer;">
                Return to Poem
            </button>
        </div>
    </div>
</div>
</section>

<?php require_once __DIR__ . '/../../components/universal_components/footer.inc.php' ?>

<!-- SCRIPT -->
<script src="./../../assets/JS/search_poems.js"></script>
<script src="./../../assets/JS/open_poem.js"></script>
<script src="../../assets/JS/copy_and_share_link.js"></script>

</body>
</html>
