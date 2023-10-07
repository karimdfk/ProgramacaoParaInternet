<?php

require "../../conexaoMysql.php";
$pdo = mysqlConnect();

require "../../sessao/sessionVerification.php";
session_start();
exitWhenNotLoggedIn();

$nomeCadastro = $_POST["nomeCadastro"] ?? "";
$cpfCadastro = $_POST["cpfCadastro"] ?? "";
$telefoneCadastro = $_POST["telefoneCadastro"] ?? "";
$passwordCadastro = $_POST["passwordCadastro"] ?? "";

$cod_anunciante = $_SESSION["codAnunciante"];

$hashsenha = password_hash($passwordCadastro, PASSWORD_DEFAULT);


$sql = <<<SQL
    UPDATE anunciante
    SET nome = ?, cpf = ?, telefone = ?, hash_senha = ?
    WHERE codigo = $cod_anunciante;
SQL;

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nomeCadastro, $cpfCadastro, $telefoneCadastro, $hashsenha]);
        $row = $stmt->fetch();

        header("location: ../../sessao/index.php");
        exit();
    }
    catch (Exception $e) {
        //error_log($e->getMessage(), 3, 'log.php');
        exit('Falha inesperada: ' . $e->getMessage());
    }

?>