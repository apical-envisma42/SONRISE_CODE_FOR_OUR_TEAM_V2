<?php require_once __DIR__ . '/../../components/universal_components/head_home.inc.php';
 require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; 
?>

<style>
    html {
        scroll-behavior: smooth;
    }
    .scroll-btn-container {
        text-align: right; 
        margin-top: 20px;
        width: 100%;
    }
    .scroll-next-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #dc3545;
        color: #ffffff;
        padding: 10px 18px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
        transition: background-color 0.2s ease-in-out, transform 0.2s ease;
    }
    .scroll-next-btn:hover {
        background-color: #bd2130;
        transform: translateY(2px);
    }

    @media screen and (max-width: 768px) {
        .scroll-btn-container {
            text-align: center; 
            margin-top: 30px;  
        }
        .scroll-next-btn {
            width: 80%;         
            justify-content: center;
        }
    }
</style>

<main class="about-page">
    <section class="about-hero">
        <h1>Our Story</h1>
        <p class="subtitle">Bringing the dawn of literature to Ghana and beyond.</p>
    </section>

    <section id="profile-jaden" class="founder-section">
        <div class="founder-container">
            <div class="founder-image">
                <div class="photo-frame">
                    <img src="../../assets/Images/jaden_ag.png" alt="Founder of Son-Rise">
                </div>
            </div>
            
            <div class="founder-text">
                <span class="label" style="font-size: 18px;">MEET THE DEVELOPERS</span>
                <h2>Behind the Verses</h2>
                <p>
                    A platform built for writers requires an equally reliable technical architecture. 
                    Tasked with designing the logic and data structures of SonRise, the focus was to 
                    ensure that every piece of literature, secure user session, and community interaction 
                    runs seamlessly behind the scenes.
                </p>
                <p>
                    By bridging the gap between functional database design and a smooth interface, 
                    this platform provides a modern, high-performance foundation capable of safely hosting 
                    the next generation of exceptional Ghanaian storytellers.
                </p>
                <div class="signature">
                    <p><strong>Jaden William Bubune Agbaga</strong></p>
                    <small><span style="color: #dc3545; font-size: 16px; font-weight:bold;">BACKEND DEVELOPER</span> Of <span style="color: #dc3545; font-size: 16px"><strong>SONRISE</strong></span></small>
                </div>

                <div class="scroll-btn-container">
                    <a href="#profile-jeremiah" class="scroll-next-btn">
                        Next Person &darr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="profile-jeremiah" class="founder-section">
        <div class="founder-container">
            <div class="founder-image">
                <div class="photo-frame">
                    <img src="../../assets/Images/jerry_pic.png" alt="Founder of Son-Rise">
                </div>
            </div>
            
            <div class="founder-text">
                <span class="label">The Visionary</span>
                <h2>Behind the Verses</h2>
                <p>
                    Great literature deserves a visual space that complements its depth. Jeremiah focused 
                    on sculpting an intuitive user journey, crafting the interface of SonRise to feel like a 
                    digital sanctuary where typography, whitespace, and structural harmony elevate the reading experience.
                </p>
                <p>
                    From early wireframes to interactive layouts, every visual choice was designed to ensure 
                    that navigating through creative writing feels effortless, inviting, and memorable for 
                    both creators and readers alike.
                </p>
                <div class="signature">
                    <p><strong>Jeremiah Ayoka Osei</strong></p>
                    <small><span style="color: #dc3545; font-size: 16px; font-weight:bold;">UI/UX DEVELOPER</span> Of <span style="color: #dc3545; font-size: 16px"><strong>SONRISE</strong></span></small>
                </div>

                <div class="scroll-btn-container">
                    <a href="#profile-peprah" class="scroll-next-btn">
                        Next Person &darr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="profile-peprah" class="founder-section">
        <div class="founder-container">
            <div class="founder-image">
                <div class="photo-frame">
                    <img src="../../assets/Images/Mr_Preprah.jpg" alt="Founder of Son-Rise">
                </div>
            </div>
            
            <div class="founder-text">
                <span class="label">The Visionary</span>
                <h2>Behind the Verses</h2>
                <p>
                    Son-Rise was born out of a passion for storytelling and the belief that every 
                    writer deserves a stage. Our mission is to preserve the beauty of Ghanaian 
                    poetry while providing a modern foundation for new voices to rise.
                </p>
                <p>
                    From humble beginnings as a shared project between friends, this platform 
                    now serves as a sanctuary for those who find solace in the written word.
                </p>
                <div class="signature">
                    <p><strong>MR. GIDEON AKOMEA PEPRAH</strong></p>
                    <small>Founder Of <span style="color: #dc3545;"><strong>SONRISE</strong></span></small>
                </div>
                
                <div class="scroll-btn-container">
                    <a href="#profile-jaden" class="scroll-next-btn" style="background-color: #6c757d;">
                        Back to Top &uarr;
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../../components/universal_components/footer.inc.php'; ?>

</body>
</html>