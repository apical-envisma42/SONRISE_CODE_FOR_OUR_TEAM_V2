<?php require_once __DIR__ . '/../../components/universal_components/head_home.inc.php' ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Lora:ital,wght@0,400;0,500;1,400&family=Inter:wght@400;500&display=swap" rel="stylesheet">
<?php require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; ?>

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
        FROM poems 
        ORDER BY created_at DESC";

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
        <!-- Image space inside the modal -->
        <div id="modalImageContainer"></div> 
        <div id="modalBody">
            <!-- Poem text injected here -->
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
