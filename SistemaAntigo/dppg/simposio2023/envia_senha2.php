<?php

session_start();

include('includes/config.php');

$senha = md5($_POST[senha]);

$sql = "update participantes set senha = '$senha' where cpf= '$_SESSION[troca_senha]'";
$resultado = mysql_query($sql);

if ($resultado == 1) {
    echo '<center><br><font color="#006400"><b>Senha alterada com Sucesso!!!<br>Acesso ao sistema já pode ser feito.</b></font><br><br>';
    echo '<meta http-equiv="refresh" content="3; URL=simposio.php">';

}

?>