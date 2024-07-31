-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/07/2024 às 03:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
  `textoRegulamento` text DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `arquivoRegulamento` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `regulamento`
--

INSERT INTO `regulamento` (`idRegulamento`, `textoRegulamento`, `idUsuario`, `arquivoRegulamento`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'teste', 2, 'teste.pdf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'novo teste <h1>isso tambem</h1>', 1, NULL, '2024-07-19 19:06:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `cpf` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `user_type` int(11) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `is_approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id`, `name`, `cpf`, `email`, `password`, `user_type`, `reset_token`, `created_at`, `updated_at`, `deleted_at`, `is_approved`) VALUES
(7, 'mateus pereira gregorio', 'admin', 'admin@admin.com', '$2y$10$6wbAXGxwAYSaCKtnlg3rCeh1h/v.nA5xSkgvj/aYdryCfRpNL/eoe', 1, '', '2024-07-30 08:14:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(10, 'Davi Tiago Erick Duarte', '22396345290', 'davi_tiago_duarte@ceuazul.ind.br', '$2y$10$E5gsfcNlJCM4FGNVrAkBoOpr4bKSaDAEyysPPX5yw9dTJos/rwUZu', 3, '', '2024-07-30 10:44:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `regulamento`
--
ALTER TABLE `regulamento`
  ADD PRIMARY KEY (`idRegulamento`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `regulamento`
--
ALTER TABLE `regulamento`
  MODIFY `idRegulamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
