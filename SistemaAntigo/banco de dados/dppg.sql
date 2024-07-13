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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
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
  `nome_curso` varchar(50) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `descricao` longtext NOT NULL,
  `vagas` int(11) NOT NULL,
  `duracao` int(11) NOT NULL,
  `data_realizacao` date NOT NULL,
  `horario_realizacao` varchar(5) NOT NULL,
  `palestrante` varchar(100) NOT NULL,
  `ativo` char(1) NOT NULL,
  PRIMARY KEY (`codigo_curso`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES
(2,'Captação de Recursos para Pesquisa','2012-02-28','2012-03-01','<p><a href=\"http://www.financiar.org.br/arquivos/apresentacao/curso_captacao_recursos_ifsudestemg_mar_2012.pdf\" target=\"_blank\">Clique aqui para fazer o download dos slides do curso</a></p>\r\n<p><span style=\"font-family: Arial; font-size: xx-small;\"><br /></span></p>',143,4,'2012-03-02','13:00','D.Sc. Cássia Camargo Harger Sakiyama','S'),
(3,'I Curso de Propriedade Intelectual','2012-02-28','2012-03-04','<p><strong>&rdquo;I Curso de Propriedade Intelectual&rdquo;. </strong></p>\r\n<p>O curso acontecer&aacute; nos dia 05 e 06 de mar&ccedil;o de 2012, de 16h030min &agrave;s 18h30min, no Sal&atilde;o Nobre do IF Sudeste MG &ndash; <em>Campus</em> Rio Pomba.&nbsp;</p>\r\n<p><strong>Ser&atilde;o abordados no curso os seguintes t&oacute;picos: </strong></p>\r\n<p>- Pol&iacute;tica de Inova&ccedil;&atilde;o do IF Sudeste MG</p>\r\n<p>- Propriedade Intelectual: Generalidades e Propriedade Industrial</p>\r\n<p>- Propriedade Intelectual: Direito Autoral e <em>Sui Generis</em></p>\r\n<p>O curso ser&aacute; ministrado por Maria Lu&iacute;za Firmiano Teixeira, bacharel em Direito pela UFJF, especialista em Processo Civil pela associa&ccedil;&atilde;o Universidade Anhanguera e Instituto Brasileiro de Direito Processual (IBDP) e por Inaiara C&oacute;ser Sobrinho, bacharel em Ci&ecirc;ncias Econ&ocirc;micas pela UFJF. Atualmente, Maria Lu&iacute;za &eacute; Coordenadora de Propriedade Intelectual e Inaiara, Coordenadora de Articula&ccedil;&atilde;o e Prospec&ccedil;&atilde;o de Oportunidade, ambas do N&uacute;cleo de Inova&ccedil;&atilde;o e Transfer&ecirc;ncia de Tecnologia &ndash; NITTEC, do IF Sudeste MG.</p>',123,4,'2012-03-05','16:30','Maria Luíza Firmiano Teixeira e Inaiara Cóser Sobrinho','S'),
(4,'Redação Científica','2012-03-14','2012-03-20','<p>Os resultados de pesquisa n&atilde;o podem ficar encerrados em sua &aacute;rea de  experimenta&ccedil;&atilde;o, sendo fundamental o conhecimento p&uacute;blico da inova&ccedil;&atilde;o, a  fim de trazer benef&iacute;cios &agrave; sociedade. A necessidade de disseminar o  conhecimento gerado pela pesquisa pressup&otilde;e o uso de linguagem adequada e  de padroniza&ccedil;&atilde;o cient&iacute;fica capaz de garantir confiabilidade e  uniformidade &agrave; informa&ccedil;&atilde;o Rog&eacute;rio V. de Faria).</p>\r\n<p>No entanto, A dificuldade em produzir textos t&eacute;cnico-cient&iacute;ficos de qualidade &eacute; um entrave para publica&ccedil;&atilde;o de trabalhos cient&iacute;ficos em revistas de alto impacto. Desta forma, o curso de &ldquo;Reda&ccedil;&atilde;o Cient&iacute;fica&rdquo; ser&aacute; &uacute;til para os estudantes e pesquisadores do <em>Campus</em> Rio Pomba que desejam aprofundar-se na &aacute;rea de pesquisa e inova&ccedil;&atilde;o.</p>\r\n<p>&nbsp;O curso ser&aacute; ministrado pelo pesquisador da EMBRAPA Rog&eacute;rio Vieira de Faria, Bolsista de Produtividade do CNPq N&iacute;vel 2, Doutor em Fitotecnia pela UFV, P&oacute;s-doutor em Quimiga&ccedil;&atilde;o pela Universidade da Georgia (EUA) e em Ra&iacute;zes pela Penn State University (EUA). Com mais de uma centena de artigos publicados, &eacute; atualmente revisor de 19 peri&oacute;dicos cient&iacute;ficos.</p>\r\n<p>&nbsp;Nesta ocasi&atilde;o, Rog&eacute;rio tamb&eacute;m apresentar&aacute; seu livro \"<strong>Dicion&aacute;rio de d&uacute;vidas e dificuldades na reda&ccedil;&atilde;o cient&iacute;fica</strong>\". Ser&aacute; mais uma boa oportunidade para a comunidade do <em>Campus</em> Rio Pomba, pois o livro ser&aacute; vendido para os interessados por R$ 40,00, sendo o pre&ccedil;o normal, diretamente na Editora, R$ 70,00.</p>\r\n<p>Local: Audit&oacute;rio da Funda&ccedil;&atilde;o/IF Sudeste MG - Campus Rio Pomba</p>',-4,8,'2012-03-21','08:00','Rogério Vieira de Faria','S');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `codigo_grupo` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo_grupo`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES
(1,'Administrador');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricao`
--

LOCK TABLES `inscricao` WRITE;
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;

/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;
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
  PRIMARY KEY (`codigo_grupo`,`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participa_grupos`
--

LOCK TABLES `participa_grupos` WRITE;
/*!40000 ALTER TABLE `participa_grupos` DISABLE KEYS */;
INSERT INTO `participa_grupos` VALUES
(1,'admin');
/*!40000 ALTER TABLE `participa_grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participantes`
--

DROP TABLE IF EXISTS `participantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participantes` (
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Geral';
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Geral';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES
('admin','e10adc3949ba59abbe56e057f20f883e','Administrador','','');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-21 11:37:25
