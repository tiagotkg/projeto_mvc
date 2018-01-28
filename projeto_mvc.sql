-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Jan-2018 às 21:43
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_mvc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--
CREATE DATABASE projeto_mvc;
USE projeto_mvc;
CREATE TABLE `grupos` (
  `cd_grupo` int(11) NOT NULL,
  `grupo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`cd_grupo`, `grupo`) VALUES
(1, 'Grupo 1'),
(2, 'Grupo 2'),
(3, 'Grupo 3'),
(4, 'Grupo 4'),
(5, 'Grupo 5'),
(6, 'Grupo 6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `cd_pessoa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `dt_criacao` date NOT NULL,
  `dt_atualizacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas_grupos`
--

CREATE TABLE `pessoas_grupos` (
  `pessoas_cd_pessoa` int(11) NOT NULL,
  `grupos_cd_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`cd_grupo`);

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`cd_pessoa`);

--
-- Indexes for table `pessoas_grupos`
--
ALTER TABLE `pessoas_grupos`
  ADD PRIMARY KEY (`pessoas_cd_pessoa`,`grupos_cd_grupo`),
  ADD KEY `fk_pessoas_has_grupos_grupos1_idx` (`grupos_cd_grupo`),
  ADD KEY `fk_pessoas_has_grupos_pessoas_idx` (`pessoas_cd_pessoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `cd_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `cd_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pessoas_grupos`
--
ALTER TABLE `pessoas_grupos`
  ADD CONSTRAINT `fk_pessoas_has_grupos_grupos1` FOREIGN KEY (`grupos_cd_grupo`) REFERENCES `grupos` (`cd_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pessoas_has_grupos_pessoas` FOREIGN KEY (`pessoas_cd_pessoa`) REFERENCES `pessoas` (`cd_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
