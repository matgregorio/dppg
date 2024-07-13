<?php

include('includes/config.php');
include('funcao.php');

$sql_data = "select data_inicio, data_fim from formularios where codigo_formulario = '5'";
$resultado_data = mysql_query($sql_data);
$campos_data = mysql_fetch_array($resultado_data);

$data_inicio = datadobanco($campos_data[data_inicio]);
$data_fim = datadobanco($campos_data[data_fim]);

$data = $data_inicio;

$data_i = datasemcaracter($data_inicio);
$data_f = datasemcaracter($data_fim);

if ((date("Ymd") >= $data_i) && (date("Ymd") <= $data_f))
    include 'form_insc.php';

if ((date("Ymd") < $data_i))
    echo '<center><font color="#FF0000">Inscrição começará na data ' . $data . '.</font><center>';

if (date("Ymd") > $data_f)
    echo '<center><font color="#FF0000">Expirou a data de cadastro do simpósio!!!</font><center>';

mysql_close($conexao);
?>