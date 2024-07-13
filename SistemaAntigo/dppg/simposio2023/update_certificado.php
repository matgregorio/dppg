<?php

include('includes/config.php');
include('acentuacao.php');


$periodo = mysql_real_escape_string($_POST[periodo]);
$edicao = mysql_real_escape_string($_POST[edicao]);

$sql = "update conteudo set informacoes ='$periodo' where codigo_conteudo='11'";
$resultado = mysql_query($sql);

$sql1 = "update conteudo set informacoes ='$edicao' where codigo_conteudo='10'";
$resultado1 = mysql_query($sql1);

if (($resultado == 1) && ($resultado1 == 1)) {
    echo '<center><font color="#006400"><b> Período do Evento e Edição alterados com sucesso!!!</b></font></center>';
    echo '<meta http-equiv="refresh" content="3; URL=form_alterar_conteudo_certificado.php">';

}


?>