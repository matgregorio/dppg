<?php
/* ATENÇÃO: EXCLUIR ESTE ARQUIVO EM 2021, E USAR O ARQUIVO certificado_submissao.php. ALTERAR TAMBÉM O ARQVUIO form_sub_trabalhos, NA LINHA 319*/

session_start();
header("Content-Type: text/html; charset=utf-8", true);

if ($_SESSION[logado_simposio_2021])
{
    include("includes/config.php");
    include("funcao.php");

    $sql_data = "select data_inicio from formularios where codigo_formulario = '7'";
    $resultado_data = mysql_query($sql_data);
    $campos_data = mysql_fetch_array($resultado_data);

    $data_inicio = datadobanco($campos_data[data_inicio]);
    $data_fim = datadobanco($campos_data[data_fim]);

    $data = $data_inicio;
    $data_i = datasemcaracter($data_inicio);

    $apresentacaoPoster = array(61,93,16,86,132,102,114,10,89,128,22);
    $apresentacaoOral = array(77,49,28,18,103,14,50,51,98,131,83,99,79,33,106,101,40,90,91,59,58,65,31,36,137,122);

    if ((date("Ymd") < $data_i))
        echo '<center><font color="#FF0000"><b>O certificado poderá ser gerado a partir da data ' . $data . '.</b></font><center>';
    else
    {
        $poster = false;
        $codigo_trab = mysql_real_escape_string($_GET[codigo]);
        $tipo = "submissao";

        //$sql = "select * from trabalhos t, participantes p where p.cpf = t.cpf and t.aprovado ='1' and 	t.presenca = 'S' and p.cpf ='$_SESSION[cpf]' and codigo_trab=$codigo_trab";
//        $sql = "select * from trabalhos t where t.aprovado ='1' and t.presenca = 'S' and t.aprovado_ext='1' and codigo_trab=$codigo_trab" ;
        $sql = "select * from trabalhos t where t.aprovado ='1' and t.aprovado_ext='1' and codigo_trab=$codigo_trab" ;
        $resultado = mysql_query($sql);
        $campos = mysql_fetch_array($resultado);
        $cpfsAutorizadosAVerCertificado = array($campos[autor1], $campos[autor2], $campos[autor3], $campos[autor4], $campos[autor5], $campos[autor6], $campos[autor7], $campos[cpf_prof_analisador], $campos[cpf]);

        /*Só abre o certificado os participantes do trabalho e os administradores do sistema*/
        if(!in_array($_SESSION[cpf], $cpfsAutorizadosAVerCertificado) && !in_array("1", $_SESSION[codigo_grupo]))
        {
            echo"<br><br><br><center> <h2> Voc&ecirc; n&atilde;o est&aacute; autorizado a ver este conte&uacute;do </h2> </center>";
            return;
        }

        $sql_submissao = mysql_query("SELECT conteudo_submissao FROM tipo_submissao WHERE codigo_submissao=$campos[codigo_submissao]");
        $campo_submissao = mysql_fetch_array($sql_submissao);

        $sql_texto_edicao = "select informacoes from conteudo where codigo_conteudo = '10'";
        $resultado_edicao = mysql_query($sql_texto_edicao);
        $campos_edicao = mysql_fetch_array($resultado_edicao);

        $sql_texto_periodo = "select informacoes from conteudo where codigo_conteudo = '11'";
        $resultado_periodo = mysql_query($sql_texto_periodo);
        $campos_periodo = mysql_fetch_array($resultado_periodo);

        $sql_topo = "select topo from conteudo where codigo_conteudo = '7'";
        $resultado_topo = mysql_query($sql_topo);
        $campos_topo = mysql_fetch_array($resultado_topo);

        $sql_assinatura1 = "select assinatura, cargo, imagem_assinatura from conteudo where codigo_conteudo = '8'";
        $resultado_assinatura1 = mysql_query($sql_assinatura1);
        $campos_assinatura1 = mysql_fetch_array($resultado_assinatura1);

        $sql_assinatura2 = "select assinatura, cargo, imagem_assinatura from conteudo where codigo_conteudo = '9'";
        $resultado_assinatura2 = mysql_query($sql_assinatura2);
        $campos_assinatura2 = mysql_fetch_array($resultado_assinatura2);

        $orientador = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM  participantes WHERE cpf='$campos[cpf_prof_analisador]'"));

        $autor1 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor1]'"));

        if ($campos[autor2])
        {
            $autor2 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor2]'"));
        }
        if ($campos[autor3]) {
            $autor3 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor3]'"));
        }
        if ($campos[autor4]) {
            $autor4 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor4]'"));
        }
        if ($campos[autor5]) {
            $autor5 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor5]'"));
        }
        if ($campos[autor6]) {
            $autor6 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor6]'"));
        }
        if ($campos[autor7]) {
            $autor7 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor7]'"));
        }
        if ($autor1[cpf] != $orientador[cpf]) {
            $texto1 = ", $orientador[nome]";
        }
        if ($autor2 != '') {
            $texto1 = $texto1 . ', ' . $autor2[nome];
        }
        if ($autor3 != '') {
            $texto1 = $texto1 . ', ' . $autor3[nome];
        }
        if ($autor4 != '') {
            $texto1 = $texto1 . ', ' . $autor4[nome];
        }
        if ($autor5 != '') {
            $texto1 = $texto1 . ', ' . $autor5[nome];
        }
        if ($autor6 != '') {
            $texto1 = $texto1 . ', ' . $autor6[nome];
        }
        if ($autor7 != '') {
            $texto1 = $texto1 . ', ' . $autor7[nome];
        }

        //  $pdf->SetFont('arial', '', 20);
        //  $texto = iconv('utf-8', 'iso-8859-1', "Certificamos que ");
        //  $pdf->SetY("75");
        //  $pdf->SetX("45");
        //  $pdf->MultiCell(220, 8, $texto, 'J');

        if ($campos[autor1] == $_SESSION[cpf]) {
            //    $texto = iconv('utf-8', 'iso-8859-1', ($autor1[nome]));
            $texto = $autor1[nome];
        } else if ($campos[autor2] == $_SESSION[cpf]) {
            //    $texto = iconv('utf-8', 'iso-8859-1', ($autor2[nome]));
            $texto = $autor2[nome];
        } else if ($campos[autor3] == $_SESSION[cpf]) {
            //    $texto = iconv('utf-8', 'iso-8859-1', ($autor3[nome]));
            $texto = $autor3[nome];
        } else if ($campos[autor4] == $_SESSION[cpf]) {
            //    $texto = iconv('utf-8', 'iso-8859-1', ($autor4[nome]));
            $texto = $autor4[nome];
        } else if ($campos[autor5] == $_SESSION[cpf]) {
            //    $texto = iconv('utf-8', 'iso-8859-1', ($autor5[nome]));
            $texto = $autor5[nome];
        } else if ($campos[autor6] == $_SESSION[cpf]) {
            //    $texto = iconv('utf-8', 'iso-8859-1', ($autor6[nome]));
            $texto = $autor6[nome];
        } else if ($campos[autor7] == $_SESSION[cpf]) {
            //    $texto = iconv('utf-8', 'iso-8859-1', ($autor7[nome]));
            $texto = $autor7[nome];
        } elseif ($campos[cpf_prof_analisador] == $_SESSION[cpf]) {
            //    $texto = iconv("utf-8", "iso-8859-1", ($orientador[nome]));
            $texto = $orientador[nome];
        }

        /* tabela trabalho tem o identificador do autor apresentador */
        if($campos[apresentador] == 0)
        {
            $cpf_apresentador = $campos[cpf_prof_analisador];
        }
        elseif ($campos[apresentador] == 1)
        {
            $cpf_apresentador = $autor1[cpf];
        }
        else if ($campos[apresentador] == 2)
        {
            $cpf_apresentador = $autor2[cpf];
        }
        else if ($campos[apresentador] == 3)
        {
            $cpf_apresentador = $autor3[cpf];
        }
        else if ($campos[apresentador] == 4)
        {
            $cpf_apresentador = $autor4[cpf];
        }
        else if ($campos[apresentador] == 5)
        {
            $cpf_apresentador = $autor5[cpf];
        }
        else if ($campos[apresentador] == 6)
        {
            $cpf_apresentador = $autor6[cpf];
        }
        else if ($campos[apresentador] == 7)
        {
            $cpf_apresentador = $autor7[cpf];
        }

        //Seleciona todos os dados do apresentador
        $sqlApresentador = "SELECT * FROM participantes WHERE participantes.cpf = '$cpf_apresentador'";
        $resultadoSqlApresentador = mysql_query($sqlApresentador);
        $apresentador = mysql_fetch_array($resultadoSqlApresentador);

        //Selecao dos apresentadores orais
        if ($campos[tipo_apresentacao] == 1)
            $poster = false;
        else
            $poster = true;

        include './valida_certificado.php';


        //A codifica��o do servidor � diferente do meu computador local, por isso fa�o essa convers�o de caracteres
        $tituloPoster  = iconv("UTF-8","ISO-8859-1",$campos[titulo]);
        $tituloPoster = iconv("ISO-8859-1","UTF-8",$tituloPoster);

        //Adiciona virgula ao nome de cada autor, se ou autor existir
        $nomeAutor1 = iconv("UTF-8","ISO-8859-1",$autor1[nome]) . ',';
        $nomeAutor1 = iconv("ISO-8859-1","UTF-8",$nomeAutor1);

        if($autor2[nome] != "")
        {
            $nomeAutor2 = iconv("UTF-8","ISO-8859-1",$autor2[nome]) . ',';
            $nomeAutor2 = iconv("ISO-8859-1","UTF-8",$nomeAutor2);
        }

        if($autor3[nome] != "")
        {
            $nomeAutor3 = iconv("UTF-8","ISO-8859-1",$autor3[nome]) . ',';
            $nomeAutor3 = iconv("ISO-8859-1","UTF-8",$nomeAutor3);
        }

        if($autor4[nome] != "")
        {
            $nomeAutor4 = iconv("UTF-8","ISO-8859-1",$autor4[nome]) . ',';
            $nomeAutor4 = iconv("ISO-8859-1","UTF-8",$nomeAutor4);
        }

        if($autor5[nome] != "")
        {
            $nomeAutor5 = iconv("UTF-8","ISO-8859-1",$autor5[nome]) . ',';
            $nomeAutor5 = iconv("ISO-8859-1","UTF-8",$nomeAutor5);
        }

        if($autor6[nome] != "")
        {
            $nomeAutor6 = iconv("UTF-8","ISO-8859-1",$autor6[nome]) . ',';
            $nomeAutor6 = iconv("ISO-8859-1","UTF-8",$nomeAutor6);
        }

        if($autor7[nome] != "")
        {
            $nomeAutor7 = iconv("UTF-8","ISO-8859-1",$autor7[nome]) . ',';
            $nomeAutor7 = iconv("ISO-8859-1","UTF-8",$nomeAutor7);
        }

        if($orientador[nome] != "")
        {
            $nomeOrientador = iconv("UTF-8","ISO-8859-1",$orientador[nome]) . ',';
            $nomeOrientador = iconv("ISO-8859-1","UTF-8",$nomeOrientador);
        }

        //Se a apresentacao for oral, escreva este conteudo
        if(in_array($codigo_trab, $apresentacaoOral))
        {
            $dizeres = "  
            Certificamos que o trabalho intitulado <b>\"$campos[titulo]\"</b>, de autoria de $nomeAutor1 $nomeOrientador $nomeAutor2 $nomeAutor3 $nomeAutor4 $nomeAutor5 $nomeAutor6 $nomeAutor7 
            foi apresentado oralmente por $apresentador[nome] no XIV Simp&oacute;sio de Ci&ecirc;ncia, 
            Inova&ccedil;&atilde;o e Tecnologia do Campus Rio Pomba, realizado entre os dias 23 e 24 de novembro de 2022.";

            //Faz a conta de quantos caracteres sobram, para introduzir a quantidade de '&nbsp;' certa
            //A funcao ceil arredonda em inteiro para cima, e a strlen conta quantos caracteres tem no texto
            $caracteresSobrando = ceil((strlen($dizeres) % 6));

            $numeroCaracteres = strlen($dizeres) + 100;

            //Acrescenta espacos no texto, para a div dos dizeres ficar com um tamanho fixo
            $dizeres = str_pad($dizeres, (1200 + $caracteresSobrando) , "&nbsp;");

            if($numeroCaracteres >= 550 && $numeroCaracteres < 600)
            {
                $tamanhoFonte = 25;
            }
            else if($numeroCaracteres >= 600 && $numeroCaracteres < 620)
            {
                $tamanhoFonte = 21;
            }

            if($numeroCaracteres >= 620 && $numeroCaracteres < 650)
            {
                $tamanhoFonte = 22;
            }

            else if($numeroCaracteres > 650 && $numeroCaracteres <= 670)
            {
                $tamanhoFonte = 20.6;
            }
            else if($numeroCaracteres > 670 && $numeroCaracteres <= 693)
            {
                $tamanhoFonte = 19;
            }
            else if($numeroCaracteres > 693 && $numeroCaracteres <= 700)
            {
                $tamanhoFonte = 20.4;
            }
            else if($numeroCaracteres > 700 && $numeroCaracteres <= 725)
            {
                $tamanhoFonte = 18;
            }
            else if($numeroCaracteres > 725 && $numeroCaracteres <= 750)
            {
                $tamanhoFonte = 20.5;
            }
            else if($numeroCaracteres > 750 && $numeroCaracteres <= 780)
            {
                $tamanhoFonte = 17.1;
            }
            else if($numeroCaracteres > 780 && $numeroCaracteres <= 800)
            {
                $tamanhoFonte = 17.5;
            }
            else if($numeroCaracteres > 800 && $numeroCaracteres <= 850)
            {
                $tamanhoFonte = 17.7;
            }

            else if($numeroCaracteres > 850 && $numeroCaracteres <= 865)
            {
                $tamanhoFonte = 17;
            }
            else if($numeroCaracteres > 860 && $numeroCaracteres <= 875)
            {
                $tamanhoFonte = 18.1;
            }
            else if($numeroCaracteres > 875 && $numeroCaracteres <= 900)
            {
                $tamanhoFonte = 18.2;
            }
            else if($numeroCaracteres > 900 && $numeroCaracteres <= 907)
            {
                $tamanhoFonte = 17;
            }
            else if($numeroCaracteres > 900 && $numeroCaracteres <= 915)
            {
                $tamanhoFonte = 18.3;
            }

            $html = <<<TAG

            
                    <!DOCTYPE html>
                    <html>
                    
                    <head>
                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    </head>
                    
                    <body>
                    
                        <!--Esta div contem todas as divs do certificado -->
                        <div id = 'container' style='position: absolute; left: 0; right: 0; top: 0; bottom: 0; z-index: 0;'>
                            
                            <!--Carregamento da marca d'agua no pdf-->
                             <img style=' position:fixed; width: 100% !important; height: 100% !important;  margin: 0 !important;' src='images/b2certificado.jpg'; />
                            
                            <!--Palavra 'Certificado'-->
                            <div style='position: fixed; width: 250px;  margin-top: -560px; z-index: 0; margin-left:43%; background-color:orange;'>
                            
                                <h1> <b> Certificado </b> </h1> 
                                
                            </div>
                            
                            <!--Resto dos dizeres do certificado-->
                            <div style ='width:1020px;  min-height:500px;  margin-top: 35px; margin-left:50px; margin-bottom:5px; font-size:$tamanhoFonte; text-align:justify;'>
                                $dizeres 
                            </div>
                            
                            <div style ='width: 970px; height: 120px; margin: 40px 0px 0px 60px;'>
                                <div style='text-align: center; margin-left: 100px; width:300px; height:100px; float: left;'>
                                   <img src='images/assinaturaLarissa.png' width='250' height='80'><br>
                                   <b>LARISSA MATTOS TREVIZANO</b><br>
                                   Diretora de Pesquisa e Pós-graduação
                            </div>
                            <div style='text-align: center;  margin-buttom: 10px ; margin-left: 160px; margin-right: 50px; width:300px; height:100px; float:left;'>
                               <img src='images/assinaturaFranciano.png' width='200' height='80'><br>
                                  <b>FRANCIANO BENEVENUTO CAETANO</b><br>
                                  Gerente de Pesquisa e Pos-graduação
                              </div>
                            </div>

                            
                            <!--Cidade e data de expedicao-->
                            <div style ='width: 800px; margin-top: 20px; margin-left:130px; font-size:21px; text-align:center;'>
                                Rio Pomba - MG, 24 de novembro de 2022
                            </div>
                            

                            
                           <!--Codigo de validacao 210 297 -->
                            <div style =' font-family: arial; font-size: 13px; width: 800px;  position: fixed; margin: 8px auto auto 120px; font-size:21px; text-align:center;'>
                                <font style='font-family: arial; font-size: 13px;'>
                                    C&oacute;digo de Valida&ccedil;&atilde;o: 
TAG
                . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "  
                                    <br>
                                    Autenticidade em: http://sistemas.riopomba.ifsudestemg.edu.br/simposio2022/simposio.php?arquivo2=form_validar_certificado.php
                                </font>
                                
                                
                            </div>  
                            
                        </div>

                    </body>

                </html>
        
            ";
        }
        else if(in_array($codigo_trab, $apresentacaoPoster)) //Se a apresentacao for poster, imprima este PDF
        {
            $tituloPoster  = iconv("UTF-8","ISO-8859-1",$campos[titulo]);
            $tituloPoster = iconv("ISO-8859-1","UTF-8",$tituloPoster);

            $dizeres = "  
            Certificamos que o trabalho intitulado <b>\"$campos[titulo]\"</b>, de autoria de $nomeAutor1 $nomeOrientador $nomeAutor2 $nomeAutor3 $nomeAutor4 $nomeAutor5 $nomeAutor6 $nomeAutor7 
            foi apresentado na forma de p&ocirc;ster por $apresentador[nome] no XIV Simp&oacute;sio de Ci&ecirc;ncia,
            Inova&ccedil;&atilde;o e Tecnologia do Campus Rio Pomba, realizado entre os dias 23 e 24 de novembro de 2022.
            ";

            $numeroCaracteres = strlen($dizeres) + 100;

            $caracteresSobrando = ceil((strlen($dizeres) % 6));

            $dizeres = str_pad($dizeres, (2000 + $caracteresSobrando) , " ");


            if($numeroCaracteres >= 550 && $numeroCaracteres < 600)
            {
                $tamanhoFonte = 25;
            }
            else if($numeroCaracteres >= 600 && $numeroCaracteres < 620)
            {
                $tamanhoFonte = 23;
            }

            if($numeroCaracteres >= 620 && $numeroCaracteres < 650)
            {
                $tamanhoFonte = 22;
            }

            else if($numeroCaracteres > 650 && $numeroCaracteres <= 670)
            {
                $tamanhoFonte = 20.6;
            }
            else if($numeroCaracteres > 670 && $numeroCaracteres <= 700)
            {
                $tamanhoFonte = 20.4;
            }
            else if($numeroCaracteres > 700 && $numeroCaracteres <= 750)
            {
                $tamanhoFonte = 20.5;
            }
            else if($numeroCaracteres > 750 && $numeroCaracteres <= 780)
            {
                $tamanhoFonte = 20.1;
            }
            else if($numeroCaracteres > 780 && $numeroCaracteres <= 800)
            {
                $tamanhoFonte = 17.5;
            }
            else if($numeroCaracteres > 800 && $numeroCaracteres <= 850)
            {
                $tamanhoFonte = 19;
            }
            else if($numeroCaracteres > 850 && $numeroCaracteres <= 900)
            {
                $tamanhoFonte = 18.2;
            }
            else if($numeroCaracteres > 900 && $numeroCaracteres <= 915)
            {
                $tamanhoFonte = 18.3;
            }

            $html = <<<TAG

            
                    <!DOCTYPE html>
                    <html>
                    
                    <head>
                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    </head>
                    
                    <body>
                    
                        <!--Esta div contem todas as divs do certificado -->
                        <div id = 'container' style='position: absolute; left: 0; right: 0; top: 0; bottom: 0; z-index: 0;'>
                            
                            <!--Carregamento da marca d'agua no pdf-->
                             <img style=' position:fixed; width: 100% !important; height: 100% !important;  margin: 0 !important;' src='images/b2certificado.jpg'; />
                            
                            <!--Palavra 'Certificado'-->
                            <div style='position: fixed; width: 250px;  margin-top: -560px; z-index: 0; margin-left:43%; background-color:orange;'>
                            
                                <h1> <b> Certificado </b> </h1> 
                                
                            </div>
                            
                            <!--Resto dos dizeres do certificado-->
                            <div style ='width:1020px;  min-height:500px;  margin-top: 35px; margin-left:50px; margin-bottom:5px; font-size:$tamanhoFonte; text-align:justify;'>
                                $dizeres 
                            </div>
                            
                            <div style ='width: 970px; height: 120px; margin: 40px 0px 0px 60px;'>
                                <div style='text-align: center; margin-left: 100px; width:300px; height:100px; float: left;'>
                                   <img src='images/assinaturaLarissa.png' width='250' height='80'><br>
                                   <b>LARISSA MATTOS TREVIZANO</b><br>
                                  Diretora de Pesquisa e Pós-graduação
                            </div>
                            <div style='text-align: center;  margin-buttom: 10px ; margin-left: 160px; margin-right: 50px; width:300px; height:100px; float:left;'>
                               <img src='images/assinaturaFranciano.png' width='200' height='80'><br>
                                  <b>FRANCIANO BENEVENUTO CAETANO</b><br>
                                 Gerente de Pesquisa e Pós-graduação
                              </div>
                            </div>

                            
                            <!--Cidade e data de expedicao-->
                            <div style ='width: 800px; margin-top: 20px; margin-left:130px; font-size:21px; text-align:center;'>
                                Rio Pomba - MG, 24 de novembro de 2022
                            </div>
                            

                            
                           <!--Codigo de validacao 210 297 -->
                            <div style =' font-family: arial; font-size: 13px; width: 800px;  position: fixed; margin: 8px auto auto 120px; font-size:21px; text-align:center;'>
                                <font style='font-family: arial; font-size: 13px;'>
                                    C&oacute;digo de Valida&ccedil;&atilde;o: 
TAG
                . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "  
                                    <br>
                                    Autenticidade em: http://sistemas.riopomba.ifsudestemg.edu.br/simposio2022/simposio.php?arquivo2=form_validar_certificado.php
                                </font>
                                 
                                
                            </div>  
                            
                        </div>

                    </body>

                </html>
        ";
        }
        else //Se o usuario não apresentou poster, nem oralmente, imprima esse PDF
        {
            $tituloPoster  = iconv("UTF-8","ISO-8859-1",$campos[titulo]);
            $tituloPoster = iconv("ISO-8859-1","UTF-8",$tituloPoster);

            $dizeres = "  
            Certificamos que o trabalho intitulado <b>\"$campos[titulo]\"</b>, de autoria de $nomeAutor1 $nomeOrientador $nomeAutor2 $nomeAutor3 $nomeAutor4 $nomeAutor5 $nomeAutor6 $nomeAutor7 
            foi publicado nos Anais do  XIV Simpósio de Ciência, Inovação e Tecnologia do Campus Rio Pomba, realizado entre os dias 23 e 24 de novembro de 2022.";

            $numeroCaracteres = strlen($dizeres) + 100;

            $caracteresSobrando = ceil((strlen($dizeres) % 6));

            $dizeres = str_pad($dizeres, (2000 + $caracteresSobrando) , " ");


            if($numeroCaracteres >= 550 && $numeroCaracteres < 600)
            {
                $tamanhoFonte = 25;
            }
            else if($numeroCaracteres >= 600 && $numeroCaracteres < 620)
            {
                $tamanhoFonte = 23;
            }

            if($numeroCaracteres >= 620 && $numeroCaracteres < 650)
            {
                $tamanhoFonte = 22;
            }

            else if($numeroCaracteres > 650 && $numeroCaracteres <= 670)
            {
                $tamanhoFonte = 20.6;
            }
            else if($numeroCaracteres > 670 && $numeroCaracteres <= 700)
            {
                $tamanhoFonte = 20.4;
            }
            else if($numeroCaracteres > 700 && $numeroCaracteres <= 750)
            {
                $tamanhoFonte = 20.5;
            }
            else if($numeroCaracteres > 750 && $numeroCaracteres <= 780)
            {
                $tamanhoFonte = 20.1;
            }
            else if($numeroCaracteres > 780 && $numeroCaracteres <= 800)
            {
                $tamanhoFonte = 17.5;
            }
            else if($numeroCaracteres > 800 && $numeroCaracteres <= 850)
            {
                $tamanhoFonte = 19;
            }
            else if($numeroCaracteres > 850 && $numeroCaracteres <= 900)
            {
                $tamanhoFonte = 18.2;
            }
            else if($numeroCaracteres > 900 && $numeroCaracteres <= 915)
            {
                $tamanhoFonte = 18.3;
            }

            $html = <<<TAG

            
                    <!DOCTYPE html>
                    <html>
                    
                    <head>
                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    </head>
                    
                    <body>
                    
                        <!--Esta div contem todas as divs do certificado -->
                        <div id = 'container' style='position: absolute; left: 0; right: 0; top: 0; bottom: 0; z-index: 0;'>
                            
                            <!--Carregamento da marca d'agua no pdf-->
                             <img style=' position:fixed; width: 100% !important; height: 100% !important;  margin: 0 !important;' src='images/b2certificado.jpg'; />
                            
                            <!--Palavra 'Certificado'-->
                            <div style='position: fixed; width: 250px;  margin-top: -560px; z-index: 0; margin-left:43%; background-color:orange;'>
                            
                                <h1> <b> Certificado </b> </h1> 
                                
                            </div>
                            
                            <!--Resto dos dizeres do certificado-->
                            <div style ='width:1020px;  min-height:500px;  margin-top: 35px; margin-left:50px; margin-bottom:5px; font-size:$tamanhoFonte; text-align:justify;'>
                                $dizeres 
                            </div>
                            
                            <div style ='width: 970px; height: 120px; margin: 40px 0px 0px 60px;'>
                                <div style='text-align: center; margin-left: 100px; width:300px; height:100px; float: left;'>
                                   <img src='images/assinaturaLarissa.png' width='250' height='80'><br>
                                   <b>LARISSA MATTOS TREVIZANO</b><br>
                                  Diretora de Pesquisa e Pós-graduação
                            </div>
                            <div style='text-align: center;  margin-buttom: 10px ; margin-left: 160px; margin-right: 50px; width:300px; height:100px; float:left;'>
                               <img src='images/assinaturaFranciano.png' width='200' height='80'><br>
                                  <b>FRANCIANO BENEVENUTO CAETANO</b><br>
                                 Gerente de Pesquisa e Pós-graduação
                              </div>
                            </div>

                            
                            <!--Cidade e data de expedicao-->
                            <div style ='width: 800px; margin-top: 20px; margin-left:130px; font-size:21px; text-align:center;'>
                                Rio Pomba - MG, 24 de novembro de 2022
                            </div>
                            

                            
                           <!--Codigo de validacao 210 297 -->
                            <div style =' font-family: arial; font-size: 13px; width: 800px;  position: fixed; margin: 8px auto auto 120px; font-size:21px; text-align:center;'>
                                <font style='font-family: arial; font-size: 13px;'>
                                    C&oacute;digo de Valida&ccedil;&atilde;o: 
TAG
                . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "  
                                    <br>
                                    Autenticidade em: http://sistemas.riopomba.ifsudestemg.edu.br/simposio2022/simposio.php?arquivo2=form_validar_certificado.php
                                </font>
                                 
                                
                            </div>  
                            
                        </div>

                    </body>

                </html>
        ";
        }

        mysql_close($conexao);

        include("./MPDF56/mpdf.php");
        //$html = utf8_encode($html);
        $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15);
        $mpdf->SetDisplayMode('fullpage', 'single');
        $mpdf->writeHTML($html);
        $mpdf->Output('mpdf.pdf', 'I');

        exit;
        mysql_close($conexao);
    }
}

?>
