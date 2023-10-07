<?php

require "../../conexaoMysql.php";
$pdo = mysqlConnect();

require "../../sessao/sessionVerification.php";
session_start();
exitWhenNotLoggedIn();

$titulo = $_POST["titulo"] ?? "";
$descricao = $_POST["descricao"] ?? "";
$preco = $_POST["preco"] ?? "";
$cep = $_POST["cep"] ?? "";
$bairro = $_POST["bairro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$categoria = $_POST["categoria"] ?? "";

$cod_anunciante = $_SESSION["codAnunciante"];


$pastaDestino = '../../img/imgAnuncios/';
$nomeImagem = uniqid() . '.jpg';
$caminhoCompleto = $pastaDestino . $nomeImagem;

try {
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) 
    throw new Exception('Falha ao salvar a imagem');

} catch (Exception $e) {
  echo "Ocorreu um erro: " . $e->getMessage();
}


    $sqlCat = <<<SQL
    SELECT codigo, nome from categoria
    where nome = ?
    SQL;

    try{
        $stmt = $pdo->prepare($sqlCat);
        $stmt->execute([$categoria]);
        $row = $stmt->fetch();
        
        if(!$row)throw new Exception('Falha na busca da categoria');

        $cod_categoria = htmlspecialchars($row['codigo']);
    }
    catch (Exception $e) {
        //error_log($e->getMessage(), 3, 'log.php');
        exit('Falha inesperada: ' . $e->getMessage());
    }

  $sql1 = <<<SQL
  -- Repare que a coluna Id foi omitida por ser auto_increment
  INSERT INTO anuncio (titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, cod_categoria, cod_anunciante)
  VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?)
  SQL;

  $sql2 = <<<SQL
  INSERT INTO foto 
    (cod_anuncio, nome_arquivo_foto)
  VALUES (?, ?)
  SQL;

  try {
    $pdo->beginTransaction();
  // Neste caso utilize prepared statements para prevenir
  // ataques do tipo SQL Injection, pois precisamos
  // cadastrar dados fornecidos pelo usuário 
  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([
    $titulo, $descricao, $preco, $cep, $bairro,$cidade, $estado, $cod_categoria, $cod_anunciante
  ])) throw new Exception('Falha na primeira inserção');

  $idNovoAnuncio = $pdo->lastInsertId();

  $stmt2 = $pdo->prepare($sql2);
  if (!$stmt2->execute([
    $idNovoAnuncio, $nomeImagem
  ])) throw new Exception('Falha na segunda inserção');

  $pdo->commit();

  header("location: ../listaAnuncios/listaAnuncios.php");
  exit();
} 
catch (Exception $e) {  
    $pdo->rollBack();
    if ($e->errorInfo[1] === 1062)
      exit('Dados duplicados: ' . $e->getMessage());
    else
      exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
