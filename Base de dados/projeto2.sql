-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Jul-2021 às 16:28
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bottle`
--

CREATE TABLE `bottle` (
  `ID_bottle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `bottle`
--

INSERT INTO `bottle` (`ID_bottle`) VALUES
('246FEC6E'),
('A7FE94C8');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bottle_user_association`
--

CREATE TABLE `bottle_user_association` (
  `ID_bottle_user_association` int(11) NOT NULL,
  `ID_user` varchar(40) NOT NULL,
  `ID_bottle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `bottle_user_association`
--

INSERT INTO `bottle_user_association` (`ID_bottle_user_association`, `ID_user`, `ID_bottle`) VALUES
(1, '6B93BF22', 'A7FE94C8'),
(4, '113861BD', '246FEC6E');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `ID_curso` int(11) NOT NULL,
  `NomeCurso` varchar(50) NOT NULL,
  `ID_unidade_organica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`ID_curso`, `NomeCurso`, `ID_unidade_organica`) VALUES
(0, 'ND', 0),
(1, 'Engenharia de Redes e Sistemas de Computadores', 1),
(2, 'Educação Básica', 2),
(3, 'Enfermagem', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `ID_turma` int(11) NOT NULL,
  `NomeTurma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`ID_turma`, `NomeTurma`) VALUES
(0, 'ND'),
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade_organica`
--

CREATE TABLE `unidade_organica` (
  `ID_unidade_organica` int(11) NOT NULL,
  `NomeUnidadeOrganica` varchar(50) NOT NULL,
  `Categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `unidade_organica`
--

INSERT INTO `unidade_organica` (`ID_unidade_organica`, `NomeUnidadeOrganica`, `Categoria`) VALUES
(1, 'ESTG', 'escola'),
(2, 'ESE', 'escola'),
(3, 'ESS', 'escola'),
(4, 'SAS', 'servicos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `ID_user` varchar(40) NOT NULL,
  `ID_unidade_organica` int(11) NOT NULL,
  `ID_curso` int(11) NOT NULL,
  `ID_turma` int(11) NOT NULL,
  `nmecanografico` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `credito` int(11) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`ID_user`, `ID_unidade_organica`, `ID_curso`, `ID_turma`, `nmecanografico`, `nome`, `credito`, `tipo`, `email`, `pass`) VALUES
('	\r\nF98A9E17', 1, 1, 1, 23041, 'Eduardo Avelar', 50, 'aluno', 'eduardoavelar@ipvc.pt', 'teste'),
('1', 3, 3, 3, 20923, 'Maria Silva', 3, 'aluno', '', ''),
('113861BD', 1, 0, 0, 1000, 'Sérgio Lopes', 28, 'professor', 'sergiolopes@ipvc.pt', 'teste'),
('2', 1, 1, 3, 22032, 'Joana Rocha', 0, 'aluno', '', ''),
('6B93BF22', 2, 2, 2, 20997, 'Francisco Ferraz', 5, 'aluno', 'franciscoferraz@ipvc.pt', 'teste');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bottle`
--
ALTER TABLE `bottle`
  ADD PRIMARY KEY (`ID_bottle`);

--
-- Índices para tabela `bottle_user_association`
--
ALTER TABLE `bottle_user_association`
  ADD PRIMARY KEY (`ID_bottle_user_association`),
  ADD KEY `ID_user` (`ID_user`),
  ADD KEY `ID_bottle` (`ID_bottle`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`ID_curso`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`ID_turma`);

--
-- Índices para tabela `unidade_organica`
--
ALTER TABLE `unidade_organica`
  ADD PRIMARY KEY (`ID_unidade_organica`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_user`),
  ADD KEY `ID_curso` (`ID_curso`),
  ADD KEY `ID_turma` (`ID_turma`),
  ADD KEY `ID_unidade_organica` (`ID_unidade_organica`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bottle_user_association`
--
ALTER TABLE `bottle_user_association`
  MODIFY `ID_bottle_user_association` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `bottle_user_association`
--
ALTER TABLE `bottle_user_association`
  ADD CONSTRAINT `bottle_user_association_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`),
  ADD CONSTRAINT `bottle_user_association_ibfk_3` FOREIGN KEY (`ID_bottle`) REFERENCES `bottle` (`ID_bottle`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ID_curso`) REFERENCES `curso` (`ID_curso`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`ID_turma`) REFERENCES `turma` (`ID_turma`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`ID_unidade_organica`) REFERENCES `unidade_organica` (`ID_unidade_organica`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
