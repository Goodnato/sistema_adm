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
  UNIQUE KEY `imei1` (`imei1`) USING BTREE,
  KEY `FK_aparelhos_modelos` (`id_modelo`),
  KEY `FK_aparelhos_marcas` (`id_marca`),
  KEY `FK_aparelhos_status_condicoes_aparelhos` (`id_status_condicao_aparelho`),
  KEY `FK_aparelhos_status_disponibilidades` (`id_status_disponibilidade`),
  KEY `FK_aparelhos_usuarios` (`id_usuario_registro`),
  KEY `FK_aparelhos_usuarios_2` (`id_usuario_at`),
  CONSTRAINT `FK_aparelhos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_modelos` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_status_condicoes_aparelhos` FOREIGN KEY (`id_status_condicao_aparelho`) REFERENCES `status_condicoes_aparelhos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_status_disponibilidades` FOREIGN KEY (`id_status_disponibilidade`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_aparelhos_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

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
  KEY `FK_categorias_usuarios` (`id_usuario_registro`),
  KEY `FK_categorias_usuarios_2` (`id_usuario_at`),
  CONSTRAINT `FK_categorias_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_categorias_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela sistema_adm.centro_custo
CREATE TABLE IF NOT EXISTS `centro_custo` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela sistema_adm.centro_custo_import
CREATE TABLE IF NOT EXISTS `centro_custo_import` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

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

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela sistema_adm.distribuicoes
CREATE TABLE IF NOT EXISTS `distribuicoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_aparelho` int(11) DEFAULT NULL,
  `id_linha` int(11) DEFAULT NULL,
  `id_colaborador` int(11) NOT NULL,
  `id_status_disponibilidade` int(11) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `id_usuario_registro` int(11) NOT NULL,
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_distribuicoes_aparelhos` (`id_aparelho`),
  KEY `FK_distribuicoes_linhas` (`id_linha`),
  KEY `FK_distribuicoes_colaboradores` (`id_colaborador`),
  KEY `FK_distribuicoes_status_disponibilidades` (`id_status_disponibilidade`),
  KEY `FK_distribuicoes_usuarios` (`id_usuario_registro`),
  KEY `FK_distribuicoes_usuarios_2` (`id_usuario_at`),
  CONSTRAINT `FK_distribuicoes_aparelhos` FOREIGN KEY (`id_aparelho`) REFERENCES `aparelhos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_colaboradores` FOREIGN KEY (`id_colaborador`) REFERENCES `colaboradores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_linhas` FOREIGN KEY (`id_linha`) REFERENCES `linhas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_status_disponibilidades` FOREIGN KEY (`id_status_disponibilidade`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_distribuicoes_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela sistema_adm.linhas
CREATE TABLE IF NOT EXISTS `linhas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_usuario_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_linhas_operadoras` (`id_operadora`),
  KEY `FK_linhas_categorias` (`id_categoria`),
  KEY `FK_linhas_status_disponibilidades` (`id_status_disponibilidade`),
  KEY `FK_linhas_usuarios` (`id_usuario_registro`),
  KEY `FK_linhas_usuarios_2` (`id_usuario_at`),
  CONSTRAINT `FK_linhas_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_linhas_operadoras` FOREIGN KEY (`id_operadora`) REFERENCES `operadoras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_linhas_status_disponibilidades` FOREIGN KEY (`id_status_disponibilidade`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_linhas_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_linhas_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela sistema_adm.logs_alteracoes
CREATE TABLE IF NOT EXISTS `logs_alteracoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabela` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `identificador` int(11) NOT NULL,
  `valor_antigo` text NOT NULL,
  `valor_novo` text NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_logs_alteracoes_usuarios` (`id_usuario`),
  CONSTRAINT `FK_logs_alteracoes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

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
  KEY `FK_marcas_usuarios` (`id_usuario_registro`),
  KEY `FK_marcas_status_disponibilidades` (`id_usuario_at`),
  CONSTRAINT `FK_marcas_status_disponibilidades` FOREIGN KEY (`id_usuario_at`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_marcas_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Exportação de dados foi desmarcado.

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
  KEY `FK_modelos_marcas` (`id_marca`),
  KEY `FK_modelos_usuarios` (`id_usuario_registro`),
  KEY `FK_modelos_usuarios_2` (`id_usuario_at`),
  CONSTRAINT `FK_modelos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modelos_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modelos_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

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
  KEY `FK_operadoras_usuarios` (`id_usuario_registro`),
  KEY `FK_operadoras_usuarios_2` (`id_usuario_at`),
  CONSTRAINT `FK_operadoras_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_operadoras_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

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
  KEY `FK_status_condicoes_aparelhos_usuarios` (`id_usuario_registro`),
  KEY `FK_status_condicoes_aparelhos_usuarios_2` (`id_usuario_at`),
  CONSTRAINT `FK_status_condicoes_aparelhos_usuarios` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_status_condicoes_aparelhos_usuarios_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

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
  KEY `FK_status_disponibilidades_status_disponibilidades` (`id_usuario_registro`),
  KEY `FK_status_disponibilidades_status_disponibilidades_2` (`id_usuario_at`),
  CONSTRAINT `FK_status_disponibilidades_status_disponibilidades` FOREIGN KEY (`id_usuario_registro`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_status_disponibilidades_status_disponibilidades_2` FOREIGN KEY (`id_usuario_at`) REFERENCES `status_disponibilidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Exportação de dados foi desmarcado.

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

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
