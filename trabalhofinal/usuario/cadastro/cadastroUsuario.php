<?php

require "../../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nomeCadastro"] ?? "";
$cpf = $_POST["cpfCadastro"] ?? "";
$email = $_POST["emailCadastro"] ?? "";
$senha = $_POST["passwordCadastro"] ?? "";
$telefone = $_POST["telefoneCadastro"] ?? "";



// calcula um hash de senha seguro para armazenar no BD
$hashsenha = password_hash($senha, PASSWORD_DEFAULT);

try {

  $sql = <<<SQL
  -- Repare que a coluna Id foi omitida por ser auto_increment
  INSERT INTO anunciante (nome, cpf, email, hash_senha, telefone)
  VALUES (?, ?, ?, ?, ?)
  SQL;

  // Neste caso utilize prepared statements para prevenir
  // ataques do tipo SQL Injection, pois precisamos
  // cadastrar dados fornecidos pelo usuário 
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nome, $cpf, $email, $hashsenha, $telefone]);

  header("location: ../login/login.html");
  exit();
} 
catch (Exception $e) {  
  //error_log($e->getMessage(), 3, 'log.php');
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
