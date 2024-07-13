<?php
session_start();
header("Content-Type: text/html; charset=utf-8", true);

/* É Preciso mudar o conteúdo do texto, pois não está dinâmico */

if ($_SESSION[logado_simposio_2021]) {
  include("includes/config.php");
  include("funcao.php");

//  require_once('fpdf16/fpdf.php');
//  require_once('rotation.php');
//  define('FPDF_FONTPATH', 'fpdf16/font/');

  $codigo_trab = mysql_real_escape_string($_GET[codigo]);

  $tipo = "submissao";

  //$sql = "select * from trabalhos t, participantes p where p.cpf = t.cpf and t.aprovado ='1' and 	t.presenca = 'S' and p.cpf ='$_SESSION[cpf]' and codigo_trab=$codigo_trab";
  
  //Seleciona tudo do trabalho do cara
  $sql = "select * from trabalhos t where t.aprovado ='1' and t.presenca = 'S' and codigo_trab=$codigo_trab";
  $resultado = mysql_query($sql);
  $campos = mysql_fetch_array($resultado);

  //Aqui algu�m passou muita raiva, raiva, raiva!!!!!
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
  if ($campos[apresentador] == 1) {
    $cpf_apresentador = $autor1[cpf];
  } else if ($campos[apresentador] == 2) {
    $cpf_apresentador = $autor2[cpf];
  } else if ($campos[apresentador] == 3) {
    $cpf_apresentador = $autor3[cpf];
  } else if ($campos[apresentador] == 4) {
    $cpf_apresentador = $autor4[cpf];
  } else if ($campos[apresentador] == 5) {
    $cpf_apresentador = $autor5[cpf];
  } else if ($campos[apresentador] == 6) {
    $cpf_apresentador = $autor6[cpf];
  } else if ($campos[apresentador] == 7) {
    $cpf_apresentador = $autor7[cpf];
  }

//    if ($_SESSION[cpf] == $cpf_apresentador) 
//    {
////      $texto = iconv('utf-8', 'iso-8859-1', 'apresentou o trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma de pôster,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba realizado no período de ' . $campos_periodo[informacoes] . '.');
//      $texto3 = 'apresentou o trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma de pôster,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba.';
//    }
//    else 
//    {
////      $texto = iconv('utf-8', 'iso-8859-1', 'foi coautor do trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma de pôster,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba realizado no período de ' . $campos_periodo[informacoes] . '.');
//      $texto3 = 'foi coautor do trabalho intitulado "' . $campos[titulo] . '", de autoria de ' . $autor1[nome] . $texto1 . ', ' . $campo_submissao[conteudo_submissao] . 'apresentado na forma de pôster,  no ' . $campos_edicao[informacoes] . ' Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba.';
//    }

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
  ?>

  <?php
  echo "
    
    <div style='border:1 solid; vertical-align: central; width:1300px; height:1300px;'>
       
        <!--Imagem de topo-->        
        <table border=0 style='width:1300px; height:1100px; text-justify: auto'>
            <tr><td align=center>&nbsp;</br></td></tr>
            <tr><td align=center><img src='images/$campos_topo[topo]' width='800' height='150'></td></tr>
            <tr><td align=center><font style='font-family: arial; font-size: 50' >CERTIFICADO</font></td></tr>
        </table>
         
        <!--Dizeres-->
        <div style='border:0 solid; margin: 0 auto; width:900px; height:300px;'>
        
            <table border=0 style='width:1300px; height:1100px; text-justify: auto'>

              <!--**** Comentado <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 28' >Certificamos que <b>" . strtr(strtoupper($texto), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b></font></td></tr> -->

              <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 28' >Certificamos que o trabalho intitulado </font></td></tr>
              <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 22' > <b> $campos[titulo] <b> </font></td></tr>    
              <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 22' > foi apresentado na Forma de P�ster no III Simp�sio de Ensino, Pesquisa e Extens�o do IF Sudeste MG e  </font></td></tr>     
              <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 22' > IX Simp�sio de Ci�ncia, Inova��o e Tecnologia do Campus Rio Pomba, realizado entre os dias 12 e 14   </font></td></tr>        
              <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 22' > de setembro de 2016.   </font></td></tr>

            </table>
        
        </div>
      
        <!--Assinaturas-->
        <div>
        
            <!--Assinatura 1 -->
            <div style='text-align: center; border:0 solid; margin-buttom: 10px ; margin-left: 100px; width:300px; height:100px; float: left;'>
              <img src='images/$campos_assinatura1[imagem_assinatura]' width='250' height='80'><br>
              <b>" . strtr(strtoupper($campos_assinatura1[assinatura]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
              $campos_assinatura1[cargo]
            </div>
            
            <!--Assinatura 2 -->
            <div style='text-align: center; border:0 solid; margin-buttom: 10px ; margin-left: 243px; margin-right: 50px; width:300px; height:100px; float:left;'>
              <img src='images/$campos_assinatura2[imagem_assinatura]' width='200' height='80'><br>
              <b>" . strtr(strtoupper($campos_assinatura2[assinatura]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
              $campos_assinatura2[cargo]
            </div>
        
        </div>
      
        <!--Rodap� -->
        <div style='text-align:center; border:0 solid; margin:0 auto; width:700px;'>
            <font style='font-family: arial; font-size: 12' >Código de Validação: " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "<br> Verifique a autenticidade deste documento na página: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2015/simposio.php?arquivo2=form_validar_certificado.php</font>
        </div>
      
    </div>
";
  mysql_close($conexao);

//  include("./MPDF56/mpdf.php");
//  $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15);
//  $mpdf->SetDisplayMode('fullpage', 'single');
//  $mpdf->writeHTML($html);
//  $mpdf->Output('mpdf.pdf', 'I');
//  exit;
//  mysql_close($conexao);
}
?>
