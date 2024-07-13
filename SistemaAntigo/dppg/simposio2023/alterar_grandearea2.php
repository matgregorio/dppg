<?php


include('includes/config.php');
include('acentuacao.php');

$alt = mysql_real_escape_string($_POST[alt]);
$nome_alt = mysql_real_escape_string($_POST[nome_alt]);
$codigo = mysql_real_escape_string($_POST[codigo]);

if ($alt == "S") {

    //echo $_POST[nome_alt];
    $sql2 = "update grande_area set nome_ga='$nome_alt' where codigo_ga='$codigo'";
    $resultado2 = mysql_query($sql2);

    echo '<center><font color="#006400"><b>Alteração feita com sucesso!!!</b></font></center><br>';
    echo '<meta http-equiv="refresh" content="3; URL=form_alterar_grandearea.php" />';
} else
    echo '<center><font color="#FF0000"><b>Insira o nome da Grande Área</b></font></center><br>';

?>