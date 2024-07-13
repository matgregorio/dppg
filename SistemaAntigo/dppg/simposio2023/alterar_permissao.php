<?php
include('includes/config.php');

$funcao = mysql_real_escape_string($_GET[f]);
$codigo = mysql_real_escape_string($_GET[c]);
$cpf = mysql_real_escape_string($_GET[cc]);
$area = mysql_real_escape_string($_GET[a]);
echo "$area";

if ($funcao == 'ca') {
    if ($query = mysql_query("INSERT INTO grupo_pro (codigo_grupo, cpf, area) VALUE ('$codigo','$cpf','$area')")) {
        echo '<br><center><font color="#006400"><b>Permição dada com sucesso!!!</b></font></center><br>';
    } else {
        echo '<br><center><font color="#006400"><b>Erro ao dar a permissão!!!</b></font></center><br>';
    }
} elseif ($funcao == 'ex') {
    if ($query = mysql_query("DELETE FROM grupo_pro WHERE cpf='$cpf' AND codigo_grupo='$codigo'")) {
        echo '<br><center><font color="#006400"><b>Permição retirada com sucesso!!!</b></font></center><br>';
    } else {
        echo '<br><center><font color="#006400"><b>Erro ao retirar a permissão!!!</b></font></center><br>';
    }
}
?>
