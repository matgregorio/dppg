<?php

include('includes/config.php');

$funcao = mysql_real_escape_string($_GET[f]);
$cpf = mysql_real_escape_string($_GET[cc]);
$area = mysql_real_escape_string($_GET[a]);

if ($funcao == 'ca') {
    if ($query = mysql_query("INSERT INTO grupo_pro (codigo_grupo, cpf, area) VALUE ('7','$cpf','$area')")) {
        echo '<br><center><font color="#006400"><b>Cadastrado com sucesso!!!</b></font></center><br>';
    } else {
        echo '<br><center><font color="#FF0000"><b>Erro no Cadastro!!!</b></font></center><br>';
    }
} elseif ($funcao == 'ex') {
    if ($query = mysql_query("DELETE FROM grupo_pro WHERE cpf='$cpf' AND codigo_grupo='7'")) {
        echo '<br><center><font color="#006400"><b>Permissão retirada com sucesso!!!</b></font></center><br>';
    } else {
        echo '<br><center><font color="#FF0000"><b>Erro ao retirar a permissão!!!</b></font></center><br>';
    }
}
mysql_close();
?>
