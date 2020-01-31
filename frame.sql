-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Out-2019 às 02:40
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `frame`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aud_auditoria`
--

CREATE TABLE `aud_auditoria` (
  `id_auditoria` int(11) NOT NULL,
  `dt_registro` datetime NOT NULL,
  `str_usr_criador` varchar(50) NOT NULL,
  `id_generica_tabela` int(11) NOT NULL,
  `str_sofre_acao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aud_generica_tabela`
--

CREATE TABLE `aud_generica_tabela` (
  `id_generica_tabela` int(11) NOT NULL,
  `str_descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aud_generica_tabela`
--

INSERT INTO `aud_generica_tabela` (`id_generica_tabela`, `str_descricao`) VALUES
(1, 'Novo usuário cadastrador'),
(2, 'Atualizado os dados do usuário'),
(3, 'Novo perfil cadastrado'),
(4, 'Atualizado os dados do perfil'),
(5, 'Novo'),
(6, 'Usado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gr_acesso`
--

CREATE TABLE `gr_acesso` (
  `id_acesso` bigint(20) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_view` bigint(20) NOT NULL,
  `visualizar` int(11) NOT NULL,
  `cadastrar` int(11) NOT NULL,
  `alterar` int(11) NOT NULL,
  `excluir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gr_acesso`
--

INSERT INTO `gr_acesso` (`id_acesso`, `id_perfil`, `id_view`, `visualizar`, `cadastrar`, `alterar`, `excluir`) VALUES
(3, 1, 4, 1, 1, 1, 1),
(4, 1, 40, 1, 1, 1, 1),
(5, 1, 19, 1, 1, 1, 1),
(6, 1, 20, 1, 1, 1, 1),
(7, 1, 17, 1, 1, 1, 1),
(8, 1, 23, 1, 1, 1, 1),
(9, 1, 39, 1, 1, 1, 1),
(10, 1, 131, 1, 1, 1, 1),
(11, 1, 1, 1, 1, 1, 1),
(12, 1, 126, 1, 1, 1, 1),
(13, 1, 2, 1, 1, 1, 1),
(14, 1, 3, 1, 1, 1, 1),
(15, 1, 6, 1, 1, 1, 1),
(16, 1, 7, 1, 1, 1, 1),
(17, 1, 12, 1, 1, 1, 1),
(18, 1, 13, 1, 1, 1, 1),
(19, 1, 15, 1, 1, 1, 1),
(20, 1, 16, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gr_modulo`
--

CREATE TABLE `gr_modulo` (
  `id_modulo` int(11) NOT NULL,
  `str_modulo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gr_modulo`
--

INSERT INTO `gr_modulo` (`id_modulo`, `str_modulo`) VALUES
(1, 'login'),
(2, 'modulo'),
(3, 'acesso'),
(5, 'perfil'),
(6, 'inicio'),
(8, 'usuario'),
(10, 'view'),
(12, 'erro'),
(15, 'auditoria'),
(66, 'projeto'),
(67, 'temp');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gr_perfil`
--

CREATE TABLE `gr_perfil` (
  `id_perfil` int(11) NOT NULL,
  `str_perfil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gr_perfil`
--

INSERT INTO `gr_perfil` (`id_perfil`, `str_perfil`) VALUES
(1, 'Administrador'),
(2, 'Consultante');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gr_usuario`
--

CREATE TABLE `gr_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `str_login` varchar(255) NOT NULL,
  `str_situacao` varchar(1) NOT NULL,
  `str_telefone` varchar(255) NOT NULL,
  `str_email` varchar(255) NOT NULL,
  `str_nome` varchar(255) NOT NULL,
  `dt_registro` varchar(255) NOT NULL,
  `str_usr_criador` varchar(255) NOT NULL,
  `str_senha` varchar(255) NOT NULL,
  `str_cpf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gr_usuario`
--

INSERT INTO `gr_usuario` (`id_usuario`, `id_perfil`, `str_login`, `str_situacao`, `str_telefone`, `str_email`, `str_nome`, `dt_registro`, `str_usr_criador`, `str_senha`, `str_cpf`) VALUES
(4, 1, 'Samuel.santos', 'A', '(61) 98409-9965', 'samuka10fute@hotmail.com', 'Samuel dos santos cruz', '2019-10-17 22:15:12', 'samuel.cruz', '2b856e66e9d7bd2f4674098c7fae5ebb', '048.769.851-70'),
(5, 1, 'jose.neto', 'A', '61986023581', 'neto-neon@live.com', 'jose martins de melo neto', '2019-10-27 18:28:46', 'Samuel.santos', '9915a73db66d9138dd73d7ad298e7b87', '059.098.821-20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gr_view`
--

CREATE TABLE `gr_view` (
  `id_view` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `str_view` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gr_view`
--

INSERT INTO `gr_view` (`id_view`, `id_modulo`, `str_view`) VALUES
(1, 1, 'inicio'),
(2, 2, 'listarModulo'),
(3, 2, 'modal'),
(4, 3, 'listarAcesso'),
(6, 5, 'modal'),
(7, 5, 'listarPerfil'),
(10, 7, 'inicio'),
(11, 7, 'acessoNegado'),
(12, 8, 'listarUsuario'),
(13, 8, 'modal'),
(15, 10, 'listarView'),
(16, 10, 'modal'),
(17, 6, 'formulario'),
(19, 12, 'acessoNegado'),
(20, 12, 'inicio'),
(21, 13, 'acessoNegado'),
(22, 13, 'inicio'),
(23, 6, 'manual'),
(39, 6, 'mapa'),
(40, 15, 'auditoria-adm'),
(126, 1, 'manutencao'),
(131, 6, 'home');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_auditor`
--

CREATE TABLE `tb_auditor` (
  `cod_auditor` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_conta`
--

CREATE TABLE `tb_conta` (
  `cod_convenio` int(11) NOT NULL,
  `nr_conta` varchar(45) DEFAULT NULL,
  `nr_prontuario` int(11) DEFAULT NULL,
  `nr_atendimento` int(11) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `nr_protfat` int(11) DEFAULT NULL,
  `situacao` char(1) DEFAULT NULL,
  `dt_inicio` date DEFAULT NULL,
  `dt_fim` date DEFAULT NULL,
  `vlr_preglosa` double DEFAULT NULL,
  `vlr_posglosa` double DEFAULT NULL,
  `nr_protocmv` int(11) DEFAULT NULL,
  `nr_remessamv` int(11) DEFAULT NULL,
  `gau` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_convenios`
--

CREATE TABLE `tb_convenios` (
  `cod_convenio` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela ` tb_distribui`
--

CREATE TABLE ` tb_distribui` (
  `cod_distribui` int(11) NOT NULL,
  `nr_conta` varchar(45) DEFAULT NULL,
  `dt_recebi` date DEFAULT NULL,
  `dt_preanalise` date DEFAULT NULL,
  `dt_entrega` date DEFAULT NULL,
  `situacao` varchar(45) DEFAULT NULL,
  `observa` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pacientes`
--

CREATE TABLE `tb_pacientes` (
  `nr_prontuario` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `convenio` varchar(45) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aud_auditoria`
--
ALTER TABLE `aud_auditoria`
  ADD PRIMARY KEY (`id_auditoria`);

--
-- Índices para tabela `aud_generica_tabela`
--
ALTER TABLE `aud_generica_tabela`
  ADD PRIMARY KEY (`id_generica_tabela`);

--
-- Índices para tabela `gr_acesso`
--
ALTER TABLE `gr_acesso`
  ADD PRIMARY KEY (`id_acesso`);

--
-- Índices para tabela `gr_modulo`
--
ALTER TABLE `gr_modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Índices para tabela `gr_perfil`
--
ALTER TABLE `gr_perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Índices para tabela `gr_usuario`
--
ALTER TABLE `gr_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices para tabela `gr_view`
--
ALTER TABLE `gr_view`
  ADD PRIMARY KEY (`id_view`);

--
-- Índices para tabela `tb_auditor`
--
ALTER TABLE `tb_auditor`
  ADD PRIMARY KEY (`cod_auditor`);

--
-- Índices para tabela `tb_conta`
--
ALTER TABLE `tb_conta`
  ADD PRIMARY KEY (`cod_convenio`);

--
-- Índices para tabela `tb_convenios`
--
ALTER TABLE `tb_convenios`
  ADD PRIMARY KEY (`cod_convenio`);

--
-- Índices para tabela ` tb_distribui`
--
ALTER TABLE ` tb_distribui`
  ADD PRIMARY KEY (`cod_distribui`);

--
-- Índices para tabela `tb_pacientes`
--
ALTER TABLE `tb_pacientes`
  ADD PRIMARY KEY (`nr_prontuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aud_auditoria`
--
ALTER TABLE `aud_auditoria`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `aud_generica_tabela`
--
ALTER TABLE `aud_generica_tabela`
  MODIFY `id_generica_tabela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `gr_acesso`
--
ALTER TABLE `gr_acesso`
  MODIFY `id_acesso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `gr_modulo`
--
ALTER TABLE `gr_modulo`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de tabela `gr_perfil`
--
ALTER TABLE `gr_perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `gr_usuario`
--
ALTER TABLE `gr_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `gr_view`
--
ALTER TABLE `gr_view`
  MODIFY `id_view` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
