<?php

include('includes/config.php');

$sql = "select topo from conteudo where codigo_conteudo = '1'";
$resultado = mysql_query($sql);

$campos = mysql_fetch_array($resultado);

echo '<img src="images/' . $campos[topo] . '" border="0" width="100%" height="100%">';

//echo '<img src="images/novalogo.png" border="0" width="100%" height="100%">';
?>
