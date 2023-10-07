<?php

require "../sessao/sessionVerification.php";
session_start();
exitWhenNotLoggedIn();

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$cod_anunciante = $_SESSION["codAnunciante"];

try {

$sql = <<<SQL
    SELECT i.*
    FROM interesse i, anuncio a 
    WHERE a.cod_anunciante = $cod_anunciante
    AND i.cod_anuncio = a.codigo
SQL;
  
    // Neste exemplo não é necessário utilizar prepared statements
    // porque não há possibilidade de injeção de SQL, 
    // pois nenhum parâmetro é utilizado na query SQL
    $stmt = $pdo->query($sql);
  } 
  catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
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
    <link rel="stylesheet" href="style.css">
    <script src="docJS.js"></script>

    <style>
        .btnRemove {
            color: red;
            border: 0px;
            cursor: pointer;
            font-size: larger;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <header>
        <h1>Mirage</h1>
        <img src="../img/logo.png" id="logo" alt="logo" width="80px" height="80px" class="logo">
    </header>


    <nav>
        <section>
            <ul>
                <li><a href="../sessao/index.php">Home</a></li>
                <li><a href="../anuncio/criar/criarAnuncio.php">Criar Anúncio</a></li>
                <li><a href="../anuncio/listaAnuncios/listaAnuncios.php">Meus Anuncios</a></li>
                <li><a href="../usuario/atualizar/atualizarCadastro.php">Atualizar Dados</a></li>
                <li><a href="../sessao/logout.php">Logout</a></li>
            </ul>
        </section>
    </nav>

    <main class="container">

    <h2>Interesses</h2>
    <table class="table table-striped table-hover">
      <tr>
        <th>Codigo</th>
        <th>Mensagem</th>
        <th>Data/Hora</th>
        <th>Contato</th>
        <th></th>
      </tr>

      <?php
      while ($row = $stmt->fetch()) {

        // Limpa os dados produzidos pelo usuário
        // com possibilidade de ataque XSS
        $codigo = htmlspecialchars($row['codigo']);
        $mensagem = htmlspecialchars($row['mensagem']);
        $data_hora = htmlspecialchars($row['data_hora']);
        $contato = htmlspecialchars($row['contato']);

        echo <<<HTML
          <tr>
            <td>$codigo</td>
            <td>$mensagem</td>
            <td>$data_hora</td>
            <td>$contato</td> 
            <td><a class="btnRemove" href="removeInteresse.php?cod=$codigo">✖</a></td>
          </tr>      
        HTML;
      }
      ?>

    </table>

    </main>


    <footer>
        <address>Av. João Naves de Ávila, Santa Mônica, Uberlândia</address>
    </footer>

</body>

</html>