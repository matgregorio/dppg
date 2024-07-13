<?php
    session_start();
    include('includes/config.php');
    require_once('tcpdf/config/lang/eng.php');
    require_once('tcpdf/tcpdf.php');

    //Pega o codigo do trabalho passado pela url
    $codigo = mysql_real_escape_string($_GET[codigot]);

    /*Faz a segurança para que ninguém acesse outro trabalho*/

    $cpfLogado = $_SESSION[cpf];
    $querySeguranca = "SELECT autor1, autor2, autor3, autor4, autor5, autor6, autor7, cpf_prof_analisador  FROM trabalhos WHERE codigo_trab= $codigo";
    $resultadoQSeguranca = mysql_query($querySeguranca);

    while($trabalhosAcessiveis = mysql_fetch_array($resultadoQSeguranca))
    {
        if(in_array("1", $_SESSION[codigo_grupo]) || $cpfLogado == $trabalhosAcessiveis[autor1] || $cpfLogado == $trabalhosAcessiveis[autor2] || $cpfLogado == $trabalhosAcessiveis[autor3] || $cpfLogado == $trabalhosAcessiveis[autor4] || $cpfLogado == $trabalhosAcessiveis[autor5] || $cpfLogado == $trabalhosAcessiveis[autor6] || $cpfLogado == $trabalhosAcessiveis[autor7] || $cpfLogado == $trabalhosAcessiveis[cpf_prof_analisador])
        {
            $liberado = true;
            break;
        }
        else
        {
            $liberado = false;
        }

    }

    if(!$liberado)
    {
        echo "<br><br><br><br><br><br><br>";
        echo "<font size='30' color='red'> <center>Você não está autorizado(a) a ver este trabalho</center></font>";
        echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    }

    /*Fim da verificação de segurança*/

    function Autores($codigo_trab, $condicao)
    {

        //Dados do trabalho
        $campos = mysql_fetch_array(mysql_query("SELECT * FROM trabalhos WHERE codigo_trab='$codigo_trab'"));

        //Pega o CPF do professor que est� analisando o trabalho
        //$analizador = mysql_fetch_array(mysql_query("SELECT cpf, nome, email FROM participantes WHERE cpf='$campos[cpf_prof_analisador]'"));
        $analizador = mysql_fetch_array(mysql_query("SELECT * FROM participantes, tipo_participante tp  WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cpf= '$campos[cpf_prof_analisador]'"));

        //Dados do autor1
        //$autor1 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor1]'"));
        //$autor1 = mysql_fetch_array(mysql_query("SELECT * FROM participantes, tipo_participante, cursos, trabalhos WHERE participantes.cpf like '$campos[autor1]' AND participantes.codigo_tipo_participante = tipo_participante.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND trabalhos.autor1 = participantes.cpf"));
        $autor1 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor1]'"));

        if($campos[autor2] != '')
        {
            //$autor2 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor2]'"));
            $autor2 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor2]'"));
        }

        if($campos[autor3] != '')
        {
            //$autor3 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor3]'"));
            $autor3 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor3]'"));
        }
        if($campos[autor4] != '')
        {
            //$autor4 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor4]'"));
            $autor4 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor4]'"));
        }
        if($campos[autor5] != '')
        {
            //$autor5 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor5]'"));
            $autor5 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor5]'"));
        }
        if($campos[autor6] != '')
        {
            //$autor6 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor6]'"));
            $autor6 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor6]'"));
        }
        if($campos[autor7] != '')
        {
            //$autor7 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor7]'"));
            $autor7 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor7]'"));
        }
        if($condicao == '0') //Autores no inicio do documento
        {
            //Nome dos autores seguido do n�mero do autor EX.: autor�, autor2�
            $cont = 1;
            $texto1 = $autor1[nome]."<sup>$cont</sup>";
            $cont++;

            //Se o primeiro autor nao for o proprio orientador, inclua o orientador como segundo autor
            if($autor1[cpf] != $analizador[cpf])
            {
                $texto1 = $texto1.'; '.$analizador[nome]."<sup>$cont</sup>";
                $cont++;
            }
            if($autor2[nome] != '')
            {
                $texto1 = $texto1.'; '.$autor2[nome]."<sup>$cont</sup>";
                $cont++;
            }
            if($autor3[nome] != '')
            {
                $texto1 = $texto1.'; '.$autor3[nome]."<sup>$cont</sup>";
                $cont++;
            }
            if($autor4[nome] != '')
            {
                $texto1 = $texto1.'; '.$autor4[nome]."<sup>$cont</sup>";
                $cont++;
            }
            if($autor5[nome] != '')
            {
                $texto1 = $texto1.'; '.$autor5[nome]."<sup>$cont</sup>";
                $cont++;
            }
            if($autor6[nome] != '')
            {
                $texto1 = $texto1.'; '.$autor6[nome]."<sup>$cont</sup>";
                $cont++;
            }
            if($autor7[nome] != '')
            {
                $texto1 = $texto1.'; '.$autor7[nome]."<sup>$cont</sup>";
            }
        }
        //Autores no final do documento(rodape)
        else if($condicao == '1')
        {
            $cont = 1;

            //Se o primeiro autor nao for o proprio orientador
            if($autor1[cpf] != $analizador[cpf])
            {
                //Se o campo 'campus' nao estiver vazio e nao estiver preenchido com a palavra 'outros'
                if($autor1[campus] != "" && $autor1[campus] != "outros")
                {
                    //Escreve o autor1 depois escreve o analizados

                    //Ex.: Aluno - IFSudesteMG/Campus Rio Pomba - fulano@email.com
                    $texto1 = "<sup>$cont</sup>$autor1[tipo] "." - "."IFSudesteMG/Campus $autor1[campus]"." - ".$autor1[email]."<br>";
                    $cont++;

                    //Se o campo 'campus' nao estiver vazio e nao estiver preenchido com a palavra 'outros'
                    if($analizador[campus] != "" && $analizador[campus] != "outros")
                    {
                        //Docente - IFSudesteMG/Campus Rio Pomba- fulano@email.comr
                        $texto1 = $texto1."<sup>$cont</sup>"."Orientador"." - IFSudesteMG/Campus $analizador[campus] - ".$analizador[email]."<br>";
                    }
                    else
                    {
                        //Docente - IFSudesteMG - fulano@email.comr
                        $texto1 = $texto1."<sup>$cont</sup>"."Orientador"." - IFSudesteMG - ".$analizador[email]."<br>";
                    }
                }
                //Se o autor1 tiver o 'campus' vazio ou campus igual a 'outros'
                else
                {
                    //$texto1 = "<sup>$cont</sup>$autor1[tipo] do curso: " . $autor1[nome_curso] . "- IFSudesteMG/Campus Rio Pomba; " . $autor1[email] . "<br>";

                    //Ex.: Aluno - IFSudesteMG - fulano@email.com
                    $texto1 = "<sup>$cont</sup>$autor1[tipo] "." - "."IFSudesteMG"." - ".$autor1[email]."<br>";
                    $cont++;

                    //Se o campo 'campus' nao estiver vazio e nao estiver preenchido com a palavra 'outros'
                    if($analizador[campus] != "" && $analizador[campus] != 'outros')
                    {
                        //Docente - IFSudesteMG/Campus Rio Pomba- fulano@email.comr
                        $texto1 = $texto1."<sup>$cont</sup>".$analizador[tipo]." - IFSudesteMG/Campus $analizador[campus] - ".$analizador[email]."<br>";
                    }
                    else
                    {
                        //Docente - IFSudesteMG - fulano@email.comr
                        $texto1 = $texto1."<sup>$cont</sup>".$analizador[tipo]." - IFSudesteMG - ".$analizador[email]."<br>";
                    }
                }
            }
            //Se o autor1 for o proprio analisador
            else
            {
                //$texto1 = $texto1 . "<sup>$cont</sup>$autor2[tipo] " . " - " . $autor2[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor2[email] . "<br>";

                if($analizador[campus] != "" && $analizador[campus] != "outros")
                {
                    //Ex.: Aluno - IFSudesteMG/Campus Rio Pomba - fulano@email.com
                    $texto1 = "<sup>$cont</sup>$analizador[tipo] "." - "."IFSudesteMG/Campus $analizador[campus]"." - ".$analisador[email]."<br>";
                }
                else
                {
                    $texto1 = "<sup>$cont</sup>$analizador[tipo] "." - "."IFSudesteMG "." - ".$analizador[email]."<br>";
                }

                $cont++;
            }

            //$texto1 = $texto1 . "<sup>$cont</sup>Professor Orientador - IFSudesteMG/Campus Rio Pomba; " . $analizador[email] . "<br>"
            if($autor2[nome] != '')
            {
                //$texto1 = $texto1 . "<sup>$cont</sup>$autor2[tipo] do curso: " . $autor2[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor2[email] . "<br>";

                if($autor2[campus] != "" && $autor2[campus] != "outros")
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor2[tipo]"." - IFSudesteMG/Campus $autor2[campus] - ".$autor2[email]."<br>";
                }
                else
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor2[tipo]"." - IFSudesteMG - ".$autor2[email]."<br>";
                }

                $cont++;

            }
            if($autor3[nome] != '')
            {
                //$texto1 = $texto1 . "<sup>$cont</sup>$autor3[tipo] do curso: " . $autor3[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor3[email] . "<br>";

                if($autor3[campus] != "" && $autor3[campus] != "outros")
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor3[tipo]"." - IFSudesteMG/Campus $autor3[campus] - ".$autor3[email]."<br>";
                }
                else
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor3[tipo]"." - IFSudesteMG - ".$autor3[email]."<br>";
                }

                $cont++;
            }
            if($autor4[nome] != '')
            {
                //$texto1 = $texto1 . "<sup>$cont</sup>$autor4[tipo] do curso: " . $autor4[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor4[email] . "<br>";

                if($autor4[campus] != "" && $autor4[campus] != "outros")
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor4[tipo]"." - IFSudesteMG/Campus $autor4[campus] - ".$autor4[email]."<br>";
                }
                else
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor4[tipo]"." - IFSudesteMG - ".$autor4[email]."<br>";
                }

                $cont++;

            }
            if($autor5[nome] != '')
            {
                //$texto1 = $texto1 . "<sup>$cont</sup>$autor5[tipo] do curso: " . $autor5[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor5[email] . "<br>";

                if($autor5[campus] != "" && $autor5[campus] != "outros")
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor5[tipo]"." - IFSudesteMG/Campus $autor5[campus] - ".$autor5[email]."<br>";
                }
                else
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor5[tipo]"." - IFSudesteMG - ".$autor5[email]."<br>";
                }

                $cont++;
            }
            if($autor6[nome] != '')
            {
                //  $texto1 = $texto1 . "<sup>$cont</sup>$autor6[tipo] do curso: " . $autor6[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor6[email] . "<br>";

                if($autor6[campus] != "" && $autor6[campus] != "outros")
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor6[tipo]"." - IFSudesteMG/Campus $autor6[campus] - ".$autor6[email]."<br>";
                }
                else
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor6[tipo]"." - IFSudesteMG - ".$autor6[email]."<br>";
                }

                $cont++;
            }
            if($autor7[nome] != '')
            {
                //$texto1 = $texto1 . "<sup>$cont</sup>$autor7[tipo] do curso: " . $autor7[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor7[email];

                if($autor7[campus] != "" && $autor7[campus] != "outros")
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor7[tipo]"." - IFSudesteMG/Campus $autor7[campus] - ".$autor7[email]."<br>";
                }
                else
                {
                    $texto1 = $texto1."<sup>$cont</sup>$autor7[tipo]"." - IFSudesteMG - ".$autor7[email]."<br>";
                }
            }
        }
        $autor1[nome] = "";
        $autor2[nome] = "";
        $autor3[nome] = "";
        $autor4[nome] = "";
        $autor5[nome] = "";
        $autor6[nome] = "";
        $autor7[nome] = "";

        return $texto1;
    }

    $campos_trabalho = mysql_fetch_array(mysql_query("SELECT codigo_trab, titulo, resumo, palavra_chave FROM trabalhos WHERE codigo_trab='$codigo'"));
    $result_apoios = mysql_query("SELECT apoio.nome FROM apoio, apoio_trabalho WHERE apoio.codigo_apoio=apoio_trabalho.codigo_apoio AND apoio_trabalho.codigo_trabalho='$codigo'");
    $cont = 0;
    while($campos_apoio = mysql_fetch_array($result_apoios))
    {
        if($cont == 0)
        {
            $apoios = $campos_apoio[nome];
            $cont++;
        }
        else
        {
            $apoios = "$apoios - $campos_apoio[nome]";
        }
    }

    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF
    {

        //Page header
        public function Header()
        {
            $codigo = mysql_real_escape_string($_GET[codigot]);

            //Edi��o do simp�sio (em n�meros romanos)
            $resultado_edicao = mysql_query("select informacoes from conteudo where codigo_conteudo = '10'");
            $campos_edicao = mysql_fetch_array($resultado_edicao);

            //Data do simp�sio de xx/xx/xxxx at� xx/xx/xxxx
            $resultado_edicao1 = mysql_query("select informacoes from conteudo where codigo_conteudo = '11'");
            $campos_edicao1 = mysql_fetch_array($resultado_edicao1);

            /*
               (Tabela modalidade: 1-Inicia��o Cient�fica e Tecnol�gica; 3-Estudos Orientados)
               Pega o tipo de inicia��o e a modalodade
            */
            $resultado_trabalho = mysql_query("SELECT modalidade, tipo_iniciacao FROM trabalhos WHERE codigo_trab='$codigo'");
            $campos_trabalho = mysql_fetch_array($resultado_trabalho);

            if($campos_trabalho[modalidade] == "N")
            {
                $modalidade = "Estudos Orientados";
            }
            else
            {
                if($campos_trabalho[tipo_iniciacao] == "G")
                {
                    $modalidade = "Iniciação Científica/Graduação";
                }
                else if($campos_trabalho[tipo_trabalho] == "M")
                {
                    $modalidade = "Iniciação Científica/Mestrado";
                }
                else
                {
                    $modalidade = "Iniciação Científica/Técnico";
                }
            }
            // Logo

            $image_file = "images/logoAnais2016.png";
            $this->Image($image_file, 8, 5, 50, 25, 'PNG', '', 'T', true, 250, '', false, false, 0, false, false, false);

            //SetFont ($family, $style=�, $size=null, $fontfile=�, $subset='default', $out=true).
            $this->SetFont('times', 'R', 9);

            $header = <<<EOD
    <div style = "margin:0% 25%  97% 50%;">
            <font align="center">
                <br>
                $campos_edicao[informacoes]  Simpósio de Ciência, 
                <br> 
                Inovação & Tecnologia – IF Sudeste MG - Campus Rio Pomba
                <br>
                Inteligência Artificial: A Nova Fronteira da Ciência Brasileira
                <br>
                $campos_edicao1[informacoes]. 
                <br>
                ISSN:2447-3375
                <br>
            </font>
        </div>
EOD;

            //$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '9', $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

            $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '4', $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

            $header = '';

            $image_file = "images/logo_simposio.png";
            //Image($file, $x='', $y='', $width=0, $height=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
            $this->Image($image_file, 160, 5, 40, 28, 'PNG', '', 'T', true, 250, '', false, false, 0, false, false, false);
        }

        // Page footer
        public function Footer()
        {
            $codigo = mysql_real_escape_string($_GET[codigot]);
            // Position at 15 mm from bottom
            //$this->SetY(-15);
            // Set font
            $this->SetFont('times', 'R', 9);

            //pega os dados formatados
            $rodape = Autores($codigo, 1);

            // Page number
            $this->writeHTMLCell($w = 0, $h = 0, $x = 15, $y = -40, $rodape, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '');
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    //set auto page breaks
    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

    //set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //set some language-dependent strings
    $pdf->setLanguageArray($l);

    // ---------------------------------------------------------
    // Add a page
    $pdf->AddPage();

    // set text shadow effect
    //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
    //if ($campos_trabalho[codigo_trab] == 72 || $campos_trabalho[codigo_trab] == 89 || $campos_trabalho[codigo_trab] == 107) {
    if(1 == 1)
    {
        $titulo = $campos_trabalho[titulo];
    }
    else
    {
        $titulo = strtr(strtoupper($campos_trabalho[titulo]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß");
    }

    $arq_name = $titulo;
    $autores = Autores($codigo, 0);
    $autores = strtr(strtoupper($autores), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß");
    // Set some content to print
    $html = <<<EOD
<font align="center" size="11"><b>$titulo</b></font>
EOD;
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '35', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

    $html = <<<EOD
<font align="justfy" size="8"><b>$autores</b></font>
EOD;
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '50', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

    //o tamanho da font é forçada no momento em que o pdf é gerado
    $resumo = htmlspecialchars_decode($campos_trabalho[resumo], ENT_QUOTES); //decodifica o texto
    //$resumo = str_replace("<p>", "", $resumo);
    //$resumo = str_replace("</p>", "", $resumo);
    //$resumo = "<p>$resumo</p>";
    $html = <<<EOD
<font align="justfy" size="10">$resumo</font><br><br><br>

EOD;
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '60', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

    $html = <<<EOD
    <font align="left"><b>PALAVRAS CHAVE:</b> $campos_trabalho[palavra_chave]</font><br><br>
    <font align="left" size"10"><b>Apoio(s):</font>
    <br>$apoios
    <br><br>
EOD;
    $pdf->writeHTMLCell($w = '0', $h = '0', $x = '15', $y = '227', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

    $pdf->Output("$titulo.pdf", 'I');

    mysql_close($conexao);
?>
