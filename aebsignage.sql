-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30-Mar-2018 às 18:46
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aebsignage`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ementas`
--

CREATE TABLE IF NOT EXISTS `ementas` (
`ID` int(11) NOT NULL,
  `periodo` tinyint(1) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `semana` int(5) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `dia` varchar(7) DEFAULT NULL,
  `sopa` varchar(100) NOT NULL,
  `prato` varchar(255) NOT NULL,
  `salada` varchar(100) NOT NULL,
  `sobremesa` varchar(100) NOT NULL,
  `pao` varchar(100) NOT NULL,
  `mostrar` tinyint(1) NOT NULL DEFAULT '1',
  `feriado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ementas1`
--

CREATE TABLE IF NOT EXISTS `ementas1` (
`ID` int(11) NOT NULL,
  `periodo` tinyint(1) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `semana` int(5) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `dia` varchar(7) DEFAULT NULL,
  `sopa` varchar(100) NOT NULL,
  `prato` varchar(255) NOT NULL,
  `salada` varchar(100) NOT NULL,
  `sobremesa` varchar(100) NOT NULL,
  `pao` varchar(100) NOT NULL,
  `mostrar` tinyint(1) NOT NULL DEFAULT '1',
  `feriado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ementas1`
--

INSERT INTO `ementas1` (`ID`, `periodo`, `tipo`, `semana`, `data`, `dia`, `sopa`, `prato`, `salada`, `sobremesa`, `pao`, `mostrar`, `feriado`) VALUES
(1, 2, 1, 1, '2018-01-01', 'Segunda', '', '', '', '', '', 1, 0),
(2, 2, 1, 1, '2018-01-02', 'Terça', '', '', '', '', '', 1, 0),
(3, 2, 1, 1, '2018-01-03', 'Quarta', 'Saloia', 'Massada de Atum', 'Alface, tomate e beterraba', 'Fruta da época (min. 3 variedades)', 'Pão de mistura', 1, 0),
(5, 2, 1, 1, '2018-01-04', 'Quinta', 'Creme de legumes', 'Frango estufado com ervilhas e arroz', 'Tomate, milho e cebola', 'Fruta da época (min. 3 variedades)', 'Pão de mistura', 1, 0),
(6, 2, 1, 1, '2018-01-05', 'Sexta', 'Grão com couve lombarda', 'Bacalhau à Brás', 'Alface, beterraba e cenoura', 'Fruta da época (min. 3 variedades) / Fruta assada', 'Pão de mistura', 1, 0),
(7, 2, 1, 2, '2018-01-08', 'Segunda', 'Couve branca com cenoura ripada', 'Esparguete à Bolonhesa', 'Alface, cebola e tomate', 'Fruta da época (min. 3 variedades) ', 'Pão de mistura', 1, 0),
(8, 2, 1, 2, '2018-01-09', 'Terça', 'Feijão vermelho com hortaliça', 'Pescada no forno com batata e brócolos cozidos', 'Alface, milho e tomate', 'Fruta da época (min. 3 variedades) / Pudim', 'Pão de mistura', 1, 0),
(9, 2, 1, 2, '2018-01-10', 'Quarta', 'Creme de abóbora com espinafres', 'Coxas de frango assadas com espirais e cenoura', 'Alface, pepino e tomate', 'Fruta da época (min. 3 variedades)', 'Pão de mistura', 1, 0),
(10, 2, 1, 2, '2018-01-11', 'Quinta', 'Caldo verde', 'Arroz de frutos do mar (abrótea, camarão e berbigão)', 'Alface, beterraba e milho', 'Fruta da época (min. 3 variedades) / Fruta cozida', 'Pão de mistura', 1, 0),
(11, 2, 1, 2, '2018-01-12', 'Sexta', 'Sopa da horta', 'Jardineira de Vitela', 'Cenoura, couve roxa e pepino', 'Fruta da época (min. 3 variedades)', 'Pão de mistura', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE IF NOT EXISTS `utilizadores` (
`ID` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`ID`, `username`, `email`, `password`, `active`) VALUES
(1, 'admin', 'admin@nowhere.com', '123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ementas`
--
ALTER TABLE `ementas`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ementas1`
--
ALTER TABLE `ementas1`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ementas`
--
ALTER TABLE `ementas`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ementas1`
--
ALTER TABLE `ementas1`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
