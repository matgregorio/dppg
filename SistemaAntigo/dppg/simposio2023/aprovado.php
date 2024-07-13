<?php

include('includes/config.php');
$codigo = mysql_real_escape_string($_POST[codigot]);
$sql = "update trabalhos set situacao='Avaliado', aprovado = '1' where codigo_trab='$codigo'";
if ($resultado = mysql_query($sql)) {
    echo "<center><b>Trabalho Aprovado</b></center>";
    echo '<meta http-equiv="refresh" content="3; URL=avaliacao_analisador.php?codigo=' . $codigo . '" />';
}
mysql_close($conexao);
?>