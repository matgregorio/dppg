<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');

    include('includes/config.php');
    $codigo = mysql_real_escape_string($_POST[codigo]);
    $titulo = mysql_real_escape_string($_POST[titulo]);
    $autores = mysql_real_escape_string($_POST[autores]);
    $palavra = mysql_real_escape_string($_POST[palavra]);

    if (mysql_query("UPDATE acervo SET titulo='$titulo', autores='$autores', palavra_chave='$palavra' WHERE codigo_acervo='$codigo'")) {
        echo '<br><center><font color="#006400"><b>Alteração efetuada com sucesso!</b></font></center><br><br>';
        echo '<meta http-equiv="refresh" content="3; URL=form_selecionar_acervo.php" />';
    }
}
?>