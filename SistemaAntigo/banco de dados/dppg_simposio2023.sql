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
-- Temporary table structure for view `ListaInscritos`
--

DROP TABLE IF EXISTS `ListaInscritos`;
/*!50001 DROP VIEW IF EXISTS `ListaInscritos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `ListaInscritos` AS SELECT
 1 AS `Evento`,
  1 AS `PALESTRANTE`,
  1 AS `CPF`,
  1 AS `NOME` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `Lista_Eventos_FULL`
--

DROP TABLE IF EXISTS `Lista_Eventos_FULL`;
/*!50001 DROP VIEW IF EXISTS `Lista_Eventos_FULL`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `Lista_Eventos_FULL` AS SELECT
 1 AS `nome_sub_evento`,
  1 AS `titulo`,
  1 AS `palestrante`,
  1 AS `cpf`,
  1 AS `nome` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `acervo`
--

DROP TABLE IF EXISTS `acervo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acervo` (
  `codigo_acervo` int(11) NOT NULL AUTO_INCREMENT,
  `arquivo` varchar(100) DEFAULT NULL,
  `palavra_chave` varchar(100) DEFAULT NULL,
  `titulo` varchar(300) DEFAULT NULL,
  `autores` varchar(200) DEFAULT NULL,
  `codigo_ano` int(11) DEFAULT NULL,
  `codigo_trab` int(11) NOT NULL,
  PRIMARY KEY (`codigo_acervo`),
  UNIQUE KEY `arquivo` (`arquivo`),
  KEY `codigo_ano` (`codigo_ano`),
  KEY `codigo_trab` (`codigo_trab`)
) ENGINE=MyISAM AUTO_INCREMENT=4265 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acervo`
--

LOCK TABLES `acervo` WRITE;
/*!40000 ALTER TABLE `acervo` DISABLE KEYS */;
INSERT INTO `acervo` VALUES
(198,'457451647_Artigo.pdf','coprodutos de biodiesel, ruminantes, silagem','Produção de gás das silagens de capim-elefante aditivadas com tortas de nabo forrageiro, pinhão manso e tremoço','Arnaldo Prata Neiva Júnior, José Cleto da Silva Filho, Valdir Botega Tavares, Edílson Rezende Cappelle, José Cardoso Pinto',4,0),
(199,'63590162_Artigo.pdf','Física do solo, efluentes, estrutura do solo.','Dispersão da argila do Latossolo Vermelho-Amarelo provocada pelo uso de águas residuárias da bovino, suíno e cunicultura.','Bruno Grossi Costa Homem, Onofre Barroca de Almeida Neto, Rafael da Silva Santana, João Eudes Ribeiro Brandão, Gustavo Henrique de Souza, Marcos Luiz Rebolças Bastiani ',4,0),
(197,'270035009_Artigo.pdf','proeja','“MUDANÇAS CLIMÁTICAS, DESASTRES NATURAIS SUSTENTÁVEL” RISCOS” “CIÊNCIA PARA O DESENVOLVIMENTO E PREVENÇÃO DE RISCOS. A concepção e a elaboração de material didático de Física no PROEJA','MOTA, Eduardo dos Anjos',4,0),
(196,'1070884429_Artigo.pdf','Municípios. Descentralização fiscal. Despesas públicas.','Destinação de recursos nos municípios da Zona da Mata de Minas Gerais: uma avaliação das despesas orçamentárias','Ariane de Oliveira FIALHO; Bruna Rodrigues de FREITAS; Charles Okama de SOUZA.',4,0),
(195,'2049115150_Artigo.pdf','leite, contaminantes, tratamento térmico.','CARACTERÍSTICAS MICROBIOLÓGICAS E FÍSICO-QUÍMICAS DE LEITE UHT COMERCIALIZADO NO MUNICÍPIO DE RIO POMBA-MG','Luana Virgínia SOUZA; Franklin Júnior Moreira da SILVA; Maurilio Lopes MARTINS',4,0),
(194,'455566866_Artigo.pdf','Processamento mínimo, deterioração, boas práticas de fabricação, temperatura.','AVALIAÇÃO DA ATIVIDADE DE BACTÉRIA GRAM-POSITIVA, MESOFÍLICA, AMINOLÍTICA ISOLADA DE POLPA DE FRUTA SOBRE AS CARACTERÍSTICAS FÍSICO-QUÍMICAS E DE TEXTURA DE MELÃO MINIMAMENTE PROCESSADO','Patrícia Martins de OLIVEIRA; Bruno Ricardo de Castro LEITE JÚNIOR; Cinthia Marotta FERNANDES; Maurilio Lopes MARTINS; Eliane Maurício Furtado MARTINS',4,0),
(193,'1466275883_Artigo.pdf','Gerenciamento de Resíduos Sólidos. Aterro Sanitário Controlado. Município de de Campo Belo - MG.','ATERRO SANITÁRIO CONTROLADO E CATADORES DE MATERIAIS RECICLÁVEIS: UMA RELAÇÃODE SUSTENTABILIDADE NO GERENCIAMENTO DOS RESÍDUOS SÓLIDOS DO MUNICÍPIO DE CAMPO BELO-MG','Bruno Silva OLHER; Maria Luz D’Alma Reis OLHER; Andréia Aparecida ALBINO',4,0),
(192,'1341296157_Artigo.pdf','            demanda bioquímica de oxigênio, sólidos totais, efluente industrial.','CARACTERIZAÇÃO DO EFLUENTE DE UMA INDÚSTRIA DE FRUTAS LOCALIZADA EM VISCONDE DO RIO BRANCO - MG','CHAVES, Rosilene Ferreira; CHAVES, Kamila Ferreira; SILVA, Vanessa Riani Olmi',4,0),
(191,'1266226815_Artigo.pdf','Gestão da qualidade. Indústrias queijeiras. Rendimento operacional.','GESTÃO DA QUALIDADE COMO ESTRATÉGIA PARA MELHORIAS NO RENDIMENTO OPERACIONAL DE INDÚSTRIAS QUEIJEIRAS','Luiz Célio Souza ROCHA; Jéssica Fernandes CARVALHAIS; Maurílio Lopes MARTINS',4,0),
(190,'1902073460_Artigo.pdf','Basidiocarpo, distribuição sazonal, ectomicorrizas','DISTRIBUIÇÃO SAZONAL: Pisolithus sp. E Scleroderma sp.  ASSOCIADAS A PLANTAÇÕES DE Eucalyptus urograndis','ABREU, Vanessa Pereira de ; MARTINS, Gustavo Sampaio de Lima; CAMPOS, André Narvaes da Rocha',4,0),
(189,'2098078007_Artigo.pdf','Representações Sociais, Tecnologias da Informação e Comunicação, Educação.',' AS REPRESENTAÇÕES SOCIAIS DAS TECNOLOGIAS DA INFORMAÇÃO E COMUNICAÇÃO NA EDUCAÇÃO PARA OS  DOCENTES E DISCENTES DO IF SUDESTE MG – CAMPUS                    RIO POMBA','BERNARDINO, Fernanda Amaral; NAIFF, Denis Giovani Monteiro.',4,0),
(188,'301161409_Artigo.pdf','Editor de Texto. Computação em Nuvem. Banco de Dados. Indústria de Softwares. Engenharia de Software','IMPLEMENTAÇÃO DE UM SISTEMA DE EDIÇÃO DE TEXTOS DIGITAIS: UMA ABORDAGEM DE ARMAZENAMENTO EM NUVEM','Jonas de Paiva POTROS; Mateus Fontes LOURENÇO; Roberto Martins Soares NETO; Yuri Pereira ANDRADE; Wellington Moreira de OLIVEIRA',4,0),
(187,'500486144_Artigo.pdf','Jogo Educativo. Lógica de Programação. Algoritmo. Fluxograma.','UMA NOVA FERRAMENTA PARA O APOIO AO ENSINO DE LÓGICA DE  PROGRAMAÇÃO NA MODALIDADE PRESENCIAL E A DISTÂNCIA','Alex MACHADO; Ana M.O. FIGUEIREDO; Lidson B. JACOBI; Paôla P. CAZETTA; Priscyla C. SANTOS;',4,0),
(186,'1096147527_Artigo.pdf','Coffea arabica, Dolichos lab-lab, Canavalia ensiformis, período de consorciação.','EFEITO DE ESPÉCIES E ÉPOCAS DE MANEJO DE LEGUMINOSAS SOBRE A MASSA E A SIMILARIDADE DA FLORA DE PLANTAS ESPONTÂNEAS EM UM CAFEZAL SOBRE MANEJO ORGÂNICO','Bianca de Jesus SOUZA; Tatiana Pires BARRELLA; Ariany das Graças TEIXEIRA; Lucas Luis FAUSTINO; Francisco Cezar GONÇALVES; Rafael Monteiro de OLIVEIRA; Ricardo Henrique Silva SANTOS',4,0),
(184,'1583746478_Artigo.pdf','Consórcio, tomate, plantas companheiras.','EFEITOS DE PLANTAS COMPANHEIRAS NA CULTURA DO TOMATE CEREJA (Lycopersicum esculentum)','Joara Secchi CANDIAN; Marcos Luiz R. BASTIANI; Antônio Daniel F. COELHO',4,0),
(185,'2034027965_Artigo.pdf','basidiósporos; ectomicorrizas; inoculação.','OTIMIZAÇÃO DA INOCULAÇÃO DE MUDAS DE EUCALIPTO COM ESPOROS DE Pisolithus microcarpus.','GUILHERME, Sérgio Flávio; ABREU, Vanessa Pereira de; CAMPOS, André Narvaes da Rocha',4,0),
(183,'1345574693_Artigo.pdf','higienização, micro-organismos, alimentação.','CARACTERIZAÇÃO MICROBIOLÓGICA DE AMBIENTES EM UMA ESCOLA DO MUNICÍPIO DE RIO POMBA – MINAS GERAIS','Thamiris da Rocha DANIEL; Franklin Júnior Moreira da SILVA; Cínthia, Marotta FERNANDES, Aurélia Dornelas de Oliveira MARTINS; Eliane Maurício Furtado; Maurílio Lopes MARTINS',4,0),
(182,'1579291486_Artigo.pdf','Repolho. Plantas de cobertura. Plantio direto. Plantas espontâneas.','PRODUÇÃO DE FITOMASSA DE PLANTAS DE COBERTURA DE VERÃO E CULTIVO DO REPOLHO, EM SISTEMA DE PLANTIO DIRETO','Lucas Ferenzini ALVES; Marcos Luiz Rebouças BASTIANI; Vinicius Candian MARQUES; Silvane de Almeida CAMPOS; Sthefani Gonçalves de OLIVEIRA; Antônio Daniel Fernandes COELHO',4,0),
(181,'822150434_Artigo.pdf','Microbiologia do solo; respiração total do solo; indicadores de qualidade do solo','MONITORAMENTO DA QUALIDADE BIOLÓGICA DO SOLO POR MEIO DA RESPIRAÇÃO TOTAL DO SOLO EM RIO POMBA/MG.','OLIVEIRA, Joel Marques de; MARTINS, Gustavo Sampaio de Lima; CAMPOS, André Narvaes da Rocha',4,0),
(180,'286568942_Artigo.pdf','Inhame, maracujá, suco de fruta.','CARACTERÍSTICAS FÍSICO-QUÍMICAS E MICROBIOLÓGICAS DE SUCO MISTO DE INHAME E MARACUJÁ','COSTA, Jéssyca Aparecida Roberto; MELONI, Vinícius Àlvares da Silva; PEREIRA, Danielle Cunha de Souza; LAMAS, Joaquim Mário Neiva; MARTINS, Eliane Maurício Furtado ; MARTINS, Maurilio',4,0),
(179,'808468494_Artigo.pdf','Agroecologia, Camapu, Solanaceae, Joá-de-Capote.','Estudo da fenologia de Physalis sp. na região da Zona da Mata Mineira.','Natália de BRITO LIMA LANNA; Junio MAGALHÃES PEREIRA; José Olívio LOPES VIEIRA JÚNIOR; Renata CUNHA PEREIRA; Carlos MIRANDA CARVALHO',4,0),
(178,'1268610185_Artigo.pdf','plantas, antimicrobianos naturais, indústria de alimentos.','INIBIÇÃO BACTERIANA POR EXTRATOS DE PLANTAS NATIVAS E CONDIMENTARES','Franklin Júnior Moreira da SILVA; Rodrigo Oliveira MADEIRA ; Maurilio Lopes MARTINS',4,0),
(177,'766402142_Artigo.pdf','Potras, lisina, aditivo alimentar, desenvolvimento, ganho de peso.','UTILIZAÇÃO DE ADITIVOS ALIMENTARES EM POTRAS MANGALARGA MARCHADOR','Paulo César Santos OLIVEIRA; Cristiano Gonzaga JAYME; Marciana Teixeira de SOUZA; Juliana Ferreira ROCHA; Edílson Rezende CAPPELLE; Gustavo Henrique de SOUZA',4,0),
(176,'1169940881_Artigo.pdf','controle de qualidade; lista de checagem.','Avaliação de Boas Práticas Fabricação em um Pequeno La-            ticínio da cidade de Rio Pomba, MG','PEREIRA, Danielle Cunha de Souza; QUINTÃO, Cinthia Soares Cardoso; SILVÉRIO, Aline de Fátima; REIS, Marilândia Rafaela de Ramos; MARTINS, Aurélia Dornelas de Oliveira',4,0),
(175,'2061331277_Artigo.pdf','Mata Ciliar, Recuperação Ambiental, Área de Preservação Permanente.','EFETIVAÇÃO DA ÁREA DE PRESERVAÇÃO PERMANENTE NO SETOR DA NASCENTE DO CAMPUS RIO POMBA DO IFET SUDESTE DE MINAS','Rodrigo OLIVEIRA; Samuel FIALHO; Maria Dalva TRIVELLATO; João Batista CORRÊA',4,0),
(174,'1484574683_Artigo.pdf','Desenvolvimento de produtos, Bebidas, soro de leite','DESENVOLVIMENTO DE BEBIDA A PARTIR DE SORO DE RICOTA COM SABORES DE LARANJA E DE MARACUJÁ','Vinícius Alvares da Silva MELONI; Lázaro Oliveira PRATES ; Joaquim Mário Neiva LAMAS; Maurilio Lopes MARTINS; Eliane Maurício Furtado MARTINS.*',4,0),
(173,'1865691273_Artigo.pdf','Plantas de cobertura. Fitomassa. Cobertura do solo. Plantas espontâneas.','DESEMPENHO DE PLANTAS DE COBERTURA EM SISTEMAS DE PRODUÇÃO AGROECOLÓGICOS, NA REGIÃO SUDESTE DE MINAS GERAIS: COBERTURAS DE INVERNO','Vinicius Candian MARQUES; Marcos Luiz Rebouças BASTIANI; Silvane de Almeida CAMPOS; Antônio Daniel Coelho; Lucas Ferenzini ALVES; Rodrigo de Paula FERREIRA',4,0),
(171,'229124789_Artigo.pdf','Atividade investigativa. Aprendizagem significativa. Logaritmo. Ensino médio.','APRENDENDO LOGARITMO POR MEIO DE INVESTIGAÇÃO','Marcos COUTINHO MOTA; Simone DE ALMEIDA LIMA; Silmara LOPES DE OLIVEIRA; Paula REIS DE MIRANDA.',4,0),
(172,'30024180_Artigo.pdf','Escherichia coli, toxina Shiga, efeito citotóxico, células vero.','ANÁLISE DO POTENCIAL CITOTÓXICO DE Escherichia coli POTENCIALMENTE SHIGA-TOXIGÊNICA','Bruno Ricardo de Castro LEITE JUNIOR; Patrícia Martins de OLIVEIRA; Franklin Júnior Moreira da SILVA; Maurilio Lopes MARTINS; Andressa Pinheiro GOMES; Miriam Teresinha dos SANTOS; Célia Alencar de MOR',4,0),
(170,'122035306_Artigo.pdf','Ricota. Físico-química. Análise.','AVALIAÇÃO DA COMPOSIÇÃO FÍSICO-QUÍMICA DE AMOSTRAS DE RICOTAS COMERCIALIZADAS EM RIO POMBA E JUIZ DE FORA, MINAS GERAIS.','Leandro OLIVEIRA JOAQUIM; Jonh WARNENS; Maurício HENRIQUES LOUZADA SILVA; Bruno GAUDERETO SOARES; José MANOEL MARTINS',4,0),
(169,'1746742857_Artigo.pdf','caldas; microrganismos; respiração.','RESPIRAÇÃO DO SOLO SUBMETIDO À DIFERENTES CALDAS ALTERNATIVAS','TEIXEIRA, Fabrício Palla; SAMPAIO, Gustavo Martins de Lima; BENEVENUTO, Renata Bonfá; CAMPOS, André Narvaes da Rocha',4,0),
(168,'320089537_Artigo.pdf','teste cego; aceitação; marcas.','ACEITABILIDADE SENSORIAL DE CHOCOLATE BRANCO E AVALIAÇÃO DO CONSUMO DE  CHOCOLATE ENTRE ADOLESCENTES E ADULTOS NO CAMPUS RIO POMBA','Cínthia Marotta FERNANDES , Mônica Santana MOREIRA , Raquel Ferreira GROSSI ; Eliane Maurício Furtado MARTINS.',4,0),
(167,'510445392_Artigo.pdf','calculo diferencial','INTRODUÇÃO AO CÁLCULO DIFERENCIAL E INTEGRAL','VILELA, Elisa de Paula; CARVALHO, Marcos Pavani',4,0),
(166,'903071123_Artigo.pdf','aceitação; preparo de café; artesanal; industrializado.','ANÁLISE SENSORIAL DE CAFÉS EXTRAÍDOS DE           DIFERENTES FORMAS','Thamiris da Rocha DANIEL; Ana Carolina TRINDADE; Janaína Aparecida Soares VALENTE; Eliane Maurício Furtado MARTINS',4,0),
(165,'1705863642_Artigo.pdf','DQO, efluente, laticínio.','COMPARAÇÃO DE METODOLOGIAS PADRÕES PARA ANÁLISE DE DEMANDA QUÍMICA DE OXIGÊNIO DE EFLUENTES DE UMA INDÚSTRIA DE LATICÍNIOS','Kamila Ferreira CHAVES; Rosilene Ferreira CHAVES; Vanessa Riani Olmi SILVA',4,0),
(163,'1895404236_Artigo.pdf','Potras, lisina, aditivo alimentar, desenvolvimento, ganho de peso.','UTILIZAÇÃO DE ADITIVOS ALIMENTARES EM POTRAS MANGALARGA MARCHADOR','Juliana Ferreira ROCHA; Cristiano Gonzaga JAYME; Paulo César Santos OLIVEIRA; Marciana Teixeira de SOUZA; Edílson Rezende CAPPELLE; Gustavo Henrique de SOUZA; ',4,0),
(164,'199074362_Artigo.pdf',' Fosfato de rocha, inoculação, ectomicorrizas.','INOCULAÇÃO COM ESPOROS DE Pisolithus microcarpus E ADIÇÃO DE   FOSFATO NATURAL PARA PRODUÇÃO DE MUDAS DE Eucalyptus                         grandis.','Vanessa Pereira de ABREU; Ana Catarina Monteiro Carvalho Mori da CUNHA; André Narvaes da Rocha CAMPOS',4,0),
(162,'1881825758_Artigo.pdf','okara, secagem, farinha.','Secagem do resíduo sólido obtido da extração aquosa da soja para produção da farinha de okara','BEM, Gabriel Siqueira; BARBOSA, Arielle Fontes; QUEIROZ, Isabela Campelo.',4,0),
(161,'285447553_Artigo.pdf','Nivelamento do jogo, aprendizagem de máquina, m5p, top culling.','BALANCEAMENTO DINÂMICO DA DIFICULDADE EM JOGOS DE ESTRATÉGIA ATRAVÉS DA ADAPTAÇÃO DO JOGADOR USANDO O TOP CULLING','Wenderson Cirilo Silva de Paula, Alex Fernandes da Veiga Machado Esteban Walter Gonzalez Clua',4,0),
(160,'386341336_Artigo.pdf','coprodutos de biodiesel, ruminantes, silagem','Degradabilidade das silagens de capim-elefante aditivadas com tortas de nabo forrageiro, pinhão manso e tremoço','Arnaldo Prata Neiva Júnior, José Cleto da Silva Filho, Valdir Botega Tavares, José Cardoso Pinto, Edílson Rezende Cappelle',4,0),
(159,'274663420_Artigo.pdf','Farinha de arroz, fécula de batata, amido de milho, polvilho, bolo.','DESENVOLVIMENTO, ANÁLISE REOLÓGICAS E SENSORIAL DE BOLOS SEM GLÚTEN','Lorrani do Carmo TEIXEIRA; Arielle Fontes BARBOSA; Vanessa Riani Olmi SILVA, Isabela Campelo DE QUEIROZ ',4,0),
(158,'1887452997_Artigo.pdf','Escherichia coli, toxina Shiga, virulência.',' IDENTIFICAÇÃO GENOTÍPICA DE Escherichia coli PRODUTORA DE TOXINA SHIGA (STEC) PELA DETECÇÃO DOS GENES stx1/stx2 E hlyA','Bruno Ricardo de Castro LEITE JUNIOR; Patrícia Martins de OLIVEIRA; Franklin Júnior Moreira da SILVA; Maurilio Lopes MARTINS; Andressa Pinheiro GOMES; Miriam Teresinha dos SANTOS; Célia Alencar de M',4,0),
(157,'1045750484_Artigo.pdf',' Patogenesia. Dinamização. Altas diluições. Água.','EXPERIMENTAÇÃO PATOGENÉSICA DE Natrum muriaticum EM ÁGUA','Silvane de Almeida CAMPOS; Fernanda M. Coutinho de ANDRADE; Paulo Roberto M. de ARAÚJO; Laura Júlia da C. MENDONÇA; Matheus Barbosa da S. ROCHA; Débora Nery PESSAMIGLIO',4,0),
(156,'1635016280_Artigo.pdf','Jogo Educacional, Ambiente Colaborativo, 3D.','UMA PROPOSTA DE JOGO EDUCACIONAL 3D COM QUESTÕES DIDÁTICAS','Ana M.O. FIGUEIREDO; Josué F. LELES; Leandro dos S.SANT’ANA; Nilson A. da S. JUNIOR; Paôla P. CAZETTA; Priscyla C. SANTOS; SebastiãoSebastião de F. E. ',4,0),
(155,'295196617_Artigo.pdf','Atividade microbiana, Respiração basal do solo, Bioindicadores da qualidade do solo.','UTILIZAÇÃO DE INDICADORES DA ATIVIDADE MICROBIANA DO SOLO PARA MONITORAMENTO DE SISTEMAS AGRÍCOLAS DE PRODUÇÃO EM RIO POMBA-MG.','Gustavo Sampaio de Lima MARTINS; Vanessa Pereira de ABREU; André Narvaes da Rocha CAMPOS.',4,0),
(154,'10300374_Artigo.pdf','Inadimplência. Entraves Financeiros. Proteção ao crédito.','INADIMPLÊNCIA EMPRESARIAL: AS DIFICULDADES DAS ORGANIZAÇÕES DE RIO POMBA E REGIÃO NESTE ENTRAVE FINANCEIRO. OS MELHORES MÉTODOS A SEREM ADOTADOS PARA EVITAR ESTE TIPO DE CONSTRANGIMENTO.','Daniela MATTOS; João Paulo BAPTISTA; Henri CÓCARO',4,0),
(153,'296780206_Artigo.pdf','lanche; adolescência; nutrição.','CONSUMO DE LANCHES ENTRE ADOLESCENTES DE UMA INSTITUIÇÃO PÚBLICA DE ENSINO','CÓCARO, Elaine Souza',4,0),
(151,'23030557_Artigo.pdf','Fatores de Auto-organização; Suínos, Animais, Ganho de peso vivo','COMPARAÇÃO ENTRE PERFIS DO MÉTODO ARCHEUS PARA SUÍNOS','Angelo Herbet Moreira ARCANJO; Lucas da Rocha PINTO; Gabriel Pinto ROSA; Gustavo Henrique de SOUZA; Silvio Leite MONTEIRO DA SILVA',4,0),
(152,'1408273528_Artigo.pdf','Administração Pública, terceirização, reformado do estado.','OS EFEITOS DA TERCEIRIZAÇÃO NA ADMINISTRAÇÃO PÚBLICA','Bruno Silva Olher; Francimar Natália Silva Cruz Reis; Andreia Aparecida Albino; Jéssica Silva Fidélis;',4,0),
(150,'437813242_Artigo.pdf','Alimentos de origem animal, micro-organismos indicadores, patógenos alimentares.','QUALIDADE MICROBIOLÓGICA DE LEITE PASTEURIZADO, QUEIJO MINAS FRESCAL E CARNE MOÍDA BOVINA COMERCIALIZADOS EM RIO POMBA E CIDADES CIRCOVIZINHAS','Patrícia Martins de OLIVEIRA; Bruno Ricardo de Castro LEITE JÚNIOR; Franklin Júnior Moreira da SILVA; Maurilio Lopes MARTINS',4,0),
(149,'633813160_Artigo.pdf','Pequenas e Médias empresas. Responsabilidade Social Corporativa. Marketing Social.','ESTUDO SOBRE RESPONSABILIDADE SOCIAL CORPORATIVA E MARKETING SOCIAL ENTRE AS 250 PMEs QUE MAIS CRESCEM NO BRASIL','Andréia ALBINO; Bruno Silva OLHER; Dany Lee Fernandes da Veiga MACHADO; Géssica Vilela de OLIVEIRA; Vanessa de Oliveira SILVA; Afonso Augusto Teixeira de Freitas de Carvalho LIMA',4,0),
(148,'515707246_Artigo.pdf','Palmeira juçara, FMA, mata atlântica.','IDENTIFICAÇÃO DE ESPOROS DE FUNGOS MICORRÍZICOS ARBUSCULARES NA RIZOSFERA DE Euterpe edulis','ALVES, Rafael Cocate; FAUSTINO, Lucas Luís; MEDINA, Juliana Martins; CAMPOS, André Narvaes da Rocha; MARTINS, Maurílio Lopes',4,0),
(147,'1437606955_Artigo.pdf','hidrolisado hemicelulósico, xilitol, Candida guilliermondii ','Caracterização da matriz lignocelulósica e do hidrolisado hemicelulósico de biomassa de sorgo forrageiro visando seu aproveitamento em bioprocessos','VARIZ ,Daniela Inês Loreto Saraiva ; RODRIGUES Rita de Cássia Lacerda Brambilla; BATISTA, Raquel de Almeida; FELIPE, Maria das Graças de Almeida',4,0),
(146,'1591463856_Artigo.pdf','Plantas de cobertura. Fitomassa. Cobertura do solo. Plantas espontâneas.','PLANTAS DE COBERTURA DO SOLO: PRODUÇÃO DE BIOMASSA NO VERÃO E SUPRESSÃO DE PLANTAS ESPONTÂNEAS','Silvane de Almeida CAMPOS; Marcos Luiz Rebouças BASTIANI; Vinicius Candian MARQUES; Lucas Ferenzini ALVES; Sthefani Gonçalves de OLIVEIRA',4,0),
(144,'87240368_Artigo.pdf','Proeja; Prática Docente; Capacitação de professores.','A CAPACITAÇÃO E A PRÁTICA DOCENTE NO PROEJA FIC –CAMPUS MURIAÉ.','MOTA, Renata Silva Lima',4,0),
(145,'781099431_Artigo.pdf','Rio Pomba; fábricas moveleiras; INTERSIND.','AGLOMERADOS PRODUTIVOS EM MINAS GERAIS–UM ESTUDO DE CASO DAS FÁBRICAS DE MÓVEIS NO POLO MOVELEIRO DE UBÁ','Nívea Soares COSTA; Wildson Justiniano PINTO ',4,0),
(143,'1336746264_Artigo.pdf','Material didático; Ensino de física; PROEJA.','A CONCEPÇÃO E A ELABORAÇÃO DE MATERIAL DIDÁTICO DE FÍSICA NO PROEJA','MOTA, Eduardo dos Anjos',4,0),
(142,'206764778_Artigo.pdf','Mata Ciliar, Recuperação Ambiental, Área de Preservação Permanente.','EFETIVAÇÃO DA ÁREA DE PRESERVAÇÃO PERMANENTE NO SETOR DA NASCENTE DO CAMPUS RIO POMBA DO IFET SUDESTE DE MINAS','Rodrigo OLIVEIRA; Samuel FIALHO; Maria Dalva TRIVELLATO; João Batista CORRÊA',4,0),
(141,'365236317_Artigo.pdf','chave: qualidade, características física, soja, resíduo','Avaliação da textura e do volume específico de três formulações de bolo com diferentes concentrações de “okara”','BARBOSA , Arielle Fontes; QUEIROZ, Isabela Campelo de; MENDES, Andressa Cristina Gaione; TEIXEIRA, Lorrani do Carmo; MARTINS, Eliane Maurício Furtado',4,0),
(140,'1526123249_Artigo.pdf','Contabilidade Gerencial; Gerenciamento; Micro, pequenas e médias empresas.','CONTABILIDADE GERENCIAL COMO FERRAMENTA PARA OS GESTORES NO DESENVOLVIMENTO DAS PEQUENAS E MÉDIAS CONFECÇÕES DO MUNICÍPIO DE RIO POMBA-MG','Nathan de Melo MOREIRA; Fátima Landim SOUZA',4,0),
(139,'1140995248_Artigo.pdf','Leite. Queijos. Bactérias psicrotróficas. Implicações tecnológicas.','AVALIAÇÃO DA ATIVIDADE DETERIORADORA DA MICROBIOTA PSICOTRÓFICA DO LEITE CRU GRANELIZADO DA REGIÃO DE RIO  POMBA-MG SOBRE O RENDIMENTO DE PRODUÇÃO DE QUEIJO MINAS PADRÃO','Jéssica Fernandes CARVALHAIS; Leandro Jader dos SANTOS; Maurilio Lopes MARTINS; Aurélia Dornelas de Oliveira MARTINS; José Manoel MARTINS; Cláudia Lúcia de Oliveira PINTO',4,0),
(138,'564646936_Artigo.pdf','FMAs, leguminosa, adubos verdes.','POTENCIAL DE INÓCULO DO SOLO COM DIFERENTES OCUPAÇÕES NO CAMPUS RIO POMBA DO IF SUDESTE MG E AVALIAÇÃO DA MULTIPLICAÇÃO DE ESPOROS DE FMAS POR CANAVALIA ENSIFORMES E CAJANUS CAJAN.','Régis Josué de Andrade REIS; André Narvaes da Rocha CAMPOS',4,0),
(137,'1636083299_Artigo.pdf','Novos produtos; Probióticos; Simbióticos.','Resumo - Avaliação de aroma e textura de diferentes sabores de  sorvete frozen yogurt à base de yacon (Smallanthus   sonchifolius) fermentado por Lactobacillus casei','BRANDÃO, Vitor Ibrahim; LEITE JÚNIOR, Bruno Ricardo de Castro; OLIVEIRA, Patrícia Martins de; RODRIGUES, Marcela Zonta; MARTINS, Eliane Mauricio Furtado; SILVA, Roselir Ribeiro da',3,0),
(136,'1871107604_Artigo.pdf','físico-química; microbiológica; sensorial.','Resumo - APROVEITAMENTO DA CASCA DE BANANA NA FABRICAÇÃO DE DOCE E BOLO','FERREIRA, Rosineide da Paixão ; MARQUES, Karine de Almeida ; SILVA, Vanessa Riani Olmi ; SILVA, Maurício Henriques Louzada ; MARTINS, Eliane ',3,0),
(135,'1561450332_Artigo.pdf','Pesquisa de mercado; repositores hidroeletrolíticos; atletas.','Resumo - COMPARATIVO SOBRE O CONHECIMENTO DE BEBIDAS ISOTÔNICAS ENTRE PRATICANTES E NÃO PRATICANTES DE ATIVIDADE FÍSICA DA REGIÃO DA ZONA DA MATA DE MINAS GERAIS','OLIVEIRA, Patrícia Martins de; LEITE JÚNIOR, Bruno Ricardo de Castro; OLIVEIRA, Allan Costa de; REIS, Marilândia Rafaela de Ramos; ANDRADE, Sheila de; SILVA, Roselir Ribeiro da',3,0),
(134,'800963548_Artigo.pdf','Novos Produtos; prebióticos; aceitação.','Resumo -  Análise sensorial de diferentes sabores de sorvete frozen yogurt à base de yacon (Smallanthus sonchifolius) fermentado por Streptococcus salivarius subsp. thermophilus e Lactobacillus delbrueckii subsp. bulgaricus','OLIVEIRA, Patrícia Martins de; LEITE JÚNIOR, Bruno Ricardo de Castro; RODRIGUES, Marcela Zonta; BRANDÃO, Vitor Ibrahim; MARTINS, Eliane Mauricio Furtado; SILVA, Roselir Ribeiro da',3,0),
(133,'139652901_Artigo.pdf','semente de palmeira','Resumo - ESTUDO DE DIFERENTES TIPOS DE SUBSTRATOS PARA A GERMINAÇÃO DE SEMENTES DA PALMEIRA JUÇARA (Euterpe edulis Martius).','ALUNO, Davidson dos Santos Martins; Francisco César Gonçalves, Juliana Loureiro de Almeida Campos',3,0),
(131,'1395481489_Artigo.pdf','leite cru','Resumo - FORMAÇÃO DE BIOFILME POR BACTÉRIAS PSICROTRÓFICAS ISOLADAS DE LEITE CRU GRANELIZADO','MARTINS, Aline Pereira ; MARTINS, Maurilio Lopes',3,0),
(132,'1659417609_Artigo.pdf','soro de leite','Resumo - CARACTERIZAÇÃO FÍSICO-QUÍMICA E SENSORIAL DE SOBREMESA LÁCTEA À BASE DE MANGA E SORO DE LEITE','Daniela Cristina Faria VIEIRA; Patrícia Rodrigues CONDÉ; Ana Sílvia Boroni de OLIVEIRA; Cleuber Antônio de Sá SILVA; Eliane Maurício Furtado MARTINS ; Vanessa Riani Olmi SILVA',3,0),
(130,'1443306669_Artigo.pdf','Frutas. Rusticidade. Edafoclimáticas.','ESTUDO DA FENOLOGIA DA PHYSALIS SP. NA REGIÃO DA ZONA DA MATA MINEIRA','John Henrique Souza LOPES; Carlos Miranda CARVALHO; Matheus Barbosa da Silva ROCHA; Natália de Brito LANNA',3,0),
(129,'1167125284_Artigo.pdf','Banana in natura. Conservação. Cobertura comestível.','AVALIAÇÃO DE COBERTURAS COMESTÍVEIS NA CONSERVAÇÃO DE BANANA IN NATURA','Miguel Meirelles de OLIVEIRA; Wanessa Oliveira GOMES; Eliane Maurício Furtado MARTINS; Isabela Campelo de QUEIROZ; Vanessa Riani Olmi SILVA; Elisabete FANTUZZI',3,0),
(127,'1812664218_Artigo.pdf','Engenharia de Software. Processo de Software. Modelagem de Software. ','ESSÊNCIA E ACIDENTES DA ENGENHARIA DE SOFTWARE','Wellington Moreira de OLIVEIRA; Raphael Barbosa da Silva ROCHA.',3,0),
(128,'1447511488_Artigo.pdf','Processamento mínimo. Alimentos funcionais. Probióticos.','ALFACE MINIMAMENTE PROCESSADA ENRIQUECIDA COM LACTOBACILLUS PARACASEI','Welliton Fagner da CRUZ; Kamila Ferreira CHAVES; Eliane Maurício Furtado MARTINS; Maurílio Lopes MARTINS',3,0),
(126,'1003900725_Artigo.pdf','Fraude. Soro. Leite.','USO DA ANÁLISE MULTIVARIADA NA DETECÇÃO DE FRAUDE DE LEITE CRU POR ADIÇÃO DE SORO DE LEITE','DIAS, V. C.; PINTO, R. T.; MARTINS, J. M.; RAMOS, A. L. S.; FONTES, E. A. F.; SILVA, R. A. G.',3,0),
(125,'152715062_Artigo.pdf','Psicrotróficos. Leite. Enzimas deterioradoras.','INFLUÊNCIA DA ATIVIDADE PROTEOLÍTICA DE BACTÉRIA PSICROTRÓFICA NA QUALIDADE DE IOGURTE TIPO LÍQUIDO, BATIDO E SUNDAE','Vitor Ibrahim BRANDÃO; Marcela Zonta RODRGUES; Bruno Ricardo de Castro LEITE JUNIOR; Maurilio Lopes MARTINS; Cláudia Lúcia de Oliveira PINTO.',3,0),
(124,'687895140_Artigo.pdf','Micorrizas, Pisolithus microcarpus, Recuperação de áreas degradadas, Esporos, inoculantes','PESO SECO E MICORRIZAÇÃO EM MUDAS DE Eucalyptus citriodora INOCULADAS COM ESPOROS DE Pisolithus microcarpus','Vanessa Pereira de ABREU; Joara Secchi CANDIAN; Fabrício Palla TEIXEIRA ;Mauro César MARTINS; André Narvaes da Rocha CAMPOS;',3,0),
(123,'1562117558_Artigo.pdf','Planejamento. Propriedade Intelectual. Transferência de Tecnologia.','A EXPERIÊNCIA DO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS NA ORGANIZAÇÃO E        GESTÃO DE NÚCLEO DE INOVAÇÃO TECNOLÓGICA','Tibério Fontenele BARREIRA; Jonas de Paiva POTROS; Karla Lúcia da MOTA; Maurilio Lopes MARTINS; Valter de MESQUITA; Edgar Ricardo FERREIRA; Maria Elizabeth RODRIGUES',3,0),
(122,'69420551_Artigo.pdf','Adubação Orgânica. Adubação Molíbdica. Feijão. Agroecologia.','EFEITO DE DOSES CRESCENTES DE ESTERCO DE AVIÁRIO NO PLANTIO, SOBRE A PRODUTIVIDADE DO FEIJOEIRO COMUM (Phaseolus vulgaris L.), SUBMETIDO A UM MANEJO AGROECOLÓGICO DE PRODUÇÃO','Silvane A. CAMPOS; Marcos L. R. BASTIANI; Brauly M. ROCHA; Antônio Daniel COELHO; Phillip A. GARCIA; José Eustáquio S. CARNEIRO',3,0),
(121,'1964979561_Artigo.pdf','Tecnologias. Ensino. Formação de docentes. Software educacional.','A VISÃO DOS LICENCIANDOS EM MATEMÁTICA SOBRE O PROCESSO ENSINO-APRENDIZAGEM COM O USO DE NOVAS TECNOLOGIAS','Sávio REIS; Paula MIRANDA. ',3,0),
(120,'845984325_Artigo.pdf','Subprodutos. Frutas. Aproveitamento.','AVALIAÇÃO FÍSICO-QUÍMICA DE SUBPRODUTOS DO PROCESSAMENTO DE FRUTAS','Rosineide da Paixão FERREIRA; Karine de Almeida MARQUES; Vanessa Riani Olmi SILVA; Maurício Henriques Louzada SILVA; Eliane Maurício Furtado MARTINS; Alcinéia de Lemos Souza RAMOS; Isabela Campelo de ',3,0),
(119,'802250532_Artigo.pdf',' Recuperação Ambiental, Restauração Florestal, Educação Ambiental.','REVEGETAÇÃO DE TALUDES E ÁREAS CILIARES DA REPRESA DO HORTO E DA NASCENTE DO IF SUDESTE MG–CAMPUS RIO POMBA','Rodrigo OLIVEIRA; Maria Dalva TRIVELLATO; Maurício SOUZA',3,0),
(118,'1678630168_Artigo.pdf','Analise físico-química. Viabilidade. Culturas probióticas.','CARACTERIZAÇÃO FÍSICO-QUÍMICA E AVALIAÇÃO DA VIABILIDADE DE UMA BEBIDA LÁCTEA PROBIÓTICA SABOR MORANGO À BASE DE SORO DO LEITE E EXTRATO HIDROSSOLÚVEL DE SOJA DE DIFERENTES CULTURAS PROBIOTICAS','Renan Luís Emídio de CASTRO; Maurício Henriques Louzada SILVA; Bruno Ricardo de Castro LEITE JÚNIOR; Vanessa Riani Olmi SILVA; Alana Oliveira DAMIÃO; Leandro Oliveira JOAQUIM',3,0),
(117,'1406476544_Artigo.pdf','Bebida Láctea; Soro de Leite; Extrato hidrossolúvel de Soja.','ANÁLISE SENSORIAL E INTENÇÃO DE COMPRA DE UMA BEBIDA LÁCTEA PROBIÓTICA SABOR MORANGO À BASE DE SORO DO LEITE E EXTRATO HIDROSSOLÚVEL DE SOJA','Renan Luís Emídio de CASTRO; Maurício Henriques Louzada SILVA; Bruno Ricardo de Castro LEITE JÚNIOR; Vanessa Riani Olmi SILVA; Alana Oliveira DAMIÃO; Leandro Oliveira JOAQUIM',3,0),
(116,'591543724_Artigo.pdf','Produtividade, crescimento, lablabe, feijão-de-porco.','EFEITO DA ÉPOCA DE MANEJO DE ADUBOS VERDES SOBRE O DESENVOLVIMENTO E PRODUÇÃO DE CAFEEIROS','Rafael Monteiro de OIVEIRA; Tatiana Pires BARRELLA; Bianca de Jesus SOUZA; Ricardo Henrique Silva SANTOS; Guilherme Musse MOREIRA; Caio Matos DAVID; Luiz Cláudio PEREIRA',3,0),
(114,'582151736_Artigo.pdf','Massa. Pão de forma. Glúten.','CARACTERZAÇÃO DE PÃO ISENTO DE GLÚTEN E ADICIONADO DE FIBRAS','Patrícia Rodrigues CONDÉ; Nívia Maria TEIXEIRA; Isabela Campelo de QUEIROZ; Alcinéia Lemos RAMOS; Vanessa Riane Olmi SILVA',3,0),
(115,'114755160_Artigo.pdf','Adubação Orgânica. Adubação Molíbdica. Feijão. Agroecologia.','COMPORTAMENTO DE DOSES CRESCENTES DE ESTERCO DE AVIÁRIO APLICADAS EM COBERTURA, SOBRE A PRODUTIVIDADE DO FEIJOEIRO COMUM (Phaseolus vulgaris L.)','Phillip de Alcântara GARCIA; Marcos Luiz R. BASTIANI; Silvane de Almeida CAMPOS; Brauly Martins ROCHA; José Eustáquio de S. CARNEIRO',3,0),
(113,'133067561_Artigo.pdf','Pólo moveleiro de Ubá; fábricas moveleiras; INTERSIND.','ALGUNS APONTAMENTOS SOBRE O PÓLO MOVELEIRO DE UBÁ','ALUNAS, Nívea Soares Costa, Aida Lúcia Moreira; ORIENTADOR, Marcelo Leles Romarco de Oliveira',3,0),
(112,'689377161_Artigo.pdf','Yacon. . Processamento mínimo. Vida de prateleira.','Utilização de metabissulfito de sódio sobre a vida de prateleira de yacon (Smallanthus sonchifolius) minimamente processado','Marcela Zonta RODRIGUES; Vitor Ibrahim BRANDÃO; Eliane Maurício Furtado MARTINS',3,0),
(110,'283301942_Artigo.pdf','Monitoria Pedagógica. Ensino-Aprendizagem. Ensino de Matemática.','Monitoria pedagógica: contribuições no processo de ensino-aprendizagem no IFET Sudeste de Minas Gerais–Campus Rio Pomba','Lídia FERREIRA; Geraldo LIMA; Paula MIRANDA',3,0),
(111,'1698906535_Artigo.pdf','Concorrência. Transmissão de preços. Leite.','CONCORRÊNCIA E ESTRATÉGIAS DE PRECIFICAÇÃO DO SISTEMA AGROINDUSTRIAL DO LEITE NA REGIÃO DA ZONA DA MATA E VERTENTES DO ESTADO DE MINAS GERAIS.','Lidiane Aparecida da SILVA; Wildson Justiniano PINTO',3,0),
(109,'902367147_Artigo.pdf','doce de leite; mercado; cor.','AVALIAÇÃO DAS CARACTERÍSTICAS FÍSICO-QUIMICAS, MICROBIOLOGICAS E SENSORIAIS DE AMOSTRAS COMERCIAIS DE DOCE DE LEITE','JOAQUIM, Leandro Oliveira; SILVA, Maurício Henriques Louzada; RAMOS, Alcinéia de Lemos Souza; SILVA, Vanessa Riani Olmi; MARTINS, Maurílio Lopes; CASTRO, Renan Luís Emídio de; LEITE JUNIOR, Bruno Rica',3,0),
(108,'644301996_Artigo.pdf','Empresa Júnior. Gestão. Administração.','PERFIL, DIFICULDADES E PERSPECTIVAS DAS EMPRESAS JUNIORES DO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS, CAMPUS RIO POMBA','Karla Lúcia da MOTA; Jonas de Paiva POTROS; Tibério Fontenele BARREIRA, Valter de MESQUITA; Maurilio Lopes MARTINS; Bruno Gaudereto SOARES.',3,0),
(107,'2003501023_Artigo.pdf','micro-organismo, bactérias láticas, leite.','COMPOSIÇÃO FÍSICO-QUIMICA DE QUEIJO MINAS PADRÃO PROBIÓTICO INOCULADO COM E. aerogenes','Karine de Almeida MARQUES; Rosineide da Paixão FERREIRA; Aurélia Dornelas de Oliveira MARTINS; Bruno Gaudereto SOARES; Maurílio Lopes MARTINS; José Manoel MARTINS                      ',3,0),
(106,'892177601_Artigo.pdf','ácido cítrico, ácido ascórbico, avaliação sensorial.','ALTERAÇÕES SENSORIAIS DE MAMÃO MINIMAMENTE PROCESSADO ADICIONADO DE ANTIOXIDANTE','Kamila Ferreira CHAVES; Lorrani do Carmo TEIXEIRA; Vanessa Riani Olmi SILVA; Aurélia Dornelas de Oliveira MARTINS; Alcinéia de Lemos Souza RAMOS; Maurício Henriques Louzada SILVA;  Eliane Maurício Fur',3,0),
(105,'1058488891_Artigo.pdf','agente antioxidante, processamento mínimo, análise sensorial.','ALTERAÇÕES NA ACEITAÇÃO SENSORIAL DE LARANJA MINIMAMENTE PROCESSADA ADICIONADA DE ÁCIDO ASCÓRBICO E ÁCIDO CÍTRICO','Kamila Ferreira CHAVES; Welliton Fagner da CRUZ; Vanessa Riani Olmi SILVA; Aurélia Dornelas de Oliveira MARTINS; Alcinéia de Lemos Souza RAMOS; Eliane Maurício Furtado MARTINS',3,0),
(104,'1237458378_Artigo.pdf','recuperação de pastagem; pastejo rotacionado, pastejo racional, altura de pastejo, pastagem nativa.','PROJETO DE RECUPERAÇÃO DE PASTAGEM E PASTEJO ROTACIONADO RACIONAL NO IFET-CAMPUS RIO POMBA','Juliana Ferreira ROCHA; Edilson Rezende CAPPELLE',3,0),
(103,'1375333368_Artigo.pdf','Gerenciamento da pesquisa e inovação. Sistema de Gestão de Pesquisa e Inovação. Consulta de dados.','IMPLEMENTAÇÃO DE BANCO DE DADOS PARA APORTE A PESQUISA NO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERIAS','Jonas de Paiva POTROS; Tibério Fontenele BARREIRA; Karla Lúcia da MOTA; Maurilio Lopes MARTINS; Valter de MESQUITA; Bruno Gaudereto SOARES; Gustavo Henrique da ROCHA',3,0),
(101,'89929477_Artigo.pdf','Custo cesta básica, Salário-mínimo, Rio Pomba','IMPLEMENTAÇÃO DE UMA PESQUISA DE ORÇAMENTO FAMILIAR E CÁLCULO DO CUSTO DA CESTA BÁSICA NACIONAL EM RIO POMBA–MG','Jéssika do Vale SILVA; Wildson Justiniano PINTO',3,0),
(102,'2124245401_Artigo.pdf','              Modelagem de Sistemas Multiagentes, Sistemas de Informações Geográficas, Geosimulação.','MODELAGEM CONCEITUAL MULTIAGENTE DE UM SISTEMA PARA SEGURANÇA PÚBLICA.','João Paulo Campolina LAMAS, Elton Vieira COSTA',3,0),
(100,'228193114_Artigo.pdf','LTSP. Meio Ambiente. Lixo Eletrônico. Thin Clients. Inclusão Digital. Economia.','Maior sobrevida aos computadores antigos do IF Sudeste MG–Campus Rio Pomba','Gustavo Henrique REIS; Racyus Delano PACÍFICO; Rafael DIAS',3,0),
(99,'496453342_Artigo.pdf','Extrato hidrossolúvel de soja, melhoria nutricional, prebiótico.','ELABORAÇÃO DE BEBIDA A BASE DE EXTRATO SOLÚVEL DE SOJA COM SORO DE QUEIJO ACRESCIDA DE INULINA E OLIGOFRUTOSE','Glauciane de Oliveira ALVES; Cinthia Soares Cardoso QUINTÃO; Roselir Ribeiro da SILVA; Eliane Maurício Furtado MARTINS.',3,0),
(98,'1326552298_Artigo.pdf','Okará, extrato solúvel de soja, hambúrguer.','Aproveitamento do resíduo sólido obtido na produção de extrato aquoso de soja na produção de hambúrguer tipo suíno','Diana Clara Nunes de LIMA; Miguel Meirelles de OLIVEIRA; Isabela Campelo de QUEIROZ; Alcinéia de Lemos Souza RAMOS; Eliane Maurício Furtado MARTINS; Aída Couto Dinucci BEZERRA ',3,0),
(96,'1563714646_Artigo.pdf','legislação, produtor, leite cru, propriedade, queijo.','DIAGNÓSTICO DA CADEIA PRODUTIVA DOS QUEIJOS ARTESANAIS PRODUZIDOS NO MUNICÍPIO DE RIO POMBA, MINAS GERAIS.','Daniela Cristina Faria VIEIRA; José Manoel MARTINS; Cleuber Antonio de Sá SILVA.',3,0),
(97,'436535342_Artigo.pdf','Controle de estoques. Software gratuito. Tecnologia da Informação.','Administração estratégica de estoques em micro e pequenas empresas do comércio em Rio Pomba, Minas Gerais: um estudo exploratório sobre os softwares gratuitos gerenciadores de estoques','Danilo PIERRE; Ademilson SANTO; Alexandre ZIVIANI',3,0),
(95,'1575018367_Artigo.pdf','Ordenha. Instrução Normativa nº 51. Tanque de granelização.','QUALIDADE DO LEITE CRU REFRIGERADO DO TANQUE DE EXPANSÃO DO SETOR DE ZOOTECNIA DO INTITUTO FEDERAL DE   EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS, CAMPUS RIO POMBA ANTES E APÓS TREINAMENTO DOS  FUNCIONÁRIOS EM BOAS PRÁTICAS AGROPECUÁRIAS','Bruno Ricardo de Castro LEITE JÚNIOR; Gustavo Henrique de SOUZA; Patrícia Martins de OLIVEIRA; Maurilio Lopes MARTINS; Eliane Maurício Furtado MARTINS',3,0),
(93,'894537286_Artigo.pdf','Equivalência, matriz companheira, EDO ','EQUIVALENCIA E A MATRIZ COMPANHEIRA','Bruna TRINDADE, M. Sc. Marcos CARVALHO',3,0),
(94,'917879323_Artigo.pdf','Leite cru. Análises físico-químicas e microbiológicas. Instrução Normativa nº 51.','QUALIDADE DO LEITE CRU DOS BOVINOS EM LACTAÇÃO DO SETOR DE ZOOTECNIA DO INTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS, CAMPUS RIO POMBA','Bruno Ricardo de Castro LEITE JÚNIOR; Gustavo Henrique de SOUZA; Patrícia Martins de OLIVEIRA; Maurilio Lopes MARTINS.',3,0),
(92,'1396438226_Artigo.pdf','produção, crescimento, nutrientes, consorciação.','EFEITO DA ÉPOCA DE MANEJO DE ADUBOS VERDES SOBRE ERVAS ESPONTÂNEAS E NUTRIÇÃO NITROGENADA EM UM CAFEZAL SOBRE MANEJO ORGÂNICO','Bianca de Jesus SOUZA; Silvonei de Araújo ABBADE Tatiana Pires BARRELA; Guilherme Musse MOREIRA; Rafael Monteiro de OLIVEIRA; Ricardo Henrique Silva SANTOS; Anastácia FONTANÉTTI ',3,0),
(91,'1991102021_Artigo.pdf','Psicrotróficos. Protease. Isoflavona.','INIBIÇÃO DA ATIVIDADE PROTEOLÍTICA DE BACTÉRIAS PSICROTRÓFICAS EM MEIO DE CULTURA ADICIONADO DE ISOFLAVONA','Aline Pereira MARTINS; Maurilio Lopes MARTINS; Cláudia Lúcia de Oliveira PINTO',3,0),
(90,'1027454132_Artigo.pdf','Gestão de Estoque, Software e Levantamento de dados.','ADMINISTRAÇÃO ESTRATÉGICA DE ESTOQUES EM MICRO E PEQUENAS EMPRESAS DO COMÉRCIO EM RIO POMBA, MINAS GERAIS: UM ESTUDO EXPLORATÓRIO SOBRE AS NECESSIDADES E FRAGILIDADES DA GESTÃO DE ESTOQUE','Ademilson do ESPÍRITO SANTO; Alexandre Lana ZIVIANI',3,0),
(89,'1462916712_Artigo.pdf','Feijão (Phaseolus vulgaris L.); Rizóbio (Rhizobium leguminosarum Biovar Phaseolii);','Utilização de estipes de rizóbio (Riozobium leguminosarum biovar phaseoli) específicas em forma e inóculo no plantio do feijoeiro (Phaseolus vulgares L.).','Diogo Machado do CARMO; Eli Lino de JESUS.',2,0),
(87,'1805306803_Artigo.pdf','Arborização Urbana; Condições morfológicas; Qualidade de vida.','RECUPERAÇÃO DE ÁREAS DEGRADADAS E PAISAGISMO URBANO: ESPÉCIES ARBÓREAS E O CONFORTO TÉRMICO','MATA, Jhennifer Alves Pereira ; SOUZA, Maurício Novaes e TRIVELLATO, Maria Dalva',2,0),
(88,'2016788794_Artigo.pdf','Produção Científica na Educação Matemática. Novas Tecnologias. Ensino de Funções.','UM PANORAMA DAS PESQUISAS SOBRE ENSINO DE FUNÇÕES COM NOVAS TECNOLOGIAS','Gláucia A. SILVA; Dênis E. C. VARGAS.',2,0),
(86,'1114505048_Artigo.pdf','absorvância; desnatado; semi-desnatado','REAÇÃO DE MAILLARD EM LEITES UHT E SUA CORRELAÇÃO COM ÍNDICES DE COR OBJETIVA','Jacyara Thaís TEIXEIRA, Cleuber Raimundo da SILVA, Alcinéia de Lemos Souza RAMOS, Eduardo Mendes RAMOS, José Luis CONTADO',2,0),
(85,'650449797_Artigo.pdf','lnga edulis Mart. Germinação. Meio de cultura.','PROTOCOLO PARA DESINFESTAÇÃO E MULTIPLICAÇÃO IN VITRO DE INGÁ (Inga edulis MART.) A PARTIR DE EXPLANTES ORIUNDOS DE SEMENTES.','Adalgisa J. PEREIRA; Anderson R. VIEIRA; Francisco C. GONÇALVES;                           Elzimar O.GONÇALVES(2)',2,0),
(83,'739552715_Artigo.pdf','EaD, Moodle, Acessibilidade.','PLATAFORMA MOODLE: ACESSIBILIDADE NA EDUCAÇÃO A DISTÂNCIA','Gustavo de Oliveira ANDRADE; Walkíria Araújo Ciribeli PROCACI;',2,0),
(84,'1033538249_Artigo.pdf',' Interdisciplinaridade. Educação Matemática. Propostas de Ensino.','PROPOSTAS DE INTERDISCIPLINARIDADE PARA A EDUCAÇÃO BÁSICA: DESAFIOS DE UM AMBIENTE EM CONSTRUÇÃO','Romaro Antonio SILVA; Paula Reis de MIRANDA',2,0),
(81,'299604660_Artigo.pdf','Monitoria Pedagógica, Ensino-Aprendizagem, Ensino de Matemática.','Monitoria Pedagógica: contribuições no processo de ensino-aprendizagem no IFET Sudeste de Minas – Campus Rio Pomba','Lídia FERREIRA; Geraldo LIMA; Paula MIRANDA',2,0),
(82,'1332973334_Artigo.pdf','Fruticultura. Comercialização. Pós colheita.','PERFIL DO MERCADO VAREJISTA DE FRUTAS NA CIDADE DE RIO POMBA.','José Lucas P. LUIZ; Francisco C. GONÇALVES;',2,0),
(80,'999937282_Artigo.pdf','Leite cru refrigerado. Bactérias psicrotróficas. Queijos. Compostos nitrogenados.','INFLUÊNCIA DA MICROBIOTA PSICROTRÓFICA DO LEITE CRU GRANELIZADO DA REGIÃO DE RIO POMBA-MG, SOBRE O RENDIMENTO DA PRODUÇÃO DE QUEIJO MINAS PADRÃO','Simone Vilela TALMA; João Batista BARBOSA; Maurilio Lopes MARTINS.',2,0),
(79,'142161443_Artigo.pdf','Indústria Metal-Mecânica; Impactos Ambientais; Fluidos ou óleos de Corte; Legislação Ambiental','IMPACTOS AMBIENTAIS A PARTIR DA UTILIZAÇÃO DE FLUIDOS OU ÓLEOS DE CORTE NA INDÚSTRIA METAL-MECÂNICA','Elcio Antônio Ignácio; Jalon de Morais Vieira ',2,0),
(78,'575446404_Artigo.pdf','Leite cru. Tanques de expansão. Microbiota psicrotrófica.','IDENTIFICAÇÃO DE BACTÉRIAS PSICROTRÓFICAS PROTEOLÍTICAS ISOLADAS DE LEITE CRU REFRIGERADO PROVENIENTE DA REGIÃO DE RIO POMBA-MG','Aline Pereira MARTINS; Simone Vilela TALMA; Maurílio Lopes MARTINS',2,0),
(77,'1055543097_Artigo.pdf','Gerenciamento de custos, Setor lácteo, Sistema administrativo.','GESTÃO DE CUSTOS DE PRODUÇÃO: UMA ANÁLISE COMPARATIVA ENTRE LATICÍNIOS DA REGIÃO DA ZONA DA MATA DE MINAS GERAIS','Fernanda Maia MARTINS, Charles Okama de SOUSA, Moissés de Sousa MOREIRA, Geraldo Ferreira DAVID, Welliton Fagner da CRUZ',2,0),
(76,'617302937_Artigo.pdf','Biodiesel; Lupinus albus, ruminantes, coprodutos.','Frações fibrosas da torta de tremoço–Potencial de uso na alimentação animal.','Cleuber Raimundo da Silva, Arnaldo P. Neiva Júnior, José Cleto S. Filho, Eric H.C. B. Van Cleef, Edílson R. Cappelle, Pedro C. Neto',2,0),
(75,'1685523728_Artigo.pdf','Micropropagação. Inga edulis Mart. Hipoclorito de sódio. BAP/ANA.','ESTABELECIMENTO E MULTIPLICAÇÃO IN VITRO DE INGÁ (Inga edulis MART.) A PARTIR DE EXPLANTES ORIUNDOS DE SEMENTES','Anderson Reis VIEIRA; Adalgisa de Jesus PEREIRA; Francisco César GONÇALVES; Elzimar de Oliveira GONÇALVES;',2,0),
(74,'1915320427_Artigo.pdf','Leite cru. Staphulococcus aureus. Atividade antimicrobiana.','ENUMERAÇÃO, ISOLAMENTO, CARACTERIZAÇÃO E CONTROLE DO CRESCIMENTO DE Staphylococcus aureus ISOLADO DE LEITE CRU GRANELIZADO DA REGIÃO DE RIO POMBA-MG','Andressa Susam Silva BRITES; Ricardo Augusto Paes RIBEIRO; Maurilio Lopes MARTINS',2,0),
(73,'818685642_Artigo.pdf',' Maçã minimamente processada, antioxidantes, caracterização físico-química.','EFEITO DO USO DE ANTIOXIDANTES SOBRE AS CARACTERÍSTICAS FÍSICO-QUÍMICAS DE MAÇÃ MINIMAMENTE PROCESSADA','Kamila Ferreira CHAVES; Guilherme Matheus de BARROS; Vanessa Riani Olmi SILVA; Aurélia Dornelas de Oliveira MARTINS; Alcinéia de Lemos Souza RAMOS; Eliane Maurício Furtado MARTINS; Gabriela Rigueira M',2,0),
(72,'182267171_Artigo.pdf','Coffea arábica, produção orgânica, leguminosas.','EFEITO DA ÉPOCA DE MANEJO DE ADUBOS VERDES SOBRE O DESENVOLVIMENTO E PRODUÇÃO DE CAFEEIROS.','Rafael OLIVEIRA; Tatiana BARRELLA; Guilherme MOREIRA; Ricardo SANTOS; Anastácia Fontanétti; Bianca OLIVEIRA; Pedro GOULART; Luiz PEREIRA.',2,0),
(71,'2113985589_Artigo.pdf','Decomposição, leguminosas, Agroecologia, consorciação','EFEITO DA ÉPOCA DE MANEJO DE ADUBOS VERDES SOBRE ERVAS ESPONTÂNEAS E NUTRIÇÃO NITROGENADA EM CAFEEIROS','Guilherme MOREIRA; Tatiana BARRELLA; Rafael OLIVEIRA; Ricardo SANTOS; Anastácia FONTANÉTTI; Pedro GOULART; Luiz PEREIRA.',2,0),
(70,'1528762289_Artigo.pdf','Biodiesel; Rafhanus sativus, ruminantes, coprodutos.','Digestibilidade da torta de nabo forrageiro–Potencial de uso na alimentação animal.','Cleuber Raimundo da Silva, Arnaldo Prata Neiva Júnior, José Cleto S. Filho, Eric H. C. B. C Van Cleef, Edílson R. Cappelle, Pedro C. Neto',2,0),
(69,'5336209_Artigo.pdf','Estatística e Probabilidade. Monitoria. Frequência. Aprovação','DIAGNÓSTICO E QUALIFICAÇÃO DA MONITORIA DE ESTATISTICA E PROBABILIDADE NO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS, CAMPUS RIO POMBA','Bruno Ricardo de Castro LEITE JUNIOR; Roberto Alves DUTRA; Maurilio Lopes MARTINS.',2,0),
(68,'21351996_Artigo.pdf','sorgo, feijão-de-porco, crotalária, biomassa, plantas espontâneas.','DESEMPENHO DE PLANTAS DE COBERTURA DE VERÃO NA PRODUÇÃO DE BIOMASSA E SUPRESSÃO DE PLANTAS ESPONTÂNEAS','Silvane A. CAMPOS; Pedro L. GOULART; Marcos L. BASTIANI; Gilvan T. GASPARONI; Luiz C. PEREIRA; Guilherme M. MOREIRA',2,0),
(67,'1296898583_Artigo.pdf','tremoço, aveia-preta, biomassa, plantas espontâneas.','DESEMPENHO DE PLANTAS DE COBERTURA DE INVERNO NA PRODUÇÃO DE BIOMASSA E SUPRESSÃO DE PLANTAS ESPONTÂNEAS','Pedro L. GOULART; Silvane A. CAMPOS; Marcos L. BASTIANI; Anastácia FONTANÉTTI; Luiz C. PEREIRA; Guilherme M. MOREIRA',2,0),
(66,'573562329_Artigo.pdf','Goiaba, Métodos alternativos, Zona Rural.','CONTROLE ALTERNATIVO DAS MOSCAS DAS FRUTAS EM SISTEMA ORGÂNICO DE PRODUÇÃO DE GOIABA NO MUNICÍPIO DE RIO POMBA–MINAS GERAIS','John Henrique Souza LOPES; Rafael Cocate ALVES; Brauly Martins ROCHA; Carlos Miranda CARVALHO (1); Roberto Alves DUTRA.',2,0),
(65,'235396229_Artigo.pdf','Leite cru. Mastite bovina. Staphylococcus aureus.','CONTAMINAÇÃO DO LEITE CRU DOS BOVINOS EM LACTAÇÃO DO  SETOR DE ZOOTECNIA DO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS, CAMPUS RIO POMBA POR ESTAFILOCOCOS','Lázaro Oliveira PRATES; Eliane das Dores CALLEGARO; Bruno Ricardo de Castro LEITE JUNIOR; Silvio Leite MONTEIRO DA SILVA; Aurélia Dornelas de Oliveira MARTINS; Maurilio Lopes MARTINS',2,0),
(64,'1385627605_Artigo.pdf','Espaçamento entre linhas, roçada, Zea mayz L.','COMPETITIVIDADE DO MILHO COM AS PLANTAS DANINHAS SOBRE DIFERENTES ESPAÇAMENTOS DAS ENTRELINHAS','Luiz Cláudio PEREIRA; Tatiana Pires BARRELLA; Francisco da SILVA; Anastácia FONTANETTI; Pedro Lamas GOULART; Guilherme Musse MOREIRA.',2,0),
(63,'817601927_Artigo.pdf','Iogurte, bebida láctea, análises microbiológicas','CARACTERIZAÇÃO MICROBIOLÓGICA DE IOGURTE SABOR MORANGO E BEBIDA LÁCTEA SABOR CHOCOLATE DE UMA INDÚSTRIA DE LATICÍNIOS DA CIDADE DE TOCANTINS–MG PRODUZIDOS EM 2007','Cleuber Raimundo da SILVA, Leandro Lamas CALDONCELLI, João Batista BARBOSA, Vanessa Riani Olmi SILVA, Luiz Ronaldo de ABREU',2,0),
(60,'142432799_Artigo.pdf','Ecologia; poluição atmosférica; Agroecologia; Zona da Mata.','BIODIVERSIDADE DE LEPIDÓPTEROS EM CIDADES COM TAMANHO POPULACIONAL DIFERENTE','Cauê TRIVELLATO; Lorena FREITAS; Célio LIMA.',2,0),
(62,'892749315_Artigo.pdf','Alunos, Calculadora, Ensino Fundamental.','O USO DA CALCULADORA NO ENSINO DA MATEMÁTICA: UMA  EXPERIÊNCIA VIVIDA PELOS ALUNOS DO 7º ANO DO ENSINO FUNDAMENTAL','Corina de Fátima Moreira VIEIRA; Paula Reis de MIRANDA; Roberto Alves DUTRA; Romaro Antonio SILVA',2,0),
(59,'1866566132_Artigo.pdf','Qualidade do Leite Cru, Análise físico-química, Análise Microbiológica.','AVALIAÇÃO FÍSICO-QUÍMICA E MICROBIOLÓGICA DO LEITE CRU PRODUZIDO NO INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SUDESTE DE MINAS GERAIS, CAMPUS RIO POMBA','Bruno Ricardo de Castro LEITE JUNIOR; Patrícia Martins de OLIVEIRA; Ana Silvia Boroni de OLIVEIRA; Lazaro de Oliveira PRATES; Gustavo Henrique de SOUZA; Maurilio Lopes MARTINS ',2,0),
(58,'1644106764_Artigo.pdf','Soro de leite ultrafiltrado; bebida isotônica; análise físico-química.','AVALIAÇÃO FISICO-QUIMICA DA BEBIDA ISOTÔNICA ELABORADA COM PERMEADO DE SORO DE LEITE ULTRAFILTRADO DURANTE ESTOCAGEM SOB REFRIGERAÇÃO.','Francemir José LOPES; Edimar Aparecida Filomeno FONTES; Roselir Ribeiro da SILVA; Rosélio Martins VIEIRA.',2,0),
(57,'351680771_Artigo.pdf','oro ultrafiltrado, Lactobacillus, massa celular','AVALIAÇÃO DO RENDIMENTO DA BIOMASSA DE CULTURA LÁTICA CULTIVADA EM PERMEADO DA ULTRAFILTRAÇÃO DO SORO DE LEITE','Welliton Fagner da CRUZ; Edimar Aparecida Filomeno FONTES; Roselir Ribeiro da SILVA; Italo Souza ROCHA.',2,0),
(56,'1765182571_Artigo.pdf','Enzimas. Queijos Maturados. Provadores.','AVALIAÇÃO DO EFEITO DE LIPASES OVINAS E CAPRINAS NA INTENSIFICAÇÃO DE SABOR DE QUEIJOS MATURADOS','Fernanda Cristina FIRMINO; Maurilio Lopes MARTINS; Múcio Mansur FURTADO; Roselir Ribeiro da SILVA; Vanessa Riani Olmi SILVA.',2,0),
(55,'1568520351_Artigo.pdf','alimentos, suinocultura, eficiência, tratamento de efluentes.','AVALIAÇÃO DO DESEMPENHO DA ESTAÇÃO DE TRATAMENTO DE EFLUENTES AGROINDUSTRIAIS DO IF SEMG–CAMPUS RIO POMBA','Nívia Carolina Lopes ROSADO; Vanessa Riani Olmi SILVA',2,0),
(54,'829012137_Artigo.pdf','Formicidae, manejo agroecológico, espécies praga.','Avaliação de Recursos para Formigas em Diferentes Sistemas de Produção de Café','Célio Júnior LIMA, Cauê TRIVELLATO, Lorena Freitas SEVERINO, Carla Rodrigues RIBAS',2,0),
(53,'1257629677_Artigo.pdf','Processamento mínimo. Cenoura. Lactobacillus paracasei.','AVALIAÇÃO DA VIABILIDADE DE Lactobacillus paracasei EM CENOURA MINIMAMENTE PROCESSADA CULTIVADA EM SISTEMA AGROECOLÓGICO','Diana Clara Nunes de LIMA; Eliane M. Furtado MARTINS; Maurílio Lopes MARTINS; Carlos Miranda CARVALHO ',2,0),
(52,'138945458_Artigo.pdf','Queijo Minas Frescal; Queijo Minas Padrão; Queijo adicionado de Soja.','AVALIAÇÃO DAS CARACTERÍSTICAS FÍSICO-QUÍMICAS, SENSORIAIS E DE RENDIMENTO EM QUEIJO MINAS FRESCAL E PADRÃO PROCESSADOS COM PROTEÍNA DE SOJA','Nayara Cantarino BARBOSA; Mauricio Henriques Louzada SILVA; Maurílio Lopes MARTINS; Vanessa Riani Olmi SILVA; Cleuber Raimundo da SILVA',2,0),
(51,'894257555_Artigo.pdf','Legislação Brasileira de Rotulagem, Rótulos, Produtos Lácteos.','AVALIAÇÃO DA LEGISLAÇÃO BRASILEIRA DE ROTULAGEM DE ALIMENTOS EM PRODUTOS LÁCTEOS COMERCIALIZADOS NO  MUNICÍPIO DE RIO POMBA E JUIZ DE FORA, MINAS GERAIS.','Jeferson dos Santos Silva, Maurício Henriques Louzada Silva.',2,0),
(50,'1320545138_Artigo.pdf','Bebida láctea. Qualidade sensorial. Influências de polpas e aromas.','AVALIAÇÃO DA INFLUÊNCIA DE POLPAS E AROMAS DE DIFERENTES FORNECEDORES NAS CARACTERÍSTICAS SENSORIAIS, NO VALOR DE pH E TEOR DE ACIDEZ DE BEBIDAS LÁCTEAS','Alan Franco BARBOSA; Miguel Meirelles de OLIVEIRA; Priscyla Cristhina dos SANTOS; Vanessa Riani Olmi SILVA; Aurélia Dornelas de Oliveira MARTINS; Maurilio Lopes MARTINS',2,0),
(49,'1267842221_Artigo.pdf','Bebida Láctea. Aceitação sensorial. Análise Descritiva Quantitativa.','AVALIAÇÃO DA INFLUÊNCIA DE DIFERENTES FORNECEDORES DE POLPAS E AROMAS NA QUALIDADE SENSORIAL DE BEBIDAS LÁCTEAS','Miguel Meirelles de OLIVEIRA; Alan Franco BARBOSA; Priscyla Cristhina dos SANTOS; Vanessa Riani Olmi SILVA; Aurélia Dornelas de Oliveira MARTINS; Maurilio Lopes MARTINS',2,0),
(47,'1859628012_Artigo.pdf','probióticos. Lactobacillus. Bifidobacterium','APLICAÇÃO DE PROBIÓTICO EM ALIMENTOS COM ENFASE EM LACTOBACILOS E BIFIDOBACTÉRIAS','Diana Clara Nunes de LIMA; Miguel Meirelles de OLIVEIRA; Aurélia Dornelas de Oliveira MARTINS; Maurílio Lopes MARTINS',2,0),
(48,'642770660_Artigo.pdf','Refrigeração; Mesófilos; Psicrotróficos.','AVALIAÇÃO DA CONTAGEM MICROBIOLÓGICA DO LEITE CRU REFRIGERADO DOS TANQUES DE EXPANSÃO DAS PROPRIEDADES RURAIS DE RIO POMBA-MG','Tamara Piubelo Soares MADEIRA; Diego Delage Furtado FARIA; Tamara Aparecida Lopes dos SANTOS; Cleuber Raimundo da SILVA; Edimar Aparecida Filomeno FONTES; Roselir Ribeiro da SILVA; Milene Therezinha d',2,0),
(46,'748068209_Artigo.pdf','Antagonismo, Bactérias lácticas, Micro-organismos indicadores','AVALIAÇÃO DO ANTAGONISMO DAS BACTÉRIAS LÁCTICAS UTILIZADAS EM PRODUTOS FERMENTADOS FRENTE À MICRO-ORGANISMOS INDICADORES','Karine de Almeida MARQUES; Aurélia Dornelas de Oliveira MARTINS; Bruno Gaudereto SOARES; Maurílio Lopes MARTINS; José Manoel MARTINS',2,0),
(45,'305099449_Artigo.pdf','OBMEP; Ensino de Geometria; Ensino Médio','UM ESTUDO SOBRE O DESEMPENHO DOS ESTUDANTES DO CAMPUS RIO POMBA NAS QUESTÕES DE GEOMETRIA DA OBMEP','VALOTE, Priscila D.; VARGAS, Dênis E. C.',2,0),
(44,'1514036134_Artigo.pdf','Projeto; extensão; desenvolvimento.','PARTICIPAÇÃO DO INSTITUTO FEDERAL DE EDUCAÇÃO CIÊNCIA E TECNOLOGIA DO SUDESTE MINAS GERAIS–CAMPUS RIO POMBA-MG EM PROJETOS DE EXTENSÃO','SILVA, Nisael Buenes Nunes da; DAVID, Geraldo Ferreira; CALLEGARO, Eliane das Dores; MARTINS, Aurélia Dornelas de Oliveira; MARTINS, Maurilio Lopes; ANDRADE, Flávia Luciana Campos Dutra;',2,0),
(43,'584021134_Artigo.pdf','Vestibular, Ensino Médio, Universidades.','O SONHO DA EDUCAÇÃO SUPERIOR: CURSOS E FACULDADES APONTADOS PELOS ALUNOS DO ENSINO MÉDIO DE RIO POMBA COMO OS DE SUA PREFERÊNCIA','RAMOS, Alan de Lima; PEREZ, Arthur Cardoso; GRANATO, Carina Alves; FERNANDES, Estefânia Silva; BENEVENUTO, Ismael Ferreira; SILVA, Liliane; SILVA, Vilma.',2,0),
(42,'2117711761_Artigo.pdf','novo produto, iogurte tipo sundae, avaliação sensorial.','ELABORAÇÃO E AVALIAÇÃO SENSORIAL DE IOGURTE LIGHT TIPO SUNDAE COM CALDA DE MAÇÃ E CANELA','Rosa Ferreira da SILVA; Aline Moura FREIRE; Patrícia Rodrigues CONDÉ ( Joaquim Mário Neiva LAMAS; Milene Therezinha das DORES',1,0),
(41,'846965368_Artigo.pdf','rendimento escolar; acadêmicos; avaliação .','ELABORAÇÃO E APLICAÇÃO DE UMA PLANILHA ESPECIALIZADA NO CONTROLE DO RENDIMENTO ESCOLAR ANUAL DO ENSINO MÉDIO (CREA)','LEITE JUNIOR, Bruno Ricardo de Castro; DUTRA, Roberto Alves; MIRANDA, Paula Reis, DUTRA, Ronaldo Alves.',2,0),
(33,'259606544_Artigo.pdf','Identidade, Memória estudantil, Licenciatura em Matemática.','TRAÇANDO A IDENTIDADE ESTUDANDIL DOS ALUNOS DO CURSO DE LICENCIATURA EM MATEMÁTICA DO CEFET-RP','Romaro SILVA; Ricelly OLIVEIRA; Paula MIRANDA',1,0),
(40,'1294103811_Artigo.pdf','soja; consumidores; lipoxigenase.','CONHECIMENTO DOS CONSUMIDORES DA REGIÃO DA ZONA DA MATA SOBRE PRODUTOS À BASE DE SOJA','CASTRO, Renan Luis Emídio de; LEITE JUNIOR, Bruno Ricardo de Castro; SILVA, Maurício Henriques Louzada, DA SILVA, Cleuber Raimundo, SILVA, Vanessa Riani Olmi',2,0),
(32,'1107786924_Artigo.pdf','Queijo, rendimento, Pseudomonas fluorescens.','RENDIMENTO DE QUEIJOS MINAS FRESCAL E MINAS PADRÃO PRODUZIDOS COM LEITE INOCULADO COM Pseudomonas fluorescens','João Batista BARBOSA, Maurilio Lopes MARTINS, Cleiton Souza BATISTA, Rosélio Martins VIEIRA, Maria Cristina Dantas VANETTI, Cláudia Lúcia de Oliveira PINTO',1,0),
(31,'229245120_Artigo.pdf','Competição. Manejo. Adubação-verde','PRODUTIVIDADE E EMPALHAMENTO DO MILHO CONSORCIADO               COM Crotalaria juncea','Luiz C. PEREIRA; Josimar N. BATISTA; Anastácia FONTANÉTTI; Pedro L. GOULART; Fernando L. A. de SOUZA; Guilherme M. MOREIRA; João C.C. GALVÃO',1,0),
(30,'1438487078_Artigo.pdf','Soro lácteo. Concentração a vácuo. Leite condensado.','PROCESSAMENTO E UTILIZAÇÃO DE SORO DE LEITE CONDENSADO','Alan César Souza MACIEL; Nisael Buenes Nunes da SILVA; Rosana de Fátima RODRIGUES; Maurilio Lopes MARTINS; Vanessa Riani Olmi SILVA; Maurício Henriques Louzada SILVA.',1,0),
(29,'350217519_Artigo.pdf','agroindústrias, queijos, perfil, Rio Pomba.','PERFIL SÓCIO-ECONÔMICO E TECNOLÓGICO DAS AGROINDÚSTRIAS PRODUTORAS DE QUEIJOS DA REGIÃO DE RIO POMBA','Chrystina Conceição de OLIVEIRA, Raquel Aparecida Batista, Cristina Thielmann MARTINS, Roselir Ribeiro da SILVA',1,0),
(28,'67341393_Artigo.pdf','Quorum sensing. Queijo Minas Frescal. Contaminação.','MECANISMO DE QUORUM SENSING ENTRE BACTÉRIAS EM QUEIJO MINAS FRESCAL','André Luiz de Oliveira ASSIS; Rosineide da Paixão FERREIRA; Alan César Souza MACIEL; Maurilio Lopes MARTINS; Aurélia Dornelas de Oliveira MARTINS; Eliane Maurício Furtado MARTINS',1,0),
(27,'261709374_Artigo.pdf','Iogurte; Labneh; Pseudomonas fluorescens.','INFLUÊNCIA DA ATIVIDADE ENZIMÁTICA DE Pseudomonas fluorescens 041 EM PRODUTOS LÁCTEOS FERMENTADOS','Karine de Almeida MARQUES, Andreza Angélica FERREIRA, João Batista BARBOSA, Eliane Maurício Furtado MARTINS, Vanessa Riani Olmi SILVA.',1,0),
(25,'1984323648_Artigo.pdf','Estufamento tardio. Clostridium. Queijo maturado.','ESTUFAMENTO TARDIO: CAUSAS E PREVENÇÃO','BARBOSA, N.C.; SILVA, J.S.; OLIVEIRA, M.M.; DIAS, V.R.; SILVA,M.H.L',1,0),
(26,'1781715724_Artigo.pdf','produção, crescimento, nutrientes, consorciação.','IMPACTO DE ADUBOS VERDES SOBRE O MANEJO DE ERVAS E NUTRIÇÃO NITROGENADA DE CAFEEIROS','Guilherme Musse MOREIRA; Fernando Luciano Alves de SOUZA; Tatiana Pires  BARRELLA; Luiz Cláudio PEREIRA; Pedro Lamas GOULART; Ricardo Henrique Silva SANTOS; Anastácia FONTANÉTTI ',1,0),
(24,'1978882281_Artigo.pdf','Plantas de Cobertura. Fitomassa. Plantas Espontâneas.','EFEITOS DE PLANTAS DE COBERTURA DE INVERNO NA PRODUÇÃO DE FITOMASSA E SUPRESSÃO DE PLANTAS ESPONTÂNEAS','Pedro L. GOULART; Marcos L. BASTIANI; Anastácia FONTANÉTTI; Luiz C. PEREIRA; Guilherme M. MOREIRA; Fernando L. A. de SOUZA',1,0),
(23,'670405796_Artigo.pdf','Difusão de tecnologia, Produtividade, Irrigação, CEFET-RP.','DIFUSÃO TECNOLÓGICA SOBRE MANEJO DE IRRIGAÇÃO PARA PROFESSORES, TÉCNICOS E ESTUDANTES DO CENTRO FEDERAL DE EDUCAÇÃO TECNOLÓGICA CEFET-RIO POMBA, ZONA DA MATA MINEIRA.','Vanessa Schiavon LOPES; Carlos Miranda CARVALHO; Steliane Pereira COELHO',1,0),
(22,'1718475165_Artigo.pdf','Água. Minimização. Geração de efluentes.','DIAGNÓSTICO E MINIMIZAÇÃO DE IMPACTO AMBIENTAL CAUSADO PELO USO DE ÁGUA E PELA GERAÇÃO DE EFLUENTES NA UNIDADE DE PROCESSAMENTO DE LEITE E DERIVADOS DO CEFET-RP','Andreza Angélica FERREIRA, Rosineide da Paixão FERREIRA, Vanessa Riani Olmi SILVA, Roselir Ribeiro da SILVA, Danilo José Pereira da SILVA.',1,0),
(21,'1797043769_Artigo.pdf','Perfil, Produção de leite, Rio Pomba','DIAGNÓSTICO DAS CARACTERÍSTICAS DE PRODUÇÃO DE LEITE NA MICRORREGIÃO DE RIO POMBA-MG','Welliton Fagner da CRUZ; Alan Franco BARBOSA; Fernanda Cristina FIRMINO; Maurílio Lopes MARTINS.',1,0),
(20,'519149089_Artigo.pdf','soro, bebida a base de suco de uva, avaliação sensorial.','DESENVOLVIMENTO E ACEITAÇÃO SENSORIAL  DE BEBIDA GASEIFICADA SABOR UVA A BASE DE SORO DE LEITE','Simone Vilela TALMA; Fernanda Cristina FIRMINO; Eliane Maurício Furtado MARTINS; Maurílio Lopes MARTINS; Vanessa Riani Olmi SILVA; Bruno Gaudereto SOARES',1,0),
(19,'931865493_Artigo.pdf','Dependência financeira. Arrecadação tributária. Municípios.','DEPENDÊNCIA FINANCEIRA E ESFORÇO DE ARRECADAÇÃO TRIBUTÁRIA NOS MUNICÍPIOS DE MINAS GERAIS','Rivânia Ferreira Moreira; Charles Okama de Souza',1,0),
(18,'1372760817_Artigo.pdf','Demonstração matemática. Informática na educação matemática. Ensino de cálculo.','DEMONSTRAÇÃO FORMAL VERSUS DEMONSTRAÇÃO COM  INFORMÁTICA: UM PROBLEMA NO ENSINO DE CÁLCULO','Ayres CORRÊA; Dênis VARGAS ',1,0),
(17,'1399756947_Artigo.pdf','Trema micrantha; substratos orgânicos, mudas florestais, qualidade de muda.','CRESCIMENTO DA CRINDIÚVA (Trema micrantha L. Blume) SOB INFLUÊNCIA DE DIFERENTES AMBIENTES E COMPOSIÇÕES DE ADUBOS ORGÂNICOS','Anderson Reis VIEIRA, Elzimar de Oliveira GONÇALVES, Adalgisa de Jesus PEREIRA, Haroldo Nogueira de PAIVA.',1,0),
(16,'977637693_Artigo.pdf','Leguminosas. Características edafoclimáticas. Fitomassa.','COMPORTAMENTO DE ADUBOS VERDES DE VERÃO NO MUNICÍPIO DE RIO POMBA-MG','Josimar N. BATISTA; Luiz C. PEREIRA; Anastácia FONTANÉTTI; Pedro L. GOULART; Guilherme M. MOREIRA; Fernando L. A. de SOUZA; Tatiana Pires BARRELLA',1,0),
(15,'801888867_Artigo.pdf','Queijo Minas Padrão, análises microbiológicas, análises físico-químicas.','CARACTERIZAÇÃO FÍSICO-QUÍMICA E MICROBIOLÓGICA DE QUEIJOS MINAS PADRÃO','André Luiz de Oliveira ASSIS; Cristina THIELMANN; Aurélia Dornelas de Oliveira MARTINS',1,0),
(14,'1644380465_Artigo.pdf','Aproveitamento. Soro. Bebida láctea.','AVALIAÇÃO FÍSICO-QUÍMICA E SENSORIAL DE BEBIDA LÁCTEA PROCESSADA COM DIFERENTES CONCENTRAÇÕES DE SORO DE QUEIJO PRODUZIDO NO LATICÍNIO DO CEFET-RP','Rosineide da Paixão FERREIRA; Andreza Angélica FERREIRA; Vanessa Riani Olmi SILVA; Maurício Henriques Louzada SILVA ',1,0),
(13,'1773848192_Artigo.pdf','Impacto Ambiental. Bioindicadores. Práticas Agroecológicas.','Avaliação do Impacto Ambiental e da Sustentabilidade em Diferentes Sistemas de Produção','Lorena Freitas SEVERINO; Cauê TRIVELLATO ; Célio Júnior LIMA ; Carla Rodrigues RIBAS ',1,0),
(12,'1496777078_Artigo.pdf','Análise de Livros Didáticos; Modelagem Matemática; Ensino de funções.','A MODELAGEM MATEMÁTICA NO ENSINO DE FUNÇÕES: UMA ANÁLISE DE LIVROS DIDÁTICOS','Lídia FERREIRA; Denis VARGAS ',1,0),
(11,'1201082380_Artigo.pdf','Maracujá. Plantas de cobertura. Adubo verde.','ADUBAÇÃO VERDE NO MANEJO DE PLANTAS ESPONTANEAS E PRODUÇÃO DO MARACUJAZEIRO','Aline Toledo da COSTA; Nívia Carolina ROSADO ; Francisco César GONÇALVES; Anastácia FONTANÉTTI',1,0),
(34,'199482438_Artigo.pdf','Bebida Láctea; Soro de Leite; Extrato hidrossolúvel de Soja.','ANÁLISE SENSORIAL DE UMA BEBIDA LÁCTEA PROBIÓTICA SABOR MORANGO À BASE DE SORO DO LEITE E EXTRATO HIDROSSOLÚVEL DE SOJA','CASTRO, Renan Luis Emídio de; LEITE JUNIOR, Bruno Ricardo de Castro; SILVA, Maurício Henriques Louzada, JOAQUIM, Leandro Oliveira, DAMIÃO, Alana Oliveira, SILVA, Vanessa Riani Olmi.',2,0),
(35,'1865469233_Artigo.pdf','carnes in natura, pH, atividade de água.','AVALIAÇÃO DAS CARACTERÍSTICAS FÍSICO-QUÍMICAS DE CARNES COMERCIALIZADAS NA REGIÃO DE RIO POMBA-MG','MARTINS, Aline Pereira; RODRIGUES, Marcela Zonta; ALVES, Glauciane de Oliveira; SILVA, Maurício Henriques Louzada; SILVA, Roselir Ribeiro da',2,0),
(36,'1989517068_Artigo.pdf','doce em massa, compota, análises físico-químicas.','AVALIAÇÃO DAS CARACTERÍSTICAS FÍSICO-QUÍMICAS DE DOCES PRODUZIDOS NA REGIÃO DE RIO POMBA–MG','RODRIGUES, Marcela Zonta; MARTINS, Aline Pereira; SILVA, Maurício Henriques Louzada; CRUZ, A. L. da; JOAQUIM, L. O.; MARTINS, E. M. F.',2,0),
(37,'2035942598_Artigo.pdf','IN 51; produtores rurais; qualidade do leite.','AVALIAÇÃO DO PERFIL DOS PRODUTORES RURAIS DO MUNICÍPIO DE RIO POMBA SEGUNDO A INSTRUÇÃO NORMATIVA N° 51','BARBOSA, Nayara Cantarino; MOREIRA, Moisses de Sousa; SILVA, Jeferson dos Santos; SILVA, Maurício Henriques Louzada',2,0),
(38,'1849348847_Artigo.pdf','doce de leite; aceitabilidade; sacarose.','AVALIAÇÃO SENSORIAL DE DOCE DE LEITE DE MARCAS DIFERENTES PRODUZIDO E CONSUMIDO NA CIDADE DE                   RIO POMBA','LEITE JUNIOR, Bruno Ricardo de Castro; LIMA, Thalisson Arrighi; GONZAGA, Anderson Luiz; BARBOSA, Ariele Fontes; OLIVEIRA, Mariana Porfírio de; GOMES; Wanessa Oliveira; DUTRA, Roberto Alves',2,0),
(39,'1931973646_Artigo.pdf','leite condensado; aceitabilidade; sacarose.','AVALIAÇÃO SENSORIAL DE LEITE CONDENSADO AÇUCARADO DE DIFERENTES LOTES PRODUZIDOS E CONSUMIDOS NA CIDADE DE RIO POMBA','SILVA, Nisael Buenes Nunes; LEITE JUNIOR, Bruno Ricardo de Castro; DUTRA, Roberto Alves; SILVA, Cleuber Raimundo da; ANDRADE, Arthur Alves de; OLIVEIRA, Allan Costa de.',2,0),
(3210,'667552813_13_11_2012.pdf','Aroma, corante, aceitação, iogurte.   ','EFEITO DE CONCENTRAÇÃO DE AROMAS E CORANTES NA  ACEITAÇÃO SENSORIAL DE IOGURTE SABOR MORANGO','Janaína     Aparecida Soares VALENTE, Marcella Pires de OLIVEIRA, Vanessa Riani  Olmi SILVA',5,0),
(3211,'720930168_13_11_2012.pdf','análises, leite pasteurizado, qualidade do leite','ANÁLISES MICROBIOLÓGICAS DE LEITE PASTEURIZADO FORNECIDO A UMA ESCOLA PÚBLICA NO MUNICÍPIO DE RIO POMBA-MG','Ana Paula Miguel Landim, Mariana Pacheco Neves, Adriana Procópio Loures Araújo, Anamares Ferreira Gomes, Aurélia Dornelas de Oliveira Martins',5,0),
(3212,'663508210_26_10_2012.pdf','Estágio Escolar. Normas. Responsabilidades.','Tratamento Jurídico do Estágio Escolar','André Luís da Silva gomes',5,0),
(3213,'111231667_12_11_2012.pdf','educação à distância; evasão','OS EVADIDOS ON-LINE: IDENTIFICANDO CAUSAS DA EVASÃO NA EDUCAÇÃO À DISTÂNCIA  ','Luciana Narciso de Mattos, Gustavo Henrique da Rocha Reis',5,0),
(3206,'426547250_28_10_2012.pdf','gamification, game design, game elements.','Gamification for Professionals in the Development Area of Electronic Games ','Ana Cristina Barbosa Faria, Alex F. da Veiga Machado, Emanoel Freitas, Priscyla dos Santos',5,0),
(3207,'1443450047_28_10_2012.pdf','Zea mays L., adubação orgânica, cama de frango, silagem.','PRODUÇÃO DE MILHO PARA SILAGEM COM UTILIZAÇÃO DE CAMA DE FRANGO','Carlos Rubens C. Ladeira FILHO , Marcos Luiz Rebouças BASTIANI , Silvane de Almeida CAMPOS, Sergio de Miranda PENA , Rodrigo de Paula FERREIRA ',5,0),
(3208,'1179957780_28_10_2012.pdf','Zea mays L., fertilizante orgânico, esterco de aviário, silagem','FERTILIZAÇÃO ORGÂNICA DO MILHO PARA SILAGEM COM ESTERCO DE AVIÁRIO ','Carlos Rubens C. Ladeira FILHO , Marcos Luiz Rebouças BASTIANI , Silvane de Almeida CAMPOS, Antônio Daniel Fernandes COELHO ',5,0),
(3209,'1294287290_28_10_2012.pdf',' boas práticas de fabricação; laticínios; check -list.','IMPLEMENTAÇÃO DAS BOAS PRÁTICAS DE FABRICAÇÃO EM LATICINIOS DO MUNICÍPIO DE RIO POMBA - MG','Nathânia de Sá Mendes, Ana Carolina Trindade, Dalila Pereira Linhares, Hellen Moretto Bicalho, Aurélia Dornelas de Oliveira Martins',5,0),
(3200,'1842276622_28_10_2012.pdf','-','Bebidas Lácteas Fermentadas Comercializadas em Rio Pomba, MG: Características e Adequação quanto a Requisitos Legais Estabelecidos no RTIQ.','Renata Leortina de Oliveira, Fernanda Marília Araújo Ferreira, Fabiana de Oliveira Martins, Maurilio Lopes Martins',5,0),
(3201,'757395365_15_11_2012.pdf','Data mining, KDD, tomada de decisão, sistema de apoio a decisão.','SISTEMA DE APOIO À DECISÃO CRIADO A PARTIR DA BASE DE DADOS DE UM SUPERMERCADO','Camila Maria Campos, Alex Ferreira da Veiga Machado',5,0),
(3202,'114903991_15_11_2012.pdf','inulina, orégano, bacon. ','DESENVOLVIMENTO DE PÃO DE QUEIJO PREBIÓTICO COM DIFERENTES AROMAS','Ronaldo Elias de Mello Júnior, Daniela Cristina Faria Vieira, Daiana de Souza Fernandes, Cleuber Antônio de Sá Silva',5,0),
(3203,'1327727638_09_11_2012.pdf','legislação; bebida-láctea; UHT','AVALIAÇÃO DE QUALIDADE FÍSICO-QUÍMICA DE BEBIDAS LÁCTEAS UHT COMERCIALIZADAS EM RIO POMBA, MG','Fernanda Marília Araújo Ferreira, Renata Leortina Oliveira, Fabiana Oliveira Martins, Maurilio Lopes Martins',5,0),
(3205,'1222882137_12_11_2012.pdf','Leite fermentado; Lactobacillus acidophillus; yacon.','Produção e caracterização de iogurte sabor coco enriquecido com Lactobacillus acidophillus e polpa de yacon','Amílcar José de Souza Paula, Guilherme Lima Guedes de Moraes, Matheus Ramos Reis, Aurélia Dornelas de Oliveira Martins, Eliane Maurício Furtado Martins, Maurilio Lopes Martins',5,0),
(3204,'43924405_28_10_2012.pdf','Qualidade fisiológica; matrizes.','COLEÇÃO E ARMAZENAMENTO DE SEMENTES DE ESPÉCIES ARBÓREAS NATIVAS','CAETANO, Dejair Felipe, CARDOSO, Igor Gomes, MELO, Paulo Regis Bandeira de',5,0),
(3198,'685723632_28_10_2012.pdf','Redes Neurais, Transferência indutiva, Aprendizado Multitarefa, generalização, redes  backpropagatio','ESTADO DA ARTE DA TRASFERÊNCIA INDUTIVA DE APRENDIZAGEM ATRAVÉS DE REDES NEURAIS','Eduardo de Barros Batista, Alex Fernandes da Veiga Machado, Alexandre de Castro Lunardi',5,0),
(3199,'1646075067_28_10_2012.pdf','chave: extrato, antimicrobiano, aroeira.','AVALIAÇÃO DE ANTIBIÓTICOS E EXTRATO BRUTO DE AROEIRA-DA-PRAIA CONTRA Staphylococcus aureus e Escherichia coli','Renata Leortina de Oliveira, Wanessa Oliveira Ribeiro, José Manoel Martins',5,0),
(3197,'394057196_13_11_2012.pdf','Derivado de milho; sujidades; umidade; microbiologia; microscopia','Avaliação Microscópica e Fisioquímica De Fubá de Moinho D`Água comercializados no Município de Rio Pomba-MG','Daiana De Souza Fernandes, Daniela Cristina Faria Vieira, Luiz Fellipe de Castro Artuso, Lúcia Léia Aparecida Vieira Silva, Cleuber Antonio de Sá Silva',5,0),
(3196,'1785446344_28_10_2012.pdf','assentamento rural; reforma agrária; MST.','ASSENTAMENTO OLGA BENÁRIO E INSTITUIÇÕES DE ENSINO PÚBLICO FEDERAIS: UMA PARCERIA COM POTENCIAL DE BONS RESULTADOS','Jean Felix Loubak, Danielle Cunha de Souza Pereira, Eli Lino de Jesus',5,0),
(3195,'2010749507_28_10_2012.pdf','Beneficiamento de alimentos; reforma agrária; MST.','PRÁTICA DE BENEFICIAMENTO E IMPLANTAÇÃO DE BOAS PRÁTICAS DE FABRICAÇÃO EM UNIDADE DE PROCESSAMENTO DE ALIMENTOS EM ASSENTAMENTO RURAL DO MST','Danielle Cunha de Souza Pereira, Jean Felix Loubak, Eli Lino de Jesus',5,0),
(3193,'1650081712_14_11_2012.pdf','Polinização, produtividade, conservação. ','POLINIZAÇÃO DE DIFERENTES CULTURAS AGRÍCOLAS: UMA AVALIAÇÃO DA IMPORTÂNCIA ECOLÓGICA DAS ABELHAS NA PRODUÇÃO DE FRUTOS','Vanessa Bonfá Benevenuto LODRON , Flávia Monteiro Coelho FERREIRA ',5,0),
(3194,'1687392403_07_11_2012.pdf',' Indicadores, APP e Conservação. ','ABELHAS COMO INDICADORES DE QUALIDADE AMBIENTAL EM UMA ÁREA DE PRESERVAÇÃO PERMANENTE DEGRADADA','Renata Bonfá BENEVENUTO, Flávia Monteiro Coelho FERREIRA ',5,0),
(3188,'1329717760_28_10_2012.pdf','Jogo de plataforma, Geração de fases automáticas, data mining.','Automatização do Processo de Geração de Fases em Jogos de Plataforma','Brígida Maria Teixeira Costa, Rodrigo Silva Pinto, Alex Fernandes da Veiga Machado',5,0),
(3189,'2050200576_28_10_2012.pdf','Era do conhecimento. Pesquisa e desenvolvimento. Crescimento econômico.','Evolução da inovação, propriedade intelectual e transferência de tecnologia no Brasil','Mateus Fontes Lourenço, Charles Okama de Souza, Maurilio Lopes Martins',5,0),
(3190,'1567391037_13_11_2012.pdf','Requeijão, físico-química, legislação.  ','Características Físico-Químicas de Requeijão Cremoso Comercializado no Município de Rio Pomba, MG.','Hellen Moretto Bicalho, Dalila Pereira Linhares, Nathânia de Sá Mendes, José Manoel Martins',5,0),
(3191,'2075489073_19_11_2012.pdf','Leite em pó, legislação, análises','VERIFICAÇÃO DOS PARÂMETROS DE IDENTIDADE E QUALDIADE DE LEITE EM PÓ INSTANTÂNEO E CONVENCIONAL COMERCIALIZADOS NO MERCADO NACIONAL','Hellen Moretto Bicalho, Dalila Pereira Linhares, Fabiana de Oliveira Martins',5,0),
(3192,'1557031052_10_11_2012.pdf','manteiga. qualidade. creme.','AVALIAÇÃO DA QUALIDADE DE MANTEIGAS COMERCIALIZADAS NO MUNICÍPIO DE RIO POMBA-MG','Wanessa Oliveira Ribeiro, Matheus de Ramos Reis, Fabiana de Oliveira Martins',5,0),
(3186,'2070361571_05_11_2012.pdf','Respiração do solo, microbiologia, agroecologia.','MONITORAMENTO DA QUALIDADE BIOLÓGICA DO SOLO EM SISTEMAS AGROECOLÓGICOS DE PRODUÇÃO – ANO 2.','Samuel da Costa MENDES, André Narvaes da Rocha CAMPOS',5,0),
(3187,'975061100_09_11_2012.pdf','Café; fisiologia vegetal; sombreamento.','RESPOSTA FISIOLÓGICA DO CAFEEIRO AO SOMBREAMENTO','Jean Felix Loubak, Laura Julia Carvalho Mendonça, Felipe Dantas Barbosa, Danielle Cunha de Souza Pereira, Andre Narvaes da Rocha Campos',5,0),
(3184,'1548186184_07_11_2012.pdf',': Qualidade. Legislação. Sorvete.','INVESTIGAÇÃO SOBRE A ADEQUAÇÃO DE GELADOS COMESTÍVEIS COMERCIALIZADOS NA REGIÃO DA ZONA DA MATA DE MINAS GERAIS QUANTO OS REQUISITOS LEGAIS ESTABELECIDOS NA LEGISLAÇÃO FEDERAL BRASILEIRA','Thais Jordânia Silva, Jéssica Fernandes Carvalhais, Fabiana de Oliveira Martins',5,0),
(3185,'224702571_08_11_2012.pdf','Produção de leite; Gestão da qualidade; Agricultura familiar.','DIAGNÓSTICO DE UNIDADES PRODUTORAS DE LEITE PERTENCENTES AO MUNICÍPIO DE RIO POMBA, MG','Vitor Rubim DIAS, José Manoel MARTINS, Thaís Jordânia SILVA ',5,0),
(3179,'443892876_26_10_2012.pdf','Gestão de estoques. Compras. Custos. Supermercado.','ESTUDO DE CASO: GESTÃO DE ESTOQUE NO SUPERMERCADO ELIZEMAR EM TABULEIRO-MG','Tatiane Aparecida, Karini Aparecida, Bruno Olher',5,0),
(3180,'263513604_26_10_2012.pdf','bacteriófago,sanitizante,patógenos.','Viabilidade de bacteriófagos de Escherichia coli  em diferentes concentrações de hipoclorito  de sódio','Mariana Gomes De Oliveira, Maryoris Elisa Soto Lopez, Eyder Caio Cal, REGINA CELIA SANTOS MENDONCA, Lais Silva Batalha',5,0),
(3181,'924402465_26_10_2012.pdf','Confecção. Produção. Tempo. Layout.','A IMPORTÂNCIA DO ESTUDO DO TEMPO NA PRODUÇÃO DAS CONFECÇÕES','Viviane Aparecida do Nascimento, Ítala Moraes Teixeira, Bruno Silva Olher',5,0),
(3182,'1582887494_27_10_2012.pdf','Desenvolvimento de Sistemas; Workflow; Transparência  Pública para a Iniciação Científica. ','Transparência Pública na Iniciação Científica','Vinícius Paixão Costa Jesus, Juliano Costa Penha Alves, Frederico de Miranda Coelho',5,0),
(3183,'848583025_13_11_2012.pdf','Leite. Produtor. Sujidades. Qualidade.','AVALIAÇÃO MICROSCOPICA DE LEITE in natura  ENVASADO EM GARRAFA PET COMERCIALIZADO NO MUNICÍPIO DE RIO POMBA','Daniela Cristina Faria Vieira , Lúcia Léia Aparecida Vieira Silva , Luíz Fellipe de Castro Artuso, Daiana de Souza Fernandes , Cleuber Antonio de Sá Silva',5,0),
(3168,'1102522828_26_10_2012.pdf','recuperação de áreas degradadas; extinção de espécies  nativas; produção de mudas.','PROPAGAÇÃO CLONAL DE JACARANDÁ (Dalbergia nigra Allem) POR MINIESTAQUIA','Felipe Côrrea RIBEIRO, Gabriel Reis FAGUNDES, Antônio Daniel Fernandes COELHO, Ana Catarina Monteiro Carvalho Mori da Cunha',5,0),
(3169,'1739490159_26_10_2012.pdf','aula, reforço, física.','Aulas de Reforço de Física para alunos do Ensino Médio do Município de Rio Pomba','Tahieny Kelly de Carvalho',5,0),
(3170,'1889045320_26_10_2012.pdf','Custos de produção. Informatização rural. Administração rural. Pecuária bovina','AVALIAÇÃO DAS METODOLOGIAS DE CÁLCULO DE CUSTO DE PRODUÇÃO UTILIZADAS EM SOFTWARES PARA GERENCIAMENTO DA PECUÁRIA BOVINA','Andressa da Silva Bhering, Henri Cócaro, Rodrigo Maurício da Silva',5,0),
(3171,'813977350_10_11_2012.pdf','Microbiota, Respiração Basal do Solo, Respiração Induzida por Sacarose.','RESPIRAÇÃO BASAL E INDUZIDA POR SUBSTRATO DE CARBONO EM SOLOS PROVENIENTES DO PLANTIO DE MILHO CONSORCIADO COM DIFERENTES ESPÉCIES ','Gustavo Sampaio de Lima Martins, André Narvaes da Rocha Campos',5,0),
(3172,'1093502324_12_11_2012.pdf','Análise Crítica; Revisão de literatura; Oprimidos; Educação Matemática','A Educação Matemática para os Oprimidos','Franciano Benevenuto Caetano, Carina Alves Granato, Paula Reis de Miranda',5,0),
(3173,'2025705357_26_10_2012.pdf','Proeja; Agente Comunitário de Saúde; Perfil.','O Perfil dos Alunos do PROEJA do Câmpus Rio Pomba','Thamiriz Martins Teixeira, Luciana de Freitas Baptista Oliveira, Bianca Coutinho Lopes, Paula Reis de Miranda',5,0),
(3174,'506852223_26_10_2012.pdf','Língua Inglesa; currículo; ensino','Projeto Inglês no Câmpus (PIC-RP)','Matheus de Freitas Oliveira Baffa, Maria Catarina Paiva Rêpoles, Marcela Zambolim de Moura, Josimar Gonçalves Ribeiro',5,0),
(3175,'532168560_08_11_2012.pdf',' Geometria  Plana;  Aulas  Diferenciadas;  Aprendizagem Significativa.','EDUCAÇÃO MATEMÁTICA: A PRÁTICA EM CONSTRUÇÃO','Claudenir José dos Santos, Amanda Fernandes Campos Vieira, Heveraldo Vitor Gomes, Raquel Vidigal Santiago ',5,0),
(3176,'193980516_13_11_2012.pdf','fotoperído; estro; progesterona.','EFEITOS DA SINCRONIZAÇÃO DE ESTRO EM CABRAS LEITEIRAS POR ALTERAÇÃO DO FOTOPERÍODO E DIFERENTES HORMÔNIOS','Helder Pessata de Almeida, Lucas Paschoalino Martins, Edilson Rezende Cappelle',5,0),
(3177,'970540391_26_10_2012.pdf',' sobrepeso; obesidade; adolescentes','PREVALÊNCIA DE SOBREPESO E OBESIDADE EM ADOLESCENTES MATRICULADOS EM UM INSTITUTO FEDERAL DE ENSINO','Fernando Peres Ferreira, Ronaldo José de Oliveira Bernardino, Frederico Souzalima Caldoncelli Franco, Matheus Santos Cerqueira, Ricardo Campos de Faria, Gustavo Pasqualini de Sousa',5,0),
(3178,'1302784471_13_11_2012.pdf','dispositivo móvel, jogo educacional, ensino-aprendizagem de Matemática','Ensino de Matemática Apoiado em uma Nova Ferramenta Pedagógica para M-Learning ','Paôla Pinto Cazetta, Priscyla Cristhina dos Santos , Ulysses Ozório Santos , Marlon Cunha Santiago, Rafael Rodrigues Padovani, Maria Cristina Silva Oliveira, Alex Fernandes da Veiga Machado ',5,0),
(3167,'219560395_26_10_2012.pdf','recuperação de áreas degradadas; extinção de espécies  nativas; produção de mudas.','PROPAGAÇÃO CLONAL DE PAU-BRASIL (Caesalpinia echinata Lam.) POR MINIESTAQUIA','Gabriel Reis FAGUNDES, Felipe Côrrea RIBEIRO, Antônio Daniel Fernandes COELHO, Ana Catarina Monteiro Carvalho Mori da Cunha',5,0),
(3166,'103065563_18_11_2012.pdf','a. Crescimento microbiano. Homeopátia. Phosphorus. ','PREPARADO HOMEOPÁTICO Phosphorus NO CRESCIMENTO DE Escherichia coli.','José Victor Hosken Cruz, André Narvaes da Rocha Campos, Fernanda Maria Coutinho de Andrade, Emi Rainildes  Lorenzetti',5,0),
(3165,'1417729773_25_10_2012.pdf','Transporte coletivo urbano. Análise Fatorial. Índice Geral de Satisfação.','Sistema de Transporte Coletivo de Muriaé-MG: Análise de Satisfação no Atendimento à População','Glenda Furlani Assad, Edirley Souza Magalhães, Tharcisio Alexandrino Caldeira',5,0),
(3164,'1842414654_06_11_2012.pdf','Atacado. Varejo. Atacarejo.','Atacarejo: Quais os benefícios desta nova tendência de mercado?','Daniela de Mattos Estavanati, João Paulo Bapstista de Oliveira, Bruno Silva Olher',5,0),
(3163,'136220591_25_10_2012.pdf','50 anos do Câmpus Rio Pomba. Modelagem Matemática. Modelo Logístico','Modelo Matemático da Evolução do Número de Matrículas nos Cursos Superiores do IF Sudeste MG - Câmpus Rio Pomba','Marcos Coutinho Mota, Diánis Ferreira Irias, Josislei de Passos Vieira, Flávio Bittencourt',5,0),
(3157,'552400694_12_11_2012.pdf',' Qualidade; Sorvete; ADQ.','AVALIAÇÃO DA QUALIDADE SENSORIAL E FÍSICO-QUÍMICA DE DIFERENTES MARCAS DE SORVETE SABOR CREME','Mônica Santana Moreira, Ana Carolina Trindade, Janaína Aparecida Soares Valente, Vanessa Riani Olmi Silva',5,0),
(3158,'1261614419_29_10_2012.pdf','Variedades, Zea mays, Agricultura Familiar.','PLANTAÇÃO DE MILHO CRIOULO NAS MICROREGIÕES DE UBÁ E  VIÇOSA','Joara Secchi CANDIAN, Carlos Rubens Cadete LADEIRA FILHO, Marcos Luiz R.  BASTIANI, Antônio Daniel Fernandes COELHO',5,0),
(3159,'785865493_13_11_2012.pdf','Estrutura física, Restaurantes, Boas Práticas de Fabricação.','Estrutura física de uma Unidade de Alimentação e Nutrição (UAN) Localizada em Ubá-MG','Alexandre de Castro Pereira, Thamiris da Rocha Daniel, Aurélia Dornelas de Oliveira Martins',5,0),
(3160,'23489333_09_11_2012.pdf','Potabilidade, contaminação, alimentos.','AVALIÇÃO FÍSICO QUIMICA E MICROBIOLOGICA DA ÁGUA DOS BEBEDOUROS DO IF SUDESTE MG CAMPUS RIO POMBA','Fidelis SOUZA, Aurélia Dornelas de Oliveira MARTINS',5,0),
(3161,'1301830197_16_11_2012.pdf','Eluente. Floculação. pH. ','Adequação de um modelo de tratamento convencional de efluentes à Usina de Beneficiamento do IF Sudeste MG, Campus Rio Pomba','Amanda Pureza Leite, Bruno Gaudereto Soares, Onofre Barroca de Almeida Neto, Vanessa Riani Olmi Silva, Líria Yuri Souza Miura, Leonardo de Oliveira Tostes',5,0),
(3162,'705401205_09_11_2012.pdf','simpósio; Web; sistema.','Simulador de Montagem e Manutenção','Maristela Esmério Assis de Andrade, Gustavo Henrique da Rocha Reis, Nivalda Aparecida Conde de Oliveira',5,0),
(3156,'1486169422_28_10_2012.pdf','Inovação. Novo Produto. Queijo.','ELABORAÇÃO E AVALIAÇÃO DA ACEITAÇÃO DE UM NOVO PRODUTO LÁCTEO','Jéssica Fernandes Carvalhais, Stephane Lima Dias NUNES, Fabiana de Oliveira Martins, Flávio Bittencourte',5,0),
(3154,'1663090508_14_11_2012.pdf','Cloro residual. Qualidade da água. Potabilidade. Água de abastecimento.','AVALIAÇÃO FISICO-QUÍMICA DA ÁGUA DA REDE DE DISTRIBUIÇÃO QUE ABASTECE O IF SUDESTE MG CÂMPUS RIO POMBA','Luíz Fellipe de Castro Artuso, Cleuber Antonio de Sá Silva, Maurício Henrique Louzada Silva',5,0),
(3155,'1783889328_13_11_2012.pdf','Suinocultura. Nutrição. Soro de Leite.','UTILIZAÇÃO DE DIFERENTES MANEIRAS DE FORNECIMENTO DE SORO DE LEITE EM DIETAS DE SUÍNOS EM CRESCIMENTO','Soraia Viana Ferreira, Cristiano Gonzaga Jayme, Sérgio de Miranda Pena, Diana Carla Fernandes Oliveira, Raiana Gonçalves Moreira, Marciana Teixeira de Souza',5,0),
(3153,'934069919_14_11_2012.pdf','Leite. Qualidade. Perfil do Produtor','PERFIL DO PRODUTOR DE LEITE DO MUNICÍPIO DE RIO POMBA/MG E VERIFICAÇÃO DE ASPECTOS DA QUALIDADE DO LEITE PRODUZIDO','Ronaldo Elias de Mello Júnior, Fabiana de Oliveira Martins',5,0),
(3150,'121722798_07_11_2012.pdf','Descentralização fiscal. Arrecadação Tributaria. ISSQN.','ARRECADAÇÃO TRIBUTÁRIA DOS MUNICÍPIOS DE MINAS GERAIS: UMA AVALIAÇÃO DO IMPOSTO SOBRE SERVIÇOS DE QUALQUER NATUREZA (ISSQN).','BRUNA RODRIGUES DE FREITAS, ARIANE DE OLIVEIRA FIALHO, CHARLES OKAMA DE SOUZA',5,0),
(3151,'2062456934_28_10_2012.pdf','Leite, UHT, qualidade.','QUALIDADE FÍSICO-QUÍMICA E SENSORIAL DE LEITE UHT COMERCIALIZADO NA ZONA DA MATA MINEIRA','Luana Virgínia Souza, Vinicius Álvares da Silva Meloni, Cláudia Lúcia de Oliveira Pinto, Letícia Loures de Oliveira , Maurilio Lopes Martins',5,0),
(3152,'470599598_17_12_2012.pdf','Lablabe, feijão-de-porco, leguminosas, produção orgânica','AVALIAÇÃO CONTINUADA DO EFEITO DA CONSORCIAÇÃO DE ADUBOS VERDES COM CAFEEIROS','João Batista dos Santos, Tatiana Pires Barrella, Francisco César Gonçalves , Ricardo Henrique Silva Santos',5,0),
(3148,'1022467270_11_11_2012.pdf','Extratos vegetais, sanitizante, processamento mínimo.','Inibição Bacteriana por extratos vegetais e avaliação da eficiência de seu uso na sanitização de couve (Brassica oleracea L.) minimamente processada','Franklin Júnior Moreira da Silva, Rodrigo de Oliveira Madeira, Maurilio Lopes Martins, Eliane Maurício Furtado Martins, André Narvaes da Rocha Campos',5,0),
(3149,'1991069694_13_11_2012.pdf','Bacon, defumação, aditivos.','EFEITO DO USO DE ADITIVOS NA ACEITAÇÃO SENSORIAL E CARACTERÍSTICAS FÍSICO - QUÍMICAS DE BACON DE SUÍNO DEFUMADO','Ana Carolina Trindade, Rosilene Ferreira Chaves, Mônica Santana Moreira, Janaína Aparecida Soares Valente, Josemário Gonçalves da Silva, Vanessa Riani Olmi Silva, Maurício Henriques Louzada Silva',5,0),
(3140,'1675326549_28_10_2012.pdf','Fosfatase. Tratamento térmico. Segurança alimentar','Averiguação do Limite de Detecção do Método Oficial Brasileiro e de um Método Rápido para Determinação de Fosfatase Alcalina em Leite','Renato Gonçalves Pereira, Fabiana de Oliveira Martins, Joice de Oliveira Cabral',5,0),
(3141,'805789937_28_10_2012.pdf','Probiótico; Funcional; Lactobacillus casei','VIABILIDADE DAS BACTÉRIAS LÁTICAS EM BEBIDA LÁCTEA COM DIFERENTES CONCENTRAÇOES DE SORO EM PÓ','Thaís Jordânia Silva, Amanda Bomtempo Soares, Jéssica Fernandes Carvalhais,  Vitor Rubim Dias, Mariane Verônica de Oliveira, Aurélia Dornelas de Oliveira Martins',5,0),
(3142,'183162062_28_10_2012.pdf','leite, mesófilos, psicrotróficos','DETERMINAÇÃO DE BACTÉRIAS MESÓFILAS E PSICROTRÓFICAS EM LEITE CRU REFRIGERADO DA REGIÃO DE RIO POMBA-MG','Dalila Pereira Linhares, Thiago Rodrigues Padovani, Gisele Inocêncio Pereira e Moreira , Maurilio Lopes Martins',5,0),
(3143,'139473180_28_10_2012.pdf','Máquinas agrícolas, Segurança e Ergonomia','DIAGNÓSTICO DAS CONDIÇÕES ERGONÔMICAS COM TRATORES AGRÍCOLAS NA MICRORREGIÃO DE RIO POMBA, MINAS GERAIS','Aécio Granato da Trindade, Paula Cristina Natalino Rinaldi, Cleyton Batista de Alvarenga, Haroldo Carlos Fernandes',5,0),
(3144,'1805128489_28_10_2012.pdf','aplicação de questionário; carqueja; novo produto.','Aplicação de questionário para avaliar a aceitação de biscoito amanteigado enriquecido com carqueja','Vitor de Sousa Lelis, Raquel Marques Soares, Isabela Campelo de Queiroz, Fabiana de Oliveira Martins, Eliane Maurício Furtado Martins',5,0),
(3145,'1187139234_28_10_2012.pdf','infecção; patógenos; leite cru.','Enumeração de micro-organismos do leite cru dos bovinos em lactação do rebanho leiteiro de uma propriedade do Município de Rio Pomba, Minas Gerais.','Wanessa Oliveira Ribeiro, Renata Leortina de Oliveira, Maurilio Lopes Martins, José Manoel Martins, Angelo Herbet Moreira Arcanjo',5,0),
(3146,'385418301_07_11_2012.pdf','Filme ativo; Soja; Conservação; Antimicrobiano; Microbiologia; Halos.','DESENVOLVIMENTO DE EMBALAGEM ATIVA AROMATIZADA E ADICIONADA DE ANTIMICROBIANO PARA UTILIZAÇÃO EM TOFU','Daiana De Souza Fernandes, Daniela Cristina Faria Vieira, Cleuber Antonio de Sá Silva',5,0),
(3147,'2103049032_11_11_2012.pdf','desinfestação superficial; hipoclorito de sódio; micropropagação.','GERMINAÇÃO ASSÉPTICA IN VITRO DE SEMENTES DE BRAÚNA-PRETA (Melanoxylon brauna Schot.)','Fabrício Palla Teixeira, Ana Catarina Monteiro Carvalho Mori da C, André Narvaes da Rocha Campos, Antônio Daniel Fernandes Coelho',5,0),
(3137,'1305722983_13_11_2012.pdf','Biscoito, carqueja. Funcional.','UTILIZAÇÃO DE DIFERENTES CONCENTRAÇÕES DE EXTRATO SECO DE CARQUEJA PARA PRODUÇÃO DE BISCOITOS TIPO “AMANTEIGADO”.','Raquel Marques Soares, Ruth Maria de Campos, Isabela Campelo de Queiroz, Eliane Maurício Furtado Martins, Fabiana de Oliveira Martins, Vitor de Sousa Lelis',5,0),
(3138,'764949104_28_10_2012.pdf',': mastite bovina, mastite clínica, mastite subclínica, CMT.','Ocorrências de Mastite Clínica e Subclínica no Rebanho Leiteiro do IF Sudeste MG Campus Rio Pomba','Angelo Herbet Moreira Arcanjo, Edilson Rezende Cappelle, Wanessa Oliveira Ribeiro , Paulo César Santos Oliveira, Bruno Grossi Costa Homem, Cristiano Gonzaga Jayme, José Manoel Martins ',5,0),
(3139,'1939828849_28_10_2012.pdf','Estilosantes, braquiária, solo, fósforo.','Relação das pastagens consorciadas com leguminosas com os componentes do solo','Paulo César Santos Oliveira, Gustavo Henrique de Souza, Angelo Herbet Moreira Arcanjo, Valdir Botega Tavares',5,0),
(208,'2108526124_Artigo.pdf','tipos de café; análise sensorial; preferência.','ANÁLISE SENSORIAL DE CAFÉ DE DIFERENTES GRAUS DE TORRA','Tamara Piubelo Soares MADEIRA; Lorrani do Carmo TEIXEIRA; Ana Paula Lamas GOULART; Claudia Raissa Coelho ANTUNES; Eliane Mauricio Furtado MARTINS',4,0),
(209,'1278857191_Artigo.pdf','Municípios, Federalismo Fiscal, Contabilidade Pública.','DESCENTRALIZAÇÃO FISCAL: ANÁLISE DAS DESPESAS PÚBLICAS NOS MUNICÍPIOS DE MINAS GERAIS NO PERÍODO 2005-2008.','Bruna Rodrigues de FREITAS; Ariane de Oliveira FIALHO; Charles Okama de SOUZA; etc. ',4,0),
(210,'1066899885_Artigo.pdf','Soja. ADQ. Bebida Láctea.','CARACTERIZAÇÃO SENSORIAL DE BEBIDAS LÁCTEAS PROBIÓTICAS SABOR MORANGO ELABORADAS À BASE DE EXTRATO HIDROSSOLÚVEL DE SOJA E SORO DE LEITE','Ana Sílvia Boroni de OLIVEIRA; Renan Luiz Emídio CASTRO; Vanessa Riani Olmi SILVA; Jéssyca Aparecida Roberto COSTA; Sylvia Maria Demolinari LOPES; Mauricio Henriques Louzada SILVA',4,0),
(211,'1759580801_Artigo.pdf','Reaproveitamento de subprodutos; Aceitação sensorial; Okara.','DOCE DE MANGA CREMOSO CONTENDO FARINHA PROVENIENTE DO EXTRATO HIDROSSOLÚVEL DE SOJA: AVALIAÇÃO SENSORIAL DE COR, AROMA E TEXTURA','CASTRO, Renan Luís Emídio; LEITE JÚNIOR, Bruno Ricardo de Castro; OLIVEIRA, Patrícia Martins de ; LAMAS, Joaquim Mário Neiva; MARTINS',4,0),
(216,'858426941_Artigo.pdf','Agricultura Familiar; agricultores; Rio Pomba.','PERFIL PRODUTIVO, GERENCIAMENTO E ASPECTOS SOCIO CULTURAIS NA AGRICULTURA NO MUNICIPIO DE RIO POMBA','Rafael de Assis Oliveira GONÇALVES; Wildson Justiniano PINTO',4,0),
(214,'768880724_Artigo.pdf','Agricultura Familiar; agricultores; Rio Pomba.','PERFIL PRODUTIVO, GERENCIAMENTO E ASPECTOS SOCIO CULTURAIS NA AGRICULTURA NO MUNICIPIO DE RIO POMBA','Rafael de Assis Oliveira GONÇALVES; Wildson Justiniano PINTO.',4,0),
(215,'2088813873_Artigo.pdf','Brassica oleracea var. capitata, Crotalaria juncea, nitrogênio','EFEITO DA ADUBAÇÃO VERDE E DO COMPOSTO ORGÂNICO NO CRESCIMENTO E PRODUÇÃO DO REPOLHO','Ariany das Graças TEIXEIRA; Sebastião Lucas Aparecido CIRICO; Lucas Luís FAUSTINO; Bianca de Jesus SOUZA; Tatiana Pires BARRELLA; Thiago de Oliveira VARGAS ',4,0),
(213,'1994617769_Artigo.pdf','Bebida Fermentada. Desenvolvimento de produto. Avalição físico-química.','ELABORAÇÃO E ANÁLISE FÍSICO-QUÍMICA DE BEBIDAS LÁCTEAS  SIMBIÓTICAS À BASE DE SORO DO LEITE E EXTRATO HIDROSSOLÚVEL DE SOJA','Renan Luis Emídio de CASTRO; Ana Silvia Boroni de OLIVEIRA; Maurício Henriques Louzada SILVA; Vanessa Riani Olmi SILVA; Bruno Ricardo de Castro LEITE JUNIOR',4,0),
(212,'1656817580_Artigo.pdf',' Índices Econômicos; Mercado de Trabalho; Educação.','POTENCIAL DE DESENVOLVIMENTO SOCIOECONÔMICO DA ZONA DA MATA MINEIRA E A IMPORTÂNCIA DOS INSTITUTOS FEDERAIS DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA','MARTINS, Mauro César; TOLEDO, Gilson Soares; TEIXEIRA , Manoel Tadeu; MOREIRA, Francisco de Assis; FIÚZA, Ana Louise de Carvalho',4,0),
(207,'1560379622_Artigo.pdf','Conservação; Processamento; Pós-colheita.','AVALIAÇÃO MICROBIOLÓGICA DE YACON MINIMAMENTE PROCESSADO ADICIONADO DE SOLUÇÃO CONSERVADORA E EMBALADOS EM DIFERENTES ATMOSFERAS','Cínthia Marotta FERNANDES, Franklin Júnior Moreira da SILVA, Patrícia Martins de OLIVEIRA; Bruno Ricardo de Castro Leite JÚNIOR',4,0),
(206,'332601059_Artigo.pdf','resumo; normas; regras.','USO DA GEOESTATÍSTICA PARA PLANEJAMENTO DE EXPERIMENTOS','ORDEIRO JÚNIOR, José Beraldo; MOTA, Monice Silveria; BITTENCOURT, Flávio; GONÇALVES, Francisco César; BASTIANI, Marcos Luiz Rebouças, BRANDÃO, João Eudes Ribeiro',4,0),
(203,'564797572_Artigo.pdf','Modelo de decisão. Effectuation. Racional-causal.','MODELO DE DECISÃO EFFECTUATION: UMA ALTERNATIVA PARA O ESTUDO DA CRIAÇÃO DE NOVOS NEGÓCIOS','Emanuelly Alves PELOGIO; Luiz Célio Souza ROCHA',4,0),
(204,'589068466_Artigo.pdf','Plantação, frutas, hortaliças.','DIAGNÓSTICO DA CADEIA PRODUTIVA DE FRUTAS E HORTALIÇAS NO MUNICÍPIO DE RIO POMBA, MINAS GERAIS','OLIVEIRA, Renata Leortina de; COSTA, Jessyca Aparecida Roberto; VIEIRA, Daniela Cristina Faria; MARTINS, Eliane Maurício Furtado; MARTINS, Maurilio Lopes',4,0),
(205,'1443600443_Artigo.pdf','aditivo; mensuração; morfologia; índices','UTILIZAÇÃO DE ADITIVOS ALIMENTARES EM POTRAS MANGALARGA MARCHADOR','Marciana Teixeira de SOUZA; Paulo César Santos OLIVEIRA; Juliana Ferreira ROCHA; Diana Carla Fernandes OLIVEIRA; Cristiano Gonzaga JAYME.',4,0),
(200,'1743661604_Artigo.pdf','Ficus carica, CFD, coeficiente de convecção.','ESTUDO DA INFLUÊNCIA DO COEFICIENTE CONVECTIVO NA REFRIGERAÇAO DO FIGO “ROXO DE VALINHOS”','Sylvia Maria Demolinari LOPES, Solimar Gonçalves MACHADO ',4,0),
(201,'707327532_Artigo.pdf','multiagent system, M5P, Architecture.','An Architecture Based on M5P Algorithm for Multiagent Systems','Cristiano G. Duarte; Marcos V. Montanari',4,0),
(202,'23573235_Artigo.pdf','Gerenciamento de Projetos, PMBOK, Metodologia','RESUMO DE UMA METODOLOGIA PARA GERENCIAMENTO DE PROJETOS','Emerson Augusto Priamo MORAES, PMP',4,0),
(3127,'1148953094_09_11_2012.pdf','Ruminantes, Biodiesel, Nabo forrageiro, Ensilagem.','TORTA DE NABO FORRAGEIRO (Raphanus sativus) ENSILADA COM CAPIM ELEFANTE (Pennisetum purpureum) NA ALIMENTAÇÃO DE RUMINANTES ','Marciana Teixeira de Souza, Arnaldo Prata Neiva Júnior, Valdir Botega Tavares, Gustavo Henrique de Souza, Soraia Viana Ferreira, Diana Carla Fernandes Oliveira, Raiana Gonçalves Moreira',5,0),
(3128,'1554789967_26_10_2012.pdf','Desenvolvimento de Sistemas; Problemas no Desenvolvimento; Informatização do Setor de Alojamento','Sistema de Controle de Alunos do Alojamento','Reydrick Marcos Góes Lourenço, Vinícios Paixão Costa Jesus, Frederico Miranda coelho',5,0),
(3129,'1225921521_27_10_2012.pdf','análise de sementes, espécie florestal, qualidade fisiológica.','EFEITO DE SUBSTRATOS NA GERMINAÇÃO DE SEMENTES DE CANUDO DE PITO (MABEA FISTULIFERA)','LUCIANA DE MOURA GONZAGA, PAULO REGIS BANDEIRA DE MELO',5,0),
(3130,'2100047789_27_10_2012.pdf','Desenvolvimento de Sistemas; Problemas no  Desenvolvimento; Informatização do Setor de Alojamento.','Problemas no Desenvolvimento de Sistemas','Reydrick Marcos Góes Lourenço, Vinícius Paixão Costa Jesus, Frederico de Miranda Coelho',5,0),
(3131,'45200140_12_11_2012.pdf','atributo, aceitação, diferenciação.','EFEITO DE CONCENTRAÇÃO DE AROMAS NA ACEITAÇÃO SENSORIAL DE IOGURTE SABOR MORANGO E PÊSSEGO','Aline de Fátima Silvério, Mônica Santana Moreira, Ana Carolina Trindade, Janaína Aparecida Soares Valente, Vanessa Riani Olmi Silva',5,0),
(3132,'267459265_27_10_2012.pdf','Produção de forragem, altura da planta, efluentes, fertilidade do solo.','PRODUÇÃO DE Brachiaria decumbens cv. Basilisk FERTIRRIGADA COM ÁGUA RESIDUÁRIA DE SUÍNOS','BRUNO GROSSI COSTA HOMEM, ONOFRE BARROCA DE ALMEIDA NETO, MARISA SENRA CONDÉ, MATEUS DINIZ SILVA, IGOR MACHADO FERREIRA, VALDIR BOTEGA TAVARES, FLÁVIO BITTENCOURT',5,0),
(3133,'741253649_27_10_2012.pdf','Adubação orgânica, disposição no solo, efluente de suínos.','ALTERAÇÕES QUÍMICAS DE UM LATOSSOLO PELA APLICAÇÃO DE ÁGUAS RESIDUÁRIAS DA SUINOCULTURA.','MARISA SENRA CONDÉ, ONOFRE BARROCA DE ALMEIDA NETO, BRUNO GROSSI COSTA HOMEM, IGOR MACHADO FERREIRA, MATEUS DINIZ SILVA, VALDIR BOTEGA TAVARES, FLÁVIO BITTENCOURT',5,0),
(3134,'1808954250_14_11_2012.pdf','Enzima. Leite. Qualidade. Soro.','AVALIAÇÃO DOS EFEITOS DA APLICAÇÃO DE TRANSGLUTAMINASE EM BEBIDA LÁCTEA COM ALTO CONTEÚDO DE SORO LÍQUIDO ','Daniela Cristina Faria Vieira,  Cleuber Antonio de Sá Silva, Vanessa Riani Olmi da Silva',5,0),
(3135,'468026865_09_11_2012.pdf','Descentralização fiscal. Arrecadação Tributária. IPTU.','ARRECADAÇÃO TRIBUTÁRIA DOS MUNICÍPIOS DE MINAS GERAIS: UMA AVALIAÇÃO DO IMPOSTO SOBRE PROPRIEDADE PREDIAL E TERRITORIAL URBANA (IPTU).','ARIANE DE OLIVEIRA FIALHO, BRUNA RODRIGUES DE FREITAS, CHARLES OKAMA DE SOUZA',5,0),
(3136,'1855435132_27_10_2012.pdf','Pisolithus. Scleroderma. Basidiocarpos.','INCIDÊNCIA E ISOLAMENTO DE FUNGOS ECTOMICORRÍZICOS EM PLANTAÇÃO DE Eucalyptus urograndis','Vanessa Pereira de Abreu, Carolina Shimohara de Barros, André Narvaes da Rocha Campos',5,0),
(3126,'397075893_15_11_2012.pdf','vegetal, processamento, conservação, pós-colheita.','USO DE SOLUÇÃO CONSERVADORA EM YACON MINIMAMENTE PROCESSADO EMBALADO EM DIFERENTES ATMOSFERAS','Cínthia Marotta Fernandes, Cristiany Oliveira Bernardo, Luma Rossi Ribeiro, Eliane Maurício Furtado Martins, Maurilio Lopes Martins',5,0),
(3124,'840223898_26_10_2012.pdf','Bebida Fermentada, Probiótico, Maracujá, L. rhamnosus.','AVALIAÇÃO FÍSICO-QUÍMICA E MICROBIOLÓGICA DE BEBIDA MISTA DE MARACUJÁ COM INHAME FERMENTADA POR L. rhamnosus','Cristiany Oliveira Bernardo, Inayara Beatriz Araújo martins, Cinthia Marotta Fernandes, Eliane Maurício Furtado Martins, Maurilio Lopes Martins',5,0),
(3125,'147408650_26_10_2012.pdf','Coliformes termotolerantes, bebida láctea, contaminação','Avaliação de coliformes em bebida láctea fermentada','Mariane Verônica de Oliveira, Thaís Jordania Silva, Amanda Bontempo Soares, Aurélia Dornelas de Oliveira Martins',5,0),
(3123,'948440669_26_10_2012.pdf','Agroecologia. Câmpus Rio Pomba. Georreferenciamento.','VARIAÇÃO ESPACIAL DA MATÉRIA ORGÂNICA DO SOLO NA ÁREA DESTINADA AOS EXPERIMENTOS EM CAMPO DO SETOR DE AGROECOLOGIA (IF SUDESTE – MG, CÂMPUS RIO POMBA)','José Beraldo Cordeiro Junior, Monice Silveira Mota, Flávio Bittencourt, Francisco César Gonçalves, Marcos Luiz Rebouças Bastiani, João Eudes Ribeiro Brandão',5,0),
(3117,'850143040_09_11_2012.pdf','Merenda escolar, contaminação, alimentos','DIAGNÓSTICO DA AVALIAÇÃO MICROBIOLÓGICA DE AMBIENTES DO PROCESSAMENTO E CONSUMO DE ALIMENTOS DAS ESCOLAS MUNICIPAIS DE UMA CIDADE DO INTERIOR DE MINAS GERAIS','Thamiris da Rocha Daniel, Akexandre de Castro Pereira, Aurélia Dornelas de Oliveira Martins',5,0),
(3118,'1187972621_12_11_2012.pdf','práticas higiênicas, crianças, manipuladores.','AVALIAÇÃO MICROBIOLÓGICA DE MERENDEIRAS DE UMA ESCOLA MUNICIPAL DE MINAS GERAIS','Thamiris da Rocha Daniel, Alexandre Pereira de Castro, Aurélia Dornelas de Oliveira Martins, Eliane M. Furtado Martins, Maurilio Lopes Martins',5,0),
(3119,'923143993_25_10_2012.pdf','Jogo Educacional, Ambiente Colaborativo, 3D.','Um jogo educacional 3D para estudo de vestibular','Ana Mara de Oliveira Figueiredo, Leandro dos Santos S`antana, Alex Machado',5,0),
(3120,'28658011_25_10_2012.pdf','cognitive, classification, game, genre.','A Proposal of Cognitive Classification of Electronic Games','Rafael Rodrigues Padovani, Ismael Antônio Batista, Marlon Cunha Santiago, Alex Fernandes da Veiga Machado, Bruno Gaudereto Soares, Esteban Walter Gonzalez Clua, Sandro de Paiva Carvalho',5,0),
(3121,'1704958300_26_10_2012.pdf','Matemática. Interdisciplinaridade. Material Didático. Curso Técnico em Agropecuária.','A MATEMÁTICA NA FORMAÇÃO DO TÉCNICO EM AGROPECUÁRIA: A EFETIVAÇÃO DO CURRÍCULO INTEGRADO','Thais Aparecida Pacheco, Josislei de Passos Vieira, Paula Reis de Miranda',5,0),
(3122,'455711315_16_11_2012.pdf','Iniciação Científica. Material Didático. Análise Real.','Análise na Reta: Um Texto para Licenciatura em Matemática','Marcos Coutinho Mota, Marcos Pavani de Carvalho',5,0),
(3115,'1382111229_23_10_2012.pdf','simpósio; Web; sistema.','SIGTEC – SISTEMA DE GERÊNCIA DE TRABALHOS TÉCNICOS CIENTÍFICOS via Web ','Racyus Delano Garcia Pacífico, Gustavo Henrique da Rocha Reis',5,0),
(3116,'1492543160_12_11_2012.pdf','APL Moveleiro de Ubá. Marketing de Causas Sociais. Marketing Social. Marketing  Societal. Responsabi','RESPONSABILIDADE SOCIAL CORPORATIVA E USO DE INICIATIVAS DE MARKETING PARA O BEM ESTAR DA SOCIEDADE: ESTUDO NO APL MOVELEIRO DE UBÁ.','Vanessa Oliveira da Silva, Andréia Aparecida Albino, Bruno Silva Olher, Afonso Augusto Teixeira de Freitas de Carvalho Lima, Géssica Vilela de Oliveira',5,0),
(3226,NULL,NULL,NULL,NULL,6,34),
(3225,NULL,NULL,NULL,NULL,6,21),
(3227,NULL,NULL,NULL,NULL,6,47),
(3228,NULL,NULL,NULL,NULL,6,65),
(3229,NULL,NULL,NULL,NULL,6,29),
(3230,NULL,NULL,NULL,NULL,6,74),
(3231,NULL,NULL,NULL,NULL,6,81),
(3232,NULL,NULL,NULL,NULL,6,77),
(3233,NULL,NULL,NULL,NULL,6,35),
(3234,NULL,NULL,NULL,NULL,6,38),
(3235,NULL,NULL,NULL,NULL,6,44),
(3236,NULL,NULL,NULL,NULL,6,46),
(3237,NULL,NULL,NULL,NULL,6,63),
(3238,NULL,NULL,NULL,NULL,6,70),
(3239,NULL,NULL,NULL,NULL,6,76),
(3240,NULL,NULL,NULL,NULL,6,82),
(3241,NULL,NULL,NULL,NULL,6,85),
(3242,NULL,NULL,NULL,NULL,6,90),
(3243,NULL,NULL,NULL,NULL,6,126),
(3244,NULL,NULL,NULL,NULL,6,1),
(3245,NULL,NULL,NULL,NULL,6,19),
(3246,NULL,NULL,NULL,NULL,6,62),
(3247,NULL,NULL,NULL,NULL,6,121),
(3248,NULL,NULL,NULL,NULL,6,129),
(3249,NULL,NULL,NULL,NULL,6,2),
(3250,NULL,NULL,NULL,NULL,6,7),
(3251,NULL,NULL,NULL,NULL,6,8),
(3252,NULL,NULL,NULL,NULL,6,10),
(3253,NULL,NULL,NULL,NULL,6,11),
(3254,NULL,NULL,NULL,NULL,6,49),
(3255,NULL,NULL,NULL,NULL,6,55),
(3256,NULL,NULL,NULL,NULL,6,116),
(3257,NULL,NULL,NULL,NULL,6,123),
(3258,NULL,NULL,NULL,NULL,6,128),
(3259,NULL,NULL,NULL,NULL,6,15),
(3260,NULL,NULL,NULL,NULL,6,16),
(3261,NULL,NULL,NULL,NULL,6,26),
(3262,NULL,NULL,NULL,NULL,6,27),
(3263,NULL,NULL,NULL,NULL,6,28),
(3264,NULL,NULL,NULL,NULL,6,33),
(3265,NULL,NULL,NULL,NULL,6,59),
(3266,NULL,NULL,NULL,NULL,6,60),
(3267,NULL,NULL,NULL,NULL,6,61),
(3268,NULL,NULL,NULL,NULL,6,84),
(3269,NULL,NULL,NULL,NULL,6,91),
(3270,NULL,NULL,NULL,NULL,6,92),
(3271,NULL,NULL,NULL,NULL,6,96),
(3272,NULL,NULL,NULL,NULL,6,98),
(3273,NULL,NULL,NULL,NULL,6,99),
(3274,NULL,NULL,NULL,NULL,6,100),
(3275,NULL,NULL,NULL,NULL,6,102),
(3276,NULL,NULL,NULL,NULL,6,110),
(3277,NULL,NULL,NULL,NULL,6,118),
(3278,NULL,NULL,NULL,NULL,6,124),
(3279,NULL,NULL,NULL,NULL,6,127),
(3280,NULL,NULL,NULL,NULL,6,132),
(3281,NULL,NULL,NULL,NULL,6,12),
(3282,NULL,NULL,NULL,NULL,6,20),
(3283,NULL,NULL,NULL,NULL,6,67),
(3284,NULL,NULL,NULL,NULL,6,68),
(3285,NULL,NULL,NULL,NULL,6,23),
(3286,NULL,NULL,NULL,NULL,6,37),
(3287,NULL,NULL,NULL,NULL,6,36),
(3288,NULL,NULL,NULL,NULL,6,41),
(3289,NULL,NULL,NULL,NULL,6,39),
(3290,NULL,NULL,NULL,NULL,6,40),
(3291,NULL,NULL,NULL,NULL,6,42),
(3292,NULL,NULL,NULL,NULL,6,43),
(3293,NULL,NULL,NULL,NULL,6,50),
(3294,NULL,NULL,NULL,NULL,6,51),
(3295,NULL,NULL,NULL,NULL,6,52),
(3296,NULL,NULL,NULL,NULL,6,53),
(3297,NULL,NULL,NULL,NULL,6,64),
(3298,NULL,NULL,NULL,NULL,6,69),
(3299,NULL,NULL,NULL,NULL,6,71),
(3300,NULL,NULL,NULL,NULL,6,72),
(3301,NULL,NULL,NULL,NULL,6,79),
(3302,NULL,NULL,NULL,NULL,6,80),
(3303,NULL,NULL,NULL,NULL,6,87),
(3304,NULL,NULL,NULL,NULL,6,89),
(3305,NULL,NULL,NULL,NULL,6,93),
(3306,NULL,NULL,NULL,NULL,6,95),
(3307,NULL,NULL,NULL,NULL,6,94),
(3308,NULL,NULL,NULL,NULL,6,97),
(3309,NULL,NULL,NULL,NULL,6,103),
(3310,NULL,NULL,NULL,NULL,6,104),
(3311,NULL,NULL,NULL,NULL,6,107),
(3312,NULL,NULL,NULL,NULL,6,108),
(3313,NULL,NULL,NULL,NULL,6,111),
(3314,NULL,NULL,NULL,NULL,6,112),
(3315,NULL,NULL,NULL,NULL,6,113),
(3316,NULL,NULL,NULL,NULL,6,119),
(3317,NULL,NULL,NULL,NULL,6,130),
(3318,NULL,NULL,NULL,NULL,6,4),
(3319,NULL,NULL,NULL,NULL,6,5),
(3320,NULL,NULL,NULL,NULL,6,9),
(3321,NULL,NULL,NULL,NULL,6,13),
(3322,NULL,NULL,NULL,NULL,6,14),
(3323,NULL,NULL,NULL,NULL,6,17),
(3324,NULL,NULL,NULL,NULL,6,22),
(3325,NULL,NULL,NULL,NULL,6,30),
(3326,NULL,NULL,NULL,NULL,6,31),
(3327,NULL,NULL,NULL,NULL,6,45),
(3328,NULL,NULL,NULL,NULL,6,56),
(3329,NULL,NULL,NULL,NULL,6,57),
(3330,NULL,NULL,NULL,NULL,6,75),
(3331,NULL,NULL,NULL,NULL,6,78),
(3332,NULL,NULL,NULL,NULL,6,88),
(3333,NULL,NULL,NULL,NULL,6,105),
(3334,NULL,NULL,NULL,NULL,6,114),
(3335,NULL,NULL,NULL,NULL,6,117),
(3336,NULL,NULL,NULL,NULL,6,131),
(3689,NULL,NULL,NULL,NULL,7,142),
(3688,NULL,NULL,NULL,NULL,7,137),
(3687,NULL,NULL,NULL,NULL,7,130),
(3686,NULL,NULL,NULL,NULL,7,126),
(3685,NULL,NULL,NULL,NULL,7,125),
(3684,NULL,NULL,NULL,NULL,7,114),
(3683,NULL,NULL,NULL,NULL,7,110),
(3682,NULL,NULL,NULL,NULL,7,98),
(3681,NULL,NULL,NULL,NULL,7,97),
(3680,NULL,NULL,NULL,NULL,7,93),
(3679,NULL,NULL,NULL,NULL,7,89),
(3678,NULL,NULL,NULL,NULL,7,88),
(3677,NULL,NULL,NULL,NULL,7,81),
(3676,NULL,NULL,NULL,NULL,7,78),
(3675,NULL,NULL,NULL,NULL,7,76),
(3674,NULL,NULL,NULL,NULL,7,74),
(3673,NULL,NULL,NULL,NULL,7,63),
(3672,NULL,NULL,NULL,NULL,7,73),
(3671,NULL,NULL,NULL,NULL,7,26),
(3670,NULL,NULL,NULL,NULL,7,22),
(3669,NULL,NULL,NULL,NULL,7,27),
(3668,NULL,NULL,NULL,NULL,7,20),
(3667,NULL,NULL,NULL,NULL,7,19),
(3666,NULL,NULL,NULL,NULL,7,15),
(3665,NULL,NULL,NULL,NULL,7,141),
(3664,NULL,NULL,NULL,NULL,7,132),
(3663,NULL,NULL,NULL,NULL,7,124),
(3662,NULL,NULL,NULL,NULL,7,118),
(3661,NULL,NULL,NULL,NULL,7,117),
(3660,NULL,NULL,NULL,NULL,7,116),
(3659,NULL,NULL,NULL,NULL,7,111),
(3658,NULL,NULL,NULL,NULL,7,108),
(3657,NULL,NULL,NULL,NULL,7,104),
(3656,NULL,NULL,NULL,NULL,7,103),
(3655,NULL,NULL,NULL,NULL,7,100),
(3654,NULL,NULL,NULL,NULL,7,99),
(3653,NULL,NULL,NULL,NULL,7,102),
(3652,NULL,NULL,NULL,NULL,7,80),
(3651,NULL,NULL,NULL,NULL,7,75),
(3650,NULL,NULL,NULL,NULL,7,70),
(3649,NULL,NULL,NULL,NULL,7,149),
(3648,NULL,NULL,NULL,NULL,7,58),
(3647,NULL,NULL,NULL,NULL,7,56),
(3646,NULL,NULL,NULL,NULL,7,55),
(3645,NULL,NULL,NULL,NULL,7,51),
(3644,NULL,NULL,NULL,NULL,7,39),
(3643,NULL,NULL,NULL,NULL,7,42),
(3642,NULL,NULL,NULL,NULL,7,37),
(3641,NULL,NULL,NULL,NULL,7,36),
(3640,NULL,NULL,NULL,NULL,7,35),
(3639,NULL,NULL,NULL,NULL,7,34),
(3638,NULL,NULL,NULL,NULL,7,33),
(3637,NULL,NULL,NULL,NULL,7,32),
(3636,NULL,NULL,NULL,NULL,7,23),
(3635,NULL,NULL,NULL,NULL,7,17),
(3634,NULL,NULL,NULL,NULL,7,16),
(3633,NULL,NULL,NULL,NULL,7,143),
(3632,NULL,NULL,NULL,NULL,7,139),
(3631,NULL,NULL,NULL,NULL,7,136),
(3630,NULL,NULL,NULL,NULL,7,134),
(3629,NULL,NULL,NULL,NULL,7,128),
(3628,NULL,NULL,NULL,NULL,7,127),
(3627,NULL,NULL,NULL,NULL,7,121),
(3626,NULL,NULL,NULL,NULL,7,147),
(3625,NULL,NULL,NULL,NULL,7,107),
(3624,NULL,NULL,NULL,NULL,7,105),
(3623,NULL,NULL,NULL,NULL,7,101),
(3622,NULL,NULL,NULL,NULL,7,95),
(3621,NULL,NULL,NULL,NULL,7,94),
(3620,NULL,NULL,NULL,NULL,7,92),
(3619,NULL,NULL,NULL,NULL,7,90),
(3618,NULL,NULL,NULL,NULL,7,85),
(3617,NULL,NULL,NULL,NULL,7,82),
(3616,NULL,NULL,NULL,NULL,7,79),
(3615,NULL,NULL,NULL,NULL,7,77),
(3614,NULL,NULL,NULL,NULL,7,66),
(3613,NULL,NULL,NULL,NULL,7,59),
(3612,NULL,NULL,NULL,NULL,7,46),
(3611,NULL,NULL,NULL,NULL,7,25),
(3610,NULL,NULL,NULL,NULL,7,146),
(3609,NULL,NULL,NULL,NULL,7,120),
(3608,NULL,NULL,NULL,NULL,7,119),
(3607,NULL,NULL,NULL,NULL,7,84),
(3606,NULL,NULL,NULL,NULL,7,68),
(3605,NULL,NULL,NULL,NULL,7,72),
(3604,NULL,NULL,NULL,NULL,7,53),
(3603,NULL,NULL,NULL,NULL,7,52),
(3602,NULL,NULL,NULL,NULL,7,50),
(3601,NULL,NULL,NULL,NULL,7,49),
(3600,NULL,NULL,NULL,NULL,7,48),
(3599,NULL,NULL,NULL,NULL,7,131),
(3598,NULL,NULL,NULL,NULL,7,54),
(3597,NULL,NULL,NULL,NULL,7,30),
(3596,NULL,NULL,NULL,NULL,7,29),
(3595,NULL,NULL,NULL,NULL,7,24),
(3594,NULL,NULL,NULL,NULL,7,2),
(3593,NULL,NULL,NULL,NULL,7,123),
(3592,NULL,NULL,NULL,NULL,7,122),
(3591,NULL,NULL,NULL,NULL,7,135),
(3590,NULL,NULL,NULL,NULL,7,106),
(3589,NULL,NULL,NULL,NULL,7,91),
(3588,NULL,NULL,NULL,NULL,7,148),
(3587,NULL,NULL,NULL,NULL,7,67),
(3586,NULL,NULL,NULL,NULL,7,64),
(3585,NULL,NULL,NULL,NULL,7,40),
(3584,NULL,NULL,NULL,NULL,7,28),
(3583,NULL,NULL,NULL,NULL,7,140),
(3582,NULL,NULL,NULL,NULL,7,138),
(3581,NULL,NULL,NULL,NULL,7,113),
(3580,NULL,NULL,NULL,NULL,7,115),
(3579,NULL,NULL,NULL,NULL,7,112),
(3578,NULL,NULL,NULL,NULL,7,45),
(3577,NULL,NULL,NULL,NULL,7,41),
(3690,NULL,NULL,NULL,NULL,8,18),
(3691,NULL,NULL,NULL,NULL,8,21),
(3692,NULL,NULL,NULL,NULL,8,58),
(3693,NULL,NULL,NULL,NULL,8,60),
(3694,NULL,NULL,NULL,NULL,8,84),
(3695,NULL,NULL,NULL,NULL,8,71),
(3696,NULL,NULL,NULL,NULL,8,88),
(3697,NULL,NULL,NULL,NULL,8,105),
(3698,NULL,NULL,NULL,NULL,8,119),
(3699,NULL,NULL,NULL,NULL,8,121),
(3700,NULL,NULL,NULL,NULL,8,124),
(3701,NULL,NULL,NULL,NULL,8,152),
(3702,NULL,NULL,NULL,NULL,8,29),
(3703,NULL,NULL,NULL,NULL,8,52),
(3704,NULL,NULL,NULL,NULL,8,57),
(3705,NULL,NULL,NULL,NULL,8,3),
(3706,NULL,NULL,NULL,NULL,8,42),
(3707,NULL,NULL,NULL,NULL,8,15),
(3708,NULL,NULL,NULL,NULL,8,141),
(3709,NULL,NULL,NULL,NULL,8,19),
(3710,NULL,NULL,NULL,NULL,8,27),
(3711,NULL,NULL,NULL,NULL,8,33),
(3712,NULL,NULL,NULL,NULL,8,37),
(3713,NULL,NULL,NULL,NULL,8,59),
(3714,NULL,NULL,NULL,NULL,8,95),
(3715,NULL,NULL,NULL,NULL,8,111),
(3716,NULL,NULL,NULL,NULL,8,136),
(3717,NULL,NULL,NULL,NULL,8,7),
(3718,NULL,NULL,NULL,NULL,8,81),
(3719,NULL,NULL,NULL,NULL,8,92),
(3720,NULL,NULL,NULL,NULL,8,134),
(3721,NULL,NULL,NULL,NULL,8,120),
(3722,NULL,NULL,NULL,NULL,8,135),
(3723,NULL,NULL,NULL,NULL,8,140),
(3724,NULL,NULL,NULL,NULL,8,23),
(3725,NULL,NULL,NULL,NULL,8,24),
(3726,NULL,NULL,NULL,NULL,8,65),
(3727,NULL,NULL,NULL,NULL,8,66),
(3728,NULL,NULL,NULL,NULL,8,145),
(3729,NULL,NULL,NULL,NULL,8,153),
(3730,NULL,NULL,NULL,NULL,8,17),
(3731,NULL,NULL,NULL,NULL,8,26),
(3732,NULL,NULL,NULL,NULL,8,39),
(3733,NULL,NULL,NULL,NULL,8,43),
(3734,NULL,NULL,NULL,NULL,8,44),
(3735,NULL,NULL,NULL,NULL,8,47),
(3736,NULL,NULL,NULL,NULL,8,48),
(3737,NULL,NULL,NULL,NULL,8,49),
(3738,NULL,NULL,NULL,NULL,8,50),
(3739,NULL,NULL,NULL,NULL,8,51),
(3740,NULL,NULL,NULL,NULL,8,63),
(3741,NULL,NULL,NULL,NULL,8,126),
(3742,NULL,NULL,NULL,NULL,8,72),
(3743,NULL,NULL,NULL,NULL,8,74),
(3744,NULL,NULL,NULL,NULL,8,75),
(3745,NULL,NULL,NULL,NULL,8,133),
(3746,NULL,NULL,NULL,NULL,8,131),
(3747,NULL,NULL,NULL,NULL,8,132),
(3748,NULL,NULL,NULL,NULL,8,106),
(3749,NULL,NULL,NULL,NULL,8,107),
(3750,NULL,NULL,NULL,NULL,8,127),
(3751,NULL,NULL,NULL,NULL,8,112),
(3752,NULL,NULL,NULL,NULL,8,114),
(3753,NULL,NULL,NULL,NULL,8,116),
(3754,NULL,NULL,NULL,NULL,8,158),
(3755,NULL,NULL,NULL,NULL,8,151),
(3756,NULL,NULL,NULL,NULL,8,143),
(3757,NULL,NULL,NULL,NULL,8,146),
(3758,NULL,NULL,NULL,NULL,8,148),
(3759,NULL,NULL,NULL,NULL,8,4),
(3760,NULL,NULL,NULL,NULL,8,20),
(3761,NULL,NULL,NULL,NULL,8,128),
(3762,NULL,NULL,NULL,NULL,8,28),
(3763,NULL,NULL,NULL,NULL,8,30),
(3764,NULL,NULL,NULL,NULL,8,32),
(3765,NULL,NULL,NULL,NULL,8,36),
(3766,NULL,NULL,NULL,NULL,8,40),
(3767,NULL,NULL,NULL,NULL,8,41),
(3768,NULL,NULL,NULL,NULL,8,56),
(3769,NULL,NULL,NULL,NULL,8,67),
(3770,NULL,NULL,NULL,NULL,8,76),
(3771,NULL,NULL,NULL,NULL,8,77),
(3772,NULL,NULL,NULL,NULL,8,80),
(3773,NULL,NULL,NULL,NULL,8,82),
(3774,NULL,NULL,NULL,NULL,8,83),
(3775,NULL,NULL,NULL,NULL,8,85),
(3776,NULL,NULL,NULL,NULL,8,86),
(3777,NULL,NULL,NULL,NULL,8,87),
(3778,NULL,NULL,NULL,NULL,8,89),
(3779,NULL,NULL,NULL,NULL,8,90),
(3780,NULL,NULL,NULL,NULL,8,91),
(3781,NULL,NULL,NULL,NULL,8,93),
(3782,NULL,NULL,NULL,NULL,8,101),
(3783,NULL,NULL,NULL,NULL,8,102),
(3784,NULL,NULL,NULL,NULL,8,108),
(3785,NULL,NULL,NULL,NULL,8,125),
(3786,NULL,NULL,NULL,NULL,8,109),
(3787,NULL,NULL,NULL,NULL,8,115),
(3788,NULL,NULL,NULL,NULL,8,129),
(3789,NULL,NULL,NULL,NULL,8,122),
(3790,NULL,NULL,NULL,NULL,8,130),
(3791,NULL,NULL,NULL,NULL,8,137),
(3792,NULL,NULL,NULL,NULL,8,138),
(3793,NULL,NULL,NULL,NULL,8,142),
(3794,NULL,NULL,NULL,NULL,8,144),
(3795,NULL,NULL,NULL,NULL,8,147),
(3796,NULL,NULL,NULL,NULL,8,155),
(3797,NULL,NULL,NULL,NULL,8,1),
(3798,NULL,NULL,NULL,NULL,8,2),
(3799,NULL,NULL,NULL,NULL,8,6),
(3800,NULL,NULL,NULL,NULL,8,5),
(3801,NULL,NULL,NULL,NULL,8,22),
(3802,NULL,NULL,NULL,NULL,8,8),
(3803,NULL,NULL,NULL,NULL,8,9),
(3804,NULL,NULL,NULL,NULL,8,10),
(3805,NULL,NULL,NULL,NULL,8,12),
(3806,NULL,NULL,NULL,NULL,8,14),
(3807,NULL,NULL,NULL,NULL,8,31),
(3808,NULL,NULL,NULL,NULL,8,34),
(3809,NULL,NULL,NULL,NULL,8,35),
(3810,NULL,NULL,NULL,NULL,8,46),
(3811,NULL,NULL,NULL,NULL,8,53),
(3812,NULL,NULL,NULL,NULL,8,55),
(3813,NULL,NULL,NULL,NULL,8,62),
(3814,NULL,NULL,NULL,NULL,8,64),
(3815,NULL,NULL,NULL,NULL,8,68),
(3816,NULL,NULL,NULL,NULL,8,69),
(3817,NULL,NULL,NULL,NULL,8,70),
(3818,NULL,NULL,NULL,NULL,8,73),
(3819,NULL,NULL,NULL,NULL,8,78),
(3820,NULL,NULL,NULL,NULL,8,99),
(3821,NULL,NULL,NULL,NULL,8,100),
(3822,NULL,NULL,NULL,NULL,8,104),
(3823,NULL,NULL,NULL,NULL,8,123),
(3824,NULL,NULL,NULL,NULL,8,156),
(3825,NULL,NULL,NULL,NULL,9,64),
(3826,NULL,NULL,NULL,NULL,9,79),
(3827,NULL,NULL,NULL,NULL,9,86),
(3828,NULL,NULL,NULL,NULL,9,120),
(3829,NULL,NULL,NULL,NULL,9,142),
(3830,NULL,NULL,NULL,NULL,9,152),
(3831,NULL,NULL,NULL,NULL,9,171),
(3832,NULL,NULL,NULL,NULL,9,223),
(3833,NULL,NULL,NULL,NULL,9,239),
(3834,NULL,NULL,NULL,NULL,9,256),
(3835,NULL,NULL,NULL,NULL,9,295),
(3836,NULL,NULL,NULL,NULL,9,399),
(3837,NULL,NULL,NULL,NULL,9,404),
(3838,NULL,NULL,NULL,NULL,9,417),
(3839,NULL,NULL,NULL,NULL,9,430),
(3841,NULL,NULL,NULL,NULL,9,303),
(3842,NULL,NULL,NULL,NULL,12,12),
(3843,NULL,NULL,NULL,NULL,12,16),
(3844,NULL,NULL,NULL,NULL,12,23),
(3845,NULL,NULL,NULL,NULL,12,28),
(3846,NULL,NULL,NULL,NULL,12,93),
(3847,NULL,NULL,NULL,NULL,12,30),
(3848,NULL,NULL,NULL,NULL,12,48),
(3849,NULL,NULL,NULL,NULL,12,35),
(3850,NULL,NULL,NULL,NULL,12,45),
(3851,NULL,NULL,NULL,NULL,12,64),
(3852,NULL,NULL,NULL,NULL,12,86),
(3853,NULL,NULL,NULL,NULL,12,90),
(3854,NULL,NULL,NULL,NULL,12,97),
(3855,NULL,NULL,NULL,NULL,12,99),
(3856,NULL,NULL,NULL,NULL,12,107),
(3857,NULL,NULL,NULL,NULL,12,114),
(3858,NULL,NULL,NULL,NULL,12,132),
(3859,NULL,NULL,NULL,NULL,12,143),
(3860,NULL,NULL,NULL,NULL,12,1),
(3861,NULL,NULL,NULL,NULL,12,6),
(3862,NULL,NULL,NULL,NULL,12,10),
(3863,NULL,NULL,NULL,NULL,12,15),
(3864,NULL,NULL,NULL,NULL,12,18),
(3865,NULL,NULL,NULL,NULL,12,20),
(3866,NULL,NULL,NULL,NULL,12,21),
(3867,NULL,NULL,NULL,NULL,12,25),
(3868,NULL,NULL,NULL,NULL,12,32),
(3869,NULL,NULL,NULL,NULL,12,33),
(3870,NULL,NULL,NULL,NULL,12,40),
(3871,NULL,NULL,NULL,NULL,12,44),
(3872,NULL,NULL,NULL,NULL,12,46),
(3873,NULL,NULL,NULL,NULL,12,51),
(3874,NULL,NULL,NULL,NULL,12,52),
(3875,NULL,NULL,NULL,NULL,12,58),
(3876,NULL,NULL,NULL,NULL,12,69),
(3877,NULL,NULL,NULL,NULL,12,95),
(3878,NULL,NULL,NULL,NULL,12,130),
(3879,NULL,NULL,NULL,NULL,12,38),
(3880,NULL,NULL,NULL,NULL,12,76),
(3881,NULL,NULL,NULL,NULL,12,71),
(3882,NULL,NULL,NULL,NULL,12,73),
(3883,NULL,NULL,NULL,NULL,12,74),
(3884,NULL,NULL,NULL,NULL,12,77),
(3885,NULL,NULL,NULL,NULL,12,91),
(3886,NULL,NULL,NULL,NULL,12,104),
(3887,NULL,NULL,NULL,NULL,12,105),
(3888,NULL,NULL,NULL,NULL,12,124),
(3889,NULL,NULL,NULL,NULL,12,131),
(3890,NULL,NULL,NULL,NULL,12,135),
(3891,NULL,NULL,NULL,NULL,12,140),
(3892,NULL,NULL,NULL,NULL,12,4),
(3893,NULL,NULL,NULL,NULL,12,5),
(3894,NULL,NULL,NULL,NULL,12,70),
(3895,NULL,NULL,NULL,NULL,12,116),
(3896,NULL,NULL,NULL,NULL,12,128),
(3897,NULL,NULL,NULL,NULL,12,133),
(3898,NULL,NULL,NULL,NULL,12,138),
(3899,NULL,NULL,NULL,NULL,12,144),
(3900,NULL,NULL,NULL,NULL,12,17),
(3901,NULL,NULL,NULL,NULL,12,36),
(3902,NULL,NULL,NULL,NULL,12,61),
(3903,NULL,NULL,NULL,NULL,12,62),
(3904,NULL,NULL,NULL,NULL,12,109),
(3905,NULL,NULL,NULL,NULL,12,136),
(3906,NULL,NULL,NULL,NULL,12,137),
(3907,NULL,NULL,NULL,NULL,12,3),
(3908,NULL,NULL,NULL,NULL,12,22),
(3909,NULL,NULL,NULL,NULL,12,29),
(3910,NULL,NULL,NULL,NULL,12,31),
(3911,NULL,NULL,NULL,NULL,12,43),
(3912,NULL,NULL,NULL,NULL,12,47),
(3913,NULL,NULL,NULL,NULL,12,53),
(3914,NULL,NULL,NULL,NULL,12,55),
(3915,NULL,NULL,NULL,NULL,12,56),
(3916,NULL,NULL,NULL,NULL,12,59),
(3917,NULL,NULL,NULL,NULL,12,63),
(3918,NULL,NULL,NULL,NULL,12,65),
(3919,NULL,NULL,NULL,NULL,12,66),
(3920,NULL,NULL,NULL,NULL,12,67),
(3921,NULL,NULL,NULL,NULL,12,68),
(3922,NULL,NULL,NULL,NULL,12,75),
(3923,NULL,NULL,NULL,NULL,12,82),
(3924,NULL,NULL,NULL,NULL,12,83),
(3925,NULL,NULL,NULL,NULL,12,87),
(3926,NULL,NULL,NULL,NULL,12,88),
(3927,NULL,NULL,NULL,NULL,12,96),
(3928,NULL,NULL,NULL,NULL,12,100),
(3929,NULL,NULL,NULL,NULL,12,101),
(3930,NULL,NULL,NULL,NULL,12,102),
(3931,NULL,NULL,NULL,NULL,12,103),
(3932,NULL,NULL,NULL,NULL,12,110),
(3933,NULL,NULL,NULL,NULL,12,111),
(3934,NULL,NULL,NULL,NULL,12,112),
(3935,NULL,NULL,NULL,NULL,12,117),
(3936,NULL,NULL,NULL,NULL,12,120),
(3937,NULL,NULL,NULL,NULL,12,122),
(3938,NULL,NULL,NULL,NULL,12,125),
(3939,NULL,NULL,NULL,NULL,12,127),
(3940,NULL,NULL,NULL,NULL,12,8),
(3941,NULL,NULL,NULL,NULL,12,19),
(3942,NULL,NULL,NULL,NULL,12,34),
(3943,NULL,NULL,NULL,NULL,12,37),
(3944,NULL,NULL,NULL,NULL,12,41),
(3945,NULL,NULL,NULL,NULL,12,57),
(3946,NULL,NULL,NULL,NULL,12,60),
(3947,NULL,NULL,NULL,NULL,12,118),
(3948,NULL,NULL,NULL,NULL,12,81),
(3949,NULL,NULL,NULL,NULL,12,94),
(3950,NULL,NULL,NULL,NULL,12,115),
(3951,NULL,NULL,NULL,NULL,12,119),
(3952,NULL,NULL,NULL,NULL,12,121),
(3953,NULL,NULL,NULL,NULL,12,142),
(3954,NULL,NULL,NULL,NULL,12,146),
(3955,NULL,NULL,NULL,NULL,12,113),
(3956,NULL,NULL,NULL,NULL,12,7),
(3957,NULL,NULL,NULL,NULL,12,9),
(3958,NULL,NULL,NULL,NULL,12,14),
(3959,NULL,NULL,NULL,NULL,12,26),
(3960,NULL,NULL,NULL,NULL,12,50),
(3961,NULL,NULL,NULL,NULL,12,92),
(3962,NULL,NULL,NULL,NULL,12,129),
(3963,NULL,NULL,NULL,NULL,13,14),
(3964,NULL,NULL,NULL,NULL,13,54),
(3965,NULL,NULL,NULL,NULL,13,55),
(3966,NULL,NULL,NULL,NULL,13,61),
(3967,NULL,NULL,NULL,NULL,13,66),
(3968,NULL,NULL,NULL,NULL,13,77),
(3969,NULL,NULL,NULL,NULL,13,80),
(3970,NULL,NULL,NULL,NULL,13,103),
(3971,NULL,NULL,NULL,NULL,13,115),
(3972,NULL,NULL,NULL,NULL,13,1),
(3973,NULL,NULL,NULL,NULL,13,4),
(3974,NULL,NULL,NULL,NULL,13,5),
(3975,NULL,NULL,NULL,NULL,13,18),
(3976,NULL,NULL,NULL,NULL,13,23),
(3977,NULL,NULL,NULL,NULL,13,31),
(3978,NULL,NULL,NULL,NULL,13,48),
(3979,NULL,NULL,NULL,NULL,13,49),
(3980,NULL,NULL,NULL,NULL,13,72),
(3981,NULL,NULL,NULL,NULL,13,93),
(3982,NULL,NULL,NULL,NULL,13,126),
(3983,NULL,NULL,NULL,NULL,13,127),
(3984,NULL,NULL,NULL,NULL,13,136),
(3985,NULL,NULL,NULL,NULL,13,137),
(3986,NULL,NULL,NULL,NULL,13,10),
(3987,NULL,NULL,NULL,NULL,13,11),
(3988,NULL,NULL,NULL,NULL,13,16),
(3989,NULL,NULL,NULL,NULL,13,20),
(3990,NULL,NULL,NULL,NULL,13,21),
(3991,NULL,NULL,NULL,NULL,13,22),
(3992,NULL,NULL,NULL,NULL,13,25),
(3993,NULL,NULL,NULL,NULL,13,26),
(3994,NULL,NULL,NULL,NULL,13,27),
(3995,NULL,NULL,NULL,NULL,13,28),
(3996,NULL,NULL,NULL,NULL,13,32),
(3997,NULL,NULL,NULL,NULL,13,35),
(3998,NULL,NULL,NULL,NULL,13,33),
(3999,NULL,NULL,NULL,NULL,13,34),
(4000,NULL,NULL,NULL,NULL,13,37),
(4001,NULL,NULL,NULL,NULL,13,45),
(4002,NULL,NULL,NULL,NULL,13,52),
(4003,NULL,NULL,NULL,NULL,13,73),
(4004,NULL,NULL,NULL,NULL,13,79),
(4005,NULL,NULL,NULL,NULL,13,74),
(4006,NULL,NULL,NULL,NULL,13,76),
(4007,NULL,NULL,NULL,NULL,13,85),
(4008,NULL,NULL,NULL,NULL,13,84),
(4009,NULL,NULL,NULL,NULL,13,86),
(4010,NULL,NULL,NULL,NULL,13,87),
(4011,NULL,NULL,NULL,NULL,13,88),
(4012,NULL,NULL,NULL,NULL,13,107),
(4013,NULL,NULL,NULL,NULL,13,130),
(4014,NULL,NULL,NULL,NULL,13,17),
(4015,NULL,NULL,NULL,NULL,13,29),
(4016,NULL,NULL,NULL,NULL,13,128),
(4017,NULL,NULL,NULL,NULL,13,62),
(4018,NULL,NULL,NULL,NULL,13,63),
(4019,NULL,NULL,NULL,NULL,13,67),
(4020,NULL,NULL,NULL,NULL,13,68),
(4021,NULL,NULL,NULL,NULL,13,69),
(4022,NULL,NULL,NULL,NULL,13,71),
(4023,NULL,NULL,NULL,NULL,13,78),
(4024,NULL,NULL,NULL,NULL,13,83),
(4025,NULL,NULL,NULL,NULL,13,102),
(4026,NULL,NULL,NULL,NULL,13,89),
(4027,NULL,NULL,NULL,NULL,13,99),
(4028,NULL,NULL,NULL,NULL,13,100),
(4029,NULL,NULL,NULL,NULL,13,108),
(4030,NULL,NULL,NULL,NULL,13,109),
(4031,NULL,NULL,NULL,NULL,13,110),
(4032,NULL,NULL,NULL,NULL,13,111),
(4033,NULL,NULL,NULL,NULL,13,112),
(4034,NULL,NULL,NULL,NULL,13,113),
(4035,NULL,NULL,NULL,NULL,13,117),
(4036,NULL,NULL,NULL,NULL,13,135),
(4037,NULL,NULL,NULL,NULL,13,138),
(4038,NULL,NULL,NULL,NULL,13,24),
(4039,NULL,NULL,NULL,NULL,13,38),
(4040,NULL,NULL,NULL,NULL,13,98),
(4041,NULL,NULL,NULL,NULL,13,120),
(4042,NULL,NULL,NULL,NULL,13,124),
(4043,NULL,NULL,NULL,NULL,13,131),
(4044,NULL,NULL,NULL,NULL,13,30),
(4045,NULL,NULL,NULL,NULL,13,122),
(4046,NULL,NULL,NULL,NULL,13,53),
(4047,NULL,NULL,NULL,NULL,13,56),
(4048,NULL,NULL,NULL,NULL,13,58),
(4049,NULL,NULL,NULL,NULL,13,59),
(4050,NULL,NULL,NULL,NULL,13,60),
(4051,NULL,NULL,NULL,NULL,13,65),
(4052,NULL,NULL,NULL,NULL,13,75),
(4053,NULL,NULL,NULL,NULL,13,104),
(4054,NULL,NULL,NULL,NULL,13,132),
(4055,NULL,NULL,NULL,NULL,13,133),
(4056,NULL,NULL,NULL,NULL,13,9),
(4057,NULL,NULL,NULL,NULL,13,12),
(4058,NULL,NULL,NULL,NULL,13,40),
(4059,NULL,NULL,NULL,NULL,13,41),
(4060,NULL,NULL,NULL,NULL,13,42),
(4061,NULL,NULL,NULL,NULL,13,43),
(4062,NULL,NULL,NULL,NULL,13,47),
(4063,NULL,NULL,NULL,NULL,13,81),
(4064,NULL,NULL,NULL,NULL,13,82),
(4065,NULL,NULL,NULL,NULL,13,92),
(4066,NULL,NULL,NULL,NULL,13,90),
(4067,NULL,NULL,NULL,NULL,13,91),
(4068,NULL,NULL,NULL,NULL,13,125),
(4069,NULL,NULL,NULL,NULL,13,95),
(4070,NULL,NULL,NULL,NULL,13,96),
(4071,NULL,NULL,NULL,NULL,13,101),
(4072,NULL,NULL,NULL,NULL,13,106),
(4073,NULL,NULL,NULL,NULL,13,114),
(4074,NULL,NULL,NULL,NULL,13,121),
(4075,NULL,NULL,NULL,NULL,13,123),
(4076,NULL,NULL,NULL,NULL,13,134),
(4077,NULL,NULL,NULL,NULL,13,36),
(4078,NULL,NULL,NULL,NULL,13,3),
(4079,NULL,NULL,NULL,NULL,13,15),
(4080,NULL,NULL,NULL,NULL,13,50),
(4081,NULL,NULL,NULL,NULL,13,51),
(4082,NULL,NULL,NULL,NULL,13,64),
(4083,NULL,NULL,NULL,NULL,13,94),
(4084,NULL,NULL,NULL,NULL,13,97),
(4085,NULL,NULL,NULL,NULL,13,105),
(4086,NULL,NULL,NULL,NULL,14,2),
(4087,NULL,NULL,NULL,NULL,14,3),
(4088,NULL,NULL,NULL,NULL,14,5),
(4089,NULL,NULL,NULL,NULL,14,6),
(4090,NULL,NULL,NULL,NULL,14,7),
(4091,NULL,NULL,NULL,NULL,14,17),
(4092,NULL,NULL,NULL,NULL,14,63),
(4093,NULL,NULL,NULL,NULL,14,76),
(4094,NULL,NULL,NULL,NULL,14,86),
(4095,NULL,NULL,NULL,NULL,14,97),
(4096,NULL,NULL,NULL,NULL,14,1),
(4097,NULL,NULL,NULL,NULL,14,9),
(4098,NULL,NULL,NULL,NULL,14,14),
(4099,NULL,NULL,NULL,NULL,14,26),
(4100,NULL,NULL,NULL,NULL,14,27),
(4101,NULL,NULL,NULL,NULL,14,29),
(4102,NULL,NULL,NULL,NULL,14,32),
(4103,NULL,NULL,NULL,NULL,14,40),
(4104,NULL,NULL,NULL,NULL,14,55),
(4105,NULL,NULL,NULL,NULL,14,66),
(4106,NULL,NULL,NULL,NULL,14,74),
(4107,NULL,NULL,NULL,NULL,14,77),
(4108,NULL,NULL,NULL,NULL,14,93),
(4109,NULL,NULL,NULL,NULL,14,95),
(4110,NULL,NULL,NULL,NULL,14,106),
(4111,NULL,NULL,NULL,NULL,14,4),
(4112,NULL,NULL,NULL,NULL,14,8),
(4113,NULL,NULL,NULL,NULL,14,15),
(4114,NULL,NULL,NULL,NULL,14,16),
(4115,NULL,NULL,NULL,NULL,14,19),
(4116,NULL,NULL,NULL,NULL,14,22),
(4117,NULL,NULL,NULL,NULL,14,24),
(4118,NULL,NULL,NULL,NULL,14,30),
(4119,NULL,NULL,NULL,NULL,14,31),
(4120,NULL,NULL,NULL,NULL,14,46),
(4121,NULL,NULL,NULL,NULL,14,57),
(4122,NULL,NULL,NULL,NULL,14,58),
(4123,NULL,NULL,NULL,NULL,14,59),
(4124,NULL,NULL,NULL,NULL,14,61),
(4125,NULL,NULL,NULL,NULL,14,62),
(4126,NULL,NULL,NULL,NULL,14,69),
(4127,NULL,NULL,NULL,NULL,14,70),
(4128,NULL,NULL,NULL,NULL,14,71),
(4129,NULL,NULL,NULL,NULL,14,72),
(4130,NULL,NULL,NULL,NULL,14,73),
(4131,NULL,NULL,NULL,NULL,14,75),
(4132,NULL,NULL,NULL,NULL,14,79),
(4133,NULL,NULL,NULL,NULL,14,84),
(4134,NULL,NULL,NULL,NULL,14,111),
(4135,NULL,NULL,NULL,NULL,14,13),
(4136,NULL,NULL,NULL,NULL,14,18),
(4137,NULL,NULL,NULL,NULL,14,20),
(4138,NULL,NULL,NULL,NULL,14,21),
(4139,NULL,NULL,NULL,NULL,14,28),
(4140,NULL,NULL,NULL,NULL,14,34),
(4141,NULL,NULL,NULL,NULL,14,38),
(4142,NULL,NULL,NULL,NULL,14,42),
(4143,NULL,NULL,NULL,NULL,14,50),
(4144,NULL,NULL,NULL,NULL,14,52),
(4145,NULL,NULL,NULL,NULL,14,54),
(4146,NULL,NULL,NULL,NULL,14,60),
(4147,NULL,NULL,NULL,NULL,14,68),
(4148,NULL,NULL,NULL,NULL,14,114),
(4149,NULL,NULL,NULL,NULL,14,98),
(4150,NULL,NULL,NULL,NULL,14,100),
(4151,NULL,NULL,NULL,NULL,14,101),
(4152,NULL,NULL,NULL,NULL,14,102),
(4153,NULL,NULL,NULL,NULL,14,104),
(4154,NULL,NULL,NULL,NULL,14,107),
(4155,NULL,NULL,NULL,NULL,14,87),
(4156,NULL,NULL,NULL,NULL,14,88),
(4157,NULL,NULL,NULL,NULL,14,89),
(4158,NULL,NULL,NULL,NULL,14,90),
(4159,NULL,NULL,NULL,NULL,14,94),
(4160,NULL,NULL,NULL,NULL,14,96),
(4161,NULL,NULL,NULL,NULL,14,108),
(4162,NULL,NULL,NULL,NULL,14,112),
(4163,NULL,NULL,NULL,NULL,14,10),
(4164,NULL,NULL,NULL,NULL,14,25),
(4165,NULL,NULL,NULL,NULL,14,33),
(4166,NULL,NULL,NULL,NULL,14,35),
(4167,NULL,NULL,NULL,NULL,14,36),
(4168,NULL,NULL,NULL,NULL,14,37),
(4169,NULL,NULL,NULL,NULL,14,39),
(4170,NULL,NULL,NULL,NULL,14,41),
(4171,NULL,NULL,NULL,NULL,14,43),
(4172,NULL,NULL,NULL,NULL,14,44),
(4173,NULL,NULL,NULL,NULL,14,45),
(4174,NULL,NULL,NULL,NULL,14,48),
(4175,NULL,NULL,NULL,NULL,14,53),
(4176,NULL,NULL,NULL,NULL,14,78),
(4177,NULL,NULL,NULL,NULL,14,81),
(4178,NULL,NULL,NULL,NULL,14,82),
(4179,NULL,NULL,NULL,NULL,14,91),
(4180,NULL,NULL,NULL,NULL,14,92),
(4181,NULL,NULL,NULL,NULL,14,109),
(4182,NULL,NULL,NULL,NULL,14,110),
(4183,NULL,NULL,NULL,NULL,14,65),
(4184,NULL,NULL,NULL,NULL,14,83),
(4185,NULL,NULL,NULL,NULL,14,11),
(4186,NULL,NULL,NULL,NULL,14,12),
(4187,NULL,NULL,NULL,NULL,14,23),
(4188,NULL,NULL,NULL,NULL,14,47),
(4189,NULL,NULL,NULL,NULL,14,49),
(4190,NULL,NULL,NULL,NULL,14,51),
(4191,NULL,NULL,NULL,NULL,14,80),
(4192,NULL,NULL,NULL,NULL,14,85),
(4193,NULL,NULL,NULL,NULL,14,103),
(4194,NULL,NULL,NULL,NULL,14,113),
(4195,NULL,NULL,NULL,NULL,15,28),
(4196,NULL,NULL,NULL,NULL,15,32),
(4197,NULL,NULL,NULL,NULL,15,46),
(4198,NULL,NULL,NULL,NULL,15,68),
(4199,NULL,NULL,NULL,NULL,15,78),
(4200,NULL,NULL,NULL,NULL,15,79),
(4201,NULL,NULL,NULL,NULL,15,1),
(4202,NULL,NULL,NULL,NULL,15,23),
(4203,NULL,NULL,NULL,NULL,15,43),
(4204,NULL,NULL,NULL,NULL,15,60),
(4205,NULL,NULL,NULL,NULL,15,63),
(4206,NULL,NULL,NULL,NULL,15,72),
(4207,NULL,NULL,NULL,NULL,15,76),
(4208,NULL,NULL,NULL,NULL,15,85),
(4209,NULL,NULL,NULL,NULL,15,11),
(4210,NULL,NULL,NULL,NULL,15,21),
(4211,NULL,NULL,NULL,NULL,15,22),
(4212,NULL,NULL,NULL,NULL,15,64),
(4213,NULL,NULL,NULL,NULL,15,65),
(4214,NULL,NULL,NULL,NULL,15,74),
(4215,NULL,NULL,NULL,NULL,15,80),
(4216,NULL,NULL,NULL,NULL,15,6),
(4217,NULL,NULL,NULL,NULL,15,10),
(4218,NULL,NULL,NULL,NULL,15,9),
(4219,NULL,NULL,NULL,NULL,15,13),
(4220,NULL,NULL,NULL,NULL,15,14),
(4221,NULL,NULL,NULL,NULL,15,18),
(4222,NULL,NULL,NULL,NULL,15,27),
(4223,NULL,NULL,NULL,NULL,15,33),
(4224,NULL,NULL,NULL,NULL,15,42),
(4225,NULL,NULL,NULL,NULL,15,48),
(4226,NULL,NULL,NULL,NULL,15,49),
(4227,NULL,NULL,NULL,NULL,15,57),
(4228,NULL,NULL,NULL,NULL,15,84),
(4229,NULL,NULL,NULL,NULL,15,8),
(4230,NULL,NULL,NULL,NULL,15,26),
(4231,NULL,NULL,NULL,NULL,15,44),
(4232,NULL,NULL,NULL,NULL,15,69),
(4233,NULL,NULL,NULL,NULL,15,24),
(4234,NULL,NULL,NULL,NULL,15,25),
(4235,NULL,NULL,NULL,NULL,15,34),
(4236,NULL,NULL,NULL,NULL,15,38),
(4237,NULL,NULL,NULL,NULL,15,47),
(4238,NULL,NULL,NULL,NULL,15,50),
(4239,NULL,NULL,NULL,NULL,15,55),
(4240,NULL,NULL,NULL,NULL,15,56),
(4241,NULL,NULL,NULL,NULL,15,70),
(4242,NULL,NULL,NULL,NULL,15,73),
(4243,NULL,NULL,NULL,NULL,15,81),
(4244,NULL,NULL,NULL,NULL,15,82),
(4245,NULL,NULL,NULL,NULL,15,7),
(4246,NULL,NULL,NULL,NULL,15,17),
(4247,NULL,NULL,NULL,NULL,15,53),
(4248,NULL,NULL,NULL,NULL,15,59),
(4249,NULL,NULL,NULL,NULL,15,61),
(4250,NULL,NULL,NULL,NULL,15,83),
(4251,NULL,NULL,NULL,NULL,15,35),
(4252,NULL,NULL,NULL,NULL,15,37),
(4253,NULL,NULL,NULL,NULL,15,2),
(4254,NULL,NULL,NULL,NULL,15,3),
(4255,NULL,NULL,NULL,NULL,15,4),
(4256,NULL,NULL,NULL,NULL,15,15),
(4257,NULL,NULL,NULL,NULL,15,16),
(4258,NULL,NULL,NULL,NULL,15,29),
(4259,NULL,NULL,NULL,NULL,15,31),
(4260,NULL,NULL,NULL,NULL,15,36),
(4261,NULL,NULL,NULL,NULL,15,45),
(4262,NULL,NULL,NULL,NULL,15,51),
(4263,NULL,NULL,NULL,NULL,15,67),
(4264,NULL,NULL,NULL,NULL,15,77);
/*!40000 ALTER TABLE `acervo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `codigo_foto` int(11) NOT NULL AUTO_INCREMENT,
  `pasta` int(11) DEFAULT NULL,
  `nome_foto` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codigo_foto`),
  KEY `pasta` (`pasta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ano`
--

DROP TABLE IF EXISTS `ano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ano` (
  `codigo_ano` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_ano`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ano`
--

LOCK TABLES `ano` WRITE;
/*!40000 ALTER TABLE `ano` DISABLE KEYS */;
INSERT INTO `ano` VALUES
(1,2008),
(2,2009),
(3,2010),
(4,2011),
(5,2012),
(6,2013),
(7,2014),
(8,2015),
(9,2016),
(10,2017),
(11,2018),
(12,2019),
(13,2020),
(14,2021),
(15,2022),
(16,2023),
(17,2024),
(18,2025),
(19,2026),
(20,2027);
/*!40000 ALTER TABLE `ano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apoio`
--

DROP TABLE IF EXISTS `apoio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apoio` (
  `codigo_apoio` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo_apoio`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apoio`
--

LOCK TABLES `apoio` WRITE;
/*!40000 ALTER TABLE `apoio` DISABLE KEYS */;
INSERT INTO `apoio` VALUES
(1,'Conselho Nacional de Desenvolvimento Científico e Tecnológico - CNPq'),
(2,'Fundação de Amparo à Pesquisa do Estado de Minas Gerais - FAPEMIG'),
(3,'Programa de Educação Tutorial - PET'),
(4,'IF Sudeste MG'),
(5,'Coordenação de Aperfeiçoamento de Pessoal de Nível Superior - CAPES'),
(6,'Outros');
/*!40000 ALTER TABLE `apoio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apoio_trabalho`
--

DROP TABLE IF EXISTS `apoio_trabalho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apoio_trabalho` (
  `codigo_apoio` int(11) NOT NULL,
  `codigo_trabalho` int(11) NOT NULL,
  KEY `fk_apoio` (`codigo_apoio`),
  KEY `fk_trabalho` (`codigo_trabalho`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apoio_trabalho`
--

LOCK TABLES `apoio_trabalho` WRITE;
/*!40000 ALTER TABLE `apoio_trabalho` DISABLE KEYS */;
INSERT INTO `apoio_trabalho` VALUES
(4,1),
(4,1),
(6,1),
(4,2),
(6,2),
(1,3),
(2,4),
(4,5),
(4,6),
(3,6),
(4,7),
(1,8),
(4,8),
(2,9),
(3,9),
(4,9),
(1,10),
(4,11),
(1,11),
(4,12),
(4,13),
(2,13),
(1,13),
(4,14),
(1,14),
(4,15),
(1,15),
(2,24),
(2,16),
(4,17),
(2,17),
(2,18),
(1,19),
(1,20),
(4,21),
(1,21),
(2,22),
(2,25),
(4,26),
(4,27),
(4,28),
(1,28),
(1,30),
(4,31),
(2,31),
(4,30),
(1,32),
(4,33),
(4,34),
(3,34),
(2,35),
(4,36),
(2,37),
(2,38),
(2,39),
(4,40),
(4,41),
(4,42),
(4,43),
(4,44),
(1,45),
(4,46),
(4,47),
(1,47),
(4,48),
(4,49),
(4,50),
(1,51),
(4,52),
(4,53),
(3,54),
(3,55),
(4,56),
(1,56),
(3,57),
(3,81),
(3,58),
(1,59),
(4,51),
(4,59),
(1,60),
(4,61),
(1,61),
(4,62),
(1,62),
(6,63),
(4,63),
(4,64),
(4,83),
(3,65),
(3,66),
(3,67),
(4,69),
(1,69),
(4,70),
(1,70),
(1,71),
(2,72),
(1,73),
(4,74),
(4,75),
(3,76),
(4,77),
(4,78),
(1,78),
(3,23),
(1,80),
(4,82),
(3,63),
(3,84),
(4,85),
(4,86),
(4,71),
(4,73),
(1,88),
(4,88),
(1,89),
(4,89),
(4,57);
/*!40000 ALTER TABLE `apoio_trabalho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arquivo`
--

DROP TABLE IF EXISTS `arquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivo` (
  `codigo_arquivo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_arquivo` varchar(300) DEFAULT NULL,
  `icone` varchar(300) NOT NULL,
  `caminho_arquivo` varchar(300) NOT NULL,
  `codigo_formulario` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_arquivo`),
  KEY `codigo_formulario` (`codigo_formulario`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivo`
--

LOCK TABLES `arquivo` WRITE;
/*!40000 ALTER TABLE `arquivo` DISABLE KEYS */;
INSERT INTO `arquivo` VALUES
(1,'PROGRAMAÇÃO - XV SIMPÓSIO DE CIÊNCIA, INOVAÇÃO &','pdf.png','Programação Simposio 2023 (3).pdf',1),
(2,'Manual Representante','manual.png','teste33_0_3.pdf',2),
(3,'Parecer do Orientador','manual.png','tutorial_avaliador2014.pdf',3),
(4,'Modelo Artigo','word.png','MODELO_ARTIGO_V_SIMP 2012.doc',0),
(5,'PROGRAMAÇÃO - XV SIMPÓSIO DE CIÊNCIA, INOVAÇÃO &','ppt.png','Programação Simposio 2023 (3).pdf',1),
(6,'Modelo Resumo','word.png','MODELO_RESUMO_IFET_RP_2012.doc',0),
(7,'FLUXOGRAMA PARA SUBMISSÃO DE RESUMOS','manual.png','Fluxograma_2019.pdf',0),
(8,'REGULAMENTO_DO_XV_SIMPOSIO.pdf','manual.png','REGULAMENTO_DO_XV_SIMPOSIO.pdf',0),
(9,'PROGRAMACAO_DO_XV_SIMPOSIO.pdf','programacao.png','PROGRAMACAO_DO_XV_SIMPOSIO.pdf',0),
(10,'MODELO_DE_POSTER-ORIENTACOES.pdf','poster.png','MODELO_DE_POSTER-ORIENTACOES.pdf',0),
(11,'POSTER.ppt','poster.png','POSTER.ppt',0);
/*!40000 ALTER TABLE `arquivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliador_trab`
--

DROP TABLE IF EXISTS `avaliador_trab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avaliador_trab` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_trab` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `item1` int(2) NOT NULL,
  `item2` int(2) NOT NULL,
  `item3` int(2) NOT NULL,
  `item4` int(2) NOT NULL,
  `item5` int(2) NOT NULL,
  `item6` int(2) NOT NULL,
  `nota` int(11) NOT NULL DEFAULT '0',
  `obs` longtext NOT NULL,
  `avaliado` int(1) NOT NULL,
  `data` date NOT NULL,
  `dias` varchar(3) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliador_trab`
--

LOCK TABLES `avaliador_trab` WRITE;
/*!40000 ALTER TABLE `avaliador_trab` DISABLE KEYS */;

/*!40000 ALTER TABLE `avaliador_trab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup`
--

DROP TABLE IF EXISTS `backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup` (
  `codigo_backup` int(11) NOT NULL AUTO_INCREMENT,
  `arquivo` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `cpf` varchar(11) NOT NULL,
  PRIMARY KEY (`codigo_backup`),
  KEY `cpf` (`cpf`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

LOCK TABLES `backup` WRITE;
/*!40000 ALTER TABLE `backup` DISABLE KEYS */;

/*!40000 ALTER TABLE `backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bloco`
--

DROP TABLE IF EXISTS `bloco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bloco` (
  `codigo_bloco` int(11) NOT NULL AUTO_INCREMENT,
  `nome_bloco` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codigo_bloco`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bloco`
--

LOCK TABLES `bloco` WRITE;
/*!40000 ALTER TABLE `bloco` DISABLE KEYS */;
INSERT INTO `bloco` VALUES
(1,'-----'),
(2,'Bloco 1'),
(3,'Bloco 2'),
(4,'Bloco 3'),
(5,'Bloco 4'),
(6,'Bloco 5'),
(7,'Bloco 6'),
(8,'Bloco 7'),
(9,'Bloco 8'),
(10,'Bloco 9'),
(11,'Bloco 10'),
(12,'Bloco 11'),
(13,'Bloco 12'),
(14,'Bloco 13'),
(15,'Bloco 14'),
(16,'Bloco 15'),
(17,'Bloco 16'),
(18,'Bloco 17'),
(19,'Bloco 18'),
(20,'Bloco 19'),
(21,'Bloco 20');
/*!40000 ALTER TABLE `bloco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conteudo`
--

DROP TABLE IF EXISTS `conteudo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conteudo` (
  `codigo_conteudo` int(11) NOT NULL AUTO_INCREMENT,
  `informacoes` longtext NOT NULL,
  `topo` varchar(40) NOT NULL,
  `link` varchar(60) NOT NULL,
  `assinatura` varchar(200) NOT NULL,
  `cargo` varchar(200) NOT NULL,
  `imagem_assinatura` varchar(200) NOT NULL,
  `assinatura_certificado` int(11) NOT NULL,
  PRIMARY KEY (`codigo_conteudo`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo`
--

LOCK TABLES `conteudo` WRITE;
/*!40000 ALTER TABLE `conteudo` DISABLE KEYS */;
INSERT INTO `conteudo` VALUES
(1,'','XV Simpósio site2.jpg','','','','',0),
(2,'<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<p style=\"text-align: center; color: #000000; font-family: arial; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: large;\"><strong>XV SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA</strong></span></p>\r\n<p style=\"text-align: center; color: #000000; font-family: arial; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</p>\r\n<p style=\"color: #000000; font-family: arial; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: x-large;\">O evento ocorrer&aacute; no campus Rio Pomba nos dias <strong>25 e 26</strong>&nbsp;de outubro de 2023.</span></p>\r\n<p style=\"color: #000000; font-family: arial; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: x-large;\"><br /></span></p>\r\n<p style=\"color: #000000; font-family: arial; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">O XV Simp&oacute;sio de Ci&ecirc;ncia, Inova&ccedil;&atilde;o &amp; Tecnologia &eacute; um evento de &acirc;mbito cient&iacute;fico regional, voltado para o desenvolvimento do pensamento cient&iacute;fico, tecnol&oacute;gico e de inova&ccedil;&atilde;o, visando &agrave; inicia&ccedil;&atilde;o &agrave; pesquisa cient&iacute;fica e tecnol&oacute;gica de estudantes do ensino m&eacute;dio e t&eacute;cnico, da gradua&ccedil;&atilde;o, da p&oacute;s-gradua&ccedil;&atilde;o e do corpo de servidores do Instituto. O evento tamb&eacute;m &eacute; destinado &agrave; avalia&ccedil;&atilde;o dos programas institucionais de inicia&ccedil;&atilde;o cient&iacute;fica e tecnol&oacute;gica do Campus.&nbsp;</span></p>\r\n<p style=\"color: #000000; font-family: arial; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">&nbsp;As atividades previstas para o XV Simp&oacute;sio s&atilde;o:</span></p>\r\n<ul>\r\n<li><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">Apresenta&ccedil;&otilde;es de trabalhos de pesquisa desenvolvidos por estudantes da inicia&ccedil;&atilde;o cientifica dos cursos t&eacute;cnicos e de gradua&ccedil;&atilde;o e p&oacute;s-gradua&ccedil;&atilde;o do Campus Rio Pomba.</span></li>\r\n</ul>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">O evento tem como objetivos:</span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">&nbsp;I. promover a divulga&ccedil;&atilde;o cient&iacute;fico-tecnol&oacute;gica a fim de estimular o debate de quest&otilde;es relevantes nas diferentes &aacute;reas do conhecimento do Campus<em>&nbsp;</em>Rio Pomba;</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">&nbsp;II. divulgar e incentivar o desenvolvimento de trabalhos de inicia&ccedil;&atilde;o cient&iacute;fica, tecnol&oacute;gica, inova&ccedil;&atilde;o e de p&oacute;s gradua&ccedil;&atilde;o relacionados &agrave;s atividades de pesquisa do Campus Rio Pomba;</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">&nbsp;III. estimular a participa&ccedil;&atilde;o de alunos, ex-alunos, servidores, pesquisadores e comunidade em geral em palestras, minicursos&nbsp; &nbsp; &nbsp;&nbsp;e apresenta&ccedil;&otilde;es de trabalhos.</span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><span>Para acessar o modelo da apresenta&ccedil;&atilde;o oral,&nbsp;<a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/2023/modelo-apresentacao-oral_orientacoes.pptx\" target=\"_blank\">Clique aqui</a></span></p>\r\n<p>&nbsp;</p>\r\n<p><span class=\"example2\">Para acessar o modelo da apresenta&ccedil;&atilde;o no formato de P&ocirc;ster (tamanho 90 x 120 cm),&nbsp;<a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/2023/modelo-apresentacao-poster-orientacoes.pptx\" target=\"_blank\">Clique aqui</a></span></p>\r\n<p>&nbsp;</p>\r\n<p><span>Para acessar o Resultado Final das Avalia&ccedil;&otilde;es dos Trabalhos,&nbsp;<a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/2023/divulgacao-do-resultado-final-da-avaliacao-dos-trabalhos-do-xv-simposio-de-ciencia-inovacao-e-tecnologia.pdf/view\" target=\"_blank\">Clique aqui</a></span></p>\r\n<p>&nbsp;</p>\r\n<p><span class=\"example2\">Para acessar os Resumos selecionados para apresenta&ccedil;&atilde;o oral,&nbsp;<a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/2023/resumos-selecionados-para-apresentacao-oral-no-xv-simposio-de-ciencia-inovacao-e-tecnologia.pdf/view\" target=\"_blank\">Clique aqui</a></span></p>\r\n<p>&nbsp;</p>\r\n<p>Para acessar as orienta&ccedil;&otilde;es para grava&ccedil;&atilde;o do v&iacute;deo- Apresenta&ccedil;&atilde;o de P&ocirc;sters da P&oacute;s-gradua&ccedil;&atilde;o, <a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/2023/orientacoes-para-gravacao-do-video-apresentadores-poster.pdf/view\" target=\"_blank\">Clique aqui<br /></a></p>\r\n<p>&nbsp;</p>\r\n<p>Para ter acesso aos hor&aacute;rios&nbsp;das apresenta&ccedil;&otilde;es Orais do XV Simp&oacute;sio, <a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/2023/horario-das-apresentacoes-orais-do-xv-simposio.pdf/view\" target=\"_blank\">Clique aqui</a></p>\r\n<p>&nbsp;</p>\r\n<p>Para ter acesso aos hor&aacute;rios das apresenta&ccedil;&otilde;es de P&ocirc;steres do XV Simp&oacute;sio, <a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/2023/horario-das-apresentacoes-de-posteres-do-xv-simposio.pdf/view\" target=\"_blank\">Clique aqui</a></p>\r\n<p class=\"western\">Link para acesso &agrave; Galeria dos P&ocirc;steres<br /><a href=\"../galeriaposter/index.php\" target=\"_blank\">https://sistemas.riopomba.ifsudestemg.edu.br/dppg/galeriaposter/index.php</a></p>\r\n<p class=\"western\">&nbsp;</p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Selecionados os resumos para cap&iacute;tulo de livro do XV Simp&oacute;sio, para verificar a lista, <a href=\"https://www.ifsudestemg.edu.br/documentos-institucionais/unidades/riopomba/diretorias-sistemicas/pesquisa/simposio-de-ciencia-inovacao-e-tecnologia/2023/resumos-selecionados-para-capitulo-de-livro-do-xv-simposio.pdf\" target=\"_blank\">Clique aqui.</a>&nbsp;</span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>','','','','','',0),
(3,'<p style=\"text-align: center;\"><em><span style=\"background-color: #a2cd5a; color: #000; font-size: small; font-family: arial, helvetica, sans-serif;\"><strong> </strong></span><span style=\"font-size: small; font-family: arial, helvetica, sans-serif; color: #000000; background-color: #a2cd5a;\"><strong>Diretoria de Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o</strong></span></em><span class=\"example1\" style=\"background-color: #a2cd5a; color: #ffffff; font-family: arial, helvetica, sans-serif; font-size: small;\"><strong><br /><span style=\"color: #000000; background-color: #a2cd5a;\"> Instituto Federal de Educa&ccedil;&atilde;o Ci&ecirc;ncia e Tecnologia do Sudeste de Minas Gerais - Campus Rio Pomba</span><br /><span style=\"color: #000000; background-color: #a2cd5a;\"> Av. Dr Jos&eacute; Sebasti&atilde;o Da Paix&atilde;o s/n&ordm; - Bairro Lindo Vale - CEP: 36180-000 - Rio Pomba/MG </span><br /><br /></strong></span></p>','','','','','',0),
(4,'dppg.jpg','','','','','',0),
(5,'<p style=\"text-align: center;\"><strong><span style=\"color: #ff0000; font-size: small;\">ATEN&Ccedil;&Atilde;O</span></strong></p>\r\n<p><span>O XV Simp&oacute;sio de Ci&ecirc;ncia, Inova&ccedil;&atilde;o &amp; Tecnologia&nbsp;<strong style=\"font-size: x-small; font-family: Calibri, sans-serif; line-height: 115%;\">&eacute; um evento gratuito e portando n&atilde;o precisa de confirma&ccedil;&atilde;o de pagamento na DPPG.</strong></span></p>','','','','','',0),
(6,'<p style=\"text-align: justify;\"><span><strong>Informa&ccedil;&otilde;es para o envio dos resumos:</strong></span></p>\r\n<p style=\"text-align: justify;\">Todos os trabalhos ser&atilde;o, <strong>OBRIGATORIAMENTE</strong>, submetidos na forma de RESUMO simples que dever&aacute; possuir no m&iacute;nimo 250 e no m&aacute;ximo 400 palavras, excluindo o t&iacute;tulo. &Eacute; de responsabilidade do autor a confer&ecirc;ncia do n&uacute;mero de palavras do resumo submetido, pois o sistema do Simp&oacute;sio n&atilde;o limita o n&uacute;mero de palavras do resumo.</p>\r\n<p style=\"text-align: justify;\">O resumo deve ser in&eacute;dito e conter introdu&ccedil;&atilde;o, objetivos, material e m&eacute;todos (ou metodologia), resultados e conclus&otilde;es. Estes t&oacute;picos dever&atilde;o estar <strong>subentendidos</strong> na reda&ccedil;&atilde;o do resumo, ou seja, o t&iacute;tulo de cada t&oacute;pico n&atilde;o dever&aacute; aparecer no texto. Os resumos que n&atilde;o respeitarem esse padr&atilde;o, sobretudo os que n&atilde;o apresentarem resultados, ser&atilde;o desclassificados, sendo aceitos apenas os que estiverem de acordo com este Regulamento. Trabalhos conduzidos como revis&otilde;es de literatura ser&atilde;o aceitos neste evento.</p>\r\n<p style=\"text-align: justify;\">O autor poder&aacute; criar o resumo diretamente na caixa de texto dispon&iacute;vel no sistema de submiss&atilde;o <em>online </em>ou<em> </em>em editor de texto <em>Microsoft Word ou LibreOffice Writer</em>. O texto deve ser justificado e digitado em par&aacute;grafo &uacute;nico e em espa&ccedil;amento simples, em fonte <em>Times New Roman</em> 12. Caso o texto seja criado em um editor de texto <em>Microsoft Word ou LibreOffice Writer</em>, os caracteres especiais como aspas, sobrescrito, it&aacute;lico, h&iacute;fen devem ser inseridos diretamente na caixa de texto do sistema de submiss&atilde;o.</p>\r\n<p style=\"text-align: justify;\">As palavras-chave dever&atilde;o ser digitadas em campo espec&iacute;fico no sistema do Simp&oacute;sio, em ordem alfab&eacute;tica e em letras min&uacute;sculas.&nbsp; Estas dever&atilde;o ser elaboradas de modo que o trabalho seja rapidamente resgatado nas pesquisas bibliogr&aacute;ficas. N&atilde;o poder&atilde;o ser retiradas do t&iacute;tulo do resumo.</p>\r\n<p style=\"text-align: justify;\">O resumo poder&aacute; ser constitu&iacute;do de, no <strong>m&aacute;ximo, 6 (seis)</strong> autores, incluindo o orientador, sendo que todos eles dever&atilde;o estar cadastrados no Simp&oacute;sio;</p>\r\n<p style=\"text-align: justify;\">N&atilde;o &eacute; necess&aacute;rio incluir o orientador como autor, pois o mesmo ser&aacute; adicionado automaticamente como autor, ap&oacute;s a sele&ccedil;&atilde;o de seu nome no sistema.</p>\r\n<p style=\"text-align: justify;\">Os resumos submetidos pelos estudantes ser&atilde;o automaticamente encaminhados para avalia&ccedil;&atilde;o pelo ORIENTADOR, o qual dever&aacute; corrigi-los e emitir o parecer (aprovado ou reprovado). Logo ap&oacute;s a aprova&ccedil;&atilde;o pelo orientador, o resumo ser&aacute; avaliado pela COMISS&Atilde;O AVALIADORA de acordo com os crit&eacute;rios apresentados no regulamento.</p>\r\n<p style=\"text-align: justify;\">Os resumos ser&atilde;o classificados em aprovados ou reprovados (aqueles que obtiverem pontua&ccedil;&atilde;o menor que 60 pontos), sendo que estes n&atilde;o constar&atilde;o nos anais do evento.</p>\r\n<p style=\"text-align: justify;\">Os resumos aprovados ser&atilde;o apresentados no evento (oral ou p&ocirc;ster) e ser&atilde;o novamente avaliados por COMISS&Acirc;O AVALIADORA seguindo os crit&eacute;rios&nbsp;apresentados no regulamento.</p>','','','','','',0),
(7,'','logo_20163.jpg','','','','',0),
(8,'','','','Reitor1','Reitoria','assinatura1.jpg',0),
(9,'','','','Reitor2','Reitoria','assinatura2.jpg',1),
(10,'XV','','','','','',0),
(11,'25 e 26 de outubro de 2023','','','','','',0),
(12,'<p class=\"MsoNormal\" style=\"text-align: justify; color: #ff0000;\"><span class=\"example2\" style=\"font-family: arial, helvetica, sans-serif; font-size: medium; color: #000000;\"><span style=\"text-align: start;\">O Simp&oacute;sio&nbsp;</span><span style=\"text-align: start;\">de Ci&ecirc;ncia, Inova&ccedil;&atilde;o &amp; Tecnologia &eacute; um evento de &acirc;mbito cient&iacute;fico regional, voltado para o desenvolvimento do pensamento cient&iacute;fico, tecnol&oacute;gico e de inova&ccedil;&atilde;o, visando &agrave; inicia&ccedil;&atilde;o &agrave; pesquisa cient&iacute;fica e tecnol&oacute;gica de estudantes do ensino m&eacute;dio e t&eacute;cnico, da gradua&ccedil;&atilde;o, da p&oacute;s-gradua&ccedil;&atilde;o e do corpo de servidores do Instituto. O evento tamb&eacute;m &eacute; destinado &agrave; avalia&ccedil;&atilde;o dos programas institucionais de inicia&ccedil;&atilde;o cient&iacute;fica e tecnol&oacute;gica do Campus Rio Pomba.</span></span></p>\r\n<p class=\"MsoNormal\">&nbsp;</p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify;\"><span class=\"example2\" style=\"font-size: medium; text-align: justify; font-family: arial, helvetica, sans-serif;\">P&uacute;blico-alvo</span></p>\r\n<p style=\"margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 150%; text-align: justify;\"><span class=\"example2\" style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\"><span style=\"color: #000000;\">A programa&ccedil;&atilde;o do evento visa contemplar os alunos e profissionais do IF Sudeste MG, apresentadores de trabalhos e ouvintes.</span></span></p>\r\n<p style=\"margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 150%; text-align: justify;\">&nbsp;</p>\r\n<p style=\"margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 150%; text-align: justify;\">&nbsp;</p>\r\n<div id=\"_mcePaste\" class=\"mcePaste\" style=\"position: absolute; left: -10000px; top: 277px; width: 1px; height: 1px; overflow: hidden;\">\r\n<table class=\"MsoNormalTable\" style=\"width: 100.0%; border-collapse: collapse; border: none; mso-border-alt: solid windowtext .5pt; mso-yfti-tbllook: 1184; mso-padding-alt: 0cm 5.4pt 0cm 5.4pt; mso-border-insideh: .5pt solid windowtext; mso-border-insidev: .5pt solid windowtext;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr style=\"mso-yfti-irow: 2;\">\r\n<td style=\"width: 166.0pt; border: solid windowtext 1.0pt; border-top: none; mso-border-top-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"221\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>&nbsp;Palestras,   apresenta&ccedil;&otilde;es orais e minicursos (S&oacute; poder&aacute; ser realizada ap&oacute;s cadastro no   sistema)</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Todos</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>A   partir do dia 16/09/2018 </span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 3;\">\r\n<td style=\"width: 166.0pt; border: solid windowtext 1.0pt; border-top: none; mso-border-top-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"221\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Submiss&atilde;o   de resumos para apresenta&ccedil;&atilde;o no evento (S&oacute; poder&aacute; ser realizada ap&oacute;s cadastro   no sistema)</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Todos   (obrigat&oacute;rio para bolsistas e volunt&aacute;rios do Programa Institucional de   Inicia&ccedil;&atilde;o Cient&iacute;fica)</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>22/06/2018   a 13/08/2018</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 4;\">\r\n<td style=\"width: 166.0pt; border: solid windowtext 1.0pt; border-top: none; mso-border-top-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"221\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Parecer   do Orientador</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Orientador   de trabalhos submetidos</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>22/06/2018   a 20/08/2018</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 5;\">\r\n<td style=\"width: 166.0pt; border: solid windowtext 1.0pt; border-top: none; mso-border-top-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"221\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Avalia&ccedil;&atilde;o   externa dos trabalhos</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Avaliadores   externos</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>06/08/2018   a 31/08/2018 </span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 6;\">\r\n<td style=\"width: 166.0pt; border: solid windowtext 1.0pt; border-top: none; mso-border-top-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"221\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Divulga&ccedil;&atilde;o   do resultado final da avalia&ccedil;&atilde;o dos trabalhos</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>DPPG</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>At&eacute;   14/09/2018</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 7;\">\r\n<td style=\"width: 166.0pt; border: solid windowtext 1.0pt; border-top: none; mso-border-top-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"221\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Divulga&ccedil;&atilde;o de hor&aacute;rios e datas das   apresenta&ccedil;&otilde;es</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>DPPG</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>At&eacute;   26/09/2018</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 8; mso-yfti-lastrow: yes;\">\r\n<td style=\"width: 166.0pt; border: solid windowtext 1.0pt; border-top: none; mso-border-top-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"221\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>X Simp&oacute;sio de Ci&ecirc;ncia, Inova&ccedil;&atilde;o   &amp; Tecnologia</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>Todos</span></p>\r\n</td>\r\n<td style=\"width: 135.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-alt: solid windowtext .5pt; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"180\" valign=\"top\">\r\n<p class=\"MsoNormal\" style=\"margin-top: 12.0pt; text-align: center;\"><span>16 e   17/10/2018</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>','apresentacao','','','','',0),
(13,'<p style=\"text-align: justify;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\"><strong>Membros <span class=\"fontstyle0\">Comit&ecirc; de&nbsp;Pesquisa e Inova&ccedil;&atilde;o do IF Sudeste MG &ndash; </span><span class=\"fontstyle2\">Campus </span><span class=\"fontstyle0\">Rio Pomba -&nbsp;<strong>Portaria CAMPUSRPB/IFSUDMG n&ordm;&nbsp;</strong><strong>314, de 31 de julho de 2023</strong></span><br /><br /></strong></span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Franciano Benevenuto Caetano</span></p>\r\n<p><span style=\"font-size: medium; font-family: arial, helvetica, sans-serif;\"><span>Rafael Monteiro Ara&uacute;jo Teixeira</span></span></p>\r\n<p><span style=\"font-size: medium; font-family: arial, helvetica, sans-serif;\"><span>Eliane Maur&iacute;cio Furtado Martins</span></span></p>\r\n<p><span style=\"font-size: medium; font-family: arial, helvetica, sans-serif;\">Cristina Henriques Nogueira</span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\"><span>Jo&atilde;o Eudes da Silva</span></span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\"><span><span>V&acirc;nia Maria Xavier</span></span></span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\"><span><span>Onofre Barroca de Almeida Neto</span></span></span></p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\"><span><span>Sandro de Paiva Carvalho</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\"><strong>Equipe da DPPG:</strong></span></p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Alessandra Martins Coelho</span></p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Ana Carolina Souza Dutra</span></p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Franciano Benevenuto Caetano</span></p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Germano de Oliveira Menezes</span></p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Gl&oacute;ria Maria Brivio Quint&atilde;o</span></p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Israel Fortunato Gomes de Oliveira</span></p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\"><span>Larissa Mattos Trevizano</span><br /></span></p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Lenice Alves Moreira</span></p>\r\n<p class=\"western\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: medium;\">Seila Cristina Santos da Costa</span></p>','corpoeditorial','','','','',0),
(14,'<div style=\"text-align: center;\">\r\n<div><br /><br /></div>\r\n</div>\r\n<div style=\"text-align: center;\"><span style=\"text-decoration: underline;\">Diretoria de Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o - DPPG</span></div>\r\n<div style=\"text-align: center;\"><strong>Diretora:</strong> <span>Larissa Mattos Trevizano</span><span> </span></div>\r\n<div style=\"text-align: center;\"><span><br /></span></div>\r\n<div style=\"text-align: center;\"><strong>Ger&ecirc;ncia de Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o:</strong>&nbsp;Franciano Benevenuto Caetano</div>\r\n<div style=\"text-align: center;\"><strong>Bibliotec&aacute;ria</strong>: Ana Carolina Souza Dutra</div>\r\n<div style=\"text-align: center;\"><strong>Secret&aacute;ria de Assuntos e Registros Acad&ecirc;micos</strong>: Lenice Alves Moreira</div>\r\n<div style=\"text-align: center;\"><span>Germano de Oliveira Menezes</span></div>\r\n<div style=\"text-align: center;\">Gl&oacute;ria Maria Brivio Quint&atilde;o</div>\r\n<div style=\"text-align: center;\"><span>Israel Fortunato Gomes de Oliveira</span></div>\r\n<div style=\"text-align: center;\"><span><span>Seila Cristina Santos da Costa</span><br /></span></div>\r\n<div style=\"text-align: center;\"><span style=\"text-decoration: underline;\">&nbsp;N&uacute;cleo de Inva&ccedil;&atilde;o e Transfer&ecirc;ncia de Tecnologia - NITTEC</span></div>\r\n<div style=\"text-align: center;\"><strong>Assessora de Inova&ccedil;&atilde;o:</strong>&nbsp;Alessandra Martins Coelho</div>\r\n<div style=\"text-align: center;\">\r\n<p class=\"western\">&nbsp;</p>\r\n<p class=\"western\">&nbsp;</p>\r\n</div>\r\n<div style=\"text-align: center;\"><span>Instituto Federal de Educ&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia do Sudeste de Minas Gerais - C&acirc;mpus Rio Pomba</span></div>\r\n<div style=\"text-align: center;\"><span>Av. Dr. Jos&eacute; Sebasti&atilde;o da Paix&atilde;o s/n&ordm; - Bairro Lindo Vale - Rio Pomba / MG - CEP: 36180-000</span></div>\r\n<div style=\"text-align: center;\"><span>Diretoria de Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o</span></div>\r\n<div style=\"text-align: center;\">E-mail: dppg.riopomba@ifsudestemg.edu.br</div>\r\n<div style=\"text-align: center;\"><span><br /></span></div>','expediente','','','','',0);
/*!40000 ALTER TABLE `conteudo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `codigo_curso` int(10) NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(150) NOT NULL,
  PRIMARY KEY (`codigo_curso`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES
(1,'-----'),
(2,'Técnico em Informática'),
(3,'Técnico em Meio Ambiente'),
(4,'Técnico em Meio Ambiente à Distância'),
(5,'Técnico em Secretariado'),
(6,'Técnico em Segurança do Trabalho'),
(7,'Técnico em Vendas'),
(8,'Técnico em Agropecuária'),
(9,'Técnico em Alimentos '),
(10,'Técnico em Florestal'),
(11,'Técnico em Zootecnia'),
(12,'Administração'),
(13,'Agroecologia'),
(14,'Ciência da Computação'),
(15,'Ciência e Tecnologia de Alimentos'),
(16,'Matemática'),
(17,'Tecnologia em laticínios'),
(18,'Zootecnia'),
(19,'Pós-graduação em Agroecologia'),
(20,'Especialização Lato-sensu Proeja'),
(21,'Outros'),
(22,'Mestrado Profissional em Ciência e Tecnologia de Alimentos'),
(24,'Curso não declarado');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `codigo_depto` int(10) NOT NULL AUTO_INCREMENT,
  `nome_depto` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo_depto`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES
(1,'Agronomia, agricultura e ambiente'),
(2,'Zootecnia'),
(3,'Ciência e tecnologia de alimentos'),
(4,'Ciências gerenciais'),
(5,'Matemática, física e estatística'),
(6,'Educação'),
(7,'Ciência da computação'),
(8,'Ciências Biológicas e Biotecnologia'),
(9,'Ciências da Saúde'),
(10,'Engenharias'),
(11,'Ciências Sociais, Humanas, Linguística e Letras'),
(21,'Artes'),
(19,'Química');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email` (
  `tipo_destinatario` varchar(100) NOT NULL,
  `assunto` varchar(300) NOT NULL,
  `mensagem` blob NOT NULL,
  `remetente` varchar(300) NOT NULL,
  PRIMARY KEY (`tipo_destinatario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES
('orientador','Envio de trabalhos','<html><pre><pre>Prezado Orientador, houve uma submiss&atilde;o de trabalho que deve ser aprovada/reprovada pelo senhor (a).</pre>\r\n<pre>Lembramos que: </pre>\r\n<pre>O resumo deve ser in&eacute;dito e conter introdu&ccedil;&atilde;o, objetivos, material e m&eacute;todos (ou metodologia), resultados e conclus&otilde;es. Estes t&oacute;picos dever&atilde;o estar <strong>subentendidos</strong> na reda&ccedil;&atilde;o do resumo, ou seja, o t&iacute;tulo de cada t&oacute;pico n&atilde;o dever&aacute; aparecer no texto. </pre>\r\n<pre>Os resumos que n&atilde;o respeitarem esse padr&atilde;o, sobretudo os que n&atilde;o apresentarem resultados, ser&atilde;o desclassificados, sendo aceitos apenas os que estiverem de acordo com este Regulamento. </pre>\r\n<pre><br /></pre>\r\n<pre>Para acessar o site do Simp&oacute;sio, use o endere&ccedil;o abaixo:</pre>\r\n<pre><a href=\"simposio.php\" target=\"_blank\">https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2023/simposio.php</a><a href=\"simposio.php\" target=\"_blank\"></a></pre>\r\n<pre><br /></pre>\r\n<pre>No campo \'Login\', utilize seu CPF. </pre>\r\n<pre>A senha &eacute; a mesma que voc&ecirc; usou quando se cadastrou no sistema. Caso n&atilde;o lembre a senha, acesse o link abaixo para altera-la:</pre>\r\n<pre><a href=\"sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2023/simposio.php?arquivo2=form_envia_senha.php\" target=\"_blank\">https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2023/simposio.php?arquivo2=form_envia_senha.php</a></pre>\r\n<a>\r\n<pre>Diretoria de Pesquisa e P&oacute;s Gradua&ccedil;&atilde;o</pre>\r\n<br /></a></pre></html>','dppg.riopomba@ifsudestemg.edu.br '),
('avaliador_externo_cadastro','Cadastro como Avaliador Externo Simpósio','<html><pre><pre>Prezado,</pre>\r\n<pre>O(a) senhor(a) foi selecionado para avaliar os trabalhos submetidos no Simp&oacute;sio.</pre>\r\n<pre>Para acessar, use o endere&ccedil;o abaixo:<br />\r\n<a href=\"simposio.php\" target=\"_blank\">https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2023/simposio.php</a><br /><br /></pre>\r\n<pre>Para logar-se no site do Simp&oacute;sio, utilize no campo \'Login\', o seu cpf, e no campo \'Senha\', a senha que o(a) senhor(a) utilizou para se cadastrar no sistema.<br /></pre>\r\n<pre><br /></pre>\r\n<pre><br /></pre>\r\nDiretoria de Pesquisa e P&oacute;s Gradua&ccedil;&atilde;o</pre></html>','dppg.riopomba@ifsudestemg.edu.br '),
('aluno_participante','Envio de trabalhos','<html><pre><pre><span>Prezado(a) participante, </span></pre>\r\n<pre><span>Informamos que a submiss&atilde;o do seu trabalho foi efetuada com sucesso.</span></pre>\r\n<pre><span>Diretoria de Pesquisa e P&oacute;s Gradua&ccedil;&atilde;o.</span></pre>\r\n<br /></pre></html>','dppg.riopomba@ifsudestemg.edu.br '),
('avaliador_externo_trabalho_vinculado','Envio de trabalho para avaliação','<html><pre><span>Prezado(a) Senhor(a),<br /></span><span><br /></span></pre>\r\n<pre><span>Vossa Senhoria foi indicada para colaborar na avalia&ccedil;&atilde;o e parecer de resumos simples submetidos para o XV SIMP&Oacute;SIO DE CI&Ecirc;NCIA, INOVA&Ccedil;&Atilde;O &amp; TECNOLOGIA a ser realizado nos dias 25 e 26 de outubro de 2023 no Instituto Federal de Educa&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia do Sudeste de Minas Gerais &ndash; Campus Rio Pomba.</span></pre>\r\n<pre><span>A avalia&ccedil;&atilde;o &eacute; r&aacute;pida, bastando emitir notas para cada quesito a ser avaliado e, no final, o trabalho ser&aacute; aprovado caso a nota seja maior ou igual a 60 pontos.   </span></pre>\r\n<pre><span><span><br /></span></span></pre>\r\n<pre>O resumo deve ser in&eacute;dito e conter introdu&ccedil;&atilde;o, objetivos, material e m&eacute;todos (ou metodologia), resultados e conclus&otilde;es. Estes t&oacute;picos dever&atilde;o estar <strong>subentendidos</strong> na reda&ccedil;&atilde;o do resumo, ou seja, o t&iacute;tulo de cada t&oacute;pico n&atilde;o dever&aacute; aparecer no texto. </pre>\r\n<pre>Os resumos que n&atilde;o respeitarem esse padr&atilde;o, sobretudo os que n&atilde;o apresentarem resultados, ser&atilde;o desclassificados, sendo aceitos apenas os que estiverem de acordo com este Regulamento. </pre>\r\n<pre><br /></pre>\r\n<pre><span><br /></span><span><br /></span><span>Para acessar, utilize o endere&ccedil;o abaixo:</span></pre>\r\n<pre><a href=\"simposio.php\" target=\"_blank\">https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2023/simposio.php</a><span><br /></span><span>\r\n<br /></span><span><br /></span><span>O prazo para a avalia&ccedil;&atilde;o termina no dia <strong>18/09/2023</strong></span></pre>\r\n<pre><span><br /></span></pre>\r\n<pre>O Certificado de avalia&ccedil;&atilde;o ser&aacute; gerado pelo pr&oacute;prio Sistema ap&oacute;s a finaliza&ccedil;&atilde;o do evento. </pre>\r\n<pre><span><br /></span></pre>\r\n<pre><span>Desde j&aacute; agradecemos a vossa contribui&ccedil;&atilde;o!</span></pre>\r\n<pre><span><br /></span></pre>\r\n<pre><span>Atenciosamente,</span></pre>\r\n<pre><br /></pre>\r\n<pre>Diretoria de Pesquisa e P&oacute;s-gradua&ccedil;&atilde;o</pre>\r\n<pre><br /></pre>\r\n<pre><span><br /></span></pre>\r\n<pre><br /></pre>\r\n<pre><br /></pre>\r\n<pre><br /></pre>\r\n<pre><span><br /></span></pre>\r\n<pre><span><br /></span></pre></html>','dppg.riopomba@ifsudestemg.edu.br ');
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `codigo_evento` int(10) NOT NULL AUTO_INCREMENT,
  `nome_evento` varchar(60) NOT NULL,
  PRIMARY KEY (`codigo_evento`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES
(1,'XV Simpósio de Ciência, Inovação & Tecnologia');
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formularios`
--

DROP TABLE IF EXISTS `formularios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formularios` (
  `codigo_formulario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_formulario` varchar(40) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `cpf_participante` varchar(11) NOT NULL,
  `data_modificacao` date NOT NULL,
  `hora_modificacao` time NOT NULL,
  `caminho_formulario` varchar(200) NOT NULL,
  `prazoExibirNotaExterna` varchar(40) NOT NULL,
  PRIMARY KEY (`codigo_formulario`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formularios`
--

LOCK TABLES `formularios` WRITE;
/*!40000 ALTER TABLE `formularios` DISABLE KEYS */;
INSERT INTO `formularios` VALUES
(1,'Apresentação','0000-00-00','0000-00-00','','2023-10-03','18:53:00','conteudo2.php',''),
(2,'Trabalhos Submetidos','0000-00-00','0000-00-00','','2020-10-04','16:22:00','trabalhos.php',''),
(3,'Trabalhos para Avaliação','0000-00-00','0000-00-00','','2014-07-28','09:55:00','avaliacao.php',''),
(4,'Submissão de Trabalhos','2023-07-24','2023-08-29','','2023-08-30','14:20:00','form_sub_trabalhos.php',''),
(5,'Cadastro Simpósio','2023-07-18','2023-10-26','','2023-07-24','16:04:00','conteudo_insc.php',''),
(6,'Inscrição no Simpósio','2023-10-11','2023-10-26','','2023-10-09','17:24:00','eventos_insc.php&codigo=1',''),
(7,'Certificado Geral','2023-11-10','0000-00-00','','2023-11-13','16:37:00','certificado_simposio.php',''),
(8,'Certificado Submissão','0000-00-00','0000-00-00','','0000-00-00','00:00:00','certificado_submissao.php',''),
(9,'prazo','0000-00-00','0000-00-00','','0000-00-00','00:00:00','2023-09-01',''),
(10,'prazoexterno','0000-00-00','0000-00-00','','0000-00-00','00:00:00','2023-11-11',''),
(11,'prazoExibirNotaExterna','0000-00-00','0000-00-00','','0000-00-00','00:00:00','2023-09-28','');
/*!40000 ALTER TABLE `formularios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grande_area`
--

DROP TABLE IF EXISTS `grande_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grande_area` (
  `codigo_ga` int(10) NOT NULL AUTO_INCREMENT,
  `nome_ga` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo_ga`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grande_area`
--

LOCK TABLES `grande_area` WRITE;
/*!40000 ALTER TABLE `grande_area` DISABLE KEYS */;
INSERT INTO `grande_area` VALUES
(1,'-----'),
(2,'Ciências Exatas/Ciências Exatas e da Terra'),
(4,'Ciências da Vida/Ciências Biológicas e Ciências da Saúde'),
(5,'Ciências Exatas/Engenharias'),
(8,'Ciências da Vida/Ciências Agrárias e Ciências Ambientais'),
(14,'Ciências Humanas/Ciências Sociais, Ciências Humanas, Linguística, Letras e Artes');
/*!40000 ALTER TABLE `grande_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `codigo_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_grupo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codigo_grupo`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES
(1,'Administrador'),
(2,'Avaliador'),
(3,'Representante'),
(4,'Comissão'),
(5,'Participante'),
(6,'Geral'),
(7,'Avaliador Externo');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_link`
--

DROP TABLE IF EXISTS `grupo_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_link` (
  `codigo_grupo` int(11) NOT NULL,
  `codigo_link` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  PRIMARY KEY (`codigo_grupo`,`codigo_link`),
  KEY `codigo_link` (`codigo_link`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_link`
--

LOCK TABLES `grupo_link` WRITE;
/*!40000 ALTER TABLE `grupo_link` DISABLE KEYS */;
INSERT INTO `grupo_link` VALUES
(1,19,10),
(1,20,10),
(1,21,10),
(1,22,10),
(1,27,10),
(1,30,10),
(1,35,10),
(1,36,10),
(2,25,10),
(3,2,10),
(3,26,10),
(4,27,10),
(4,30,10),
(5,6,10),
(5,16,10),
(5,17,10),
(5,18,10),
(5,24,10),
(5,28,10),
(6,1,1),
(6,51,2),
(6,52,3),
(6,4,9),
(6,5,8),
(7,49,10),
(7,50,10),
(6,53,4),
(6,54,5),
(6,57,10),
(6,58,10),
(6,59,10),
(6,60,2),
(6,61,9);
/*!40000 ALTER TABLE `grupo_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_pro`
--

DROP TABLE IF EXISTS `grupo_pro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_pro` (
  `codigo_grupo` int(11) NOT NULL DEFAULT '0',
  `cpf` varchar(11) NOT NULL DEFAULT '0',
  `area` varchar(3) NOT NULL,
  PRIMARY KEY (`codigo_grupo`,`cpf`),
  KEY `cpf` (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_pro`
--

LOCK TABLES `grupo_pro` WRITE;
/*!40000 ALTER TABLE `grupo_pro` DISABLE KEYS */;

/*!40000 ALTER TABLE `grupo_pro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico`
--

DROP TABLE IF EXISTS `historico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico` (
  `codigo_historico` int(11) NOT NULL AUTO_INCREMENT,
  `cpf_prof_analisador` varchar(11) DEFAULT NULL,
  `codigo_trab` int(11) DEFAULT NULL,
  `observacao` longtext,
  `cpf` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_historico`),
  KEY `cpf` (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico`
--

LOCK TABLES `historico` WRITE;
/*!40000 ALTER TABLE `historico` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscricao`
--

DROP TABLE IF EXISTS `inscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscricao` (
  `cpf` varchar(11) NOT NULL,
  `data_inscricao` date NOT NULL,
  `hora_inscricao` time NOT NULL,
  `pagamento` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`cpf`)
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
-- Table structure for table `itens_inscricao`
--

DROP TABLE IF EXISTS `itens_inscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_inscricao` (
  `cpf` varchar(11) NOT NULL,
  `codigo_sub_evento` int(10) NOT NULL DEFAULT '0',
  `presenca` varchar(3) NOT NULL,
  PRIMARY KEY (`cpf`,`codigo_sub_evento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_inscricao`
--

LOCK TABLES `itens_inscricao` WRITE;
/*!40000 ALTER TABLE `itens_inscricao` DISABLE KEYS */;

/*!40000 ALTER TABLE `itens_inscricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_menu`
--

DROP TABLE IF EXISTS `link_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link_menu` (
  `codigo_link` int(11) NOT NULL AUTO_INCREMENT,
  `nome_link` varchar(60) NOT NULL,
  `cpf_participante` varchar(11) NOT NULL,
  `data_modificacao` date NOT NULL,
  `hora_modificacao` time NOT NULL,
  `icone` varchar(50) NOT NULL,
  `caminho` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo_link`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_menu`
--

LOCK TABLES `link_menu` WRITE;
/*!40000 ALTER TABLE `link_menu` DISABLE KEYS */;
INSERT INTO `link_menu` VALUES
(1,'Home','','2021-10-27','18:21:00','Imagem da DPPG.jpg','principal2.php'),
(2,'Consultar Acervo','','0000-00-00','00:00:00','acervo.png','form_acervo.php'),
(57,'Validar Certificado','','2015-05-07','16:29:00','validarCertificado.png','form_validar_certificado.php'),
(4,'Cadastro Simpósio','','0000-00-00','00:00:00','user1.png','conteudo_insc.php'),
(5,'Programação','','0000-00-00','00:00:00','programacao.png','eventos.php&codigo=1'),
(6,'Inscrição','','0000-00-00','00:00:00','lampada.png','eventos_insc.php&codigo=1'),
(22,'Listagem Participantes','','0000-00-00','00:00:00','listagem.png','listagem_participante.php'),
(21,'Pagamento','','0000-00-00','00:00:00','money.png','form_pagamento.php'),
(20,'Trabalhos para Avaliadores Externos','','0000-00-00','00:00:00','listagem.png','opcao_avaliador.php'),
(19,'Administração','','2012-02-07','14:24:00','admin.png','administracao.php'),
(18,'Comprovante de Inscrição','','0000-00-00','00:00:00','impressora.png','comprovante_insc.php'),
(17,'Submissão de Trabalhos','','0000-00-00','00:00:00','fm.png','form_sub_trabalhos.php'),
(16,'Dados Pessoais','','0000-00-00','00:00:00','dadop.png','form_alt.php'),
(23,'Trabalhos Aprovados','','0000-00-00','00:00:00','trabalho.png','listagem_trabalhos_aprovados.php'),
(24,'Certificado Geral','','0000-00-00','00:00:00','certificado.png','certificado_simposio.php'),
(25,'Parecer do(a) Orientador(a)','','2018-06-20','11:07:00','report.png','avaliacao.php'),
(26,'Trabalhos','','0000-00-00','00:00:00','note.png','trabalhos.php'),
(27,'Presença','','0000-00-00','00:00:00','presenca.png','presenca.php'),
(28,'Sair','','0000-00-00','00:00:00','porta.png','logout.php'),
(29,'Certificado Submissão','','0000-00-00','00:00:00','certificado2.png','certificado_submissao.php'),
(30,'Presença Trabalho','','0000-00-00','00:00:00','presenca_trabalho.png','presenca_trabalho.php'),
(36,'Lista de Submissões','','2013-02-27','16:06:00','listagem.png','listagem_apresentacoes.php'),
(35,'Trabalhos Avaliados','','0000-00-00','00:00:00','find.png','listagem_trabalhos_teste.php'),
(49,'Avaliação Externa','','0000-00-00','00:00:00','report.png','avaliacao_externa.php'),
(50,'Certificado Avaliador(a)','','2018-06-19','19:29:00','certificado.png','certificado_avaliador.php'),
(51,'Apresentação','','0000-00-00','00:00:00','document50.png','apresentacao.php'),
(52,'Corpo Editorial','','0000-00-00','00:00:00','report50.png','corpoEditorial.php'),
(53,'Expediente','','0000-00-00','00:00:00','expediente.png','expediente.php'),
(54,'Normas para Publicação','','0000-00-00','00:00:00','normas.png','normasPublicacao.php'),
(55,'Edição Atual','','0000-00-00','00:00:00','acervo.png','form_acervo.php'),
(56,'Edições Anteriores','','0000-00-00','00:00:00','acervo1.png','form_acervo1.php'),
(58,'Anais','','2023-12-20','21:58:00','anais.ico','dppg/anais-simposio/'),
(59,'DPPG','','2021-10-27','11:31:00','DPPG.jpg','dppg'),
(60,'Regulamento','','0000-00-00','00:00:00','regulamento.png','regulamento.php'),
(61,'Modelo de Pôster','','2022-10-19','09:41:00','poster.png','modelo_poster.php');
/*!40000 ALTER TABLE `link_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modalidade`
--

DROP TABLE IF EXISTS `modalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modalidade` (
  `cod_modalidade` int(10) NOT NULL AUTO_INCREMENT,
  `nome_modalidade` varchar(40) NOT NULL,
  PRIMARY KEY (`cod_modalidade`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modalidade`
--

LOCK TABLES `modalidade` WRITE;
/*!40000 ALTER TABLE `modalidade` DISABLE KEYS */;
INSERT INTO `modalidade` VALUES
(1,'Iniciação Científica e Tecnológica'),
(3,'Estudos Orientados');
/*!40000 ALTER TABLE `modalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participantes`
--

DROP TABLE IF EXISTS `participantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participantes` (
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `codigo_tipo_participante` int(10) NOT NULL,
  `codigo_tipo_iniciacao` int(10) NOT NULL,
  `codigo_curso` int(10) NOT NULL,
  `campus` varchar(50) NOT NULL,
  `codigo_depto` int(10) NOT NULL,
  `codigo_sa` int(11) NOT NULL,
  `pesquisa` varchar(100) NOT NULL,
  `visitante` int(11) NOT NULL,
  `iniciacao` varchar(1) NOT NULL,
  `enviou_email` int(11) NOT NULL,
  PRIMARY KEY (`cpf`),
  KEY `dp` (`codigo_depto`),
  KEY `cp` (`codigo_curso`),
  KEY `tipop` (`codigo_tipo_participante`),
  KEY `codigo_sa` (`codigo_sa`),
  KEY `codigo_tipo_iniciacao` (`codigo_tipo_iniciacao`)
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
-- Table structure for table `sub_area`
--

DROP TABLE IF EXISTS `sub_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_area` (
  `codigo_sa` int(10) NOT NULL AUTO_INCREMENT,
  `nome_sa` varchar(50) NOT NULL,
  `cpf_representante` varchar(11) NOT NULL,
  `codigo_ga` int(10) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  PRIMARY KEY (`codigo_sa`),
  KEY `gras` (`codigo_ga`),
  KEY `ps` (`cpf`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_area`
--

LOCK TABLES `sub_area` WRITE;
/*!40000 ALTER TABLE `sub_area` DISABLE KEYS */;
INSERT INTO `sub_area` VALUES
(20,'Agronomia, Agricultura e Ambiente','',8,''),
(18,'Engenharias','',5,''),
(36,'Artes','',14,''),
(9,'Ciência da Computação','',2,''),
(4,'Ciências Biológicas e Biotecnologia','',4,''),
(5,'Ciências da Saúde','',4,''),
(35,'Educação','',14,''),
(11,'Matemática, física e estatística','',2,''),
(21,'Ciência e Tecnologia de Alimentos','',5,''),
(22,'Zootecnia','',8,''),
(29,'Química','',2,''),
(12,'Ciências gerenciais','',14,''),
(34,'Ciências Sociais, Humanas, Linguística e Letras','',14,'');
/*!40000 ALTER TABLE `sub_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_eventos`
--

DROP TABLE IF EXISTS `sub_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_eventos` (
  `codigo_sub_evento` int(10) NOT NULL AUTO_INCREMENT,
  `nome_sub_evento` varchar(200) NOT NULL,
  `data` date NOT NULL DEFAULT '0000-00-00',
  `horario` time NOT NULL DEFAULT '00:00:00',
  `duracao` int(10) NOT NULL,
  `palestrante` longtext CHARACTER SET utf8 NOT NULL,
  `dados_palestrante` longtext NOT NULL,
  `vagas` int(10) NOT NULL,
  `codigo_evento` int(10) NOT NULL,
  `local` varchar(50) NOT NULL,
  `titulo` longtext NOT NULL,
  `descricao` longtext,
  `lattes_participante` varchar(100) NOT NULL,
  `codigo_bloco` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_sub_evento`),
  KEY `ese` (`codigo_evento`),
  KEY `codigo_bloco` (`codigo_bloco`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_eventos`
--

LOCK TABLES `sub_eventos` WRITE;
/*!40000 ALTER TABLE `sub_eventos` DISABLE KEYS */;
INSERT INTO `sub_eventos` VALUES
(62,'Apresentação Oral','2023-10-25','16:00:00',20,'ATHOS EMANUEL BRITO NOVAES','',170,1,'Salão Nobre','Nodulação dos cultivares de feijoeiro ouro vermelho e ouro negro por rizóbios nativos a partir do cultivo em solos com diferentes usos','Nodulação dos cultivares de feijoeiro ouro vermelho e ouro negro por rizóbios nativos a partir do cultivo em solos com diferentes usos',' http://lattes.cnpq.br/3359258065625704',2),
(63,'Apresentação Oral','2023-10-25','16:20:00',20,'JOÃO PEDRO OLIVEIRA MALFITANO','',167,1,'Salão Nobre','PERCEPÇÃO DAS AULAS DE EDUCAÇÃO FÍSICA SEGUNDO OS ESTUDANTES DO CAMPUS RIO POMBA','PERCEPÇÃO DAS AULAS DE EDUCAÇÃO FÍSICA SEGUNDO OS ESTUDANTES DO CAMPUS RIO POMBA','http://lattes.cnpq.br/3359258065625704',2),
(64,'Apresentação Oral','2023-10-25','18:40:00',20,'SARA ELIZABETH DA SILVEIRA','',19,1,'Anfiteatro do Prédio Central','O CEJUSC Rio Pombense como Mecanismo de acesso à justiça','O CEJUSC Rio Pombense como Mecanismo de acesso à justiça','http://lattes.cnpq.br/4210246030249641',2),
(65,'Apresentação Oral','2023-10-25','19:00:00',20,'MAGDA SOUSA SENRA','',15,1,'Anfiteatro do Prédio Central','A JUDICIALIZAÇÃO DA SAÚDE EM RIO POMBA: EFETIVIDADE E IMPACTOS FINANCEIROS AO ENTE PÚBLICO MUNICIPAL','A JUDICIALIZAÇÃO DA SAÚDE EM RIO POMBA:\r\nEFETIVIDADE E IMPACTOS FINANCEIROS AO ENTE\r\nPÚBLICO MUNICIPAL ','http://lattes.cnpq.br/8591676165863526',2),
(66,'Apresentação Oral','2023-10-25','19:20:00',20,'TERESA SOARES MOURA','',11,1,'Anfiteatro do Prédio Central','O ENSINO DE FRAÇÕES POR MEIO DE JOGOS E TECNOLOGIAS: UM ESTUDO DE ESTADO DA ARTE A PARTIR DA BNCC','O ENSINO DE FRAÇÕES POR MEIO DE JOGOS E\r\nTECNOLOGIAS: UM ESTUDO DE ESTADO DA ARTE A PARTIR DA BNCC',' http://lattes.cnpq.br/4404839344603062',2),
(67,'Apresentação Oral','2023-10-25','19:40:00',20,'WALQUIRIA DE SOUZA LIMA BRITO','',16,1,'Anfiteatro do Prédio Central','Possibilidade de ensino de Geometria Espacial para curso técnico em Zootecnia','Possibilidade de ensino de Geometria Espacial para curso técnico em Zootecnia','http://lattes.cnpq.br/2300357485328718',2),
(68,'Apresentação Oral','2023-10-26','08:00:00',20,'LAISMARA ALVES ARAUJO','',10,1,'Sala 1 do 3º Andar do Prédio da Biblioteca','Estabilidade microbiológica de linguiças cozidas embaladas a vácuo durante sua vida de prateleira em condições de temperatura ambiente da região do Sul do Estado do Rio de Janeiro','Estabilidade microbiológica de linguiças cozidas embaladas a vácuo durante sua vida de prateleira em condições de temperatura ambiente da região do Sul do Estado do Rio de Janeiro ','http://lattes.cnpq.br/0247858615310019',2),
(69,'Apresentação Oral','2023-10-26','08:20:00',20,'NATÁLIA LOPES COELHO','',13,1,'Sala 1 do 3º Andar do Prédio da Biblioteca','CARACTERÍSTICAS FÍSICO-QUÍMICAS E VIABILIDADE DE Bacillus clausii EM BARRAS DE CEREAIS','CARACTERÍSTICAS FÍSICO-QUÍMICAS E VIABILIDADE DE Bacillus clausii EM BARRAS DE CEREAIS ','http://lattes.cnpq.br/8717356362358907',2),
(70,'Apresentação Oral','2023-10-26','08:40:00',20,'SARA PEREIRA LEANDRO','',11,1,'Sala 1 do 3º Andar do Prédio da Biblioteca','ACEITAÇÃO SENSORIAL DE MARCAS DE PÃO DE QUEIJO COMERCIALIZADAS NA ZONA DA MATA MINEIRA','ACEITAÇÃO SENSORIAL DE MARCAS DE PÃO DE\r\nQUEIJO COMERCIALIZADAS NA ZONA DA MATA MINEIRA ','http://lattes.cnpq.br/9571041085122931',2),
(71,'Apresentação Oral','2023-10-26','09:00:00',20,'DOUGLAS DOMICIANO CORREA NETTO CUNHA','',15,1,'Sala 1 do 3º Andar do Prédio da Biblioteca','Uso de metodologias ativas para ensino de educação ambiental crítica: um curta metragem produzido pelos alunos do curso técnico integrado em meio ambiente','Uso de metodologias ativas para ensino de\r\neducação ambiental crítica: um curta metragem produzido pelos alunos do curso\r\ntécnico integrado em meio ambiente',' http://lattes.cnpq.br/2995807839278340',2),
(72,'Apresentação Oral','2023-10-26','09:20:00',20,'LORRANY FERNANDES FARIA','',-1,1,'Sala 1 do 3º Andar do Prédio da Biblioteca','Comportamento ingestivo de vacas leiteiras recebendo milho probiotado em sua dieta','Comportamento ingestivo de vacas leiteiras\r\nrecebendo milho probiotado em sua dieta','http://lattes.cnpq.br/2384920865168284',2),
(73,'Apresentação Oral','2023-10-26','09:40:00',20,'INGRID BARBOSA GUERREIRO','',-1,1,'Sala 1 do 3º Andar do Prédio da Biblioteca','AVALIAÇÃO DE LOMBO SUÍNO (Longissimus dorsi) SUBMETIDO A DIFERENTES PROCESSOS DE MATURAÇÃO','AVALIAÇÃO DE LOMBO SUÍNO (Longissimus\r\ndorsi) SUBMETIDO A DIFERENTES PROCESSOS DE\r\nMATURAÇÃO ','http://lattes.cnpq.br/1455570868980095',2),
(58,'Apresentação Oral','2023-10-25','15:40:00',20,'EMANOEL FARIA DOS SANTOS','',166,1,'Salão Nobre','Classificação de Depressão e Ansiedade em Textos usando Aprendizado Profundo','Classificação de Depressão e Ansiedade em Textos usando Aprendizado Profundo',' http://lattes.cnpq.br/5584323933178748',2),
(61,'Apresentação Oral','2023-10-25','14:40:00',20,'THAÍS SANTOS PELEGRINO','',171,1,'Salão Nobre','Estimativa do estoque de carbono na necromassa vegetal de uma Floresta Estacional Semidecidual na Mata Atlântica mineira','Estimativa do estoque de carbono na necromassa vegetal de uma Floresta Estacional Semidecidual na Mata Atlântica mineira ','http://lattes.cnpq.br/8200330984876303',2),
(59,'Apresentação Oral','2023-10-25','15:00:00',20,'JORDÂNA CUSTÓDIO ALVES','',156,1,'Salão Nobre','JOVENS ESTUDANTES ELEVAM A PERFORMANCE QUANTITATIVA DO TOQUE NO VOLEIBOL APÓS 10 SEMANA DE TREINAMENTO DE AMORTIMENTO DA BOLA','JOVENS ESTUDANTES ELEVAM A PERFORMANCE QUANTITATIVA DO TOQUE NO VOLEIBOL APÓS 10 SEMANA DE TREINAMENTO DE AMORTIMENTO DA BOLA','http://lattes.cnpq.br/9272897587962955',2),
(60,'Apresentação Oral','2023-10-25','15:20:00',20,'ISAIAS SOARES DA SILVA','',151,1,'Salão Nobre','PERCEPÇÃO DO ESTUDANTE DO CAMPUS RIO POMBA PARA O TIPO DE AULA DE EDUCAÇÃO FÍSICA QUE CONTRIBUI PARA A FORMAÇÃO CIDADÃ','PERCEPÇÃO DO ESTUDANTE DO CAMPUS RIO POMBA\r\nPARA O TIPO DE AULA DE EDUCAÇÃO FÍSICA QUE CONTRIBUI PARA A FORMAÇÃO CIDADÃ ','http://lattes.cnpq.br/6601002456170561',2),
(57,'Apresentação Oral','2023-10-25','14:20:00',20,'GABRIEL JOSÉ DOS SANTOS REIS','',171,1,'Salão Nobre','Estoque de carbono de um fragmento florestal na região da Zona da Mata mineira','Estoque de carbono deum fragmento florestal na região da Zona da Mata mineira','http://lattes.cnpq.br/3586563703839996',2),
(56,'Apresentação Oral','2023-10-25','14:00:00',20,'RAQUEL CERONI FERREIRA','',173,1,'Salão Nobre','Estudo da perda de água e da concentração de sais em tanques de evapotranspiração (TEvap) cultivados com diferentes espécies vegetais','Estudo da perda de água e da concentração de sais em tanques de evapotranspiração\r\n(TEvap) cultivados com diferentes espécies\r\nvegetais ','http://lattes.cnpq.br/8145122025331773',2),
(53,'Mesa de abertura','2023-10-25','08:30:00',25,'Dirigentes do IF Sudeste MG','',68,1,'Salão Nobre','Mesa de abertura do XV Simpósio de Ciência, Inovação & Tecnologia ','Mesa de abertura do XV Simpósio de Ciência, Inovação & Tecnologia.','https://buscatextual.cnpq.br/buscatextual/busca.do?metodo=apresentar',2),
(54,'Apresentação do Livro do XIV Simpósio','2023-10-25','08:55:00',5,'Franciano Benevenuto Caetano','',80,1,'Salão Nobre','Apresentação do livro: A pesquisa científica do campus Rio Pomba do IF Sudeste MG em destaque: avanços no cenário científico, tecnológico e de Inovação','Apresentação do livro: A pesquisa científica do campus Rio Pomba do IF Sudeste MG em destaque: avanços no cenário\r\ncientífico, tecnológico e de Inovação','http://lattes.cnpq.br/9938385313759645',2),
(55,'Palestra de Abertura do XV Simpósio','2023-10-25','09:30:00',90,'José Hugo Campos Ribeiro','',64,1,'Salão Nobre','Ciência básicas para o Desenvolvimento Sustentável: desafios e oportunidades em um país megadiversos','Ciência básicas para o Desenvolvimento Sustentável: desafios e oportunidades em um país megadiversos',' http://lattes.cnpq.br/7776426156093218',2);
/*!40000 ALTER TABLE `sub_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_iniciacao`
--

DROP TABLE IF EXISTS `tipo_iniciacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_iniciacao` (
  `codigo_tipo_iniciacao` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo_tipo_iniciacao`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_iniciacao`
--

LOCK TABLES `tipo_iniciacao` WRITE;
/*!40000 ALTER TABLE `tipo_iniciacao` DISABLE KEYS */;
INSERT INTO `tipo_iniciacao` VALUES
(1,'-----'),
(2,'FAPEMIG'),
(3,'FAPEMIG Jr'),
(4,'CNPq'),
(5,'CNPq Jr'),
(6,'IFSudesteMG'),
(7,'IFSudesteMG Jr'),
(8,'FUNDEP '),
(9,'FUNDEP Jr'),
(10,'Voluntário'),
(11,'Voluntário Jr'),
(12,'Outros');
/*!40000 ALTER TABLE `tipo_iniciacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_participante`
--

DROP TABLE IF EXISTS `tipo_participante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_participante` (
  `codigo_tipo_participante` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo_tipo_participante`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_participante`
--

LOCK TABLES `tipo_participante` WRITE;
/*!40000 ALTER TABLE `tipo_participante` DISABLE KEYS */;
INSERT INTO `tipo_participante` VALUES
(1,'-----'),
(2,'Aluno'),
(3,'Docente'),
(4,'Ex-Aluno'),
(5,'Técnico Administrativo'),
(6,'Outros'),
(8,'Tipo não declarado');
/*!40000 ALTER TABLE `tipo_participante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_submissao`
--

DROP TABLE IF EXISTS `tipo_submissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_submissao` (
  `codigo_submissao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_submissao` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo_submissao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_submissao`
--

LOCK TABLES `tipo_submissao` WRITE;
/*!40000 ALTER TABLE `tipo_submissao` DISABLE KEYS */;
INSERT INTO `tipo_submissao` VALUES
(1,'Comunicação Oral'),
(2,'Pôster (Painel)');
/*!40000 ALTER TABLE `tipo_submissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabalhos`
--

DROP TABLE IF EXISTS `trabalhos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trabalhos` (
  `codigo_trab` int(10) NOT NULL AUTO_INCREMENT,
  `arquivo` varchar(200) DEFAULT NULL,
  `situacao` varchar(40) DEFAULT NULL,
  `autor1` varchar(11) NOT NULL,
  `autor2` varchar(11) DEFAULT NULL,
  `autor3` varchar(11) DEFAULT NULL,
  `autor4` varchar(11) DEFAULT NULL,
  `autor5` varchar(11) DEFAULT NULL,
  `autor6` varchar(11) DEFAULT NULL,
  `autor7` varchar(11) DEFAULT NULL,
  `cpf_prof_analisador` varchar(11) NOT NULL,
  `titulo` longtext NOT NULL,
  `resumo` longtext COMMENT 'LongText',
  `palavra_chave` longtext NOT NULL,
  `tipo_projeto` varchar(3) NOT NULL,
  `modalidade` varchar(1) DEFAULT NULL,
  `tipo_iniciacao` varchar(1) DEFAULT NULL,
  `codigo_sa` int(10) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `aprovado` int(1) DEFAULT NULL,
  `presenca` varchar(1) DEFAULT NULL,
  `acervo` int(1) DEFAULT '0',
  `ano` varchar(4) DEFAULT NULL,
  `apresentador` varchar(1) DEFAULT NULL,
  `dias_restantes` int(11) DEFAULT '0',
  `data_envio` date DEFAULT NULL,
  `avaliado` int(11) DEFAULT '0',
  `nota1` varchar(15) NOT NULL DEFAULT '',
  `nota2` varchar(15) NOT NULL DEFAULT '',
  `aprovado_ext` int(1) NOT NULL,
  `tipo_apresentacao` tinyint(1) DEFAULT NULL COMMENT '0 para apresentação pôster, 1 para apresentação oral',
  PRIMARY KEY (`codigo_trab`),
  KEY `mt` (`modalidade`),
  KEY `atka` (`codigo_sa`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabalhos`
--

LOCK TABLES `trabalhos` WRITE;
/*!40000 ALTER TABLE `trabalhos` DISABLE KEYS */;
/*!40000 ALTER TABLE `trabalhos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valida_certificado`
--

DROP TABLE IF EXISTS `valida_certificado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valida_certificado` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) NOT NULL,
  `codigo_trab` int(11) DEFAULT NULL,
  `data` datetime NOT NULL,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valida_certificado`
--

LOCK TABLES `valida_certificado` WRITE;
/*!40000 ALTER TABLE `valida_certificado` DISABLE KEYS */;

/*!40000 ALTER TABLE `valida_certificado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `ListaInscritos`
--

/*!50001 DROP VIEW IF EXISTS `ListaInscritos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`userdppg`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `ListaInscritos` AS select `se`.`nome_sub_evento` AS `Evento`,`se`.`palestrante` AS `PALESTRANTE`,`p`.`cpf` AS `CPF`,`p`.`nome` AS `NOME` from ((`participantes` `p` join `sub_eventos` `se`) join `itens_inscricao` `ii`) where ((`ii`.`codigo_sub_evento` = `se`.`codigo_sub_evento`) and (`ii`.`cpf` = `p`.`cpf`)) group by `se`.`nome_sub_evento`,`se`.`palestrante`,`p`.`nome` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `Lista_Eventos_FULL`
--

/*!50001 DROP VIEW IF EXISTS `Lista_Eventos_FULL`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`userdppg`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `Lista_Eventos_FULL` AS select `se`.`nome_sub_evento` AS `nome_sub_evento`,`se`.`titulo` AS `titulo`,`se`.`palestrante` AS `palestrante`,`p`.`cpf` AS `cpf`,`p`.`nome` AS `nome` from ((`sub_eventos` `se` join `participantes` `p`) join `itens_inscricao` `ii`) where ((`ii`.`codigo_sub_evento` = `se`.`codigo_sub_evento`) and (`p`.`cpf` = `ii`.`cpf`)) group by `se`.`nome_sub_evento`,`se`.`titulo`,`p`.`nome` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-21 11:37:34
