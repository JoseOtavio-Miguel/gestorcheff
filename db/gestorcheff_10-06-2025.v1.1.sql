-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/06/2025 às 19:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestorcheff`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `usuario_id`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `pais`, `created_at`, `updated_at`) VALUES
(1, 3, 'Rua dos Passos', '836', 'A', 'Centro', 'Viçosa', 'MG', '36570-005', 'Brasil', '2025-06-08 18:52:35', '2025-06-08 18:52:35'),
(2, 3, 'Rua Francisco Godoy Alvarenga', '378', 'Bloco A', 'Triângulo', 'Ponte Nova', 'MG', '35430-149', 'Brasil', '2025-06-08 19:45:40', '2025-06-08 19:45:40');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_cardapio`
--

CREATE TABLE `itens_cardapio` (
  `id` int(10) UNSIGNED NOT NULL,
  `restaurante_id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `disponivel` enum('sim','nao') NOT NULL DEFAULT 'sim',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens_cardapio`
--

INSERT INTO `itens_cardapio` (`id`, `restaurante_id`, `nome`, `descricao`, `preco`, `categoria`, `imagem`, `disponivel`, `criado_em`, `atualizado_em`) VALUES
(1, 1, 'Marmita P ', 'Arroz, farrofa, feijão, salada e bife de porco.', 25.99, 'Marmita', '1749575840_ae27aa4f5202738cc9ce.jpg', 'sim', NULL, '2025-06-10 14:17:20'),
(2, 1, 'Marmita P', 'Arroz, feijão, carne de porco, batata frita e salada. (Aproximadamente : 600g)', 22.50, 'Marmita', '1749320363_f012e868f11b01e967c2.jpg', 'sim', '2025-04-27 14:06:32', '2025-06-07 18:19:23'),
(3, 1, 'Prato de Almoço - Pequeno (P)', 'Arroz, feijão, salada e uma porção pequena de carne', 15.00, 'Almoço', '1749575561_dcfac44c0dbf4af647fa.jpg', 'sim', '2025-06-07 17:11:08', '2025-06-10 14:12:41'),
(4, 1, 'Prato de Almoço - Médio (M)', 'Arroz, feijão, salada e uma porção média de carne', 20.00, 'Almoço', '1749574257_46d2d9c87a8506a13878.jpg', 'sim', '2025-06-07 17:11:56', '2025-06-10 13:50:57'),
(5, 1, 'Prato de Almoço - Grande (G)', 'Arroz, feijão, salada e uma porção grande de carne.', 25.00, 'Almoço', '1749316378_4e1c0ea905ec200a523f.webp', 'sim', '2025-06-07 17:12:58', '2025-06-07 17:12:58'),
(6, 1, 'Almoço Médio', 'Almoço padrão', 30.00, 'Marmita', '1749575827_8775699398c9005f23b2.jpg', 'sim', '2025-06-07 18:32:47', '2025-06-10 14:17:07'),
(7, 1, 'Marmita Tradicional', 'Arroz branco, feijão carioca, bife grelhado e salada de alface com tomate', 18.00, 'Marmita', '1749575900_7c148248e0425617ec3d.jpg', 'sim', '2025-06-07 18:42:59', '2025-06-10 14:18:20'),
(8, 1, 'Marmita Fitness', 'Arroz integral, feijão preto, filé de frango grelhado, legumes cozidos (cenoura, abobrinha e brócolis).', 20.00, 'Marmita', '1749575944_bb3afcfb95919027a32d.jpg', 'sim', '2025-06-07 18:44:19', '2025-06-10 14:19:04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `pedido_id` int(10) UNSIGNED NOT NULL,
  `cardapio_id` int(10) UNSIGNED NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `preco_unitario` decimal(10,2) NOT NULL DEFAULT 0.00,
  `preco_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`id`, `pedido_id`, `cardapio_id`, `quantidade`, `preco_unitario`, `preco_total`, `criado_em`, `atualizado_em`) VALUES
(5, 1, 1, 1, 25.99, 25.99, '2025-06-08 19:06:41', '2025-06-08 19:06:41'),
(6, 1, 2, 1, 22.50, 22.50, '2025-06-08 19:06:41', '2025-06-08 19:06:41'),
(7, 1, 2, 1, 22.50, 22.50, '2025-06-08 19:26:12', '2025-06-08 19:26:12'),
(8, 1, 1, 1, 25.99, 25.99, '2025-06-08 19:26:12', '2025-06-08 19:26:12'),
(9, 1, 6, 1, 30.00, 30.00, '2025-06-08 19:26:12', '2025-06-08 19:26:12'),
(10, 11, 2, 1, 22.50, 22.50, '2025-06-08 20:31:37', '2025-06-08 20:31:37'),
(11, 11, 1, 1, 25.99, 25.99, '2025-06-08 20:31:37', '2025-06-08 20:31:37'),
(12, 11, 8, 1, 20.00, 20.00, '2025-06-08 20:31:37', '2025-06-08 20:31:37'),
(13, 12, 1, 1, 25.99, 25.99, '2025-06-08 20:49:57', '2025-06-08 20:49:57'),
(14, 13, 2, 1, 22.50, 22.50, '2025-06-08 20:53:46', '2025-06-08 20:53:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-04-26-115909', 'App\\Database\\Migrations\\Usuarios', 'default', 'App', 1745755587, 1),
(2, '2025-04-26-144937', 'App\\Database\\Migrations\\Restaurantes', 'default', 'App', 1745755587, 1),
(3, '2025-04-27-114216', 'App\\Database\\Migrations\\ItensCardapio', 'default', 'App', 1745755587, 1),
(4, '2025-04-27-114227', 'App\\Database\\Migrations\\Pedido', 'default', 'App', 1745755587, 1),
(5, '2025-04-27-114239', 'App\\Database\\Migrations\\ItemPedido', 'default', 'App', 1745755989, 2),
(14, '2025-04-26-115909', 'App\\Database\\Migrations\\RelatoriosRestaurantes', 'default', 'App', 1749418017, 3),
(15, '2025-06-07-173158', 'App\\Database\\Migrations\\CreateEnderecosTable', 'default', 'App', 1749418017, 3),
(16, '2025-06-08-160246', 'App\\Database\\Migrations\\ItensPedido', 'default', 'App', 1749418017, 3),
(17, '2025-06-08-220111', 'App\\Database\\Migrations\\ItensPedido', 'default', 'App', 1749420138, 4),
(18, '2025-06-08-231128', 'App\\Database\\Migrations\\AddUsuarioIdToPedidos', 'default', 'App', 1749424347, 5),
(19, '2025-06-08-231415', 'App\\Database\\Migrations\\AddCamposExtrasToPedidos', 'default', 'App', 1749424461, 6),
(20, '2025-06-09-162032', 'App\\Database\\Migrations\\CreateRelatoriosRestaurantes', 'default', 'App', 1749486206, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED DEFAULT NULL,
  `restaurante_id` int(10) UNSIGNED NOT NULL,
  `cliente_nome` varchar(255) NOT NULL,
  `cliente_telefone` varchar(20) NOT NULL,
  `cliente_endereco` varchar(255) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('aguardando','preparando','enviado','finalizado','cancelado') NOT NULL DEFAULT 'aguardando',
  `data` datetime DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `avaliacao_detalhes` text DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `restaurante_id`, `cliente_nome`, `cliente_telefone`, `cliente_endereco`, `valor_total`, `status`, `data`, `avaliacao`, `avaliacao_detalhes`, `criado_em`, `atualizado_em`) VALUES
(1, 3, 1, 'José', '31984363321', 'Rua dos Passos', 40.00, 'finalizado', NULL, NULL, NULL, NULL, NULL),
(2, 3, 1, 'José', '(11) 99999-9999', 'Rua Exemplo, 123 - Centro, São Paulo/SP - CEP: 01000-000', 89.90, 'finalizado', NULL, NULL, NULL, '2025-06-08 19:28:55', '2025-06-08 19:28:55'),
(7, 3, 1, 'José Otávio', '31984363321', 'Rua dos Passos, 836 - Centro, Viçosa/MG', 52.50, 'finalizado', NULL, NULL, NULL, '2025-06-08 19:41:33', '2025-06-08 19:41:33'),
(8, NULL, 1, 'José Otávio', '31984363321', 'Rua dos Passos, 836 - Centro, Viçosa/MG', 38.00, 'finalizado', NULL, NULL, NULL, '2025-06-08 19:44:11', '2025-06-08 19:44:11'),
(9, NULL, 1, 'José Otávio', '31984363321', 'Rua Francisco Godoy Alvarenga, 378 - Triângulo, Ponte Nova/MG', 40.00, 'finalizado', NULL, NULL, NULL, '2025-06-08 19:45:56', '2025-06-08 19:45:56'),
(10, NULL, 1, 'José Otávio', '31984363321', 'Rua dos Passos, 836 - Centro, Viçosa/MG', 78.99, 'finalizado', NULL, NULL, NULL, '2025-06-08 20:30:31', '2025-06-08 20:30:31'),
(11, NULL, 1, 'José Otávio', '31984363321', 'Rua dos Passos, 836 - Centro, Viçosa/MG', 68.49, 'finalizado', NULL, NULL, NULL, '2025-06-08 20:31:37', '2025-06-08 20:31:37'),
(12, NULL, 0, 'José Otávio', '31984363321', 'Rua Francisco Godoy Alvarenga, 378 - Triângulo, Ponte Nova/MG', 25.99, 'finalizado', NULL, NULL, NULL, '2025-06-08 20:49:57', '2025-06-08 20:49:57'),
(13, 3, 1, 'José Otávio', '31984363321', 'Rua Francisco Godoy Alvarenga, 378 - Triângulo, Ponte Nova/MG', 22.50, 'aguardando', NULL, NULL, NULL, '2025-06-08 20:53:46', '2025-06-08 20:53:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorios_restaurantes`
--

CREATE TABLE `relatorios_restaurantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `restaurante_id` int(10) UNSIGNED NOT NULL,
  `total_pedidos` int(11) NOT NULL DEFAULT 0,
  `receita_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `avaliacao_media` decimal(3,2) NOT NULL DEFAULT 0.00,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `nome_restaurante` varchar(255) DEFAULT NULL,
  `pedidos_30dias` int(11) DEFAULT 0,
  `receita_30dias` decimal(10,2) DEFAULT 0.00,
  `total_clientes` int(11) DEFAULT 0,
  `produto_mais_vendido` varchar(255) DEFAULT NULL,
  `categoria_mais_vendida` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `relatorios_restaurantes`
--

INSERT INTO `relatorios_restaurantes` (`id`, `restaurante_id`, `total_pedidos`, `receita_total`, `avaliacao_media`, `criado_em`, `atualizado_em`, `nome_restaurante`, `pedidos_30dias`, `receita_30dias`, `total_clientes`, `produto_mais_vendido`, `categoria_mais_vendida`) VALUES
(1, 1, 8, 430.38, 0.00, '2025-06-09 13:38:23', '2025-06-09 13:38:35', 'Terreiro do Vovo', 7, 390.38, 1, 'Marmita P', NULL),
(2, 2, 0, 0.00, 0.00, '2025-06-09 13:38:23', '2025-06-09 13:38:35', 'Churrascaria Gaúcha', 0, 0.00, 0, 'Nenhum', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `cnpj` varchar(18) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `restaurantes`
--

INSERT INTO `restaurantes` (`id`, `nome`, `descricao`, `cnpj`, `telefone`, `email`, `rua`, `cidade`, `estado`, `cep`, `senha`, `status`, `criado_em`, `atualizado_em`) VALUES
(1, 'Terreiro do Vovo', 'Restaurante', '12.345.678/0001-95', '31984363321', 'gestorcheff@gmail.com', 'Rua dos Passos 836', 'Viçosa', 'MG', '36570005', '$2y$10$ZRjvHKqAEKm2fg3ErGt1uOCN6bW1DZwxx/xNAbzaW/NIfgBx6KlWy', 'ativo', '2025-04-27 12:19:16', '2025-04-27 12:19:16'),
(2, 'Churrascaria Gaúcha', '', '12.345.678/0001-90', '(11) 91234-5678', 'contato@churrascariagaucha.com.br', 'Av. das Nações Unidas, 3000', 'São Paulo', 'SP', '04578-000', '$2y$10$EzQZyXwafzqBXIK2JdBR5eHyKUERwQfCIp4Oek3uhtPwE0XO7wNHe', 'ativo', '2025-04-27 12:19:55', '2025-04-27 12:19:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `datanascimento` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `datanascimento`, `email`, `cpf`, `telefone`, `senha`, `ativo`, `criado_em`, `atualizado_em`) VALUES
(3, 'José', 'Otávio', '1999-04-12', 'joseotavio_m@hotmail.com', '05962167694', '31984363321', '$2y$10$uxU/U11771Q2rFdcIr7/zeLkM9T0MIlqsZDPO1R/VhBxh2mPSbNBy', 1, '2025-06-07 17:21:16', '2025-06-07 17:21:16');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enderecos_usuario_id_foreign` (`usuario_id`);

--
-- Índices de tabela `itens_cardapio`
--
ALTER TABLE `itens_cardapio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itens_pedido_pedido_id_foreign` (`pedido_id`),
  ADD KEY `itens_pedido_cardapio_id_foreign` (`cardapio_id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `relatorios_restaurantes`
--
ALTER TABLE `relatorios_restaurantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relatorios_restaurantes_restaurante_id_foreign` (`restaurante_id`);

--
-- Índices de tabela `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `itens_cardapio`
--
ALTER TABLE `itens_cardapio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `relatorios_restaurantes`
--
ALTER TABLE `relatorios_restaurantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `itens_pedido_cardapio_id_foreign` FOREIGN KEY (`cardapio_id`) REFERENCES `itens_cardapio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itens_pedido_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `relatorios_restaurantes`
--
ALTER TABLE `relatorios_restaurantes`
  ADD CONSTRAINT `relatorios_restaurantes_restaurante_id_foreign` FOREIGN KEY (`restaurante_id`) REFERENCES `restaurantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
