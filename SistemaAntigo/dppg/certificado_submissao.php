<?php
    session_start();
    header("Content-Type: text/html; charset=utf-8", true);
    include_once ('trataInjection.php');

    if (protectorString($_GET['codigo']))
        return;

    /* É Preciso mudar o conteúdo do texto, pois não está dinâmico */

    if ($_SESSION[logado_simposio_2018]) {
        include("includes/config.php");
        include("funcao.php");

        $poster = false;
        //  require_once('fpdf16/fpdf.php');
        //  require_once('rotation.php');
        //  define('FPDF_FONTPATH', 'fpdf16/font/');

        $codigo_trab = mysql_real_escape_string($_GET[codigo]);

        $tipo = "submissao";

        //$sql = "select * from trabalhos t, participantes p where p.cpf = t.cpf and t.aprovado ='1' and 	t.presenca = 'S' and p.cpf ='$_SESSION[cpf]' and codigo_trab=$codigo_trab";
        $sql = "select * from trabalhos t where t.aprovado ='1' and t.presenca = 'S' and codigo_trab=$codigo_trab";
        $resultado = mysql_query($sql);
        $campos = mysql_fetch_array($resultado);

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

        //  $pdf = new PDF_Rotate("L", "mm", "A4");
        //  $pdf->SetTitle("Certificado");
        //  $pdf->SetSubject("Certificado de participação");
        //  $pdf->SetY("-1");
        //  $pdf->Cell(0, 190, '', 1, 1, 'L', false);
        //  $pdf->SetFont("arial", "", 36);
        //  $pdf->Image("images/" . $campos_topo[topo], 40, 18);
        //  $certificado = "CERTIFICADO";
        //  $pdf->Text(110, 70, $certificado);

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
        if ($campos[codigo_trab] == 4 || $campos[codigo_trab] == 5 || $campos[codigo_trab] == 19 || $campos[codigo_trab] == 33 ||
            $campos[codigo_trab] == 35 ||$campos[codigo_trab] == 47 || $campos[codigo_trab] == 59 || $campos[codigo_trab] == 66 ||
            $campos[codigo_trab] == 79 || $campos[codigo_trab] == 81 || $campos[codigo_trab] == 85 || $campos[codigo_trab] == 95 ||
            $campos[codigo_trab] == 109 ||$campos[codigo_trab] == 116 || $campos[codigo_trab] == 118 || $campos[codigo_trab] == 140 ||
            $campos[codigo_trab] == 146 || $campos[codigo_trab] == 162 || $campos[codigo_trab] == 191 || $campos[codigo_trab] == 204)
        {
            $poster = false;

            //        if ($_SESSION[cpf] == $cpf_apresentador)
            //        {
            //          //$texto = iconv('utf-8', 'iso-8859-1', 'apresentou o trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma oral,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba realizado no período de ' . $campos_periodo[informacoes] . '.');
            //          $texto3 = 'apresentou o trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma oral,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba.';
            //        }
            //        else
            //        {
            //          //$texto = iconv('utf-8', 'iso-8859-1', 'foi coautor do trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma oral,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba realizado no período de ' . $campos_periodo[informacoes] . '.');
            //          $texto3 = 'foi coautor do trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma oral,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba.';
            //        }
        }
        else
        {
            $poster = true;
            //        if ($_SESSION[cpf] == $cpf_apresentador)
            //        {
            //    //      $texto = iconv('utf-8', 'iso-8859-1', 'apresentou o trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma de pôster,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba realizado no período de ' . $campos_periodo[informacoes] . '.');
            //          $texto3 = 'apresentou o trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma de pôster,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba.';
            //        }
            //        else
            //        {
            //    //      $texto = iconv('utf-8', 'iso-8859-1', 'foi coautor do trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma de pôster,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba realizado no período de ' . $campos_periodo[informacoes] . '.');
            //          $texto3 = 'foi coautor do trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma de pôster,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba.';
            //        }
        }
        //  $pdf->SetY("83");
        //  $pdf->SetX("45");
        //  $pdf->MultiCell(220, 8, $texto, 'J');
        //
        //  $pdf->SetFont('arial', 'B', 12);
        //  $pdf->SetY("183");
        //  $pdf->SetX("45");
        //
        //  $assinatura1 = (iconv('utf-8', 'iso-8859-1', $campos_assinatura1[assinatura]));
        //  $pdf->Image("images/" . $campos_assinatura1[imagem_assinatura], 45, 164);
        //  $pdf->MultiCell(100, 2, $assinatura1, 'J');
        //
        //  $pdf->SetFont('arial', 'B', 12);
        //  $pdf->SetY("183");
        //  $pdf->SetX("180");
        //
        //  $assinatura2 = (iconv('utf-8', 'iso-8859-1', $campos_assinatura2[assinatura]));
        //  $pdf->Image("images/" . $campos_assinatura2[imagem_assinatura], 180, 164);
        //  $pdf->MultiCell(150, 2, $assinatura2, 'J');
        //
        //  $pdf->SetFont('arial', '', 12);
        //  $pdf->SetY("187");
        //  $pdf->SetX("45");
        //  $cargo1 = (iconv('utf-8', 'iso-8859-1', $campos_assinatura1[cargo]));
        //  $pdf->MultiCell(120, 2, $cargo1, 0, 'L');
        //
        //  $pdf->SetFont('arial', '', 12);
        //  $pdf->SetY("187");
        //  $pdf->SetX("180");
        //  $cargo2 = (iconv('utf-8', 'iso-8859-1', $campos_assinatura2[cargo]));
        //  $pdf->MultiCell(120, 2, $cargo2, 0, 'L');
        //
        include './valida_certificado.php';
        //  $pdf->SetFont('arial', '', 12);
        //  $pdf->SetY("70");
        //  $pdf->SetX("200");
        //  $a = str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT);
        //  $cargo2 = (iconv('utf-8', 'iso-8859-1', "Codigo de Validação: $a"));
        //  $pdf->MultiCell(120, 1, $cargo2, 0, 'L');
        //
        //
        //  $pdf->Output("arquivo", "I");

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
        if(!$poster)
        {
            $dizeres = "  
            Certificamos que o trabalho intitulado <b>\"$campos[titulo]\"</b>, de autoria de $nomeAutor1 $nomeOrientador $nomeAutor2 $nomeAutor3 $nomeAutor4 $nomeAutor5 $nomeAutor6 $nomeAutor7 
            foi apresentado oralmente por $apresentador[nome] no X Simp&oacute;sio de Ci&ecirc;ncia, 
            Inova&ccedil;&atilde;o e Tecnologia do Campus Rio Pomba, realizado entre os dias 16 e 17 de outubro de 2018.";

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
                            <div style='position: fixed; width: 250px;  margin-top: -600px; z-index: 0; margin-left:43%; background-color:orange;'>
                            
                                <h1> <b> Certificado </b> </h1> 
                                
                            </div>
                            
                            <!--Resto dos dizeres do certificado-->
                            <div style ='width:1020px;  min-height:500px;  margin-top: 35px; margin-left:50px; margin-bottom:5px; font-size:$tamanhoFonte; text-align:justify;'>
                                $dizeres 
                            </div>
                            
                            <div style ='width: 970px; height: 120px; margin: 40px 0px 0px 60px;'>
                                <div style='text-align: center; margin-left: 100px; width:300px; height:100px; float: left;'>
                                   <img src='images/assinaturaRafael.png' width='250' height='80'><br>
                                   <b>RAFAEL MONTEIRO ARAÚJO TEIXEIRA</b><br>
                                   Diretor de Pesquisa e Pós-graduação
                            </div>
                            <div style='text-align: center;  margin-buttom: 10px ; margin-left: 160px; margin-right: 50px; width:300px; height:100px; float:left;'>
                               <img src='images/assinaturaWellingta.png' width='200' height='80'><br>
                                  <b>WELLINGTA CRISTINA ALMEIDA DO N BENEVENUTO</b><br>
                                  Gerente de Pesquisa e Pos-graduação
                              </div>
                            </div>

                            
                            <!--Cidade e data de expedicao-->
                            <div style ='width: 800px; margin-top: 20px; margin-left:130px; font-size:21px; text-align:center;'>
                                Rio Pomba - MG, 18 de outubro de 2018
                            </div>
                            

                            
                           <!--Codigo de validacao 210 297 -->
                            <div style =' font-family: arial; font-size: 13px; width: 800px;  position: fixed; margin: 8px auto auto 120px; font-size:21px; text-align:center;'>
                                <font style='font-family: arial; font-size: 13px;'>
                                    C&oacute;digo de Valida&ccedil;&atilde;o: 
TAG
                . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "  
                                    <br>
                                    Autenticidade em: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2018/simposio.php?arquivo2=form_validar_certificado.php
                                </font>
                                
                                
                            </div>  
                            
                        </div>

                    </body>

                </html>
        
            ";
        }
        else //Se a apresentacao for poster, imprima no PDF este html
        {
            //No trabalho 129 o ultimo autor nao sai

            $tituloPoster  = iconv("UTF-8","ISO-8859-1",$campos[titulo]);
            $tituloPoster = iconv("ISO-8859-1","UTF-8",$tituloPoster);

            $dizeres = "  
        Certificamos que o trabalho intitulado <b>\"$campos[titulo]\"</b>, de autoria de $nomeAutor1 $nomeOrientador $nomeAutor2 $nomeAutor3 $nomeAutor4 $nomeAutor5 $nomeAutor6 $nomeAutor7 
        foi apresentado na forma de p&ocirc;ster por $apresentador[nome] no X Simp&oacute;sio de Ci&ecirc;ncia,
        Inova&ccedil;&atilde;o e Tecnologia do Campus Rio Pomba, realizado entre os dias 16 e 17 de outubro de 2018.
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

            //Casos particulares :)
            if($codigo_trab == 72)
            {
                $tamanhoFonte = 18.2;
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
                            <div style='position: fixed; width: 250px;  margin-top: -600px; z-index: 0; margin-left:43%; background-color:orange;'>
                            
                                <h1> <b> Certificado </b> </h1> 
                                
                            </div>
                            
                            <!--Resto dos dizeres do certificado-->
                            <div style ='width:1020px;  min-height:500px;  margin-top: 35px; margin-left:50px; margin-bottom:5px; font-size:$tamanhoFonte; text-align:justify;'>
                                $dizeres 
                            </div>
                            
                            <div style ='width: 970px; height: 120px; margin: 40px 0px 0px 60px;'>
                                <div style='text-align: center; margin-left: 100px; width:300px; height:100px; float: left;'>
                                   <img src='images/assinaturaRafael.png' width='250' height='80'><br>
                                   <b>RAFAEL MONTEIRO ARAÚJO TEIXEIRA</b><br>
                                  Diretor de Pesquisa e Pós-graduação
                            </div>
                            <div style='text-align: center;  margin-buttom: 10px ; margin-left: 160px; margin-right: 50px; width:300px; height:100px; float:left;'>
                               <img src='images/assinaturaWellingta.png' width='200' height='80'><br>
                                  <b>WELLINGTA CRISTINA ALMEIDA DO N BENEVENUTO</b><br>
                                 Gerente de Pesquisa e Pós-graduação
                              </div>
                            </div>

                            
                            <!--Cidade e data de expedicao-->
                            <div style ='width: 800px; margin-top: 20px; margin-left:130px; font-size:21px; text-align:center;'>
                                Rio Pomba - MG, 18 de outubro de 2018
                            </div>
                            

                            
                           <!--Codigo de validacao 210 297 -->
                            <div style =' font-family: arial; font-size: 13px; width: 800px;  position: fixed; margin: 8px auto auto 120px; font-size:21px; text-align:center;'>
                                <font style='font-family: arial; font-size: 13px;'>
                                    C&oacute;digo de Valida&ccedil;&atilde;o: 
TAG
                . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "  
                                    <br>
                                    Autenticidade em: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2018/simposio.php?arquivo2=form_validar_certificado.php
                                </font>
                                
                                
                            </div>  
                            
                        </div>

                    </body>

                </html>
        ";
        }
        //  $html = "
        //    <div style='border:1 solid; vertical-align: central; width:1300px; height:1300px;'>
        //      <table border=0 style='width:1300px; height:1100px; text-justify: auto'>
        //        <tr><td align=center>&nbsp;</br></td></tr>
        //        <tr><td align=center><img src='images/$campos_topo[topo]' width='800' height='150'></td></tr>
        //        <tr><td align=center><font style='font-family: arial; font-size: 50' >CERTIFICADO</font></td></tr>
        //      </table>
        //      <div style='border:0 solid; margin: 0 auto; width:900px; height:300px;'>
        //        <table border=0 style='width:1300px; height:1100px; text-justify: auto'>
        //          <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 28' >Certificamos que <b>" . strtr(strtoupper($texto), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b></font></td></tr>
        //          <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 22' >$texto3</font></td></tr>
        //        </table>
        //      </div>
        //      <div>
        //        <div style='text-align: center; border:0 solid; margin-buttom: 10px ; margin-left: 100px; width:300px; height:100px; float: left;'>
        //          <img src='images/$campos_assinatura1[imagem_assinatura]' width='250' height='80'><br>
        //          <b>" . strtr(strtoupper($campos_assinatura1[assinatura]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
        //          $campos_assinatura1[cargo]
        //        </div>
        //        <div style='text-align: center; border:0 solid; margin-buttom: 10px ; margin-left: 243px; margin-right: 50px; width:300px; height:100px; float:left;'>
        //          <img src='images/$campos_assinatura2[imagem_assinatura]' width='200' height='80'><br>
        //          <b>" . strtr(strtoupper($campos_assinatura2[assinatura]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
        //          $campos_assinatura2[cargo]
        //        </div>
        //      </div>
        //      <div style='text-align:center; border:0 solid; margin:0 auto; width:700px;'>
        //        <font style='font-family: arial; font-size: 12' >Código de Validação: " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "<br> Verifique a autenticidade deste documento na página: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2015/simposio.php?arquivo2=form_validar_certificado.php</font>
        //      </div>
        //    </div>
        //";
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
    else
    {
        echo "
         <hr><h1><center>Certificados </center></h1><hr> 
         <br> 
         <h2> <center> Caro participante, seu certificado ser&aacute; gerado em breve.</center> </h2>
         <br> 
         <h2> <center>Equipe DPPG Rio Pomba</center> </h2>";
    }
?>
