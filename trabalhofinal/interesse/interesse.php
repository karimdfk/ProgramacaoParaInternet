<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();


// Resgata os dados do cliente
$mensagem = $_POST["mensagem"] ?? "";
$contato = $_POST["contato"] ?? "";
$codigoAnuncio = $_GET["anuncio"] ?? "";


$sql1 = <<<SQL
  INSERT INTO interesse (mensagem, data_hora, contato, cod_anuncio)
  VALUES (?, NOW(), ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([
    $mensagem, $contato, $codigoAnuncio
  ])) throw new Exception('Falha na inserção');

  // Efetiva as operações
  $pdo->commit();

  header("location: ../anuncio/mostraAnuncio.php?cod=$codigoAnuncio");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}

