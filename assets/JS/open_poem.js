function openPoem(card) {
    const modal = document.getElementById("poemModal");
    const modalBody = document.getElementById("modalBody");
    const modalImgContainer = document.getElementById("modalImageContainer");
    
    const cardImgSrc = card.querySelector("img").src;
    const cardImgAlt = card.querySelector("img").alt;
    
    const fullContent = card.querySelector(".blog-content").innerHTML;
    
    modalImgContainer.innerHTML = `<img src="${cardImgSrc}" alt="${cardImgAlt}">`;
    modalBody.innerHTML = fullContent;
    
    modal.style.display = "flex";
        modalContent.scrollTop = 0; 
    document.body.style.overflow = "hidden"; 
}

document.querySelector(".close-modal").onclick = closeModal;
window.onclick = function(event) {
    if (event.target == document.getElementById("poemModal")) closeModal();
};

function closeModal() {
    document.getElementById("poemModal").style.display = "none";
    document.body.style.overflow = "auto";
}