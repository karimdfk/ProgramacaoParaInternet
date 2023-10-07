window.onload = function () {
    const txtinteresse = document.querySelector("#textoInteresse");
    txtinteresse.addEventListener("keyup", e => {
        if (e.key === "Enter") {
            adicionaInteresse();
        }
    })
}

function adicionaInteresse() {
    const txtinteresse = document.querySelector("#textoInteresse");
    const lista = document.querySelector("ol");

    const novoLI = document.createElement("li");
    const novoButton = document.createElement("button");
    const novoSpan = document.createElement("span");

    novoSpan.textContent = txtinteresse.value;
    novoButton.textContent = "✖";

    novoLI.appendChild(novoSpan);
    novoLI.appendChild(novoButton);
    lista.appendChild(novoLI);

    novoButton.onclick = function () {
        novoLI.remove();
    }

    txtinteresse.value = "";
}
