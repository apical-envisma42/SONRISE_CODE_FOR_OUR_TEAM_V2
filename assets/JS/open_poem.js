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





function openPoem(card) {
    const modal = document.getElementById("poemModal");
    const modalBody = document.getElementById("modalBody");
    const modalImgContainer = document.getElementById("modalImageContainer");
    
    // 1. Clear previous content
    modalImgContainer.innerHTML = "";
    modalBody.innerHTML = "";

    // 2. Handle Image
    const cardImg = card.querySelector("img");
    if (cardImg) {
        const newImg = document.createElement("img");
        newImg.src = cardImg.src;
        modalImgContainer.appendChild(newImg);
    }
    
    // 3. Data Extraction
    const titleText = card.querySelector("h2").textContent;
    const poemText = card.querySelector(".blog-content p").textContent;
    const authorText = card.querySelector("small").textContent;
    // Extract the slug from the data-slug attribute
    const poemSlug = card.getAttribute('data-slug');

    // 4. Building the View
    // Create Title
    const titleElement = document.createElement("h2");
    titleElement.className = "modal-poem-title";
    titleElement.textContent = titleText;
    modalBody.appendChild(titleElement);

    // Create Poem Wrapper
    const wrapper = document.createElement("div");
    wrapper.className = "poem-wrapper";

    const poemElement = document.createElement("div");
    poemElement.className = "poem-content-area";
    poemElement.textContent = poemText.trim(); 
    
    wrapper.appendChild(poemElement);
    modalBody.appendChild(wrapper);

    // Create Author Footer
    const authorElement = document.createElement("div");
    authorElement.className = "modal-poem-author";
    authorElement.textContent = authorText;
    modalBody.appendChild(authorElement);
    
    // 5. Show Modal and Update URL
    modal.style.display = "flex";
    document.body.style.overflow = "hidden"; 

    // Update the URL to include the slug using the ?poem= format
    if (poemSlug) {
        const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?poem=' + poemSlug;
        window.history.pushState({path: newUrl}, '', newUrl);
    }

    // --- STREAK LOGIC (REFINED) ---
    const today = new Date().toDateString();
    let count = parseInt(localStorage.getItem('sr_streak')) || 0;
    let lastDate = localStorage.getItem('sr_lastDate');

    if (lastDate !== today) {
        if (lastDate) {
            const last = new Date(lastDate);
            const curr = new Date(today);
            const dayDiff = Math.floor((curr - last) / (1000 * 60 * 60 * 24));
            
            if (dayDiff === 1) {
                count++;
            } else if (dayDiff > 1) {
                count = 1;
            }
        } else {
            count = 1;
        }

        localStorage.setItem('sr_streak', count);
        localStorage.setItem('sr_lastDate', today);
        console.log("Streak updated to: " + count);
    } else {
        console.log("Streak already logged for today.");
    }
}

// --- NEW SLUG AUTO-LOADER FUNCTION ---
// This checks the URL on page load and opens the correct poem
window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const poemSlugFromUrl = urlParams.get('poem'); // Checks for ?poem=slug

    if (poemSlugFromUrl) {
        // Look for the card in your poems.php loop that has this specific data-slug
        const targetCard = document.querySelector(`.poem-card[data-slug="${poemSlugFromUrl}"]`);
        
        if (targetCard) {
            // Automatically trigger your existing openPoem function
            openPoem(targetCard);
        }
    }
});

// --- UPDATED CLOSE LOGIC ---

function closeModal() {
    const modal = document.getElementById("poemModal");
    modal.style.display = "none";
    document.body.style.overflow = "auto";
    
    // Clear URL slug back to clean version
    const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.pushState({path: cleanUrl}, '', cleanUrl);
}

// Ensure the close button listener is attached
document.addEventListener('DOMContentLoaded', () => {
    const closeBtn = document.querySelector(".close-modal");
    if (closeBtn) {
        closeBtn.onclick = closeModal;
    }

    // Background click to close
    window.onclick = function(event) {
        const modal = document.getElementById("poemModal");
        if (event.target === modal) {
            closeModal();
        }
    };

    // Auto-loader for slugs in URL
    const urlParams = new URLSearchParams(window.location.search);
    const poemSlugFromUrl = urlParams.get('poem');

    if (poemSlugFromUrl) {
        const targetCard = document.querySelector(`.poem-card[data-slug="${poemSlugFromUrl}"]`);
        if (targetCard) {
            openPoem(targetCard);
        }
    }
});