<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Grande Área </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php

    include('includes/config.php');

    $sql = "SELECT * FROM `grande_area` WHERE nome_ga not like '%-%' order by nome_ga";
    $resultado = mysql_query($sql);

    echo '<div id="conteudo3">';
    echo '<br><center><b>Mostrar</b></center><br>';

    echo '<center><table border="0" width="100%" class="esquerda">
			<tr bgcolor="#61C02D">
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Grande áreas Cadastradas&nbsp;&nbsp;</i></b></font><center></td>			
			</tr>';

    while ($campos = mysql_fetch_array($resultado)) {

        echo '<tr class="linha">
					<td>' . $campos[nome_ga] . '</td>
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
