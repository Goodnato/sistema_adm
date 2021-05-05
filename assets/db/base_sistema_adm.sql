-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 28-Abr-2021 às 21:48
-- Versão do servidor: 8.0.23
-- versão do PHP: 7.4.16
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
  time_zone = "+00:00";
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
    `id_status_disponibilidade` int NOT NULL DEFAULT '1',
    `status` int NOT NULL DEFAULT '1',
    `nota_fiscal` varchar(50) DEFAULT NULL,
    `data_nota` date DEFAULT NULL,
    `valor` double(6, 2) NOT NULL,
    `valor_depreciado` double(6, 2) DEFAULT NULL,
    `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `id_usuario_registro` int NOT NULL,
    `id_usuario_at` int DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
  -- Extraindo dados da tabela `aparelhos`
  --
INSERT INTO
  `aparelhos` (
    `id`,
    `id_modelo`,
    `id_marca`,
    `imei1`,
    `id_status_condicao_aparelho`,
    `id_status_disponibilidade`,
    `status`,
    `nota_fiscal`,
    `data_nota`,
    `valor`,
    `valor_depreciado`,
    `data_registro`,
    `data_at`,
    `id_usuario_registro`,
    `id_usuario_at`
  )
VALUES
  (
    1,
    1,
    1,
    '123456789456123',
    1,
    1,
    1,
    '1451541451',
    '2021-06-28',
    121.54,
    NULL,
    '2021-04-13 22:20:16',
    '2021-04-28 21:41:55',
    1,
    1
  );
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
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
  -- Extraindo dados da tabela `categorias`
  --
INSERT INTO
  `categorias` (
    `id`,
    `nome`,
    `status`,
    `data_registro`,
    `data_at`,
    `id_usuario_registro`,
    `id_usuario_at`
  )
VALUES
  (
    1,
    'CATEGORIA I',
    1,
    '2021-03-31 22:58:01',
    NULL,
    1,
    NULL
  ),
  (
    3,
    'CATEGORIA II',
    1,
    '2021-04-01 21:22:19',
    NULL,
    1,
    NULL
  ),
  (
    4,
    'CATEGORIA III',
    1,
    '2021-04-01 21:23:04',
    NULL,
    1,
    NULL
  ),
  (
    6,
    'CATEGORIA IV',
    1,
    '2021-04-01 21:23:45',
    NULL,
    1,
    NULL
  ),
  (
    7,
    'CATEGORIA V',
    1,
    '2021-04-01 21:24:53',
    NULL,
    1,
    NULL
  );
-- --------------------------------------------------------
  --
  -- Estrutura da tabela `centro_custo`
  --
  CREATE TABLE `centro_custo` (
    `id` int NOT NULL,
    `nome` varchar(100) DEFAULT NULL,
    `area` varchar(100) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
-- --------------------------------------------------------
  --
  -- Estrutura da tabela `centro_custo_import`
  --
  CREATE TABLE `centro_custo_import` (
    `id` int NOT NULL,
    `nome` varchar(100) DEFAULT NULL,
    `area` varchar(100) DEFAULT NULL,
    `departamento` varchar(100) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
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
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
  -- Extraindo dados da tabela `colaboradores`
  --
INSERT INTO
  `colaboradores` (
    `id`,
    `nome`,
    `id_centro_custo`,
    `cargo`,
    `email`,
    `gestor`,
    `situacao`,
    `empresa`,
    `cidade`,
    `matricula_coordenador`,
    `status`
  )
VALUES
  (
    1234,
    'Renato',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    1
  );
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
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
-- --------------------------------------------------------
  --
  -- Estrutura da tabela `distribuicoes`
  --
  CREATE TABLE `distribuicoes` (
    `id` int NOT NULL,
    `id_aparelho` int DEFAULT NULL,
    `id_linha` int DEFAULT NULL,
    `id_colaborador` int NOT NULL,
    `id_status_disponibilidade` int NOT NULL,
    `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `id_usuario_registro` int NOT NULL,
    `id_usuario_at` int DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
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
    `id_status_disponibilidade` int DEFAULT '1',
    `status` tinyint NOT NULL DEFAULT '1',
    `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `id_usuario_registro` int NOT NULL,
    `id_usuario_at` int DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
  -- Extraindo dados da tabela `linhas`
  --
INSERT INTO
  `linhas` (
    `id`,
    `numero_linha`,
    `codigo_chip`,
    `pin_puk1`,
    `pin_puk2`,
    `id_operadora`,
    `id_categoria`,
    `id_status_disponibilidade`,
    `status`,
    `data_registro`,
    `data_at`,
    `id_usuario_registro`,
    `id_usuario_at`
  )
VALUES
  (
    1,
    '12345678901',
    '123456789012345',
    '123412345678',
    '012345678',
    1,
    3,
    1,
    1,
    '2021-04-01 22:08:13',
    '2021-04-05 16:05:46',
    1,
    NULL
  ),
  (
    2,
    '11986680241',
    '123456789012344',
    '321409876543',
    '412345678',
    1,
    1,
    1,
    1,
    '2021-04-02 10:00:36',
    '2021-04-05 16:05:48',
    1,
    NULL
  ),
  (
    3,
    '(11)98765-3421',
    '123456789012303',
    '123271230985',
    '912345678',
    1,
    1,
    1,
    1,
    '2021-04-02 11:03:50',
    '2021-04-28 21:43:45',
    1,
    NULL
  ),
  (
    7,
    '12345678923',
    '123456789012350',
    '127610987654',
    '945671234',
    1,
    1,
    1,
    1,
    '2021-04-05 16:18:01',
    NULL,
    1,
    NULL
  );
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
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 ROW_FORMAT = DYNAMIC;
--
  -- Extraindo dados da tabela `marcas`
  --
INSERT INTO
  `marcas` (
    `id`,
    `nome`,
    `status`,
    `data_registro`,
    `data_at`,
    `id_usuario_registro`,
    `id_usuario_at`
  )
VALUES
  (
    1,
    'LG',
    1,
    '2021-03-31 23:01:59',
    '2021-03-31 23:01:46',
    1,
    NULL
  ),
  (
    2,
    'SAMSUNG',
    1,
    '2021-03-31 23:01:59',
    '2021-03-31 23:01:46',
    1,
    NULL
  );
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
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
  -- Extraindo dados da tabela `modelos`
  --
INSERT INTO
  `modelos` (
    `id`,
    `nome`,
    `id_marca`,
    `status`,
    `data_registro`,
    `data_at`,
    `id_usuario_registro`,
    `id_usuario_at`
  )
VALUES
  (
    1,
    'LG K40S',
    1,
    1,
    '2021-03-31 23:02:58',
    '2021-03-31 23:02:19',
    1,
    NULL
  ),
  (
    2,
    'LG X STYLE',
    1,
    1,
    '2021-03-31 23:02:58',
    '2021-03-31 23:02:19',
    1,
    NULL
  ),
  (
    3,
    'SAMSUNG TAB A6',
    2,
    1,
    '2021-03-31 23:02:58',
    '2021-03-31 23:02:19',
    1,
    NULL
  );
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
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
  -- Extraindo dados da tabela `operadoras`
  --
INSERT INTO
  `operadoras` (
    `id`,
    `nome`,
    `status`,
    `data_registro`,
    `data_at`,
    `id_usuario_registro`,
    `id_usuario_at`
  )
VALUES
  (
    1,
    'CLARO',
    1,
    '2021-03-31 23:01:18',
    '2021-03-31 23:01:14',
    1,
    NULL
  ),
  (
    2,
    'OUTRA',
    1,
    '2021-04-01 21:25:33',
    NULL,
    1,
    NULL
  );
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
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
  -- Extraindo dados da tabela `status_condicoes_aparelhos`
  --
INSERT INTO
  `status_condicoes_aparelhos` (
    `id`,
    `nome`,
    `status`,
    `data_registro`,
    `data_at`,
    `id_usuario_registro`,
    `id_usuario_at`
  )
VALUES
  (
    1,
    'NOVO',
    1,
    '2021-03-31 22:54:06',
    '2021-03-31 22:53:50',
    1,
    NULL
  ),
  (
    2,
    'USADO',
    1,
    '2021-03-31 22:54:06',
    '2021-03-31 22:53:50',
    1,
    NULL
  ),
  (
    3,
    'DESCARTADO',
    1,
    '2021-03-31 22:54:18',
    '2021-03-31 22:54:08',
    1,
    NULL
  ),
  (
    4,
    'EM MANUTENÇÃO',
    1,
    '2021-04-27 21:42:19',
    '2021-04-27 21:42:06',
    1,
    NULL
  );
-- --------------------------------------------------------
  --
  -- Estrutura da tabela `status_disponibilidades`
  --
  CREATE TABLE `status_disponibilidades` (
    `id` int NOT NULL,
    `nome` varchar(100) NOT NULL,
    `status` tinyint NOT NULL DEFAULT '1',
    `data_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `data_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `id_usuario_registro` int NOT NULL,
    `id_usuario_at` int DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 ROW_FORMAT = DYNAMIC;
--
  -- Extraindo dados da tabela `status_disponibilidades`
  --
INSERT INTO
  `status_disponibilidades` (
    `id`,
    `nome`,
    `status`,
    `data_registro`,
    `data_at`,
    `id_usuario_registro`,
    `id_usuario_at`
  )
VALUES
  (
    1,
    'EM USO',
    1,
    '2021-03-31 22:55:48',
    '2021-03-31 22:54:49',
    1,
    NULL
  ),
  (
    2,
    'DISPONÍVEL',
    1,
    '2021-03-31 22:55:48',
    '2021-03-31 22:54:49',
    1,
    NULL
  ),
  (
    3,
    'MANUTENÇÃO',
    1,
    '2021-03-31 22:55:48',
    '2021-03-31 22:54:49',
    1,
    NULL
  );
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
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
  -- Extraindo dados da tabela `status_distribuicoes`
  --
INSERT INTO
  `status_distribuicoes` (
    `id`,
    `nome`,
    `data_registro`,
    `data_at`,
    `id_usuario_registro`,
    `id_usuario_at`
  )
VALUES
  (
    1,
    'EM USO',
    '2021-04-27 21:41:33',
    '2021-04-27 21:36:03',
    1,
    NULL
  ),
  (
    2,
    'DISPONÍVEL',
    '2021-04-27 21:41:33',
    '2021-04-27 21:36:03',
    1,
    NULL
  );
-- --------------------------------------------------------
  --
  -- Estrutura da tabela `usuarios`
  --
  CREATE TABLE `usuarios` (
    `id` int NOT NULL,
    `nome` varchar(100) NOT NULL,
    `login` varchar(100) NOT NULL,
    `senha` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `nivel_acesso` varchar(100) NOT NULL,
    `data_criado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
  -- Extraindo dados da tabela `usuarios`
  --
INSERT INTO
  `usuarios` (
    `id`,
    `nome`,
    `login`,
    `senha`,
    `email`,
    `nivel_acesso`,
    `data_criado`
  )
VALUES
  (
    1,
    'CLEYTON CARVALHO',
    'N6169286',
    '123',
    'cleyton.neves@claro.com.br',
    'admin',
    '2021-03-31 22:53:02'
  );
--
  -- Índices para tabelas despejadas
  --
  --
  -- Índices para tabela `aparelhos`
  --
ALTER TABLE
  `aparelhos`
ADD
  PRIMARY KEY (`id`) USING BTREE,
ADD
  UNIQUE KEY `imei1` (`imei1`) USING BTREE;
--
  -- Índices para tabela `categorias`
  --
ALTER TABLE
  `categorias`
ADD
  PRIMARY KEY (`id`);
--
  -- Índices para tabela `centro_custo`
  --
ALTER TABLE
  `centro_custo`
ADD
  PRIMARY KEY (`id`);
--
  -- Índices para tabela `centro_custo_import`
  --
ALTER TABLE
  `centro_custo_import`
ADD
  PRIMARY KEY (`id`);
--
  -- Índices para tabela `colaboradores`
  --
ALTER TABLE
  `colaboradores`
ADD
  PRIMARY KEY (`id`);
--
  -- Índices para tabela `colaboradores_import`
  --
ALTER TABLE
  `colaboradores_import`
ADD
  PRIMARY KEY (`id`) USING BTREE;
--
  -- Índices para tabela `distribuicoes`
  --
ALTER TABLE
  `distribuicoes`
ADD
  PRIMARY KEY (`id`);
--
  -- Índices para tabela `linhas`
  --
ALTER TABLE
  `linhas`
ADD
  PRIMARY KEY (`id`) USING BTREE;
--
  -- Índices para tabela `marcas`
  --
ALTER TABLE
  `marcas`
ADD
  PRIMARY KEY (`id`) USING BTREE;
--
  -- Índices para tabela `modelos`
  --
ALTER TABLE
  `modelos`
ADD
  PRIMARY KEY (`id`) USING BTREE;
--
  -- Índices para tabela `operadoras`
  --
ALTER TABLE
  `operadoras`
ADD
  PRIMARY KEY (`id`);
--
  -- Índices para tabela `status_condicoes_aparelhos`
  --
ALTER TABLE
  `status_condicoes_aparelhos`
ADD
  PRIMARY KEY (`id`);
--
  -- Índices para tabela `status_disponibilidades`
  --
ALTER TABLE
  `status_disponibilidades`
ADD
  PRIMARY KEY (`id`) USING BTREE;
--
  -- Índices para tabela `status_distribuicoes`
  --
ALTER TABLE
  `status_distribuicoes`
ADD
  PRIMARY KEY (`id`);
--
  -- Índices para tabela `usuarios`
  --
ALTER TABLE
  `usuarios`
ADD
  PRIMARY KEY (`id`);
--
  -- AUTO_INCREMENT de tabelas despejadas
  --
  --
  -- AUTO_INCREMENT de tabela `aparelhos`
  --
ALTER TABLE
  `aparelhos`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
  -- AUTO_INCREMENT de tabela `categorias`
  --
ALTER TABLE
  `categorias`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 8;
--
  -- AUTO_INCREMENT de tabela `distribuicoes`
  --
ALTER TABLE
  `distribuicoes`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT;
--
  -- AUTO_INCREMENT de tabela `linhas`
  --
ALTER TABLE
  `linhas`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 8;
--
  -- AUTO_INCREMENT de tabela `marcas`
  --
ALTER TABLE
  `marcas`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
  -- AUTO_INCREMENT de tabela `modelos`
  --
ALTER TABLE
  `modelos`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
  -- AUTO_INCREMENT de tabela `operadoras`
  --
ALTER TABLE
  `operadoras`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
  -- AUTO_INCREMENT de tabela `status_condicoes_aparelhos`
  --
ALTER TABLE
  `status_condicoes_aparelhos`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
--
  -- AUTO_INCREMENT de tabela `status_disponibilidades`
  --
ALTER TABLE
  `status_disponibilidades`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
  -- AUTO_INCREMENT de tabela `usuarios`
  --
ALTER TABLE
  `usuarios`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
  COMMIT;
  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;