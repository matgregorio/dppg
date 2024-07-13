<?php

include('includes/config.php');
include ('acentuacao.php');
header('Content-Type: text/html; charset=utf-8');



echo '<div id="rodape">';

$sql = "select informacoes from conteudo where codigo_conteudo = '3'";
$resultado = mysql_query($sql);
$campos = mysql_fetch_array($resultado);

echo $campos[informacoes];

echo'<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />';
echo '<center><span class="example1" style=" color: #fff; font-family: arial, helvetica, sans-serif; font-size: small;"><strong>Web Master respons&aacute;vel: Andr&eacute; Filipe da Silva - Integrante <a href="http://www.riopomba.ifsudestemg.edu.br/dcc/ifgnu" target="_blank">IFGNU</strong></font></center><br>';
echo '<div>';
?>
