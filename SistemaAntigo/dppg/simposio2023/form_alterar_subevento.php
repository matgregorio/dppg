<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Subeventos </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    echo '<div id="conteudo3"><br>';
    echo '<center><b>Alterar Subeventos</b></center><br>';
    ?>

    <?php

    include('includes/config.php');

    $sql = "select * from sub_eventos order by titulo asc";
    $resultado = mysql_query($sql);

    echo '<center>
				<form name="form_alterar_subevento" method="GET">  				
				
				<table border="0" width="100%" class="esquerda">				
				<tr bgcolor="#61C02D">
					<td align="center"><font color="#ffffff"><b>Título</b></font></td>
					<td align="center"><font color="#ffffff"><b>Alterar</b></font></td>
				</tr>';

    while ($campos = mysql_fetch_array($resultado)) {

        echo '<tr class="linha">
						<td>' . $campos[titulo] . '</td>
						<td align="center"><a href="alterar_subevento.php?codigo=' . $campos[codigo_sub_evento] . '&alterar=S"><img src="images/alterar.gif" border="0"></a></td>
					</tr>';

    }

    echo '</table>
				</form>';

    echo '</center>';

    echo '</div>';
    ?>

    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>