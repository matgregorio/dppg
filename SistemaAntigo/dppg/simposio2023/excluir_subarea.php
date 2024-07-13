<?php
include('includes/config.php');
include('acentuacao.php');

$subarea = mysql_real_escape_string($_POST[subarea]);

$sql = "delete  from sub_area where codigo_sa = '$subarea'";
$resultado = mysql_query($sql);

echo '<center><font color="#006400"><b>Exclusão feita com sucesso !!!</b></font></center><br>';
echo '<meta http-equiv="refresh" content="3; URL=form_excluir_subarea.php" />';
?>