<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Product//Definindo uma classe produto
{
  public $cod;
  public $titulo;
  public $descricao;
  public $preco;
  public $imagePath;

  function __construct($cod, $titulo, $descricao, $preco, $imagePath)//O construtor tem a função de instanciar os produtos, atribuindo os valores dos parâmetros aos atributos da classe
  {
    $this->cod = $cod;
    $this->titulo = $titulo; 
    $this->descricao = $descricao;
    $this->preco = $preco;
    $this->imagePath = $imagePath;
  }
}

$posicaoAtual = $_GET["posicao"] ?? "";

try {
    
    $sql1 = <<<SQL
        SELECT a.codigo, a.titulo, a.descricao, a.preco, f.nome_arquivo_foto
        FROM anuncio a, foto f
        WHERE a.codigo = f.cod_anuncio
        LIMIT 6 OFFSET $posicaoAtual
    SQL;
    
      $stmt1 = $pdo->query($sql1);
    } 
    catch (Exception $e) {
      //error_log($e->getMessage(), 3, 'log.php');
      exit('Ocorreu uma falha: ' . $e->getMessage());
    }

    $products = array(); // Criando um array vazio

    while ($row = $stmt1->fetch()) {
        $codigo = htmlspecialchars($row['codigo']);
        $titulo = htmlspecialchars($row['titulo']);
        $descricao = htmlspecialchars($row['descricao']);
        $preco = htmlspecialchars($row['preco']);
        $imagem = htmlspecialchars($row['nome_arquivo_foto']);

        $product = new Product($codigo, $titulo, $descricao, $preco, $imagem);
        $products[] = $product;
    }
 
header('Content-type: application/json');//Define o cabeçalho da resposta http para indicar que o conteúdo está em json
echo json_encode($products);//Converte randProds em json

?>