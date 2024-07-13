<?php

include('includes/config.php');

$situacao = "Avaliado";
$codigo = mysql_real_escape_string($_POST[codigot]);
$sql = "update trabalhos set situacao='$situacao', aprovado = '0' where codigo_trab='$codigo'";
$resultado = mysql_query($sql);

echo '<meta http-equiv="refresh" content="1; URL=avaliacao_analisador.php?codigo=' . $codigo . '" />';
?>