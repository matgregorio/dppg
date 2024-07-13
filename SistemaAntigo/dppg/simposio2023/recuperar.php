<?php

session_start();

include('includes/config.php');
include('acentuacao.php');

$dir = "/tmp/";

$arquivo = $_FILES[arquivo][name];

if (eregi(".sql", $_FILES[arquivo]["name"])) {

    $numero = rand(1000, 10000);
    $arquivo = "BD_" . $numero . ".sql";

    if (move_uploaded_file($_FILES[arquivo][tmp_name], $dir . $arquivo)) {
        $restaurar = 'mysql -u ' . $usuario . ' -p' . $senha . ' -e "source ' . $dir . $arquivo . '"';
        system($restaurar);

        echo '<center><font color="#006400"><b>Banco de Dados Restaurado com Sucesso!</b></font></center>';
        echo '<meta http-equiv="refresh" content="3; URL=form_recuperar.php">';
    } else
        echo "Não foi possível enviar o arquivo para o Servidor!!!<br>";


    unlink($dir . $arquivo);
} else {
    echo '<center><font color="#FF0000"><b>Arquivo em formato inválido! O Arquivo deve ser no formato .sql</b></font></center>';
    echo '<meta http-equiv="refresh" content="3; URL=form_recuperar.php">';
}
?>