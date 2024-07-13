<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Backup</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021]) {

        include('includes/config.php');

        echo "<div id='conteudo3'>
				<br>
				<center><b>Backup</b><br><br></center>
				";


        echo "<center>
						Faça o Backup da Base de Dados clicando no Link <Backup>:<a href='backup.php'>Backup</a>
						<br><br><br>
						<form name='backup' method='GET'>
						
						<table border='0' class='esquerda'>
							<tr align='center' bgcolor='#61C02D'>
								<td><font color='#FFFFFF'><b>Arquivo</b></font></td>
								<td><font color='#FFFFFF'><b>Data</b></font></td>
								<td><font color='#FFFFFF'><b>Hora</b></font></td>
								<td><font color='#FFFFFF'><b>Excluir</b></font></td>
							</tr>
					 ";


        $sql_backup = "select * from backup order by data desc, hora desc";
        $resultado_backup = mysql_query($sql_backup);


        while ($campos_backup = mysql_fetch_array($resultado_backup)) {

            echo '<tr class="linha">
					 					<td><a href="Backup/' . $campos_backup[arquivo] . '">' . $campos_backup[arquivo] . '</a></td>
					 					<td>' . $campos_backup[data] . '</td>
					 					<td>' . $campos_backup[hora] . '</td>
					 					<td align="center"><a href="excluir_backup.php?codigo=' . $campos_backup[codigo_backup] . '&nome=' . $campos_backup[arquivo] . '">
					 					<img src="images/delete.png" width="50%" border="0"></a></td>
					 				</tr>';
        }

        echo "</table>
				</form>
				</center>";

    }

    mysql_close($conexao);
    ?>
    </body>
    </html>
<?php
}
?>