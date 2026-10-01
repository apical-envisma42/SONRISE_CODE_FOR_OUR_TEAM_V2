<?php 
require_once __DIR__ . '/../../components/universal_components/head_home.inc.php';
require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; 
?>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

<style>
    html {
        scroll-behavior: smooth;
    }

    .video-hero {
        text-align: center;
        padding: 60px 20px 30px;
        background: #ffffff;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .video-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        color: #111111;
        margin-bottom: 10px;
    }

    .video-hero p.subtitle {
        font-family: 'Inter', sans-serif;
        color: #6c757d;
        font-size: 1.1rem;
        max-width: 650px;
        margin: 0 auto;
    }

    .video-container-wrapper {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Video Aspect Ratio Frame */
    .video-frame {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        height: 0;
        overflow: hidden;
        border-radius: 8px;
        background-color: #000000;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .video-frame iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Featured Section */
    .featured-video-section {
        margin-bottom: 50px;
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.08);
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .featured-video-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: #111111;
        margin-bottom: 20px;
        border-left: 4px solid #dc3545;
        padding-left: 12px;
    }

    .video-details {
        margin-top: 20px;
    }

    .video-details .video-tag {
        display: inline-block;
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        font-weight: 700;
        font-size: 13px;
        padding: 4px 12px;
        border-radius: 4px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .video-details h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: #111;
        margin-bottom: 8px;
    }

    .video-details p {
        font-family: 'Inter', sans-serif;
        color: #555;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Grid Section */
    .grid-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: #111;
        margin-bottom: 25px;
        border-left: 4px solid #dc3545;
        padding-left: 12px;
    }

    .video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .video-card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,0.08);
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .video-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.12);
    }

    .video-card .card-body {
        padding: 20px;
    }

    .video-card h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        color: #111;
        margin-bottom: 8px;
    }

    @media screen and (max-width: 768px) {
        .video-hero h1 {
            font-size: 2.1rem;
        }
        
        .featured-video-section {
            padding: 15px;
        }

        .video-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<main class="video-page">
    <section class="video-hero">
        <h1>Visual & Spoken Verses</h1>
        <p class="subtitle">Experience poetry recitations, stage performances, and visual art directly from the SonRise creators and community.</p>
    </section>

    <div class="video-container-wrapper">
        
        <!-- Featured Spotlight Video -->
        <section class="featured-video-section">
            <h2>Featured Performance</h2>
            
            <div class="video-frame">
                <!-- UPDATED EMBED LINK HERE -->
                <iframe 
                    src="https://www.youtube.com/embed/ELy-1BE2FZU" 
                    title="SonRise Featured Performance" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
                </iframe>
            </div>

            <div class="video-details">
                <span class="video-tag">POETRY RECITATION</span>
                <h3>Featured Recitation Title</h3>
                <p>
                    Add a description for your featured video here. Highlight the themes, author notes, or performers behind this piece.
                </p>
                <small style="color: #dc3545; font-weight: bold;">Performed for SONRISE</small>
            </div>
        </section>

        <!-- Video Grid Section -->
        <section class="video-grid-section">
            <h2 class="grid-heading">More Video Recitations</h2>
            
            <div class="video-grid">

                <!-- Video Card 1 -->
                <div class="video-card">
                    <div class="video-frame">
                        <iframe 
                            src="https://www.youtube.com/embed/ELy-1BE2FZU" 
                            title="Video Recitation 1" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="card-body">
                        <span class="video-tag">Spoken Word</span>
                        <h4>Video Recitation 1</h4>
                        <p>Short description or stanza excerpt accompanying this recitation video.</p>
                        <small>By <span style="color: #dc3545; font-weight:bold;">SonRise Author</span></small>
                    </div>
                </div>

                <!-- Video Card 2 -->
                <div class="video-card">
                    <div class="video-frame">
                        <iframe 
                            src="https://www.youtube.com/embed/ELy-1BE2FZU" 
                            title="Video Recitation 2" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="card-body">
                        <span class="video-tag">Gothic Thriller</span>
                        <h4>Video Recitation 2</h4>
                        <p>Short description or stanza excerpt accompanying this recitation video.</p>
                        <small>By <span style="color: #dc3545; font-weight:bold;">SonRise Author</span></small>
                    </div>
                </div>

                <!-- Video Card 3 -->
                <div class="video-card">
                    <div class="video-frame">
                        <iframe 
                            src="https://www.youtube.com/embed/ELy-1BE2FZU" 
                            title="Video Recitation 3" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="card-body">
                        <span class="video-tag">Behind the Scenes</span>
                        <h4>Video Recitation 3</h4>
                        <p>Short description or stanza excerpt accompanying this recitation video.</p>
                        <small>By <span style="color: #dc3545; font-weight:bold;">SonRise Author</span></small>
                    </div>
                </div>

            </div>
        </section>

    </div>
</main>

<?php require_once __DIR__ . '/../../components/universal_components/footer.inc.php'; ?>

</body>
</html>