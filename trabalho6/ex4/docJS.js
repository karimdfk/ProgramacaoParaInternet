window.onload = function () {
    document.forms.formContato.onsubmit = validaForm;//Acessa o formulario e indica a função que vai tratar o form
    botoes = document.querySelectorAll("nav button");//Seleciona todos os button filhos de nav
    for (let button of botoes) {//o for percorre todos os button armazenados em "botoes"
        button.addEventListener("click", mudaTab);//aciona a função mudaTab ao clickar em um botão
    }
    openTab(0);//aciona a função openTab passando como parametro 0, esta linha tem como finalidade mostrar o primeiro section logo que a pagina é carregada
}

function mudaTab(e) {
    const buttonAtual = e.target;//Seleciona o button que acionou o evento click
    const buttonLi = buttonAtual.parentNode;//Pega o pai do button selecionado (no caso é um li)
    const nodes = Array.from(buttonLi.parentNode.children);//O parentNode do li é um ol, Esta linha monta um Array com todos os filhos do ol (todos os li) 
    const index = nodes.indexOf(buttonLi);//Pega a posição no Array do li que acionou o evento click
    openTab(index);//aciona a função openTab passando como parametro a posição armazenada no index
}

function openTab(i) {
    const tabActive = document.querySelector(".tabActive");
    if (tabActive !== null)//Caso a section tenha como nome da classe "tabActive"
        tabActive.className = "";//Muda o nome das classes das sections, isto esconde seus conteúdos


    const buttonActive = document.querySelector(".buttonActive");
    if (buttonActive !== null)//Caso 0 button tenha como nome da classe "buttonActive"
        buttonActive.className = "";//Muda o nome das classes dos buttons, isto tira o destaque dado pelo estilo diferente da classe buttonActive


    document.querySelectorAll(".tabs section")[i].className = "tabActive";//muda o nome da classe do section cuja posição foi passada como parametro. Essa clase tem display = "block" e mostra o conteudo do section
    document.querySelectorAll("nav button")[i].className = "buttonActive";//muda o nome da classe do button cuja posição foi passada como parametro. O button terá alterações no estilo para destaque e relação visual com o conteúdo atual
}

function validaForm(x) {
    let form = x.target;//Acesso ao objeto do form
    let formValido = true;

    const spanNome = form.nomeContato.nextElementSibling;//Acesso aos spans de cada campo do formulário
    const spanEmail = form.emailContato.nextElementSibling;
    const spanMsg = form.mensagemContato.nextElementSibling;

    spanNome.textContent = "";//Muda o conteúdo dos spans para vazio
    spanEmail.textContent = "";
    spanMsg.textContent = "";

    if (form.nomeContato.value === "") {//Se o campo do formulario em quetao estiver vazio, aparece uma mensagem no span indicando o que deve ser feito e formValido passa para falso
        spanNome.textContent = "O usuario deve ser preenchido";
        formValido = false;
    }

    if (form.emailContato.value === "") {
        spanEmail.textContent = "O email deve ser preenchido";
        formValido = false;
    }

    if (form.mensagemContato.value === "") {
        spanMsg.textContent = "O campo de mensagem deve ser preenchido";
        formValido = false;
    }

    if (!formValido) {//confere se o formulario é valido, senão a função preventDefault impede que o form seja enviado
        x.preventDefault();
    }
}