<?php

class Product//Definindo uma classe produto
{
  public $id;
  public $name;
  public $price;
  public $imagePath;

  function __construct($id, $name, $price, $imagePath)//O construtor tem a função de instanciar os produtos, atribuindo os valores dos parâmetros aos atributos da classe
  {
    $this->id = $id;
    $this->name = $name; 
    $this->price = $price;
    $this->imagePath = $imagePath;
  }
}

$products = array(//Instanciando vários produtos e gusrdando em um array
  new Product(1, 'Smart TV LED 55', 2900, 'tv.webp'),
  new Product(2, 'Smartphone 6.5 ABC', 1590, 'smartphone.webp'),
  new Product(3, 'Notebook 17 Ultra Slim', 4299, 'notebook.webp'),
  new Product(4, 'Mouse Óptico XYZ', 149, 'mouse.webp'),
  new Product(5, 'Monitor 28 4k', 1460, 'monitor.webp'),
  new Product(6, 'Fone Headset ABC', 250, 'headset.webp'),
  new Product(7, 'Pen-drive de 64GB', 90, 'pen-drive.webp')
);
 
$randProds = [//Escolhe de forma aleatória 5 produtos do array "products"
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)]
];

header('Content-type: application/json');//Define o cabeçalho da resposta http para indicar que o conteúdo está em json
echo json_encode($randProds);//Converte "randProds em json
