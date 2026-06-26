<?php 
require_once __DIR__ . '/../../components/universal_components/head_home.inc.php'; 

if(!check_logged_in()):
    header("Location: " . BASE_URL . "/API/OAUTH/google_oauth/index.php?page_denied=denied_access_Add_poem");
endif;

require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; 
?>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Lora:ital,wght@0,400;0,500;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>/assets/CSS/add_poem.css">
<main class="poem-submission-container">
    
    <div class="form-header">
        <h1>Contribute to SonRise</h1>
        <p>Pour your vision into verses. Share your latest work directly into our community anthology.</p>
    </div>

    <div class="submission-card">
        <!-- Form configured to route smoothly to your standard MVC controller folder structure -->
        <form action="../../site_logic/add_poem/add_poem_logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token']) ?>">
            <div class="form-grid-two">
                <!-- Poem Title -->
                <div class="sr-form-group">
                    <label for="poem_title">Poem Title</label>
                    <input 
                        type="text" 
                        id="poem_title" 
                        name="poem_title" 
                        required 
                        placeholder="Enter title..." 
                        class="sr-input"
                        value="<?= xss_protect($_POST['poem_title'] ?? '') ?>"
                    >
                </div>

                <!-- Genre/Mood Selection Matching Card Badges -->
                <div class="sr-form-group">
                    <label for="poem_genre">Genre / Mood</label>
                    <select id="poem_genre" name="poem_genre" required class="sr-select">
                        <option value="" disabled selected>Select Category</option>
                        <option value="Gothic Thriller">Gothic Thriller</option>
                        <option value="Romance">Romance</option>
                        <option value="Love">Love</option>
                        <option value="Sad">Sad</option>
                        <option value="Nature">Nature</option>
                    </select>
                </div>
            </div>

            <!-- Poem Body Area -->
            <div class="sr-form-group">
                <label for="poem_content">The Verses</label>
                <textarea 
                    id="poem_content" 
                    name="poem_content" 
                    required 
                    placeholder="Type or paste your piece here. Stanza line-breaks are preserved naturally..." 
                    class="sr-textarea"
                    value="<?= xss_protect($_POST['poem_content'] ?? '') ?>"
                ></textarea>
            </div>

            <div class="sr-form-group">
                <label>Companion Background ArtworK</label>
                <div class="file-drop-area" id="dropArea">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span id="fileMessage">Drag & drop your visual inspiration artwork here or click to browse</span>
                    <input type="file" name="poem_image" id="poem_image" accept="image/*" class="file-input" value="<?= xss_protect($_FILES['poem_image'] ?? '') ?>" required>
                </div>
            </div>

            <div class="submit-action-row">
                <a href="<?= xss_protect(BASE_URL); ?>/HTML/poems.php" class="btn-cancel">Cancel and Return</a>
                <button type="submit" class="btn-submit-poem">Publish Piece</button>
            </div>
        </form>
    </div>

</main>

<script>
    // Live feedback script for asset uploads
    const fileInput = document.getElementById('poem_image');
    const dropArea = document.getElementById('dropArea');
    const fileMessage = document.getElementById('fileMessage');

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropArea.classList.add('dragover');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
        }, false);
    });

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileMessage.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--crimson-brand)"></i> Selected: <strong>${this.files[0].name}</strong>`;
        }
    });
</script>

<?php require_once __DIR__ . '/../../components/universal_components/footer.inc.php'; ?>