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
-- Table structure for table `acervo`
--

DROP TABLE IF EXISTS `acervo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acervo` (
  `codigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `arquivo` varchar(100) NOT NULL,
  `palavra_chave` varchar(100) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `autores` varchar(200) NOT NULL,
  `ano` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acervo`
--

LOCK TABLES `acervo` WRITE;
/*!40000 ALTER TABLE `acervo` DISABLE KEYS */;
INSERT INTO `acervo` VALUES
(1,'artigo1.pdf','Gestão de Estoque, Software e Levantamento de dados','  ADMINISTRAÇÃO ESTRATÉGICA DE ESTOQUES EM MICRO E PEQUENAS EMPRESAS DO COMÉRCIO EM RIO POMBA, MINAS GERAIS: UM ESTUDO EXPLORATÓRIO SOBRE AS NECESSIDADES E FRAGILIDADES DA GESTÃO DE ESTOQUE','Ademilson do ESPÍRITO SANTO; Alexandre Lana ZIVIANI',2010),
(2,'artigo2.pdf','Psicrotróficos Protease Isoflavona','INIBIÇÃO DA ATIVIDADE PROTEOLÍTICA DE BACTÉRIAS PSICROTRÓFICAS EM MEIO DE CULTURA ADICIONADO DE ISOFLAVONA','Aline Pereira MARTINS; Maurilio Lopes MARTINS; Cláudia Lúcia de Oliveira PINTO',2010),
(3,'artigo3.pdf','produção, crescimento, nutrientes, consorciação.','EFEITO DA ÉPOCA DE MANEJO DE ADUBOS VERDES SOBRE ERVAS ESPONTÂNEAS E NUTRIÇÃO NITROGENADA EM UM CAFEZAL SOBRE MANEJO ORGÂNICO','Bianca de Jesus SOUZA; Silvonei de Araújo ABBADE; Tatiana Pires BARRELA; Guilherme Musse MOREIRA; Rafael Monteiro de OLIVEIRA; Ricardo Henrique Silva SANTOS (2); Anastácia FONTANÉTTI',2010),
(5,'artigo4.pdf','Equivalência, matriz companheira, EDO','EQUIVALÊNCIA E A MATRIZ COMPANHEIRA','Bruna TRINDADE; M. Sc. Marcos CARVALHO',2010),
(6,'artigo5.pdf','Leite cru. Análises físico-químicas e microbiológicas. Instrução Normativa no51.','QUALIDADE DO LEITE CRU DOS BOVINOS EM LACTAÇÃO DO SETOR DE ZOOTECNIA DO INTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS, CAMPUS RIO POMBA','Bruno Ricardo de Castro LEITE JÚNIOR; Gustavo Henrique de SOUZA; Patrícia Martins de OLIVEIRA; Maurilio Lopes MARTINS.',2010),
(11,'artigo6.pdf','Ordenha. Instrução Normativa no51. Tanque de granelização.','QUALIDADE DO LEITE CRU REFRIGERADO DO TANQUE DE EXPANSÃO DO SETOR DE ZOOTECNIA DO INTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS, CAMPUS RIO POMBA ANTES E APÓS TREINAMENTO DOS FUNCIONÁRIOS EM BOAS PRÁTICAS AGROPECUÁRIAS','Bruno Ricardo de Castro LEITE JÚNIOR; Gustavo Henrique de SOUZA; Patrícia Martins de OLIVEIRA; Maurilio Lopes MARTINS; Eliane Maurício Furtado MARTINS.',2010),
(12,'artigo7.pdf','legislação, produtor, leite cru, propriedade, queijo.','DIAGNÓSTICO DA CADEIA PRODUTIVA DOS QUEIJOS ARTESANAIS PRODUZIDOS NO MUNICÍPIO DE RIO POMBA,  MINAS GERAIS','Daniela Cristina Faria VIEIRA; José Manoel MARTINS; Cleuber Antonio de Sá SILVA.',2010),
(13,'artigo8.pdf','Controle de estoques. Software gratuito. Tecnologia da Informação.','Administração estratégica de estoques em micro e pequenas empresas do\ncomércio em Rio Pomba, Minas Gerais: um estudo exploratório sobre os softwares gratuitos gerenciadores de estoques','Danilo PIERRE; Ademilson SANTO; Alexandre ZIVIANI',2010),
(14,'artigo9.pdf','Okará, extrato solúvel de soja, hambúrguer.','Aproveitamento do resíduo sólido obtido na produção de extrato aquoso de soja na produção de hambúrguer tipo suíno','Diana Clara Nunes de LIMA; Miguel Meirelles de OLIVEIRA; Isabela Campelo de QUEIROZ; Alcinéia de Lemos Souza RAMOS; Eliane Maurício Furtado MARTINS; Aída Couto Dinucci BEZERRA',2010),
(15,'artigo10.pdf','Extrato hidrossolúvel de soja, melhoria nutricional, prebiótico.','ELABORAÇÃO DE BEBIDA A BASE DE EXTRATO SOLÚVEL DE SOJA COM SORO DE QUEIJO ACRESCIDA DE INULINA E OLIGOFRUTOSE','Glauciane de Oliveira ALVES; Cinthia Soares Cardoso QUINTÃO; Roselir Ribeiro da SILVA; Eliane Maurício Furtado MARTINS.',2010),
(16,'artigo11.pdf','LTSP. Meio Ambiente. Lixo Eletrônico. Thin Clients. Inclusão Digital. Economia.','Maior sobrevida aos computadores antigos do IF Sudeste MG – Campus Rio Pomba','Gustavo Henrique REIS; Racyus Delano PACÍFICO;Rafael DIAS.',2010),
(17,'artigo12.pdf','Custo cesta básica, Salário-mínimo, Rio Pomba','IMPLEMENTAÇÃO DE UMA PESQUISA DE ORÇAMENTO FAMILIAR E CÁLCULO DO CUSTO DA CESTA BÁSICA NACIONAL EM RIO POMBA – MG','Jéssika do Vale SILVA; Wildson Justiniano PINTO',2010),
(18,'artigo13.pdf','Modelagem de Sistemas Multiagentes, Sistemas de Informações Geográficas, Geosimulação.','MODELAGEM CONCEITUAL MULTIAGENTE DE UM SISTEMA PARA\nSEGURANÇA PÚBLICA.','João Paulo Campolina LAMAS, Elton Vieira COSTA',2010),
(19,'artigo14.pdf','Gerenciamento da pesquisa e inovação. Sistema de Gestão de Pesquisa e Inovação. Consulta de dados.','IMPLEMENTAÇÃO DE BANCO DE DADOS PARA APORTE A PESQUISA NO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERIAS','Jonas de Paiva POTROS; Tibério Fontenele BARREIRA; Karla Lúcia da MOTA; Maurilio Lopes MARTINS; Valter de MESQUITA; Bruno Gaudereto SOARES;\nGustavo Henrique da ROCHA',2010),
(20,'artigo15.pdf','recuperação de pastagem; pastejo rotacionado, pastejo racional, altura de pastejo,pastagem nativa.','PROJETO DE RECUPERAÇÃO DE PASTAGEM E PASTEJO\nROTACIONADO RACIONAL NO IFET - CAMPUS RIO POMBA','Juliana Ferreira ROCHA; Edilson Rezende CAPPELLE',2010),
(21,'artigo16.pdf','agente antioxidante, processamento mínimo, análise sensorial.','ALTERAÇÕES NA ACEITAÇÃO SENSORIAL DE LARANJA MINIMAMENTE PROCESSADA ADICIONADA DE ÁCIDO ASCÓRBICO E ÁCIDO CÍTRICO','Kamila Ferreira CHAVES; Welliton Fagner da CRUZ; Vanessa Riani Olmi SILVA; Aurélia Dornelas de Oliveira MARTINS; Alcinéia de Lemos Souza RAMOS;Eliane Maurício Furtado MARTINS; Maurício Henriques Louza',2010),
(22,'artigo17.pdf','ácido cítrico, ácido ascórbico, avaliação sensorial.','ALTERAÇÕES SENSORIAIS DE MAMÃO MINIMAMENTE PROCESSADO ADICIONADO DE ANTIOXIDANTE','Kamila Ferreira CHAVES; Lorrani do Carmo TEIXEIRA; Vanessa Riani Olmi SILVA; Aurélia Dornelas de Oliveira MARTINS; Alcinéia de Lemos Souza RAMOS; Maurício Henriques Louzada SILVA; Eliane Maurício Furt',2010),
(23,'artigo18.pdf','micro-organismo, bactérias láticas, leite.','COMPOSIÇÃO FÍSICO-QUIMICA DE QUEIJO MINAS PADRÃO PROBIÓTICO INOCULADO COM E. aerogenes','Karine de Almeida MARQUES; Rosineide da Paixão FERREIRA; Aurélia Dornelas de Oliveira MARTINS; Bruno Gaudereto SOARES; Maurílio Lopes MARTINS; José Manoel MARTINS.',2010),
(24,'artigo19.pdf','Empresa Júnior. Gestão. Administração.','PERFIL, DIFICULDADES E PERSPECTIVAS DAS EMPRESAS JUNIORES DO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS, CAMPUS RIO POMBA','Karla Lúcia da MOTA; Jonas de Paiva POTROS; Tibério Fontenele BARREIRA, Valter de MESQUITA; Maurilio Lopes MARTINS; Bruno Gaudereto SOARES.',2010),
(25,'artigo20.pdf','doce de leite; mercado; cor.','    AVALIAÇÃO DAS CARACTERÍSTICAS FÍSICO-QUIMICAS, MICROBIOLOGICAS E SENSORIAIS DE AMOSTRAS COMERCIAIS DE DOCE DE LEITE','JOAQUIM, Leandro Oliveira; SILVA, Maurício Henriques Louzada; RAMOS, Alcinéia de Lemos Souza; SILVA, Vanessa Riani Olmi; MARTINS, Maurílio Lopes; CASTRO, Renan Luís Emídio de; LEITE JUNIOR, Bruno Rica',2010),
(26,'artigo21.pdf','Monitoria Pedagógica. Ensino-Aprendizagem. Ensino de Matemática.','Monitoria pedagógica: contribuições no processo de ensino-aprendizagem no IFET Sudeste de Minas Gerais – Campus Rio Pomba','Lídia FERREIRA; Geraldo LIMA; Paula MIRANDA',2010),
(27,'artigo22.pdf','Concorrência. Transmissão de preços. Leite.','CONCORRÊNCIA E ESTRATÉGIAS DE PRECIFICAÇÃO DO SISTEMA AGROINDUSTRIAL DO LEITE NA REGIÃO DA ZONA DA MATA E VERTENTES DO ESTADO DE MINAS GERAIS.','Lidiane Aparecida da SILVA; Wildson Justiniano PINTO',2010),
(28,'artigo23.pdf','Yacon. . Processamento mínimo. Vida de prateleira.','Utilização de metabissulfito de sódio sobre a vida de prateleira de yacon (Smallanthus sonchifolius) minimamente processado','Marcela Zonta RODRIGUES (1); Vitor Ibrahim BRANDÃO (1); Eliane Maurício Furtado   MARTINS',2010),
(29,'artigo24.pdf','Pólo moveleiro de Ubá; fábricas moveleiras; INTERSIND.','ALGUNS APONTAMENTOS SOBRE O PÓLO MOVELEIRO DE UBÁ','Nívea Soares Costa, Aida Lúcia Moreira; Marcelo Leles Romarco de Oliveira',2010),
(30,'artigo25.pdf','Massa. Pão de forma. Glúten.','CARACTERZAÇÃO DE PÃO ISENTO DE GLÚTEN E ADICIONADO DE FIBRAS','Patrícia Rodrigues CONDÉ; Nívia Maria TEIXEIRA; Isabela Campelo de QUEIROZ; Alcinéia Lemos RAMOS; Vanessa Riane Olmi SILVA',2010),
(31,'artigo26.pdf','Adubação Orgânica. Adubação Molíbdica. Feijão. Agroecologia.','COMPORTAMENTO DE DOSES CRESCENTES DE ESTERCO DE AVIÁRIO APLICADAS EM COBERTURA, SOBRE A PRODUTIVIDADE DO FEIJOEIRO COMUM (Phaseolus vulgaris L.)','Phillip de Alcântara GARCIA; Marcos Luiz R. BASTIANI; Silvane de Almeida CAMPOS; Brauly Martins ROCHA; José Eustáquio de S. CARNEIRO',2010),
(32,'artigo27.pdf','Produtividade, crescimento, lablabe, feijão-de-porco.','EFEITO DA ÉPOCA DE MANEJO DE ADUBOS VERDES SOBRE O DESENVOLVIMENTO E PRODUÇÃO DE CAFEEIROS','Rafael Monteiro de OIVEIRA; Tatiana Pires BARRELLA; Bianca de Jesus SOUZA; Ricardo Henrique Silva SANTOS; Guilherme Musse MOREIRA; Caio Matos DAVID; Luiz Cláudio PEREIRA',2010),
(33,'artigo28.pdf','Bebida Láctea; Soro de Leite; Extrato hidrossolúvel de Soja.','ANÁLISE SENSORIAL E INTENÇÃO DE COMPRA DE UMA BEBIDA LÁCTEA PROBIÓTICA SABOR MORANGO À BASE DE SORO DO LEITE E EXTRATO HIDROSSOLÚVEL DE SOJA','Renan Luís Emídio de CASTRO; Maurício Henriques Louzada SILVA; Bruno Ricardo de Castro LEITE JÚNIOR; Vanessa Riani Olmi SILVA; Alana Oliveira DAMIÃO; Leandro Oliveira JOAQUIM.',2010),
(34,'artigo29.pdf','Analise físico-química. Viabilidade. Culturas probióticas.','CARACTERIZAÇÃO FÍSICO-QUÍMICA E AVALIAÇÃO DA VIABILIDADE DE UMA BEBIDA LÁCTEA PROBIÓTICA SABOR MORANGO À BASE DE SORO DO LEITE E EXTRATO HIDROSSOLÚVEL DE SOJA DE DIFERENTES CULTURAS PROBIOTICAS','Renan Luís Emídio de CASTRO; Maurício Henriques Louzada SILVA; Bruno Ricardo de Castro LEITE JÚNIOR; Vanessa Riani Olmi SILVA; Alana Oliveira DAMIÃO; Leandro Oliveira JOAQUIM.',2010),
(35,'artigo30.pdf','Recuperação Ambiental, Restauração Florestal, Educação Ambiental.','REVEGETAÇÃO DE TALUDES E ÁREAS CILIARES DA REPRESA DO HORTO E DA NASCENTE DO IF SUDESTE MG – CAMPUS RIO POMBA','Rodrigo OLIVEIRA; Maria Dalva TRIVELLATO; Maurício SOUZA',2010),
(36,'artigo31.pdf','Subprodutos. Frutas. Aproveitamento.','AVALIAÇÃO FÍSICO-QUÍMICA DE SUBPRODUTOS DO PROCESSAMENTO DE FRUTAS','Rosineide da Paixão FERREIRA; Karine de Almeida MARQUES; Vanessa Riani Olmi SILVA; Maurício Henriques Louzada SILVA; Eliane Maurício Furtado MARTINS; Alcinéia de Lemos Souza RAMOS; Isabela Campelo de ',2010),
(37,'artigo32.pdf','Tecnologias. Ensino. Formação de docentes. Software educacional.','A VISÃO DOS LICENCIANDOS EM MATEMÁTICA SOBRE O PROCESSO ENSINO-APRENDIZAGEM COM O USO DE NOVAS TECNOLOGIAS','Sávio REIS; Paula MIRANDA.',2010),
(38,'artigo33.pdf','Adubação Orgânica. Adubação Molíbdica. Feijão. Agroecologia.','EFEITO DE DOSES CRESCENTES DE ESTERCO DE AVIÁRIO NO PLANTIO, SOBRE A PRODUTIVIDADE DO FEIJOEIRO COMUM(Phaseolus vulgaris L.), SUBMETIDO A UM MANEJO AGROECOLÓGICO DE PRODUÇÃO','Silvane A. CAMPOS; Marcos L. R. BASTIANI; Brauly M. ROCHA; Antônio Daniel COELHO; Phillip A. GARCIA; José Eustáquio S. CARNEIRO',2010),
(39,'artigo34.pdf','Planejamento. Propriedade Intelectual. Transferência de Tecnologia.','A EXPERIÊNCIA DO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS NA ORGANIZAÇÃO E GESTÃO DE NÚCLEO DE INOVAÇÃO TECNOLÓGICA','Tibério Fontenele BARREIRA; Jonas de Paiva POTROS; Karla Lúcia da MOTA;Maurilio Lopes MARTINS; Valter de MESQUITA; Edgar Ricardo FERREIRA; Maria Elizabeth RODRIGUES.',2010),
(40,'artigo35.pdf','Micorrizas, Pisolithus microcarpus, Recuperação de áreas degradadas, Esporos,inoculantes.','PESO SECO E MICORRIZAÇÃO EM MUDAS DE Eucalyptus citriodora INOCULADAS COM ESPOROS DE Pisolithus microcarpus','Vanessa Pereira de ABREU; Joara Secchi CANDIAN; Fabrício Palla TEIXEIRA;Mauro César MARTINS; André Narvaes da Rocha CAMPOS',2010),
(41,'artigo36.pdf','Psicrotróficos. Leite. Enzimas deterioradoras.','INFLUÊNCIA DA ATIVIDADE PROTEOLÍTICA DE BACTÉRIA PSICROTRÓFICA NA QUALIDADE DE IOGURTE TIPO LÍQUIDO,   BATIDO E SUNDAE','Vitor Ibrahim BRANDÃO; Marcela Zonta RODRGUES; Bruno Ricardo de CastroL EITE JUNIOR; Maurilio Lopes MARTINS; Cláudia Lúcia de Oliveira PINTO.',2010),
(42,'artigo37.pdf','Fraude. Soro. Leite.','USO DA ANÁLISE MULTIVARIADA NA DETECÇÃO DE FRAUDE DE LEITE CRU POR ADIÇÃO DE SORO DE LEITE','DIAS, V. C.; PINTO, R. T.; MARTINS, J. M.; RAMOS, A. L. S.; FONTES, E. A. F.; SILVA, R. A. G..',2010),
(43,'artigo38.pdf','Engenharia de Software. Processo de Software. Modelagem de Software. Metodologia de Software. Essênc','ESSÊNCIA E ACIDENTES DA ENGENHARIA DE SOFTWARE','Wellington Moreira de OLIVEIRA; Raphael Barbosa da Silva ROCHA.',2010),
(44,'artigo39.pdf','Processamento mínimo. Alimentos funcionais. Probióticos.','ALFACE MINIMAMENTE PROCESSADA ENRIQUECIDA COM LACTOBACILLUS PARACASEI','Welliton Fagner da CRUZ; Kamila Ferreira CHAVES; Eliane Maurício Furtado MARTINS; Maurílio Lopes MARTINS',2010),
(45,'resumo1.pdf','','FORMAÇÃO DE BIOFILME POR BACTÉRIAS PSICROTRÓFICAS ISOLADAS DE LEITE CRU GRANELIZADO','MARTINS, Aline Pereira; MARTINS, Maurilio Lopes',2010),
(46,'resumo2.pdf','Sobremesa láctea. Soro. Manga.','CARACTERIZAÇÃO FÍSICO-QUÍMICA E SENSORIAL DE SOBREMESA LÁCTEA À BASE DE MANGA E SORO DE LEITE','Daniela Cristina Faria VIEIRA; Patrícia Rodrigues CONDÉ; Ana Sílvia Boroni de OLIVEIRA;Cleuber Antônio de Sá SILVA; Eliane Maurício Furtado MARTINS; Vanessa Riani Olmi SILVA',2010),
(47,'resumo3.pdf','propagação; palmito; mudas.','ESTUDO DE DIFERENTES TIPOS DE SUBSTRATOS PARA A GERMINAÇÃO DE SEMENTES DA PALMEIRA JUÇARA (Euterpe edulis Martius).','Davidson dos Santos Martins; Francisco César Gonçalves, Juliana Loureiro de Almeida Campos',2010),
(48,'resumo4.pdf','Novos Produtos; prebióticos; aceitação.','Análise sensorial de diferentes sabores de sorvete frozen yogurt à base de yacon (Smallanthus sonchifolius)fermentado por Streptococcus salivarius subsp. thermophilus e Lactobacillus delbrueckii subsp. bulgaricus','OLIVEIRA, Patrícia Martins de; LEITE JÚNIOR, Bruno Ricardo de Castro;RODRIGUES, Marcela Zonta; BRANDÃO, Vitor Ibrahim; MARTINS, Eliane Mauricio Furtado; SILVA, Roselir Ribeiro da',2010),
(49,'resumo5.pdf','Pesquisa de mercado; repositores hidroeletrolíticos; atletas.','COMPARATIVO SOBRE O CONHECIMENTO DE BEBIDAS ISOTÔNICAS ENTRE PRATICANTES E NÃO PRATICANTES\nDE ATIVIDADE FÍSICA DA REGIÃO DA ZONA DA MATA DE MINAS GERAIS','OLIVEIRA, Patrícia Martins de; LEITE JÚNIOR, Bruno Ricardo de Castro;OLIVEIRA, Allan Costa de; REIS, Marilândia Rafaela de Ramos; ANDRADE,Sheila de; SILVA, Roselir Ribeiro da',2010),
(50,'resumo6.pdf','físico-química; microbiológica; sensorial.','APROVEITAMENTO DA CASCA DE BANANA NA FABRICAÇÃO DE DOCE E BOLO','FERREIRA, Rosineide da Paixão; MARQUES, Karine de Almeida; SILVA,Vanessa Riani Olmi; SILVA, Maurício Henriques Louzada; MARTINS, Eliane Mauricio Furtado; RAMOS, Alcinéia de Lemos Souza; QUEIROZ, Isabe',2010),
(51,'resumo7.pdf','Novos produtos; Probióticos; Simbióticos.','Avaliação de aroma e textura de diferentes sabores de sorvete frozen yogurt à base de yacon (Smallanthus\n  sonchifolius) fermentado por Lactobacillus casei','BRANDÃO, Vitor Ibrahim; LEITE JÚNIOR, Bruno Ricardo de Castro;OLIVEIRA, Patrícia Martins de; RODRIGUES, Marcela Zonta; MARTINS,Eliane Mauricio Furtado; SILVA, Roselir Ribeiro da',2010),
(52,'artigo40.pdf','Banana in natura; Conservação; Cobertura comestível','AVALIAÇÃO DE COBERTURAS COMESTÍVEIS NA CONSERVAÇÃO DE BANANA IN NATURA','Miguel Meirelles de OLIVEIRA; Wanessa Oliveira GOMES; Eliane Maurício Furtado MARTINS; Isabela Campelo de QUEIROZ; Vanessa Riani Olmi SILVA; Elisabete FANTUZZI.',2010),
(53,'artigo41.pdf','Frutas. Rusticidade. Edafoclimáticas.','ESTUDO DA FENOLOGIA DA PHYSALIS SP. NA REGIÃO DA ZONA DA MATA MINEIRA','John Henrique Souza LOPES; Carlos Miranda CARVALHO; Matheus Barbosa da Silva ROCHA; Natália de Brito LANNA',2010);
/*!40000 ALTER TABLE `acervo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administracao`
--

DROP TABLE IF EXISTS `administracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administracao` (
  `usuario` varchar(20) NOT NULL DEFAULT '',
  `senha` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administracao`
--

LOCK TABLES `administracao` WRITE;
/*!40000 ALTER TABLE `administracao` DISABLE KEYS */;
INSERT INTO `administracao` VALUES
('adm','123456'),
('ccpg','123456');
/*!40000 ALTER TABLE `administracao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controle_certificado`
--

DROP TABLE IF EXISTS `controle_certificado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controle_certificado` (
  `cpf` varchar(11) NOT NULL,
  `numero` bigint(20) NOT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controle_certificado`
--

LOCK TABLES `controle_certificado` WRITE;
/*!40000 ALTER TABLE `controle_certificado` DISABLE KEYS */;

/*!40000 ALTER TABLE `controle_certificado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES
(2,'Técnico em Informática'),
(3,'Técnico em Meio Ambiente'),
(4,'Técnico em Meio Ambiente à Distância'),
(5,'Técnico em Secretariado'),
(6,'Técnico em Segurança do Trabalho'),
(7,'Técnico em Vendas'),
(8,'Técnico em Agropecuária'),
(9,'Técnico em Alimentos'),
(10,'Técnico em Florestal'),
(11,'Técnico em Zootecnia'),
(1,'-----'),
(12,'Administração'),
(13,'Agroecologia'),
(14,'Ciência da Computação'),
(15,'Ciência e Tecnologia em Alimentos'),
(16,'Matemática'),
(17,'Tecnologia em Laticínios'),
(18,'Zootecnia'),
(19,'Pós-graduação em Agroecologia'),
(20,'Especialização Lato-sensu Proeja');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `codigo` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES
(1,'III Simpósio de Ciência, Inovação & Tecnologia'),
(2,'I Seminário de Inovação Tecnológica');
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insc_eventos`
--

DROP TABLE IF EXISTS `insc_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insc_eventos` (
  `cpf` varchar(11) NOT NULL DEFAULT '0',
  `cod_evento` int(11) NOT NULL DEFAULT '0',
  `pagamento` varchar(3) NOT NULL DEFAULT '',
  `presenca` varchar(3) NOT NULL DEFAULT '',
  `data_inscricao` date NOT NULL DEFAULT '0000-00-00',
  `hora_inscricao` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`cpf`,`cod_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insc_eventos`
--

LOCK TABLES `insc_eventos` WRITE;
/*!40000 ALTER TABLE `insc_eventos` DISABLE KEYS */;

/*!40000 ALTER TABLE `insc_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscricao`
--

DROP TABLE IF EXISTS `inscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscricao` (
  `cpf` varchar(11) NOT NULL DEFAULT '0',
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `email` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `senha` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `telefone` bigint(20) NOT NULL DEFAULT '0',
  `curso` int(11) NOT NULL DEFAULT '0',
  `trabalhos` char(1) DEFAULT 'N',
  `tipo_participante` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricao`
--

LOCK TABLES `inscricao` WRITE;
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;

/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linhas_pesquisa`
--

DROP TABLE IF EXISTS `linhas_pesquisa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linhas_pesquisa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linhas_pesquisa`
--

LOCK TABLES `linhas_pesquisa` WRITE;
/*!40000 ALTER TABLE `linhas_pesquisa` DISABLE KEYS */;
INSERT INTO `linhas_pesquisa` VALUES
(58,'Agricultura','joao.correa@ifsudestemg.edu.br'),
(59,'Ciências Biológicas e Biotecnologia','andre.campos@ifsudestemg.edu.br'),
(60,'Ciências da Saúde','isabela.queiroz@ifsudestemg.edu.br'),
(61,'Ciências Exatas e dos Materiais','vanessa.freitas@ifsudestemg.edu.br'),
(62,'Recursos Naturais, Ciências e Tecnologias Ambientais','joao.correa@ifsudestemg.edu.br'),
(63,'Zootecnia','cristiano.jayme@ifsudestemg.edu.br'),
(64,'Ciência e Tecnologia de Alimentos','isabela.queiroz@ifsudestemg.edu.br'),
(65,'Ciências Sociais, Humanas, Letras e Artes','charles.okama@ifsudestemg.edu.br');
/*!40000 ALTER TABLE `linhas_pesquisa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modalidades`
--

DROP TABLE IF EXISTS `modalidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modalidades` (
  `codigo` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(100) NOT NULL DEFAULT '',
  `vagas` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modalidades`
--

LOCK TABLES `modalidades` WRITE;
/*!40000 ALTER TABLE `modalidades` DISABLE KEYS */;
INSERT INTO `modalidades` VALUES
(1,'Iniciação Científica e Tecnológica',30),
(2,'Exepriências Profissionais',30),
(3,'Estudos Orientados',30);
/*!40000 ALTER TABLE `modalidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_eventos`
--

DROP TABLE IF EXISTS `sub_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_eventos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_evento` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `data` date NOT NULL DEFAULT '0000-00-00',
  `vagas` int(11) NOT NULL DEFAULT '0',
  `horario` time NOT NULL DEFAULT '00:00:00',
  `codigo_evento` int(11) NOT NULL DEFAULT '0',
  `titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `local` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `palestrante` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_eventos`
--

LOCK TABLES `sub_eventos` WRITE;
/*!40000 ALTER TABLE `sub_eventos` DISABLE KEYS */;
INSERT INTO `sub_eventos` VALUES
(1,'Painel de Abertura','2010-10-19',13,'08:00:00',2,'','Salão Nobre',''),
(2,'Palestra 1','2010-10-19',0,'09:00:00',2,'Possibilidades de parcerias CRITT e IF Sudeste MG','Salão Nobre','Paulo Nepomuceno – Secretário de Desenvolvimento Tecnológico da UFJF'),
(3,'Palestra 2','2010-10-19',0,'10:00:00',2,'Exemplo de sucesso: depoimento de inventor','Salão Nobre','Révelson de Souza Lima - Gerente da Modo Arte Indústria, Comércio e Exportação Ltda'),
(4,'Palestra 3','2010-10-19',0,'13:00:00',2,'A proteção de conhecimento sensíveis nas instituições de ciência e tecnologias nacionais','Salão Nobre','Antônio Carlos Fernandes de Souza – Agência Brasileira de Inteligência - ABIN'),
(5,'Palestra 4','2010-10-19',0,'14:00:00',2,'Financiamento da Ação Inovadora','Salão Nobre','Alexandre Cabral, Financiadora de Estudos e Projetos – FINEP'),
(6,'Palestra 5','2010-10-19',0,'15:00:00',2,'A experiência do IF Sudeste MG na organização e gestão do núcleo de inovação tecnológica','Salão Nobre','Equipe do NITTEC, Campus Rio Pomba'),
(7,'Exposição de inventos','2010-10-19',0,'16:00:00',2,'Concurso de produtos e processos','Salão Nobre',''),
(8,'Palestra 6','2010-10-19',0,'18:30:00',2,'A contribuição da Empresa Júnior para a vida profissional','Salão Nobre','Mauro Lúcio de Resende – Administrador de empresas, Gerente da Fazenda Experimental Risoleta Neves –'),
(9,'Palestra 7','2010-10-19',0,'19:00:00',2,'Desenvolvimento Organizacional de uma Empresa Júnior','Salão Nobre','Jackson Guimarães Siqueira – Presidente da Minas Lácteos Assessoria – UFV'),
(10,'Palestra 8','2010-10-19',0,'19:30:00',2,'O movimento empresa Junior no Brasil e o seu papel para construção do conhecimento','Salão Nobre','Federação das Empresas Juniores do Estado de Minas Gerais - FEJEMG'),
(11,'Apresentação Oral 1','2010-10-20',19,'07:30:00',1,'Estudo da fenologia de Physalis sp. na região da Zona da Mata Mineira','Salão Nobre','John Henrique Souza Lopes'),
(12,'Palestra 1','2010-10-20',0,'10:30:00',1,'Ciência para o Desenvolvimento Sustentável','Salão Nobre','Prof. Mauricio Novaes Souza (Diretor-Geral Campus São João Del Rei)'),
(13,'Experiência Profissional 1','2010-10-19',0,'19:00:00',1,'Uma Proposta para o Ensino de Matemática para o Curso Técnico em Agente Comunitário de Saúde na Modalidade PROEJA','Anfiteatro da Fundação','Profª. Paula Reis Miranda'),
(14,'Apresentação Oral 2','2010-10-20',6,'08:00:00',1,'Efeito da época de manejo e espécies de adubos verdes sobre cafezal em manejo orgânico','Salão Nobre','Bianca de Jesus Souza'),
(15,'Apresentação Oral 3','2010-10-20',14,'08:30:00',1,'Produção agroecológica do feijoeiro comum (Phaseolus vulgaris L.)','Salão Nobre','Silvane de Almeida Campos'),
(16,'Apresentação Oral 4','2010-10-20',5,'09:30:00',1,'Revegetação de taludes e áreas ciliares da represa do horto e da nascente do IF/Campus Rio Pomba','Salão Nobre','Rodrigo Fernandes de Oliveira'),
(17,'Apresentação Oral 5','2010-10-20',11,'10:00:00',1,'Produção de mudas de mamoeiro (Carica papaya L.) em diferentes recipientes e substratos orgânicos','Salão Nobre','Adalgisa de Jesus Pereira'),
(18,'Palestra 2','2010-10-20',0,'13:00:00',1,'Diretrizes nacionais para Pesquisa, Inovação e Pós-Graduação nos Institutos Federais: encaminhamentos do Fórum de Pró-Reitores – FORPOG','Salão Nobre','Profª. Maria Elizabeth Rodrigues (Pró-Reitora de Pesquisa e Inovação do IF Sudeste MG)'),
(19,'Experiência Profissional 2','2010-10-19',0,'19:30:00',1,'Uma Análise sobre a Implantação do PROEJA: Um Estudo de Caso no Instituto Federal do Sudeste de Minas Gerais - Campus Rio Pomba de 2006 a 2008','Anfiteatro da Fundação','Prof. Roscelino Quintão Barbosa'),
(20,'Apresentação Oral 6','2010-10-20',1,'14:30:00',1,'Avaliação da viabilidade de utilização de microrganismos probióticos em yacon (Smallanthus sonchifolius) e alface (Lactuca sativa L.) minimamente processados','Salão Nobre','Welliton Fagner da Cruz'),
(21,'Apresentação de Pôsteres','2010-10-20',0,'15:00:00',1,'','Salão Nobre',''),
(22,'Apresentação Oral 7','2010-10-20',0,'15:30:00',1,'Avaliação de coberturas comestíveis na conservação pós-colheita de tomate in natura e almeirão minimamente processado','Salão Nobre','Miguel Meirelles de Oliveira'),
(23,'Apresentação Oral 8','2010-10-20',3,'16:00:00',1,'Avaliação da utilização de cloreto de cálcio e diferentes antioxidantes na manutenção da qualidade de yacon (Smallanthus sonchifolius) minimamente processado','Salão Nobre','Marcela Zonta Rodrigues'),
(24,'Apresentação Oral 9','2010-10-20',0,'16:30:00',1,'Substituição de hidrocolóides por soro de leite fluído enriquecido com lactulose na elaboração de apresuntados','Salão Nobre','Carolina Sperandio Gravina'),
(25,'Apresentação Oral 10','2010-10-20',0,'17:00:00',1,'Elaboração de salaminhos com substituição parcial da gordura suína por óleos vegetais','Salão Nobre','Andressa Cristina Gaione Mendes'),
(26,'Apresentação Oral 11','2010-10-20',0,'18:30:00',1,'Administração estratégica de estoques em micro e pequenas empresas do comércio em Rio Pomba-MG: um estudo exploratório sobre os softwares gratuitos gerenciadores de estoques','Salão Nobre','Danilo Oliveira Pierre'),
(27,'Palestra 3','2010-10-20',0,'19:00:00',1,'Desenvolvimento de Novos Produtos e a Importância Estratégica da Pesquisa Científica','Salão Nobre','Prof. Alexandre Ziviani (Diretor de Desenvolvimento Institucional Campus São João Del Rei)'),
(28,'Experiência Profissional 3','2010-10-20',0,'09:00:00',1,'Manejo de espécies de leguminosas em Cafezal sob Cultivo Orgânico','Salão Nobre','Profª. Tatiana Pires Barrella'),
(29,'Apresentação de Pôsteres','2010-10-20',0,'20:30:00',1,'','Salão Nobre',''),
(30,'Apresentação Oral 12','2010-10-20',0,'21:00:00',1,'Administração Estratégica de Estoques em Micro e Pequenas Empresas do Comércio em Rio Pomba, Minas Gerais: um Estudo Exploratório sobre as Necessidades e Fragilidades da Gestão de Estoque','Salão Nobre','Ademilson do Espírito Santo'),
(31,'Apresentação Oral 13','2010-10-20',0,'21:30:00',1,'O ensino de funções e geometria analítica no Campus Rio Pomba com o Software Winplot: uma análise do uso da informática na educação matemática','Salão Nobre','Gláucia Ananias da Silva'),
(32,'Apresentação Oral 14','2010-10-21',1,'07:30:00',1,'Desenvolvimento e caracterização de bebida láctea probiótica à base de extrato hidrossolúvel de soja e soro de leite','Salão Nobre','Renan Luís Emídio de Castro'),
(33,'Palestra 4','2010-10-21',1,'09:30:00',1,'O Papel dos comitês de ética na Pesquisa','Salão Nobre','Cheilon Caldeira Carmago e  Prof.  Robson Helen da Silva (Campus Barbacena)'),
(34,'Experiência Profissional 4','2010-10-20',0,'14:00:00',1,'Avaliação da viabilidade de utilização de micro-organismos probióticos em salada de fruta minimamente processada','Salão Nobre','Profª. Eliane M Furtado Martins'),
(35,'Apresentação Oral 15','2010-10-21',0,'08:00:00',1,'Elaboração de materiais técnicos e implantação de boas práticas agropecuárias (BPA) para a melhoria da qualidade do leite produzido no município de Rio Pomba, MG','Salão Nobre','Vítor Rubim Dias'),
(36,'Apresentação Oral 16','2010-10-21',0,'08:30:00',1,'Uso da análise multivariada na detecção de fraude de leite cru por adição de soro de leite','Salão Nobre','Viviane Correa Dias'),
(37,'Apresentação Oral 17','2010-10-21',0,'09:00:00',1,'Diagnóstico da cadeia produtiva dos queijos artesanais produzidos na microrregião de Rio Pomba, Minas Gerais','Salão Nobre','Daniela Cristina Faria Vieira'),
(38,'Apresentação Oral 18','2010-10-21',6,'11:00:00',1,'Desenvolvimento de embalagem ativa para utilização em queijo de leite de cabra tipo minas padrão','Salão Nobre','Tayara Bizotto Vieira'),
(39,'Palestra 5','2010-10-21',13,'13:00:00',1,'A Experiência de Abertura e Condução dos Cursos de Pós-Graduação da UFLA','Salão Nobre','Prof. Joel Augusto Munis (Ex-Pró-Reitor de Pós-Graduação UFLA)'),
(40,'Experiência Profissional 5','2010-10-20',0,'20:00:00',1,'Estudos primários de modelagem conceitual de banco de dados geográficos para segurança pública','Salão Nobre','Prof. João Paulo'),
(41,'Apresentação Oral 19','2010-10-21',1,'14:30:00',1,'Avaliação do efeito de medicamentos homeopáticos contra Staphylococcus aureus isolado de leite cru procedente do Setor de Zootecnia e de leite cru granelizado da região de Rio Pomba','Salão Nobre','Lázaro Oliveira Prates'),
(42,'Apresentação de Pôsteres','2010-10-21',0,'15:00:00',1,'','Salão Nobre',''),
(43,'Apresentação Oral 20','2010-10-21',0,'15:30:00',1,'Avaliação das características físico-químicas, microbiológicas, sensoriais e instrumentais de cor de amostras comerciais de doce de leite pastoso','Salão Nobre','Leandro Oliveira Joaquim'),
(44,'Apresentação Oral 21','2010-10-21',0,'16:00:00',1,'Adequação dos tanques comunitários do Município de Rio Pomba – MG à Instrução Normativa número 22, qualidade microbiológica do leite cru refrigerado granelizado e influência da atividade enzimática da microbiota psicrotrófica proteolítica sobre a qualidade de produtos lácteos fermentados','Salão Nobre','Vítor Ibrahim Brandão'),
(45,'Apresentação Oral 22','2010-10-21',0,'16:30:00',1,'Diagnóstico e melhoramento da qualidade do leite cru do IF/Campus Rio Pomba','Salão Nobre','Bruno Ricardo de Castro Leite Júnior'),
(46,'Apresentação Oral 23','2010-10-21',3,'17:00:00',1,'Caracterização e avaliação do potencial deteriorador dos isolados psicrotróficos da coleção de cultura do laboratório de microbiologia','Salão Nobre','Aline Pereira Martins'),
(47,'Apresentação Oral 24','2010-10-21',0,'18:30:30',1,'Equivalência e a matriz companheira P','Salão Nobre','Bruna da Silva Trindade'),
(48,'Experiência Profissional 7','2010-10-21',40,'14:00:00',1,'Avaliação do complexo de medicação ultra-diluída Fatores de Auto-Organização na infecção experimental por Leishmania chagasi em hamsters','Salão Nobre',' Silvio Leite Monteiro da Silva'),
(49,'Apresentação Oral 25','2010-10-21',0,'19:30:00',1,'Concorrência e estratégias de precificação no sistema agroindustrial do leite na região da Zona da Mata e Vertentes do Estado de Minas Gerais','Salão Nobre','Lidiane Aparecida da Silva'),
(50,'Experiência Profissional 8','2010-10-21',0,'19:00:00',1,'Aprendizado de Máquina Aplicado a Jogos Eletrônicos','Salão Nobre','Prof. Alex Fernandes da Veiga Machado'),
(51,'Apresentação de Pôsteres','2010-10-21',0,'20:30:00',1,'','Salão Nobre',''),
(52,'Apresentação Oral 26','2010-10-21',0,'21:00:00',1,'Implementação de uma pesquisa de orçamento familiar e índice de preço ao consumidor em Rio Pomba-MG','Salão Nobre','Jéssica do Vale Silva'),
(53,'Apresentação Oral 27','2010-10-22',25,'07:30:00',1,'Elaboração de bebida a base de extrato solúvel de soja extraído com soro de queijo acrescido de inulina','Salão Nobre','Glauciane de Oliveira Alves'),
(54,'Apresentação Oral 28','2010-10-22',27,'09:30:00',1,'Inserção de cultura ABT (Streptococcus thermophilus, Bifidobacterium longum e Lactobacillus acidophilus) na fabricação de queijo Minas Padrão','Salão Nobre','Karine de Almeida Marques'),
(55,'Palestra 6','2010-10-22',37,'08:00:00',1,'Experiência do Curso de Mestrado em Educação Agrícola da UFRRJ para a Rede e parceria com o Campus Rio Pomba para um Mestrado Associado','Salão Nobre','Profa Sandra Barros Sanchez- Coordenadora Substituta do Programa de Mestrado em Educação Agrícola - A CONFIRMAR'),
(56,'Experiência Profissional 9','2010-10-21',0,'20:00:00',1,'O Papel do Cientista Social nos Processos de licenciamento Ambiental','Salão Nobre','Prof. Marcelo Leles Romarco de Oliveira'),
(57,'Apresentação Oral 29','2010-10-22',14,'10:00:00',1,'Qualidade físico-química e sensorial de frutas e salada de frutas minimamente processadas adicionadas de agentes antioxidantes','Salão Nobre','Kamila Ferreira Chaves'),
(58,'Apresentação Oral 30','2010-10-22',14,'10:30:00',1,'Qualidade físico-química e sensorial de produtos elaborados com subprodutos do processamento de frutas','Salão Nobre','Rosineide da Paixão Ferreira'),
(59,'Apresentação Oral 31','2010-10-22',24,'11:00:00',1,'Efeito da concentração de polpas e aromas na aceitação sensorial de bebidas lácteas por mapa de preferência interno','Salão Nobre','Alan Franco Barbosa'),
(60,'Apresentação Oral 32','2010-10-22',25,'13:30:00',1,'Elaboração de uma pré-mistura para o desenvolvimento de produtos de panificação isenta de glúten enriquecido de fibras','Salão Nobre','Patrícia Rodrigues Condé'),
(61,'Experiência Profissional 10','2010-10-22',27,'09:00:00',1,'Mudança Organizacional: de Ginásio Agrícola à Instituição de Ensino Superior. O caso do Centro Federal de Educação Profissional e Tecnológica de Rio Pomba','Salão Nobre','Profª. Elisete Reis de Oliveira (Diretora-Geral Campus Muriaé)'),
(62,'Apresentação Oral 33','2010-10-22',26,'14:00:00',1,'Aproveitamento do resíduo sólido obtido na produção do extrato aquoso de soja no município de Rio Pomba','Salão Nobre','Diana Clara Nunes'),
(63,'Apresentação Oral 34','2010-10-22',29,'14:30:00',1,'Efeito da época de manejo e espécies de adubos verdes sobre cafezal em manejo orgânico','Salão Nobre','Rafael Monteiro de Oliveira'),
(64,'Apresentação Oral 35','2010-10-22',28,'15:30:00',1,'Desenvolvimento de um sistema de mecanização da compostagem para o IF/Campus Rio Pomba e avaliação do húmus produzido','Salão Nobre','Sthefani Gonçalves de Oliveira'),
(65,'Apresentação de Pôsteres','2010-10-22',0,'15:00:00',1,'','Salão Nobre',''),
(66,'Apresentação Oral 36','2010-10-22',39,'16:00:00',1,'Produção agroecológica do feijoeiro comum (Phaseolus vulgaris L.)','Salão Nobre','Phillip de Alcântara Garcia'),
(67,'Apresentação Oral 37','2010-10-22',14,'16:30:00',1,'Monitoria pedagógica: contribuições no processo de ensino-aprendizagem no IF Sudeste MG – Campus Rio Pomba','Salão Nobre','Lídia Maria Lima Ferreira'),
(68,'Almoço','2010-10-19',0,'11:00:00',2,'','',''),
(69,'Debate','2010-10-19',10,'20:00:00',2,'','Salão Nobre',''),
(70,'Almoço','2010-10-20',0,'11:30:00',1,'','',''),
(71,'Intervalo','2010-10-20',0,'17:30:00',1,'','',''),
(72,'Almoço','2010-10-21',0,'11:30:00',1,'','',''),
(73,'Intervalo','2010-10-21',0,'17:30:00',1,'','',''),
(74,'Almoço','2010-10-22',0,'11:30:00',1,'','',''),
(75,'Apresentação Oral TCC','2010-10-19',0,'20:00:00',1,'Investigação sobre a percepção dos alunos de curso técnico em agente comunitário da saúde pela física','Anfiteatro da Fundação','Márcia Aparecida Silva Zauza'),
(76,'Apresentação Pôsteres TCC','2010-10-19',0,'20:30:00',1,'','Anfiteatro da Fundação',''),
(77,'Experiência Profissional 11','2010-10-22',33,'13:00:00',1,'Avaliação físico-química, sensorial e instrumental de diferentes variedades de raízes de mandioca (Manihot esculenta Crantz) cultivadas na região Norte Fluminense - RJ','Salão Nobre','Simone Vilela Talma (Ex-aluna e Mestranda da Universidade Estadual Norte Fluminense)'),
(78,'Encerramento','2010-10-22',0,'17:00:00',1,'','Salão Nobre',''),
(79,'Experiência Profissional 6','2010-10-21',8,'10:30:00',1,'Estatística Aplicada à Indústria de Alimentos: uma experiência acadêmica','Salão Nobre','Adriana Dias  (Ex-aluna e Doutoranda da Universidade Federal de Lavras)'),
(80,'Credenciamento','2010-10-19',0,'07:00:00',1,'','Salão Nobre',''),
(81,'','0000-00-00',0,'00:00:00',0,'','','');
/*!40000 ALTER TABLE `sub_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_participante`
--

DROP TABLE IF EXISTS `tipo_participante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_participante` (
  `codigo_participante` int(11) NOT NULL AUTO_INCREMENT,
  `participante` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`codigo_participante`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_participante`
--

LOCK TABLES `tipo_participante` WRITE;
/*!40000 ALTER TABLE `tipo_participante` DISABLE KEYS */;
INSERT INTO `tipo_participante` VALUES
(1,'-----'),
(2,'Aluno'),
(3,'Ex-Aluno'),
(4,'Docente'),
(5,'Técnico Administrativo');
/*!40000 ALTER TABLE `tipo_participante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabalhos`
--

DROP TABLE IF EXISTS `trabalhos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trabalhos` (
  `cpf` varchar(11) NOT NULL DEFAULT '0',
  `arquivo` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `observacoes` varchar(250) DEFAULT NULL,
  `aprovado` char(3) CHARACTER SET latin1 DEFAULT NULL,
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `modalidade` int(11) NOT NULL DEFAULT '0',
  `titulo` varchar(100) NOT NULL DEFAULT '',
  `area` int(11) NOT NULL DEFAULT '0',
  `autor1` varchar(100) NOT NULL DEFAULT '',
  `autor2` varchar(100) DEFAULT NULL,
  `autor3` varchar(100) DEFAULT NULL,
  `autor4` varchar(100) DEFAULT NULL,
  `autor5` varchar(100) DEFAULT NULL,
  `autor6` varchar(100) DEFAULT NULL,
  `autor7` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabalhos`
--

LOCK TABLES `trabalhos` WRITE;
/*!40000 ALTER TABLE `trabalhos` DISABLE KEYS */;

/*!40000 ALTER TABLE `trabalhos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuario` varchar(20) NOT NULL DEFAULT '',
  `senha` varchar(20) NOT NULL DEFAULT '',
  `linha_pesquisa` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

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

-- Dump completed on 2023-12-21 11:37:38
