<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Cadastro Área de Atuação </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    echo '<div id="conteudo3"><br>';

    echo '<center><b>Cadastro Área de Atuação</b></center><br>';

    echo '<center>
				<form name="cadastro_depto" method="post" action="cadastro_depto.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Nome:&nbsp;<input type="text" name="depto" size="20"></td>
				</tr>
				<tr>
					<td align="center"><input type="submit" value="OK"></td>
				</tr>
				</table>
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