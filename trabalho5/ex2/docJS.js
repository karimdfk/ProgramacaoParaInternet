document.addEventListener("DOMContentLoaded", function () {
    const nodeH1 = document.querySelector("h1");
    nodeH1.addEventListener("click", function () {
        nodeH1.textContent = "Ciclano de Tal"
    })
})

document.addEventListener("DOMContentLoaded", function () {
    const nodeh2 = document.querySelectorAll("h2");
    for (let node of nodeh2) {
        node.addEventListener("click", () => node.textContent = "Obrigado")
    }
})

