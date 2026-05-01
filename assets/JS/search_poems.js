function searchPoems() {
    let input = document.getElementById("searchBar").value.toLowerCase();

    let poems = document.querySelectorAll(".poem-card");

    poems.forEach(function(poem) {

        let genre = poem.getAttribute("data-genre");

        if (genre.includes(input)) {
            poem.style.display = "block";
        } else {
            poem.style.display = "none";
        }

    });
}