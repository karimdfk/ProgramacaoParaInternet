window.onload = function () {
    const botaoOpen = document.querySelector(".buttonOpen"); //passa para a constante botaoOpen o nó com a classe buttonOpen.
    const botaoClose = document.querySelector(".buttonClose"); //passa para a constante botaoClose o nó com a classe buttonClose.
    const modal = document.querySelector(".modal"); //passa para a constante modal o nó com a classe modal.

    botaoOpen.addEventListener("click", function () { //A função é chamada quando ocorrer um click no elemento com a classe buttonOpen.
        modal.style.display = "block"; //Altera o estilo css do elemento com a classe modal, mudando o atributo display para "block". Esta ação mostrara o conteúdo antes oculto.
    })

    botaoClose.addEventListener("click", function () { //A funç~so é chamada quando ocorrer um click no elemento com a classe buttonClose.
        modal.style.display = "none"; //Altera o estilo css do elemento com a classe modal, mudando o atributo display para "noone". Esta ação removerá novamente o elemento.
    })
}