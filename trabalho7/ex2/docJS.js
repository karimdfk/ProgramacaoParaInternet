window.onload = function () {
    document.forms.formContato.onsubmit = validaForm;//Acessa o formulario e indica a função que vai tratar o form
}

function validaForm(x) {
    let form = x.target;//Acesso ao objeto do form
    let formValido = true;

    if (form.nomeContato.value === "") {//Se o campo do formulario em quetao estiver vazio, aparece uma mensagem no span indicando o que deve ser feito e formValido passa para falso
        formValido = false;
    }

    if (form.emailContato.value === "") {
        formValido = false;
    }

    if (form.mensagemContato.value === "") {
        formValido = false;
    }

    if (!formValido) {//confere se o formulario é valido, senão a função preventDefault impede que o form seja enviado
        x.preventDefault();
    }
    else {
        const escondeModal = document.getElementById("meuModal");
        escondeModal.style.visibility = "hidden";
    }
}