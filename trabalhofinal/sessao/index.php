<?php

require "sessionVerification.php";
session_start();
exitWhenNotLoggedIn();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Listar Anuncios</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>Mirage</h1>
        <img src="../img/logo.png" id="logo" alt="logo" width="80px" height="80px" class="logo">
    </header>


    <nav>
        <section>
            <ul>
                <li><a href="../anuncio/criar/criarAnuncio.php">Criar Anuncio</a></li>
                <li><a href="../anuncio/listaAnuncios/listaAnuncios.php">Meus Anuncios</a></li>
                <li><a href="../usuario/atualizar/atualizarCadastro.php">Atualizar Dados</a></li>
                <li><a href="../interesse/mostraInteresse.php">Interesse</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </section>
    </nav>

    <main class="container" style="text-align: center;">
    <p>Bem vindo à MIRAGE, sua página de anúncios online</p>
    </main>


    <footer>
        <address>Av. João Naves de Ávila, Santa Mônica, Uberlândia</address>
    </footer>

</body>

</html>