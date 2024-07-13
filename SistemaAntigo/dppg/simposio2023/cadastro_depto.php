<?php

include('includes/config.php');
include('acentuacao.php');

$depto = mysql_real_escape_string($_POST[depto]);
if ($depto != "") {
    $sql = "insert into departamento (codigo_depto, nome_depto) values ('','$depto')";
    $resultado = mysql_query($sql);
    echo '<center><font color="#006400"><b>Cadastro feito com sucesso!!!</b></font></center><br>';
} else
    echo '<center><font color="#FF0000"><b>Insira o nome da Área de Atuação</b></font></center><br>';

echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_depto.php" />';
?>