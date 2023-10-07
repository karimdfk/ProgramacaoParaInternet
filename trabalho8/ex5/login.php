<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = <<<SQL
    SELECT hash_senha FROM cliente2 
    WHERE email = ?
    SQL;

try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();
    
    if(!$row){
        header("location: login.html");
    }
    else if(!password_verify($senha, $row['hash_senha'])){
        header("location: login.html");
    }
    else{
        header("location: ../ex4/mostraDados.php");
    }
}
catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Falha inesperada: ' . $e->getMessage());
}

?>