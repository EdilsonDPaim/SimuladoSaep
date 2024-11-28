CREATE TABLE Venda (
    id_venda INTEGER PRIMARY KEY  NOT NULL,
    data_venda DATE  NOT NULL,
    item_venda VARCHAR (100)  NOT NULL,
    id_comprador INTEGER  NOT NULL
);

CREATE TABLE ItemVenda (
    id_item INTEGER PRIMARY KEY  NOT NULL,
    quantidade INTEGER  NOT NULL,
    subtotal FLOAT  NOT NULL,
    id_venda INTEGER  NOT NULL,
    id_produto INTEGER  NOT NULL
);

CREATE TABLE Comprador (
    id_comprador INTEGER PRIMARY KEY NOT NULL,
    nome VARCHAR (100)  NOT NULL,
    telefone VARCHAR (50)  NOT NULL,
    endereco VARCHAR (200)  NOT NULL
);

CREATE TABLE Produto (
    id_produto INTEGER PRIMARY KEY  NOT NULL,
    informacoes VARCHAR (100) NOT NULL,
    nome_produto VARCHAR (100) NOT NULL,
    descricao VARCHAR (100) NOT NULL,
    preco FLOAT NOT NULL,
    fk_ItemVenda_id_item INTEGER  NOT NULL
);