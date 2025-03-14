document.addEventListener("DOMContentLoaded", function () {
    const searchBox = document.getElementById("searchBox");

    searchBox.addEventListener("keyup", function () {
        let query = searchBox.value;
        if (query.length > 2) {
            fetch(`search.php?query=${query}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("searchResults").innerHTML = data;
                });
        }
    });
});