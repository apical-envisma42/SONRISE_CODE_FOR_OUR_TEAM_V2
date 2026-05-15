// function openPoem(card) {
//     const modal = document.getElementById("poemModal");
//     const modalBody = document.getElementById("modalBody");
//     const modalImgContainer = document.getElementById("modalImageContainer");
    
//     // 1. Clear previous content
//     modalImgContainer.innerHTML = "";
//     modalBody.innerHTML = "";

//     // 2. Handle Image
//     const cardImg = card.querySelector("img");
//     if (cardImg) {
//         const newImg = document.createElement("img");
//         newImg.src = cardImg.src;
//         modalImgContainer.appendChild(newImg);
//     }
    
//     // 3. Data Extraction
//     const titleText = card.querySelector("h2").textContent;
//     const poemText = card.querySelector(".blog-content p").textContent;
//     const authorText = card.querySelector("small").textContent;

//     // 4. Building the View
//     // Create Title
//     const titleElement = document.createElement("h2");
//     titleElement.className = "modal-poem-title";
//     titleElement.textContent = titleText;
//     modalBody.appendChild(titleElement);

//     // Create Poem Wrapper
//     const wrapper = document.createElement("div");
//     wrapper.className = "poem-wrapper";

//     const poemElement = document.createElement("div");
//     poemElement.className = "poem-content-area";
//     poemElement.textContent = poemText.trim(); 
    
//     wrapper.appendChild(poemElement);
//     modalBody.appendChild(wrapper);

//     // Create Author Footer
//     const authorElement = document.createElement("div");
//     authorElement.className = "modal-poem-author";
//     authorElement.textContent = authorText;
//     modalBody.appendChild(authorElement);
    
//     // 5. Show Modal
//     modal.style.display = "flex";
//     document.body.style.overflow = "hidden"; 

//     // --- STREAK LOGIC (REFINED) ---
//     const today = new Date().toDateString();
//     let count = parseInt(localStorage.getItem('sr_streak')) || 0;
//     let lastDate = localStorage.getItem('sr_lastDate');

//     // Prevent multiple increases in a single day
//     if (lastDate !== today) {
//         if (lastDate) {
//             const last = new Date(lastDate);
//             const curr = new Date(today);
//             // Calculate difference in full days
//             const dayDiff = Math.floor((curr - last) / (1000 * 60 * 60 * 24));
            
//             if (dayDiff === 1) {
//                 // Continued the streak
//                 count++;
//             } else if (dayDiff > 1) {
//                 // Missed a day: Restart at 1
//                 count = 1;
//             }
//         } else {
//             // First time ever: Start at 1
//             count = 1;
//         }

//         // Save data
//         localStorage.setItem('sr_streak', count);
//         localStorage.setItem('sr_lastDate', today);
//         console.log("Streak updated to: " + count);
//     } else {
//         console.log("Streak already logged for today.");
//     }
// }

// // Modal Closing Logic
// function closeModal() {
//     document.getElementById("poemModal").style.display = "none";
//     document.body.style.overflow = "auto";
// }

// document.querySelector(".close-modal").onclick = closeModal;

// window.addEventListener('click', function(event) {
//     const poemModal = document.getElementById("poemModal");
//     if (event.target === poemModal) {
//         closeModal();
//     }
// });





// function openPoem(card) {
//     const modal = document.getElementById("poemModal");
//     const modalBody = document.getElementById("modalBody");
//     const modalImgContainer = document.getElementById("modalImageContainer");
    
//     // 1. Clear previous content
//     modalImgContainer.innerHTML = "";
//     modalBody.innerHTML = "";

//     // 2. Handle Image
//     const cardImg = card.querySelector("img");
//     if (cardImg) {
//         const newImg = document.createElement("img");
//         newImg.src = cardImg.src;
//         modalImgContainer.appendChild(newImg);
//     }
    
//     // 3. Data Extraction
//     const titleText = card.querySelector("h2").textContent;
//     const poemText = card.querySelector(".blog-content p").textContent;
//     const authorText = card.querySelector("small").textContent;
//     // Extract the slug from the data-slug attribute
//     const poemSlug = card.getAttribute('data-slug');

//     // 4. Building the View
//     // Create Title
//     const titleElement = document.createElement("h2");
//     titleElement.className = "modal-poem-title";
//     titleElement.textContent = titleText;
//     modalBody.appendChild(titleElement);

//     // Create Poem Wrapper
//     const wrapper = document.createElement("div");
//     wrapper.className = "poem-wrapper";

//     const poemElement = document.createElement("div");
//     poemElement.className = "poem-content-area";
//     poemElement.textContent = poemText.trim(); 
    
//     wrapper.appendChild(poemElement);
//     modalBody.appendChild(wrapper);

//     // Create Author Footer
//     const authorElement = document.createElement("div");
//     authorElement.className = "modal-poem-author";
//     authorElement.textContent = authorText;
//     modalBody.appendChild(authorElement);
    
//     // 5. Show Modal and Update URL
//     modal.style.display = "flex";
//     document.body.style.overflow = "hidden"; 

//     // Update the URL to include the slug using the ?poem= format
//     if (poemSlug) {
//         const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?poem=' + poemSlug;
//         window.history.pushState({path: newUrl}, '', newUrl);
//     }

//     // --- STREAK LOGIC (REFINED) ---
//     const today = new Date().toDateString();
//     let count = parseInt(localStorage.getItem('sr_streak')) || 0;
//     let lastDate = localStorage.getItem('sr_lastDate');

//     if (lastDate !== today) {
//         if (lastDate) {
//             const last = new Date(lastDate);
//             const curr = new Date(today);
//             const dayDiff = Math.floor((curr - last) / (1000 * 60 * 60 * 24));
            
//             if (dayDiff === 1) {
//                 count++;
//             } else if (dayDiff > 1) {
//                 count = 1;
//             }
//         } else {
//             count = 1;
//         }

//         localStorage.setItem('sr_streak', count);
//         localStorage.setItem('sr_lastDate', today);
//         console.log("Streak updated to: " + count);
//     } else {
//         console.log("Streak already logged for today.");
//     }
// }

/**
 * Opens the poem modal with a dual-tab system (Poem & Analysis)
 */
/**
 * Opens the poem modal with an integrated Literary Analysis toggle
 * and automated streak tracking for Son-Rise.
 */
/**
 * Opens the primary Poem Modal
 */
function openPoem(card) {
    const modal = document.getElementById("poemModal");
    const modalBody = document.getElementById("modalBody");
    const modalImgContainer = document.getElementById("modalImageContainer");
    
    // 1. Clear previous content and restore Image Logic
    if (modalImgContainer) {
        modalImgContainer.innerHTML = "";
        const cardImg = card.querySelector("img");
        if (cardImg) {
            const newImg = document.createElement("img");
            newImg.src = cardImg.src;
            newImg.style.width = "100%";
            newImg.style.borderRadius = "8px";
            newImg.style.marginBottom = "20px";
            modalImgContainer.appendChild(newImg);
        }
    }

    // 2. Extract Data
    const title = card.querySelector("h2").textContent;
    const content = card.querySelector(".blog-content p").innerHTML;
    const author = card.querySelector("small").textContent;
    // FIX: Define the slug variable so the URL logic works
    const poemSlug = card.getAttribute('data-slug'); 

    // 3. Inject Poem
    modalBody.innerHTML = `
        <h2 class="modal-poem-title">${title}</h2>
        <div class="poem-wrapper">${content}</div>
        <div class="modal-poem-author">${author}</div>
        
        <div class="analysis-trigger-box" style="margin-top: 30px; text-align: center; color:#dc3545">
             <a href="#" class="analysis-toggle-link" onclick="openAnalysisModal(event)">
                <i class="fa-solid fa-magnifying-glass-chart"></i> Open Detailed Analysis
            </a>
        </div>
    `;

    modal.style.display = "flex";
    document.body.style.overflow = "hidden";

    // 4. URL Slug Logic (Now fixed because poemSlug is defined above)
    if (poemSlug) {
        const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?poem=' + poemSlug;
        window.history.pushState({path: newUrl}, '', newUrl);
    }

    updateStreak();
}

/**
 * Opens the NEW Secondary Analysis Modal
 */
function openAnalysisModal(e) {
    e.preventDefault();
    const analysisModal = document.getElementById("analysisModal");
    const analysisContent = document.getElementById("analysisContent");

    analysisContent.innerHTML = `
        <div class="stanza-block">
            <h4 style="color: #dc3545;">Stanza 1</h4>
            <p class="stanza-quote"><em>"I wander around / On the warm summer ground..."</em></p>
            <p>The opening immediately introduces movement and instability through the verb “wander.” The diction suggests aimlessness and emotional searching. The contrast between the "warm summer ground" and the question “when will I have fun?” reveals inner unhappiness despite outward beauty.</p>
        </div>

        <div class="stanza-block">
            <h4 style="color: #dc3545;">Stanza 2</h4>
            <p class="stanza-quote"><em>"I’m always working / And giving glory..."</em></p>
            <p>The phrase “giving glory” suggests sacrifice or devotion to others while neglecting oneself. The speaker longs for “my own story,” symbolizing a desire for identity and recognition.</p>
        </div>

        <div class="stanza-block">
            <h4 style="color: #dc3545;">Stanza 3</h4>
            <p class="stanza-quote"><em>"I shiver beneath the moon / On a cold winter night..."</em></p>
            <p>The shift from summer to winter reflects emotional transition. Winter now symbolizes loneliness and suffering, intensifying the melancholy atmosphere.</p>
        </div>

        <div class="stanza-block">
            <h4 style="color: #dc3545;">Stanza 4</h4>
            <p class="stanza-quote"><em>"“What didn’t I do right?”"</em></p>
            <p>This isolated line visually emphasizes loneliness and self-doubt. The diction is painfully simple, making the emotion feel genuine and universal.</p>
        </div>

        <div class="stanza-block">
            <h4 style="color: #dc3545;">Stanza 5</h4>
            <p class="stanza-quote"><em>"If I do die of this “abandoning”..."</em></p>
            <p>The word “abandoning” personifies abandonment as something destructive enough to kill. The stanza transforms suffering into spiritual reflection.</p>
        </div>

        <div class="stanza-block">
            <h4 style="color: #dc3545;">Final Couplet</h4>
            <p class="stanza-quote"><em>"And then I’ll talk to the others / Who also had bad mothers."</em></p>
            <p>Ending with “bad mothers” reveals the root of the speaker’s pain. The poem closes with vulnerability and emotional honesty.</p>
    `;

    analysisModal.style.display = "flex";
}

function closeAnalysisModal() {
    document.getElementById("analysisModal").style.display = "none";
}

function updateStreak() {
    const today = new Date().toDateString();
    let count = parseInt(localStorage.getItem('sr_streak')) || 0;
    let lastDate = localStorage.getItem('sr_lastDate');

    if (lastDate !== today) {
        if (lastDate) {
            const last = new Date(lastDate);
            const curr = new Date(today);
            const dayDiff = Math.floor((curr - last) / (1000 * 60 * 60 * 24));
            if (dayDiff === 1) count++; else if (dayDiff > 1) count = 1;
        } else { count = 1; }
        localStorage.setItem('sr_streak', count);
        localStorage.setItem('sr_lastDate', today);
    }
}

function closeModal() {
    const modal = document.getElementById("poemModal");
    modal.style.display = "none";
    document.body.style.overflow = "auto";
    const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.pushState({path: cleanUrl}, '', cleanUrl);
}

// Global Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    const closeBtn = document.querySelector(".close-modal");
    if (closeBtn) closeBtn.onclick = closeModal;

    // UPDATED: Background click to close both modals
    window.onclick = function(event) {
        const poemModal = document.getElementById("poemModal");
        const analysisModal = document.getElementById("analysisModal");
        
        if (event.target === poemModal) closeModal();
        if (event.target === analysisModal) closeAnalysisModal();
    };

    const urlParams = new URLSearchParams(window.location.search);
    const poemSlugFromUrl = urlParams.get('poem');
    if (poemSlugFromUrl) {
        const targetCard = document.querySelector(`.poem-card[data-slug="${poemSlugFromUrl}"]`);
        if (targetCard) openPoem(targetCard);
    }
});