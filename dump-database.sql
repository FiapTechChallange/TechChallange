-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 03/09/2023 às 20:24
-- Versão do servidor: 8.1.0
-- Versão do PHP: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `FIAP_CHALLENGE`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cardapio`
--

CREATE TABLE IF NOT EXISTS `cardapio` (
  `id` int NOT NULL,
  `nome` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_categoria` int NOT NULL,
  `valor` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL,
  `nome` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Lanche'),
(2, 'Acompanhamento'),
(3, 'Bebida'),
(4, 'Sobremesa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `checkout`
--

CREATE TABLE IF NOT EXISTS `checkout` (
  `id` int NOT NULL,
  `id_pedido` int NOT NULL,
  `status` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'iniciado',
  `gateway_pagamento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL,
  `cpf` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int NOT NULL,
  `id_cliente` int DEFAULT NULL,
  `recebimento` datetime DEFAULT CURRENT_TIMESTAMP,
  `fechamento` datetime DEFAULT NULL,
  `pagamento` datetime DEFAULT NULL,
  `status` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'iniciado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_itens`
--

CREATE TABLE IF NOT EXISTS `pedido_itens` (
  `id` int NOT NULL,
  `id_pedido` int NOT NULL,
  `id_item_cardapio` int DEFAULT NULL,
  `observacoes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `preparo`
--

CREATE TABLE IF NOT EXISTS `preparo` (
  `id` int NOT NULL,
  `id_pedido` int NOT NULL,
  `inicio` datetime NOT NULL,
  `termino` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cardapio_categoria_id_fk` (`id_categoria`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkout_pedido_id_fk` (`id_pedido`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_itens_pedido_id_fk` (`id_pedido`),
  ADD KEY `pedido_itens_cardapio_id_fk` (`id_item_cardapio`);

--
-- Índices de tabela `preparo`
--
ALTER TABLE `preparo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preparo_pedido_id_fk` (`id_pedido`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `preparo`
--
ALTER TABLE `preparo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cardapio`
--
ALTER TABLE `cardapio`
  ADD CONSTRAINT `cardapio_categoria_id_fk` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Restrições para tabelas `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_pedido_id_fk` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`);

--
-- Restrições para tabelas `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `pedido_itens_cardapio_id_fk` FOREIGN KEY (`id_item_cardapio`) REFERENCES `cardapio` (`id`),
  ADD CONSTRAINT `pedido_itens_pedido_id_fk` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`);

--
-- Restrições para tabelas `preparo`
--
ALTER TABLE `preparo`
  ADD CONSTRAINT `preparo_pedido_id_fk` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`);
COMMIT;

INSERT INTO clientes (cpf, nome, email, telefone) VALUES
("86288366757", "João Silva", "joao.silva@example.com", "13987654321"),
("55567699812", "Maria Santos", "maria.santos@example.com", "13912345678"),
("74398625641", "Pedro Oliveira", "pedro.oliveira@example.com", "13998765432"),
("35478965129", "Ana Souza", "ana.souza@example.com", "13911112222"),
("12545783653", "Carlos Pereira", "carlos.pereira@example.com", "13933334444"),
("98763254722", "Fernanda Costa", "fernanda.costa@example.com", "13955556666"),
("41258498664", "Rafaela Almeida", "rafaela.almeida@example.com", "13977778888"),
("75215436735", "Gustavo Rodrigues", "gustavo.rodrigues@example.com", "13999991111"),
("88945276178", "Amanda Ferreira", "amanda.ferreira@example.com", "13922223333"),
("63245785210", "Mariana Oliveira", "mariana.oliveira@example.com", "13944445555"),
("12345678901", "Lucas Castro", "lucas.castro@example.com", "13966667777"),
("23456789012", "Isabela Lima", "isabela.lima@example.com", "13988889999"),
("34567890123", "André Pereira", "andre.pereira@example.com", "13900001111"),
("45678901234", "Camila Cardoso", "camila.cardoso@example.com", "13922223333"),
("56789012345", "Ricardo Santos", "ricardo.santos@example.com", "13944445555"),
("67890123456", "Juliana Almeida", "juliana.almeida@example.com", "13966667777"),
("78901234567", "Miguel Gomes", "miguel.gomes@example.com", "13988889999"),
("89012345678", "Beatriz Martins", "beatriz.martins@example.com", "13900001111"),
("90123456789", "Eduardo Costa", "eduardo.costa@example.com", "13922223333"),
("01234567890", "Gabriela Silva", "gabriela.silva@example.com", "13944445555"),
("34567890190", "Rodrigo Fernandes", "rodrigo.fernandes@example.com", "13966667777"),
("45678901299", "Larissa Oliveira", "larissa.oliveira@example.com", "13988889999"),
("56789012308", "Marcelo Souza", "marcelo.souza@example.com", "13900001111"),
("67890123417", "Vanessa Santos", "vanessa.santos@example.com", "13922223333"),
("78901234526", "Fábio Pereira", "fabio.pereira@example.com", "13944445555"),
("89012345635", "Carolina Mendes", "carolina.mendes@example.com", "13966667777"),
("90123456744", "Raul Castro", "raul.castro@example.com", "13988889999"),
("01234567853", "Patrícia Almeida", "patricia.almeida@example.com", "13900001111"),
("12345678962", "Diego Lima", "diego.lima@example.com", "13922223333");

INSERT INTO cardapio (nome, descricao, id_categoria, valor) VALUES
("X-Bacon", "Pão, hambúrguer de carne, queijo, bacon, alface, tomate e maionese", 1, 25.50),
("X-Tudo", "Pão, hambúrguer de carne, presunto, queijo, ovo, bacon, alface, tomate, cebola e maionese", 1, 30.75),
("X-Salada", "Pão, hambúrguer de carne, queijo, alface, tomate, cebola e maionese", 1, 22.00),
("X-Frango", "Pão, hambúrguer de frango, queijo, alface, tomate e maionese", 1, 23.80),
("X-Egg", "Pão, hambúrguer de carne, queijo, ovo, alface, tomate e maionese", 1, 21.40),
("X-Calabresa", "Pão, hambúrguer de carne, queijo, calabresa, alface, tomate e maionese", 1, 24.90),
("X-Burguer", "Pão, hambúrguer de carne, queijo, alface, tomate e maionese", 1, 20.50),
("X-Picanha", "Pão, hambúrguer de picanha, queijo, alface, tomate e maionese", 1, 29.60),
("X-Veggie", "Pão, hambúrguer vegetariano, queijo, alface, tomate, cebola e maionese", 1, 26.75),
("X-Frango Catupiry", "Pão, hambúrguer de frango, queijo catupiry, alface, tomate e maionese", 1, 28.90),
("X-Bacon Egg", "Pão, hambúrguer de carne, queijo, bacon, ovo, alface, tomate e maionese", 1, 27.25),
("X-Frango Bacon", "Pão, hambúrguer de frango, queijo, bacon, alface, tomate e maionese", 1, 23.50),
("X-Tudo Duplo", "Pão, dois hambúrgueres de carne, presunto, queijo, ovo, bacon, alface, tomate, cebola e maionese", 1, 35.90),
("X-Salada Duplo", "Pão, dois hambúrgueres de carne, queijo, alface, tomate, cebola e maionese", 1, 32.75),
("X-Frango Duplo", "Pão, dois hambúrgueres de frango, queijo, alface, tomate e maionese", 1, 34.20),
("X-Egg Duplo", "Pão, dois hambúrgueres de carne, queijo, dois ovos, alface, tomate e maionese", 1, 31.40),
("X-Calabresa Duplo", "Pão, dois hambúrgueres de carne, queijo, duas calabresas, alface, tomate e maionese", 1, 33.80),
("X-Burguer Duplo", "Pão, dois hambúrgueres de carne, queijo, alface, tomate e maionese", 1, 30.50),
("X-Picanha Duplo", "Pão, dois hambúrgueres de picanha, queijo, alface, tomate e maionese", 1, 37.90),
("X-Veggie Duplo", "Pão, dois hambúrgueres vegetarianos, queijo, alface, tomate, cebola e maionese", 1, 36.25),
("X-Bacon Triplo", "Pão, três hambúrgueres de carne, queijo, bacon, alface, tomate e maionese", 1, 40.50),
("X-Frango Triplo", "Pão, três hambúrgueres de frango, queijo, alface, tomate e maionese", 1, 43.80),
("X-Tudo Triplo", "Pão, três hambúrgueres de carne, presunto, queijo, ovo, bacon, alface, tomate, cebola e maionese", 1, 49.25),
("X-Salada Triplo", "Pão, três hambúrgueres de carne, queijo, alface, tomate, cebola e maionese", 1, 45.90),
("X-Egg Triplo", "Pão, três hambúrgueres de carne, queijo, três ovos, alface, tomate e maionese", 1, 42.75),
("X-Calabresa Triplo", "Pão, três hambúrgueres de carne, queijo, três calabresas, alface, tomate e maionese", 1, 35.20);

INSERT INTO cardapio (nome, descricao, id_categoria, valor) VALUES
("Batata Frita", "Deliciosas batatas fritas crocantes", 2, 15.50),
("Onion Rings", "Anéis de cebola empanados e crocantes", 2, 12.75),
("Nuggets de Frango", "Pedacinhos suculentos de frango empanados", 2, 14.25),
("Polenta Frita", "Polenta macia e frita", 2, 13.80),
("Mandioca Frita", "Mandioca cozida e frita", 2, 11.50),
("Maionese Especial", "Maionese temperada e cremosa", 2, 18.90),
("Cebola Caramelizada", "Cebola caramelizada e dourada", 2, 10.25),
("Anéis de Pimenta", "Anéis de pimenta empanados e apimentados", 2, 12.50),
("Queijo Coalho Grelhado", "Queijo coalho grelhado e crocante", 2, 15.75),
("Molho Barbecue", "Molho barbecue caseiro", 2, 14.95);

INSERT INTO cardapio (nome, descricao, id_categoria, valor) VALUES
("Coca-Cola", "Refrigerante de cola tradicional", 3, 10.50),
("Guaraná Antarctica", "Refrigerante de guaraná", 3, 9.75),
("Suco de Laranja", "Suco natural de laranja", 3, 7.25),
("Fanta Uva", "Refrigerante sabor uva", 3, 8.50),
("Suco de Uva", "Suco natural de uva", 3, 8.50),
("Chá Gelado de Pêssego", "Chá preto gelado sabor pêssego", 3, 6.90),
("Refrigerante de Limão", "Refrigerante sabor limão", 3, 6.25),
("Suco de Abacaxi", "Suco natural de abacaxi", 3, 7.80),
("Fanta Uva", "Refrigerante sabor uva", 3, 8.50),
("Suco de Laranja", "Suco natural de laranja", 3, 8.75);

INSERT INTO cardapio (nome, descricao, id_categoria, valor) VALUES
("Sorvete de Chocolate", "Delicioso sorvete de chocolate", 4, 15.50),
("Pudim de Leite", "Clássico pudim de leite condensado", 4, 10.75),
("Torta de Morango", "Torta recheada com morangos frescos", 4, 20.25),
("Mousse de Maracujá", "Leve e refrescante mousse de maracujá", 4, 8.50),
("Brownie com Sorvete", "Brownie quentinho com sorvete de baunilha", 4, 12.80),
("Cheesecake de Frutas Vermelhas", "Cheesecake com calda de frutas vermelhas", 4, 18.90),
("Milkshake de Baunilha", "Milkshake cremoso de baunilha", 4, 9.25),
("Brigadeiro Gourmet", "Brigadeiro de chocolate em versão gourmet", 4, 6.50),
("Tiramisu", "Sobremesa italiana com camadas de biscoito e café", 4, 25.75),
("Sorvete de Pistache", "Sorvete sabor pistache com pedaços de amêndoas", 4, 14.95);

INSERT INTO pedido (id_cliente, fechamento, pagamento, status) VALUES
(1, NULL, "2023-07-06 14:00:00", "recebido"),
(2, NULL, "2023-07-06 14:05:00", "em preparação"),
(3, NULL, "2023-07-06 14:10:00", "pronto"),
(4, "2023-07-06 14:30:00", "2023-07-06 14:15:00", "finalizado");

INSERT INTO pedido_itens(id_pedido, id_item_cardapio) VALUES
    (1, 1),
    (1, 2),
    (2, 27),
    (2, 38),
    (3, 48),
    (4, 47),
    (4, 31),
    (4, 39),
    (4, 4);

INSERT INTO preparo (id_pedido, inicio, termino) VALUES
(1, "2023-07-06 14:00:00", NULL),
(2, "2023-07-06 14:05:00", NULL),
(3, "2023-07-06 14:10:00", NULL),
(4, "2023-07-06 14:15:00", "2023-07-06 14:27:00");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
