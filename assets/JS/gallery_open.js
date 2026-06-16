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

/**
 * Launches the lightbox gallery view.
 * Expects the triggering element containing data attributes.
 * @param {HTMLElement} element - The .media-box element clicked
 */
function launchLightbox(element) {
    // 1. Pull data safely from the custom HTML data attributes
    const imgSrc = element.getAttribute('data-img');
    const title = element.getAttribute('data-title');
    const description = element.getAttribute('data-poem');

    const lightbox = document.getElementById('galleryLightbox');
    const targetDesc = document.getElementById('lightboxTargetDesc');
    
    // 2. Assign text and image src to target layout nodes
    document.getElementById('lightboxTargetImage').src = imgSrc;
    document.getElementById('lightboxTargetTitle').textContent = title;
    
    // 3. Render poem line breaks properly
    // Setting CSS white-space to 'pre-line' guarantees HTML treats \n breaks like a poem.
    targetDesc.style.whiteSpace = 'pre-line';
    targetDesc.textContent = description;
    
    // 4. Reveal UI Lightbox modal components
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden'; 
}

function dismissLightbox() {
    const lightbox = document.getElementById('galleryLightbox');
    lightbox.classList.remove('active');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        dismissLightbox();
    }
});