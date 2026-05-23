<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Son-Rize | Gallery</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- Core Layout & Global Variables --- */
        :root {
            --crimson-brand: #dc3545;
            --crimson-hover: #b21f2d;
            --dark-charcoal: #111111;
            --light-bg: #fdfdfd;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            --transition-smooth: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* --- Hero Header & Navigation Filter Elements --- */
        .gallery-hero {
            text-align: center;
            padding: 60px 20px 40px 20px;
            background: linear-gradient(180deg, rgba(220, 53, 69, 0.02) 0%, rgba(255,255,255,0) 100%);
        }

        .gallery-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: var(--dark-charcoal);
            margin: 0 0 15px 0;
            font-weight: 700;
        }

        .gallery-hero p {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 30px auto;
            line-height: 1.6;
        }

        .filter-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .filter-btn {
            background: #fff;
            border: 1px solid rgba(220, 53, 69, 0.15);
            color: var(--dark-charcoal);
            padding: 10px 24px;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 30px;
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .filter-btn:hover, 
        .filter-btn.active {
            background: var(--crimson-brand);
            color: #fff;
            border-color: var(--crimson-brand);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
            transform: translateY(-2px);
        }

        /* --- Portfolio Responsive Grid Layout --- */
        .gallery-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 80px 20px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
        }

        .gallery-item {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0, 0, 0, 0.03);
            transition: var(--transition-smooth);
        }

        .gallery-item.hidden {
            display: none;
        }

        .gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(220, 53, 69, 0.12);
        }

        .media-box {
            position: relative;
            width: 100%;
            height: 260px;
            overflow: hidden;
            background-color: #f4f4f4;
            cursor: pointer;
        }

        .media-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition-smooth);
        }

        .gallery-item:hover .media-box img {
            transform: scale(1.06);
        }

        .media-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(0deg, rgba(17, 17, 17, 0.7) 0%, rgba(17, 17, 17, 0) 60%);
            opacity: 0;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            transition: var(--transition-smooth);
            box-sizing: border-box;
        }

        .gallery-item:hover .media-overlay {
            opacity: 1;
        }

        .overlay-view-btn {
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .item-details {
            padding: 22px;
        }

        .item-category {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--crimson-brand);
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 6px;
        }

        .item-details h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--dark-charcoal);
            margin: 0 0 8px 0;
            font-weight: 700;
        }

        .item-details p {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0;
        }

        /* --- Empty Query Feedback --- */
        #galleryNoResults {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            display: none;
        }

        #galleryNoResults i {
            font-size: 3rem;
            color: var(--crimson-brand);
            margin-bottom: 15px;
        }

        /* --- Premium Crimson Lightbox Overlay --- */
        .lightbox-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 15, 20, 0.96); /* Deep near-black background text viewport */
            z-index: 4000;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            transition: opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-sizing: border-box;
        }

        .lightbox-overlay.active {
            display: flex;
            opacity: 1;
        }

        .lightbox-content {
            position: relative;
            max-width: 85vw;
            max-height: 85vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: scale(0.92);
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .lightbox-overlay.active .lightbox-content {
            transform: scale(1);
        }

        .lightbox-image-wrapper {
            background: #1a1a1a;
            border-radius: 12px;
            padding: 8px;
            border: 1px solid rgba(220, 53, 69, 0.25); /* Crimson core glowing border outline frame */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 30px rgba(220, 53, 69, 0.15);
            max-width: 100%;
            overflow: hidden;
            box-sizing: border-box;
        }

        .lightbox-content img {
            max-width: 100%;
            max-height: 62vh;
            display: block;
            border-radius: 8px;
            object-fit: contain;
        }

        /* Circular Action Close Control Button */
        .lightbox-close {
            position: absolute;
            top: -23px;
            right: -23px;
            background: #fff;
            color: #111;
            border: 2px solid var(--crimson-brand);
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 4100;
        }

        .lightbox-close:hover {
            background: var(--crimson-brand);
            color: #fff;
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 0 20px rgba(220, 53, 69, 0.6);
        }

        /* Glassmorphic Presentation Card Description Shell */
        .lightbox-caption-card {
            margin-top: 20px;
            background: rgba(26, 26, 26, 0.85);
            border-left: 4px solid var(--crimson-brand); /* Brand Identifier Accent Left Line */
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            border-right: 1px solid rgba(255, 255, 255, 0.07);
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            padding: 20px 25px;
            border-radius: 0 10px 10px 0;
            width: 100%;
            max-width: 650px;
            box-sizing: border-box;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.4);
            text-align: left;
        }

        .lightbox-caption-card h4 {
            font-family: 'Playfair Display', serif;
            color: #fff;
            margin: 0 0 6px 0;
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .lightbox-caption-card p {
            color: #b3b3b3;
            font-family: 'Inter', sans-serif;
            margin: 0;
            font-size: 0.92rem;
            line-height: 1.5;
        }

        /* --- Viewport Media Adaptations --- */
        @media (max-width: 768px) {
            .gallery-hero h1 { font-size: 2.2rem; }
            .gallery-grid { grid-template-columns: 1fr; }
            
            .lightbox-content { max-width: 92vw; }
            .lightbox-close {
                top: -15px;
                right: -10px;
                width: 38px;
                height: 38px;
                font-size: 0.95rem;
            }
            .lightbox-caption-card { padding: 15px; max-width: 100%; }
            .lightbox-caption-card h4 { font-size: 1.15rem; }
            .lightbox-caption-card p { font-size: 0.85rem; }
        }
    </style>
</head>
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
                <div class="media-box" onclick="launchLightbox('../../assets/Images/ink_my_mind.jpg', 'Ink My Mind Artwork', 'Visual composition representing creative paralysis and the divine guide.')">
                    <img src="../../assets/Images/ink_my_mind.jpg" alt="Ink My Mind Artwork" loading="lazy">
                    <div class="media-overlay">
                        <span class="overlay-view-btn"><i class="fa-solid fa-expand"></i> Inspect View</span>
                    </div>
                </div>
                <div class="item-details">
                    <span class="item-category">Gothic Thriller</span>
                    <h3>Ink My Mind Artwork</h3>
                    <p>Visual composition representing creative paralysis and the divine guide.</p>
                </div>
            </div>
        
            <div class="gallery-item" data-category="Romance">
                <div class="media-box" onclick="launchLightbox('../../assets/Images/what_is_love.jpg', 'What Is Love Cover', 'Visual conceptual art accompanying the core stanzas of emotional discovery.')">
                    <img src="../../assets/Images/what_is_love.jpg" alt="What Is Love Cover" loading="lazy">
                    <div class="media-overlay">
                        <span class="overlay-view-btn"><i class="fa-solid fa-expand"></i> Inspect View</span>
                    </div>
                </div>
                <div class="item-details">
                    <span class="item-category">Romance</span>
                    <h3>What Is Love Cover</h3>
                    <p>Visual conceptual art accompanying the core stanzas of emotional discovery.</p>
                </div>
            </div>
        
            <div class="gallery-item" data-category="Nature">
                <div class="media-box" onclick="launchLightbox('../../assets/Images/wandering_around.jpg', 'Wandering Around Horizon', 'Atmospheric scenic imagery representing an emotional and aimless search.')">
                    <img src="../../assets/Images/wandering_around.jpg" alt="Wandering Around Horizon" loading="lazy">
                    <div class="media-overlay">
                        <span class="overlay-view-btn"><i class="fa-solid fa-expand"></i> Inspect View</span>
                    </div>
                </div>
                <div class="item-details">
                    <span class="item-category">Nature</span>
                    <h3>Wandering Around Horizon</h3>
                    <p>Atmospheric scenic imagery representing an emotional and aimless search.</p>
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

    <script>
        function filterGallery(category, buttonElement) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            buttonElement.classList.add('active');
            
            const items = document.querySelectorAll('.gallery-item');
            let visibleCount = 0;
            
            items.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                if (category === 'all' || itemCategory === category) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });
            
            const noResults = document.getElementById('galleryNoResults');
            if (visibleCount === 0) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
        }

        function launchLightbox(imgSrc, title, description) {
            const lightbox = document.getElementById('galleryLightbox');
            document.getElementById('lightboxTargetImage').src = imgSrc;
            document.getElementById('lightboxTargetTitle').textContent = title;
            document.getElementById('lightboxTargetDesc').textContent = description;
            
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden'; // Stop background scrolling leakage
        }

        function dismissLightbox() {
            const lightbox = document.getElementById('galleryLightbox');
            lightbox.classList.remove('active');
            document.body.style.overflow = ''; // Release window frame scrolling lock
        }

        // Add physical Esc hotkey trigger support natively
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                dismissLightbox();
            }
        });
    </script>
</body>
</html>