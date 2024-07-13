<?php

include('includes/config.php');
include('acentuacao.php');

$sql = "delete  from grande_area where codigo_ga = '$_POST[grandearea]'";
$resultado = mysql_query($sql);

$sql1 = "select cpf from sub_area where codigo_ga='$_POST[grandearea]'";
$resultado1 = mysql_query($sql1);

while ($campos = mysql_fetch_array($resultado1)) {
    $sql2 = "delete from grupo_pro where cpf='$campos[cpf]'";
    $resultado2 = mysql_query($sql2);
}

$sql3 = "delete from sub_area where codigo_ga = '$_POST[grandearea]'";
$resultado3 = mysql_query($sql3);

echo '<center><font color="#006400"><b>Exclusão feita com sucesso !!!</b></font></center><br>';
echo '<meta http-equiv="refresh" content="3; URL=form_excluir_grandearea.php" />';
?>