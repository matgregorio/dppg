<?php

include('includes/config.php');
include('acentuacao.php');

$depto = mysql_real_escape_string($_POST[depto]);

$sql = "delete  from departamento where codigo_depto = '$depto'";
$resultado = mysql_query($sql);

echo '<center><font color="#006400"><b>Exclusão feita com sucesso !!!</b></font></center><br>';
echo '<meta http-equiv="refresh" content="3; URL=form_excluir_depto.php" />';
?>