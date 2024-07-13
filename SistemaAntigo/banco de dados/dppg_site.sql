/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `area_atuacao`
--

DROP TABLE IF EXISTS `area_atuacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_atuacao` (
  `id_grande_area` int(11) NOT NULL AUTO_INCREMENT,
  `nome_area` varchar(100) NOT NULL,
  PRIMARY KEY (`id_grande_area`),
  UNIQUE KEY `nome_area` (`nome_area`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_atuacao`
--

LOCK TABLES `area_atuacao` WRITE;
/*!40000 ALTER TABLE `area_atuacao` DISABLE KEYS */;
INSERT INTO `area_atuacao` VALUES
(1,'Ciências agrárias'),
(2,'Ciências biológicas'),
(3,'Ciências da saúde'),
(4,'Ciências exatas e da terra'),
(5,'Ciências humanas'),
(6,'Ciências sociais aplicadas'),
(7,'Desenvolvimento Social'),
(8,'Engenharias'),
(9,'Linguística, letras e artes'),
(10,'Meio ambiente'),
(11,'Outros');
/*!40000 ALTER TABLE `area_atuacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atividades_complementares`
--

DROP TABLE IF EXISTS `atividades_complementares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atividades_complementares` (
  `codigo_atividades_complementares` int(11) NOT NULL AUTO_INCREMENT,
  `horas_max_atividades_complementares` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome_atividades_complementares` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codigo_atividades_complementares`),
  KEY `cpf` (`cpf`),
  CONSTRAINT `atividades_complementares_ibfk_1` FOREIGN KEY (`cpf`) REFERENCES `usuarios` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividades_complementares`
--

LOCK TABLES `atividades_complementares` WRITE;
/*!40000 ALTER TABLE `atividades_complementares` DISABLE KEYS */;
/*!40000 ALTER TABLE `atividades_complementares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atividades_enviadas`
--

DROP TABLE IF EXISTS `atividades_enviadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atividades_enviadas` (
  `codigo_atividades_enviadas` int(11) NOT NULL AUTO_INCREMENT,
  `subtipo_atividades_enviadas` varchar(60) NOT NULL,
  `horas_atividades_enviadas` int(11) NOT NULL,
  `arquivo_atividades_enviadas` varchar(60) DEFAULT NULL,
  `situacao_atividades_enviadas` varchar(60) NOT NULL,
  `justificativa_atividades_enviadas` longtext NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `codigo_curso` int(11) NOT NULL,
  `nome_atividades_enviadas` varchar(60) NOT NULL,
  `aprovadas` int(3) NOT NULL,
  PRIMARY KEY (`codigo_atividades_enviadas`),
  KEY `cpf` (`cpf`),
  KEY `codigo_curso` (`codigo_curso`),
  CONSTRAINT `atividades_enviadas_ibfk_1` FOREIGN KEY (`cpf`) REFERENCES `usuarios` (`cpf`),
  CONSTRAINT `atividades_enviadas_ibfk_2` FOREIGN KEY (`cpf`) REFERENCES `usuarios` (`cpf`),
  CONSTRAINT `atividades_enviadas_ibfk_3` FOREIGN KEY (`codigo_curso`) REFERENCES `cursos` (`codigo_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividades_enviadas`
--

LOCK TABLES `atividades_enviadas` WRITE;
/*!40000 ALTER TABLE `atividades_enviadas` DISABLE KEYS */;
/*!40000 ALTER TABLE `atividades_enviadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner` (
  `codigo_banner` int(11) NOT NULL AUTO_INCREMENT,
  `nome_banner` varchar(200) NOT NULL,
  `arquivo_banner` varchar(200) NOT NULL,
  `link_banner` varchar(200) NOT NULL,
  `cpf_usuario` varchar(14) NOT NULL,
  PRIMARY KEY (`codigo_banner`),
  KEY `cpf_usuario` (`cpf_usuario`),
  CONSTRAINT `banner_ibfk_1` FOREIGN KEY (`cpf_usuario`) REFERENCES `usuarios` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` VALUES
(7,'Sistema INOVARE','982633522_logo_inovare.png','https://inovare.ifsudestemg.edu.br/','04593127661'),
(9,'Mestrado de alimentos','1924801512_alimentos.png','https://sistemas.riopomba.ifsudestemg.edu.br/mpcta/index.php','04593127661'),
(10,'MS Profissional em Nutrição e Produção Animal','559878528_Logo mestrado zootecnia_H.jpg','http://portais.riopomba.ifsudestemg.edu.br/mestradozootecnia/index.php?arquivo=listar_noticias.php','85561096672'),
(11,'Mestrado Profissional em Educação Profissional e Tecnológica','924150516_Banner_ProfEPT.png','http://profept.ifes.edu.br/','85561096672'),
(12,'X Simpósio','1796575934_Banner do XI simpósio.jpg','https://sistemas.riopomba.ifsudestemg.edu.br/simposio2019/simposio.php?arquivo2=principal2.php','85561096672');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colaboradores` (
  `id_colaborador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` text NOT NULL,
  `senha` varchar(16) NOT NULL,
  `instituicao` varchar(150) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `titulacao` varchar(30) NOT NULL,
  `areatuacao` varchar(100) NOT NULL,
  `peqareatuacao` varchar(150) NOT NULL,
  `subareatuacao` varchar(150) NOT NULL,
  PRIMARY KEY (`id_colaborador`)
) ENGINE=InnoDB AUTO_INCREMENT=85016 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colaboradores`
--

LOCK TABLES `colaboradores` WRITE;
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;

/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `codigo_curso` int(10) NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(200) CHARACTER SET latin1 NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `descricao` longtext CHARACTER SET latin1 NOT NULL,
  `vagas` int(11) NOT NULL,
  `duracao` int(11) NOT NULL,
  `data_realizacao` date NOT NULL,
  `horario_realizacao` varchar(5) CHARACTER SET latin1 NOT NULL,
  `palestrante` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ativo` char(1) CHARACTER SET latin1 NOT NULL,
  `data_realizacao2` date NOT NULL,
  `data_realizacao3` date NOT NULL,
  PRIMARY KEY (`codigo_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES
(2,'Captação de Recursos para Pesquisa','2012-02-28','2012-03-01','<p><a href=\"http://www.financiar.org.br/arquivos/apresentacao/curso_captacao_recursos_ifsudestemg_mar_2012.pdf\" target=\"_blank\">Clique aqui para fazer o download dos slides do curso</a></p>\r\n<p><span style=\"font-family: Arial; font-size: xx-small;\"><br /></span></p>',143,4,'2012-03-02','13:00','D.Sc. Cássia Camargo Harger Sakiyama','S','0000-00-00','0000-00-00'),
(3,'I Curso de Propriedade Intelectual','2012-02-28','2012-03-04','<p><strong>&rdquo;I Curso de Propriedade Intelectual&rdquo;. </strong></p>\r\n<p>O curso acontecer&aacute; nos dia 05 e 06 de mar&ccedil;o de 2012, de 16h030min &agrave;s 18h30min, no Sal&atilde;o Nobre do IF Sudeste MG &ndash; <em>Campus</em> Rio Pomba.&nbsp;</p>\r\n<p><strong>Ser&atilde;o abordados no curso os seguintes t&oacute;picos: </strong></p>\r\n<p>- Pol&iacute;tica de Inova&ccedil;&atilde;o do IF Sudeste MG</p>\r\n<p>- Propriedade Intelectual: Generalidades e Propriedade Industrial</p>\r\n<p>- Propriedade Intelectual: Direito Autoral e <em>Sui Generis</em></p>\r\n<p>O curso ser&aacute; ministrado por Maria Lu&iacute;za Firmiano Teixeira, bacharel em Direito pela UFJF, especialista em Processo Civil pela associa&ccedil;&atilde;o Universidade Anhanguera e Instituto Brasileiro de Direito Processual (IBDP) e por Inaiara C&oacute;ser Sobrinho, bacharel em Ci&ecirc;ncias Econ&ocirc;micas pela UFJF. Atualmente, Maria Lu&iacute;za &eacute; Coordenadora de Propriedade Intelectual e Inaiara, Coordenadora de Articula&ccedil;&atilde;o e Prospec&ccedil;&atilde;o de Oportunidade, ambas do N&uacute;cleo de Inova&ccedil;&atilde;o e Transfer&ecirc;ncia de Tecnologia &ndash; NITTEC, do IF Sudeste MG.</p>',123,4,'2012-03-05','16:30','Maria Luíza Firmiano Teixeira e Inaiara Cóser Sobrinho','S','0000-00-00','0000-00-00'),
(4,'Redação Científica','2012-03-14','2012-03-20','<p>Os resultados de pesquisa n&atilde;o podem ficar encerrados em sua &aacute;rea de  experimenta&ccedil;&atilde;o, sendo fundamental o conhecimento p&uacute;blico da inova&ccedil;&atilde;o, a  fim de trazer benef&iacute;cios &agrave; sociedade. A necessidade de disseminar o  conhecimento gerado pela pesquisa pressup&otilde;e o uso de linguagem adequada e  de padroniza&ccedil;&atilde;o cient&iacute;fica capaz de garantir confiabilidade e  uniformidade &agrave; informa&ccedil;&atilde;o Rog&eacute;rio V. de Faria).</p>\r\n<p>No entanto, A dificuldade em produzir textos t&eacute;cnico-cient&iacute;ficos de qualidade &eacute; um entrave para publica&ccedil;&atilde;o de trabalhos cient&iacute;ficos em revistas de alto impacto. Desta forma, o curso de &ldquo;Reda&ccedil;&atilde;o Cient&iacute;fica&rdquo; ser&aacute; &uacute;til para os estudantes e pesquisadores do <em>Campus</em> Rio Pomba que desejam aprofundar-se na &aacute;rea de pesquisa e inova&ccedil;&atilde;o.</p>\r\n<p>&nbsp;O curso ser&aacute; ministrado pelo pesquisador da EMBRAPA Rog&eacute;rio Vieira de Faria, Bolsista de Produtividade do CNPq N&iacute;vel 2, Doutor em Fitotecnia pela UFV, P&oacute;s-doutor em Quimiga&ccedil;&atilde;o pela Universidade da Georgia (EUA) e em Ra&iacute;zes pela Penn State University (EUA). Com mais de uma centena de artigos publicados, &eacute; atualmente revisor de 19 peri&oacute;dicos cient&iacute;ficos.</p>\r\n<p>&nbsp;Nesta ocasi&atilde;o, Rog&eacute;rio tamb&eacute;m apresentar&aacute; seu livro \"<strong>Dicion&aacute;rio de d&uacute;vidas e dificuldades na reda&ccedil;&atilde;o cient&iacute;fica</strong>\". Ser&aacute; mais uma boa oportunidade para a comunidade do <em>Campus</em> Rio Pomba, pois o livro ser&aacute; vendido para os interessados por R$ 40,00, sendo o pre&ccedil;o normal, diretamente na Editora, R$ 70,00.</p>\r\n<p>Local: Audit&oacute;rio da Funda&ccedil;&atilde;o/IF Sudeste MG - Campus Rio Pomba</p>',-4,8,'2012-03-21','08:00','Rogério Vieira de Faria','S','0000-00-00','0000-00-00'),
(5,'INTRODUÇÃO AO USO DO SOFTWARE ESTATÍSTICO R','2014-04-25','2014-04-30','<p>Curso ofertado aos pesquisadores do Campus Rio Pomba.</p>',9,12,'2014-04-30','13:00','Mônica Pontes Galdino - UFV','N','2014-04-16','2014-04-23'),
(6,'Minicurso de Análise de Experimentos no R por meio do pacote ExpDes','2014-10-07','0000-00-00','<p>Instala&ccedil;&atilde;o do programa. Instala&ccedil;&atilde;o do pacote ExpDes. Revis&atilde;o dos  delineamentos experimentais. An&aacute;lise estat&iacute;stica de experimentos no R  via pacote ExpDes. <span style=\"background-color: #ffffff;\">O objetivo do curso &eacute;  capacitar profissionais da pesquisa, professores, alunos e interessados  para realizarem an&aacute;lises estat&iacute;sticas de experimentos instalados segundo  os delineamentos experimentais (DIC, DBC etc) utilizando o programa R e  o pacote ExpDes.</span></p>\r\n<p><span style=\"background-color: #ffffff;\">As Inscri&ccedil;&otilde;es ser&atilde;o feitas diretamente na DPPG, bastando que o interessado v&aacute; a DPPG e informe nome, n&uacute;mero de CPF, e-mail e telefone. N&atilde;o aceitaremos inscri&ccedil;&otilde;es via Telefone.</span></p>\r\n<p><span style=\"background-color: #ffffff;\"><br /></span></p>',0,4,'2014-10-10','07:00','Flávio Bittencourt e Adriana Dias - UNIFAL - MG (Universidade Federal de Alfenas)','S','0000-00-00','0000-00-00'),
(7,'Instrução Normativa n° 02/2020 - PROPPI','2020-07-30','2020-08-08','<p>Este curso visa apresentar as principais mudan&ccedil;as na P&oacute;s-gradua&ccedil;&atilde;o em decorr&ecirc;ncia da&nbsp;&nbsp;<a class=\"state-published\" title=\"Disp&otilde;e sobre as a&ccedil;&otilde;es para cadastro de projetos de pesquisa dos cursos Stricto Sensu no m&oacute;dulo Pesquisa do Sistema Integrado de Gest&atilde;o de Atividades Acad&ecirc;micas (SIGAA).\" href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/pos-graduacao/outros-documentos/instrucao-normativa-ndeg-02-2020-proppi\">Instru&ccedil;&atilde;o Normativa n&deg; 02/2020 - PROPPI</a></p>',16,8,'2020-08-15','07:00','Ana Carolina Souza Dutra','S','0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formularios`
--

DROP TABLE IF EXISTS `formularios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formularios` (
  `codigo_formulario` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_formulario` varchar(100) NOT NULL,
  `arquivo_formulario` varchar(200) NOT NULL,
  `codigo_menu` int(11) NOT NULL,
  `codigo_submenu` int(11) NOT NULL,
  `codigo_sub_subcategoria` int(11) DEFAULT NULL,
  `codigo_usuario` varchar(14) NOT NULL,
  PRIMARY KEY (`codigo_formulario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formularios`
--

LOCK TABLES `formularios` WRITE;
/*!40000 ALTER TABLE `formularios` DISABLE KEYS */;
/*!40000 ALTER TABLE `formularios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_usuario`
--

DROP TABLE IF EXISTS `grupo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_usuario` (
  `codigo_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_grupo` varchar(40) NOT NULL,
  `descricao_grupo` longtext NOT NULL,
  PRIMARY KEY (`codigo_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_usuario`
--

LOCK TABLES `grupo_usuario` WRITE;
/*!40000 ALTER TABLE `grupo_usuario` DISABLE KEYS */;
INSERT INTO `grupo_usuario` VALUES
(1,'Administrador','Grupo pertencente ao usuário administrador. Este usuário possui total acesso ao sistema.'),
(2,'Sub Administrador','Nivel de usuários sub administradores. Este nivel permite ao usuário relacionado a ter acesso completo a um subsistema cadastrado.'),
(3,'Aluno','Nivel de usuario teste'),
(4,'Professor','Nivel de usuario teste'),
(5,'Avaliador','Nivel de usuario teste');
/*!40000 ALTER TABLE `grupo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscricao`
--

DROP TABLE IF EXISTS `inscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscricao` (
  `codigo_curso` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `data_inscricao` date NOT NULL,
  `presenca` char(1) NOT NULL,
  PRIMARY KEY (`codigo_curso`,`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricao`
--

LOCK TABLES `inscricao` WRITE;
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;

/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links_externos`
--

DROP TABLE IF EXISTS `links_externos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links_externos` (
  `codigo_link` int(5) NOT NULL AUTO_INCREMENT,
  `nome_link` varchar(60) NOT NULL,
  `endereco_link` varchar(100) NOT NULL,
  `imagem_link` varchar(200) DEFAULT NULL,
  `tipo_link` int(11) NOT NULL,
  PRIMARY KEY (`codigo_link`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links_externos`
--

LOCK TABLES `links_externos` WRITE;
/*!40000 ALTER TABLE `links_externos` DISABLE KEYS */;
INSERT INTO `links_externos` VALUES
(2,'IFSudesteMG - Campus Rio Pomba','http://www.riopomba.ifsudestemg.edu.br/','470585238_logo_ifet.png',1),
(3,'CNPQ','http://www.cnpq.br/','2070435387_cnpq.png',2),
(4,'CAPES','http://www.capes.gov.br/','512933805_capes.png',2),
(5,'FAPEMIG','http://www.fapemig.br/','1511979215_fapemig.png',2),
(6,'FINEP','http://www.finep.gov.br/','1117559323_finep.png',2),
(7,'Grupoo de Pesquisa','http://dgp.cnpq.br/buscagrupo/','1385016448_grupo_pesquisa.png',2),
(8,'Periodicos da Capes','http://periodicos.capes.gov.br/','898559183_periodicos da capes.jpg',1),
(11,'NITTEC','http://nittec.ifsudestemg.edu.br/','1127946992_nittec.png',1),
(12,'Facebook','https://www.facebook.com/ifsudestemgriopomba/','1945682787_face.jpg',1),
(13,'Sistema Inovare','http://inovare.ifsudestemg.edu.br/','1536477762_inovare.jpg',1);
/*!40000 ALTER TABLE `links_externos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensagens`
--

DROP TABLE IF EXISTS `mensagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensagens` (
  `codigo` int(4) NOT NULL AUTO_INCREMENT,
  `mensagens` varchar(30) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `data` varchar(10) NOT NULL,
  `visualizada` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensagens`
--

LOCK TABLES `mensagens` WRITE;
/*!40000 ALTER TABLE `mensagens` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_categoria`
--

DROP TABLE IF EXISTS `menu_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_categoria` (
  `codigo_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(40) NOT NULL,
  `posicao_menu` int(2) NOT NULL,
  PRIMARY KEY (`codigo_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_categoria`
--

LOCK TABLES `menu_categoria` WRITE;
/*!40000 ALTER TABLE `menu_categoria` DISABLE KEYS */;
INSERT INTO `menu_categoria` VALUES
(2,'Simpósio',2),
(5,'Quem Somos',1),
(6,'Anais do Simpósio',3),
(7,'Livros-E-book-Ciência e Tecnologia',4);
/*!40000 ALTER TABLE `menu_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_sistemas`
--

DROP TABLE IF EXISTS `menu_sistemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_sistemas` (
  `codigo_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nome_menu` varchar(40) NOT NULL,
  `descricao_sistema` longtext NOT NULL,
  `link_menu` varchar(100) NOT NULL,
  `link_index` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_sistemas`
--

LOCK TABLES `menu_sistemas` WRITE;
/*!40000 ALTER TABLE `menu_sistemas` DISABLE KEYS */;
INSERT INTO `menu_sistemas` VALUES
(1,'Gerencia de Usuários','Área onde o usuário administrador e os usuários sub administradores poderão gerenciar os demais usuários do sistema.','subsistemas/usuario/menu_usuario.php',''),
(2,'DPPG','<p>Sistema da Diretoria de Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o.</p>','subsistemas/cursos/menu_cursos.php','subsistemas/cursos/index.php');
/*!40000 ALTER TABLE `menu_sistemas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_sistemas_subcategoria`
--

DROP TABLE IF EXISTS `menu_sistemas_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_sistemas_subcategoria` (
  `codigo_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_subcategoria` varchar(40) NOT NULL,
  `link_subcategoria` varchar(100) NOT NULL,
  `codigo_menu` int(11) NOT NULL,
  PRIMARY KEY (`codigo_subcategoria`),
  KEY `codigo_menu` (`codigo_menu`),
  CONSTRAINT `menu_sistemas_subcategoria_ibfk_1` FOREIGN KEY (`codigo_menu`) REFERENCES `menu_sistemas` (`codigo_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_sistemas_subcategoria`
--

LOCK TABLES `menu_sistemas_subcategoria` WRITE;
/*!40000 ALTER TABLE `menu_sistemas_subcategoria` DISABLE KEYS */;
INSERT INTO `menu_sistemas_subcategoria` VALUES
(1,'Cursos Ofertados','subsistemas/cursos/cursos.php',2),
(2,'Alterar Dados Participante','subsistemas/cursos/form_cpf_participante.php',2),
(3,'Cadastro de Avaliadores','subsistemas/cursos/form_registro.php',2);
/*!40000 ALTER TABLE `menu_sistemas_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_sub_subcategoria`
--

DROP TABLE IF EXISTS `menu_sub_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_sub_subcategoria` (
  `codigo_sub_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_sub_subcategoria` varchar(40) NOT NULL,
  `conteudo_sub_subcategoria` longtext NOT NULL,
  `menu_subcategoria` int(11) NOT NULL,
  `posicao` int(11) NOT NULL,
  PRIMARY KEY (`codigo_sub_subcategoria`),
  KEY `menu_subcategoria` (`menu_subcategoria`),
  CONSTRAINT `menu_sub_subcategoria_ibfk_1` FOREIGN KEY (`menu_subcategoria`) REFERENCES `menu_subcategoria` (`codigo_subcategoria`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_sub_subcategoria`
--

LOCK TABLES `menu_sub_subcategoria` WRITE;
/*!40000 ALTER TABLE `menu_sub_subcategoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_sub_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_subcategoria`
--

DROP TABLE IF EXISTS `menu_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_subcategoria` (
  `codigo_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_subcategoria` varchar(40) NOT NULL,
  `conteudo_subcategoria` longtext NOT NULL,
  `categoria` int(11) NOT NULL,
  `posicao` int(11) NOT NULL,
  PRIMARY KEY (`codigo_subcategoria`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `menu_subcategoria_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `menu_categoria` (`codigo_categoria`),
  CONSTRAINT `menu_subcategoria_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `menu_categoria` (`codigo_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_subcategoria`
--

LOCK TABLES `menu_subcategoria` WRITE;
/*!40000 ALTER TABLE `menu_subcategoria` DISABLE KEYS */;
INSERT INTO `menu_subcategoria` VALUES
(6,'Simpósio 2010','<h2 class=\"western\" style=\"text-align: center;\"><span style=\"font-size: large;\">&nbsp;<a href=\"simposio2010/simposio.php\" target=\"_blank\">Simp&oacute;sio de Ci&ecirc;ncia, Inova&ccedil;&atilde;o &amp; Tecnologia</a></span></h2>\r\n<p><span style=\"font-size: large;\"><br /></span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\">&Eacute; um evento de &acirc;mbito cient&iacute;fico regional, voltado para o desenvolvimento do pensamento cient&iacute;fico, tecnol&oacute;gico e de inova&ccedil;&atilde;o, visando &agrave; inicia&ccedil;&atilde;o &agrave; pesquisa cient&iacute;fica e tecnol&oacute;gica de estudantes da educa&ccedil;&atilde;o b&aacute;sica e da gradua&ccedil;&atilde;o, e do corpo de servidores do Instituto. O evento tamb&eacute;m servir&aacute; para avaliar os programas Institucionais de inicia&ccedil;&atilde;o cient&iacute;fica e tecnol&oacute;gica do C&acirc;mpus.</span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">Acesso ao <a href=\"simposio2010/simposio.php\" target=\"_blank\">simp&oacute;sio 2010</a></p>',2,1),
(7,'Simpósio 2011','<h2 class=\"western\" style=\"text-align: center;\"><span><a href=\"simposio2011/simposio.php\" target=\"_blank\">&nbsp;Simp&oacute;sio de Ci&ecirc;ncia, Inova&ccedil;&atilde;o &amp; Tecnologia</a></span></h2>\r\n<p><span><br /></span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\">&Eacute; um evento de &acirc;mbito cient&iacute;fico regional, voltado para o desenvolvimento do pensamento cient&iacute;fico, tecnol&oacute;gico e de inova&ccedil;&atilde;o, visando &agrave; inicia&ccedil;&atilde;o &agrave; pesquisa cient&iacute;fica e tecnol&oacute;gica de estudantes da educa&ccedil;&atilde;o b&aacute;sica e da gradua&ccedil;&atilde;o, e do corpo de servidores do Instituto. O evento tamb&eacute;m servir&aacute; para avaliar os programas Institucionais de inicia&ccedil;&atilde;o cient&iacute;fica e tecnol&oacute;gica do C&acirc;mpus.</span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">Acesso ao <a href=\"simposio2011/simposio.php\" target=\"_blank\">simp&oacute;sio 2011</a></p>',2,2),
(8,'Simpósio 2012','<h2 class=\"western\" style=\"text-align: center;\"><span style=\"font-size: large;\">&nbsp;<a href=\"simposio2012/simposio.php\">Simp&oacute;sio de Ci&ecirc;ncia, Inova&ccedil;&atilde;o &amp; Tecnologia</a></span></h2>\r\n<p><span><br /></span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\">&Eacute; um evento de &acirc;mbito cient&iacute;fico regional, voltado para o desenvolvimento do pensamento cient&iacute;fico, tecnol&oacute;gico e de inova&ccedil;&atilde;o, visando &agrave; inicia&ccedil;&atilde;o &agrave; pesquisa cient&iacute;fica e tecnol&oacute;gica de estudantes da educa&ccedil;&atilde;o b&aacute;sica e da gradua&ccedil;&atilde;o, e do corpo de servidores do Instituto. O evento tamb&eacute;m servir&aacute; para avaliar os programas Institucionais de inicia&ccedil;&atilde;o cient&iacute;fica e tecnol&oacute;gica do C&acirc;mpus.</span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">Acesso ao <a href=\"simposio2012/simposio.php\" target=\"_blank\">simp&oacute;sio &nbsp;2012</a></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><a href=\"simposio2012/simposio.php\" target=\"_blank\">http://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2012/simposio.php</a></p>',2,3),
(14,'DPPG','<h2 style=\"text-align: center;\"><span style=\"color: #000000; font-family: \'times new roman\', times; font-size: large;\"><strong><strong>Diretoria de Pequisa e P&oacute;s Gradua&ccedil;&atilde;o</strong></strong></span></h2>\r\n<p><span style=\"color: #000000; font-family: \'times new roman\', times; font-size: large;\"><br /></span></p>\r\n<p><span style=\"text-align: justify; font-family: \'times new roman\', times; font-size: medium;\">A Diretoria de Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o &eacute; o &oacute;rg&atilde;o que planeja, articula, coordena, fomenta e acompanha as atividades e pol&iacute;ticas de pesquisa, integradas ao ensino e &agrave; extens&atilde;o.&nbsp;</span><span style=\"text-align: justify; font-family: \'times new roman\', times; font-size: medium;\">Tamb&eacute;m, coordena e acompanha as pol&iacute;ticas de P&oacute;s-Gradua&ccedil;&atilde;o, visando &agrave; qualifica&ccedil;&atilde;o dos servidores e &agrave; oferta de cursos de P&oacute;s-Gradua&ccedil;&atilde;o,&nbsp;</span><span style=\"text-align: justify; font-family: \'times new roman\', times; font-size: medium;\">al&eacute;m de promover a&ccedil;&otilde;es de interc&acirc;mbio com institui&ccedil;&otilde;es e empresas na &aacute;rea de fomento &agrave; pesquisa, ci&ecirc;ncia e tecnologia.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times; font-size: medium;\">Para execu&ccedil;&atilde;o de suas atividades, a Diretoria de Pesquisa e&nbsp;P&oacute;s-gradua&ccedil;&atilde;o conta com:</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><br /></span></p>\r\n<p><span style=\"font-family: \'times new roman\', times; font-size: medium;\">1-&nbsp;Ger&ecirc;ncia de Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times; font-size: medium;\">Para desenvolver suas atividades, a Ger&ecirc;ncia de Pesquisa e&nbsp;P&oacute;s-Gradua&ccedil;&atilde;o conta com:</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: \'times new roman\', times; font-size: medium;\">I. Assessoria de Programas de Pesquisa.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times; font-size: medium;\">II. Assessoria Acad&ecirc;mica.</span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><strong>Diretora:</strong>&nbsp;<span><span>Larissa Mattos Trevizano&nbsp;</span></span></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><strong>Gerente de Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o:</strong> <span>Franciano Benevenuto Caetano</span></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><span><span><strong>N&uacute;cleo de Inova&ccedil;&atilde;o e Transfer&ecirc;ncia de Tecnologia</strong>:&nbsp;</span><span>Alessandra Martins Coelho</span><br /></span></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: &quot;times new roman&quot;, times; font-size: medium;\"><strong>T&eacute;cnicas em Assuntos Educacionais: </strong><span>&nbsp;Gloria Maria Brivio Quint&atilde;o</span>&nbsp;e&nbsp;<span>Lenice Alves Moreira</span></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><strong>Assistente em Administra&ccedil;&atilde;o</strong>: Germano de Oliveira Menezes e&nbsp;Israel Fortunato Gomes de Oliveira</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><strong>Bibliotec&aacute;ria</strong>:&nbsp;Ana Carolina Souza Dutra</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><strong>Assessoria Geral</strong>: Seila Cristina Santos da Costa</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><br /></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: small;\"><br /></span></p>\r\n<div style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><strong>Contato:</strong>&nbsp;(32) 3571-5700</span></div>\r\n<div style=\"text-align: center;\"><span style=\"font-family: \'times new roman\', times; font-size: medium;\"><strong>E-mail:</strong>&nbsp;<a href=\"http://dppg.riopomba@ifsudestemg.edu.br/\" target=\"_blank\">dppg.riopomba@ifsudestemg.edu.br</a></span></div>',5,1),
(21,'NITTEC','<p style=\"text-align: justify;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">O NITTEC &eacute; um &oacute;rg&atilde;o executivo da administra&ccedil;&atilde;o superior do IF Sudeste MG diretamente subordinado a Pr&oacute;-reitoria de Pesquisa e Inova&ccedil;&atilde;o e tem por finalidade promover a adequada prote&ccedil;&atilde;o das inven&ccedil;&otilde;es geradas no &acirc;mbito da Institui&ccedil;&atilde;o e a sua transfer&ecirc;ncia ao setor produtivo, visando a integra&ccedil;&atilde;o com a comunidade e contribuir para o desenvolvimento tecnol&oacute;gico e social do pa&iacute;s.</span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\"><span>Para execu&ccedil;&atilde;o de suas atividades, o NITTEC conta com:</span></span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\"><br /></span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">I- Gerente de Prospec&ccedil;&atilde;o de Oportunidades de Inova&ccedil;&atilde;o</span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">II- Assessora do N&uacute;cleo de Inova&ccedil;&atilde;o e Transferencia de Tecnologia</span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">III- Estagi&aacute;rio</span></p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n<p class=\"western\" style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><strong><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">&nbsp;</span></strong><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\"><br /></span></span></p>\r\n<p style=\"text-align: center;\"><strong><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Assessora do N&uacute;cleo de Inova&ccedil;&atilde;o e Transferencia de Tecnologia: <strong>&nbsp;</strong><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">Profa. Dsc. <span>Alessandra Martins Coelho</span></span></span></strong><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">&nbsp;</span></p>\r\n<p class=\"western\" style=\"text-align: center;\"><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\"><br /></span></p>\r\n<p class=\"western\" style=\"text-align: center;\">&nbsp;</p>\r\n<p class=\"western\" style=\"text-align: center;\"><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Contato: <span class=\"skype_c2c_print_container notranslate\">(32) 3571-5700</span></span></p>\r\n<p class=\"western\" style=\"text-align: center;\"><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">e-mail: nittec.riopomba@ifsudestemg.edu.br</span></p>\r\n<p class=\"western\">&nbsp;</p>\r\n<p style=\"text-align: justify;\"><span style=\"font-size: small; font-family: Arial, sans-serif;\"><br /></span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\"><br /></span></p>\r\n<p style=\"text-align: justify;\"><span><span style=\"font-size: medium;\"><br /></span></span></p>\r\n<div id=\"skype_c2c_menu_container\" class=\"skype_c2c_menu_container notranslate\" style=\"display: none;\" onmouseover=\"SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)\" onmouseout=\"SkypeClick2Call.MenuInjectionHandler.hideMenu(this, event)\">\r\n<div class=\"skype_c2c_menu_click2call\"><a id=\"skype_c2c_menu_click2call_action\" class=\"skype_c2c_menu_click2call_action\" target=\"_self\">Call</a></div>\r\n<div class=\"skype_c2c_menu_click2sms\"><a id=\"skype_c2c_menu_click2sms_action\" class=\"skype_c2c_menu_click2sms_action\" target=\"_self\">Send SMS</a></div>\r\n<div class=\"skype_c2c_menu_add2skype\"><a id=\"skype_c2c_menu_add2skype_text\" class=\"skype_c2c_menu_add2skype_text\" target=\"_self\">Add to Skype</a></div>\r\n<div class=\"skype_c2c_menu_toll_info\"><span class=\"skype_c2c_menu_toll_callcredit\">You\'ll need Skype Credit</span><span class=\"skype_c2c_menu_toll_free\">Free via Skype</span></div>\r\n</div>',5,2),
(23,'Simpósio 2013','<p>O <a href=\"simposio2013/simposio.php\">VI Simp&oacute;sio de  Ci&ecirc;ncia, Inova&ccedil;&atilde;o &amp; Tecnologia</a> &eacute; um evento de &acirc;mbito cient&iacute;fico  regional, voltado para o desenvolvimento do pensamento cient&iacute;fico,  tecnol&oacute;gico e de inova&ccedil;&atilde;o, visando &agrave; inicia&ccedil;&atilde;o &agrave; pesquisa cient&iacute;fica e  tecnol&oacute;gica de estudantes da educa&ccedil;&atilde;o b&aacute;sica e da gradua&ccedil;&atilde;o, bem como do  corpo de servidores do Instituto. O evento tamb&eacute;m servir&aacute; para avaliar  os programas institucionais de inicia&ccedil;&atilde;o cient&iacute;fica e tecnol&oacute;gica do  Campus.<br /><br /><strong>Atividades</strong><br /><br /></p>\r\n<ul style=\"color: #000000; font-family: arial; font-size: 13.63636302947998px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; background-color: #ffffff;\">\r\n<li>VI Semin&aacute;rio e Encontro de Inicia&ccedil;&atilde;o Cient&iacute;fica e Tecnol&oacute;gica do C&acirc;mpus Rio Pomba</li>\r\n<li>Apresenta&ccedil;&atilde;o de palestras e cursos relacionados &agrave; Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o.</li>\r\n<li>Semin&aacute;rios dos alunos do<span>&nbsp;</span><span>Doutorado Interinstitucional (</span>Dinter) em Ci&ecirc;ncias Ambientais</li>\r\n</ul>\r\n<p><br /><strong>Data</strong><br /><br />Dias 22, 23 e 24 de outubro de 2013</p>\r\n<p>Maiores informa&ccedil;&otilde;es no site do evento:</p>\r\n<p><a href=\"simposio2013/simposio.php?arquivo2=principal2.php\"></a><a href=\"simposio2013/simposio.php\">http://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2013/simposio.php</a></p>',2,4),
(28,'Simpósio 2014','<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Segue link do&nbsp;<strong style=\"font-size: 10px;\"><a href=\"simposio2014/simposio.php\">VII SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</a></strong></p>\r\n<p>&nbsp;<span style=\"font-size: 10px;\">Tema: Ci&ecirc;ncia e Tecnologia para o Desenvolvimento Social</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 10px;\"><a title=\"Simp&oacute;sio 2014\" href=\"simposio2014/simposio.php?arquivo2=principal2.php\"></a><a href=\"simposio2014/simposio.php\">http://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2014/simposio.php</a><br /></span></p>',2,5),
(32,'Simpósio 2015','<p>Segue link do&nbsp;<strong><a href=\"simposio2015/simposio.php\" target=\"_blank\">VIII SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</a></strong></p>\r\n<p>&nbsp;<span>Tema: \"Luz, Ci&ecirc;ncia e Vida\".</span></p>\r\n<p><span style=\"font-size: x-large;\">Para acessar a p&aacute;gina do Simp&oacute;sio clique no link: <span style=\"font-size: xx-large;\"><span style=\"color: #ff0000;\"><a href=\"simposio2015/simposio.php\" target=\"_blank\">Simp&oacute;sio 2015</a></span></span></span></p>',2,6),
(43,'Simpósio 2016','<p>Segue link do<strong><a href=\"simposio2016/simposio.php\"> III SIMP&Oacute;SIO DE ENSINO,PESQUISA E&nbsp; EXTENS&Atilde;O e&nbsp; IX SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</a></strong></p>\r\n<p><br /><span>&nbsp;</span></p>\r\n<p><span style=\"font-size: x-large;\">Para acessar a p&aacute;gina do Simp&oacute;sio clique no link: <span style=\"font-size: xx-large;\"><span style=\"color: #ff0000;\"><a href=\"simposio2016/simposio.php\" target=\"_blank\">SIMEPE e Simp&oacute;sio 2016</a></span></span></span></p>',2,7),
(48,'Simpósio 2018','<p style=\"text-align: justify; color: #000000; font-family: arial; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #f7f7f7; text-decoration-style: initial; text-decoration-color: initial;\">Segue link do <strong><a style=\"font-size: 12px; text-decoration: none; color: #006400;\" href=\"simposio2018/simposio.php\">X SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</a></strong></p>\r\n<p style=\"text-align: justify; color: #000000; font-family: arial; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #f7f7f7; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;<span>Tema: \"Ci&ecirc;ncia para redu&ccedil;&atilde;o das desigualdades\".</span></p>\r\n<p style=\"text-align: justify; color: #000000; font-family: arial; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #f7f7f7; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"font-size: x-large;\">Para acessar a p&aacute;gina do Simp&oacute;sio clique no link:<span> <a href=\"simposio2018/simposio.php\">Simp&oacute;sio 2018<br /></a></span><a href=\"simposio2018/simposio.php\"> </a></span></p>\r\n<hr />\r\n<p><a href=\"simposio2018/simposio.php?arquivo2=principal2.php\"><span style=\"font-size: xx-large;\"><span style=\"font-size: 12px; text-decoration: none; color: #006400;\"><span style=\"color: #ff0000;\">&nbsp;</span></span></span></a></p>',2,8),
(49,'Simpósio de 2019','<p>Segue link do&nbsp;<strong><a href=\"simposio2019/simposio.php\" target=\"_blank\">XI SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</a></strong></p>\r\n<p>&nbsp;Tema: \"<strong><span><span>Bioeconomia: diversidade e riqueza para o desenvolvimento sustent&aacute;vel</span></span></strong>\".</p>\r\n<p>Para acessar a p&aacute;gina do Simp&oacute;sio clique no link:&nbsp;<a href=\"simposio2019/simposio.php\">Simp&oacute;sio&nbsp;2019</a></p>',2,9),
(50,'Acesso aos Anais do Simpósio','<p>Acesse os Anais do evento Simp&oacute;sio no link abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"anais-simposio/\" target=\"_blank\">Anais simp&oacute;sio</a></p>',6,1),
(51,'E-book de 2016','<p>O E-book de 2016, intitulado:&nbsp;Ci&ecirc;ncia e Tecnologia no Campus Rio Pomba do IF SudesteMG: contribui&ccedil;&otilde;es para a Zona da Mata Mineira, pode ser acessado no link abaixo:</p>\r\n<p><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/livros/2016_ebook-ciencia-e-tecnologia-no-campus-rio-pomba\" target=\"_blank\">E-Book 2016</a></p>',7,1),
(52,'E-book de 2017','<p>O E-book de 2017, intitulado:&nbsp;Ci&ecirc;ncia e Tecnologia no Campus Rio Pomba do IF SudesteMG: Import&acirc;ncia para o Arranjo Produtivo Local,&nbsp;<span>pode ser acessado no link abaixo</span>:</p>\r\n<p><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/livros/2017_ebook-ciencia-e-tecnologia-no-campus-rio-pomba\" target=\"_blank\">E-Book de 2017</a></p>',7,2),
(53,'E-book de 2018','<p>O E-book de 2018, intitulado:&nbsp;<span>Simp&oacute;sio de Ci&ecirc;ncia, Inova&ccedil;&atilde;o e Tecnologia no Campus Rio Pomba do<br />IF Sudeste MG: h&aacute; dez anos disseminando conhecimentos,&nbsp;<span>pode ser acessado no link abaixo</span>:</span></p>\r\n<p>&nbsp;</p>\r\n<p><span><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/livros/2018-ebook-ciencia-e-tecnologia-no-campus-rio-pomba.pdf\" target=\"_blank\">E-book de 201</a>8</span></p>',7,3),
(54,'Simpósio de 2020','<p>Segue link do&nbsp;<strong><a href=\"simposio2020/simposio.php\" target=\"_blank\">XII SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</a></strong></p>\r\n<p>&nbsp;Tema: \"<strong>Intelig&ecirc;ncia artificial: a nova fronteira da ci&ecirc;ncia brasileira</strong>\".</p>\r\n<p>Para acessar a p&aacute;gina do Simp&oacute;sio clique no link: <a title=\"Simp&oacute;sio 2020\" href=\"simposio2020/simposio.php\" target=\"_blank\">Simp&oacute;sio 2020</a></p>',2,10),
(55,'Simpósio de 2021','<p>Segue link do&nbsp;<strong><a href=\"simposio2021/simposio.php\" target=\"_blank\">XIII SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</a></strong></p>\r\n<p>&nbsp;Tema: \"<strong>A transversalidade da Ci&ecirc;ncia, Tecnologia e Inova&ccedil;&atilde;o para o planeta</strong>\".</p>\r\n<p>Para acessar a p&aacute;gina do Simp&oacute;sio clique no link:&nbsp;<a href=\"simposio2021/simposio.php\" target=\"_blank\">Simp&oacute;sio 2021</a></p>',2,11),
(56,'Simpósio de 2022','<p>Segue link do<a href=\"simposio2023/simposio.php\" target=\"_blank\">&nbsp;</a><strong><a href=\"simposio2022/simposio.php\">XIV SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</a></strong></p>\r\n<p>&nbsp;Tema: \"<strong><span>B</span><strong>icenten&aacute;rio da Independ&ecirc;ncia: 200 anos de ci&ecirc;ncia, tecnologia e inova&ccedil;&atilde;o no Brasil</strong></strong>\".</p>\r\n<p>Para acessar a p&aacute;gina do Simp&oacute;sio clique no link:&nbsp;<a href=\"simposio2023/simposio.php\" target=\"_blank\">Simp&oacute;sio 2022</a></p>',2,12),
(57,'Simpósio de 2023','<p>Segue link do&nbsp;<strong><a href=\"simposio2023/simposio.php\" target=\"_blank\">XV SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</a></strong></p>\r\n<p>&nbsp;Tema: \"<strong>Ci&ecirc;ncias B&aacute;sicas para o Desenvolvimento Sustent&aacute;vel</strong>\".</p>\r\n<p>Para acessar a p&aacute;gina do Simp&oacute;sio clique no link:&nbsp;<a href=\"simposio2023/simposio.php\" target=\"_blank\">Simp&oacute;sio 2023</a></p>',2,13),
(58,'E--book de 2019','<p><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/livros/ciencia-e-tecnologia-no-campus-rio-pomba-ficha.pdf\" target=\"_blank\">E-book de 2019</a>, intitulado:&nbsp;\"Ci&ecirc;ncia e Tecnologia no Campus Rio Pomba: imposs&iacute;vel desenvolver sem ci&ecirc;ncia\",&nbsp;pode ser acessado no link abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/livros/ciencia-e-tecnologia-no-campus-rio-pomba-ficha.pdf\" target=\"_blank\">2019 E-book&nbsp;</a></p>',7,4),
(59,'E-book de 2020','<p><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/livros/2020-e-book-ciencia-e-tecnologia-no-campus-rio-pomba-avancos-academicos-e-os-impactos-da-ciencia-para-a-sociedade.pdf\" target=\"_blank\">E-book de 2020</a>, intitulado:&nbsp;\"Ci&ecirc;ncia e tecnologia no Campus Rio Pomba: Avan&ccedil;os acad&ecirc;micos e os impactos da ci&ecirc;ncia para a sociedade\",&nbsp;pode ser acessado no link abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/livros/2020-e-book-ciencia-e-tecnologia-no-campus-rio-pomba-avancos-academicos-e-os-impactos-da-ciencia-para-a-sociedade.pdf\" target=\"_blank\">2020 E-book&nbsp;</a></p>',7,5),
(60,'E-book de 2021','<p><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/livros/ebook-versao-final.pdf\" target=\"_blank\">E-book de 2021</a>, intitulado:&nbsp;\"Desafios e contribui&ccedil;&otilde;es do campus Rio Pomba para a pesquisa em tempos de pandemia\",&nbsp;pode ser acessado no link abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/livros/ebook-versao-final.pdf\" target=\"_blank\">2021 E-book&nbsp;</a></p>',7,6);
/*!40000 ALTER TABLE `menu_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticias` (
  `codigo_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_noticia` varchar(150) NOT NULL,
  `conteudo_noticia` longtext NOT NULL,
  `arquivo_noticia` varchar(200) NOT NULL,
  `data_noticia` date NOT NULL,
  `hora_noticia` time NOT NULL,
  `codigo_usuario` varchar(60) NOT NULL,
  PRIMARY KEY (`codigo_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` VALUES
(1,'Página da DPPG','<p>As informa&ccedil;&otilde;es da Diretoira de Pesquisa e P&oacute;s-gradua&ccedil;&atilde;o (DPPG) est&atilde;o sendo publicadas na nova p&aacute;gina hospedada no site do Campus Rio Pomba, em Direitorias Sist&ecirc;micas/Pesquisa e P&oacute;s-gradua&ccedil;&atilde;o/ Documentos.&nbsp;</p>\r\n<p><a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa\" target=\"_blank\">https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa</a></p>','332736079','2020-07-20','17:07:36','85561096672');
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participa_grupos`
--

DROP TABLE IF EXISTS `participa_grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participa_grupos` (
  `codigo_grupo` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `codigo_sistema` int(11) NOT NULL,
  KEY `cpf` (`cpf`),
  KEY `codigo_grupo` (`codigo_grupo`),
  KEY `codigo_sistema` (`codigo_sistema`),
  CONSTRAINT `participa_grupos_ibfk_1` FOREIGN KEY (`cpf`) REFERENCES `usuarios` (`cpf`),
  CONSTRAINT `participa_grupos_ibfk_2` FOREIGN KEY (`codigo_grupo`) REFERENCES `grupo_usuario` (`codigo_grupo`),
  CONSTRAINT `participa_grupos_ibfk_3` FOREIGN KEY (`codigo_grupo`) REFERENCES `grupo_usuario` (`codigo_grupo`),
  CONSTRAINT `participa_grupos_ibfk_4` FOREIGN KEY (`codigo_sistema`) REFERENCES `menu_sistemas` (`codigo_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participa_grupos`
--

LOCK TABLES `participa_grupos` WRITE;
/*!40000 ALTER TABLE `participa_grupos` DISABLE KEYS */;

UNLOCK TABLES;

--
-- Table structure for table `participantes`
--

DROP TABLE IF EXISTS `participantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participantes` (
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(10) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(10) DEFAULT NULL,
  `agencia` varchar(30) DEFAULT NULL,
  `conta` varchar(30) DEFAULT NULL,
  `departamento` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Geral';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participantes`
--

LOCK TABLES `participantes` WRITE;
/*!40000 ALTER TABLE `participantes` DISABLE KEYS */;

/*!40000 ALTER TABLE `participantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peq_areas_atuacao`
--

DROP TABLE IF EXISTS `peq_areas_atuacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peq_areas_atuacao` (
  `id_grandearea` int(11) NOT NULL,
  `id_peq_area` int(11) NOT NULL AUTO_INCREMENT,
  `nome_peq_area` varchar(150) NOT NULL,
  PRIMARY KEY (`id_peq_area`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peq_areas_atuacao`
--

LOCK TABLES `peq_areas_atuacao` WRITE;
/*!40000 ALTER TABLE `peq_areas_atuacao` DISABLE KEYS */;
INSERT INTO `peq_areas_atuacao` VALUES
(1,1,'Agrobiologia'),
(1,2,'Agronomia'),
(1,3,'Bioinformática'),
(1,4,'Biotecnologia'),
(1,5,'Cadeia Produtiva'),
(1,6,'Ciência e Tecnologia de Alimentos'),
(1,7,'Ciências Agrárias'),
(1,8,'Desenvolvimento Sustentável'),
(1,9,'Energia'),
(1,10,'Engenharia Agrícola'),
(1,11,'Genômica'),
(1,12,'Infra-estrutura'),
(1,13,'Medicina Veterinária'),
(1,14,'Meio Ambiente'),
(1,15,'Recursos Florestais e Engenharia Florestal'),
(1,16,'Recursos Pesqueiros e Engenharia de Pesca'),
(1,17,'Responsabilidade social'),
(1,18,'Segurança alimentar'),
(1,19,'Tecnologia'),
(1,20,'Zootecnia'),
(2,21,'Bioclimatologia'),
(2,22,'Bioética'),
(2,23,'Biofísica'),
(2,24,'Biogeografia'),
(2,25,'Biohidrologia'),
(2,26,'Biologia Estrutural'),
(2,27,'Biologia Evolutiva'),
(2,28,'Biologia Experimental'),
(2,29,'Biologia Geral'),
(2,30,'Biologia Marinha'),
(2,31,'Bioquímica'),
(2,32,'Biossegurança'),
(2,33,'Biotecnologia'),
(2,34,'Botânica'),
(2,35,'Ciências Biológicas'),
(2,36,'Desenvolvimento Sustentável'),
(2,37,'Ecologia'),
(2,38,'Exobiologia ou astrobiologia'),
(2,39,'Farmacologia'),
(2,40,'Fisiologia'),
(2,41,'Genética'),
(2,42,'Genômica'),
(2,43,'Imunologia'),
(2,44,'Infra-estrutura'),
(2,45,'Meio Ambiente'),
(2,46,'Microbiologia'),
(2,47,'Morfologia'),
(2,48,'Neurobiologia'),
(2,49,'Parasitologia'),
(2,50,'Responsabilidade social'),
(2,51,'Tecnologia'),
(2,52,'Zoologia'),
(3,69,'Bioética'),
(3,70,'Bioinformática'),
(3,71,'Biotecnologia'),
(3,72,'Ciências da Saúde'),
(3,73,'Educação Física'),
(3,74,'Enfermagem'),
(3,75,'Farmácia'),
(3,76,'Fisioterapia e terapia ocupacional'),
(3,77,'Fonoaudiologia'),
(3,78,'Genômica'),
(3,79,'Infra-estrutura'),
(3,80,'Medicina'),
(3,81,'Nutrição'),
(3,82,'Odontologia'),
(3,83,'Responsabilidade social'),
(3,84,'Saúde coletiva'),
(3,85,'Tecnologia'),
(4,86,'Astronomia'),
(4,87,'Ciência da Computação'),
(4,88,'Ciências Exatas e da Terra'),
(4,89,'Física'),
(4,90,'Geociências'),
(4,91,'Infra-estrutura'),
(4,92,'Matemática'),
(4,93,'Oceanografia'),
(4,94,'Probabilidade e Estatística'),
(4,95,'Química'),
(4,96,'Responsabilidade Social'),
(4,97,'Tecnologia'),
(5,98,'Antropologia'),
(5,99,'Arqueologia'),
(5,100,'Ciência Política'),
(5,101,'Ciências Humanas'),
(5,102,'Educação'),
(5,103,'Filosofia'),
(5,104,'Gênero'),
(5,105,'Geografia'),
(5,106,'História'),
(5,107,'Infra-estrutura'),
(5,108,'Psicologia'),
(5,109,'Responsabilidade social'),
(5,110,'Segurança'),
(5,111,'Sociologia'),
(5,112,'Tecnologia'),
(5,113,'Teologia'),
(6,114,'Administração'),
(6,115,'Arquitetura e Urbanismo'),
(6,116,'Ciência da Informação'),
(6,117,'Ciências Sociais Aplicadas'),
(6,118,'Comunicação'),
(6,119,'Demografia'),
(6,120,'Desenho Industrial'),
(6,121,'Desenvolvimento Sustentável'),
(6,122,'Direito'),
(6,123,'Economia'),
(6,124,'Economia Doméstica'),
(6,125,'Gênero'),
(6,126,'Infra-estrutura'),
(6,127,'Museologia'),
(6,128,'Planejamento Urbano e Regional'),
(6,129,'Responsabilidade social'),
(6,130,'Serviço Social'),
(6,131,'Tecnologia'),
(6,132,'Turismo'),
(6,133,'Relações internacionais'),
(6,134,'Relações públicas'),
(6,135,'Secretariado Executivo'),
(6,136,'Ciências Atuariais'),
(7,137,'Desenvolvimento Social'),
(7,138,'Desenvolvimento Sustentável'),
(7,139,'Direitos Humanos'),
(7,140,'Gênero'),
(7,141,'Inclusão Social'),
(7,142,'Liderança'),
(7,143,'Parceiras'),
(7,144,'Responsabilidade Social'),
(7,145,'Segurança'),
(8,146,'Cadeia Produtiva'),
(8,147,'Energia'),
(8,148,'Engenharia aeroespacial'),
(8,149,'Engenharia ambiental'),
(8,150,'Engenharia biomádica'),
(8,151,'Engenharia civil'),
(8,152,'Engenharia de computação'),
(8,153,'Engenharia de materiais e metalúrgia'),
(8,154,'Engenharia de Minas'),
(8,155,'Engenharia de produção'),
(8,156,'Engenharia de transportes'),
(8,157,'Engenharia elétrica'),
(8,158,'ngenharia eletrônica'),
(8,159,'Engenharia mecânica'),
(8,160,'Engenharia naval e oceânica'),
(8,161,'Engenharia nuclear'),
(8,162,'Engenharia química'),
(8,163,'Engenharia sanitária'),
(8,164,'Engenharias'),
(8,165,'Infra-estrutura'),
(8,166,'Responsabilidade Social'),
(8,167,'Tecnologia'),
(8,168,'Engenharia mecatrônica'),
(8,169,'Engenharia Cartográfica'),
(8,170,'Engenharia de agrimensura'),
(8,171,'Engenharia de armamentos'),
(9,172,'Artes'),
(9,173,'Incentivo à cultura'),
(9,174,'Infra-estrutura'),
(9,175,'Letras'),
(9,176,'Linguística'),
(9,177,'Linguística, letras e artes'),
(9,178,'Responsabilidade social'),
(9,179,'Tecnologia'),
(9,180,'Decoração'),
(9,181,'Desenho de Moda'),
(9,182,'Desenho de Projetos'),
(10,183,'Bioética'),
(10,184,'Conservação'),
(10,185,'Desenvolvimento Sustentável'),
(10,186,'Ecodesenvolvimento'),
(10,187,'Gestão Ambiental'),
(10,188,'Meio Ambiente'),
(10,189,'Responsabilidade Social'),
(10,190,'Tecnologia');
/*!40000 ALTER TABLE `peq_areas_atuacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projetos` (
  `idProjeto` int(11) NOT NULL AUTO_INCREMENT,
  `projeto` longtext NOT NULL,
  `fomento` longtext NOT NULL,
  `vigencia` longtext NOT NULL,
  PRIMARY KEY (`idProjeto`)
) ENGINE=MyISAM AUTO_INCREMENT=576 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetos`
--

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
INSERT INTO `projetos` VALUES
(1,'INFLUENCIA DO EMPREGO DA RADIAÇÃO GAMA (CO60), DE DIFERENTES EMBALAGENS PLÁSTICAS FLEXÍVEIS E DA TEMPERATURA DE ESTOCAGEM NA CONSERVAÇÃO DE POLPA DE AÇAÍ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(2,'FORNECIMENTO DE ÓLEOS ESSENCIAIS E ÁCIDOS ORGÂNICOS VIA ÁGUA DE BEBIDA PARA LEITÕES NA FASE DE CRECHE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(3,'AVALIAÇÃO DO DESEMPENHO DE NOVILHAS MESTIÇAS SUPLEMENTADAS COM DIFERENTES NÍVEIS DE PROTEINADO DURANTE A ÉPOCA DA SECA, EM PASTAGEM DE BRACHIARIA BRIZANTHA CV MARANDU SUBMETIDA A DIFERIMENTO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(4,'ANÁLISE DA FORMAÇÃO CURRICULAR DOS CURSOS DE ADMINISTRAÇÃO DAS INSTITUIÇÕES FEDERAIS DE ENSINO DO ESTADO DE MINAS GERAIS, CONFORME A RESOLUÇÃO CNE/CES N° 4, DE 13 DE JULHO DE 2005','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(5,'SISTEMAS DE GESTÃO DA QUALIDADE E SERVIÇO DE INSPEÇÃO SANITÁRIA INDUSTRIAL: ESTUDO DE CASO DE UMA AGROINDÚSTRIA PROCESSADORA DE LEITE E DERIVADOS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(6,'VALORAÇÃO ECONÔMICA DO SERVIÇO DE POLINIZAÇÃO REALIZADO PELAS ABELHAS NA PRODUÇÃO DE FRUTOS DA ZONA DA MATA DE MINAS GERAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(7,'CARACTERIZAÇÃO E CONSCIENTIZAÇÃO DOS CONSUMIDORES DE OVOS DE CODORNAS NOS MUNICÍPIOS DE RIO POMBA E SILVEIRÂNIA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(8,'USO DE FITOTERÁPICOS NO CONTROLE DO CARRAPATO AMBLYOMMA CAJENNENSE, FABRICIUS, 1787 (CARRAPATO ESTRELA)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(9,'EFETIVIDADE DA FIXAÇÃO BIOLÓGICA DE NITROGÊNIO PARA DIFERENTES CULTIVARES DE FEIJOEIRO COMUM E O EFEITO DA UTILIZAÇÃO DE RESÍDUO DE ORIGEM ANIMAL, APLICADO EM COBERTURA SOBRE ESTA CULTURA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(10,'DIÁLOGO ENTRE AS REPORTAGENS E OS ANÚNCIOS PUBLICADOS NA REVISTA QUATRO RODAS ACERCA DA SEGURANÇA AUTOMOTIVA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(11,'NÍVEIS DE RUÍDO EMITIDOS POR DIFERENTES CONJUNTOS MECANIZADOS OPERANDO EM VELOCIDADES RECOMENDAS PELOS FABRICANTES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(12,'AVALIAÇÃO DO DESEMPENHO DE BEZERRAS MESTIÇAS H/Z SUPLEMENTADAS EM PASTEJO ALTERNADO DE BRACHIARIA BRIZANTHA CV. MARANDU COM DIFERENTES NÍVEIS DE ADUBAÇÃO MINERAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(13,'AVALIAÇÃO DO EFEITO DE DIFERENTES DOSES DE ÁGUA RESIDUÁRIA DE SUÍNOS SOBRE A MICROBIOTA DO SOLO EM PASTAGEM DE PENNISETUM PURPUREUM CV. BRS KURUMI','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(14,'ADAPTAÇÃO, APLICAÇÃO E AJUSTE DE METODOLOGIA DE AVALIAÇÃO RÁPIDA DA PERFORMANCE DE AGROECOSSISTEMAS FAMILIARES – INTERFACE SOLO-PLANTA-DIVERSIDADE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(15,'ESTUDO DA BIODEGRADAÇÃO DE SACOLAS PLÁSTICAS EMPREGADAS NOS SUPERMERCADOS/MERCADOS DA CIDADE DE RIO POMBA - MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(16,'AVALIAÇÃO DA GRANULOMETRIA E CLASSIFICAÇÃO DO MILHO DE SUINOCULTORES DA ZONA DA MATA MINEIRA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(17,'EFEITOS DA UTILIZAÇÃO DE OCITOCINA NOS TEORES DE SÓLIDOS TOTAIS NO LEITE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(18,'AVALIAÇÃO DE INGREDIENTES DO BIOMA CAATINGA NA REDUÇÃO DAS EMISSÕES DE METANO ENTÉRICO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(19,'MULTIPLICAÇÃO IN VITRO DE BAMBU GIGANTE (DENDROCALAMUS GIGANTEUS)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(20,'ELABORAÇÃO DE GELÉIAS E GELEIADAS A BASE DE FRUTOS DA PALMEIRA JUÇARA (EUTERPE EDULIS MARTIUS)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(21,'FAZENDA FORTALEZA DE SANT’ANNA: DA MONOCULTURA À AGRICULTURA CAMPONESA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(22,'DESENVOLVIMENTO DO MÓDULO FINANCEIRO E APERFEIÇOAMENTO DO MÓDULO DE ORIENTAÇÃO NUTRICIONAL PARA APLICATIVO MOBILE “ALIMENTAÇÃO SAUDÁVEL”','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(23,'APLICAÇÃO DE RECURSOS COMPUTACIONAIS NA IRRIGAÇÃO DO FEIJOEIRO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(24,'ELABORAÇÃO DO QUEIJO LABNEH CONDIMENTADO A PARTIR DO LEITE DE CABRA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(25,'DESENVOLVIMENTO E CARACTERIZAÇÃO DE SORVETE COM PIMENTA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(26,'ELABORAÇÃO DE RICOTA A PARTIR DO LEITE DE CABRA E AVALIAÇÃO DO RENDIMENTO TÉCNICO E ECONÔMICO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(27,'ELABORAÇÃO DE SMOOTHIES DE FRUTOS DA PALMEIRA JUÇARA (EUTERPE EDULIS MARTIUS) ADICIONADOS DE ABACAXI E MARACUJÁ POTENCIALMENTE PROBIÓTICOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(28,'DESENVOLVIMENTO DE PRODUTOS LÁCTEOS COM TEOR REDUZIDO DE SÓDIO PARTE I: QUEIJO MINAS FRESCAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(29,'PRÉ-TRATAMENTO ENZIMÁTICO DE EFLUENTES DAS INDÚSTRIAS DE LATICÍNIOS UTILIZANDO LIPASES MICROBIANAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(30,'DESENVOLVIMENTO DE PETIT SUISSE COM FARINHA DE CHIA A PARTIR DE DIFERENTES CULTURAS PROBIÓTICAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(31,'DESENVOLVIMENTO DE HAMBÚRGUER DE FRANGO ADICIONADO DE SEMENTE DE CHIA (SALVIA HISPANICA L.) COMO SUBSTITUTA PARCIAL DE GORDURA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(32,'DESENVOLVIMENTO DE DOCE CREMOSO A PARTIR DOS FRUTOS DA PALMEIRA JUÇARA (EUTERPE EDULIS MARTIUS), BANANA E ABACAXI','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(33,'LEVANTAMENTO DAS TIPOLOGIAS DE OCORRÊNCIAS POLICIAIS EM CIDADES DE PEQUENO PORTE POR MEIO DE CADASTRO GEORREFERENCIADO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(34,'INVENTÁRIO QUALI-QUANTITATIVO DA ARBORIZAÇÃO URBANA DE RIO POMBA, MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(35,'O IMPARCIAL – A MEMÓRIA IMPRESSA DE RIO POMBA (1931-1945): HIGIENIZAÇÃO, CATALOGAÇÃO E DITIGALIZAÇÃO DO ACERVO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(36,'AVALIAÇÃO DO COMPORTAMENTO DE BANANEIRAS CV “PRATA’’ CULTIVADAS EM CONSÓRCIOS COM LEGUMINOSAS E CULTIVOS ANUAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(37,'MODELAGEM E DESENVOLVIMENTO DE UM SISTEMA DE GERENCIAMENTO DE TRANSPORTES DE PEQUENO PORTE PARA O IF SUDESTE DE MG – CÂMPUS RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE FEVEREIRO DE 2015 A 31 DE JULHO DE 2015'),
(38,'O IMPARCIAL - A MEMÓRIA IMPRESSA DE RIO POMBA (1918-1930): HIGIENIZAÇÃO, CATALOGAÇÃO E DIGITALIZAÇÃO DO ACERVO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(39,'DESENVOLVIMENTO DE MATERIAL DIDÁTICO DE LÍNGUA INGLESA PARA OS CURSOS SUPERIORES DE CIÊNCIA E TECNOLOGIA DE ALIMENTOS E CIÊNCIA DA COMPUTAÇÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE JANEIRO DE 2015 A 31 DE JULHO DE 2015'),
(40,'AVALIAÇÃO DA UMIDADE, TEMPERATURA E CARACTERÍSTICAS QUÍMICAS DE UM SOLO DURANTE 10 MESES SOB COBERTURA MORTA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(41,'QUALIDADE MICROBIOLÓGICA DO LEITE CRU VERSUS GRAU DE PROTEÓLISE DO LEITE UHT','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(42,'DESEMPENHO DE SEMENTES DE ESPÉCIE FLORESTAL NATIVA EM DIFERENTES CONDIÇÕES DE ARMAZENAMENTO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG - (PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(43,'INTEGRAÇÃO DE SISTEMAS DE INFORMAÇÃO EM INSTITUIÇÕES PÚBLICAS DE ENSINO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(44,'EFEITO DE PRODUTOS BIOLÓGICOS NO CONTROLE DA ANTRACNOSE E NA CONSERVAÇÃO DA MANGA CV. PALMER EM PÓS-COLHEITA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(45,'AVALIAÇÃO DA QUALIDADE DA PASTAGEM DIFERIDA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(46,'CARACTERIZAÇÃO DO POTENCIAL DE MANEJO SILVIPASTORIL EM PROPRIEDADES RURAIS NA MICRORREGIÃO DE RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(47,'ESTABILIDADE E CARACTERIZAÇÃO DE ANTIBIÓTICOS EM BACTÉRIAS CAUSADORAS DA MASTITE BOVINA NA REGIÃO DE RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(48,'AVALIAÇÃO DE DIFERENTES TEMPERATURAS DE REFRIGERAÇÃO NA CONSERVAÇÃO DE POLPA DE AÇAÍ TRATADAS COM RADIAÇÃO GAMA (60 CO) E ESTABILIDADE DE COR DURANTE A ESTOCAGEM','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(49,'INTEGRAÇÃO DE SISTEMAS: DESENVOLVIMENTO DO MÓDULO ACOMPANHAMENTO DOS PROGRAMAS E PROJETOS DE PESQUISA NO SISTEMA INOVARE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(50,'COMPARAÇÃO FÍSICO-QUÍMICA, TECNOLÓGICA E DE ACEITAÇÃO DE HAMBÚRGUER BOVINO COM REDUZIDO VALOR CALÓRICO PRODUZIDO COM LINHAÇA NA FORMA DE SEMENTE E DE FARINHA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(51,'MELISSA (MELISSA OFFICINALIS L.) COMO ADITIVO FITOTERÁPICO NA ALIMENTAÇÃO DE CODORNAS JAPONESAS EM POSTURA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(52,'UTILIZAÇÃO DO MÉTODO DO ÍNDICE DE QUALIDADE (MIQ), NA AVALIAÇÃO DO FRESCOR DE TILÁPIA DO NILO (OREOCHROMIS NILOTICUS) ARMAZENADA EM GELO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(53,'AVALIAÇÃO DA GRANULOMETRIA E CLASSIFICAÇÃO DO MILHO UTILIZADO POR FÁBRICAS DE RAÇÕES DA ZONA DA MATA MINEIRA PARA ALIMENTAÇÃO DE FRANGOS DE CORTE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(54,'PLANTAS DE COBERTURA “DE INVERNO” E SEU POTENCIAL INIBITÓRIO SOBRE A GERMINAÇÃO DE PLANTAS ESPONTÂNEAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(55,'AVALIAÇÃO DE INGREDIENTES DO BIOMA MATA ATLANTICA NA REDUÇÃO DAS EMISSÕES DE METANO ENTÉRICO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(56,'AVALIAÇÃO DAS CONDIÇÕES DE MANIPULAÇÃO DE ALIMENTOS EM ESTABELECIMENTOS EDUCACIONAIS AMPARADOS PELO PROGRAMA NACIONAL DA ALIMENTAÇÃO ESCOLAR (PNAE) NA CIDADE DE RIO POMBA-MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(57,'AVALIAÇÃO DE CULTIVARES DE MILHO CRIOULO E SEU RESGATE NA AGRICULTURA FAMILIAR EM RIO POMBA – MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(58,'PRODUÇÃO DE PÓLEN EM ABELHAS AFRICANIZADAS SUBMETIDAS A DIFERENTES SUPLEMENTAÇÕES ENERGÉTICO-PROTEÍCAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(59,'ISOLAMENTO DE BACTERIÓFGOS LÍTICOS CONTRA AS BACTÉRIAS CAUSADORAS DE MASTITE BOVINA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(60,'QUALIDADE DE OVOS DE GALINHAS ALOJADAS EM DIFERENTES SISTEMAS DE PRODUÇÃO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(61,'AVALIAÇÃO DO EFEITO DA UTILIZAÇÃO DA RADIAÇÃO GAMA ASSOCIADA A BAIXA TEMPERATURA E EMBALAGEM A VÁCUO NA CONSERVAÇÃO DE MANDIOCA IN NATURA SEM CASCA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE FEVEREIRO DE 2015 A 31 DE JULHO DE 2015'),
(62,'ISOLAMENTO E CARACTERIZAÇÃO DE BACTÉRIAS CAUSADORAS DE MASTITE BOVINA NA MICRORREGIÃO DE RIO POMBA, MINAS GERAIS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2014 A 28 DE FEVEREIRO DE 2015'),
(63,'VALIDAÇÃO DE SISTEMA DE AUTOMAÇÃO DO VOLUME E TEMPERATURA DO LEITE EM TANQUE DE EXPANSÃO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(64,'AVALIAÇÃO DE ESPÉCIES LEGUMINOSAS COM POTENCIAL DE ACIDIFICAÇÃO DA RIZOSFERA NAS CONDIÇÕES DA ZONA DA MATA DE MINAS GERAIS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2014 A 31 DE JULHO DE 2015'),
(65,'EFEITO DO NZONE MAX SOBRE A QUANTIDADE DE AMÔNIA VOLATILIZADA DA CAMA DE FRANGO ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / FADUC – RP – PARCERIA EMPRESA','01 DE SETEMBRO DE 2014 A 31 DE AGOSTO DE 2015'),
(138,'DIVERSIDADE GENÉTICA E IDENTIFICAÇÃO DE ESTIRPES RIZOBIANAS ISOLADAS DE NÓDULOS DE FEIJOEIRO DA REGIÃO DE RIO POMBA, MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(67,'ANÁLISE DA EFICIÊNCIA NA ALOCAÇÃO DOS GASTOS PÚBLICOS COM EDUCAÇÃO NOS MUNICÍPIOS DO ESTADO DE MINAS GERAIS','PIBICTI IF SUDESTE MG','01 DE AGOSTO DE 2013 A 31 DE JULHO DE 2014'),
(68,'JOVENS TALENTOS PARA CIÊNCIA','JOVENS TALENTOS PARA A CIÊNCIA - CAPES','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(69,'AVALIAÇÃO DA EFEITO PREBIÓTICO DO ALBEDO DE MARACUJÁ SOBRE L. CASEI EM BEBIDA LÁCTEA FERMENTADA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ - (PIBIC-CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(70,'PERFIL DA PRODUÇÃO E DA QUALIDADE DA SILAGEM DE MILHO NO MUNICÍPIO DE RIO POMBA MG','PROGRAMA INSTITUCIONAL VOLUNTáRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(71,'VALIDAÇÃO DE UM SISTEMA INTEGRADO DE MONITORAMENTO DO CONSUMO INDIVIDUAL DE ALIMENTO E ÁGUA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ - (PIBIC-CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(72,'CARACTERÍSTICAS DE QUEIJOS MINAS ARTESANAIS DA SERRA DA CANASTRA MATURADOS EM CENTRO DE QUALIDADE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ - (PIBIC-CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(73,'ANÁLISE DO DESEMPENHO ACADÊMICO DOS ESTUDANTES QUE INGRESSARAM POR MEIO DO VESTIBULAR E DO SISTEMA DE SELEÇÃO UNIFICADO (SISU) NOS CURSOS DE GRADUAÇÃO DO IF SUDESTE MG - CÂMPUS RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ - (PIBIC-CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(74,'VIABILIDADE TECNOLÓGICA DO PROCESSAMENTOS DE HAMBÚRGUER DE FRANGO PRÉ-COZIDO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MAIO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(75,'DESEMPENHO E CARACTERÍSTICAS DE CARCAÇA DE SUÍNOS MACHOS CASTRADOS E IMUNOCASTRADOS EM TERMINAÇÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(76,'CONTROLE DE PATÓGENOS DE FRUTOS PÓS-COLHEITA POR METABÓLITOS DE FUNGOS ECTOMICORRÍZICOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(77,'AVALIAÇÃO DE TRATAMENTOS HOMEOPÁTICOS E FITOTERÁPICOS PARA O CONTROLE DE RHIPICEPHALUS (BOOPHILUS) MICROPLUS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(78,'DELINEAMENTO DO PERFIL DE FORMAÇÃO E ATUAÇÃO DOS PROFISSIONAIS DOCENTES DO IF SUDESTE MG CAMPUS RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(79,'CARACTERIZAÇÃO DE EFLUENTES GERADOS EM TANQUES DE ARMAZENAMENTO DE LEITE CRU COM VISTAS À IMPLANTAÇÃO E AVALIAÇÃO DE SISTEMAS DE TRATAMENTO POR WETLANDS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(80,'SANIDADE DE BEZERRAS F1 HOLANDÊS-GIR EM RELAÇÃO A TRANSFERÊNCIA DE IMUNIDADE PASSIVA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(81,'EFEITO DA ADUBAÇÃO DE COBERTURA SOBRE A CULTURA DO FEIJOEIRO COMUM E EFETIVIDADE DA FIXAÇÃO BIOLÓGICA DE NITROGÊNIO PARA DIFERENTES CULTIVARES DESTA CULTURA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(82,'AVALIAÇÃO DE ROTULAGEM E CARACTERIZAÇÃO FÍSICO-QUÍMICA DE NÉCTARES DE UVA COMERCIALIZADOS EM MINAS GERAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(83,'QUALIDADE NUTRICIONAL DA SILAGEM DURANTE O PERÍODO DE DESENSILAGEM','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(84,'ENCAPSULAMENTO DE PROPÁGULOS DE CULTIVARES DE MORANGUEIRO EM MATRIZ DE ALGINATO DE SÓDIO ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(85,'ELABORAÇÃO DE FARINHA DE TENÉBRIO MOLITOR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(86,'DIVERSIDADE FLORÍSTICA EM ÁREAS DE PRESERVAÇÃO PERMANENTE E DE RESERVA LEGAL NA MICRO REGIÃO DE RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(87,'AVALIAÇÃO DA ESTABILIDADE MICROBIOLÓGICA E ACEITAÇÃO SENSORIAL DE HAMBÚRGUER DE FRANGO PASTEURIZADO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(88,'AVALIAÇÃO DO RENDIMENTO E TEOR DE PROTEÍNA BRUTA DA FORRAGEIRA BRACHIÁRIA BRIZANTHA CV. MARANDU, FERTIRRIGADAS COM DIFERENTES DOSES DE ESTERCO LÍQUIDO BOVINO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG - (PROBIC - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(89,'RECUPERAÇÃO E ADEQUAÇÃO AMBIENTAL DE APP COM ESPÉCIES ARBÓREAS NATIVAS EM UM TRECHO DE UMA MICROBACIA HIDROGRÁFICA DO CÓRREGO TIJUCO NO INSTITUTO FEDERAL SUDESTE DE MINAS CAMPUS RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ - (PIBIC - AF-CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(90,'AVALIAÇÃO DE PARÂMETROS QUÍMICOS DO SOLO E RESPIRAÇÃO BASAL DE UM LATOSSOLO VERMELHO-AMARELO DISTRÓFICO, SOB FERTIRRIGAÇÃO COM ESTERCO LÍQUIDO BOVINO EM PASTAGEM DE BRACHIÁRIA BRIZANTHA CV. MARANDU','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ - (PIBIC - AF-CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(91,'PREDIÇÃO DE PESO CORPORAL DE BOVINOS NELORE ATRAVÉES DO PERÍMETRO TORÁCICO ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ - (PIBITI - CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(92,'ELABORAÇÃO DE RAÇÃO PARA CODORNAS JAPONESAS COM INCLUSÃO DE UM SUBPRODUTO DE ORIGEM ANIMAL ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ - (PIBITI - CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(521,'DESENVOLVIMENTO DE EMBALAGEM ATIVA PARA ÁGUA DE COCO ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(94,'CONSTRUÇÃO E CALIBRAÇÃO DE TERMÔMETRO MICROCONTROLADO ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ - (PIBITI - CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(95,'EFEITO DE COMPOSTOS NATURAIS BIOATIVOS NO CONTROLE DA ANTRACNOSE (COLLETOTRICHUM GLOEOSPORIOIDES PENZ) E NA CONSERVAÇÃO PÓS-COLHEITA EM MANGAS (MANGIFERA INDICA L.) CV. PALMER ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ - (PIBITI - CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(96,'AVALIAÇÃO DE COMPOSTOS BIOATIVOS EM SMOOTHIES DE FRUTOS DA PALMEIRA JUÇARA (EUTERPE EDULIS MARTIUS) ADICIONADOS DE ABACAXI CONTENDO L. RHAMONOSUS GG E SUA SOBREVIVÊNCIA SOBRE CONDIÇÕES GASTROINTESTINAIS SIMULADAS IN VITRO ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ - (PIBITI - CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(97,'REDUÇÃO DE SÓDIO EM HAMBÚRGUER BOVINO COM ADIÇÃO DE POTENCIADORES DE SABOR ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(98,'UTILIZAÇÃO DE LIPASES NO TRATAMENTO DE EFLUENTES PROVENIENTES DAS INDÚSTRIAS DE LATICÍNIOS ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ - (PIBITI - CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(99,'ISOLAMENTO DE FUNGOS LIPOLÍTICOS E SELEÇÃO DE MEIO PARA PRODUÇÃO DE LIPASE ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ - (PIBITI - CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(100,'DESENVOLVIMENTO DE BEBIDA LÁCTEA FERMENTADA COM ALBEDO DE MARACUJÁ E DIFERENTES CULTURAS PROBIÓTICAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG - (PROBIC - JR. - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(101,'AVALIAÇÃO DA VIABILIDADE DE BACTÉRIAS LÁTICAS EM LEITES FERMENTADOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG - (PROBIC - JR. - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(102,'CATALOGAÇÃO E DIGITALIZAÇÃO DOS REGISTROS DE BATISMO DA FREGUESIA DO MÁRTIR SÃO MANOEL (1801-1825)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG - (PROBIC - JR. - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(103,'PERFIL DOS HÁBITOS ALIMENTARES E CONHECIMENTOS NUTRICIONAIS DE FREQUENTADORES DA FEIRA LIVRE DE RIO POMBA - MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG - (PROBIC - JR. - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(104,'AVALIAÇÃO DA ESTABILIDADE DE COR DA ÁGUA DE COCO ENVASADA EM EMBALAGEM ATIVA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG - (PROBIC - JR. - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(105,'CARACTERIZAÇÃO DA COMERCIALIZAÇÃO E ANÁLISE BROMATOLÓGICA DE ALIMENTOS BALANCEADOS PARA CÃES E GATOS NO MUNICÍPIO DE RIO POMBA, MINAS GERAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG - (PROBIC - JR. - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(106,'MONTAGEM DO BANCO DE DADOS DOS REGISTROS DE BATISMO DA FREGUESIA DE SÃO MANOEL DO RIO POMBA (1810-1825)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG - (PROBIC - JR. - FAPEMIG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(107,'CARACTERIZAÇÃO FÍSICO-QUÍMICA E AVALIAÇÃO DE ROTULAGEM DE NÉCTARES DE PÊSSEGO COMERCIALIZADOS NA CIDADE DE RIO POMBA - MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ - (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(139,'CARACTERIZAÇÃO DE RIZÓBIOS PRODUTORES DE AIA E SOLUBILIZADORES DE FOSFATO PARA INOCULAÇÃO DO FEIJOEIRO NA ZONA DA MATA DE MINAS GERAIS.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(109,'AVALIAÇÃO DO COMPORTAMENTO DE BANANEIRAS CV “PRATA’’ CULTIVADAS EM CONSÓRCIOS COM LEGUMINOSAS E CULTIVOS ANUAIS. ANO II','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ - (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(110,'AVALIAÇÃO DA INOCULAÇÃO DE ESTIRPES DE RIZÓBIO NO DESENVOLVIMENTO E PRODUTIVIDADE DO FEIJOEIRO NO MUNICÍPIO DE RIO POMBA, MG (ZONA DA MATA MINEIRA)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ - (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(111,'CARACTERIZAÇÃO DO PROCESSO DE PRODUÇÃO E AVALIAÇÃO FÍSICO-QUÍMICA E MICROBIOLÓGICA DE SALAMINHOS PRODUZIDOS ARTESANALMENTE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(112,'ESTABILIDADE DA FARINHA DE TENEBRIO MOLITOR EM DIFERENTES CONDIÇÕES DE ESTOCAGEM','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ - (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(113,'VIABILIDADE TECNOLÓGICA DO PROCESSAMENTO DE HAMBÚRGUER DE FRANGO PRÉ-COZIDO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ - (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(114,'SUBSTITUIÇÃO DE NITRATO/NITRITO POR CULTURAS INICIADORAS EM LINGUIÇA FRESCAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(115,'ESTUDO DA PRECIPITAÇÃO PLUVIOMÉTRICA NO MUNICÍPIO DE RIO POMBA - MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(116,'DESEMPENHO DE PLANTAS DE COBERTURA “DE INVERNO” SOBRE O CULTIVO DE BRÁSSICAS, EM SUCESSÃO E SEU POTENCIAL INIBITÓRIO SOBRE PLANTAS INFESTANTES EM ÁREAS AGRÍCOLAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(117,'INFLUÊNCIA DA CASTRAÇÃO CIRÚRGICA (GONADECTOMIA) E DA IMUNOCASTRAÇÃO NA QUALIDADE DA CARNE DE SUÍNOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(118,'QUALIDADE DE OVOS DE GALINHAS SUBMETIDOS A TRATAMENTO SUPERFICIAL DA CASCA COM PRÓPOLIS OU ÓLEO MINERAL ARMAZENADOS EM DIFERENTES AMBIENTES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(119,'QUALIDADE DE CONSERVAS DE OVOS DE CODORNA, REFRIGERADAS E TIPO PICLES, ADICIONADAS OU NÃO COM CONDIMENTOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(120,'COMPARAÇÃO ENTRE A BIODEGRADAÇÃO DE SACOLAS PLÁSTICAS EM SOLO DIRETO E EM RESPIRÔMETRO DE BARTHA MODIFICADO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(121,'AVALIAÇÃO MORFOLÓGICA DE BRACHIARIA BRIZANTA CV MARANDU SOBRE ADUBAÇÃO ORGÂNICA E MINERAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(122,'EFICIÊNCIA DE MERCADO, INFLUÊNCIA DOS CROSS HEDGES E DA TAXA DE JUROS NO MERCADO FUTURO DO CAFÉ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(123,'AVALIAÇÃO DA HIGIENIZAÇÃO DOS TANQUES DE ARMAZENAMENTO DE LEITE E ELABORAÇÃO DE PROCEDIMENTO PADRÃO DE HIGIENE OPERACIONAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(124,'TÓPICOS DE ÁLGEBRA LINEAR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG -(PIBICTI  - IF SUDESTE MG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(125,'DESENVOLVIMENTO E CARACTERIZAÇÃO DE SUCO DE JUÇARA PROBIÓTICO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(126,'DIVERSIDADE GENÉTICA DE BACTÉRIAS ESPORULADAS DO GÊNERO BACILLUS CONTAMINANTES DE LEITE UHT','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  - IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(127,'USO DE EUCALIPTO (CORYMBIA CITRIODORA) E OU OUTROS FITOTERÁPICOS, NO CONTROLE DE CARRAPATOS DE EQUINOS (AMBLYOMMA CAJENNENSE E ANOCENTOR NITENS), EM PROPRIEDADES RURAIS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  - IF SUDESTE MG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(128,'POTENCIAL PROTEOLÍTICO DE BACTÉRIAS PSICROTRÓFICAS ISOLADAS DE LEITE CRU REFRIGERADO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  - IF SUDESTE MG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(129,'EFEITO DA IRRIGAÇÃO NA ATIVIDADE E BIOMASSA DE MICRORGANISMOS DO SOLO SOB CULTIVO DA BANANEIRA ORGÂNICA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  - IF SUDESTE MG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(130,'RELAÇÃO DO ESCORE DE LOCOMOÇÃO E A PRODUTIVIDADE EM BOVINOS LEITEIROS DA BACIA LEITEIRA DE RIO POMBA NO PERÍODO DA SECA E DAS ÁGUAS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  - IF SUDESTE MG)','01 DE MARÇO DE 2015 A 29 DE FEVEREIRO DE 2016'),
(131,'PROJETO SIGTEC - SISTEMA DE GERÊNCIA DE TRABALHOS CIENTÍFICOS VIA WEB','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MAIO DE 2014 A 30 DE ABRIL DE 2015'),
(132,'SISTEMA DE GERÊNCIA DE TRABALHOS CIENTÍFICOS VIA WEB','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MAIO DE 2015 A 30 DE ABRIL DE 2016'),
(133,'IDENTIFICAÇÃO DAS TÉCNICAS DE MANEJO UTILIZADAS NA CRIAÇÃO DE BEZERRAS LEITEIRAS NO MUNICÍPIO DE RIO POMBA-MG','PIVICT- IF SUDESTE MG','01 DE AGOSTO DE 2013 A 31 DE JULHO DE 2014'),
(134,' INFLUÊNCIA DA MORFOLOGIA NA QUALIDADE DA MARCHA E NA COMODIDADE DE CAVALOS DA RAÇA MANGALARGA MARCHADOR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(137,'SUCESSÃO ECOLÓGICA EM ÁREA DE PASTAGEM NA ZONA DA MATA DE MINAS GERAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(140,'DESEMPENHO E COMPORTAMENTO DE BEZERROS LEITEIROS SUBMETIDOS A DOIS NÍVEIS DE ALEITAMENTO&#13;&#10;','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)&#13;&#10;','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(141,'EFEITO DE DIFERENTES ATIVIDADES PREPARATÓRIAS NA POTENCIALIZAÇÃO DO DESEMPENHO DA CORRIDA DE 100 M','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)&#13;&#10;','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(142,'DESENVOLVIMENTO DE UM LIVRO DIGITAL INTERATIVO INFANTIL PARA SMARTPHONES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(143,'INFLUÊNCIA DO AMBIENTE DE MATURAÇÃO NAS CARACTERÍSTICAS FÍSICO-QUÍMICAS E MICROBIOLÓGICAS DE QUEIJO MINAS ARTESANAL DO SERRO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(144,'DIVERSIDADE GENÉTICA E IDENTIFICAÇÃO DE ESTIRPES RIZOBIANAS ISOLADAS DE NÓDULOS DE FEIJOEIRO DA REGIÃO DE RIO POMBA, MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(145,'LEVANTAMENTO DA GRANULOMETRIA E CLASSIFICAÇÃO DO MILHO USADO EM RAÇÕES PARA SUÍNOS EM FÁBRICAS DE RAÇÃO NA ZONA DA MATA MINEIRA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(146,'EXTRATO DE LEVEDURA NA RAÇÃO DE VACAS LEITEIRAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(147,'AVALIAÇÃO DA COMPETITIVIDADE DO SETOR DE HORTIFRUTIGRANJEIROS DA CIDADE DE RIO POMBA E SUA INFLUêNCIA SOBRE A FEIRA LIVRE: UM ESTUDO DE CASO SOBRE OS FORNECEDORES E CONCORRENTES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(148,'EFEITO DA ALTURA DE MANEJO SOBRE O CONSÓRCIO GRAMÍNEA LEGUMINOSA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(149,'CULTIVO DE COGUMELOS AGARICUS BLAZEI PELA TÉCNICA JUN-CAO EM DIFERENTES TIPOS DE SUBSTRATOS ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(150,'CÁLCULO PARA ALUNOS CEGOS: DESAFIOS E POSSIBILIDADES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(151,'FARINHA DE COGUMELO AGARICUS BLAZEI COMO ADITIVO FUNCIONAL NA ALIMENTAÇÃO DE GALINHAS POEDEIRAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(152,'POTENCIAL INIBITÓRIO DE PLANTAS DE COBERTURA DO SOLO SOBRE ESPÉCIES DA VEGETAÇÃO ESPONTÂNEA E SEU DESEMPENHO EM SUCESSÃO, NO CULTIVO DE OLERÍCULAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(153,'VERIFICAÇÃO DA EFICIÊNCIA DE KITS MICROBIOLÓGICOS DE DETECÇÃO DE ANTIBIÓTICOS EM LEITE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(154,'O PROBLEMA DE CORTE UNIDIMENSIONAL, COM MINIMIZAÇÃO DO NÚMERO DE OBJETOS PROCESSADOS E SETUP, VIA METAHEURÍSTICAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(155,'ELABORAÇÃO DE HAMBÚRGUER ADICIONADO DE FARINHA DE TENEBRIO MOLITOR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(156,'AVALIAÇÃO DE DIFERENTES FORMAS DE FORNECIMENTO DE FERRO PARA LEITÕES RECÉM-NASCIDOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(157,'INFLUÊNCIA DA QUALIDADE MICROBIOLÓGICA DO LEITE CRU NA INTEGRIDADE DAS PROTEÍNAS DO LEITE E NO RENDIMENTO DA PRODUÇÃO DE QUEIJO MINAS PADRÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(158,'DESENVOLVIMENTO DE QUEIJOS MINAS FRESCAL E MUSSARELA COM TEOR REDUZIDO DE SÓDIO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(159,'EFEITO DE ESTRESSE SUBLETAL EM CÉLULAS DE LACTOBACILLUS RHAMNOSUS GG EM SUCO MISTO DE JUÇARA E MANGA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(160,'DISPOSITIVO NÃO-INVASIVO PARA CANCELAMENTO DE TREMOR EM PACIENTES COM TREMOR ESSENCIAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(161,'DESENVOLVIMENTO DE UM PROCESSO DE PURIFICAÇÃO DE ÓLEO DE FRITURA PARA USO NA ALIMENTAÇÃO DE SUÍNOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(162,'CARACTERIZAÇÃO ENZIMÁTICA DE POLIFENOLOXIDASES E PEROXIDASES PARA DESENVOLVIMENTO DE METODOLOGIA DE INATIVAÇÃO TÉRMICA E ELABORAÇÃO DE PRODUTO À BASE DE YACON.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(163,'ELABORAÃ?Ã?O E CARACTERIZAÃ?Ã?O DE QUEIJO TIPO MINAS PADRÃ?O ADICIONADO DE BACTÃ?RIAS LÃ??TICAS ISOLADAS DA REGIÃ?O DO SERRO, MINAS GERAIS ','',''),
(164,'DESENVOLVIMENTO DE PRODUTOS CÁRNEOS REESTRUTURADOS COM ADIÇÃO DE CHIA (SALVIA HISPANICA L.) COMO SUBSTITUTA PARCIAL DE GORDURA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(165,'DISPOSITIVO TECNOLÓGICO AUXILIAR DO TREINADOR DE NATAÇÃO NA CONDUÇÃO DO TREINO DE ATLETAS COMPETITIVOS.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(166,'EFEITO DA RADIAÇÃO GAMA (COBALTO 60) NA CONSERVAÇÃO DE FARINHA DE TENEBRIO MOLITOR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE JANEIRO DE 2016 A 31 DE JULHO DE 2017'),
(167,'DETERMINAÇÃO DA INFLUENCIA DO MANEJO DE ORDENHA NA QUALIDADE DO LEITE CRU','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(168,'CÁLCULO DIFERENCIAL: UMA ABORDAGEM PARA ESTUDANTES DO ENSINO MÉDIO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(169,'CONFECÇÃO DE CARPOTECA E MAPA FENOLÓGICO DAS ESPÉCIES ARBÓREAS PRESENTES NO CAMPUS RIO POMBA - ESTUDO PRELIMINAR.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(170,'MOSCAS-BRANCAS (BEMISIA TABACI): ANÁLISE PARA IDENTIFICAÇÃO DE ESPÉCIE E DO CONJUNTO DE ENDOSSIMBIONTES&#13;&#10;&#13;&#10;','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(171,'MOSCAS-BRANCAS (BEMISIA TABACI): ANÁLISE PARA IDENTIFICAÇÃO DE ESPÉCIE E DO CONJUNTO DE ENDOSSIMBIONTES&#13;&#10;','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(172,'INFLUÊNCIA DO AMBIENTE DE MATURAÇÃO NAS CARACTERÍSTICAS FÍSICO-QUÍMICAS E MICROBIOLÓGICAS DE QUEIJO MINAS ARTESANAL DO SERRO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(173,'BIOATIVIDADE DE PRODUTOS NATURAIS SOBRE A TRAÇA-DO-TOMATEIRO TUTA ABSOLUTA MEYRICK) (LEPIDOPTERA: GELECHIIDAE) E SELETIVIDADE AOS SEUS PREDADORES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(174,'INFLUÊNCIA DO AMBIENTE DE MATURAÇÃO NAS CARACTERÍSTICAS FÍSICO-QUÍMICAS E MICROBIOLÓGICAS DE QUEIJO MINAS ARTESANAL DO SERRO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(175,'USO DO EXTRATO SECO DA FOLHA DO NEEM NO CONTROLE DE VERMINOSES EM OVINOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(176,'CONFECÇÃO DE CARPOTECA E MAPA FENOLÓGICO DAS ESPÉCIES ARBÓREAS PRESENTES NO CAMPUS RIO POMBA - ESTUDO PRELIMINAR.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(177,'BIOATIVIDADE DE PRODUTOS NATURAIS SOBRE A TRAÇA-DO-TOMATEIRO TUTA ABSOLUTA MEYRICK) (LEPIDOPTERA: GELECHIIDAE) E SELETIVIDADE AOS SEUS PREDADORES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(178,'AVALIAÇÃO DE ROTULAGEM DE REFRIGERANTES DE DIFERENTES SABORES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(179,'AVALIAÇÃO DE ROTULAGEM DE REFRIGERANTES DE DIFERENTES SABORES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE MARÇO DE 2017 A 31 DE JULHO DE 2017'),
(180,'SISTEMA DE GERÊNCIA DE TRABALHOS TÉCNICOS CIENTÍFICOS VIA WEB – SISTEMAS PARA A DPPG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(181,'MOSCAS-BRANCAS (BEMISIA TABACI): ANÁLISE PARA IDENTIFICAÇÃO DE ESPÉCIE E DO CONJUNTO DE ENDOSSIMBIONTES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG–(PIBICTI–IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(182,'DESEMPENHO E QUALIDADE DE OVOS DE GALINHAS SEMIPESADAS ALIMENTADAS COM RAÇÕES CONTENDO PRODUTOS HOMEOPÁTICOS DURANTE E APÓS A MUDA FORÇADA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(183,'VALIDAÃ?Ã?O DA FITA DE PESAGEM DA RAÃ?A GIROLANDO','',''),
(184,'QUALIDADE NUTRICIONAL DA SILAGEM DE MILHO PÓS REENSILAGEM','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(185,'CARACTERIZAÇÃO BIOQUÍMICA DA PROTEASE APRX DE PSEUDOMONAS FLUORESCENS 041 E DETERMINAÇÃO DO POTENCIAL PROTEOLÍTICO NAS CASEÍNAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(186,'POTENCIAL PREBIÓTICO DE POLPA DE FRUTAS NA VIABILIDADE DAS BACTÉRIAS LÁTICAS EM BEBIDA TIPO SMOOTHIE A BASE DE KEFIR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(187,'DESENVOLVIMENTO DE UM SISTEMA DE VISUALIZAÇÃO TRIDIMENSIONAL DA DINÂMICA DE MAGNETIZAÇÃO EM NANOMAGNETOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(188,'PLICATIVO MOBILE PARA COMPARTILHAMENTO DE INFORMAÇÕES DE VIAGENS DO SETOR DE TRANSPORTE ENTRE INSTITUIÇÕES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(189,'AVALIAÇÃO DO RENDIMENTO E TEOR DE PROTEÍNA BRUTA DA FORRAGEIRA PANICUM MAXIMUM BRS ZURI EM FUNÇÃO DE DIFERENTES DOSES DE FERTILIZANTE NITROGENADO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(190,'EFEITOS DE UM PROTOCOLO DE HIGH INTENSITY INTERVAL TRAINING (HIIT) NA CAPACIDADE FUNCIONAL DE IDOSAS DA CIDADE DE RIO POMBA – MG: UM ESTUDO RANDOMIZADO E CONTROLADO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(191,'PRODUÇÃO DE QUEIJO EM AGRICULTURA FAMILIAR: AVALIAÇÃO DAS CONDIÇÕES HIGIÊNICO-SANITÁRIAS E CARACTERÍSTICAS FÍSICO-QUÍMICAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(192,'ÓLEOS ESSÊNCIAS NO CONTROLE DO MOFO CINZENTO E SEUS EFEITOS NA QUALIDADE PÓS-COLHEITA DO MORANGO (FRAGARIA SP.)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(193,'EFEITO DO DANO MUSCULAR INDUZIDO PELO EXERCÍCIO NA APRENDIZAGEM MOTORA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(194,'ANÁLISE ECONÔMICA E AVALIAÇÃO DA QUALIDADE DA SILAGEM DE COPRODUTOS DE MANGA COM DIFERENTES NÍVEIS DE ADITIVO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(195,'CLASSIFICAÇÃO DE GRÃOS DE CAFÉ UTILIZANDO TÉCNICAS DE ANÁLISE DE IMAGENS E APRENDIZADO DE MÁQUINA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(196,'CCOMPARAÇÃO DE PARÂMETROS CINÉTICOS NA FERMENTAÇÃO DE CERVEJA ARTESANAL POR SACCHAROMYCES BOULARDII E SACCHAROMYCES CEREVISIAE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2017 A 31 DE JULHO DE 2017'),
(197,'AVALIAÇÃO FÍSICO QUÍMICA DE HAMBÚRGUER DE FRANGO COZIDO ELABORADO COM CARNE MECANICAMENTE SEPARADA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2017 A 31 DE JULHO DE 2017'),
(198,'DETERMINAÇÃO DA CURVA DE CRESCIMENTO DE ANIMAIS NELORE','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(199,'DESEMPENHO E COMPORTAMENTO DE BEZERROS LEITEIROS SUBMETIDOS A DOIS NÍVEIS DE ALEITAMENTO','PROGRAMA INSTITUCIONAL VOLUNTáRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(200,'CARACTERIZAÇÃO FÍSICO-QUÍMICA E AVALIAÇÃO DE VIDA ÚTIL DO QUEIJO À BASE DE RICOTA ADICIONADO DE DRESSING FERMENTADO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(201,' ELABORAÃ?Ã?O E CARACTERIZAÃ?Ã?O DE QUEIJO TIPO MINAS PADRÃ?O ADICIONADO DE BACTÃ?RIAS LÃ??TICAS ISOLADAS DA REGIÃ?O DO SERRO, MINAS GERAIS ','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE ABRIL DE 2017  A 31 DE JULHO DE 2017'),
(202,'CRIAÇÃO DE TUBIFEX (TUBIFEX SP.)','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(203,'COMPARAÇÃO DE PARÂMETROS CINÉTICOS NA FERMENTAÇÃO DE CERVEJA ARTESANAL POR SACCHAROMYCES BOULARDII E SACCHAROMYCES CEREVISIAE','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(204,'ESTIMAÇÃO DOS PARÂMETROS GENÉTICOS PARA PRODUÇÃO DE LEITE NO IF SUDESTE MG CAMPUS RIO POMBA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(205,'COMPRESSÃO DE SEQUÊNCIAS GENÔMICAS USANDO ALGORITMOS DE CODIFICAÇÃO DE IMAGENS E VÍDEOS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(206,'PRODUÇÃO DE QUEIJO EM AGRICULTURA FAMILIAR: AVALIAÇÃO DAS CONDIÇÕES HIGIÊNICO-SANITÁRIAS E CARACTERÍSTICAS FÍSICO-QUÍMICAS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(207,'UMA METODOLOGIA PARA A DETECÇÃO DE ANOMALIAS DA MAMA UTILIZANDO APRENDIZADO PROFUNDO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(208,'DESENVOLVIMENTO DE UM SISTEMA DE VISUALIZAÇÃO TRIDIMENSIONAL DA DINÂMICA DE MAGNETIZAÇÃO EM NANOMAGNETOS','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(209,'INFLUÊNCIA DO TIPO DE FERMENTO NAS CARACTERÍSTICAS DE QUEIJO MINAS ARTESANAL DO SERRO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(210,'DESENVOLVIMENTO DE UM PROCESSO DE PURIFICAÇÃO DE ÓLEO DE FRITURA PARA USO NA ALIMENTAÇÃO DE SUÍNOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(211,'INFLUÊNCIA DA QUALIDADE MICROBIOLÓGICA DO LEITE CRU NA INTEGRIDADE DAS PROTEÍNAS DO LEITE E NO RENDIMENTO DA PRODUÇÃO DE QUEIJO MINAS PADRÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE JANEIRO DE 2017 A 31 DE JULHO DE 2017'),
(212,'AVALIAÃ?Ã?O DE DIFERENTES FORMAS DE FORNECIMENTO DE FERRO PARA LEITÃ?ES RECÃ?M-NASCIDOS\n','',''),
(213,'EFEITO DE ESTRESSE SUBLETAL EM CÉLULAS DE LACTOBACILLUS RHAMNOSUS GG EM SUCO MISTO DE JUÇARA E MANGA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(214,'DISPOSITIVO TECNOLÓGICO AUXILIAR DO TREINADOR DE NATAÇÃO NA CONDUÇÃO DO TREINO DE ATLETAS COMPETITIVOS.','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE DEZEMBRO DE 2016 A 31 DE JULHO DE 2017'),
(215,'UTILIZAÇÃO DE SORO DE LEITE PARA FERTIRRIGAÇÃO: ESTUDO DA UTILIZAÇÃO ALTERNATIVA DESTE RESÍDUO INDUSTRIAL.','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(216,'UTILIZAÃ?Ã?O DE SORO DE LEITE PARA FERTIRRIGAÃ?Ã?O: ESTUDO DA UTILIZAÃ?Ã?O ALTERNATIVA DESTE RESÃ??DUO INDUSTRIAL.','',''),
(217,'EFEITO DA ALTURA DE MANEJO SOBRE O CONSÓRCIO GRAMÍNEA LEGUMINOSA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(218,'INFLUÊNCIA DE MICRORGANISMOS EFICIENTES NA COMPOSTAGEM DE MATERIAL DE BANHEIRO SECO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(219,'FARINHA DE COGUMELO AGARICUS BLAZEI COMO ADITIVO FUNCIONAL NA ALIMENTAÇÃO DE GALINHAS POEDEIRAS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(220,'CÁLCULO PARA ALUNOS CEGOS: DESAFIOS E POSSIBILIDADES','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(221,'DIVERSIDADE GENÉTICA E IDENTIFICAÇÃO DE ESTIRPES RIZOBIANAS ISOLADAS DE NÓDULOS DE FEIJOEIRO DA REGIÃO DE RIO POMBA, MG','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(222,'ANÁLISE DA INFLUÊNCIA DO USO E OCUPAÇÃO DO SOLO NA QUALIDADE DAS ÁGUAS DA BACIA DO RIO TIJUCO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(223,'ELABORAÇÃO DE HAMBÚRGUER ADICIONADO DE FARINHA DE TENEBRIO MOLITOR','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(224,'AVALIAÇÃO DA COMPETITIVIDADE DO SETOR DE HORTIFRUTIGRANJEIROS DA CIDADE DE RIO POMBA E SUA INFLUÊNCIA SOBRE A FEIRA LIVRE: UM ESTUDO DE CASO SOBRE OS FORNECEDORES E CONCORRENTES','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(225,'AVALIAÇÃO DA COMPETITIVIDADE DO SETOR DE HORTIFRUTIGRANJEIROS DA CIDADE DE RIO POMBA E SUA INFLUÊNCIA SOBRE A FEIRA LIVRE: UM ESTUDO DE CASO SOBRE OS FORNECEDORES E CONCORRENTES','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE OUTUBRO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(226,'PARÂMETROS FÍSICOS-QUÍMICOS DA ÁGUA EM PISCICULTURA COM SISTEMA DE CULTIVO EM TANQUES-REDE EM TABULEIRO - MG','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(227,'PARÂMETROS FÍSICOS-QUÍMICOS DA ÁGUA EM PISCICULTURA COM SISTEMA DE CULTIVO EM TANQUES-REDE EM TABULEIRO - MG','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(228,'CARACTERIZAÇÃO DO ESCORE DE LOCOMOÇÃO DE VACAS LACTANTES DA RAÇA GIR LEITEIRO','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(229,'EFEITO DE ESTRESSE SUBLETAL EM CÉLULAS DE LACTOBACILLUS RHAMNOSUS GG EM SUCO MISTO DE JUÇARA E MANGA ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE FEVEREIRO DE 2017 A 31 DE JULHO DE 2017'),
(230,'DIAGNÓSTICO E MELHORAMENTO DA QUALIDADE DO LEITE CRU DE UMA PROPRIEDADE RURAL DO MUNICÍPIO DE RIO POMBA, MG.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(231,'OCORRÊNCIA DE LEITE INSTÁVEL NÃO ÁCIDO (LINA) E SUAS IMPLICAÇÕES SOBRE A COMPOSIÇÃO E AS PROPRIEDADES FÍSICO-QUÍMICAS DO LEITE CRU PRODUZIDO NA REGIÃO DE RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2011 A 31 DE JULHO DE 2012'),
(232,'COMPATIBILIDADE ENTRE ESTIRPES BRASILEIRAS DE FUNGOS ECTOMICORR??ZICOS E ACACIA MANGIUM','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2012 A 31 DE JULHO DE 2013'),
(233,'ISOLAMENTO DE BACTÉRIAS FIXADORAS DE NITROGÊNIO PROMOTORAS DA RIZOGÊNESE PARA INOCULAÇÃO DE ESPÉCIES LEGUMINOSAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2012 A 31 DE JULHO DE 2013'),
(234,'CARACTERIZAÇÃO DO PROCESSO DE PRODUÇÃO E AVALIAÇÃO F??SICO-QU??MICA E MICROBIOLÓGICA DE SALAMINHOS PRODUZIDOS ARTESANALMENTE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2015 A 31 DE JULHO DE 2016'),
(236,'UTILIZAÇÃO DE SORO DE LEITE PARA FERTIRRIGAÇÃO: ESTUDO DA UTILIZAÇÃO ALTERNATIVA DESTE RESÍDUO INDUSTRIAL.','PROGRAMA INSTITUCIONAL VOLUNTÁRIO DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2016 A 28 DE FEVEREIRO DE 2017'),
(239,'METABOLIZABILIDADE DE NUTRIENTES DE RAÇÕES SUPLEMENTADAS COM COMPLEXO MULTIENZIMÁTICO PARA SUÍNOS NA FASE DE CRECHE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(240,'AVALIAÇÃO DA VIABILIDADE DE BACTÉRIAS LÁTICAS EM LEITES FERMENTADOS PROBIÓTICOS COMERCIAIS E RESISTÊNCIA DAS ESTIRPES AO TRATO GASTROINTESTINAL SIMULADO IN VITRO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(241,'AVALIAÇÃO DO USO DE BIOENSAIO COM DANIO RERIO (ZEBRAFISH) PARA A DETECÇÃO DE ÁCIDO CIANÍDRICO EM MANDIOCA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(242,'ALTERAÇÕES NAS CARACTERÍSTICAS FÍSICO-QUÍMICAS DO SOLO E AVALIAÇÃO DA PRODUTIVIDADE DA FORRAGEIRA PANICUM MAXIMUM BRS ZURI FERTIRRIGADA COM ÁGUA RESIDUÁRIA DA PISCICULTURA','PROGRAMA INSTITUCIONAL VOLUNTáRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(243,'APOIO À CARACTERIZAÇÃO E RECONHECIMENTO DA REGIÃO DAS SERRAS DE IBITIPOCA COMO PRODUTORA DE QUEIJO ARTESANAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(244,'EFEITOS DO ALONGAMENTO ESTÁTICO PRÉVIO NAS ADAPTAÇÕES MUSCULARES APÓS 8 SEMANAS DE TREINAMENTO DE FORÇA EM HOMENS JOVENS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(245,'ELABORAÇÃO E CARACTERIZAÇÃO DE QUEIJO TIPO MINAS PADRÃO COM TEOR REDUZIDO DE SÓDIO, ADICIONADO DE BACTÉRIA LÁTICA ISOLADA DA REGIÃO DO SERRO, MINAS GERAIS, E SOBREVIVÊNCIA DA MESMA AO TRATO GASTROINTESTINAL SIMULADO IN VITRO','PROGRAMA INSTITUCIONAL VOLUNTáRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO(PIVICTI  – IF SUDESTE MG).','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(246,'DELINEAMENTO DO PERFIL DE FORMAÇÃO E ATUAÇÃO DOS PROFISSIONAIS DOCENTES DO IF SUDESTE MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(247,'AVALIAÇÃO DE DIFERENTES FORMAS DE FORNECIMENTO DE FERRO EM LEITÕES RECÉM-NASCIDOS E SEUS EFEITOS NA FASE DE CRECHE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(248,'ALGAS MARINHAS COMO TAMPONANTE RUMINAL EM DIETAS DE VACAS LEITEIRAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(249,'AVALIAÇÃO DA ALTURA DE MANEJO SOBRE O CONSÓRCIO GRAMÍNEA LEGUMINOSA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓFICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(250,'DESAFIOS E POSSIBILIDADES DE ENSINO DE ESTATÍSTICA PARA DEFICIENTES VISUAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(251,'PARÂMETROS DE QUALIDADE FÍSICO-QUÍMICA DE OVOS DE GALINHA SUBMETIDOS A TRATAMENTO SUPERFICIAL DA CASCA ESTOCADOS EM AMBIENTE COM E SEM REFRIGERAÇÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(252,'ESTUDOS SOBRE A ATIVIDADE ALELOPÁTICA DE EXTRATOS VEGETAIS E SUA UTILIZAÇÃO NO MANEJO DE ESPÉCIES DA VEGETAÇÃO ESPONTÂNEA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(253,'POTENCIAL PREBIÓTICO DE FARINHA DE PLEUROTUS OSTREATUS VAR. FLORIDA NO CRESCIMENTO DE L. CASEI EM IOGURTE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(254,'A INFLUÊNCIA DO TEMPO DE RALLY NO PLANEJAMENTO DOS TREINOS DAS EQUIPES DE VOLEIBOL DO CAMPUS RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(255,'EFICÁCIA DA FITA TORÁCICA PARA PREDIÇÃO DO PESO CORPORAL DE EQUINOS MANGALARGA MARCHADOR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(256,'COMPOSIÇÃO DE EXPERIMENTOS CIENTÍFICOS IN SILICO A PARTIR DA ANÁLISE DE EXPERIMENTOS CIENTÍFICOS BIOQUÍMICOS IN VITRO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(257,'AVALIAÇÃO DA RECUPERAÇÃO MUSCULAR EM UMA COMPETIÇÃO ESCOLAR DE FUTEBOL SUB 19 COM INTERVALO DE RECUPERAÇÃO ENTRE OS JOGOS DE 24H','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(258,'AVALIAÇÃO DO RENDIMENTO, TEOR DE PROTEÍNA BRUTA E CARACTERÍSTICAS MORFOGÊNICAS E INTENSIDADES DE DESFOLHAS DA FORRAGEIRA BRACHIARIA BRIZANTHA CV. XARAÉS SUBMETIDA A FERTIRRIGAÇÃO COM DIFERENTES DOSES DE ESTERCO LIQUIDO BOVINO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(259,'IMPACTO DE DIFERENTES ALEITAMENTOS SOBRE A RECRIA E A EFICIÊNCIA REPRODUTIVA DE NOVILHAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(260,'CARACTERIZAÇÃO E POTENCIAL TECNOLÓGICO DE LEITELHO PRODUZIDO EM LATICÍNIOS DA MICRORREGIÃO DE UBÁ ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(522,'QUALIDADE DA ÁGUA UTILIZADA NA DESSEDENTAÇÃO DE BOVINOS NO MUNICÍPIO DE RIO POMBA - MG E REGIÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(262,'DESENVOLVIMENTO E CARACTERIZAÇÃO DE CERVEJA ARTESANAL ESTILO ALE BLOND COM ADIÇÃO DE JUÇARA (EUTERPE EDULIS)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(263,'CONSTRUÇÃO DE CÂMARA EQUIPADA COM CONTROLE DE TEMPERATURA E UMIDADE RELATIVA DO AR MONTADA COM MÓDULO DE PELTIER PARA FABRICAÇÃO DE SALAMINHO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(264,'SISTEMA DE APOIO À DECISÃO PARA AUXÍLIO DO PROCESSAMENTO DOS FORMULÁRIOS SOCIOECONÔMICOS DO PROGRAMA DE ATENDIMENTO AOS ESTUDANTES EM BAIXA CONDIÇÃO SOCIOECONÔMICA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(265,'FABRICAÇÃO DE QUEIJO MINAS PADRÃO COM A UTILIZAÇÃO DE CULTURAS LÁCTICAS ENDÓGENAS, ISOLADAS DE QUEIJOS MINAS ARTESANAIS DO SERRO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(266,'ELABORAÇÃO DE HAMBÚRGUER BOVINO COM REDUZIDO TEOR DE SÓDIO E ADIÇÃO DE CLORETO DE POTÁSSIO E DE POTENCIALIZADORES DE SABOR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(267,'DESENVOLVIMENTO DE UM SISTEMA ORIENTADO AO DIAGNÓSTICO DE ANOMALIAS DAS MAMAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(268,'APLICAÇÃO SELETIVA DE MÉTRICAS HETEROGÊNEAS NO PLANEJAMENTO E ESTIMATIVA DE TESTE DE SOFTWARE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(269,'MEMÓRIA DO ESPORTE E DA EDUCAÇÃO FÍSICA NO INSTITUTO FEDERAL DE CIÊNCIA E TECNOLOGIA DE RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(270,'CARACTERIZAÇÃO DO TEMPO DE DURAÇÃO DO RALLY NO VOLEIBOL EM JOGOS AMADORES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(271,'MATHMEMORY: UM JOGO DA MEMÓRIA MATEMÁTICO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(272,'CARACTERIZAÇÃO FÍSICO-QUÍMICA E AVALIAÇÃO DE ROTULAGEM DE SUCOS E NÉCTARES DE CAJU COMERCIALIZADOS NA CIDADE DE RIO POMBA - MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(273,'ANÁLISE BIOLÓGICA E MOLECULAR DE BEMISIA TABACI - MIDDLE EAST ASIA MINOR 1 (MEAM1) EM MANIHOT ESCULENTA CRANTZ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(274,'APLICAÇÃO, MONITORAMENTO E AVALIAÇÃO DA UTILIZAÇÃO DE FERTIPROTETORES PARA O MANEJO AGROECOLÓGICO DA NUTRIÇÃO E DA FITOSSANIDADE DE PLANTAS DE COFFEA ARABICA EM UNIDADE EXPERIMENTAL A PLENO SOL E ARBORIZADA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(275,'POTENCIAL DE EXTRATOS VEGETAIS NO CONTROLE DE TUTA ABSOLUTA, PLUTELLA XYLOSTELLA E ASCIA MONUSTE ORSEIS','PROGRAMA INSTITUCIONAL VOLUNTáRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(276,'AVALIAÇÃO DA QUALIDADE DO ÓLEO DE DESCARTE SUBMETIDO AO PROCESSO DE FRITURA DESCONTÍNUA EM ESTABELECIMENTOS COMERCIAIS DA CIDADE DE RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(277,'UM APLICATIVO DE APOIO AO APRENDIZADO DA LÍNGUA INGLESA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(278,'UMA METODOLOGIA PARA A SEGMENTAÇÃO E A CLASSIFICAÇÃO DE IMAGENS INFRAVERMELHAS LATERAIS PARA O DIAGNÓSTICO DE ANOMALIAS DA MAMA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(279,'DESEMPENHO DOS ESTAGIÁRIOS DISPONIBILIZADOS AO MERCADO PELO IF SUDESTE MG - CAMPUS RIO POMBA: UMA PESQUISA DE SATISFAÇÃO JUNTO AO EMPRESARIADO LOCAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(280,'APTIDÃO DE TERRAS DO CAMPUS RIO POMBA DO IF SUDESTE MG PARA À AGRICULTURA MECANIZADA UTILIZANDO TRATORES AGRÍCOLAS DE PNEUS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(281,'ANÁLISE DA EFICIÊNCIA NA ALOCAÇÃO DOS GASTOS PÚBLICOS COM SEGURANÇA PÚBLICA NOS MUNICÍPIOS DA ZONA DA MATA MINEIRA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(282,'ELABORAÇÃO DE SALAMINHO EM CÂMARA MONTADA COM MÓDULOS DE PELTIER EQUIPADA COM CONTROLES DE TEMPERATURA E UMIDADE RELATIVA DO AR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(283,'SILAGEM DE GRÃO DE MILHO TRITURADO E REIDRATADO COM SORO DE LEITE OU ÁGUA, UTILIZANDO OU NÃO LACTOBACILLUS BUCHNERI','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(284,'RASTREIO, DIAGNÓSTICO E REABILITAÇÃO DA FRAGILIDADE E SARCOPENIA EM IDOSOS DE RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(285,'ADEQUAÇÃO DOS TESTES DE CONDUTIVIDADE ELÉTRICA E ENVELHECIMENTO ACELERADO PARA DETERMINAÇÃO DA QUALIDADE FISIOLÓGICA EM SEMENTES DE CRATYLIA ARGENTEA (DESV.) KUNTZE (FABACEAE – PAPILIONOIDEA)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(286,'ESTUDOS SOBRE O POTENCIAL ALELOPÁTICO DE ESPÉCIES DE COBERTURA DO SOLO NO PERÍODO DE INVERNO, SOBRE PLANTAS ESPONTÂNEAS DE OCORRÊNCIA EM ÁREAS AGRÍCOLAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(287,'MORFOGÊNESE, CARACTERÍSTICA ESTRUTURAL E ACÚMULO DE FORRAGEM EM PASTAGEM DE PANICUM MAXIMUM BRS ZURI SOB DIFERENTES DOSES DE ADUBAÇÃO NITROGENADA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(288,'EFEITO ALELOPÁTICO DO SORGOLEONE SOBRE A GERMINAÇÃO DO PICÃO PRETO E ALFACE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(289,'DESEMPENHO ZOOTÉCNICO, CARACTERÍSTICAS DE CARCAÇA E PARÂMETROS SANGUÍNEOS DE FRANGOS DE CORTE ALIMENTADOS COM RAÇÕES ADICIONADAS DE PRODUTOS HOMEOPÁTICOS','PROGRAMA INSTITUCIONAL VOLUNTáRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(551,'HISTÓRIAS E MEMÓRIAS DA INCLUSÃO NAS ESCOLAS DE RIO POMBA - MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(291,'AVALIAÇÃO MICROBIOLÓGICA DE KEFIR E EFEITO PREBIÓTICO DE FARINHA DE BANANA VERDE NO CRESCIMENTO DE BACTÉRIAS LÁTICAS CONTIDAS NOS GRÃOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(292,'A INCLUSÃO DE ALUNOS SURDOS NAS AULAS DE MATEMÁTICA: EXPLORANDO OS CONCEITOS DO CÁLCULO DIFERENCIAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(293,'EXTRAÇÃO DE PROTEÍNAS DE FOLHA ORA-PRO-NÓBIS (PERESKIA ACULEATA) PARA OBTENÇÃO DE CONCENTRADO PROTEICO SUBMETIDO A DIFERENTES TRATAMENTOS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(294,'COLETA E ANÁLISE DE DADOS DO SOLO, APLICADOS À AGRICULTURA, ATRAVÉS DE PROCESSOS DE CLASSIFICAÇÃO E APRENDIZADO DE MÁQUINA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(295,'DESENVOLVIMENTO DE DOCE DE LEITE ELABORADO A PARTIR DE LEITE DE CABRA E AVALIAÇÃO DE SUAS CARACTERÍSTICAS FÍSICO-QUÍMICAS E SENSORIAIS, COMPARADA ÀS DO LEITE DE VACA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(296,'RECUPERAÇÃO AMBIENTAL DA NASCENTE QUE ABASTECE O CAMPUS RIO POMBA – IF SUDESTE MG','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(297,'ELABORAÇÃO DE HAMBÚRGUER DE FRANGO ADICIONADO DE FARINHA DE LINHAÇA DOURADA (LINUM USITATISSIMUM L) ','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(298,'GERAÇÃO PROCEDURAL DE TERRENOS EM JOGOS BIDIMENSIONAIS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(299,'UMA METODOLOGIA PARA EXTRAÇÃO DE PONTOS HOMÓLOGOS EM PARES DE IMAGENS ESTEREOSCÓPICAS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(300,'APROVEITAMENTO DE COPRODUTO DO PROCESSO CERVEJEIRO PARA ELABORAÇÃO DE BARRAS DE CEREAIS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(301,'AVALIAÇÃO DO TEOR DE METABISSULFITO EM ÁGUAS DE COCO INDUSTRIALIZADAS, COMERCIALIZADAS NO MUNICÍPIO DE RIO POMBA - MG','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2017 A 28 DE FEVEREIRO DE 2018'),
(302,'AVALIAÇÃO DE SIMBIÓTICOS EM DIETAS UMEDECIDAS OU NÃO PARA SUÍNOS NA FASE DE CRESCIMENTO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2013 A 28 DE FEVEREIRO DE 2014'),
(303,'EFEITOS DE UM PROTOCOLO DE HIGH INTENSITY INTERVAL TRAINING (HIIT) NA CAPACIDADE FUNCIONAL DE IDOSAS DA CIDADE DE RIO POMBA-MG: UM ESTUDO RANDOMIZADO E CONTROLADO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG (PIBICTI-IF SUDESTE MG)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(304,'DISPOSITIVO TECNOLÓGICO AUXILIAR DO TREINADOR DE NATAÇÃO NA CONDUÇÃO DO TREINO DE ATLETAS COMPETITIVOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ- (PIBITI-CNPQ)','01 DE AGOSTO DE 2016 A 31 DE JULHO DE 2017'),
(305,' ELABORAÇÃO E CARACTERIZAÇÃO DE QUEIJO TIPO MINAS PADRÃO ADICIONADO DE BACTÉRIAS LÁTICAS ISOLADAS DA REGIÃO DO SERRO, MINAS GERAIS ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ - (PIBITI - CNPQ)',' 01 DE ABRIL DE 2017 A 31 DE  JULHO DE 2017'),
(306,'INFLUêNCIA DO AMBIENTE DE MATURAçãO NAS CARACTERíSTICAS FíSICO-QUíMICAS E MICROBIOLóGICAS DE QUEIJO MINAS ARTESANAL DO SERRO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ(PIBIC-CNPQ)','01 DE JANEIRO DE 2016 A 31 DE JULHO DE 2017'),
(307,'DETERMINAÇÃO DA VARIALBILIDADE ESPACIAL DOS ATRIBUTOS DO SOLO DA ÁREA EXPERIMENTAL DO SETOR DE AGROECOLOGIA - CAMPUS RIO POMBA (IFSUDESTEMG)','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI-IF SUDESTE MG)','01 DE AGOSTO DE 2011 A 31 DE JULHO DE 2012'),
(308,'COMPARAÇÃO DE DIFERENTES MÉTODOS INTERPOLADORES ESPACIAIS PARA ESTUDO DE ATRIBUTOS DO SOLO DA ÁREA EXPERIMENTAL DO SETOR DE AGROECOLOGIA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG(PIBICTI - IF SUDESTE MG)','01 DE AGOSTO DE 2012 A 31 DE JULHO DE 2013'),
(309,'SISTEMA DE GERÊNCIA DE TRABALHOS CIENTÍFICOS VIA WEB ANO 4','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2017 A 31 DE JULHO DE 2018'),
(310,'AVALIAÇÃO DAS METODOLOGIAS DE CÁLCULO DE CUSTO DE PRODUÇÃO UTILIZADAS EM SOFTWARES PARA GERENCIAMENTO DA PECUÁRIA BOVINA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI - IF SUDESTE MG)','01 DE AGOSTO DE 2011 A 31 DE JULHO DE 2012'),
(311,'USO DE COPRODUTO DE ORIGEM ANIMAL NA ALIMENTAÇÃO DE SUÍNOS: DESEMPENHO E CARACTERÍSTICAS DE CARCAÇA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(312,'ELABORAÇÃO E CARACTERIZAÇÃO DE FARINHA DE BAGAÇO DE MALTE E UTILIZAÇÃO NA PRODUÇÃO DE MASSAS ALIMENTÍCIAS E PRODUTOS DE PANIFICAÇÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(313,'DESEMPENHO ZOOTÉCNICO, RENDIMENTO DE CARCAÇA E PARÂMETROS SANGUÍNEOS DE FRANGOS DE CORTE ALIMENTADOS COM RAÇÕES ADICIONADAS DE PRODUTOS HOMEOPÁTICOS ADMINISTRADOS SOB DIFERENTES VEÍCULOS.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)',''),
(314,'SILAGEM DE CAPIM-ELEFANTE (PENNISETUM PURPUREUM SCHUM.) COM INCLUSÃO DIFERENTES NÍVEIS DE FUBÁ DE MILHO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(315,'EFEITO DA ESCOLHA E DA VARIAÇÃO DE EXERCÍCIOS MULTI-ARTICULARES SOBRE OS GANHOS DE FORÇA MUSCULAR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)&#13;&#10;&#13;&#10;','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(316,'ESTUDO SOBRE O COMPORTAMENTO DOS PREÇOS DE HORTIFRUTIGRANJEIROS COMERCIALIZADOS NA CIDADE DE RIO POMBA/MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE FEVEREIRO DE 2019 A 31 DE JULHO DE 2019'),
(317,'AVALIAÇÃO DO POTENCIAL PROTEOLÍTICO NAS CASEÍNAS CAUSADO PELA PROTEASE APRX DE PSEUDOMONAS FLUORESCENS 041','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(318,'ESTABILIDADE AERÓBICA DA SILAGEM DE MILHO REENSILADA NA REGIÃO SEMIÁRIDA DE MINAS GERAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(319,'PRESERVAÇÃO DA QUALIDADE INTERNA DE OVOS DE GALINHAS REVESTIDOS SUPERFICIALMENTE COM DIFERENTES SUBSTÂNCIAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(320,'CONFIABILIDADE DA AVALIAÇÃO DE CONTEÚDOS TÉCNICOS DA BRAÇADA DO NADO CRAWL POR PROFESSORES DE NATAÇÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(321,'EFEITO DE PREBIÓTICOS NO CRESCIMENTO DE BACTÉRIAS LÁTICAS PRESENTES NO KEFIR','PROGRAMA INSTITUCIONAL VOLUNTáRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(322,'AVALIAÇÃO DO RENDIMENTO, TEOR DE PROTEÍNA BRUTA, CARACTERÍSTICAS MORFOGÊNICAS E INTENSIDADES DE DESFOLHAS DA FORRAGEIRA BRACHIARIA BRIZANTHA CV. XARAÉS SUBMETIDA A FERTIRRIGAÇÃO COM DIFERENTES DOSES DE ÁGUA RESIDUÁRIA DE SUÍNOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(323,'PREDIÇÃO DO PESO CORPORAL ATRAVÉS DE FITA PARA ANIMAIS DA RAÇA GIR LEITEIRO E GUZERÁ LEITEIRO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(324,'COMPLEXO ENZIMÁTICO EM DIETAS COM DIFERENTES GRANULOMETRIAS DE MILHO PARA LEITÕES NA FASE DE CRECHE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(325,'ANÁLISE DA PERFORMANCE NO SAQUE, RECEPÇÃO E ATAQUE POR MEIO DE SCOUT TÉCNICO EM JOGOS DE VOLEIBOL ESCOLAR E AMADOR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(326,'DESAFIOS E POSSIBILIDADES DE ENSINO DE ESTATÍSTICA PARA DEFICIENTES VISUAIS: CONSTRUINDO CAMINHOS E MATERIAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(327,'AVALIAÇÃO SOBRE OS IMPACTOS DE UMA METODOLOGIA DE APRENDIZAGEM ATIVA EM DISCIPLINA DE FÍSICA INTRODUTÓRIA EM CURSOS DE GRADUAÇÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(328,'EFETIVIDADE DA FIXAÇÃO BIOLÓGICA DE NITROGÊNIO EM CULTIVARES DE FEIJOEIRO COMUM, EM RESPOSTA À UTILIZAÇÃO DE DIFERENTES ESTIRPES DE RHIZOBIUM SP.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(329,'SILAGEM DE GRÃO DE MILHO TRITURADO E REIDRATADO COM ÁGUA, UTILIZANDO OU NÃO INOCULANTE E/OU MELAÇO DE CANA EM PÓ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)',''),
(330,'DIAGNÓSTICO DA PRODUÇÃO AGROALIMENTAR DO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS - CAMPUS RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(331,'EFEITO DA SOMATOTROPINA BOVINA NA RESPOSTA PRODUTIVA E ECONÔMICA DE VACAS LEITEIRAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(332,'ELABORAÇÃO E CARACTERIZAÇÃO DE QUEIJO MINAS FRESCAL PROBIÓTICO COM TEOR REDUZIDO DE SÓDIO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE MARÇO DE 2019 A 31 DE JULHO DE 2019'),
(333,'DESENVOLVIMENTO DE SMOOTHIS A BASE DE FRUTAS E HORTALIÇAS E AVALIAÇÃO DO SEU EFEITO NA RECUPERAÇÃO DO DANO MUSCULAR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019&#13;&#10;'),
(334,'UMA PROPOSTA DE SOFTWARE PARA ANÁLISE DE IMAGENS DE ELETROFORESE EM GEL DE POLIACRILAMIDA PARA A REDUÇÃO DA CONTAMINAÇÃO DO LEITE CRU COM BACTÉRIAS PSICRÓTRÓFICAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)',''),
(335,'CURRÍCULO INTEGRADO: UM ESTADO DA ARTE DAS EXPERIÊNCIAS ENVOLVENDO MATEMÁTICA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(336,'DESENVOLVIMENTO E APLICAÇÃO DE SOFTWARE PARA AUXÍLIO NA GESTÃO DE PROCESSOS PRODUTIVOS DO INSTITUTO FEDERAL DO SUDESTE DE MINAS GERAIS – CAMPUS RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARçO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(337,'AVALIAÇÃO DA EFICIÊNCIA DA FOSSA SÉPTICA BIODIGESTORA E DO TANQUE DE EVAPOTRANSPIRAÇÃO NA ZONA RURAL DE RIO POMBA - MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(338,'AVALIAÇÃO DA PRODUÇÃO, DINÂMICA DE PERFILHAMENTO E DO TEOR DE PROTEÍNA BRUTA EM PASTAGEM DE PANICUM MAXIMUM BRS ZURI SOB DIFERENTES DOSES DE NITROGÊNIO E COMBINAÇÕES DE NITROGÊNIO E POTÁSSIO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(339,'DIFERENTES SUBSTRATOS ALTERNATIVOS NA AVALIAÇÃO FENOLÓGICA DE MUDAS DE COFFEA ARABICA.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE OUTUBRO DE 2018 A 31 DE JULHO DE 2019'),
(340,'DESENVOLVIMENTO DE HAMBÚRGUER “VEGANO” COM ADIÇÃO DE MIX DE CONDIMENTOS.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)',''),
(341,'AVALIAÇÃO DA EFICIÊNCIA DA FOSSA SÉPTICA BIODIGESTORA E DO TANQUE DE EVAPOTRANSPIRAÇÃO NA ZONA RURAL DE RIO POMBA – MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(342,'DESENVOLVIMENTO DE BEBIDA PROBIÓTICA A BASE DE ISOLADO PROTEICO DE SORO, BANANA, E JUÇARRA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(343,'DIVERSIDADE DE ABELHAS VISITANTES DE DIFERENTES ESPÉCIES DE ADUBO VERDE.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(344,'DIFERENTES SUBSTRATOS ALTERNATIVOS NA AVALIAÇÃO FENOLÓGICA DE MUDAS DE COFFEA ARÁBICA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE OUTUBRO DE 2018 A 31 DE JULHO DE 2019'),
(345,'OBTENÇÃO DA BIOMASSA DE BANANA VERDE PARA INCORPORAÇÃO EM GELADOS COMESTÍVEIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(346,'EFEITOS FISIOLÓGICOS DA CRIOTERAPIA DE CORPO INTEIRO REALIZADA ANTES E APÓS UMA PARTIDA DE FUTEBOL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(347,'VIABILIDADE DE BACTÉRIAS PROBIÓTICAS EM BALAS DE PECTINA E GELATINA SABOR JUÇARA E MARACUJÁ.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(348,'ADIÇÃO DE FARINHA DE BAGAÇO DE MALTE E L. CASEI EM IOGURTE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(349,'AVALIAÇÃO DA PRODUÇÃO DINÂMICA DE PERFILHAMENTO E DO TEOR DE PROTEÍNA BRUTA EM PASTAGEM DE PANICUM MAXIMUM BRS ZURI SOB DIFERENTES DOSES DE NITROGENIO E COMBINAÇÕES DE NITROGÊNIO E POTÁSSIO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(350,'DIFERENÇA NA COMPETÊNCIA MOTORA AQUÁTICA ENTRE CRIANÇAS QUE APRENDEM A ADAPTAÇÃO AO MEIO AQUÁTICO POR MEIO DE DOIS DIFERENTES MÉTODOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)',''),
(351,'AVALIAÇÃO DA TÉCNICA DE CORANTE P NA QUANTIFICAÇÃO DE METABISSULFITO EM NÉCTARES E SUCO CONCENTRADO DE CAJU E UVA, COMERCIALIZADOS NO MUNICÍPIO DE RIO POMBA- MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)',''),
(352,'ADUBOS VERDES EM ÁREA DE RECUPERAÇÃO AMBIENTAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(353,'EFEITOS DE UM PROGRAMA DE TREINAMENTO FUNCIONAL SOBRE PARÂMETROS ANTROPOMÉTRICOS E VALÊNCIAS FÍSICAS EM ESCOLARES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(354,'DESEMPENHO DE ALEVINOS DE CARPA CAPIM (CTENOPHARYNGODON IDELLA) ALIMENTADOS COM A FORRAGEIRA ZURI E SUPLEMENTADOS COM RAÇÃO COMERCIAL','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(355,'AVALIAÇÃO DA QUALIDADE MICROBIOLÓGICA DO LEITE CRU E DO LEITE UHT E ISOLAMENTO E IDENTIFICAÇÃO DE BACTÉRIAS ESPORULADAS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(356,'CÓDIGOS CORRETORES DE ERROS ABELIANOS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(357,'UTILIZAÇÃO DE MICRORGANISMOS AUTÓCTONES NA PRODUÇÃO DE VEGETAIS EM CONSERVA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)',''),
(358,'ELABORAÇÃO E CARACTERIZAÇÃO DE QUEIJO MINAS FRESCAL COM TEOR REDUZIDO DE SÓDIO.','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)',''),
(359,'DIFERENÇA NA COMPETÊNCIA MOTORA AQUÁTICA ENTRE CRIANÇAS QUE APRENDEM A ADAPTAÇÃO AO MEIO AQUÁTICO POR MEIO DE DOIS DIFERENTES MÉTODOS.','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(360,'DESEMPENHO ZOOTÉCNICO, RENDIMENTO DE CARCAÇA E PARÂMETROS SANGUÍNEOS DE FRANGOS DE CORTE ALIMENTADOS COM RAÇÕES ADICIONADAS DE PRODUTOS HOMEOPÁTICOS ADMINISTRADOS SOB DIFERENTES VEÍCULOS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)',''),
(361,'EDUCAÇÃO ESTATÍSTICA: UMA INVESTIGAÇÃO SOBRE O PROCESSO DE ENSINO APRENDIZAGEM DA ESTATÍSTICA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(362,'ANÁLISE DE CORRESPONDÊNCIA: UMA AVALIAÇÃO SOBRE AS CAUSAS DE EVASÃO DO CURSO DE MATEMÁTICA.','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)',''),
(363,'UTILIZAÇÃO DA REALIDADE VIRTUAL COMO RECURSO DE APRENDIZAGEM NA NATAÇÃO.','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARçO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(364,'EFEITOS DE UM PROGRAMA DE TREINAMENTO FUNCIONAL SOBRE A APTIDÃO FÍSICA DE ADOLESCENTES','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(365,'PETTIT SUISSE PROBIÓTICO SABOR BANANA ADOÇADO COM MEL','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(366,'IRRIGAÇÃO AUTOMATIZADA APLICADA EM FORRAGEIRAS ','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARçO DE 2018 A 28 DE FEVEREIRO DE 2019'),
(367,'UM ESTUDO INTRODUTÓRIO A TEORIA DOS JOGOS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI-IF SUDESTE MG)','01 DE OUTUBRO DE 2018 A 31 DE JULHO DE 2019'),
(368,'ANÁLISE DE CORRESPONDÊNCIA: UMA AVALIAÇÃO SOBRE AS CAUSAS DE EVASÃO DO CURSO DE MATEMÁTICA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO (PIVICTI – IF SUDESTE MG)','01 DE AGOSTO DE 2018 A 31 DE JULHO DE 2019'),
(369,'AVALIAÇÃO DA QUALIDADE DO LEITE CRU DE TANQUES DE EXPANSÃO DA CIDADE DE RIO POMBA, MINAS GERAIS','PROGRAMA INSTITUCIONAL VOLUNTáRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2019 A 31 DE JULHO DE 2019'),
(372,'IOGURTE GREGO ADICIONADO DE FIBRAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(377,'DESENVOLVIMENTO DE SALADAS DE FRUTAS MINIMAMENTE PROCESSADAS ENRIQUECIDAS COM BACTÃ©RIAS PROBIÃ³TICAS','',''),
(381,'SORO DE LEITE EM DIETAS DE VACAS LEITEIRAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE AGOSTO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(382,'EFEITO DO TREINAMENTO PLIOMÃ©TRICO DE MEMBROS INFERIORES E SUPERIORES SOBRE PARÃ¢METROS ANTROPOMÃ©TRICOS E NEUROMUSCULARES ANAERÃ³BICOS EM ATLETAS ADOLESCENTES DE VOLEIBOL ESCOLAR.','',''),
(385,'UTILIZAÃ§Ã£O DE FARINHA DE BAGAÃ§O DE MALTE NA ELABORAÃ§Ã£O DE QUEIJO PETIT SUISSE','',''),
(387,'INCLUSÃO ESCOLAR: UM ESTADO DA ARTE DAS EXPERIENCIAS ENVOLVENDO A EDUCAÇÃO PROFISSIONAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(388,'PERCEPÃ§Ã£O DO ESTUDANTES ACERCA DOS CURSOS DE BACHARELADO EM ADMINSTRAÃ§Ã£O OFERTADOS PELA REDE FEDERAL DE EDUCAÃ§Ã£O, CIENCIA E TECNOLOGIA','',''),
(389,'EFEITOS DE DIFERENTES INTENSIDADES DO FIFA 11+ NO DESEMPENHO DE JOGADORES DE FUTEBOL SUB 20','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE ABRIL DE 2020 A 31 DE JULHO DE 2020'),
(469,'EFEITOS FISIOLÓGICOS CAUSADOS PELO USO DE MÁSCARAS FACIAIS CUSTOMIZADAS NA CORRIDA DE 5 KM E NA CORRIDA INTERVALADA DE ALTA INTENSIDADE ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(394,'MONITORAMENTO INTELIGENTE DE PRAGAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)&#13;&#10;','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020&#13;&#10;'),
(466,'ELABORAÇÃO DE MATERIAL DIDÁTICO DE AULAS PRÁTICAS DE QUÍMICA INOVADORAS, REALIZADAS COM MATERIAIS ALTERNATIVOS E DE BAIXO CUSTO, PARA UTILIZAÇÃO NAS TURMAS DE 1º ANO DOS CURSOS TÉCNICOS INTEGRADOS DO IF – SUDESTEMG – CAMPUS RP','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) JÚNIOR DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI – JR. – IF SUDESTE MG)','01 DE MAIO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(399,'EFEITOS DO ALONGAMENTO DINâMICO REALIZADO ANTES DO EXERCíCIO DE FORçA NAS ADAPTAçõES MUSCULARES APóS 8 SEMANAS DE TREINAMENTO DE FORçA EM HOMENS JOVENS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(520,'BUSCA DOS FATORES ASSOCIADOS À EVASÃO: UM ESTUDO DE CASO NOS CURSOS DO DEPARTAMENTO ACADÊMICO DE CIÊNCIAS GERENCIAIS, CAMPUS DO IF SUDESTE MG EM RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(467,'','',''),
(409,'INFLUÃªNCIA DO MÃ©TODO DE SECAGEM ARTIFICIAL NA OBTENÃ§Ã£O DE FARINHA DE CASCA DE BANANA','',''),
(468,'IMUNOCASTRAÇÃO EM FÊMEAS SUÍNAS PESADAS E SEUS EFEITOS SOBRE A QUALIDADE DA CARNE ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(470,'POTENCIAL DOS DIFERENTES MECANISMOS DE CERTIFICAÇÃO ORGÂNICA DO ESTADO DE MINAS GERAIS PARA VENDA DE ALIMENTOS PARA O PNAE EM ATENDIMENTO A LEI N° 11.947/2009 ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(421,'EXTRAÇÃO DO ÓLEO DAS SEMENTES DO LIMÃO GALEGO E SICILIANO PARA ESTUDO DO POTENCIAL ANTIMICROBIANO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(422,'CARACTERÍSTICAS FÍSICO-QUÍMICAS E MICROBIOLÓGICAS DE QUEIJO MINAS ARTESANAL DO CAMPO DAS VERTENTES DURANTE A MATURAÇÃO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020&#13;&#10;'),
(423,'REALIDADE VIRTUAL NO AUXÍLIO DO TRATAMENTO DE FOBIAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(424,'PRODUTIVIDADE E DINÂMICA DE PERFILHAMENTO EM PANICUM VR. MASSAI SUBMETIDO A IRRIGAÇÃO AUTOMATIZADA ATRAVÉS DA PLATAFORMA ARDUINO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(425,'METABOLIZABILIDADE DE NUTRIENTES EM DIETAS COM DIFERENTES GRANULOMETRIAS DE MILHO SUPLEMENTADAS COM COMPLEXO ENZIMÁTICO PARA SUÍNOS EM CRESCIMENTO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020&#13;&#10;'),
(426,'AVALIAÇÃO BIOQUÍMICA DE PROTEASES TERMORESISTENTES DE PSEUDOMONAS FLUORESCENS NA PROTEÓLISE DE CASEÍNAS DO LEITE BOVINO CRU','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2019 A 29 DE FEVEREIRO DE 2020.'),
(427,'PERCEPÇÃO DO ESTUDANTES ACERCA DOS CURSOS DE BACHARELADO EM ADMINSTRAÇÃO OFERTADOS PELA REDE FEDERAL DE EDUCAÇÃO, CIENCIA E TECNOLOGIA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)',''),
(428,'DESENVOLVIMENTO DE SALADAS DE FRUTAS MINIMAMENTE PROCESSADAS ENRIQUECIDAS COM BACTÉRIAS PROBIÓTICAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(429,'ADEQUAÇÃO DO TESTE DE TETRAZÓLIO PARA DETERMINAÇÃO DA QUALIDADE FISIOLÓGICA EM SEMENTES DE CRATYLIA ARGENTEA (DESV.) KUNTZE (FABACEAE – PAPILIONOIDEA)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(430,'EFEITO NA QUALIDADE E ESTABILIDADE AERÓBICA DA SILAGEM DE CAPIM ELEFANTE BRS CAPIAÇU INOCULADOS COM DIFERENTES INOCULANTES','PROGRAMA INSTITUCIONAL VOLUNTáRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(431,'ELABORAÇÃO DO ÍNDICE DE DESENVOLVIMENTO FAMILIAR (IDF) NA CIDADE DE JUIZ DE FORA ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(432,'AVALIAÇÃO DA ATIVIDADE BIOLÓGICA DE EXTRATO DE NICOTIANA TABACUM (FUMO) NA POSTURA E ECLOSÃO DE OVOS DE RHIPICEPHALUS (BOOPHILUS) MICROPLUS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(433,'EFEITO DO TREINAMENTO PLIOMÉTRICO DE MEMBROS INFERIORES E SUPERIORES SOBRE PARÂMETROS ANTROPOMÉTRICOS E NEUROMUSCULARES ANAERÓBICOS EM ATLETAS ADOLESCENTES DE VOLEIBOL ESCOLAR.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2019 A 29 DE FEVEREIRO DE 2020&#13;&#10;'),
(434,'AVALIAÇÃO DAS DEMANDAS DAS ACADEMIAS DE MUSCULAÇÃO DO MUNICÍPIO DE RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(435,'AVALIAÇÃO DA INTEGRIDADE DAS CASEÍNAS DO LEITE CRU GRANELIZADO DO MUNICÍPIO DE RIO POMBA, MINAS GERAIS, E DA QUALIDADE MICROBIOLÓGICA DESSE ALIMENTO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2019 A 29 DE FEVEREIRO DE 2020&#13;&#10;'),
(436,'UTILIZAÇÃO DE FARINHA DE BAGAÇO DE MALTE NA ELABORAÇÃO DE QUEIJO PETIT SUISSE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)',''),
(437,'DETERMINAÇÃO DOS NÍVEIS DE (IN)SEGURANÇA ALIMENTAR DOS ESTUDANTES MATRICULADOS NO ENSINO FUNDAMENTAL E MÉDIO DO MUNICÍPIO DE RIO POMBA/MG E SUAS INTERAÇÕES COM O PROGRAMA NACIONAL DE ALIMENTAÇÃO ESCOLAR (PNAE)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(438,'INCLUSÃO ESCOLAR: UM ESTADO DA ARTE DAS EXPERIENCIAS ENVOLVENDO A EDUCAÇÃO PROFISSIONAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 de março de 2019 a 29 de fevereiro de 2020'),
(439,'INTRODUÇÃO A CADEIA DE MARKOV','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020&#13;&#10;'),
(440,'DESENVOLVIMENTO DE UM SISTEMA PARA CLASSIFICAÇÃO DE RETINOPATIA DIABÉTICA UTILIZANDO APRENDIZADO PROFUNDO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(441,'DESENVOLVIMENTO DE SMOOTHIES A BASE DE FRUTAS E HORTALIÇAS E AVALIAÇÃO DO SEU EFEITO NA RECUPERAÇÃO DO DANO MUSCULAR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020&#13;&#10;'),
(442,'DESENVOLVIMENTO DE UMA FERRAMENTA DE BAIXO CUSTO PARA PREDIÇÃO DE ESCORE CORPORAL DE FÊMEAS SUÍNAS GESTANTES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(443,'DISPOSITIVO ELETRÔNICO COM SENSOR DE PERCEPÇÃO PARA AVALIAÇÃO DE TEMPO DE DESLOCAMENTO EM DESEMPENHO FÍSICO E ESPORTIVO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020&#13;&#10;'),
(444,'USO DE DETERGENTE NEUTRO COMO UMA ALTERNATIVA APLICÁVEL E DE BAIXO CUSTO NA DETECÇÃO E PREVENÇÃO DA MASTITE  UBCLÍNICA EM REBANHOS BOVINOS DA MICRORREGIÃO DE RIO POMBA – MG','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE ABRIL DE 2019 A 29 DE FEVEREIRO DE 2020'),
(445,'CONSTRUINDO PONTES PARA A EFETIVAÇÃO DO CURRÍCULO INTEGRADO ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARçO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(446,'DESENVOLVIMENTO DE EQUIPAMENTO ELETRÔNICO E SOFTWARE DE BAIXO CUSTO PARA AVALIAÇÃO DE VELOCIDADE E AGILIDADE EM DESEMPENHO FÍSICO E ESPORTIVO ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARçO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(447,'ELABORAÇÃO DE MATERIAL DIDÁTICO DE AULAS PRÁTICAS DE QUÍMICA INOVADORAS, REALIZADAS COM MATERIAIS ALTERNATIVOS E DE BAIXO CUSTO, PARA UTILIZAÇÃO NAS TURMAS DE 1º ANO DOS CURSOS TÉCNICOS INTEGRADOS DO IF – SUDESTEMG – CAMPUS RP.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE ABRIL DE 2019 A 29 DE FEVEREIRO DE 2020&#13;&#10;'),
(448,'COMPOSIÇÃO BROMATOLÓGICA DO PANICUM MAXIMUM CV. BRS ZURI SUBMETIDO A DIFERENTES DOSES DE NITROGÊNIO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG – (PIBICTI – IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(449,'ACEITAÇÃO SENSORIAL E CARACTERIZAÇÃO FÍSICO-QUÍMICA DE CAFÉS TORRADOS E MOÍDOS COMERCIAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020&#13;&#10;'),
(450,'FARINHA DE ALBEDO DE LARANJA EM IOGURTE LÍQUIDO PROBIÓTICO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020&#13;&#10;'),
(451,'DESENVOLVIMENTO DE UMA FERRAMENTA DA BAIXO CUSTO PARA PREDIÇÃO DE ESCORE CORPORAL DE FÊMEAS SUÍNAS GESTANTES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(452,'SUBSTITUIÇÃO TOTAL DA FARINHA DE TRIGO POR FARINHA MISTA DE AMARANTO E QUINOA EM PRODUTOS DE PANIFICAÇÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MARçO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(453,'BIOMASSA E CARBONO EM FRAGMENTO DA MATA ATLÂNTICA NO SUDESTE DE MINAS GERAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MARçO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(455,'CARACTERIZAÇÃO DE BISCOITO TIPO COOKIE COM SUBSTITUIÇÃO TOTAL E PARCIAL DA FARINHA DE TRIGO POR BLEND DE QUINOA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(456,'TRANSFERÊNCIA DE IMUNIDADE PASSIVA E DESEMPENHO DE BEZERROS DA RAÇA CANCHIM','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(457,'EFEITO DE PLANTAS DE COBERTURA DO SOLO SOBRE A VEGETAÇÃO ESPONTÂNEA E CULTURA DO FEIJOEIRO COMUM (PHASEOLUS VULGARIS L.), EM SUCESSÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI–IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(458,'USO DE LEVEDURAS VIVAS EM DIETAS DE VACAS LEITEIRAS PODE INFLUENCIAR OS NÍVEIS DE CÉLULAS SOMÁTICAS DO LEITE?','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(459,'INFLUÊNCIA DO MÉTODO DE SECAGEM ARTIFICIAL NA OBTENÇÃO DE FARINHA DE CASCA DE BANANA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)',''),
(460,'GERAÇÃO DE MÚSICA EM TEMPO REAL PARA JOGOS UTILIZANDO DEEP LEARNING','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(461,'AVALIAÇÃO DO TRATAMENTO E PRODUÇÃO DE BIOGÁS PROVENIENTE DE RESÍDUOS DE ORIGEM ANIMAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020'),
(462,'DESENVOLVIMENTO E CARACTERIZAÇÃO SENSORIAL DE BEBIDA NÃO ALCOÓLICA DESTILADA MISTA DE ABACAXI, GENGIBRE E HORTELÃ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE AGOSTO DE 2019 A 31 DE JULHO DE 2020&#13;&#10;'),
(463,'IDENTIFICAÇÃO DE FUNGOS FITOPATOGÊNICOS PRODUTORES DE ENZIMAS PARA HIDRÓLISE DE MATERIAIS HEMICELULÓSICOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MAIO DE 2019 A 29 DE FEVEREIRO DE 2020'),
(464,'UM ESTUDO COMPARATIVO ENTRE OS MÉTODOS DE OTIMIZAÇÃO DIFERENCIÁVEL E IRRESTRITO','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2019 A 31 DE AGOSTO DE 2020'),
(471,'ESTUDO DA VIABILIDADE DA PRODUÇÃO DE HIDROMEL UTILIZANDO KEFIR DE ÁGUA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE ABRIL DE 2020 A 28 DE FEVEREIRO DE 2021'),
(472,'SISTEMA DE ANÁLISE DE MALWARE INTELIGENTE USANDO CIÊNCIA DOS DADOS COM SUPORTE DE MACHINE LEARNING','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)',''),
(473,'UTILIZAÇÃO DO BIOFERTILIZANTE &#34;URINA DE VACA&#34; NA PRODUÇÃO DE HORTALIÇAS FOLHOSAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(474,'ELABORAÇÃO E CARACTERIZAÇÃO DE HAMBÚRGUER ADICIONADO DE FARINHA DE BAGAÇO DE MALTE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)',''),
(475,'PRODUÇÃO DE MATÉRIA SECA, VALOR NUTRICIONAL E COMPOSIÇÃO MORFOLÓGICA DA CULTIVAR BRS CAPIAÇU SUBMETIDA A DIFERENTES ESTRATÉGIAS DE MANEJO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(476,'INVESTIGAÇÃO ACERCA DA RELAÇÃO ENTRE GÊNERO E PROPRIEDADE DA TERRA NO MUNICÍPIO DE RIO POMBA – MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(477,'AVALIAÇÃO DA EFICIÊNCIA DE SANIFICANTES COMERCIALIZADOS CLANDESTINAMENTE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(478,'DESENVOLVIMENTO DE UM EQUIPAMENTO DE BAIXO CUSTO PARA AQUISIÇÃO DE VALORES DE INTERCEPTAÇÃO LUMINOSA ATRAVÉS DA PLATAFORMA ARDUINO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(479,'AVALIANDO A APLICAÇÃO DAS ATIVIDADES LÚDICAS NO ENSINO DA MATEMÁTICA ESCOLAR.','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(480,'PACOTE SHINY: APLICAÇÕES PARA O ENSINO DE ESTATÍSTICA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(481,'DIFERENTES SUPLEMENTOS PARA VACAS LEITEIRAS SOB PASTEJO DURANTE O PERÍODO DAS ÁGUAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(482,'AVALIAÇÃO MORFOGÊNICA DO PANICUM MAXIMUM X PANICUM INFESTUM VR. MASSAI SUBMETIDO A IRRIGAÇÃO AUTOMATIZADA COM A PLATAFORMA ARDUINO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(483,'VADE MECUM DA LEGISLAÇÃO MINERAL LUSO-BRASILEIRA: SÉCULOS XVI-XXI','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(484,'AVALIAÇÃO DO GRAU DE PROTEÓLISE DA CASEÍNA CAUSADO POR PROTEASES TERMORRESISTENTES DE PSEUDOMONAS FLUORESCENS EM QUEIJO MINAS FRESCAL PRODUZIDO A PARTIR DE LEITE CRU E PASTEURIZADO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(486,'ASSOCIAÇÃO DO TEMPO DE RECUPERAÇÃO DA TEMPERATURA DA PELE COM A RECUPERAÇÃO DO DESEMPENHO MUSCULAR','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)',''),
(487,'DESENVOLVIMENTO RURAL NO ESTADO DE MINAS GERAIS: PRINCIPAIS FATORES E CATEGORIZAÇÃO DOS MUNICÍPIOS ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)',''),
(488,'ESTUDO DO MOVIMENTO DE CAMINHADA HUMANO ','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(489,'DESENVOLVIMENTO DE FITA PARA PREDIÇÃO DO PESO CORPORAL DE MATRIZES SUÍNAS DE ALTO POTENCIAL GENÉTICO ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(490,'DESENVOLVIMENTO DO MÓDULO “POWER BALL” COM SENSOR DE ACELERAÇÃO DE BAIXO CUSTO PARA AVALIAR A VELOCIDADE E POTÊNCIA DE IMPACTO NA PERFORMANCE HUMANA ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(491,'NOVO MÓDULO DO EQUIPAMENTO SPEED COM SENSOR SONORO QUE AVALIE A VELOCIDADE DE DESLOCAMENTO EM PERFORMANCES FÍSICAS E ESPORTIVAS ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(492,'CLASSIFICAÇÃO DA RETINOPATIA DIABÉTICA ORIENTADA ÀS ALTERAÇÕES DAS ESTRUTURAS VASCULARES DA RETINA ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)',''),
(493,'MUDANÇAS ANTROPOMÉTRICAS EM ATLETAS DE HANDEBOL MASCULINO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA JÚNIOR / FAPEMIG – (PROBIC – JR. – FAPEMIG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(494,'USO DE CALDAS FITOPROTETORAS NO CONTROLE DE ALTERNARIA PORRI L. IN VITRO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE ABRIL DE 2020 A 28 DE FEVEREIRO DE 2021'),
(495,'INFLUÊNCIA DO USO DE DIFERENTES TIPOS DE ENRIQUECIMENTO SOBRE O DESEMPENHO ZOOTÉCNICO E COMPORTAMENTO DE COELHOS ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(496,'PERCEPÇÃO DE CIÊNCIA E TRAJETÓRIA ACADÊMICA DE ESTUDANTES DE GRADUAÇÃO DO IF SUDESTE – MG: UM ESTUDO MULTICAMPI','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)',''),
(497,'ESTOQUE DE CARBONO NA NECROMASSA E FITOSSOCIOLOGIA EM FRAGMENTO DE MATA ATLÂNTICA NO SUDESTE DE MINAS GERAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)',''),
(498,'DESENVOLVIMENTO E AVALIAÇÃO FÍSICO-QUÍMICA DE MASSA DE PIZZA SEM GLÚTEN.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(499,'INFLUÊNCIA DE JOGOS CONSECUTIVOS DE FUTSAL NO DESEMPENHO FÍSICO E NA TEMPERATURA TERMOGRÁFICA DOS MEMBROS INFERIORES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(500,'AVALIAÇÃO BROMATOLÓGICA DE DIFERENTE HÍBRIDOS DE MILHO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(501,'AVALIAÇÃO DAS CARACTERÍSTICAS AGRONÔMICAS DE DIFERENTES HÍBRIDOS DE MILHO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)',''),
(502,'ALTURA DE COLHEITA DE MILHO PARA SILAGEM: VALOR NUTRITIVO E EFEITO DA FITOMASSA RESIDUAL NO SOLO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE ABRIL DE 2021 A 31 DE AGOSTO DE 2021'),
(503,'COMPOSIÇÃO BROMATOLÓGICA DE SILAGEM DE CAPIM ELEFANTE (PENNISETUM PURPUREUM SCHUM) CULTIVAR BRS CAPIAÇU COM INOCULANTE E DIFERENTES NÍVEIS DE ADIÇÃO DE SORGO MOÍDO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(504,'QUALIDADE DO COLOSTRO E SUAS INFLUÊNCIAS NA TRANSFERÊNCIA DE IMUNIDADE PASSIVA EM BEZERROS MESTIÇOS HOLANDÊS - ZEBU','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(505,'CARACTERIZAÇÃO DOS ESTÁGIOS INICIAIS DA RETINOPATIA DIABÉTICA UTILIZANDO APRENDIZADO PROFUNDO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(506,'AVALIAÇÃO DA QUALIDADE DE SALMOURAS USADAS EM SALGA DE QUEIJOS DE LATICÍNIOS PRESENTES EM RIO POMBA E REGIÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(507,'O BOM PROFESSOR EBTT: UMA REPRESENTAÇÃO DOS DISCENTES DO IF SUDESTE MG – CAMPUS RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(508,'AVALIAÇÃO DAS CARACTERÍSTICAS FÍSICO- QUÍMICAS E DA PADRONIZAÇÃO DE DOCE DE LEITE PASTOSO PRODUZIDO POR UM LATICÍNIO DE RIO POMBA – MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)',''),
(509,'IMPACTOS DA JUDICIALIZAÇÃO DA POLÍTICA PÚBLICA NA ÁREA DA SAÚDE SOBRE O ORÇAMENTO DE MUNICÍPIOS DE PEQUENO PORTE DA ZONA DA MATA MINEIRA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE JULHO DE 2021'),
(510,'EFEITOS FISIOLÓGICOS DO USO DE MÁSCARAS CUSTOMIZADAS DURANTE SESSÕES DE CURTA E DE LONGA DURAÇÃO NO CROSSFIT','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 30 DE ABRIL DE 2021'),
(511,'AVALIAÇÃO DA FERMENTAÇÃO E VALOR NUTRICIONAL DA SILAGEM DO CAPIM BRS CAPIAÇU ENSILADO COM DIFERENTES ALTURAS DE PLANTA E ALTURAS DE RESÍDUO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE MAIO DE 2021 A 31 DE AGOSTO DE 2021'),
(512,'DENSIDADE E ESPAÇAMENTO DE HIBRIDO PARA SILAGEM','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)',''),
(513,'DESENVOLVIMENTO DE DISPOSITIVO BASEADO EM SISTEMA DE VARREDURA A LASER PARA MONITORAMENTO DA ALTURA DE MANEJO DE ESPÉCIES FORRAGEIRAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE ABRIL DE 2021 A 31 DE AGOSTO DE 2021'),
(514,'AVALIAÇÃO DA RAMPA DE TEMPERATURA UTILIZADA NA MOSTURAÇÃO NAS CARACTERÍSTICAS FÍSICO-QUÍMICAS DE CERVEJA ARTESANAL ADICIONADA DE BATATA DOCE COMO ADJUNTO CERVEJEIRO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)',''),
(515,'MANEJO ALTERNATIVO DA CERCOSPORIOSE (CERCOSPORA BETICOLA SACC) DA BETERRABA (BETA VULGARIS L)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(516,'OTIMIZAÇÃO COM RESTRIÇÕES: ASPECTOS TEÓRICOS E ANÁLISE DE PROCEDIMENTOS COMPUTACIONAIS','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(517,'VALIDAÇÃO DE UM SISTEMA AUTOMATIZADO DE IRRIGAÇÃO BASEADO NA PLATAFORMA ARDUINO EM TERMOS DE QUALIDADE BROMATOLÓGICA DO PANICUM MAXIMUM X P. INFESTUM VR. MASSAI','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO /IF SUDESTE MG –(PIBICTI  – IF SUDESTE MG)','01 DE SETEMBRO DE 2020 A 31 DE AGOSTO DE 2021'),
(518,'NANOPARTÍCULAS DE PRATA COMO AGENTES ANTIMICROBIANOS NO LEITE','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE ABRIL DE 2021 A 30 DE SETEMBRO DE 2021'),
(519,'DESENVOLVIMENTO DE DISPENSADOR DE ÁLCOOL GEL SEM CONTATO EQUIPADO COM SENSOR IR','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE OUTUBRO DE 2020 A 31 DE MARÇO DE 2021'),
(523,'UTILIZAÇÃO DE PLANTAS MACRÓFITAS AQUÁTICAS NO TRATAMENTO TERCIÁRIO DE RESÍDUOS LÍQUIDOS DA INDÚSTRIA DE ALIMENTOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / PIBIC-CNPQ/PROBIC/FAPEMIG','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(524,'COMPORTAMENTO INGESTIVO DE BOVINOS DE CORTE A PASTO SUPLEMENTADOS COM DOIS NÍVEIS DE PROTEÍNA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(526,'ESTUDO COMPARATIVO ENTRE OS PREÇOS DE ALIMENTOS COMERCIALIZADOS PELA REDE MÃOS A HORTA ANTES E DURANTE O PERÍODO DE PANDEMIA COVID-19','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(527,'INFLUÊNCIA DE 8 SEMANAS DE TREINAMENTO NO DESEMPENHO FÍSICO E NO TESTE DE AGILIDADE EM ATLETAS DE FUTSAL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(528,'EFEITO DA TEMPERATURA E SUBSTRATOS NA GERMINAÇÃO DE SEMENTES DE CRATYLIA (CRATYLIA ARGENTEA)','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)',''),
(529,'PRODUTIVIDADE E CARACTERÍSTICAS DE PERFILHOS DA CULTIVAR BRS CAPIAÇU SUBMETIDA A DIFERENTES PROTOCOLOS DE MANEJO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(530,'DESEMPENHO ZOOTÉCNICO E QUALIDADE DE OVOS DE CODORNAS JAPONESAS ALIMENTADAS COM RAÇÕES SUPLEMENTADAS COM IMMUNOWALL®','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARçO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(531,'QUALIDADE DA ÁGUA PARA DESSEDENTAÇÃO DE BOVINOS LEITEIROS NO IFSUDESTEMG - CAMPUS RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG E PROBIC JR-FAPEMIG)','01 DE MARçO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(532,'ESTUDO DA QUALIDADE DO SOLO EM DIFERENTES CONDIÇÕES DE MANEJO NO IF SUDESTE MG CAMPUS RIO POMBA E VALIDAÇÃO DA CROMATOGRAFIA DE PFEIFFER','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(533,'ANÁLISE DOS IMPACTOS DA NOVA LEI DE LICENCIAMENTO AMBIENTAL DO ESTADO DE MINAS GERAIS (LEI Nº 21972/2016) SOBRE O SOLO URBANO NO MUNICÍPIO RIO POMBA- MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(534,'VALIDAÇÃO EM TEMOS DE PRODUTIVIDADE E MORFOLOGIA DE UM SISTEMA AUTOMATIZADO PARA O MANEJO DA IRRIGAÇÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(535,'PAGAMENTO POR SERVIÇOS AMBIENTAIS EM RIO POMBA/MG: APLICABILIDADE, POTENCIAIS E DESAFIOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(536,'POTENCIAL DOS DIFERENTES MECANISMOS DE CERTIFICAÇÃO ORGÂNICA DO ESTADO DE MINAS GERAIS PARA CAPTAR AGRICULTORES FAMILIARES PARA VENDA DE ALIMENTOS ORGÂNICOS PARA O PNAE: ELABORAÇÃO DE MAPAS TEMÁTICOS POR MESORREGIÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / CNPQ – (PIBIC – AF-CNPQ)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(537,'DESENVOLVIMENTO DE CÂMARA DESIDRATADORA DE VEGETAIS DE BAIXO CUSTO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ OU PIBIC-EM PARA ESTUDANTES DO ENSINO MÉDIO)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(538,'DESENVOLVIMENTO DE BISCOITO COM BAGAÇO DE MALTE E ADICIONADO DE CÚRCUMA LONGA L','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(539,'DESENVOLVIMENTO DOS MÓDULOS POWER BALL E DE DETECÇÃO DO TEMPO DE DESLOCAMENTO PARA O EQUIPAMENTO SPEED ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ – (PIBITI – CNPQ OU PIBIC-EM PARA ESTUDANTES DO ENSINO MÉDIO)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(540,'MOBILIDADE ESPACIAL ESTUDANTIL NA ÁREA DE POLARIZAÇÃO DO IF SUDESTE MG, RIO POMBA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(541,'ELABORAÇÃO DE CANUDO À BASE DE BAGAÇO DE MALTE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(542,'ADOÇÃO DO APLICATIVO GERCAL EM PROPRIEDADES LEITEIRAS PERTENCENTES AO PROGRAMA CURRAL BONITO DE RIO POMBA MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(543,'ANÁLISE DE CONCENTRADOS PROTÉICOS NA DIETA DE BOVINOS DE CORTE E SUA VIABILIDADE ECONÔMICA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(544,'ENTRE A LIBERDADE RELIGIOSA E OS COSTUMES CRISTÃOS: PESQUISA E INTERPRETAÇÃO ACERCA DA PRESENÇA DE SÍMBOLOS RELIGIOSOS NAS REPARTIÇÕES PÚBLICAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(545,'CLASSIFICAÇÃO DE SUPERNOVAS USANDO APRENDIZADO DE MÁQUINA ','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(546,'EFEITO DE 5 E 8 SEMANAS DE TREINAMENTO PLIOMÉTRICO DE MEMBROS SUPERIORES SOBRE PARÂMETROS ANTROPOMÉTRICOS E NO DESEMPENHO FÍSICO EM JOVENS-ADULTOS ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ – (PIBIC-CNPQ)','01 DE ABRIL DE 2022 A 31 DE AGOSTO DE 2022'),
(547,'DESENVOLVIMENTO DE BISCOITO COM BAGAÇO DE MALTE E ADICIONADO DE CÚRCUMA LONGA L. ','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO JÚNIOR (PIVICTI-JR – IF SUDESTE MG)','01 DE SETEMBRO DE 2021 A 31 DE AGOSTO DE 2022'),
(548,'CORRELAÇÕES ENTRE INDICADORES SOCIOECONÔMICOS E AMBIENTAIS E AS NOTIFICAÇÕES DE ARBOVIROSES NO BRASIL','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO JÚNIOR (PIVICTI-JR – IF SUDESTE MG)','01 DE ABRIL DE 2022 A 30 SETEMBRO DE 2022'),
(549,'PRODUÇÃO DE FARINHA DA CASCA DE BANANA MADURA NO MUNICÍPIO DE TRAJANO DE MORAES-RJ E SEU POTENCIAL PARA PRODUÇÃO DE PÃO DE MEL: ANÁLISES FÍSICO-QUÍMICAS, MICROBIOLÓGICAS E SENSORIAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / IF SUDESTE MG – (PIBIC-IF SUDESTE MG)','01 DE SETEMBRO DE 2022 A 01 DE MARÇO DE 2023'),
(550,'ANO II- VADE MECUM DA LEGISLAÇÃO MINERÁRIA LUSO-BRASILEIRA: SÉCULOS XVI-XXI','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE MARÇO DE 2021 A 28 DE FEVEREIRO DE 2022'),
(552,'AVALIAÇÃO DO HÁBITO DE CONSUMO DE BEBIDAS AÇUCARADAS NÃO ALCOÓLICAS ASSOCIADO À PARÂMETROS ANTROPOMÉTRICOS, ESTADO NUTRICIONAL E ATIVIDADE FÍSICA DE ESTUDANTES DO CAMPUS RIO POMBA.','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE MARÇO DE 2020 A 28 DE FEVEREIRO DE 2021'),
(553,'QUALIDADE FÍSICO-QUÍMICA DE OVOS DE GALINHA ORIUNDOS DE DIFERENTES SISTEMAS DE PRODUÇÃO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / IF SUDESTE MG – (PIBIC-IF SUDESTE MG)','01 DE JUNHO DE 2022 A 31 DE MAIO DE 2023'),
(554,'DESEMPENHO ZOOTÉCNICO, QUALIDADE DE OVOS E COMPORTAMENTO DE CODORNAS JAPONESAS ALOJADAS SOB DIFERENTES DENSIDADES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / IF SUDESTE MG – (PIBIC-IF SUDESTE MG)','01 DE JUNHO DE 2022 A 31 DE MAIO DE 2023'),
(555,'CLASSIFICAÇÃO DE DEPRESSÃO E ANSIEDADE EM TEXTOS USANDO APRENDIZADO PROFUNDO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / IF SUDESTE MG – (PIBITI – IF SUDESTE MG)','01 DE JUNHO DE 2022 A 31 DE MAIO DE 2023'),
(565,'DEFASAGEM DE APRENDIZAGEM MATEMÁTICA: UM ESTUDO NO CURSO TÉCNICO INTEGRADO EM ALIMENTOS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / IF SUDESTE MG  (PIBIC – AF-IF SUDESTE MG)','01 DE JUNHO DE 2022 A 31 DE MAIO DE 2023'),
(557,'ANÁLISE DOS IMPACTOS DA NOVA LEI DE LICENCIAMENTO AMBIENTAL DO ESTADO DE MINAS GERAIS(LEI Nº 21972/2016) SOBRE O SOLO URBANO NO MUNICÍPIO RIO POMBA- MG','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS / IF SUDESTE MG  (PIBIC – AF-IF SUDESTE MG)','01 DE JUNHO DE 2022 A 31 DE MAIO DE 2023'),
(558,'DESENVOLVIMENTO DE INOCULANTE PARA O FEIJOEIRO A BASE DE RIZÓBIOS SOLUBILIZADORES DE FOSFATO E PRODUTORES DE AIA: ISOLAMENTO E SELEÇÃO DE ESTIRPES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ (PIBITI - CNPQ)','01 DE OUTUBRO DE 2022 A 31 DE AGOSTO DE 2023'),
(559,'SUCESSÃO DE CULTURAS EM SISTEMA DE PLANTIO DIRETO E SEUS EFEITOS SOBRE COMPONENTES DE PRODUTIVIDADE E A VEGETAÇÃO ESPONTÂNEA','PROGRAMA INSTITUCIONAL VOLUNTÁRIO(A) DE INICIAÇÃO CIENTÍFICA, EM DESENVOLVIMENTO  TECNOLÓGICO E INOVAÇÃO (PIVICTI  – IF SUDESTE MG)','01 DE OUTUBRO DE 2022 A 31 DE AGOSTO DE 2023'),
(560,'FERRAMENTA DA QUALIDADE NO CONTEXTO DA INDUSTRIA 4.0','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / IF SUDESTE MG – (PIBIC-IF SUDESTE MG)','01 DE JUNHO DE 2022 A 31 DE MAIO DE 2023'),
(561,'AVALIAÇÃO DA TEMPERATURA DA PELE E SUA RELAÇÃO COM A RECUPERAÇÃO MUSCULAR AO LONGO DE UMA SEMANA DE TREINAMENTO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / IF SUDESTE MG – (PIBIC-IF SUDESTE MG)','01 DE OUTUBRO DE 2022 A 31 DE MAIO DE 2023'),
(562,'(CONTINUIDADE) IMPACTOS DA JUDICIALIZAÇÃO DA POLÍTICA PÚBLICA NA ÁREA DA SAÚDE SOBRE O ORÇAMENTO DE MUNICÍPIOS DE PEQUENO PORTE DA ZONA DA MATA MINEIRA','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / IF SUDESTE MG – (PIBIC-IF SUDESTE MG)','01 DE JUNHO DE 2022 A 31 DE MAIO DE 2023'),
(563,'EFEITO DE 10 SEMANAS DE TREINAMENTO DO TOQUE POR CIMA COM O AMORTECIMENTO DA BOLA NO VOLEIBOL SOBRE O DESEMPENHO QUALITATIVO E QUANTITATIVO EM INICIANTES DE AMBOS OS SEXOS.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE OUTUBRO DE 2022 A 30 DE SETEMBRO DE 2023'),
(564,'DESENVOLVIMENTO DE UM APLICATIVO MÓVEL PARA PRESCRIÇÃO, AVALIAÇÃO E CONTROLE DAS CARGAS INTERNA E EXTERNA DE PROGRAMA DE TREINAMENTO','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / CNPQ (PIBITI - CNPQ)','01 DE SETEMBRO DE 2022 A 31 DE AGOSTO DE 2023'),
(566,'MILHO PROBIOTADO PARA VACAS LEITEIRAS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA NAS AÇÕES AFIRMATIVAS/ CNPQ – (PIBIC AF-CNPQ)','01 DE SETEMBRO DE 2022 A 31 DE AGOSTO DE 2023'),
(567,'ELABORAÇÃO DE BARRA DE CEREAL ENRIQUECIDA COM FERRO E VITAMINA A PARA ALIMENTAÇÃO INFANTOJUVENIL ','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO NAS AÇÕES AFIRMATIVAS / IF SUDESTE MG – (PIBITI- AF – IF SUDESTE MG)','01 DE JUNHO DE 2022 A 31 DE MAIO DE 2023'),
(568,'PRODUÇÃO DE MUDAS DAS SOLANÁCEAS C. CHINENSE E L. ESCULENTUM TRATADAS COM EM PRODUZIDO A PARTIR DA COLETA DE MICRORGANISMOS ORIUNDOS DE DIFERENTES TIPOS DE USO DO SOLO.','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA PARA O ENSINO MÉDIO / CNPQ – (PIBIC-EM- CNPQ)','01 DE OUTUBRO DE 2022 A 31 DE AGOSTO DE 2023'),
(569,'O ENSINO DE FRAÇÕES POR MEIO DE JOGOS E TECNOLOGIAS: UM ESTUDO DE ESTADO DA ARTE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE SETEMBRO DE 2022 A 31 DE AGOSTO DE 2023'),
(570,'DIFERENTES ALTURAS DE CORTE DA PLANTA DE MILHO VISANDO A PRODUÇÃO DA SILAGEM TOPLAGE','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ - (PIBIC-CNPQ)','01 DE SETEMBRO DE 2022 A 31 DE AGOSTO DE 2023'),
(572,'EFEITOS DE DIFERENTES ATIVIDADES CONDICIONANTES NO DESEMPENHO TÁTICO E FÍSICO DE JOGADORES DE FUTEBOL','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / FAPEMIG – (PROBIC – FAPEMIG)','01 DE OUTUBRO DE 2022 A 30 DE SETEMBRO DE 2023'),
(573,'ANSIEDADE PRÉ-COMPETITIVA DE ATLETAS PARTICIPANTES NOS JOGOS DOS INSTITUTOS FEDERAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ - (PIBIC-CNPQ)','01 DE MARÇO DE 2023 A 31 DE AGOSTO DE 2023'),
(574,'DESENVOLVIMENTO DE UM APLICATIVO MÓVEL PARA AVALIAÇÃO DA APTIDÃO FÍSICA DE ESCOLARES','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA EM DESENVOLVIMENTO TECNOLÓGICO E INOVAÇÃO / IF SUDESTE MG – (PIBITI – IF SUDESTE MG)','01 DE JUNHO DE 2022 A 31 DE MAIO DE 2023'),
(575,'BARRAS DE CEREAIS ENRIQUECIDAS COM BACILOS PROBIÓTICOS: ELABORAÇÃO E AVALIAÇÃO FÍSICO-QUÍMICA, MICROBIOLÓGICA, SENSORIAL E DE SOBREVIVÊNCIA DO PROBIÓTICO APÓS SIMULAÇÃO IN-VITRO DAS CONDIÇÕES GASTROINTESTINAIS','PROGRAMA INSTITUCIONAL DE BOLSAS DE INICIAÇÃO CIENTÍFICA E TECNOLÓGICA / CNPQ - (PIBIC-CNPQ)','01 DE SETEMBRO DE 2022 A 31 DE AGOSTO DE 2023');
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetosparticipantes`
--

DROP TABLE IF EXISTS `projetosparticipantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projetosparticipantes` (
  `idProjetoParticipante` int(11) NOT NULL AUTO_INCREMENT,
  `cpfAluno` varchar(11) NOT NULL,
  `cpfOrientador` varchar(11) NOT NULL,
  `idProjeto` int(11) NOT NULL,
  `tipoBolsa` varchar(11) NOT NULL,
  `liberar` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProjetoParticipante`)
) ENGINE=MyISAM AUTO_INCREMENT=806 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetosparticipantes`
--

LOCK TABLES `projetosparticipantes` WRITE;
/*!40000 ALTER TABLE `projetosparticipantes` DISABLE KEYS */;

/*!40000 ALTER TABLE `projetosparticipantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sistema_externo`
--

DROP TABLE IF EXISTS `sistema_externo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sistema_externo` (
  `codigo_sistema` int(11) NOT NULL AUTO_INCREMENT,
  `nome_sistema` int(11) NOT NULL,
  PRIMARY KEY (`codigo_sistema`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistema_externo`
--

LOCK TABLES `sistema_externo` WRITE;
/*!40000 ALTER TABLE `sistema_externo` DISABLE KEYS */;
INSERT INTO `sistema_externo` VALUES
(1,0);
/*!40000 ALTER TABLE `sistema_externo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `codigo_site` int(2) NOT NULL,
  `titulo_janela` varchar(100) NOT NULL,
  `logo_topo` varchar(60) NOT NULL,
  `nome_site` varchar(50) NOT NULL,
  `titulo_rodape` varchar(50) NOT NULL,
  `instituicao_rodape` varchar(150) NOT NULL,
  `endereco_rodape` varchar(100) NOT NULL,
  `telefone_rodape` varchar(15) NOT NULL,
  `email_rodape` varchar(60) NOT NULL,
  `desenvolvido` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo_site`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` VALUES
(1,'.:: DPPG - Diretoria de Pesquisa e Pós-Graduação ::.','689787254_Simbolo da DPPG.jpg','Diretoria de Pesquisa e Pós-Graduação','Diretoria de Pesquisa e Pós-Graduação','Instituto Federal de Educação Ciência e Tecnologia do Sudeste de Minas Gerais - Campus Rio Pomba','Av. Dr José Sebastião Da Paixão s/nº - Bairro Lindo Vale - CEP: 36180-000 - Rio Pomba/MG ','(32)3571-5700','dppg.riopomba@ifsudestemg.edu.br','Jairo Marotta');
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_atividades_complementares`
--

DROP TABLE IF EXISTS `sub_atividades_complementares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_atividades_complementares` (
  `codigo_sub_atividades_complementares` int(11) NOT NULL AUTO_INCREMENT,
  `nome_sub_atividades` varchar(50) NOT NULL,
  `carga_horaria` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `codigo_atividades_complementares` int(11) NOT NULL,
  PRIMARY KEY (`codigo_sub_atividades_complementares`),
  KEY `cpf` (`cpf`),
  KEY `codigo_atividades_complementares` (`codigo_atividades_complementares`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_atividades_complementares`
--

LOCK TABLES `sub_atividades_complementares` WRITE;
/*!40000 ALTER TABLE `sub_atividades_complementares` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_atividades_complementares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Geral';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES
('000','21232f297a57a5a743894a0e4a801fc3','Administrador','',''),
('001','21232f297a57a5a743894a0e4a801fc3','Sub Administrador','',''),

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valida_certificado`
--

DROP TABLE IF EXISTS `valida_certificado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valida_certificado` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) DEFAULT '-',
  `codigo_curso` int(11) DEFAULT NULL,
  `data` datetime NOT NULL,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=914 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valida_certificado`
--

LOCK TABLES `valida_certificado` WRITE;
/*!40000 ALTER TABLE `valida_certificado` DISABLE KEYS */;

/*!40000 ALTER TABLE `valida_certificado` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-21 11:37:35
