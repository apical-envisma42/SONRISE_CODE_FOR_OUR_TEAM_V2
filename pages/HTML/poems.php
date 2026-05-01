
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Son-Rise | Blog</title>
    <link rel="shortcut icon" href="./../../assets/Logos/sonrise.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/CSS/blog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<?php require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php' ?>


<!-- SEARCH BAR -->
<section class="search-section">

    <h1>Explore Our Poems & Stories</h1>

    <div class="search-container">
        <i class="fa-solid fa-magnifying-glass"></i>

        <input 
            type="text" 
            id="searchBar" 
            placeholder="Find the perfect genre..."
            onkeyup="searchPoems()"
        >
    </div>

</section>


<!-- BLOG CARDS -->
<section class="blog-container" id="SECTION_POEMS">

    <div class="blog-card poem-card" data-genre="love">
        <img src="../../assets/Images/POEMS_IMAGES/Love_at_sea.jpg" alt="Love Poetry">

        <div class="blog-content">
            <span class="genre">Love</span>
            <h2>I Sat At The Sea</h2>
            <p>
                I sat at the sea, where the waves kissed the shore,
                A love so deep, I couldn't ask for more.
                The sun dipped low, painting the sky with gold,
                In that moment, our love story was told.
                At the shore-line a legacy to behold.
                The love strong and bold, forever to be retold.
            </p>
            <br>

            <small>By Jeremiah Osei • Published on April 15, 2026</small>
        </div>
    </div>


    <div class="blog-card poem-card" data-genre="sad">
        <img src="../../assets/Images/POEMS_IMAGES/Broken_clock.jpg" alt="Sad Story">

        <div class="blog-content">
            <span class="genre">Sad</span>
            <h2>Broken Clock</h2>
            <p>
                A broken clock on the wall, frozen in time,
                A symbol of a love that once was mine.
                The hands no longer move, the ticking ceased,
                A reminder of a love that has been released.
            </p>
            <br>
            <small>By Gideon Akomea Preprah • Published on March 20, 2026</small>
        </div>
    </div>


    <div class="blog-card poem-card" data-genre="nature">
        <img src="../../assets/Images/POEMS_IMAGES/rain.jpg" alt="Nature Poem">

        <div class="blog-content">
            <span class="genre">Nature</span>
            <h2>Whispers of Rain</h2>
            <p>
                The rain whispers secrets to the earth,
                A symphony of life, a song of rebirth.
                Each drop a story, a tale to be told,
                In the dance of the rain, mysteries unfold.
                The earth drinks deeply, alive and new,
                As raindrops fall, the world renews.
            </p>
            <br>
            <small>By Nana Yaa Obobuea • Published on March 20, 2026</small>
        </div>
    </div>


    <div class="blog-card poem-card" data-genre="fantasy">
        <img src="../../assets/Images/POEMS_IMAGES/moon_light.jpg" alt="Fantasy Story">

        <div class="blog-content">
            <span class="genre">Fantasy</span>
            <h2>Moonlight Dreams</h2>
            <p>
                Under the moonlight, dreams take flight,
                A world of magic, a realm of light.
                Stars whisper secrets in the night,
                Guiding us through the endless sky.
                In moonlight's embrace, we find our way,
                To a land where dreams forever stay.
            </p>
            <br>
            <small>By Jasmine Asiedu • Published on March 20, 2026</small>
        </div>
    </div>

</section>


<!-- SCRIPT -->
<script src="./../../assets/JS/search_poems.js"></script>

</body>
</html>
