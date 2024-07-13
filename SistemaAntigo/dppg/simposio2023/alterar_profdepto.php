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
				<form name="form_alterar_profdepto1" method="post" action="alterar_profdepto1.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Selecione o Professor:&nbsp;
					';

    $depto = mysql_real_escape_string($_POST[depto]);

    $sql = "select * from participantes p, grupo_pro gp where p.cpf = gp.cpf and codigo_grupo = '2' and
		codigo_depto = '$depto' order by nome";
    $resultado = mysql_query($sql);

    echo '<select size="1" name="prof">';
    while ($campos = mysql_fetch_array($resultado)) {
        echo "<option value='$campos[cpf]'>$campos[nome]</option>";
    }
    echo '</select>
				</td>
				</tr>
				<tr>
					<td align="center"><input type="submit" value="OK">
					<!--<input type="hidden" name="alterar" value="S">--></td>
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