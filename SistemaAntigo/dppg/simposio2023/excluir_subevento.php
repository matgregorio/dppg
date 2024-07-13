<?php

include('includes/config.php');
include('acentuacao.php');

$codigo = mysql_real_escape_string($_GET[codigo]);

$sql = "delete  from sub_eventos where codigo_sub_evento = '$codigo'";
$resultado = mysql_query($sql);

echo '<center><font color="#006400"><b>Exclusão feita com sucesso !!!</b></font></center><br>';
echo '<meta http-equiv="refresh" content="3; URL=form_excluir_subevento.php" />';
?>