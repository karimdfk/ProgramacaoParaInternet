<?php

require "../../sessao/sessionVerification.php";
session_start();
exitWhenNotLoggedIn();

require "../../conexaoMysql.php";
$pdo = mysqlConnect();

?>

<!DOCTYPE html>
<html lang="pt-BR ">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Cadastre-se</title>

    <style>
        #styleMainCadastro {
            max-width: 600px;
            height: 550px;

            background-color: white;
            border-radius: 10px;
            border: 2px solid #f7ceb0;

            margin-top: 50px;
            padding: 40px;

            color: #c24b59;
        }

        .styleInputCadastro {
            box-sizing: border-box;
            width: 100%;
            padding: 7px 0px;
            margin: 15px 0px;
            border: 1px solid #f7ceb0;
        }

        .styleButtonCadastro {
            box-sizing: border-box;
            width: 100%;
            padding: 7px 0px;
            margin: 15px 0px 0px 0px;
            border: 1px solid #f7ceb0;
            background-color: #f6e6da;
            color: #c24b59;
        }

        .styleLabelCadastro {
            font-family: "Helvetica Neue", Helvetica, sans-serif;
            font-size: 16pt;
        }
    </style>
</head>

<body>

    <header>
        <h1>Mirage</h1>
        <img src="../../img/logo.png" id="logo" alt="logo" width="80px" height="80px">
    </header>


    <nav>
        <section>
            <ul>
                <li><a href="../../sessao/index.php">Home</a></li>
                <li><a href="../../anuncio/criar/criarAnuncio.php">Criar Anuncio</a></li>
                <li><a href="../../anuncio/listaAnuncios/listaAnuncios.php">Meus Anuncios</a></li>
                <li><a href="../../interesse/mostraInteresse.php">Interesse</a></li>
                <li><a href="../../sessao/logout.php">Logout</a></li>
            </ul>
        </section>
    </nav>

    <main id="styleMainCadastro" class="container">
        <form action="atualizar.php" method="post">

            <div>
                <label for="nomeCadastro" class="styleLabelCadastro">Nome</label>
                <input type="text" name="nomeCadastro" id="nome" Cadastro class="styleInputCadastro"
                    placeholder="Informe seu Nome" required>
            </div>

            <div>
                <label for="cpfCadastro" class="styleLabelCadastro">CPF</label>
                <input type="text" name="cpfCadastro" id="cpfCadastro" class="styleInputCadastro"
                    pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required maxlength="14" placeholder="XXX.XXX.XXX-XX">
            </div>

            <div>
                <label for="telefoneCadastro" class="styleLabelCadastro">Telefone</label>
                <input type="tel" name="telefoneCadastro" id="telefoneCadastro" class="styleInputCadastro" required
                    placeholder="Insira seu Telefone">
            </div>

            <div>
                <label for="passwordCadastro" class="styleLabelCadastro">Senha</label>
                <input type="password" name="passwordCadastro" id="passwordCadastro" class="styleInputCadastro" required
                    placeholder="Insira sua Senha">
            </div>

            <button class="styleButtonCadastro">Cadastrar</button>
        </form>
    </main>

    <footer>
        <address>Av. João Naves de Ávila, Santa Mônica, Uberlândia</address>
    </footer>

</body>

</html>