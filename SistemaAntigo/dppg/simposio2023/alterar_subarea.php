<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Subárea </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/validasubarea1.js" type="text/javascript"></script>
    </head>
    <body>
    <div id="conteudo3"><br>
        <center><b>Alterar Subárea</b></center>
        <br>
        <?php
        include('includes/config.php');
        $cpf = mysql_real_escape_string($_POST[cpf]);
        $nome_sa = mysql_real_escape_string($_POST[nome_sa]);
        $grandearea = mysql_real_escape_string($_POST[grandearea]);
        $codigop = mysql_real_escape_string($_POST[codigo]);

        if ($_POST[alt] == "S") {
            $sql3 = "UPDATE sub_area SET nome_sa = '$nome_sa'codigo_ga = '$grandearea' WHERE codigo_sa ='$codigop'";
            $resultado = mysql_query($sql3);

            echo '<center><font color="#006400"><b>Alteração feita com sucesso!!!</b></font></center><br>';
            echo '<meta http-equiv="refresh" content="3; URL=form_alterar_subarea.php" />';
        }
        $alterar = mysql_real_escape_string($_POST[alterar]);
        $subarea = mysql_real_escape_string($_POST[subarea]);

        if ($alterar == "S") {
            $sql4 = "SELECT * FROM sub_area sa, grande_area ga WHERE sa.codigo_ga = ga.codigo_ga AND sa.codigo_sa ='$subarea'";
            $resultado4 = mysql_query($sql4);
            $campos = mysql_fetch_array($resultado4);
            ?>
		<form name="form_alterar" method="post" onsubmit="javascript: return checkcontatos()" action="alterar_subarea.php">
			<center>
				<table border="0" width="100%" class="esquerda">
					<tr>
						<td align="center">Nome subárea:</td>
						<?php echo "<td><input type='text' name='nome_sa' size='50' value='$campos[nome_sa]'></td>";?>
					</tr>
					<tr>
						<td align="center">Grande área:</td>
						<td>
							<?php
            $sql1 = "select * from grande_area";
            $resultado1 = mysql_query($sql1);

            echo '<select size="1" name="grandearea">';

            while ($campos1 = mysql_fetch_array($resultado1)) {
                if ($campos1[codigo_ga] == $campos[codigo_ga])
                    echo "<option  value='$campos1[codigo_ga]' selected>$campos1[nome_ga]</option>";
                else
                    echo "<option  value='$campos1[codigo_ga]'>$campos1[nome_ga]</option>";
            }
            ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><input type="hidden" name="codigo" value="'.$campos[codigo_sa].'"></td>
						<td><input type="hidden" name="alt" value="S"></td>
					</tr>
				</table>
				<input type="submit" value="OK">
		</form>
		</center>
		<br>
		<?php
        }
        ?>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>