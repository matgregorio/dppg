<?php

session_start();

if (in_array("1", $_SESSION[codigo_grupo])) {
    include('includes/config.php');
    include('acentuacao.php');

    $data = date('Y-m-d');
    $hora = date('H:i');

    $numero = rand(1000, 10000);
    chmod("Backup/", 777);

    $arquivo = "BD_" . $numero . ".sql";


    $sql = "insert into backup (codigo_backup, arquivo, data, hora, cpf)
		values ('','$arquivo', '$data', '$hora', '$_SESSION[cpf]')";
    $resultado = mysql_query($sql);

    if ($resultado == 1) {

        //$backup = "mysqldump --add-drop-table -u ".$usuario." -p".$senha." -B ".$banco." > Backup/".$arquivo."";
        //mysqldump --all-databases -u root -p --result-file=mysql.txt
        $backup = "mysqldump --all-databases -u " . $usuario . " -p" . $senha . " --result-file=Backup/" . $arquivo . "";
        system($backup);

        echo '<center><font color="#006400"><b>Backup Efetuado com Sucesso!</b></font></center>';
        echo '<meta http-equiv="refresh" content="3; URL=form_backup.php">';

    }

    mysql_close($conexao);
}
?>