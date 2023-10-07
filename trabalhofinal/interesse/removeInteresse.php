<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

require "../sessao/sessionVerification.php";
session_start();
exitWhenNotLoggedIn();

$codigoInteresse = $_GET["cod"] ?? "";

try {


$sql = <<<SQL
    DELETE FROM interesse
    WHERE codigo = $codigoInteresse
SQL;

    $stmt = $pdo->query($sql);

    $row = $stmt->fetch();

    header("location: mostraInteresse.php");
    exit();
  } 
  catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }

?>
