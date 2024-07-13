<?php

session_start();
header("Content-Type: text/html; charset=utf-8", true);

/* ? Preciso mudar o conte?do do texto, pois n?o est? din?mico */
//    require_once('fpdf16/fpdf.php');
//    require_once('rotation.php');
//    define('FPDF_FONTPATH', 'fpdf16/font/');
//
//    $sql_texto_edicao = "SELECT informacoes FROM conteudo WHERE codigo_conteudo = '10'";
//    $resultado_edicao = mysql_query($sql_texto_edicao);
//    $campos_edicao = mysql_fetch_array($resultado_edicao);
//
//    $sql_texto_periodo = "SELECT informacoes FROM conteudo WHERE codigo_conteudo = '11'";
//    $resultado_periodo = mysql_query($sql_texto_periodo);
//    $campos_periodo = mysql_fetch_array($resultado_periodo);
//
//    $sql = "SELECT p.nome FROM participantes p WHERE p.cpf='$_SESSION[cpf]'";
//    $resultado = mysql_query($sql);
//
//    $pdf = new PDF_Rotate("L", "mm", "A4");
//    $pdf->SetTitle("Certificado");
//    $pdf->SetSubject("Certificado de Avalia??o");
//    $pdf->SetY("-1");
//    $pdf->Cell(0, 190, '', 1, 1, 'L', false);
//    $pdf->SetFont("arial", "", 36);
//
//    $sql_topo = "SELECT topo FROM conteudo WHERE codigo_conteudo = '7'";
//    $resultado_topo = mysql_query($sql_topo);
//    $campos_topo = mysql_fetch_array($resultado_topo);
//
//    $pdf->Image("images/" . $campos_topo[topo], 40, 18);
//
//    $certificado = "CERTIFICADO";
//    $pdf->Text(110, 75, $certificado);
//
//    $pdf->SetFont('arial', '', 20);
//    $texto = iconv('utf-8', 'iso-8859-1', "Certificamos que ");
//    $pdf->SetY("80");
//    $pdf->SetX("45");
//    $pdf->MultiCell(220, 8, $texto, 'J');
//
//    $campos = mysql_fetch_array($result_ava);
//    $pdf->SetFont('arial', 'B', 20);
//    $nome = (iconv('utf-8', 'iso-8859-1', $campos[nome]));
//    $pdf->SetY("80");
//    $pdf->SetX("110");
//    $pdf->MultiCell(210, 8, $nome, 'J');
//
//    $pdf->SetFont('arial', '', 20);
//    $pdf->SetY("90");
//    $pdf->SetX("45");
//
//    $texto = (iconv('utf-8', 'iso-8859-1', "atuou como parecerista de trabalhos submetidos para publica??o no $campos_edicao[informacoes] Simp?sio de Ci?ncia, Inova??o & Tecnologia - IF Sudeste MG - Campus Rio Pomba realizado nos dias $campos_periodo[informacoes]."));
//    $pdf->MultiCell(220, 10, $texto, '', 'J');
//
//    $pdf->SetFont('arial', 'B', 12);
//    $pdf->SetY("160");
//    $pdf->SetX("45");
//
//    $sql_assinatura1 = "select assinatura, cargo, imagem_assinatura from conteudo where codigo_conteudo = '8'";
//    $resultado_assinatura1 = mysql_query($sql_assinatura1);
//    $campos_assinatura1 = mysql_fetch_array($resultado_assinatura1);
//
//    $assinatura1 = (iconv('utf-8', 'iso-8859-1', $campos_assinatura1[assinatura]));
//    $pdf->Image("images/" . $campos_assinatura1[imagem_assinatura], 45, 145);
//    $pdf->MultiCell(100, 10, $assinatura1, 'J');
//
//    $sql_assinatura2 = "select assinatura, cargo, imagem_assinatura from conteudo where codigo_conteudo = '9'";
//    $resultado_assinatura2 = mysql_query($sql_assinatura2);
//    $campos_assinatura2 = mysql_fetch_array($resultado_assinatura2);
//
//    $pdf->SetFont('arial', 'B', 12);
//    $pdf->SetY("160");
//    $pdf->SetX("180");
//
//    $assinatura2 = (iconv('utf-8', 'iso-8859-1', $campos_assinatura2[assinatura]));
//    $pdf->Image("images/" . $campos_assinatura2[imagem_assinatura], 180, 145);
//    $pdf->MultiCell(150, 10, $assinatura2, 'J');
//
//    $pdf->SetFont('arial', '', 12);
//    $pdf->SetY("168");
//    $pdf->SetX("45");
//    $cargo1 = (iconv('utf-8', 'iso-8859-1', $campos_assinatura1[cargo]));
//    $pdf->MultiCell(120, 5, $cargo1, 0, 'L');
//
//    $pdf->SetFont('arial', '', 12);
//    $pdf->SetY("168");
//    $pdf->SetX("180");
//    $cargo2 = (iconv('utf-8', 'iso-8859-1', $campos_assinatura2[cargo]));
//    $pdf->MultiCell(120, 5, $cargo2, 0, 'L');
//
//    include './valida_certificado.php';
//    $pdf->SetFont('arial', '', 12);
//    $pdf->SetY("70");
//    $pdf->SetX("200");
//    $a = str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT);
//    $cargo2 = (iconv('utf-8', 'iso-8859-1', "Codigo de Valida??o: $a"));
//    $pdf->MultiCell(120, 1, $cargo2, 0, 'L');
//
//    $pdf->Output("arquivo", "I");
//  mysql_close($conexao);
//}
/*
  Na linha 165 era usado este c�digo, puxando as assinaturas do banco de dados. Em 2016 foi mudado, e as assinaturas
  es�o sendo inclu�das por div's html. Se for usar este c�digo, observar o banco, na tabela conte�do
 * 
 * 
 * <div>
  <div style='text-align: center; border:0 solid; margin-buttom: 30px ; margin-left: 100px; width:300px; height:100px; float: left;'>
  <img src='images/$campos_assinatura1[imagem_assinatura]' width='250' height='80'><br>
  <b>$campos_assinatura1[assinatura]</b><br>
  $campos_assinatura1[cargo]
  </div>

  <div style='text-align: center; border:0 solid; margin-buttom: 30px ; margin-left: 243px; margin-right: 50px; width:300px; height:100px; float:left;'>
  <img src='images/$campos_assinatura2[imagem_assinatura]' width='200' height='80'><br>
  <b>$campos_assinatura2[assinatura]</b><br>
  $campos_assinatura2[cargo]
  </div> */

if ($_SESSION[logado_simposio_2021])
{

    include("includes/config.php");
    include("funcao.php");
    include("acentuacao.php");

    $tipo = "avaliador";

    $sql_ava = "SELECT p.nome FROM participantes p, avaliador_trab at WHERE p.cpf=at.cpf AND at.cpf='$_SESSION[cpf]' AND avaliado='1'";
    $result_ava = mysql_query($sql_ava);
    $camposAvaliador = mysql_fetch_array($result_ava);
    $n = mysql_num_rows($result_ava);

    $sql_data = "select data_inicio from formularios where codigo_formulario = '7'";
    $resultado_data = mysql_query($sql_data);
    $campos_data = mysql_fetch_array($resultado_data);

    $data_inicio = datadobanco($campos_data[data_inicio]);
    $data_fim = datadobanco($campos_data[data_fim]);

    $data = $data_inicio;

    $data_i = datasemcaracter($data_inicio);


    if ((date("Ymd") >= $data_i))
    {
        if ($n > 0)
        {
            include("includes/config.php");

            $tipo = "avaliador";

            $sql_ava = "SELECT p.nome FROM participantes p, avaliador_trab at WHERE p.cpf=at.cpf AND at.cpf='$_SESSION[cpf]' AND avaliado='1'";
            $result_ava = mysql_query($sql_ava);
            $n = mysql_num_rows($result_ava);
            $campos = mysql_fetch_array($result_ava);

            $sql_texto_edicao = "SELECT informacoes FROM conteudo WHERE codigo_conteudo = '10'";
            $resultado_edicao = mysql_query($sql_texto_edicao);
            $campos_edicao = mysql_fetch_array($resultado_edicao);

            $sql_texto_periodo = "SELECT informacoes FROM conteudo WHERE codigo_conteudo = '11'";
            $resultado_periodo = mysql_query($sql_texto_periodo);
            $campos_periodo = mysql_fetch_array($resultado_periodo);

            $sql = "SELECT p.nome FROM participantes p WHERE p.cpf='$_SESSION[cpf]'";
            $resultado = mysql_query($sql);

//            $sql_topo = "SELECT topo FROM conteudo WHERE codigo_conteudo = '7'";
//            $resultado_topo = mysql_query($sql_topo);
//            $campos_topo = mysql_fetch_array($resultado_topo);
//
//            $sql_assinatura1 = "select assinatura, cargo, imagem_assinatura from conteudo where codigo_conteudo = '8'";
//            $resultado_assinatura1 = mysql_query($sql_assinatura1);
//            $campos_assinatura1 = mysql_fetch_array($resultado_assinatura1);
//
//            $sql_assinatura2 = "select assinatura, cargo, imagem_assinatura from conteudo where codigo_conteudo = '9'";
//            $resultado_assinatura2 = mysql_query($sql_assinatura2);
//            $campos_assinatura2 = mysql_fetch_array($resultado_assinatura2);

            include './valida_certificado.php';

//            $html = "
//      <div style='border:1 solid; vertical-align: central; width:1300px; height:1100px;'>
//        <table border=0 style='width:1300px; height:1100px; text-justify: auto'>
//          <tr><td align=center>&nbsp;</br></td></tr>
//          <tr><td align=center><img src='images/$campos_topo[topo]' width='800' height='150'></td></tr>
//          <tr><td align=center><font style='font-family: arial; font-size: 50' >CERTIFICADO</font></td></tr>
//        </table>
//        <div style='border:0 solid; margin: 0 auto; width:900px; height:300px;'>
//          <table border=0 style='width:1300px; height:1100px; text-justify: auto'>
//            <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 28' >Certificamos que <b>" . strtr(strtoupper($campos[nome]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b></font></td></tr>
//            <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 22' >atuou como parecerista de trabalhos submetidos para publica��o no $campos_edicao[informacoes] Simp�sio de Ci�ncia, Inova��o & Tecnologia - IF Sudeste MG - Campus Rio Pomba.</font></td></tr>
//          </table>
//        </div>
//        
//
//        <div>          
//            <div style='text-align: center; border:0 solid; margin-buttom: 30px ; margin-left: 30px; width:300px; height:100px; float: left;'>
//              <img src='images/ensino.png' width='250' height='80'><br>
//              <b>Maria Elizabeth Rodrigues</b><br>
//              Pr�-Reitora de Ensino
//            </div>
//            
//            <div style='text-align: center; border:0 solid; margin-buttom: 30px ; margin-left: 50px; width:300px; height:100px; float: left;'>
//              <img src='images/extensao.png' width='250' height='80'><br>
//              <b>Jos� Roberto Ribeiro Lima</b><br>
//              Pr�-Reitor de Extens�o
//            </div>
//           
//             <div style='text-align: center; border:0 solid; margin-buttom: 30px ; margin-left: 50px; width:300px; height:100px; float:left;'>
//              <img src='images/pesquisa.png' width='200' height='80'><br>
//              <b>Frederico Souzalima Caldoncelli Franco</b><br>
//              Pr�-Reitor de Pesquisa e Inova��o
//            </div>
//
//          
//        </div>
//        <div style='text-align:center; border:0 solid; margin:0 auto; width:700px;'>
//          <font style='font-family: arial; font-size: 12' >C�digo de valida��o: " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "<br> Verifique a autenticidade deste documento na p�gina: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2016/simposio.php?arquivo2=form_validar_certificado.php</font>
//        </div>
//      </div>  
//    ";
           
        //Tratamento de caracteres especiais
        $nomeAvaliador = iconv("UTF-8","ISO-8859-1",$camposAvaliador[nome]);
        //$nomeAvaliador = iconv("ISO-8859-1","UTF-8",$nomeAvaliador);
        
        $dizeres = "  
         
        Certificamos que $nomeAvaliador atuou como parecerista de trabalhos submetidos para a publica&ccedil;&atilde;o no XV Simp&oacute;sio de Ci&ecirc;ncia, Inova&ccedil;&atilde;o e Tecnologia do Campus Rio Pomba, realizado entre 
        os dias 25 e 26 de outubro de 2023, no Campus Rio Pomba. 
       ";

        $numeroCaracteres = strlen($dizeres);
        
        if($numeroCaracteres >= 300 && $numeroCaracteres < 430)
        {
            $tamanhoFonte = 25  ;
        }

            $html = " 
            
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
                            <div style='position: fixed; width: 250px;  margin-top: -540px; z-index: 0; margin-left:500px; background-color:orange;'>
                            
                                <h1> <b> Certificado </b> </h1> 
                                
                            </div>
                            
                            <!--Resto dos dizeres do certificado-->
                            <div style ='width:1000px;  min-height:500px;  margin-top: 20px; margin-left:60px; margin-bottom:5px; font-size:$tamanhoFonte; text-align:justify;'>
                             $dizeres  
                            </div>
                            
                            <div style ='width: 970px; height: 120px; margin: 40px 0px 0px 60px;'>
                                <div style='text-align: center; margin-left: 100px; width:300px; height:100px; float: left;'>
                                   <img src='images/assinaturaLarissa.png' width='250' height='80'><br>
                                   <b>LARISSA MATTOS TREVIZANO</b><br>
                                   Diretora de Pesquisa e P&oacute;s-gradua&ccedil;&atilde;o
                            </div>
                            <div style='text-align: center;  margin-buttom: 10px ; margin-left: 160px; margin-right: 50px; width:300px; height:100px; float:left;'>
                               <img src='images/assinaturaFranciano.png' width='200' height='80'><br>
                                  <b>FRANCIANO BENEVENUTO CAETANO</b><br>
                                  Gerente de Pesquisa e P&oacute;s-gradua&ccedil;&atilde;o
                              </div>
                            </div>
                            
                            <!--Cidade e data de expedicao-->
                            <div style ='position: fixed; margin-top: 20px; margin-left:-20px; font-size:23px; text-align:center;'>
                                Rio Pomba - MG, 26 de outubro de 2023
                            </div>
                            
                            <!--Imortante para formatacao do pdf-->
                            <div sytle = 'clear:both;'>
                                
                                <br>
                                                      
                            </div>
                            
                           <!--Codigo de validacao 210 297 -->
                            <div style =' font-family: arial; font-size: 13px; width: 800px;  position: fixed; margin: 25px auto auto 120px; font-size:21px; text-align:center;'>
                                <font style='font-family: arial; font-size: 13px;'>
                                    C&oacute;digo de Valida&ccedil;&atilde;o: 
                                    " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "
                                     <br>
                                     Autenticidade em: http://sistemas.riopomba.ifsudestemg.edu.br/simposio2023/simposio.php?arquivo2=form_validar_certificado.php
                                </font>
                                   
                            </div>  
                            
                        </div>

                    </body>

                </html>
        ";          
             
            mysql_close($conexao);

            include("./MPDF56/mpdf.php");
            $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15);
            $mpdf->charset_in = 'windows-1252';
            $mpdf->writeHTML($html);
            $mpdf->Output('mpdf.pdf', 'I');

            exit;
        } else
        {
            echo '<center><font color="#FF0000"><b>O certificado não pôde ser gerado, pois não há trabalho avaliado.</b></font><center>';
        }
    } 
    else
    {
        echo '<center><font color="#FF0000"><b>O certificado poder&aacute; ser gerado a partir da data ' . $data . '.</b></font><center>';
    }
}
?>