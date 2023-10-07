<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Categoria//Definindo uma classe produto
{
  public $nome;

  function __construct($nome)//O construtor tem a função de instanciar os produtos, atribuindo os valores dos parâmetros aos atributos da classe
  {
    $this->nome = $nome;
  }
}

try {
    $sql = <<<SQL
    SELECT nome
    FROM categoria
    SQL;
  
    $stmt = $pdo->query($sql);
    $categorias = array(); // Criando um array vazio

    while ($row = $stmt->fetch()) {
        $nome = htmlspecialchars($row['nome']);
        $categoria = new Categoria($nome);
        $categorias[] = $categoria;
    }

    header('Content-type: application/json');//Define o cabeçalho da resposta http para indicar que o conteúdo está em json
    echo json_encode($categorias);//Converte randProds em json 
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }
  

?>