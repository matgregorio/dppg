<?php

include('includes/config.php');
include('acentuacao.php');

$cpf = mysql_real_escape_string($_POST[cpf]);
$profdepto = mysql_real_escape_string($_POST[profdepto]);
$pesquisa = mysql_real_escape_string($_POST[pesquisa]);
$visitante = mysql_real_escape_string($_POST[visitante]);

$sqlp = "select * from participantes where cpf='$cpf'";
$resultadop = mysql_query($sqlp);

if (mysql_num_rows($resultadop) > 0) {

    $sql = "update participantes set codigo_depto ='$profdepto', pesquisa='$pesquisa', visitante = '$visitante' where cpf='$cpf'";

    $resultado = mysql_query($sql);

    $sql1 = "insert into grupo_pro(codigo_grupo, cpf) values ('2','$cpf')";
    $resultado1 = mysql_query($sql1);

    echo '<center><font color="#006400"><b>Cadastro efetuado com sucesso!!!</b></font></center><br>';
    echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_profdepto.php" />';
} else {
    echo '<center><font color="#FF0000"><b>Cadastro não efetuado!!!<br> Participante não cadastrado</b></font></center><br>';
    echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_profdepto.php" />';
}
?>