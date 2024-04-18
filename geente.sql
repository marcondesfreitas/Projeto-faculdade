-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Maio-2023 às 03:09
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `geente`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

CREATE TABLE `equipe` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Foto-tipo` varchar(255) NOT NULL,
  `Cargo` varchar(255) NOT NULL,
  `Link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`Id`, `Nome`, `Foto-tipo`, `Cargo`, `Link`) VALUES
(2, 'Ana Karine Souza', '.gif', 'Pesquisadora', 'http://lattes.cnpq.br/3650958700473443'),
(3, 'Ana Maria Landim Felix', '.gif', 'Pesquisadora', 'http://lattes.cnpq.br/1929650322434576'),
(9, 'Andrezza Alves Queiroz', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/6706712416502038'),
(10, 'Aurilene Andrade Leal', '.jpg', 'Pesquisadora', 'http://lattes.cnpq.br/8067218711128093'),
(11, 'Benedita Conceição Braga Monteiro', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/1159388977517120'),
(12, 'Camila Maria dos Santos Silva', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/5683693835425807'),
(13, 'Charliana Clécia Moura Rodrigues', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/2273525335607093'),
(14, 'Claudio Márcio Ferreira Cavalcanti', '.png', 'Pesquisador', 'http://lattes.cnpq.br/1714190252561695'),
(15, 'Danielle Maria Gomes Veloso', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/4919689039638605'),
(16, 'Denise Teixeira Marques', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/4937684034217578'),
(17, 'Erika Assunção dos Santos Cavalcante', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/6632842145730696'),
(18, 'Francisca Poliane Lima de Oliveira', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/1032002102727836'),
(19, 'Francisco Igor Albuquerque Dantas', '.png', 'Pesquisador', 'http://lattes.cnpq.br/0613494684393837'),
(20, 'Hylo Leal Pereira', '.png', 'Pesquisador', 'http://lattes.cnpq.br/8521102890580342'),
(21, 'Idália Cavalcanti Parente', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/3716257753112015'),
(23, 'Joana D&lsquo;arc Oliveira Cruz Pinheiro', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/8444158846818269'),
(24, 'Kandice da Silva Ferreira', '.png', 'Pesquisadora', 'http://lattes.cnpq.br/1281386127826205'),
(25, 'Luiz Eleildo Pereira Alves', '.png', 'Pesquisador', 'http://lattes.cnpq.br/3113445891264409'),
(26, 'Maria Helenice Araújo Costa', '', 'Pesquisadora', 'http://lattes.cnpq.br/5246373482517751'),
(27, 'Otaciano Dias Noronha Filho', '.png', 'Pesquisador', 'http://lattes.cnpq.br/8385301212238170'),
(28, 'Úrsula Maria Pereira viana', '', 'Pesquisadora', 'http://lattes.cnpq.br/0443831538968576'),
(29, 'Andreia Marques Dos Santos', '.png', 'Estudante', 'http://lattes.cnpq.br/6775972750654026'),
(30, 'Débora Leite de Oliveira', '.png', 'Estudante', 'http://lattes.cnpq.br/2824518870625347'),
(31, 'Jariza Augusto Rodrigues', '.png', 'Estudante', 'http://lattes.cnpq.br/8915792701976171'),
(32, 'Rochelle Kilvia Nascimento Mendes', '.png', 'Estudante', 'http://lattes.cnpq.br/8367803991677682'),
(38, 'Alana Kercia Barros Demétrio', '.gif', 'Pesquisadora', 'http://lattes.cnpq.br/5284508837424907');

-- --------------------------------------------------------

--
-- Estrutura da tabela `img_evento`
--

CREATE TABLE `img_evento` (
  `Id` int(255) NOT NULL,
  `Foto_nome` varchar(255) NOT NULL,
  `Id_evento` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `img_evento`
--

INSERT INTO `img_evento` (`Id`, `Foto_nome`, `Id_evento`) VALUES
(159, '.gif', 28),
(160, '.gif', 28),
(161, '.gif', 28),
(162, '.png', 28),
(163, '.png', 28),
(164, '.png', 28);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `Id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`Id`, `Email`, `Senha`, `Nome`) VALUES
(1, 'adm@adm.com', '1234', 'Adm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `material`
--

CREATE TABLE `material` (
  `Id` int(255) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descricao` varchar(5555) NOT NULL,
  `Data` date NOT NULL,
  `Autor` varchar(255) NOT NULL,
  `Nome_doc` varchar(255) NOT NULL,
  `Link` varchar(255) NOT NULL,
  `Categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `material`
--

INSERT INTO `material` (`Id`, `Titulo`, `Descricao`, `Data`, `Autor`, `Nome_doc`, `Link`, `Categoria`) VALUES
(16, 'Filologia e Linguística Textual em diálogo: revisitando um conflito administrativo do Ceará Colonial a partir da recategorização identitária dos participantes do evento.', 'QUEIROZ, A. A. Filologia e Linguística Textual em diálogo: revisitando um conflito administrativo do Ceará Colonial a partir da recategorização identitária dos participantes do evento. 2020. 294f. Tese (Doutorado em Linguística Aplicada) - Programa de Pós-Graduação em Linguística Aplicada, Universidade Estadual do Ceará, Fortaleza, 2020', '2020-02-17', 'Andrezza Alves Queiroz', 'Andrezza-Alves.pdf', '', 'Tese');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificar_eventos`
--

CREATE TABLE `notificar_eventos` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Descricao` varchar(1000) NOT NULL,
  `Link_forms` varchar(999) NOT NULL,
  `Fotos` varchar(255) NOT NULL,
  `Data` date NOT NULL,
  `Valido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `notificar_eventos`
--

INSERT INTO `notificar_eventos` (`Id`, `Nome`, `Descricao`, `Link_forms`, `Fotos`, `Data`, `Valido`) VALUES
(3, 'Workshop Informática', 'Workshop De informática da Escola Profissionalizante Paulo Barbosa Leite. O evento contará com apresentação de projetos dos alunos, gincana, Museu de Tecnologia, e muito mais. ', 'http://lattes.cnpq.br/5284508837424907', '.gif', '2023-05-12', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `registrar_eventos`
--

CREATE TABLE `registrar_eventos` (
  `Id` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Texto` varchar(9999) NOT NULL,
  `Data_evento` date NOT NULL,
  `Foto_fundo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `registrar_eventos`
--

INSERT INTO `registrar_eventos` (`Id`, `Titulo`, `Texto`, `Data_evento`, `Foto_fundo`) VALUES
(28, 'Aoba', 'dfdsdsacsdfdsfds', '2000-02-21', '.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalho`
--

CREATE TABLE `trabalho` (
  `Id` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descricao` varchar(9999) NOT NULL,
  `Data` date NOT NULL,
  `Autor` varchar(255) NOT NULL,
  `Nome_doc` varchar(255) NOT NULL,
  `Link` varchar(500) NOT NULL,
  `Categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `trabalho`
--

INSERT INTO `trabalho` (`Id`, `Titulo`, `Descricao`, `Data`, `Autor`, `Nome_doc`, `Link`, `Categoria`) VALUES
(3, 'Texto e Metatexto: aprendendo a viver (N) a complexidade dos eventos textuais', 'COSTA, M. H. A.; QUEIROZ, A. A.; ALVES, L. E. P. Texto e metatexto aprendendo a viver (n)a complexidade dos eventos textuais., 2020.  (Outra produção técnica)', '2020-01-01', 'Autoria do Grupo GEENTE', 'Texto_Metatexto_GEENTE.pdf', 'http://www.uece.br/posla/wp-content/uploads/sites/53/2020/12/Texto_Metatexto_GEENTE.pdf', 'Livro'),
(4, 'Fato ou fake: um olhar para as pistas (con)textuais no processo de construção de sentido.', 'OLIVEIRA, D. L.; COSTA, M. H. A. Fato ou fake: um olhar para as pista (con)textuais no processo de construção de sentido., 2019.  ', '2019-01-01', 'Débora Leite de Oliveira', 'admin,+263-Manuscrito-4993-1-6-20201112.pdf', 'https://cadernos.abralin.org/index.php/cadernos/article/view/263', 'Artigo Científico'),
(5, 'O evento comunicativo no texto-comentário de uma instrução ao sósia.', 'BESSA, L. P.; OLIVEIRA, D. L.; COSTA, M. H. A. O evento comunicativo no texto-comentário de uma instrução ao sósia: a construção de sentido(s) em situação de (co)análise da atividade docente. (CON)TEXTOS LINGUÍSTICOS. , v.14, p.249 - 265, 2020.', '2020-07-15', 'Débora Leite de Oliveira', 'pwitchs,+L2+-+10+-+BESSA.pdf', 'https://periodicos.ufes.br/contextoslinguisticos/article/view/29222', 'Artigo Científico'),
(6, 'Referenciação e Polidez em cartas de amor: o resgate da história de Jayme e Maria por meio da (re)construção do self e do outro', 'QUEIROZ, A. A. Referenciação e Polidez em cartas de amor: o resgate da história de Jayme e Maria por meio da (re)construção do self e do outro. 2015. 127f. Dissertação (Mestrado em Linguística Aplicada) - Programa de Pós-Graduação em Linguística Aplicada, Universidade Estadual do Ceará, Fortaleza, 2015', '2015-01-01', 'Andrezza Alves Queiroz', 'Andrezza-Alves.pdf', '', 'Dissertação'),
(8, 'Referenciação e polidez na (re)construção do self e do outro: resgatando a história de amor de Jayme e Maria', 'QUEIROZ, A. A.; COSTA, M. H. A. Referenciação e polidez na (re)construção do self e do outro: resgatando a história de amor de Jayme e Maria. Signum: Estudos da Linguagem, v. 20, n. 3,  p. 317, 2017', '2017-01-01', 'Andrezza Alves Queiroz', 'signum,+Gerente+da+revista,+013+Queiroz+et+al.+2975011.pdf', '', 'Artigo Científico'),
(9, 'Referenciação e reconstrução da intersubjetividade em cartas de amor do século XX.', 'QUEIROZ, A. A.; DEMÉTRIO, A. K. B.; COSTA, M. H. A. Referenciação e reconstrução da intersubjetividade em cartas de amor do século XX. Revista Virtual de Estudos da Linguagem, v. 13, n. 25, p. 226-255, 2015', '2015-01-01', 'Andrezza Alves Queiroz', '31e309d846df48844fda089405d5fc8d.pdf', '', 'Artigo Científico'),
(10, 'DA CONSTRUÇÃO À CO-CONSTRUÇÃO DE REFERENTES: UM OLHAR SOBRE OS MECANISMOS COGNITIVO-DISCURSIVOS SUBJACENTES À PRODUÇÃO E À COMPREENSÃO DE PEÇAS DE DIVULGAÇÃO ELABORADAS POR DESIGNERS', 'Dissertação apresentada ao Programa\r\nde Pós-Graduação em Linguística\r\nAplicada, do Centro de Humanidades,\r\nda Universidade Estadual do Ceará,\r\ncomo requisito parcial para obtenção\r\ndo grau de mestre.\r\nÁrea de concentração: Estudos da\r\nLinguagem\r\n', '2020-01-01', 'Francisca Poliane Lima de Oliveira', 'FranciscaPolianeLimadeOliveira.pdf', '', 'Dissertação'),
(11, 'RECATEGORIZAÇÃO PARA ALÉM DOS MUROS: A PRODUÇÃO (INTER)SUBJETIVA DE OBJETOS DE DISCURSO NO UNIVERSO DOS GRAFFITIS E A RECRIAÇÃO DA REALIDADE', 'Tese apresentada ao Programa de PósGraduação em Linguística Aplicada, do Centro\r\nde Humanidades, da Universidade Estadual do\r\nCeará, como requisito parcial para obtenção do\r\ntítulo de doutora em Linguística Aplicada.\r\nÁrea de concentração: Linguagem e Interação.', '2017-01-01', 'Francisca Poliane Lima de Oliveira', 'TESE_FRANCISCA-POLIANE-LIMA-DE-OLIVEIRA.pdf', '', 'Tese'),
(12, 'ANÁLISE INTERPRETATIVA DE UMA PARÓDIA POR ALUNOS DO ENSINO FUNDAMENTAL: INVESTIGANDO OS RECURSOS ESTRATÉGICOS DE LEITURA NA MODALIDADE REMOTA', 'ARAÚJO, Rodolfo Sampaio de Aquino. ANÁLISE INTERPRETATIVA DE UMA PARÓDIA POR ALUNOS DO ENSINO FUNDAMENTAL: INVESTIGANDO OS RECURSOS ESTRATÉGICOS DE LEITURA NA MODALIDADE REMOTA. Monografia de graduação. Fortaleza, CE: Universidade Estadual do Ceará, UECE. 2021.', '2020-01-01', 'Rodolfo Sampaio de Aquino Araújo', 'report.pdf', 'https://siduece.uece.br/siduece/trabalhoAcademicoPublico.jsf?id=99595', 'Outros'),
(13, 'LEITURA INTERPRETATIVA DE UMA TIRINHA POR ALUNOS DO ENSINO FUNDAMENTAL II: UMA ANÁLISE SOB A ÓTICA DA LINGUÍSTICA TEXTUAL', 'ARAÚJO, R. S. A.; LIMA, Robervânia Santos ; SÁ, Cynthia Maria ; COSTA, M. H. A. LEITURA INTERPRETATIVA DE UMA TIRINHA POR ALUNOS DO ENSINO FUNDAMENTAL II: UMA ANÁLISE SOB A ÓTICA DA LINGUÍSTICA TEXTUAL. In: XXIV Semana Universitária da UECE, 2019, Fortaleza. Anais da Semana Universitária. Fortaleza. P. 1-15.', '2019-01-01', 'Rodolfo Sampaio de Aquino Araújo', '', 'https://semanauniversitaria.uece.br/semana/paginas/estudante/alterarEstudante.jsf', 'Outros'),
(14, 'A recategorização do referente O lugar onde vivo em artigos de opinião', 'Dissertação apresentada ao Programa de\r\nPós-Graduação em Linguística Aplicada,\r\ndo Centro de Humanidades, da\r\nUniversidade Estadual do Ceará, como\r\nrequisito parcial para a obtenção do título\r\nde mestre em Linguística Aplicada. Área\r\nde Concentração: Linguagem e Interação. ', '2017-01-01', 'Filipe Fontenele Oliveira', 'Dissertação-Filipe-Fontenele-Oliveira.pdf', '', 'Dissertação');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `img_evento`
--
ALTER TABLE `img_evento`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `notificar_eventos`
--
ALTER TABLE `notificar_eventos`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `registrar_eventos`
--
ALTER TABLE `registrar_eventos`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `trabalho`
--
ALTER TABLE `trabalho`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `equipe`
--
ALTER TABLE `equipe`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `img_evento`
--
ALTER TABLE `img_evento`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `material`
--
ALTER TABLE `material`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `notificar_eventos`
--
ALTER TABLE `notificar_eventos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `registrar_eventos`
--
ALTER TABLE `registrar_eventos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `trabalho`
--
ALTER TABLE `trabalho`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
