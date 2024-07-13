<?php
session_start();
include('includes/config.php');
session_start();

$senha1 = mysql_real_escape_string($_POST[senha]);
$cpf = mysql_real_escape_string($_POST[cpf]);

$senha = md5($senha1);

$sql = "select cpf, senha, iniciacao from participantes where cpf='$cpf' and senha='$senha'";
$resultado = mysql_query($sql);

if ((mysql_num_rows($resultado) == 1)) {
    $campos = mysql_fetch_array($resultado);
    $sql1 = "select * from grupo_pro where cpf='$cpf'";
    $resultado1 = mysql_query($sql1);
    while ($campos1 = mysql_fetch_array($resultado1)) {
        $codigo_grupo[] = $campos1[codigo_grupo];
        $_SESSION[codigo_grupo] = $codigo_grupo;
    }

    if ($campos[iniciacao] == 'S')
        $_SESSION[trabalhos] = 'S';

    $_SESSION[logado_simposio_2021] = TRUE;
    $_SESSION[cpf] = $cpf;
    echo '<meta http-equiv="refresh" content="2; URL=simposio.php" />';
    echo '<br><center><font color="#006400"><b>Login efetuado com sucesso!</b></font></center><br>';
    //}
} else
    echo '<br><center><font color="#FF0000"><b>Não foi possível Acessar o Sistema <br> Tente Novamente!</b></font></center><br>';

mysql_close($conexao);
?>