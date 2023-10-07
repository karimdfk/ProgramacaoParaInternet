document.addEventListener("DOMContentLoaded", function () {
    const nodeButton = document.querySelector("button");
    nodeButton.addEventListener("click", showMessage);
})

function showMessage(msg) {
    const nodeDiv = document.querySelector("div");
    const nodeForm = document.querySelector("form");
    nodeDiv.textContent = msg;
    nodeDiv.style.visibility = "visible";

    nodeForm.style.visibility = "hidden";
}
