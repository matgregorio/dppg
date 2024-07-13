<?php

session_start();
//header("Content-Type: text/html; charset=iso-8859-1", true);
header("Content-Type: text/html; charset=utf-8", true);

include("../../includes/config2.php");
include_once ('trataInjection.php');
require_once('../../fpdf16/fpdf.php');
require_once('../../rotation.php');
define('FPDF_FONTPATH', '../../fpdf16/font/');

if(protectorString($_POST[cpf]) || protectorString($_POST[codigo_curso]))
  return;

$codigo_curso = mysql_real_escape_string($_POST[codigo_curso]);
$cpf = mysql_real_escape_string($_POST[cpf]);

$codigo_curso = '2';
$cpf = '10063010623';

$sql = "select participantes.nome as nomep, cursos.nome_curso, data_realizacao, data_realizacao2, data_realizacao3, duracao from participantes join (inscricao join cursos on inscricao.codigo_curso=cursos.codigo_curso) on participantes.cpf=inscricao.cpf where inscricao.presenca='S' and inscricao.codigo_curso='$codigo_curso' and participantes.cpf='$cpf'";

$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) < 1)
  echo "<br><br><br><center><b>O certificado não foi gerado, pois não consta presença no curso em que você se inscreveu.</center></b>";
else {
  $pdf = new PDF_Rotate("L", "mm", "A4");
  $pdf->SetTitle("Certificado");
  $pdf->SetSubject("Certificado de participação");
  $pdf->SetY("-1");
  $pdf->Cell(0, 190, '', 1, 1, 'L', false);
  $pdf->SetFont("arial", "", 36);

  $pdf->Image("../../images/topo_certificado.jpg", 40, 18);

  $certificado = "CERTIFICADO";
  $pdf->Text(110, 80, $certificado);

  $pdf->SetFont('arial', '', 20);
  $texto = "Certificamos que ";
  $pdf->SetY("90");
  $pdf->SetX("45");
  $pdf->MultiCell(220, 8, $texto, 'J');

  $campos = mysql_fetch_array($resultado);
  $pdf->SetFont('arial', 'B', 20);
  $nome = $campos[nomep];// iconv('utf-8', 'iso-8859-1', "Certificamos que $campos[nomep]");
  $pdf->SetY("90");
  $pdf->SetX("110");
  $pdf->MultiCell(210, 8, $nome, 'J');

  $pdf->SetFont('arial', '', 20);
  $pdf->SetY("100");
  $pdf->SetX("45");



  $data1 = $campos[data_realizacao];
  $data2 = $campos[data_realizacao2];
  $data3 = $campos[data_realizacao3];
  $dataMax = "";
  $dataMei = "";
  $dataMin = "";
//echo "$data1 -- $data2 -- $data3 ";
  if (strtotime($data1) > strtotime($data2)) {
    if (strtotime($data1) > strtotime($data3)) {
      $dataMax = implode("/", array_reverse(explode("-", $data1)));
      if (strtotime($data2) > strtotime($data3)) {
        $dataMei = implode("/", array_reverse(explode("-", $data2)));
        $dataMin = implode("/", array_reverse(explode("-", $data3)));
      } else if (strtotime($data2) < strtotime($data3)) {
        $dataMei = implode("/", array_reverse(explode("-", $data3)));
        $dataMin = implode("/", array_reverse(explode("-", $data2)));
      }
    } else if (strtotime($data1) < strtotime($data3)) {
      $dataMax = implode("/", array_reverse(explode("-", $data3)));
      $dataMei = implode("/", array_reverse(explode("-", $data1)));
      $dataMin = implode("/", array_reverse(explode("-", $data2)));
    }
  } elseif (strtotime($data1) > strtotime($data3)) {
    $dataMax = implode("/", array_reverse(explode("-", $data2)));
    $dataMei = implode("/", array_reverse(explode("-", $data1)));
    $dataMin = implode("/", array_reverse(explode("-", $data3)));
  } else {
    $dataMin = implode("/", array_reverse(explode("-", $data1)));
    if (strtotime($data2) > strtotime($data3)) {
      $dataMax = implode("/", array_reverse(explode("-", $data2)));
      $dataMei = implode("/", array_reverse(explode("-", $data3)));
    } else {
      $dataMax = implode("/", array_reverse(explode("-", $data3)));
      $dataMei = implode("/", array_reverse(explode("-", $data2)));
    }
  }

  $data_realizacao = "";
  if ($dataMin != "") {
    $data_realizacao = $dataMin;
  }
  if (($dataMei != '') && ($dataMax != '')) {
    if ($data_realizacao == "") {
      $data_realizacao = "$dataMei e $dataMax";
    } else {
      $data_realizacao = "$data_realizacao, $dataMei e $dataMax";
    }
  } else if (($dataMei != '') && ($dataMax == '')) {
    if ($data_realizacao == "") {
      $data_realizacao = "$dataMei";
    } else {
      $data_realizacao = "$data_realizacao e $dataMei";
    }
  } else if (($dataMei == '') && ($dataMax != '')) {
    if ($data_realizacao == "") {
      $data_realizacao = "$dataMax";
    } else {
      $data_realizacao = "$data_realizacao e $dataMax";
    }
  }

//  $data_realizacao = implode("/", array_reverse(explode("-", $campos[data_realizacao])));

  $texto = "participou do curso " . $campos[nome_curso] . ' realizado no(s) dia(s) ' . $data_realizacao . ' com carga horária de ' .
          $campos[duracao] . 'h(s) no Instituto Federal de Educação, Ciência e Tecnologia do Sudeste de Minas Gerais - <i>Campus</i> Rio Pomba.';
//  $texto = iconv('iso-8859-1', 'utf-8', $texto);
  $pdf->MultiCell(220, 10, $texto, '', 'J');

  $pdf->SetFont('arial', 'B', 12);
  $pdf->SetY("165");
  $pdf->SetX("45");
  $assinatura1 = "André Narvaes da Rocha Campos";
  $pdf->Image("../../images/andre.jpg", 45, 150);
  $pdf->MultiCell(100, 10, $assinatura1, 'J');

  $pdf->SetFont('arial', '', 12);
  $pdf->SetY("173");
  $pdf->SetX("45");
  $cargo1 = "Diretor de Pesquisa e Pós-Graduação";
  $pdf->MultiCell(120, 5, $cargo1, 0, 'L');

  $pdf->SetFont('arial', 'B', 12);
  $pdf->SetY("165");
  $pdf->SetX("180");
  $assinatura1 = "Sérgio de Miranda Pena";
  $pdf->Image("../../images/SergioPena.jpg", 180, 140);
  $pdf->MultiCell(100, 10, $assinatura1, 'J');

  $pdf->SetFont('arial', '', 12);
  $pdf->SetY("173");
  $pdf->SetX("180");
  $cargo1 = "Gerente de Pesquisa e Pós-Graduação";
  $pdf->MultiCell(120, 5, $cargo1, 0, 'L');

  $pdf->Output("arquivo.pdf", "I");
  mysql_close($conexao);
}
?>
