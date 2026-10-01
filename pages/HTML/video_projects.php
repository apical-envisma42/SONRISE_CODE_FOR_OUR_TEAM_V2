<?php 
require_once __DIR__ . '/../../components/universal_components/head_home.inc.php';
require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; 

// Array for additional videos. Leave empty [] to trigger the "None available" state, or add videos here.
$additional_videos = [
    /*
    [
        'embed_url'   => 'https://www.youtube.com/embed/ELy-1BE2FZU',
        'title'       => 'Video Project 1',
        'category'    => 'English Assignment',
        'description' => 'Short description or summary accompanying this video project.',
        'author'      => 'SonRise Author'
    ]
    */
];
?>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

<style>
    /* Hero Section */
    .video-hero {
        text-align: center;
        padding: 50px 20px 30px;
        background: #ffffff;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        width: 100%;
        box-sizing: border-box;
    }

    .video-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 2.8rem);
        color: #111111;
        margin-bottom: 10px;
        line-height: 1.2;
    }

    .video-hero p.subtitle {
        font-family: 'Inter', sans-serif;
        color: #6c757d;
        font-size: clamp(0.95rem, 2vw, 1.1rem);
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.5;
    }

    .video-container-wrapper {
        width: 100%;
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        box-sizing: border-box;
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
        width: 100%;
        box-sizing: border-box;
    }

    .featured-video-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.4rem, 3vw, 1.8rem);
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
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 4px;
        text-transform: uppercase;
        margin-bottom: 10px;
        letter-spacing: 0.5px;
    }

    .video-details h3 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.25rem, 2.5vw, 1.5rem);
        color: #111;
        margin-bottom: 10px;
    }

    .video-details p {
        font-family: 'Inter', sans-serif;
        color: #555;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    /* Grid Section & Headings */
    .grid-heading {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.4rem, 3vw, 1.8rem);
        color: #111;
        margin-bottom: 25px;
        border-left: 4px solid #dc3545;
        padding-left: 12px;
    }

    .video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        width: 100%;
        box-sizing: border-box;
    }

    .video-card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,0.08);
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        width: 100%;
        box-sizing: border-box;
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

    /* Empty State Container */
    .no-videos-box {
        text-align: center;
        padding: 50px 20px;
        background: #ffffff;
        border: 1px dashed rgba(220, 53, 69, 0.3);
        border-radius: 12px;
        color: #6c757d;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        width: 100%;
        box-sizing: border-box;
    }

    .no-videos-box i {
        font-size: 2.5rem;
        color: #dc3545;
        margin-bottom: 15px;
    }

    .no-videos-box p {
        font-size: 1.05rem;
        margin: 0;
        font-weight: 500;
    }

    /* Media Queries for Mobile Responsiveness */
    @media screen and (max-width: 992px) {
        .video-container-wrapper {
            margin: 30px auto;
        }
    }

    @media screen and (max-width: 768px) {
        .video-hero {
            padding: 40px 15px 25px;
        }

        .video-container-wrapper {
            padding: 0 15px;
        }
        
        .featured-video-section {
            padding: 18px;
            margin-bottom: 35px;
        }

        .video-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    @media screen and (max-width: 480px) {
        .featured-video-section {
            padding: 12px;
            border-radius: 8px;
        }

        .video-card .card-body {
            padding: 15px;
        }

        .no-videos-box {
            padding: 35px 15px;
        }
    }
</style>

<main class="video-page">
    <section class="video-hero">
        <h1>Video Showcase & Media Projects</h1>
        <p class="subtitle">Explore multimedia presentations, video assignments, and creative visual projects from the SonRise platform.</p>
    </section>

    <div class="video-container-wrapper">
        
        <!-- Featured Spotlight Video -->
        <section class="featured-video-section">
            <h2>Featured Performance</h2>
            
            <div class="video-frame">
                <iframe 
                    src="https://www.youtube.com/embed/ELy-1BE2FZU" 
                    title="SonRise Featured Performance" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
                </iframe>
            </div>

            <div class="video-details">
                <span class="video-tag">PROJECT ON ADVERTISING</span>
                <h3>ADVERTISMENT ENGLISH VIDEO PROJECT</h3>
                <p>
                    An engaging English language presentation exploring persuasive techniques, media messaging, and creative advertising concepts. This visual project demonstrates structured storytelling and rhetorical strategies applied to modern commercial media.
                </p>
                <small style="color: #dc3545; font-weight: bold;">Performed for SONRISE</small>
            </div>
        </section>

        <!-- Video Grid Section with Fallback -->
        <section class="video-grid-section">
            <h2 class="grid-heading">More Video Projects</h2>
            
            <?php if (!empty($additional_videos)): ?>
                <div class="video-grid">
                    <?php foreach ($additional_videos as $video): ?>
                        <div class="video-card">
                            <div class="video-frame">
                                <iframe 
                                    src="<?= xss_protect($video['embed_url']); ?>" 
                                    title="<?= xss_protect($video['title']); ?>" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <div class="card-body">
                                <span class="video-tag"><?= xss_protect($video['category']); ?></span>
                                <h4><?= xss_protect($video['title']); ?></h4>
                                <p><?= xss_protect($video['description']); ?></p>
                                <small>By <span style="color: #dc3545; font-weight:bold;"><?= xss_protect($video['author']); ?></span></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- Empty State Placeholder when no additional videos exist -->
                <div class="no-videos-box">
                    <i class="fa-solid fa-film"></i>
                    <p>No additional video projects available at the moment. Stay tuned for new releases!</p>
                </div>
            <?php endif; ?>
        </section>

    </div>
</main>

<?php require_once __DIR__ . '/../../components/universal_components/footer.inc.php'; ?>

</body>
</html>