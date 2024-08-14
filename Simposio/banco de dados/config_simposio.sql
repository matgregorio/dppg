-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/08/2024 às 21:59
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
-- Estrutura para tabela `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `email_templates`
--

INSERT INTO `email_templates` (`id`, `type`, `subject`, `body`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'password_reset', 'Redefinição de Senha!', 'Clique no link para redefinir sua senha: {link}', 7, NULL, '2024-07-30 08:36:21', NULL),
(2, 'registration_confirmation', 'Confirmação de Registro', 'Bem-vindo, {name}! Obrigado por se registrar.', 0, NULL, NULL, NULL),
(3, 'account_activation', 'Ativação de Conta', 'Ative sua conta clicando no link: {link}', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `presentation`
--

CREATE TABLE `presentation` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `regulations`
--

CREATE TABLE `regulations` (
  `id` int(11) NOT NULL,
  `file_name` varchar(256) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `regulations`
--

INSERT INTO `regulations` (`id`, `file_name`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '66bb4d3d2b1f9.pdf', 7, '0000-00-00 00:00:00', '2024-08-13 09:10:37', '0000-00-00 00:00:00');

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
-- Índices de tabela `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `regulations`
--
ALTER TABLE `regulations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `presentation`
--
ALTER TABLE `presentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `regulations`
--
ALTER TABLE `regulations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
