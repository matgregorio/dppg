<?php

include('includes/config.php');
include('acentuacao.php');

$grandearea = mysql_real_escape_string($_POST[grandearea]);

if ($grandearea != "") {
    $sql = "insert into grande_area (codigo_ga, nome_ga) values ('','$grandearea')";
    $resultado = mysql_query($sql);
    echo '<center><font color="#006400"><b>Cadastro feito com sucesso!!!</b></font></center><br>';
} else
    echo '<center><font color="#FF0000"><b>Insira o nome da Grande Área</b></font></center><br>';

echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_grandearea.php" />';
?>