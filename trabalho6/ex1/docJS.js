window.onload = function () {
    const pegah2 = document.querySelectorAll("h2");
    for (let subtitulo of pegah2) {
        subtitulo.addEventListener("click", function () {
            subtitulo.nextElementSibling.style.display = "none";
        });
        subtitulo.addEventListener("dblclick", function () {
            subtitulo.nextElementSibling.style.display = "block";
        });
    }
}

