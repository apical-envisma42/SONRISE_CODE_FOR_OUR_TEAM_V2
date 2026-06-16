<?php require_once __DIR__ . '/../../components/universal_components/head_home.inc.php';
      require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php';
?>
<link rel="stylesheet" href="../../assets/CSS/gallery.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
<body>

    <section class="gallery-hero">
        <h1>Visual Inspirations</h1>
        <p>Step inside our creative space. Browse conceptual visual artwork tied directly to our dark gothic narratives, thrillers, and deep moving poetry layers.</p>
        
        <div class="filter-container">
            <button class="filter-btn active" onclick="filterGallery('all', this)">Show All</button>
            <button class="filter-btn" onclick="filterGallery('Gothic Thriller', this)">Gothic Thriller</button>
            <button class="filter-btn" onclick="filterGallery('Romance', this)">Romance</button>
            <button class="filter-btn" onclick="filterGallery('Nature', this)">Nature</button>
        </div>
    </section>

    <section class="gallery-wrapper">
        <div class="gallery-grid" id="SONRISE_GALLERY_GRID">
        <div class="gallery-item" data-category="Gothic Thriller">
    <div class="media-box" 
         onclick="launchLightbox(this)" 
         data-img="../../assets/gallery_uploaded_images/depresss_girl.jpeg" 
         data-title="Ink My Mind Artwork" 
         data-poem="I'm just a girl,&#10;That's what they all say.&#10;You'd think my life was easy,&#10;But you'd be wrong that way.&#10;&#10;I cry myself to sleep,&#10;I starve myself to look good.&#10;Underneath my smile lies&#10;A heart misunderstood.&#10;&#10;I truly feel I’m falling,&#10;Slowly torn apart.&#10;I was tricked and left betrayed,&#10;With scars upon my heart.&#10;&#10;My precious fruit was plucked,&#10;I was used and cast away.&#10;I cry through all my nights,&#10;My wrath blurs my sight.&#10;&#10;The pressure keeps increasing&#10;As my joy begins to fade.&#10;I’m supposed to be perfect,&#10;Yet I’m breaking from the weight.&#10;&#10;But what good is being perfect&#10;If my soul is stained with pain?&#10;Does fate delight in breaking me,&#10;And washing hope away like rain?&#10;&#10;I was never one admired,&#10;Just a painting left to fade,&#10;Hung where no one stops to look,&#10;Like a worthless choice once made.&#10;&#10;All my colors have been wasted,&#10;All my beauty turned to dust,&#10;So I kneel alone and pray&#10;That my broken soul still trusts.&#10;&#10;And I pray my life one day&#10;Won’t stay sad and cold and gray.">
        
        <img src="../../assets/gallery_uploaded_images/depresss_girl.jpeg" alt="Ink My Mind Artwork">
        <div class="media-overlay">
            <span class="overlay-view-btn"><i class="fa-solid fa-expand"></i> Inspect View</span>
        </div>
    </div>

    <div class="item-details">
        <span class="item-category">Gothic Thriller</span>
        <h3>Ink My Mind Artwork</h3>
        
        <p>
            I’m just a girl,<br>
            That’s what they all say.<br>
            You’d think my life was easy,<br>
            But you’d be wrong that way.
        </p>

        <p>
            I cry myself to sleep,<br>
            I starve myself to look good.<br>
            Underneath my smile lies<br>
            A heart misunderstood.
        </p>

        <p>
            I truly feel I’m falling,<br>
            Slowly torn apart.<br>
            I was tricked and left betrayed,<br>
            With scars upon my heart.
        </p>

        <p>
            My precious fruit was plucked,<br>
            I was used and cast away.<br>
            I cry through all my nights,<br>
            My wrath blurs my sight.
        </p>

        <p>
            The pressure keeps increasing<br>
            As my joy begins to fade.<br>
            I’m supposed to be perfect,<br>
            Yet I’m breaking from the weight.
        </p>

        <p>
            But what good is being perfect<br>
            If my soul is stained with pain?<br>
            Does fate delight in breaking me,<br>
            And washing hope away like rain?
        </p>

        <p>
            I was never one admired,<br>
            Just a painting left to fade,<br>
            Hung where no one stops to look,<br>
            Like a worthless choice once made.
        </p>

        <p>
            All my colors have been wasted,<br>
            All my beauty turned to dust,<br>
            So I kneel alone and pray&#10;            That my broken soul still trusts.
        </p>

        <p>
            And I pray my life one day<br>
            Won’t stay sad and cold and gray.
        </p>

        <p style="color: #dc3545;">
            Click On Image To Read More
        </p>
    </div>
</div>
          
            </div>
            <div id="galleryNoResults">
                <i class="fa-solid fa-circle-exclamation"></i>
                <p>No media files match this specific classification category.</p>
            </div>
        </div>
    </section>

    <div id="galleryLightbox" class="lightbox-overlay" onclick="dismissLightbox()">
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <button class="lightbox-close" onclick="dismissLightbox()" title="Close Gallery Image">
                <i class="fa-solid fa-xmark"></i>
            </button>
            
            <div class="lightbox-image-wrapper">
                <img id="lightboxTargetImage" src="" alt="View Container">
            </div>
            
            <div class="lightbox-caption-card">
                <h4 id="lightboxTargetTitle"></h4>
                <p id="lightboxTargetDesc"></p>
            </div>
        </div>
    </div>
<?php include_once __DIR__ . '/../../components/universal_components/footer.inc.php'; ?>
<script src="../../assets/JS/gallery_open.js"></script>
</body>
</html>