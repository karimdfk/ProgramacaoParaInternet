<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();

try{
$sql = <<<SQL
    SELECT nome, email, mensagem FROM contato;
    SQL;

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
       <table class="table table-striped table-hover">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Mensagem</th>
        </tr>

        <?php
        while($row = $stmt->fetch()){
            $nomeContato = $row['nome'];
            $emailContato = $row['email'];
            $mensagemContato = $row['mensagem'];

            echo <<<HTML
                <tr>
                    <th>$nomeContato</th>
                    <th>$emailContato</th>
                    <th>$mensagemContato</th>
                </tr>
                HTML;

        }       
        ?>
       </table>

       <a href="index.html">voltar</a>
    </main>

</body>

</html>