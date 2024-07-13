<?php

include('includes/config.php');
include('acentuacao.php');

$codigopost = mysql_real_escape_string($_GET[codigo]);

$sql = "delete from backup where codigo_backup = '$codigopost'";
$resultado = mysql_query($sql);


if ($resultado == 1) {
    $dir = "Backup/";

    unlink($dir . $_GET[nome]);

    echo '<center><font color="#006400"><b>Backup Excluído com com Sucesso!</b></font></center>';
    echo '<meta http-equiv="refresh" content="3; URL=form_backup.php">';

}

mysql_close($conexao);

?>