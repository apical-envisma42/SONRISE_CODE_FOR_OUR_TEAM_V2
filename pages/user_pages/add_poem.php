<?php 
require_once __DIR__ . '/../../components/universal_components/head_home.inc.php'; 

if(!check_logged_in()):
    header("Location: " . BASE_URL . "/API/OAUTH/google_oauth/index.php?page_denied=denied_access_Add_poem");
    exit();
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
        <form action="../../site_logic/add_poem/add_poem_logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token']) ?>">
            
            <!-- Standard Form Grid Layout Section -->
            <div class="form-grid-two">
                <!-- Poem Title Component -->
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

                <!-- Genre Selector Section Container -->
                <div class="sr-form-group">
                    <label for="poem_genre_select">Genre / Mood</label>
                    <select id="poem_genre_select" name="poem_genre" required class="sr-select" onchange="handleGenreSwitch(this)">
                        <option value="" disabled selected>Select Category</option>
                        <option value="Gothic Thriller">Gothic Thriller</option>
                        <option value="Romance">Romance</option>
                        <option value="Love">Love</option>
                        <option value="Sad">Sad</option>
                        <option value="Nature">Nature</option>
                        <option value="OTHER_CUSTOM">Other (Create Custom Genre...)</option>
                    </select>

                    <!-- Hidden Custom Input Group Area -->
                    <div id="customGenreWrapper" style="display: none; margin-top: 15px; transition: all 0.3s ease;">
                        <label for="custom_genre_input" style="font-size: 0.75rem; color: #555;">Enter Custom Genre Name</label>
                        <input 
                            type="text" 
                            id="custom_genre_input" 
                            name="custom_genre" 
                            class="sr-input" 
                            placeholder="e.g., Sci-Fi Poetry, Haiku" 
                            maxlength="50"
                        >
                    </div>
                </div>
            </div>

            <!-- Poem Body Area Container -->
            <div class="sr-form-group">
                <label for="poem_content">The Verses</label>
                <textarea 
                    id="poem_content" 
                    name="poem_content" 
                    required 
                    placeholder="Type or paste your piece here. Stanza line-breaks are preserved naturally..." 
                    class="sr-textarea"
                ><?= xss_protect($_POST['poem_content'] ?? '') ?></textarea>
            </div>

            <!-- Image File Upload Dropzone Component -->
            <div class="sr-form-group">
                <label>Companion Background Artwork</label>
                <div class="file-drop-area" id="dropArea">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span id="fileMessage">Drag & drop your visual inspiration artwork here or click to browse</span>
                    <input type="file" name="poem_image" id="poem_image" accept="image/*" class="file-input" required>
                </div>
            </div>

            <!-- Form Interaction Control Triggers -->
            <div class="submit-action-row">
                <a href="<?= xss_protect(BASE_URL); ?>/HTML/poems.php" class="btn-cancel">Cancel and Return</a>
                <button type="submit" class="btn-submit-poem">Publish Piece</button>
            </div>
        </form>
    </div>

</main>

<script>
function handleGenreSwitch(selectElement) {
    const customWrapper = document.getElementById('customGenreWrapper');
    const customInput = document.getElementById('custom_genre_input');
    
    if (selectElement.value === 'OTHER_CUSTOM') {
        customWrapper.style.display = 'block';
        customInput.setAttribute('required', 'required');
        customInput.focus();
    } else {
        customWrapper.style.display = 'none';
        customInput.removeAttribute('required');
        customInput.value = '';
    }
}

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