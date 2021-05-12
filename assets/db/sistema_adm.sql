-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Maio-2021 às 00:48
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


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
  `id` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `imei1` varchar(200) NOT NULL,
  `id_status_condicao_aparelho` int(11) NOT NULL,
  `id_status_disponibilidade` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `nota_fiscal` varchar(50) DEFAULT NULL,
  `data_nota` date DEFAULT NULL,
  `valor` double(6,2) NOT NULL,
  `valor_depreciado` double(6,2) DEFAULT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `data_registro` datetime DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `centro_custo`
--

CREATE TABLE `centro_custo` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `centro_custo_import`
--

CREATE TABLE `centro_custo_import` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `id_centro_custo` int(11) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gestor` varchar(100) DEFAULT NULL,
  `situacao` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `matricula_coordenador` int(11) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores_import`
--

CREATE TABLE `colaboradores_import` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `id_centro_custo` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gestor` varchar(100) DEFAULT NULL,
  `situacao` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `matricula_coordenador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `distribuicoes`
--

CREATE TABLE `distribuicoes` (
  `id` int(11) NOT NULL,
  `id_aparelho` int(11) DEFAULT NULL,
  `id_linha` int(11) DEFAULT NULL,
  `id_colaborador` int(11) NOT NULL,
  `id_status_disponibilidade` int(11) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `linhas`
--

CREATE TABLE `linhas` (
  `id` int(11) NOT NULL,
  `numero_linha` varchar(200) NOT NULL,
  `codigo_chip` varchar(200) NOT NULL,
  `pin_puk1` varchar(200) DEFAULT NULL,
  `pin_puk2` varchar(200) DEFAULT NULL,
  `id_operadora` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_status_disponibilidade` int(11) DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs_alteracoes`
--

CREATE TABLE `logs_alteracoes` (
  `id` int(11) NOT NULL,
  `tabela` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `identificador` int(11) NOT NULL,
  `valor_antigo` text NOT NULL,
  `valor_novo` text NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelos`
--

CREATE TABLE `modelos` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `operadoras`
--

CREATE TABLE `operadoras` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_condicoes_aparelhos`
--

CREATE TABLE `status_condicoes_aparelhos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `status_condicoes_aparelhos`
--

INSERT INTO `status_condicoes_aparelhos` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
(1, 'NOVO', 1, '2021-05-07 23:04:43', '2021-05-07 23:04:06', 1, NULL),
(2, 'USADO', 1, '2021-05-07 23:04:43', '2021-05-07 23:04:06', 1, NULL),
(3, 'DESCARTADO', 1, '2021-05-07 23:04:43', '2021-05-07 23:04:06', 1, NULL),
(4, 'MANUNTENÇÃO', 1, '2021-05-07 23:04:43', '2021-05-07 23:04:06', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_disponibilidades`
--

CREATE TABLE `status_disponibilidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `status_disponibilidades`
--

INSERT INTO `status_disponibilidades` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
(1, 'EM USO', 1, '2021-05-07 23:03:59', '2021-05-07 23:03:28', 1, NULL),
(2, 'DISPONÍVEL', 1, '2021-05-07 23:03:59', '2021-05-07 23:03:28', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nivel_acesso` varchar(100) NOT NULL,
  `data_criado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `email`, `nivel_acesso`, `data_criado`) VALUES
(1, 'CLEYTON', 'cleyton', '123', 'rsfd@d.com', '', '2021-05-07 23:03:17');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aparelhos`
--
ALTER TABLE `aparelhos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `imei1` (`imei1`) USING BTREE,
  ADD KEY `FK_aparelhos_modelos` (`id_modelo`),
  ADD KEY `FK_aparelhos_marcas` (`id_marca`),
  ADD KEY `FK_aparelhos_status_condicoes_aparelhos` (`id_status_condicao_aparelho`),
  ADD KEY `FK_aparelhos_status_disponibilidades` (`id_status_disponibilidade`),
  ADD KEY `FK_aparelhos_usuarios` (`id_usuario_registro`),
  ADD KEY `FK_aparelhos_usuarios_2` (`id_usuario_at`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_categorias_usuarios` (`id_usuario_registro`),
  ADD KEY `FK_categorias_usuarios_2` (`id_usuario_at`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `FK_distribuicoes_linhas` (`id_linha`),
  ADD KEY `FK_distribuicoes_colaboradores` (`id_colaborador`),
  ADD KEY `FK_distribuicoes_status_disponibilidades` (`id_status_disponibilidade`),
  ADD KEY `FK_distribuicoes_usuarios` (`id_usuario_registro`),
  ADD KEY `FK_distribuicoes_usuarios_2` (`id_usuario_at`);

--
-- Índices para tabela `linhas`
--
ALTER TABLE `linhas`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_linhas_operadoras` (`id_operadora`),
  ADD KEY `FK_linhas_categorias` (`id_categoria`),
  ADD KEY `FK_linhas_status_disponibilidades` (`id_status_disponibilidade`),
  ADD KEY `FK_linhas_usuarios` (`id_usuario_registro`),
  ADD KEY `FK_linhas_usuarios_2` (`id_usuario_at`);

--
-- Índices para tabela `logs_alteracoes`
--
ALTER TABLE `logs_alteracoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_logs_alteracoes_usuarios` (`id_usuario`);

--
-- Índices para tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_marcas_usuarios` (`id_usuario_registro`),
  ADD KEY `FK_marcas_status_disponibilidades` (`id_usuario_at`);

--
-- Índices para tabela `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_modelos_marcas` (`id_marca`),
  ADD KEY `FK_modelos_usuarios` (`id_usuario_registro`),
  ADD KEY `FK_modelos_usuarios_2` (`id_usuario_at`);

--
-- Índices para tabela `operadoras`
--
ALTER TABLE `operadoras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_operadoras_usuarios` (`id_usuario_registro`),
  ADD KEY `FK_operadoras_usuarios_2` (`id_usuario_at`);

--
-- Índices para tabela `status_condicoes_aparelhos`
--
ALTER TABLE `status_condicoes_aparelhos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_status_condicoes_aparelhos_usuarios` (`id_usuario_registro`),
  ADD KEY `FK_status_condicoes_aparelhos_usuarios_2` (`id_usuario_at`);

--
-- Índices para tabela `status_disponibilidades`
--
ALTER TABLE `status_disponibilidades`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_status_disponibilidades_status_disponibilidades` (`id_usuario_registro`),
  ADD KEY `FK_status_disponibilidades_status_disponibilidades_2` (`id_usuario_at`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `distribuicoes`
--
ALTER TABLE `distribuicoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `linhas`
--
ALTER TABLE `linhas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logs_alteracoes`
--
ALTER TABLE `logs_alteracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `operadoras`
--
ALTER TABLE `operadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `status_condicoes_aparelhos`
--
ALTER TABLE `status_condicoes_aparelhos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `status_disponibilidades`
--
ALTER TABLE `status_disponibilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aparelhos`
--
ALTER TABLE `aparelhos`
  ADD CONSTRAINT `FK_aparelhos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_aparelhos_modelos` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_aparelhos_status_condicoes_aparelhos` FOREIGN KEY (`id_status_condicao_aparelho`) REFERENCES `status_condicoes_aparelhos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_aparelhos_status_disponibilidades` FOREIGN KEY (`id_status_disponibilidade`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_aparelhos_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_aparelhos_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `FK_categorias_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_categorias_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `distribuicoes`
--
ALTER TABLE `distribuicoes`
  ADD CONSTRAINT `FK_distribuicoes_aparelhos` FOREIGN KEY (`id_aparelho`) REFERENCES `aparelhos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_distribuicoes_colaboradores` FOREIGN KEY (`id_colaborador`) REFERENCES `colaboradores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_distribuicoes_linhas` FOREIGN KEY (`id_linha`) REFERENCES `linhas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_distribuicoes_status_disponibilidades` FOREIGN KEY (`id_status_disponibilidade`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_distribuicoes_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_distribuicoes_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `linhas`
--
ALTER TABLE `linhas`
  ADD CONSTRAINT `FK_linhas_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_linhas_operadoras` FOREIGN KEY (`id_operadora`) REFERENCES `operadoras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_linhas_status_disponibilidades` FOREIGN KEY (`id_status_disponibilidade`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_linhas_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_linhas_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `logs_alteracoes`
--
ALTER TABLE `logs_alteracoes`
  ADD CONSTRAINT `FK_logs_alteracoes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `marcas`
--
ALTER TABLE `marcas`
  ADD CONSTRAINT `FK_marcas_status_disponibilidades` FOREIGN KEY (`id_usuario_at`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_marcas_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `FK_modelos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_modelos_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_modelos_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `operadoras`
--
ALTER TABLE `operadoras`
  ADD CONSTRAINT `FK_operadoras_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_operadoras_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `status_condicoes_aparelhos`
--
ALTER TABLE `status_condicoes_aparelhos`
  ADD CONSTRAINT `FK_status_condicoes_aparelhos_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_condicoes_aparelhos_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `status_disponibilidades`
--
ALTER TABLE `status_disponibilidades`
  ADD CONSTRAINT `FK_status_disponibilidades_status_disponibilidades` FOREIGN KEY (`id_usuario_registro`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_disponibilidades_status_disponibilidades_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;