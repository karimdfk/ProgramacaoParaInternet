<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();

$nomeContato = $_GET['nomeContato'] ?? "";
$emailContato = $_GET['emailContato'] ?? "";
$mensagemContato = $_GET['mensagemContato'] ?? "";

try{
$sql = <<<SQL
    INSERT INTO contato (nome, email, mensagem)
    VALUES ('$nomeContato', '$emailContato', '$mensagemContato');
    SQL;

    $pdo->exec($sql);

    header("location: mostraContato.php");
    exit();
}
catch (Exception $e) {  
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
?>
