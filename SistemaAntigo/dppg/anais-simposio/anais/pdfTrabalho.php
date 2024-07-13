<?php
include 'model/dao/ParticipanteDao.class.php';
include 'model/dao/TrabalhoDao.class.php';
include 'model/dao/ApoioDao.class.php';
include 'model/Trabalho.class.php';

require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');


$year = date("Y");

$id = $_GET[local];

$trabalhoDao = new TrabalhoDao("dppg_simposio$year");
$objListTrabalho = $trabalhoDao->getSingletObjects($id);

//$participanteDao = new ParticipanteDao("dppg_simposio$year");
//$objListParticipante = $participanteDao->getObjects();
$objListParticipante = $_REQUEST[participante];

function Autores($codigo_trab, $condicao) {
  $campos = mysql_fetch_array(mysql_query("SELECT * FROM trabalhos WHERE codigo_trab='$codigo_trab'"));
  $analizador = mysql_fetch_array(mysql_query("SELECT cpf, nome, email FROM participantes WHERE cpf='$campos[cpf_prof_analisador]'"));
  $autor1 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor1]'"));
  if ($campos[autor2] != '') {
    $autor2 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor2]'"));
  }
  if ($campos[autor3] != '') {
    $autor3 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor3]'"));
  }
  if ($campos[autor4] != '') {
    $autor4 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor4]'"));
  }
  if ($campos[autor5] != '') {
    $autor5 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor5]'"));
  }
  if ($campos[autor6] != '') {
    $autor6 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor6]'"));
  }
  if ($campos[autor7] != '') {
    $autor7 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor7]'"));
  }
  if ($condicao == '0') {
    $cont = 1;
    $texto1 = $autor1[nome] . "<sup>$cont</sup>";
    $cont++;
    if ($autor1[cpf] != $analizador[cpf]) {
      $texto1 = $texto1 . '; ' . $analizador[nome] . "<sup>$cont</sup>";
    }
    if ($autor2[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor2[nome] . "<sup>$cont</sup>";
    }
    if ($autor3[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor3[nome] . "<sup>$cont</sup>";
    }
    if ($autor4[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor4[nome] . "<sup>$cont</sup>";
    }
    if ($autor5[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor5[nome] . "<sup>$cont</sup>";
    }
    if ($autor6[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor6[nome] . "<sup>$cont</sup>";
    }
    if ($autor7[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor7[nome] . "<sup>$cont</sup>";
    }
  } else if ($condicao == '1') {
    //colocar condição que diz qual tipo de participante
    $cont = 0;
    if ($autor1[cpf] != $analizador[cpf]) {//caso o autor 1 seja o orientador
      $cont++;
      $texto1 = "<sup>$cont</sup>$autor1[tipo] do curso: " . $autor1[nome_curso] . "- IFSudesteMG/Campus Rio Pomba; " . $autor1[email] . "<br>";
    }
    $cont++;
    $texto1 = $texto1 . "<sup>$cont</sup>Professor Orientador - IFSudesteMG/Campus Rio Pomba; " . $analizador[email] . "<br>";
    if ($autor2[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor2[tipo] do curso: " . $autor2[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor2[email] . "<br>";
    }
    if ($autor3[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor3[tipo] do curso: " . $autor3[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor3[email] . "<br>";
    }
    if ($autor4[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor4[tipo] do curso: " . $autor4[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor4[email] . "<br>";
    }
    if ($autor5[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor5[tipo] do curso: " . $autor5[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor5[email] . "<br>";
    }
    if ($autor6[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor6[tipo] do curso: " . $autor6[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor6[email] . "<br>";
    }
    if ($autor7[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor7[tipo] do curso: " . $autor7[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor7[email];
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
while ($campos_apoio = mysql_fetch_array($result_apoios)) {
  if ($cont == 0) {
    $apoios = $campos_apoio[nome];
    $cont++;
  } else {
    $apoios = "$apoios - $campos_apoio[nome]";
  }
}

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

  //Page header
  public function Header() {
    $codigo = mysql_real_escape_string($_GET[codigot]);
    $resultado_edicao = mysql_query("select informacoes from conteudo where codigo_conteudo = '10'");
    $campos_edicao = mysql_fetch_array($resultado_edicao);
    $resultado_edicao1 = mysql_query("select informacoes from conteudo where codigo_conteudo = '11'");
    $campos_edicao1 = mysql_fetch_array($resultado_edicao1);
    $resultado_trabalho = mysql_query("SELECT modalidade, tipo_iniciacao FROM trabalhos WHERE codigo_trab='$codigo'");
    $campos_trabalho = mysql_fetch_array($resultado_trabalho);
    if ($campos_trabalho[modalidade] == "N") {
      $modalidade = "Estudos Orientados";
    } else {
      if ($campos_trabalho[tipo_iniciacao] == "G") {
        $modalidade = "Iniciação Científica/Graduação";
      } else if ($campos_trabalho[tipo_trabalho] == "M") {
        $modalidade = "Iniciação Científica/Mestrado";
      } else {
        $modalidade = "Iniciação Científica/Técnico";
      }
    }
    // Logo
    $image_file = "images/logo-ifete.png";
    $this->Image($image_file, 25, 7, 50, 25, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $this->SetFont('times', 'R', 9);

    $header = <<<EOD
    <table align="right" >
      <tr>
        <td>$campos_edicao[informacoes] Simpósio de Ciência, Inovação & Tecnologia – IF Sudeste MG - Campus Rio Pomba</td>
      </tr>
      <tr>
        <td>Ciência e Tecnologia para o Desenvolvimento Social</td>
      </tr>
      <tr>
        <td>$campos_edicao1[informacoes].</td>
      </tr>
    </table>
EOD;
    $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '9', $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
  }

  // Page footer
  public function Footer() {
    $codigo = mysql_real_escape_string($_GET[codigot]);
    // Position at 15 mm from bottom
    //$this->SetY(-15);
    // Set font
    $this->SetFont('times', 'R', 9);

    //pega os dados formatados
    $rodape = Autores($codigo, 1);

    // Page number
    $this->writeHTMLCell($w = 0, $h = 0, $x = 15, $y = -40, $rodape, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '');
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
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

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
if (1 == 1) {
  $titulo = $campos_trabalho[titulo];
} else {
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
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '60', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

//o tamanho da font é forçada no momento em que o pdf é gerado
$resumo = htmlspecialchars_decode($campos_trabalho[resumo], ENT_QUOTES); //decodifica o texto
//$resumo = str_replace("<p>", "", $resumo);
//$resumo = str_replace("</p>", "", $resumo);
//$resumo = "<p>$resumo</p>";
$html = <<<EOD
<font align="justfy" size="11">$resumo</font><br><br><br>

EOD;
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '60', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

$html = <<<EOD
    <font align="left"><b>PALAVRAS CHAVE:</b> $campos_trabalho[palavra_chave]</font><br><br>
    <font align="left" size"10"><b>Apoio(s):</font>
    <br>$apoios
    <br><br>
EOD;
$pdf->writeHTMLCell($w = '0', $h = '0', $x = '15', $y = '227', $html, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '', $autopadding = true);

$pdf->Output("$titulo.pdf", 'I');

mysql_close($conexao);
?>
