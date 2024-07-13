<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Excluir Subevento </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    include('includes/config.php');


    $sql = "SELECT * FROM sub_eventos se, eventos e where se.codigo_evento = e.codigo_evento order by se.codigo_evento, titulo";
    $resultado = mysql_query($sql);

    echo '<div id="conteudo3"><br>';

    echo '<center><b>Excluir Subeventos</b></center><br>';

    echo '<center>
				<form name="form_excluir_subevento" method="GET">  				
				
				<table border="0" width="100%" class="esquerda">				
				<tr bgcolor="#61C02D">
					<td align="center"><font color="#ffffff"><b>Título</b></font></td>
					<td align="center"><font color="#ffffff"><b>Excluir</b></font></td>
				</tr>';

    while ($campos = mysql_fetch_array($resultado)) {
        echo '<tr class="linha">
						<td>' . $campos[titulo] . '</td>
						<td align="center"><a href="excluir_subevento.php?codigo=' . $campos[codigo_sub_evento] . '"><img src="images/delete.png" border="0"></a></td>
					</tr>';
    }
    echo '</table>
				</form>
				</center>';


    echo '</div>';
    ?>

    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>