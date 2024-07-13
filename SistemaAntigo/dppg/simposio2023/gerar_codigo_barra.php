<?php
   
session_start();

if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');

    require_once('tcpdf/config/lang/eng.php');
    require_once('tcpdf/tcpdf.php');

    include("includes/config.php");

    mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');

    // create new PDF document
//    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8', false);

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set auto page breaks
//    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //set image scale factor
//    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //set some language-dependent strings
    $pdf->setLanguageArray($l);

    // ---------------------------------------------------------
    // set a barcode on the page footer
//    $pdf->setBarcode(date('Y-m-d H:i:s'));

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
        'fgcolor' => array(0, 0, 0),
        'bgcolor' => false, //array(255,255,255),
        'text' => false,
        'font' => 'helvetica',
        'fontsize' => 8,
        'stretchtext' => 4
    );

    $pdf->SetFont('', 'J', 14);
    $pdf->AddLink('Impressra', 'javascript:window.print()');

//    $sql = "select p.cpf, p.nome from participantes p, inscricao i where p.cpf = i.cpf and i.pagamento = 'S' order by p.nome asc";
    $sql = "select distinct p.cpf, p.nome from participantes p, itens_inscricao i where p.cpf = i.cpf order by p.nome asc";
    $resultado = mysql_query($sql);

    $linha = 30;
    $coluna = 15;

    while ($campos = mysql_fetch_array($resultado)) {
        //primeira coluna
        $pdf->SetFont("helvetica", "", 8); /* Alterar tipo e tamanho letra */
        $texto = $campos['nome'];
        $pdf->SetXY("$coluna" - 1, "$linha");
        $pdf->Cell(0, 0, "$texto", 0, 1);
        //$linha = $linha + 5;
        $pdf->SetXY("$coluna", "$linha" + 5);


        // EAN 13
        //18 altura do quadro, 0.4 espaço entre barras
        $cpf = "$campos[cpf]";
        $pdf->write1DBarcode($cpf, 'C128A', '', '', '', 13, 0.4, $style, 'S');

        $pdf->SetXY("$coluna", "$linha" + 25);

        if ($campos = mysql_fetch_array($resultado)) {
            //segunda coluna
            $texto = "$campos[nome]";
            $coluna = 120;
            $pdf->SetXY("$coluna" - 1, "$linha");
            $pdf->Cell(0, 0, "$texto", 0, 1);
            $pdf->SetXY("$coluna", "$linha" + 5);
            // EAN 13
            $cpf = "$campos[cpf]";
            $pdf->write1DBarcode($cpf, 'C128A', '', '', '', 13, 0.4, $style, 'S');
            $pdf->SetXY("$coluna", "$linha" + 25);
        }

        $coluna = 15;
        $linha = $linha + 33;

        //Verifica se chegou no final da página para gerar a próxima página
        if ($linha > 239) {
            $linha = 30;
            $pdf->AddPage();
        }
    }

    $pdf->Output('lista_presenca.pdf', 'I');

    mysql_close($conexao);
}
?>