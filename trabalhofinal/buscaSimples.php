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

$texto = $_POST["buscasimples"] ?? "";
$posicaoAtual = $_POST["posicao"] ?? "";

$palavras = explode(" ", $texto); // Divide a string em um array de palavras usando o espaço como separador
$primeirasPalavras = array_slice($palavras, 0, 5); // Obtém as cinco primeiras palavras do array
//Formatando para usar na consulta SQL
$primeirasPalavras[0] = "%".$primeirasPalavras[0]."%";
$primeirasPalavras[1] = "%".$primeirasPalavras[1]."%";
$primeirasPalavras[2] = "%".$primeirasPalavras[2]."%";
$primeirasPalavras[3] = "%".$primeirasPalavras[3]."%";
$primeirasPalavras[4] = "%".$primeirasPalavras[4]."%";

try{
$sql = <<<SQL
    SELECT a.codigo, a.titulo, a.descricao, a.preco, f.nome_arquivo_foto
    FROM anuncio a, foto f
    WHERE a.codigo = f.cod_anuncio
    AND descricao LIKE ?
    AND descricao LIKE ?
    AND descricao LIKE ?
    AND descricao LIKE ?
    AND descricao LIKE ?
    ORDER BY a.data_hora DESC
    LIMIT 6 OFFSET $posicaoAtual
SQL;


    $stmt = $pdo->prepare($sql);
    $stmt->execute([$primeirasPalavras[0],$primeirasPalavras[1],$primeirasPalavras[2],$primeirasPalavras[3],$primeirasPalavras[4]]);

    $products = array(); // Criando um array vazio

    while ($row = $stmt->fetch()) {
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
}
catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Falha inesperada: ' . $e->getMessage());
}

       
?>