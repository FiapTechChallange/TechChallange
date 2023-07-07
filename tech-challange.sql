CREATE DATABASE FIAP_CHALLENGE;
USE FIAP_CHALLENGE;


CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(512) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '';
CREATE TABLE cardapio (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(512) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, descricao TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, id_categoria int NOT NULL, valor DECIMAL(6,2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '';
CREATE TABLE clientes (id INT AUTO_INCREMENT NOT NULL, cpf VARCHAR(64) DEFAULT NULL, nome VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(512) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, telefone VARCHAR(128) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '';
CREATE TABLE preparo (id INT AUTO_INCREMENT NOT NULL, id_pedido INT NOT NULL, inicio DATETIME NOT NULL, termino DATETIME DEFAULT NULL, INDEX preparo_pedido_id_fk (id_pedido), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '';
CREATE TABLE pedido (id INT AUTO_INCREMENT NOT NULL, id_cliente INT DEFAULT NULL, fechamento DATETIME DEFAULT NULL, pagamento DATETIME DEFAULT NULL, status VARCHAR(16) CHARACTER SET utf8mb4 DEFAULT 'iniciado' NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT ='';
CREATE TABLE pedido_itens (id INT AUTO_INCREMENT NOT NULL, id_pedido INT NOT NULL, id_item_cardapio INT DEFAULT NULL, observacoes TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX pedido_itens_pedido_id_fk (id_pedido), INDEX pedido_itens_cardapio_id_fk (id_item_cardapio), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT ='';
ALTER TABLE preparo ADD CONSTRAINT preparo_pedido_id_fk FOREIGN KEY (id_pedido) REFERENCES pedido (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE cardapio ADD CONSTRAINT cardapio_categoria_id_fk FOREIGN KEY (id_categoria) REFERENCES categoria (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE pedido_itens ADD CONSTRAINT pedido_itens_cardapio_id_fk FOREIGN KEY (id_item_cardapio) REFERENCES cardapio (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE pedido_itens ADD CONSTRAINT pedido_itens_pedido_id_fk FOREIGN KEY (id_pedido) REFERENCES pedido (id) ON UPDATE NO ACTION ON DELETE NO ACTION;

INSERT INTO categoria(nome) VALUES ('Lanche'),('Acompanhamento'),('Bebida'), ('Sobremesa');
