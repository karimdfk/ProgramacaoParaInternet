CREATE TABLE anunciante(
    codigo int PRIMARY KEY auto_increment,
    nome varchar(50),
    cpf char(14) UNIQUE,
    email varchar(50) UNIQUE,
    hash_senha varchar(300),
    telefone varchar(30)
) ENGINE=InnoDB;

CREATE TABLE categoria(
    codigo int PRIMARY KEY auto_increment,
    nome varchar(50),
    descricao varchar(300)
) ENGINE=InnoDB;

CREATE TABLE anuncio(
    codigo int PRIMARY KEY auto_increment,
    titulo varchar(50),
    descricao varchar(10000),
    preco float,
    data_hora datetime,
    cep char(10),
    bairro varchar(50),
    cidade varchar(50),
    estado varchar(50),
    cod_categoria int not null,
    cod_anunciante int not null,
    FOREIGN KEY (cod_categoria) REFERENCES categoria(codigo) ON DELETE CASCADE,
    FOREIGN KEY (cod_anunciante) REFERENCES anunciante(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE interesse(
    codigo int PRIMARY KEY auto_increment,
    mensagem varchar(300),
    data_hora datetime,
    contato varchar(50),
    cod_anuncio int not null,
    FOREIGN KEY (cod_anuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE foto(
    cod_anuncio int not null,
    nome_arquivo_foto varchar(300),
    FOREIGN KEY (cod_anuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE base_endereco_ajax(
    cep char(10),
    bairro varchar(50),
    cidade varchar(50),
    estado varchar(50)
) ENGINE=InnoDB;


INSERT INTO base_endereco_ajax VALUES("38400-100","Centro","Uberlândia", "Minas Gerais");
INSERT INTO base_endereco_ajax VALUES("38400-200","Fundinho","Uberlândia", "Minas Gerais");
INSERT INTO base_endereco_ajax VALUES("38400-300","Resende Junqueira","Uberlândia", "Minas Gerais");
INSERT INTO base_endereco_ajax VALUES("38400-400","Oswaldo Resende","Uberlândia", "Minas Gerais");
INSERT INTO base_endereco_ajax VALUES("39400-400","Centro","Montes Claros", "Minas Gerais");

INSERT INTO categoria VALUES (default, "Veículo", "A categoria veículo engloba meios de transporte.");
INSERT INTO categoria VALUES (default, "Eletroeletrônico", "A categoria eletroeletrônicos engloba dispositivos eletrônicos.");
INSERT INTO categoria VALUES (default, "Imóvel", "A categoria imóvel engloba propriedades e terrenos");
INSERT INTO categoria VALUES (default, "Vestuário", "A categoria vestuário engloba roupa, calçados e acessórios.");
INSERT INTO categoria VALUES (default, "Outros", "Caso nenhuma das categorias se enquadre no seu produto, utilize esta.");

