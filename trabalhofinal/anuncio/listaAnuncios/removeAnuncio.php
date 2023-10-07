<?php

require "../../conexaoMysql.php";
$pdo = mysqlConnect();

require "../../sessao/sessionVerification.php";
session_start();
exitWhenNotLoggedIn();

$codigoAnuncio = $_GET["cod"] ?? "";

try {

$sql1 = <<<SQL
    SELECT nome_arquivo_foto FROM foto
    WHERE cod_anuncio = $codigoAnuncio
SQL;

$sql2 = <<<SQL
    DELETE FROM anuncio
    WHERE codigo = $codigoAnuncio
SQL;

    $stmt1 = $pdo->query($sql1);

    $row = $stmt1->fetch();
    $nomeImg = htmlspecialchars($row['nome_arquivo_foto']);
    $caminhoImagem = '../../img/imgAnuncios/' . $nomeImg;

    if (!file_exists($caminhoImagem)) throw new Exception('Arquivo nao existe');
    if (!unlink($caminhoImagem)) throw new Exception('Falha na remocao');
            
  
    // Neste exemplo não é necessário utilizar prepared statements
    // porque não há possibilidade de injeção de SQL, 
    // pois nenhum parâmetro é utilizado na query SQL
    $stmt2 = $pdo->query($sql2);

    header("location: listaAnuncios.php");
    exit();
  } 
  catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }

?>
