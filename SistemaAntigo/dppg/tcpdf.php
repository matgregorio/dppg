<?php
//============================================================+
// File name   : example_027.php
// Begin       : 2008-03-04
// Last Update : 2011-09-22
//
// Description : Example 027 for TCPDF class
//               1D Barcodes
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: 1D Barcodes.
 * @author Nicola Asuni
 * @since 2008-03-04
 */


session_start();
//header("Content-Type: text/html; charset=utf8",true);
//include("pesquisa_vetor.php"); 
//$resultado = pesquisa_vetor($_SESSION[grupos],array('1'));

//if (($_SESSION[logado_site_dppg]) && ($resultado)){



	require_once('tcpdf/config/lang/eng.php');
	require_once('tcpdf/tcpdf.php');

	include("includes/config2.php");

   mysql_query("SET NAMES 'utf8'");
   mysql_query('SET character_set_connection=utf8');
   mysql_query('SET character_set_client=utf8');
   mysql_query('SET character_set_results=utf8');
	
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Gustavo Reis');
	$pdf->SetTitle('DPPG');
	$pdf->SetSubject('DPPG');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_DPPG, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITULO, PDF_HEADER_TEXTO);

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

	// set a barcode on the page footer
	$pdf->setBarcode(date('Y-m-d H:i:s'));

	// add a page
	$pdf->AddPage();

	// define barcode style
	$style = array(
   	'position' => '',
    	'align' => 'C',
    	'stretch' => false,
    	'fitwidth' => true,
    	'cellfitalign' => '',
    	'border' => true,
    	'hpadding' => 'auto',
    	'vpadding' => 'auto',
    	'fgcolor' => array(0,0,0),
    	'bgcolor' => false, //array(255,255,255),
    	'text' => false,
    	'font' => 'helvetica',
    	'fontsize' => 8,
    	'stretchtext' => 4
	);

	$sql = "select nome_curso from cursos where codigo_curso=$_GET[codigo_curso]";
	$resultado = mysql_query($sql);
	$campos = mysql_fetch_array($resultado);
	// PRINT VARIOUS 1D BARCODES
	$pdf->SetFont('helvetica', 'B', 14);
	$texto = "Lista presença do curso $campos[nome_curso]";
	$pdf->Cell(0, 0, $texto, 0, 1, 'C');
	$pdf->SetFont('helvetica', '', 10);
	$sql = "select participantes.cpf, participantes.nome from participantes join inscricao on inscricao.cpf=participantes.cpf 
			 	where inscricao.codigo_curso='$_GET[codigo_curso]' order by participantes.nome";
	$resultado = mysql_query($sql);
	$linha = 40;
	$coluna = 15;
	while ($campos = mysql_fetch_array($resultado)) {
		
		//primeira coluna
		$texto = "$campos[nome]";
		$pdf->SetXY("$coluna"-1,"$linha");
		$pdf->Cell(0, 0, "$texto", 0, 1);
		//$linha = $linha + 5;
		$pdf->SetXY("$coluna","$linha"+5);

		// EAN 13
		$cpf = "$campos[cpf]";
		$pdf->write1DBarcode($cpf, 'EAN13', '', '', '', 18, 0.4, $style, 'N');

		//$linha = $linha + 20;
		$pdf->SetXY("$coluna","$linha"+25);
		$pdf->Cell(0, 0, 'Ass.:______________________', 0, 1);
		
		if ($campos = mysql_fetch_array($resultado)) {
			//segunda coluna
			$texto = "$campos[nome]";
			$coluna = 120;
			$pdf->SetXY("$coluna"-1,"$linha");
			$pdf->Cell(0, 0, "$texto", 0, 1);
			$pdf->SetXY("$coluna","$linha"+5);
			// EAN 13
			$cpf = "$campos[cpf]";
			$pdf->write1DBarcode($cpf, 'EAN13', '', '', '', 18, 0.4, $style, 'N');			
			$pdf->SetXY("$coluna","$linha"+25);
			$pdf->Cell(0, 0, 'Ass.:______________________', 0, 1);
		}
		
		$coluna = 15;
		$linha = $linha+40;
		//Verifica se chegou no final da página para gera a próxima página
		if ($linha > 279) {
		   $linha = 40;
		   $pdf->AddPage();
		}
	}

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('example_027.pdf', 'I');

	//============================================================+
	// END OF FILE
	//============================================================+
	mysql_close($conexao);
//}
?>