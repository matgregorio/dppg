<?php

session_start();
header("Content-Type: text/html; charset=iso-8859-1",true);

	require_once('../fpdf16/fpdf.php');
	require_once('../rotation.php');
	include_once("../includes/config2.php");
	include_once ('trataInjection.php');
    define('FPDF_FONTPATH','../fpdf16/font/');

    if(protectorString($_POST[cpf]))
        return;


echo 'ok';
	$sql = "select participantes.nome as nomep, cursos.nome_curso, data_realizacao, duracao from participantes
           join (inscricao join cursos on inscricao.codigo_curso=cursos.codigo_curso)
           on participantes.cpf=inscricao.cpf where 
           inscricao.presenca='S' and inscricao.codigo_curso='include_once ('trataInjection.php');[codigo_curso]' and participantes.cpf='$_POST[cpf]'";
           
	$resultado = mysql_query($sql);

	if (mysql_num_rows($resultado)<1)
		echo "<br><br><br><center><b>O certificado n�o foi gerado, pois n�o consta presen�a no curso em que voc� se inscreveu.</center></b>";
	else {
		$pdf= new PDF_Rotate("L","mm","A4");
		$pdf->SetTitle("Certificado");
		$pdf->SetSubject("Certificado de participa��o");
		$pdf->SetY("-1");
		$pdf->Cell(0,190,'',1,1,'L',false);
		$pdf->SetFont("arial","", 36); 

		$pdf->Image("../images/topo_certificado.jpg", 40,18);

		$certificado="CERTIFICADO";
		$pdf->Text(110,80, $certificado);

		$pdf->SetFont('arial','',20);
		$texto="Certificamos que ";
		$pdf->SetY("90");
		$pdf->SetX("45");
		$pdf->MultiCell(220,8,$texto,'J');

		$campos = mysql_fetch_array($resultado);
		$pdf->SetFont('arial','B',20);
		$nome=$campos[nomep];
		$pdf->SetY("90");
		$pdf->SetX("110");
		$pdf->MultiCell(210,8,$nome,'J');

		$pdf->SetFont('arial','',20);
		$pdf->SetY("100");
		$pdf->SetX("45");

/*	if ((mysql_num_rows($resultado) >= 10) && (mysql_num_rows($resultado) <= 15)) {
		$texto="participou parcialmente do IV Simp�sio de Ci�ncia, Inova��o & Tecnologia do Instituto Federal de Educa��o, Ci�ncia e Tecnologia do Sudeste de Minas Gerais - Campus Rio Pomba na data de 19 a 22 de outrubro de 2010 com carga hor�ria de 15hs.";
		$pdf->MultiCell(220,10,$texto,'J');
	} else*/ 
		$data_realizacao = implode("/", array_reverse(explode("-", $campos[data_realizacao])));
		$texto="participou do curso ".$campos[nome_curso].' realizado no dia '.$data_realizacao.' com carga hor�ria de '.
					$campos[duracao].'h(s) no Instituto Federal de Educa��o, Ci�ncia e Tecnologia do Sudeste de Minas Gerais -
					Campus Rio Pomba.';
		$pdf->MultiCell(220,10,$texto,'','J');
	
		$pdf->SetFont('arial','B',12);
		$pdf->SetY("160");
		$pdf->SetX("45");
		$assinatura1 = "Maur�cio Henriques Louzada Silva";
		$pdf->Image("../images/mauricio.jpg", 45,150);
		$pdf->MultiCell(100,10,$assinatura1,'J');

		$pdf->SetY("160");
		$pdf->SetX("200");
		//$assinatura3 = "Jo�o Eudes da Silva";
		$pdf->Image("../images/dppg.jpg", 200,150);
	   //$pdf->MultiCell(50,10,$assinatura3,'J');

		$pdf->SetFont('arial','',12);		
		$pdf->SetY("168");
		$pdf->SetX("45");
		$cargo1 = "Diretor de Pesquisa e P�s-Gradua��o";
		$pdf->MultiCell(120,5,$cargo1,0,'L');


	$pdf->Output("arquivo.pdf","I");
	mysql_close($conexao);
	}

?>