<?php
require "../../sessao/sessionVerification.php";
session_start();
exitWhenNotLoggedIn();

require "../../conexaoMysql.php";
$pdo = mysqlConnect();

class CEP//Definindo uma classe produto
{
  public $bairro;
  public $cidade;
  public $estado;

  function __construct($bairro, $cidade, $estado)//O construtor tem a função de instanciar os produtos, atribuindo os valores dos parâmetros aos atributos da classe
  {
    $this->bairro = $bairro;
    $this->cidade = $cidade; 
    $this->estado = $estado;
  }
}

$cep = $_GET["cep"] ?? "";

try {
    $sql = <<<SQL
    SELECT bairro, cidade, estado
    FROM base_endereco_ajax
    WHERE cep = ?
    SQL;
  
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cep]);

    $row = $stmt->fetch();

    $bairro = htmlspecialchars($row['bairro']);
    $cidade = htmlspecialchars($row['cidade']);
    $estado = htmlspecialchars($row['estado']);

    $completa = new CEP($bairro, $cidade, $estado);

    header('Content-type: application/json');//Define o cabeçalho da resposta http para indicar que o conteúdo está em json
    echo json_encode($completa);//Converte randProds em json 
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }
  

?>