<?php
session_start();

if (!in_array("1", $_SESSION[codigo_grupo]))
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Somente administradores logados podem acessar esse conteúdo</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    return;
}

include_once ('includes/config.php');
include_once ('acentuacao.php');
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

$codigoSubEvento = filter_input(INPUT_POST, "codigoSubEvento", FILTER_SANITIZE_NUMBER_INT );
$tipoArquivo = filter_input(INPUT_POST, "tipoArquivo", FILTER_SANITIZE_SPECIAL_CHARS );
$relacaoInscritosSubEventosParaExcel = mysql_query("SELECT p.nome, p.email, ii.cpf, se.nome_sub_evento, ii.codigo_sub_evento, ii.presenca  FROM itens_inscricao ii, participantes p, sub_eventos se WHERE p.cpf = ii.cpf AND ii.codigo_sub_evento = se.codigo_sub_evento and ii.codigo_sub_evento = '$codigoSubEvento'");
$nomeArquivo = mysql_query("SELECT se.nome_sub_evento FROM itens_inscricao ii, participantes p, sub_eventos se WHERE p.cpf = ii.cpf AND ii.codigo_sub_evento = se.codigo_sub_evento and ii.codigo_sub_evento = '$codigoSubEvento' LIMIT 1");
$nomeArquivo = mysql_fetch_row($nomeArquivo);
$nomeArquivo = htmlspecialchars($nomeArquivo[0]);

if(strlen($nomeArquivo) >= 200)
    $nomeArquivo = substr("$nomeArquivo", 0, 100);

if(mysql_num_rows($relacaoInscritosSubEventosParaExcel)==0)
{
    echo "Erro ao recuperar lista de participantes";
}
else
{
    /*Cabeçalho tabela*/
    $html = '';
    $html.= "
        <style type='text/css'>            
            .tg  {border-collapse:collapse;border-color:#bbb;border-spacing:0; margin-left:auto; margin-right:auto;}
            .tg td{background-color:#E0FFEB;border-color:#bbb;border-style:solid;border-width:1px;color:#594F4F; font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal; text-align: center;}
            .tg td{background-color:#9DE0AD;border-color:#bbb;border-style:solid;border-width:1px;color:#493F3F; font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
            .tg .tg-0lax1{text-align:center; vertical-align:top; background-color: #E0FFEB;}
        </style>";

        $html .= '<table class="tg">';
        $html .= '<tr>';
        $html .= '<td></td>';
        $html .= '<td><b>'.$nomeArquivo.'</b></td>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '<td></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>Nome</b></td>';
        $html .= '<td><b>CPF</b></td>';
        $html .= '<td><b>Email</b></td>';
        $html .= '<td><b>Presen&ccedil;a</b></td>';
        $html .= '</tr>';

    while($dadosSubEvento = mysql_fetch_array($relacaoInscritosSubEventosParaExcel))
    {
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td class=\'tg-0lax1\'>' . htmlspecialchars($dadosSubEvento[nome]) . '</td>';
        $html .= '<td class=\'tg-0lax1\'>' . htmlspecialchars($dadosSubEvento[cpf]) . '</td>';
        $html .= '<td class=\'tg-0lax1\'>' . htmlspecialchars($dadosSubEvento[email]) . '</td>';
        $html .= '<td class=\'tg-0lax1\'>' . htmlspecialchars($dadosSubEvento[presenca]) . '</td>';
        $html .= '</tr>';
        $html .= '</tbody>';
    }
    $html .= '</table>';

    switch ($tipoArquivo)
    {
        /*Gera um arquivo MS Excel*/
        case 'xls':
        {
            /*Configurações header para forçar o download*/
            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); //Força o navegador desabilitar o cache
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/x-msexcel");
            header ("Content-Disposition: attachment; filename=\"{$nomeArquivo}\".xls" );
            header ("Content-Description: PHP Generated Data" );
            break;
        }
        /*Gera um arquivo ODS (Libre Office)*/
        case 'ods':
        {
            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); //Força o navegador desabilitar o cache
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/vnd.oasis.opendocument.spreadsheet");
            header ("Content-Disposition: attachment; filename=\"{$nomeArquivo}\".ods" );
            header ("Content-Description: PHP Generated Data" );
            break;
        }
        /*Gera um arquivo PDF*/
        case 'pdf':
        {
            $totalParticipantesPDF = "<h2 style='margin-left: 40%; margin-top: 15px;'>". "Total de participantes: ";
            $totalParticipantesPDF.= mysql_num_rows($relacaoInscritosSubEventosParaExcel) . "</h2>";
            include_once("./MPDF56/mpdf.php");
            $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15);
            $mpdf->SetDisplayMode('fullpage', 'single');
            $mpdf->writeHTML($totalParticipantesPDF);
            $mpdf->writeHTML($html);
            $mpdf->Output("$nomeArquivo".".pdf", 'D', "I");
            exit;

        }
    }

    echo $html;
    exit;
}

?>