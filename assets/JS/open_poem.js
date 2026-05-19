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
/**
 * Global variable to store the analysis of the poem currently being viewed.
 * This is populated every time openPoem() is called.
 */
let currentAnalysisData = [];


function openPoem(card) {
    const modal = document.getElementById("poemModal");
    const modalBody = document.getElementById("modalBody");
    const modalImgContainer = document.getElementById("modalImageContainer");
    
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

    const title = card.querySelector("h2").textContent;
    const content = card.querySelector(".blog-content p").innerHTML;
    const author = card.querySelector("small").textContent;
    const poemSlug = card.getAttribute('data-slug'); 

   
    const rawAnalysis = card.getAttribute('data-analysis');
    currentAnalysisData = rawAnalysis ? JSON.parse(rawAnalysis) : [];

    modalBody.innerHTML = `
        <h2 class="modal-poem-title">${title}</h2>
        <div class="poem-wrapper">${content}</div>
        <div class="modal-poem-author">${author}</div>
        
        <div class="analysis-trigger-box" style="margin-top: 30px; text-align: center;">
             <a href="#" class="analysis-toggle-link" style="color:#dc3545; font-weight: bold; text-decoration: none;" onclick="openAnalysisModal(event)">
                <i class="fa-solid fa-magnifying-glass-chart"></i> Open Detailed Analysis
            </a>
        </div>
    `;

    modal.style.display = "flex";
    document.body.style.overflow = "hidden";

    if (poemSlug) {
        const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?poem=' + poemSlug;
        window.history.pushState({path: newUrl}, '', newUrl);
    }

    updateStreak();
}

function openAnalysisModal(e) {
    e.preventDefault();
    const analysisModal = document.getElementById("analysisModal");
    const analysisContent = document.getElementById("analysisContent");

    analysisContent.innerHTML = "";

    if (currentAnalysisData.length === 0) {
        analysisContent.innerHTML = `
            <div style="text-align:center; padding: 20px; color: #666;">
                <p>Detailed analysis for this poem is coming soon!</p>
            </div>`;
    } else {
        // Build the analysis blocks dynamically from the currentAnalysisData array
        currentAnalysisData.forEach(item => {
            analysisContent.innerHTML += `
                <div class="stanza-block" style="margin-bottom: 25px;">
                    <h4 style="color: #dc3545;">${item.stanza_title}</h4>
                    <p class="stanza-quote"><em>"${item.stanza_quote}"</em></p>
                    <p>${item.analysis_text}</p>
                </div>
            `;
        });
    }

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
        } else { 
            count = 1; 
        }
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

document.addEventListener('DOMContentLoaded', () => {
    const closeBtn = document.querySelector(".close-modal");
    if (closeBtn) closeBtn.onclick = closeModal;

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