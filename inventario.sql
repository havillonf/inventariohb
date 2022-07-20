-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 13-Dez-2019 às 03:07
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventario`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresa`
--

DROP TABLE IF EXISTS `tb_empresa`;
CREATE TABLE IF NOT EXISTS `tb_empresa` (
  `emp_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_nome` varchar(30) NOT NULL,
  `emp_cnpj` varchar(18) NOT NULL,
  `emp_senha` varchar(30) NOT NULL,
  PRIMARY KEY (`emp_id`),
  UNIQUE KEY `emp_cnpj` (`emp_cnpj`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_empresa`
--

INSERT INTO `tb_empresa` (`emp_id`, `emp_nome`, `emp_cnpj`, `emp_senha`) VALUES
(1, 'a', 'a', 'a'),
(2, 'k', 'k', 'k'),
(3, 'sas', 'sus', 'ssi'),
(4, 'ss', 'sssus', 'ss'),
(6, 'ssa', '1ssus', 'ss'),
(7, 'nome', '11.111.111/1111-11', 'senha'),
(8, 'Fábrica Fortaleza - Amori', '43.545.354/3412-33', 'fortaleza');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_emp_for`
--

DROP TABLE IF EXISTS `tb_emp_for`;
CREATE TABLE IF NOT EXISTS `tb_emp_for` (
  `ef_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_id` int(10) NOT NULL,
  `for_id` int(10) NOT NULL,
  PRIMARY KEY (`ef_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_emp_for`
--

INSERT INTO `tb_emp_for` (`ef_id`, `emp_id`, `for_id`) VALUES
(1, 1, 1),
(2, 8, 1),
(3, 7, 1),
(4, 7, 9),
(5, 7, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fornecedor`
--

DROP TABLE IF EXISTS `tb_fornecedor`;
CREATE TABLE IF NOT EXISTS `tb_fornecedor` (
  `for_id` int(10) NOT NULL AUTO_INCREMENT,
  `for_nome` varchar(50) NOT NULL,
  `for_cidade` varchar(30) NOT NULL,
  `for_bairro` varchar(30) NOT NULL,
  `for_logradouro` varchar(30) NOT NULL,
  `for_endereco` varchar(50) NOT NULL,
  `for_numero` int(10) NOT NULL,
  `for_complemento` varchar(30) DEFAULT NULL,
  `for_cnpj` varchar(18) NOT NULL,
  PRIMARY KEY (`for_id`),
  UNIQUE KEY `for_nome` (`for_nome`),
  UNIQUE KEY `for_cnpj` (`for_cnpj`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_fornecedor`
--

INSERT INTO `tb_fornecedor` (`for_id`, `for_nome`, `for_cidade`, `for_bairro`, `for_logradouro`, `for_endereco`, `for_numero`, `for_complemento`, `for_cnpj`) VALUES
(1, 'b', 'b', 'b', 'b', 'b', 110, 'b', '33.332.121/1111-11'),
(2, 'a', 'a', 'a', 'a', 'a', 3, NULL, '34.343.434/3434-34'),
(3, 'bv', 'vbvbv', 'vbvbv', 'bvbvb', 'bvb', 44, NULL, '44.444.444/4477-77'),
(4, 'sad', 'asd', 'sda', '', 'asdaq', 44444, NULL, '90.080.897/8998-08'),
(5, 'dddddddd', 'ddddddddd', 'eeeeeee', '2', '3', 4, NULL, '55.555.555/5555-55'),
(6, 'c', 'ddddddddd', 'f', 'g', 'trttrtr', 66, NULL, '33.333.333/3333-33'),
(7, 'rrrrrr', 'rrrrrrrrrr', 'rrrrrrr', 'rrrrrrrrr', 'rrrrrrrr', 4444, NULL, '12.132.131/2323-13'),
(8, 'vvvvvvv', 'vvvvvv', 'vvvvvvv', 'vvvvvv', 'vvvvvvv', 333222, NULL, '22.222.222/2222-22'),
(9, 'ss', 'dddd3', 'd', 'f', 'w', 6, NULL, '33.333.334/4444-22'),
(10, 'frf', 'eeee', 'rrrrrrrrrr', 'f', 'g', 4, NULL, '55.555.555/4443-33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produtos`
--

DROP TABLE IF EXISTS `tb_produtos`;
CREATE TABLE IF NOT EXISTS `tb_produtos` (
  `pro_id` int(10) NOT NULL AUTO_INCREMENT,
  `pro_nome` varchar(30) NOT NULL,
  `pro_preco` double(10,2) NOT NULL,
  `pro_quantidade` int(10) NOT NULL,
  `ef_id` int(10) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`pro_id`, `pro_nome`, `pro_preco`, `pro_quantidade`, `ef_id`) VALUES
(1, 'b', 2.50, 8, 1),
(2, 'nome', 10.05, 2, 1),
(3, 'Produto', 2.00, 3, 0),
(19, 't', 3.00, 5, 3),
(21, 'awaw', 22.00, 33, 3),
(22, 'hhhhh', 22.00, 22, 3),
(24, 'Bolacha', 3.00, 40, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
