CREATE TABLE aluno
(
   nome varchar(50),
   telefone varchar(50)
) ENGINE=InnoDB;

CREATE TABLE cliente
(
   id int PRIMARY KEY auto_increment,
   nome varchar(50),
   cpf char(14) UNIQUE,
   email varchar(50) UNIQUE,
   hash_senha varchar(255),
   data_nascimento date,
   estado_civil varchar(30),
   altura int
) ENGINE=InnoDB;

CREATE TABLE endereco_entrega
(
   id int PRIMARY KEY auto_increment,
   cep char(10),
   endereco varchar(100),
   bairro varchar(50),
   cidade varchar(50),
   id_cliente int not null,
   FOREIGN KEY (id_cliente) REFERENCES cliente(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE contato
(
   nome varchar(50),
   email varchar(50) UNIQUE,
   mensagem varchar(350)
) ENGINE=InnoDB;

CREATE TABLE cliente2
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(50),
   cpf char(14) UNIQUE,
   email varchar(50) UNIQUE,
   hash_senha varchar(255)
) ENGINE=InnoDB;

CREATE TABLE clienteEndereco
(
   codigo int PRIMARY KEY auto_increment,
   cep char(10),
   endereco varchar(100),
   bairro varchar(50),
   cidade varchar(50),
   estado varchar(50),
   codigo_cliente int not null,
   FOREIGN KEY (codigo_cliente) REFERENCES cliente2(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO aluno VALUES ("Fulano", "123");
INSERT INTO aluno VALUES ("Ciclano", "456");
