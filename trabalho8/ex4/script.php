<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";

$cep = $_POST["cep"] ?? "";
$endereco = $_POST["endereco"] ?? "";
$bairro = $_POST["bairro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql1 = <<<SQL
    INSERT INTO cliente2(nome, cpf, email, hash_senha)
    VALUES (?,?,?,?)
    SQL;


$sql2 = <<<SQL
    INSERT INTO clienteEndereco(cep, endereco, bairro, cidade, estado, codigo_cliente)
    VALUES (?,?,?,?,?,?)
    SQL;

try{
    $pdo->beginTransaction();

    $stmt1 = $pdo->prepare($sql1);
    if(!$stmt1->execute([$nome, $cpf, $email, $senhaHash])) 
    throw new Exception('Falha na primeira inserção');

    $codigo_cliente = $pdo->lastInsertId();

    $stmt2 = $pdo->prepare($sql2);
    if(!$stmt2->execute([$cep, $endereco, $bairro, $cidade, $estado, $codigo_cliente])) 
    throw new Exception('Falha na segunda inserção');

    $pdo->commit();

    header("location: mostraDados.php");
    exit();
}
catch (Exception $e)
{
$pdo->rollBack();
exit('Falha na transação: ' . $e->getMessage());
}
?>