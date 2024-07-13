<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Grande Área </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    echo '<div id="conteudo3"><br>';
    echo '<center><b>Alterar Grande Área</b></center><br>';
    ?>

    <?php

    include('includes/config.php');

    echo '<center>
				<form name="form_alterar_grandearea" method="post" action="alterar_grandearea.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Selecione a grande área:&nbsp;';

    $sql = "SELECT * FROM `grande_area` WHERE nome_ga not like '%-%' order by nome_ga";
    $resultado = mysql_query($sql);

    echo '<select size="1" name="grandearea">';

    while ($campos = mysql_fetch_array($resultado)) {
        echo "<option value='$campos[codigo_ga]'>$campos[nome_ga]</option>";
    }
    echo '</select>
				</td>
				</tr>
				<tr>					
					<td align="center"><input type="submit" value="OK"></td>
				</tr>
				<tr>
					<td><input type="hidden" name="alterar" value="S"></td>
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