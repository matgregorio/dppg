<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Departamentos </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php

    include('includes/config.php');

    $sql = "select * from departamento";
    $resultado = mysql_query($sql);

    echo '<div id="conteudo3">';
    echo '<br><center><b>Mostrar Área de Atuação</b></center><br>';

    echo '<center><table border="0" width="60%" class="esquerda">
			<tr bgcolor="#61C02D">
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Área de Atuação Cadastradas&nbsp;&nbsp;</i></b></font><center></td>			
			</tr>';

    while ($campos = mysql_fetch_array($resultado)) {

        echo '<tr class="linha">
					<td>' . $campos[nome_depto] . '</td>
				</tr>';
    }
    echo '</table></center><br></div>';
    ?>

    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>