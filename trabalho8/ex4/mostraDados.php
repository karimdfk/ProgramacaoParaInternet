<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();


try{
$sql1 = <<<SQL
    SELECT nome, cpf, email, hash_senha FROM cliente2
    SQL;

$sql2 = <<<SQL
    SELECT cep, endereco, bairro, cidade, estado, codigo_cliente FROM clienteEndereco
    SQL;

    $stmt1 = $pdo->query($sql1);
    $stmt2 = $pdo->query($sql2);
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
    <meta name="description"
        content="A Clinica ABC Health é ua espaço destinado a cuidar da sua saúde. Com mais de 10 consultórios e 25 profissionais nós temos a solução para seu problema...">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="docJS.js"></script>
    <title>Mostra Formulario</title>
</head>

<body>
    <header class="container" style="text-align: center;">
        <h1>Mostrando Dados do Formulario</h1>
    </header>

    <main class="container" style="margin-top: 25px;">

    <h2>Tabela cliente</h2>

       <table class="table table-striped table-hover">
        <tr>
            <th>nome</th>
            <th>cpf</th>
            <th>email</th>
            <th>hash_senha</th>
        </tr>

        <?php
        while($row = $stmt1->fetch()){
            $nome = htmlspecialchars($row['nome']);
            $cpf = htmlspecialchars($row['cpf']);
            $email = htmlspecialchars($row['email']);
            $hash_senha = htmlspecialchars($row['hash_senha']);

        echo <<<HTML
            <tr>
                <th>$nome</th>
                <th>$cpf</th>
                <th>$email</th>
                <th>$hash_senha</th>
            </tr>
            HTML;
        }
        ?>
       </table>

       <h2>Tabela clienteEndereco</h2>

       <table class="table table-striped table-hover">
        <tr>
            <th>cep</th>
            <th>endereco</th>
            <th>bairro</th>
            <th>cidade</th>
            <th>estado</th>
            <th>codigo_cliente</th>
        </tr>

        <?php
        while($row = $stmt2->fetch()){
            $cep = htmlspecialchars($row['cep']);
            $endereco = htmlspecialchars($row['endereco']);
            $bairro = htmlspecialchars($row['bairro']);
            $cidade = htmlspecialchars($row['cidade']);
            $estado = htmlspecialchars($row['estado']);
            $codigo_cliente = htmlspecialchars($row['codigo_cliente']);

        echo <<<HTML
            <tr>
                <th>$cep</th>
                <th>$endereco</th>
                <th>$bairro</th>
                <th>$cidade</th>
                <th>$estado</th>
                <th>$codigo_cliente</th>
            </tr>
            HTML;
        }
        ?>
       </table>

       <a href="../ex5/index.html">voltar</a>
    </main>

</body>

</html>