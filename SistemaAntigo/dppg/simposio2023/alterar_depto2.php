<?php

include('includes/config.php');
include('acentuacao.php');

$nome_alt = mysql_real_escape_string($_POST[nome_alt]);
$alt = mysql_real_escape_string($_POST[alt]);
$codigo = mysql_real_escape_string($_POST[codigo]);

if (($nome_alt != "")) {
    if (($alt == "S")) {
        //echo $_POST[nome_alt];
        $sql2 = "update departamento set nome_depto='$nome_alt' where codigo_depto='$codigo'";
        $resultado2 = mysql_query($sql2);
        echo '<center><font color="#006400"><b>Alteração feita com sucesso!!!</b></font></center><br>';
        echo '<meta http-equiv="refresh" content="3; URL=form_alterar_depto.php" />';
    }
} else {
    echo '<center><font color="#ff0000"><b>Insira o nome da Área de Atuação!!!</b></font></center><br>';
    echo '<meta http-equiv="refresh" content="3; URL=form_alterar_depto.php" />';
}
?>
