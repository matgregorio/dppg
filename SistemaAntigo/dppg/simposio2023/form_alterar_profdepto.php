<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Professor Área de Atuação </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    include('includes/config.php');

    echo '<div id="conteudo3"><br>';

    echo '<center><b>Alterar A.A.P.</b></center><br>';

    echo '<center>
				<form name="form_excluir_alterar" method="post" action="alterar_profdepto.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Selecione a Área de Atuação:&nbsp;
					';

    $sql = "select * from departamento order by nome_depto";
    $resultado = mysql_query($sql);

    echo '<select size="1" name="depto">';
    while ($campos = mysql_fetch_array($resultado)) {
        echo "<option value='$campos[codigo_depto]'>$campos[nome_depto]</option>";
    }
    echo '</select>
				<!--<input type="hidden" name="cpf" value="' . $campos[cpf] . '">-->
				</td>
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