<?php
header('Content-Type: text/html; charset=utf-8');

include('includes/config.php');

$nome_sa = mysql_real_escape_string($_POST[nome_sa]);
$grandearea = mysql_real_escape_string($_POST[grandearea]);

$sql = "insert into sub_area(codigo_sa, nome_sa, codigo_ga) values ('','$nome_sa', '$grandearea')";
if ($resultado = mysql_query($sql)) {
    echo '<center><font color="#000000"><b><i>Cadastro feito com sucesso!!!</i></b></font></center><br>';
    echo '<meta http-equiv="refresh" content="1; URL=form_cadastro_subarea.php" />';
} else {
    echo '<center><font color="#000000"><b><i>Cadastro não efetuado!!!</i></b></font></center><br>';
    echo '<meta http-equiv="refresh" content="2; URL=form_cadastro_profdepto.php" />';
}
?>