-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.18-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela sistema_adm.aparelhos
CREATE TABLE IF NOT EXISTS `aparelhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `imei1` (`imei1`),
  KEY `FK_aparelhos_modelos` (`id_modelo`),
  KEY `FK_aparelhos_marcas` (`id_marca`),
  KEY `FK_aparelhos_status_condicoes` (`id_status_condicao_aparelho`),
  KEY `FK_aparelhos_usuarios_registro` (`id_usuario_registro`),
  KEY `FK_aparelhos_usuarios_at` (`id_usuario_at`),
  KEY `status` (`status`),
  KEY `FK_aparelhos_status_disponibilidade_aparelhos` (`id_status_disponibilidade`) USING BTREE,
  CONSTRAINT `FK_aparelhos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_modelos` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_status_condicoes` FOREIGN KEY (`id_status_condicao_aparelho`) REFERENCES `status_condicoes_aparelhos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_status_disponibilidades` FOREIGN KEY (`id_status_disponibilidade`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.aparelhos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `aparelhos` DISABLE KEYS */;
/*!40000 ALTER TABLE `aparelhos` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `data_registro` datetime DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categorias_usuarios_registro` (`id_usuario_registro`),
  KEY `FK_categorias_usuarios_at` (`id_usuario_at`),
  KEY `status` (`status`),
  CONSTRAINT `FK_categorias_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_categorias_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.categorias: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
	(1, 'CATEGORIA I', 1, '2021-03-31 22:58:01', NULL, 1, NULL),
	(3, 'CATEGORIA II', 1, '2021-04-01 21:22:19', NULL, 1, NULL),
	(4, 'CATEGORIA III', 1, '2021-04-01 21:23:04', NULL, 1, NULL),
	(6, 'CATEGORIA IV', 1, '2021-04-01 21:23:45', NULL, 1, NULL),
	(7, 'CATEGORIA V', 1, '2021-04-01 21:24:53', NULL, 1, NULL);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.centro_custo
CREATE TABLE IF NOT EXISTS `centro_custo` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.centro_custo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `centro_custo` DISABLE KEYS */;
/*!40000 ALTER TABLE `centro_custo` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.centro_custo_import
CREATE TABLE IF NOT EXISTS `centro_custo_import` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.centro_custo_import: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `centro_custo_import` DISABLE KEYS */;
/*!40000 ALTER TABLE `centro_custo_import` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.colaboradores
CREATE TABLE IF NOT EXISTS `colaboradores` (
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
  `status` tinyint(3) unsigned DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_colaboradores_centro_custo` (`id_centro_custo`),
  CONSTRAINT `FK_colaboradores_centro_custo` FOREIGN KEY (`id_centro_custo`) REFERENCES `centro_custo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.colaboradores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;
/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.colaboradores_import
CREATE TABLE IF NOT EXISTS `colaboradores_import` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `id_centro_custo` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gestor` varchar(100) DEFAULT NULL,
  `situacao` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `matricula_coordenador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.colaboradores_import: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `colaboradores_import` DISABLE KEYS */;
/*!40000 ALTER TABLE `colaboradores_import` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.distribuicoes
CREATE TABLE IF NOT EXISTS `distribuicoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_aparelho` int(11) NOT NULL,
  `id_linha` int(11) NOT NULL,
  `id_colaborador` int(11) NOT NULL,
  `id_status_distribuicao` int(11) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_distribuicoes_aparelhos` (`id_aparelho`),
  KEY `FK_distribuicoes_colaboradores` (`id_colaborador`),
  KEY `FK_distribuicoes_linhas` (`id_linha`),
  KEY `FK_distribuicoes_status_distribuicoes` (`id_status_distribuicao`),
  KEY `FK_distribuicoes_usuarios_registro` (`id_usuario_registro`),
  KEY `FK_distribuicoes_usuarios_at` (`id_usuario_at`),
  CONSTRAINT `FK_distribuicoes_aparelhos` FOREIGN KEY (`id_aparelho`) REFERENCES `aparelhos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_colaboradores` FOREIGN KEY (`id_colaborador`) REFERENCES `colaboradores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_linhas` FOREIGN KEY (`id_linha`) REFERENCES `linhas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_status_distribuicoes` FOREIGN KEY (`id_status_distribuicao`) REFERENCES `status_distribuicoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.distribuicoes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `distribuicoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `distribuicoes` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.linhas
CREATE TABLE IF NOT EXISTS `linhas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_linha` varchar(200) NOT NULL,
  `codigo_chip` varchar(200) NOT NULL,
  `pin_puk1` varchar(200) DEFAULT NULL,
  `pin_puk2` varchar(200) DEFAULT NULL,
  `id_operadora` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_status_disponibilidade` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `numero_linha` (`numero_linha`),
  KEY `FK_linhas_categorias` (`id_categoria`),
  KEY `FK_linhas_operadoras` (`id_operadora`),
  KEY `FK_linhas_usuarios_registro` (`id_usuario_registro`),
  KEY `FK_linhas_usuarios_at` (`id_usuario_at`),
  KEY `status` (`status`),
  KEY `FK_linhas_status_disponibilidades` (`id_status_disponibilidade`),
  CONSTRAINT `FK_linhas_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_linhas_operadoras` FOREIGN KEY (`id_operadora`) REFERENCES `operadoras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_linhas_status_disponibilidades` FOREIGN KEY (`id_status_disponibilidade`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_linhas_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_linhas_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.linhas: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `linhas` DISABLE KEYS */;
INSERT INTO `linhas` (`id`, `numero_linha`, `codigo_chip`, `pin_puk1`, `pin_puk2`, `id_operadora`, `id_categoria`, `id_status_disponibilidade`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
	(1, '12345678901', '123456789012345', '123412345678', '012345678', 1, 3, 1, 0, '2021-04-01 22:08:13', '2021-04-02 15:40:49', 1, NULL),
	(2, '11986680241', '123456789012344', '321409876543', '412345678', 1, 1, 1, 0, '2021-04-02 10:00:36', '2021-04-02 15:40:50', 1, NULL),
	(3, '11987653421', '123456789012303', '123271230985', '912345678', 1, 1, 1, 0, '2021-04-02 11:03:50', '2021-04-02 15:40:51', 1, NULL);
/*!40000 ALTER TABLE `linhas` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.marcas
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_marcas_usuarios_registro` (`id_usuario_registro`),
  KEY `FK_marcas_usuarios_at` (`id_usuario_at`),
  CONSTRAINT `FK_marcas_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_marcas_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sistema_adm.marcas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
	(1, 'LG', 1, '2021-03-31 23:01:59', '2021-03-31 23:01:46', 1, NULL),
	(2, 'SAMSUNG', 1, '2021-03-31 23:01:59', '2021-03-31 23:01:46', 1, NULL);
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.modelos
CREATE TABLE IF NOT EXISTS `modelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_modelos_usuarios_registro` (`id_usuario_registro`),
  KEY `FK_modelos_usuarios_at` (`id_usuario_at`),
  KEY `FK_modelos_marcas` (`id_marca`),
  CONSTRAINT `FK_modelos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modelos_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modelos_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.modelos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `modelos` DISABLE KEYS */;
INSERT INTO `modelos` (`id`, `nome`, `id_marca`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
	(1, 'LG K40S', 1, 1, '2021-03-31 23:02:58', '2021-03-31 23:02:19', 1, NULL),
	(2, 'LG X STYLE', 1, 1, '2021-03-31 23:02:58', '2021-03-31 23:02:19', 1, NULL),
	(3, 'SAMSUNG TAB A6', 2, 1, '2021-03-31 23:02:58', '2021-03-31 23:02:19', 1, NULL);
/*!40000 ALTER TABLE `modelos` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.operadoras
CREATE TABLE IF NOT EXISTS `operadoras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_operadoras_usuarios_registro` (`id_usuario_registro`),
  CONSTRAINT `FK_operadoras_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.operadoras: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `operadoras` DISABLE KEYS */;
INSERT INTO `operadoras` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
	(1, 'CLARO', 1, '2021-03-31 23:01:18', '2021-03-31 23:01:14', 1, NULL),
	(2, 'OUTRA', 1, '2021-04-01 21:25:33', NULL, 1, NULL);
/*!40000 ALTER TABLE `operadoras` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.status_condicoes_aparelhos
CREATE TABLE IF NOT EXISTS `status_condicoes_aparelhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_status_condicoes_usuarios_registro` (`id_usuario_registro`),
  KEY `FK_status_condicoes_usuarios_at` (`id_usuario_at`),
  CONSTRAINT `FK_status_condicoes_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_status_condicoes_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.status_condicoes_aparelhos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `status_condicoes_aparelhos` DISABLE KEYS */;
INSERT INTO `status_condicoes_aparelhos` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
	(1, 'NOVO', 1, '2021-03-31 22:54:06', '2021-03-31 22:53:50', 1, NULL),
	(2, 'USADO', 1, '2021-03-31 22:54:06', '2021-03-31 22:53:50', 1, NULL),
	(3, 'DESCARTADO', 1, '2021-03-31 22:54:18', '2021-03-31 22:54:08', 1, NULL);
/*!40000 ALTER TABLE `status_condicoes_aparelhos` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.status_disponibilidades
CREATE TABLE IF NOT EXISTS `status_disponibilidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_status_disponibilidades_aparelhos_usuarios_registro` (`id_usuario_registro`),
  KEY `FK_status_disponibilidades_aparelhos_usuarios_at` (`id_usuario_at`),
  CONSTRAINT `FK_status_disponibilidades_aparelhos_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_status_disponibilidades_aparelhos_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sistema_adm.status_disponibilidades: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `status_disponibilidades` DISABLE KEYS */;
INSERT INTO `status_disponibilidades` (`id`, `nome`, `status`, `data_registro`, `data_at`, `id_usuario_registro`, `id_usuario_at`) VALUES
	(1, 'EM USO', 1, '2021-03-31 22:55:48', '2021-03-31 22:54:49', 1, NULL),
	(2, 'DISPONÍVEL', 1, '2021-03-31 22:55:48', '2021-03-31 22:54:49', 1, NULL),
	(3, 'MANUTENÇÃO', 1, '2021-03-31 22:55:48', '2021-03-31 22:54:49', 1, NULL);
/*!40000 ALTER TABLE `status_disponibilidades` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.status_distribuicoes
CREATE TABLE IF NOT EXISTS `status_distribuicoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_registro` datetime DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_status_distribuicoes_usuarios_registro` (`id_usuario_registro`),
  KEY `FK_status_distribuicoes_usuarios_at` (`id_usuario_at`),
  CONSTRAINT `FK_status_distribuicoes_usuarios_at` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_status_distribuicoes_usuarios_registro` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.status_distribuicoes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `status_distribuicoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_distribuicoes` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_adm.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nivel_acesso` varchar(100) NOT NULL,
  `data_criado` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_adm.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `email`, `nivel_acesso`, `data_criado`) VALUES
	(1, 'CLEYTON CARVALHO', 'N6169286', '123', 'cleyton.neves@claro.com.br', 'admin', '2021-03-31 22:53:02');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
