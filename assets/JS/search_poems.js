function searchPoems() {
    let input = document.getElementById("searchBar").value;
    let noResults = document.getElementById("noResults");
    
    let sanitizedInput = input.replace(/<[^>]*>?/gm, '').toLowerCase().trim();
    let poems = document.querySelectorAll(".poem-card");
    
    let visibleCount = 0; 

    poems.forEach(function(poem) {
        let genre = poem.getAttribute("data-genre").toLowerCase();
        let title = poem.querySelector("h2").textContent.toLowerCase();
        let author = poem.querySelector("small").textContent.toLowerCase();

        if (
            genre.includes(sanitizedInput) || 
            title.includes(sanitizedInput) || 
            author.includes(sanitizedInput)
        ) {
            poem.style.display = "block";
            visibleCount++; 
        } else {
            poem.style.display = "none";
        }
    });

    if (visibleCount === 0) {
        noResults.style.display = "flex";
    } else {
        noResults.style.display = "none";
    }
}