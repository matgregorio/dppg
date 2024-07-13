<?php

session_start();

include("../../includes/config2.php");
include_once ('trataInjection.php');

if(protectorString($_POST[codigo_curso]) || protectorString($_POST[cpf]))
    return;


//require_once('../../fpdf16/fpdf.php');
//require_once('../../rotation.php');
//define('FPDF_FONTPATH', '../../fpdf16/font/');

$codigo_curso = mysql_real_escape_string($_POST[codigo_curso]);
$cpf = mysql_real_escape_string($_POST[cpf]);

$sql = "select participantes.nome as nomep, cursos.nome_curso, data_realizacao, data_realizacao2, data_realizacao3, duracao from participantes join (inscricao join cursos on inscricao.codigo_curso=cursos.codigo_curso) on participantes.cpf=inscricao.cpf where inscricao.presenca='S' and inscricao.codigo_curso='$codigo_curso' and participantes.cpf='$cpf'";

$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) < 1)
    echo "<br><br><br><center><b>O certificado não foi gerado, pois não consta presença no curso em que você se inscreveu.</center></b>";
else {
    $tipo = "curso";
//    $pdf = new PDF_Rotate("L", "mm", "A4");
//    $pdf->SetTitle("Certificado");
//    $pdf->SetSubject("Certificado de participação");
//    $pdf->SetY("-1");
//    $pdf->Cell(0, 190, '', 1, 1, 'L', false);
//    $pdf->SetFont("arial", "", 36);
//
//    $pdf->Image("../../images/topo_certificado.jpg", 40, 18);
//    $certificado = "CERTIFICADO";
//    $pdf->Text(110, 80, $certificado);
//
//    $pdf->SetFont('arial', '', 20);
//    $texto = "Certificamos que ";
//    $pdf->SetY("90");
//    $pdf->SetX("45");
//    $pdf->MultiCell(220, 8, $texto, 'J');

    $campos = mysql_fetch_array($resultado);
//    $pdf->SetFont('arial', 'B', 20);
//    $nome = $campos[nomep]; // iconv('utf-8', 'iso-8859-1', "Certificamos que $campos[nomep]");
   // $nome = iconv('iso-8859-1', 'utf-8', "$campos[nomep]");
    $nome = utf8_encode($campos[nomep]);
//    $pdf->SetY("90");
//    $pdf->SetX("110");
//    $pdf->MultiCell(210, 8, $nome, 'J');
//
//    $pdf->SetFont('arial', '', 20);
//    $pdf->SetY("100");
//    $pdf->SetX("45");

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

    $data_realizacao = implode("/", array_reverse(explode("-", $campos[data_realizacao])));
    $a = utf8_encode($campos[nome_curso]);

//    $texto = "participou do " . $a . " realizado no(s) dia(s) $data_realizacao com carga " . iconv('utf-8', 'iso-8859-1', "horária") . "  no Instituto Federal de " . utf8_decode("Educação, Ciência") . " e Tecnologia do Sudeste de Minas Gerais - " . iconv('utf-8', 'iso-8859-1', "Câmpus") . " Rio Pomba.";

    $texto = "participou do " . $a . " realizado no(s) dia(s) $data_realizacao com carga horária de $campos[duracao] hora(s) no Instituto Federal de Educação, Ciência e Tecnologia do Sudeste de Minas Gerais - Câmpus Rio Pomba.";

//  $texto = "participou do $a, realizado no(s) dia(s) $data_realizacao com carga horária de $campos[duracao] h(s) no Instituto Federal de Educação, Ciência e Tecnologia do Sudeste de Minas Gerais - <i>Campus</i> Rio Pomba.";
//  $texto = iconv("iso-8859-1', 'utf-8', $texto);
//    $pdf->MultiCell(220, 10, $texto, '', 'J');
//
//    $pdf->SetFont('arial', 'B', 12);
//    $pdf->SetY("165");
//    $pdf->SetX("45");
//    $assinatura1 = iconv('utf-8', 'iso-8859-1', "André Narvaes da Rocha Campos"); //"André Narvaes da Rocha Campos";
//    $pdf->Image("../../images/andre.jpg", 45, 150);
//    $pdf->MultiCell(100, 10, $assinatura1, 'J');
//
//    $pdf->SetFont('arial', '', 12);
//    $pdf->SetY("173");
//    $pdf->SetX("45");
//    $cargo1 = utf8_decode("Diretor de Pesquisa e Pós-Graduação");
//    $pdf->MultiCell(120, 5, $cargo1, 0, 'L');
//
//    $pdf->SetFont('arial', 'B', 12);
//    $pdf->SetY("165");
//    $pdf->SetX("180");
//    $assinatura1 = iconv('utf-8', 'iso-8859-1', "Sérgio de Miranda Pena"); //"Sérgio de Miranda Pena";
//    $pdf->Image("../../images/SergioPena.jpg", 180, 140);
//    $pdf->MultiCell(100, 10, $assinatura1, 'J');
//
//    $pdf->SetFont('arial', '', 12);
//    $pdf->SetY("173");
//    $pdf->SetX("180");
//    $cargo1 = utf8_decode("Gerente de Pesquisa e Pós-Graduação");
//    $pdf->MultiCell(120, 5, $cargo1, 0, 'L');
//
//    $pdf->Output("arquivo.pdf", "I");
    include './valida_certificado.php';
    //$texto = iconv("ISO-8859-1", "UTF-8", $texto);


    $html = "
    <meta charset=\"UTF-8\" />
      <div style='border:1 solid; vertical-align: central; width:1300px; height:1100px;'>
        <table border=0 style='width:1300px; height:1100px; text-justify: auto'>
          <tr><td align=center>&nbsp;</br></td></tr>
          <tr><td align=center><img src='../../images/topo_certificado.jpg' width='800' height='150'></td></tr>
          <tr><td align=center><font style='font-family: arial; font-size: 50' >CERTIFICADO</font></td></tr>
        </table>
        <div style='border:0 solid; margin: 25px auto; width:900px; height:215px;'>
          <table border=0 style='width:1300px; height:1100px; text-justify: auto'>
            <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 28' >Certificamos que <b>" . strtr(strtoupper($nome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b></font></td></tr>
            <tr><td style='text-align: justify'><font style='font-family: arial; font-size: 28' >$texto</font></td></tr>    
          </table>
        </div>
        <div>
          <div style='text-align: center; border:0 solid; margin-top:-20px; margin-buttom: 30px ; margin-left: 100px; width:300px; height:100px; float: left;'>
            <img src='../../images/AssinaturaLarissaTrevizano.png' width='180' height='60'><br>
            <b>" . strtr(strtoupper("Larissa Mattos Trevizano"), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
            Diretora de Pesquisa e Pós-Graduação
          </div>
          <div style='text-align: center; border:0 solid; margin-top:-20px; margin-buttom: 30px ; margin-left: 243px; margin-right: 50px; width:300px; height:100px; float:left;'>
            <img src='../../images/AssinaturaFranciano.png' width='180' height='60'><br>
            <b>" . strtr(strtoupper("Franciano Benevenuto Caetano"), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
            Gerente de Pesquisa e Pós-Graduação
          </div>
        </div>
		<br><br>
        <div style='text-align:center; border:0 solid; margin:0 auto; width:700px;'>
          <font style='font-family: arial; font-size: 12' >Código de Validação: " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "<br> Verifique a autenticidade deste documento na página: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/index.php?arquivo=subsistemas/cursos/form_validar_certificado.php</font>
        </div>
      </div>  
    ";
//    mysql_close($conexao);

    include '../../MPDF56/mpdf.php';
    $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15);
    $mpdf->writeHTML($html);
    $mpdf->Output('arquivo.pdf', 'I');
    $mpdf->charset_in='utf-8';
    exit;
    mysql_close($conexao);
}
?>
