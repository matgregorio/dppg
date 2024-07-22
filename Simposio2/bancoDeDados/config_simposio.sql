-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/07/2024 às 15:35
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `config_simposio`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `regulamento`
--

CREATE TABLE `regulamento` (
  `idRegulamento` int(11) NOT NULL,
  `textoRegulamento` varchar(250) NOT NULL,
  `arquivoRegulamento` text DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `regulamento`
--

INSERT INTO `regulamento` (`idRegulamento`, `textoRegulamento`, `arquivoRegulamento`, `idUsuario`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'novo teste <h1>isso tambem</h1>', NULL, 1, '2024-07-19 21:23:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `regulamento`
--
ALTER TABLE `regulamento`
  ADD PRIMARY KEY (`idRegulamento`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `regulamento`
--
ALTER TABLE `regulamento`
  MODIFY `idRegulamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
