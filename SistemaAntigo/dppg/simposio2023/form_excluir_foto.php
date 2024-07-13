<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Excluir Galeria de Fotos </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    include('includes/config.php');

    $sql = "select * from ano order by ano asc";
    $resultado = mysql_query($sql);


    echo '<div id="conteudo3"><br>';

    echo '<center><b>Excluir Foto</b></center><br>';

    echo '<center>
				<form name="form_excluir_foto" method="post" action="excluir_foto.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Selecione o ano que corresponde a pasta da foto:
					<select name="ano" size="1">';

    while ($campos = mysql_fetch_array($resultado)) {
        echo "<option value='$campos[codigo_ano]'>$campos[ano]</option>";
    }

    echo '</select>
				</td>
				</tr>
				</table>
				<input type="submit" value="OK">
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