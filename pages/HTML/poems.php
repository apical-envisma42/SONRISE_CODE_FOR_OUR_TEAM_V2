<?php require_once __DIR__ . '/../../components/universal_components/head_home.inc.php' ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

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

    <div class="blog-card poem-card" data-genre="love" onclick="openPoem(this)">
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
            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>
            <small>By Jeremiah Osei • Published on April 15, 2026</small>
        </div>
    </div>


    <div class="blog-card poem-card" data-genre="sad" onclick="openPoem(this)">
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
            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>
            <small>By Gideon Akomea Preprah • Published on March 20, 2026</small>
        </div>
    </div>


    <div class="blog-card poem-card" data-genre="nature" onclick="openPoem(this)">
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
            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>
            <small>By Nana Yaa Obobuea • Published on March 20, 2026</small>
        </div>
    </div>


    <div class="blog-card poem-card" data-genre="fantasy" onclick="openPoem(this)">
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
            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>
            <small>By Jasmine Asiedu • Published on March 20, 2026</small>
        </div>
    </div>

<div class="blog-card poem-card" data-genre="Horror" onclick="openPoem(this)">
        <img src="../../assets/Images/Horror.jpg" alt="Horror story">

        <div class="blog-content">
            <span class="genre">Horror</span>
            <h2>Shadows in the Night</h2>

            <p>
                In the dead of night, shadows creep,
                A haunting presence, a secret to keep.
                The moon hides behind a veil of clouds,
                As whispers echo through the shrouds.
                Fear takes hold, a chilling embrace,
                In the darkness, we lose our place.
            </p>

            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>

            <small>By Jaden Agbaga • Published on March 20, 2026</small>
        </div>
    </div>


    <div class="blog-card poem-card" data-genre="Adventure" onclick="openPoem(this)">
        <img src="../../assets/Images/Adventure.jpg" alt="Adventure Story">

        <div class="blog-content">
            <span class="genre">Adventure</span>
            <h2>Beyond the Horizon</h2>

            <p>
                Beyond the horizon, where dreams take flight,
                A world of adventure, a realm of light.
                The call of the unknown, a siren's song,
                Guiding us to places where we belong.
                In the heart of adventure, we find our way,
                To a land where dreams forever stay.
            </p>

            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>

            <small>By Gabrielle Obodai • Published on March 20, 2026</small>
        </div>
    </div>


    <div class="blog-card poem-card" data-genre="Love" onclick="openPoem(this)">
        <img src="../../assets/Images/Rose_Garden.jpg" alt="Love Poem">

        <div class="blog-content">
            <span class="genre">Love</span>
            <h2>Roses After Rain</h2>

            <p>
                Beneath the rain, the roses swayed,
                In gentle winds our hearts were laid.
                Your laughter danced like morning light,
                Turning darkest days warm and bright.
                Through every storm, through joy and pain,
                Our love still blooms like roses after rain.
            </p>

            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>

            <small>By Elorm Mensah • Published on April 28, 2026</small>
        </div>
    </div>


    <div class="blog-card poem-card" data-genre="Fantasy" onclick="openPoem(this)">
        <img src="../../assets/Images/mountain.jpg" alt="Fantasy Poem">

        <div class="blog-content">
            <span class="genre">Fantasy</span>
            <h2>The Crystal Kingdom</h2>

            <p>
                Beyond the mountains crowned with snow,
                Lies a kingdom few will know.
                Dragons soar through silver skies,
                While magic sleeps in ancient eyes.
                The crystal towers softly gleam,
                Like fragments of a timeless dream.
            </p>

            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>

            <small>By Ama Serwaa • Published on April 28, 2026</small>
        </div>
    </div>
    

    <div class="blog-card poem-card" data-genre="Sad" onclick="openPoem(this)">
    <img src="../../assets/Images/Library.jpg" alt="Sad Poem">

    <div class="blog-content">
        <span class="genre">Sad</span>
        <h2>The Empty Bench</h2>

        <p>
            Beneath the fading evening light,
            I found the bench where we'd unite.
            The winds now whisper through the trees,
            Carrying echoes meant to tease.
            Though seasons pass and skies may bend,
            I still await a vanished friend.
        </p>

            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>

        <small>By Kofi Annan Mensah • Published on April 30, 2026</small>
    </div>
</div>


<div class="blog-card poem-card" data-genre="Nature" onclick="openPoem(this)">
    <img src="../../assets/Images/nature.jpg" alt="Nature Poem">

    <div class="blog-content">
        <span class="genre">Nature</span>
        <h2>Forest Symphony</h2>

        <p>
            The forest hummed a peaceful tune,
            Beneath the silver light of moon.
            Leaves danced softly in the breeze,
            While rivers sang through ancient trees.
            Nature painted earth with grace,
            A quiet, calm, enchanted place.
        </p>

            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>

        <small>By Akosua Nyamekye • Published on April 30, 2026</small>
    </div>
</div>


<div class="blog-card poem-card" data-genre="Adventure" onclick="openPoem(this)">
    <img src="../../assets/Images/Adventure.jpg" alt="Adventure Poem">

    <div class="blog-content">
        <span class="genre">Adventure</span>
        <h2>Across the Golden Dunes</h2>

        <p>
            Across the dunes beneath the sun,
            Our endless journey had begun.
            Through blazing heat and endless sand,
            We chased the map held in our hand.
            Beyond the storm, beyond the skies,
            Adventure waited where courage lies.
        </p>

        
        <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
        <br><br>


        <small>By Daniel Tetteh • Published on April 30, 2026</small>
    </div>
</div>

<div class="blog-card poem-card" data-genre="Adventure" onclick="openPoem(this)">
    <img src="../../assets/Images/background_images.jpg" alt="Adventure Story">

    <div class="blog-content">
        <span class="genre">Adventure</span>
        <h2>The Last Voyage</h2>

        <p>
            The waves crashed hard against the shore,
            Calling sailors to explore.
            Through raging storms and skies so wide,
            We sailed with fearless hearts and pride.
            Beyond the sea where legends glow,
            Lay hidden lands few souls would know.
        </p>

            <span class="read-more-text">Read More <i class="fa-solid fa-chevron-right"></i></span>
            <br><br>

        <small>By Kojo Baffour • Published on April 30, 2026</small>
    </div>
</div>

</section>


<div id="noResults">
<i class="fa-solid fa-magnifying-glass"></i>
    <p>Poem Not Found</p>
</div>

<!-- POEM MODAL OVERLAY -->
<div id="poemModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <!-- Image space inside the modal -->
        <div id="modalImageContainer"></div> 
        <div id="modalBody">
            <!-- Poem text injected here -->
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../components/universal_components/footer.inc.php' ?>

<!-- SCRIPT -->
<script src="./../../assets/JS/search_poems.js"></script>
<script src="./../../assets/JS/open_poem.js"></script>

</body>
</html>
