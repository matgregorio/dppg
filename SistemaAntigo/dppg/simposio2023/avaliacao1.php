<?php

include('includes/config.php');

$situacao = "Autor deve fazer alteração";

$codigot = mysql_real_escape_string($_POST[codigot]);
$observacao = mysql_real_escape_string($_POST[observacao]);

$sql = "update trabalhos set situacao = '$situacao' where codigo_trab='$codigot'";
$resultado = mysql_query($sql);

$sql1 = "select * from trabalhos where codigo_trab='$codigot'";
$resultado1 = mysql_query($sql1);
$campos = mysql_fetch_array($resultado1);

$sql2 = "insert into historico (codigo_historico, cpf_prof_analisador, codigo_trab, observacao, cpf) values ('', '$campos[cpf_prof_analisador]', '$campos[codigo_trab]', '$observacao', '$campos[cpf]')";
$resultado2 = mysql_query($sql2);

echo '<meta http-equiv="refresh" content="3; URL=avaliacao_analisador.php?codigo=' . $codigot . '" />';
?>