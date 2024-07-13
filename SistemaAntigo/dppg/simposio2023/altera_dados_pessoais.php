<?php

if ($_SESSION[logado_simposio_2021]) {
    include('includes/config.php');

    $nome = mysql_real_escape_string($_POST[nome]);
    $nome = strtr(strtoupper($nome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß");

    $senha1 = mysql_real_escape_string($_POST[senha]);
    $senha = md5($senha1);

    $cpf = mysql_real_escape_string($_POST[cpf]);
    $email = mysql_real_escape_string($_POST[email]);
    $telefone = mysql_real_escape_string($_POST[telefone]);
    $participante = mysql_real_escape_string($_POST[participante]);
    //$curso = mysql_real_escape_string($_POST[curso]);
    $campus = mysql_real_escape_string($_POST[campus]);
    $subarea = mysql_real_escape_string($_POST[subarea]);
    $profdepto = mysql_real_escape_string($_POST[profdepto]);
    $pesquisa = mysql_real_escape_string($_POST[pesquisa]);
    $visitante = mysql_real_escape_string($_POST[visitante]);

    if ($participante == 3 || $participante == 5 || $participante == 6) {
        $sql = "UPDATE participantes SET cpf='$cpf', senha='$senha', nome='$nome', email='$email', telefone='$telefone', codigo_tipo_participante='$participante', codigo_curso='0', campus = '$campus',codigo_depto='$profdepto', codigo_sa='$subarea', pesquisa='$pesquisa', visitante='$visitante' WHERE cpf='$_SESSION[cpf]'";
        $sql1 = "INSERT INTO grupo_pro (codigo_grupo, cpf) VALUES ('2', '$cpf')";
    } else {
        $sql = "UPDATE participantes SET cpf='$cpf', senha='$senha', nome='$nome', email='$email', telefone='$telefone', codigo_tipo_participante='$participante', codigo_curso='0',campus = '$campus', codigo_depto='0', codigo_sa='0', pesquisa='', visitante='0' WHERE cpf='$_SESSION[cpf]'";
        $sql1 = "DELETE FROM grupo_pro WHERE cpf='$cpf'";
    }
    $resultado = mysql_query($sql);
    $resultado1 = mysql_query($sql1);
    //echo $sql;
    if ($resultado == 1) {
        echo '<br><br><center><font color="#006400"><b>Dados Pessoais atualizados com sucesso!</b></font></center><br>';
        echo '<meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=form_alt.php">';
    } else
        echo '<br><br><center><font color="#FF0000"><b>Erro na atualização!</b></font></center><br>';

    mysql_close($conexao);
}
?>
