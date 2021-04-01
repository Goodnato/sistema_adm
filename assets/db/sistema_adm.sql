-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 31-Mar-2021 às 23:35
-- Versão do servidor: 8.0.23
-- versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

use sistema_adm;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_adm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aparelhos`
--

CREATE TABLE `aparelhos` (
  `id` int NOT NULL,
  `id_modelo` int NOT NULL,
  `id_marca` int NOT NULL,
  `imei1` varchar(200) NOT NULL,
  `id_status_condicao_aparelho` int NOT NULL,
  `id_status_disponibilidade_aparelho` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `nota_fiscal` varchar(50) DEFAULT NULL,
  `data_nota` date DEFAULT NULL,
  `valor` double(6,2) NOT NULL,
  `valor_depreciado` double(6,2) DEFAULT NULL,
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `data_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
(1, 'CATEGORIA I', 1, '2021-03-31 22:58:01', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `centro_custo`
--

CREATE TABLE `centro_custo` (
  `id` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `centro_custo_import`
--

CREATE TABLE `centro_custo_import` (
  `id` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `id_centro_custo` int DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gestor` varchar(100) DEFAULT NULL,
  `situacao` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `matricula_coordenador` int DEFAULT NULL,
  `status` tinyint UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores_import`
--

CREATE TABLE `colaboradores_import` (
  `id` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `id_centro_custo` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gestor` varchar(100) DEFAULT NULL,
  `situacao` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `matricula_coordenador` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `distribuicoes`
--

CREATE TABLE `distribuicoes` (
  `id` int NOT NULL,
  `id_aparelho` int NOT NULL,
  `id_linha` int NOT NULL,
  `id_colaborador` int NOT NULL,
  `id_status_distribuicao` int NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `linhas`
--

CREATE TABLE `linhas` (
  `id` int NOT NULL,
  `numero_linha` varchar(200) NOT NULL,
  `codigo_chip` varchar(200) NOT NULL,
  `pin_puk1` varchar(200) DEFAULT NULL,
  `pin_puk2` varchar(200) DEFAULT NULL,
  `id_operadora` int NOT NULL,
  `id_categoria` int NOT NULL,
  `status` tinyint NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
(1, 'LG', 1, '2021-03-31 23:01:59', '2021-03-31 23:01:46', 1, NULL),
(2, 'SAMSUNG', 1, '2021-03-31 23:01:59', '2021-03-31 23:01:46', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelos`
--

CREATE TABLE `modelos` (
  `id` int NOT NULL,
  `nome` varchar(200) NOT NULL,
  `id_marca` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelos`
--

INSERT INTO `modelos` (`id`, `nome`, `id_marca`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
(1, 'LG K40S', 1, 1, '2021-03-31 23:02:58', '2021-03-31 23:02:19', 1, NULL),
(2, 'LG X STYLE', 1, 1, '2021-03-31 23:02:58', '2021-03-31 23:02:19', 1, NULL),
(3, 'SAMSUNG TAB A6', 2, 1, '2021-03-31 23:02:58', '2021-03-31 23:02:19', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `operadoras`
--

CREATE TABLE `operadoras` (
  `id` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `operadoras`
--

INSERT INTO `operadoras` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
(1, 'CLARO', 1, '2021-03-31 23:01:18', '2021-03-31 23:01:14', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_condicoes_aparelhos`
--

CREATE TABLE `status_condicoes_aparelhos` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `status_condicoes_aparelhos`
--

INSERT INTO `status_condicoes_aparelhos` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
(1, 'NOVO', 1, '2021-03-31 22:54:06', '2021-03-31 22:53:50', 1, NULL),
(2, 'USADO', 1, '2021-03-31 22:54:06', '2021-03-31 22:53:50', 1, NULL),
(3, 'DESCARTADO', 1, '2021-03-31 22:54:18', '2021-03-31 22:54:08', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_disponibilidades_aparelhos`
--

CREATE TABLE `status_disponibilidades_aparelhos` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `status_disponibilidades_aparelhos`
--

INSERT INTO `status_disponibilidades_aparelhos` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
(1, 'EM USO', 1, '2021-03-31 22:55:48', '2021-03-31 22:54:49', 1, NULL),
(2, 'DISPONÍVEL', 1, '2021-03-31 22:55:48', '2021-03-31 22:54:49', 1, NULL),
(3, 'MANUTENÇÃO', 1, '2021-03-31 22:55:48', '2021-03-31 22:54:49', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_distribuicoes`
--

CREATE TABLE `status_distribuicoes` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario_registro` int NOT NULL,
  `id_usuario_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nivel_acesso` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data_criado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `email`, `nivel_acesso`, `data_criado`) VALUES
(1, 'Cleyton', 'Goodnato', '123', 'renato@gmail.com', '', '2021-03-31 22:53:02');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aparelhos`
--
ALTER TABLE `aparelhos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `imei1` (`imei1`),
  ADD KEY `FK_aparelhos_modelos` (`id_modelo`),
  ADD KEY `FK_aparelhos_marcas` (`id_marca`),
  ADD KEY `FK_aparelhos_status_condicoes` (`id_status_condicao_aparelho`),
  ADD KEY `FK_aparelhos_status_disponibilidade_aparelhos` (`id_status_disponibilidade_aparelho`),
  ADD KEY `FK_aparelhos_usuarios_registro` (`id_usuario_registro`),
  ADD KEY `FK_aparelhos_usuarios_at` (`id_usuario_at`),
  ADD KEY `status` (`status`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_categorias_usuarios_registro` (`id_usuario_registro`),
  ADD KEY `FK_categorias_usuarios_at` (`id_usuario_at`),
  ADD KEY `status` (`status`);

--
-- Índices para tabela `centro_custo`
--
ALTER TABLE `centro_custo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `centro_custo_import`
--
ALTER TABLE `centro_custo_import`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_colaboradores_centro_custo` (`id_centro_custo`);

--
-- Índices para tabela `colaboradores_import`
--
ALTER TABLE `colaboradores_import`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices para tabela `distribuicoes`
--
ALTER TABLE `distribuicoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_distribuicoes_aparelhos` (`id_aparelho`),
  ADD KEY `FK_distribuicoes_colaboradores` (`id_colaborador`),
  ADD KEY `FK_distribuicoes_linhas` (`id_linha`),
  ADD KEY `FK_distribuicoes_status_distribuicoes` (`id_status_distribuicao`),
  ADD KEY `FK_distribuicoes_usuarios_registro` (`id_usuario_registro`),
  ADD KEY `FK_distribuicoes_usuarios_at` (`id_usuario_at`);

--
-- Índices para tabela `linhas`
--
ALTER TABLE `linhas`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `numero_linha` (`numero_linha`),
  ADD KEY `FK_linhas_categorias` (`id_categoria`),
  ADD KEY `FK_linhas_operadoras` (`id_operadora`),
  ADD KEY `FK_linhas_usuarios_registro` (`id_usuario_registro`),
  ADD KEY `FK_linhas_usuarios_at` (`id_usuario_at`),
  ADD KEY `status` (`status`);

--
-- Índices para tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_marcas_usuarios_registro` (`id_usuario_registro`),
  ADD KEY `FK_marcas_usuarios_at` (`id_usuario_at`);

--
-- Índices para tabela `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_modelos_usuarios_registro` (`id_usuario_registro`),
  ADD KEY `FK_modelos_usuarios_at` (`id_usuario_at`),
  ADD KEY `FK_modelos_marcas` (`id_marca`);

--
-- Índices para tabela `operadoras`
--
ALTER TABLE `operadoras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_operadoras_usuarios_registro` (`id_usuario_registro`);

--
-- Índices para tabela `status_condicoes_aparelhos`
--
ALTER TABLE `status_condicoes_aparelhos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_status_condicoes_usuarios_registro` (`id_usuario_registro`),
  ADD KEY `FK_status_condicoes_usuarios_at` (`id_usuario_at`);

--
-- Índices para tabela `status_disponibilidades_aparelhos`
--
ALTER TABLE `status_disponibilidades_aparelhos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_status_disponibilidades_aparelhos_usuarios_registro` (`id_usuario_registro`),
  ADD KEY `FK_status_disponibilidades_aparelhos_usuarios_at` (`id_usuario_at`);

--
-- Índices para tabela `status_distribuicoes`
--
ALTER TABLE `status_distribuicoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_status_distribuicoes_usuarios_registro` (`id_usuario_registro`),
  ADD KEY `FK_status_distribuicoes_usuarios_at` (`id_usuario_at`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aparelhos`
--
ALTER TABLE `aparelhos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `operadoras`
--
ALTER TABLE `operadoras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `status_condicoes_aparelhos`
--
ALTER TABLE `status_condicoes_aparelhos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `status_disponibilidades_aparelhos`
--
ALTER TABLE `status_disponibilidades_aparelhos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aparelhos`
--
ALTER TABLE `aparelhos`
  ADD CONSTRAINT `FK_aparelhos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_aparelhos_modelos` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_aparelhos_status_condicoes` FOREIGN KEY (`id_status_condicao_aparelho`) REFERENCES `status_condicoes_aparelhos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_aparelhos_status_disponibilidade_aparelhos` FOREIGN KEY (`id_status_disponibilidade_aparelho`) REFERENCES `status_disponibilidades_aparelhos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_aparelhos_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_aparelhos_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `FK_categorias_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_categorias_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `FK_colaboradores_centro_custo` FOREIGN KEY (`id_centro_custo`) REFERENCES `centro_custo` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `distribuicoes`
--
ALTER TABLE `distribuicoes`
  ADD CONSTRAINT `FK_distribuicoes_aparelhos` FOREIGN KEY (`id_aparelho`) REFERENCES `aparelhos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_distribuicoes_colaboradores` FOREIGN KEY (`id_colaborador`) REFERENCES `colaboradores` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_distribuicoes_linhas` FOREIGN KEY (`id_linha`) REFERENCES `linhas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_distribuicoes_status_distribuicoes` FOREIGN KEY (`id_status_distribuicao`) REFERENCES `status_distribuicoes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_distribuicoes_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_distribuicoes_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `linhas`
--
ALTER TABLE `linhas`
  ADD CONSTRAINT `FK_linhas_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_linhas_operadoras` FOREIGN KEY (`id_operadora`) REFERENCES `operadoras` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_linhas_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_linhas_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `marcas`
--
ALTER TABLE `marcas`
  ADD CONSTRAINT `FK_marcas_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_marcas_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `FK_modelos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_modelos_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_modelos_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `operadoras`
--
ALTER TABLE `operadoras`
  ADD CONSTRAINT `FK_operadoras_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `status_condicoes_aparelhos`
--
ALTER TABLE `status_condicoes_aparelhos`
  ADD CONSTRAINT `FK_status_condicoes_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_status_condicoes_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `status_disponibilidades_aparelhos`
--
ALTER TABLE `status_disponibilidades_aparelhos`
  ADD CONSTRAINT `FK_status_disponibilidades_aparelhos_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_status_disponibilidades_aparelhos_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `status_distribuicoes`
--
ALTER TABLE `status_distribuicoes`
  ADD CONSTRAINT `FK_status_distribuicoes_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_status_distribuicoes_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
