<?php

require "../../sessao/sessionVerification.php";
session_start();
exitWhenNotLoggedIn();

require "../../conexaoMysql.php";
$pdo = mysqlConnect();

try {
    $sql = <<<SQL
    SELECT nome
    FROM categoria
    SQL;
  
    // Neste exemplo não é necessário utilizar prepared statements
    // porque não há a possibilidade de injeção de SQL, 
    // pois nenhum parâmetro do usuário é utilizado na query SQL. 
    // Além disso, como há resultados a serem processados, 
    // utilizamos o método query (e não o exec).
    $stmt = $pdo->query($sql);
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }
  

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <header>
        <h1>Mirage</h1>
        <img src="../../img/logo.png" id="logo" alt="logo" width="80px" height="80px" class="logo">
    </header>


    <nav>
        <section>
            <ul>
                <li><a href="../../sessao/index.php">Home</a></li>
                <li><a href="../listaAnuncios/listaAnuncios.php">Meus Anuncios</a></li>
                <li><a href="../../usuario/atualizar/atualizarCadastro.php">Atualizar Dados</a></li>
                <li><a href="../../interesse/mostraInteresse.php">Interesse</a></li>
                <li><a href="../../sessao/logout.php">Logout</a></li>
            </ul>
        </section>
    </nav>

    <main class="container">
        <h2 style="text-align: center; margin-bottom: 20px;">Criar um anúncio</h2>
        <form action="anuncio.php" method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" id="titulo" class="form-control" name="titulo">
                </div>
                <div class="col-9">
                    <label for="descricao" class="form-label">Descricao</label>
                    <input type="text" id="descricao" class="form-control" name="descricao">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="preco" class="form-label">Preco</label>
                    <input type="text" id="preco" class="form-control" name="preco">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" id="cep" class="form-control" name="cep">
                </div>
                <div class="col-sm-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" id="bairro" class="form-control" name="bairro">
                </div>
                <div class="col-sm-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" id="cidade" class="form-control" name="cidade">
                </div>
                <div class="col-sm-3">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" id="estado" class="form-control" name="estado">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label for="imagem" class="form-label">Imagem</label>
                    <input type="file" id="imagem" class="form-control" name="imagem" accept="image/*" multiple>
                </div>
                <div class="col-sm-6">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select id="categoria" class="form-select" name="categoria">
                        <option selected>Selecione</option>
                        <?php
                            while ($row = $stmt->fetch()) {

                                $nome = htmlspecialchars($row['nome']);
                                                              
                                echo <<<HTML
                                <option value="$nome">$nome</option>    
                                HTML;
                            }
                            ?>
                    </select>
                </div>
            </div>


            <button id="btnAnuncio" class="btn btn-danger btn-sm" style="margin-top: 15px; background-color: #c24b59;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                </svg>
                Cadastrar
            </button>

        </form>

    </main>


    <footer>
        <address>Av. João Naves de Ávila, Santa Mônica, Uberlândia</address>
    </footer>


    <script>
        function buscaEndereco(cep) {
      
            if (cep.length != 9) return;      
            let bairroInput = document.querySelector("#bairro");
            let cidadeInput = document.querySelector("#cidade");
            let estadoInput = document.querySelector("#estado");
            
            fetch("completaCEP.php?cep=" + cep)
                .then(response => {
                if (!response.ok) {
                    throw new Error(response.status);
                    // return Promise.reject(response.status); // outra opção
                }

                // Requisição finalizada com sucesso e o servidor
                // retornou um código de status de sucesso (200-299). 
                // O método json() faz a leitura dos dados de forma 
                // assíncrona e converte para um objeto JS. Qdo essa 
                // operação finalizar com sucesso, a função de callback
                // do próximo then receberá o resultado e será executada.
                return response.json(); // Atenção para o 'return' aqui
                })
                .then(CEP => {
                // utiliza os dados para preencher o formulário
                bairroInput.value = CEP.bairro;
                cidadeInput.value = CEP.cidade;
                estadoInput.value = CEP.estado;
                })
                .catch(error => {
                // Ocorreu um erro na comunicação com o servidor ou
                // no processamento da requisição no PHP, que pode não
                // ter retornado uma string JSON válida.
                console.error('Falha inesperada: ' + error);
                });
    }

    window.onload = function () {
      const inputCep = document.querySelector("#cep");
      inputCep.onkeyup = () => buscaEndereco(inputCep.value);
    }
    </script>
    

</body>

</html>