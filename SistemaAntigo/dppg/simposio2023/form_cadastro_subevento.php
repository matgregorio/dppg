<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Cadastro Subevento </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/valida_cadastro_sube.js" type="text/javascript"></script>
    </head>
    <body>
    <?php

    include('includes/config.php');

    echo '<div id="conteudo3"><br>';

    echo '<center><b>Cadastro Subevento</b></center><br>';

    echo '<center>
				<form name="form_cadastro_subevento" method="post" onsubmit="javascript: return checkcontatos()" action="cadastro_subevento.php">  				
				<table border="0" width="100%"  class="esquerda">				
				<tr>
					<td align="center">Tipo:</td>
					<td><input type="text" name="nome_se" size="50"></td>
				</tr>
				<tr>
					<td align="center">Data:</td>
					<td>
						<input type="text" size="10" name="data" OnKeyUp="mascara_data(this.value)" maxlength="10"> dd/mm/aaaa<br>  
					</td>
				</tr>
				<tr>
					<td align="center">Horário:</td>
					<td><input type="text" size="5" name="hora" OnKeyUp="mascara_hora(this.value)" maxlength="5"> hh:mm<br></td>
				</tr>	
				<tr>
					<td align="center">Duração:</td>
					<td><input type="text" name="duracao" size="5">Minutos</td>
				</tr>	
				<tr>
					<td align="center">Palestrante:</td>
					<td><input type="text" name="palestrante" size="50"></td>
				</tr>		
				<tr>
					<td align="center">Vagas:</td>
					<td><input type="text" name="vagas" size="4"></td>
				</tr>
				<tr>
					<td align="center">Evento:</td>
					<td>';

    $sql = "select * from eventos";
    $resultado = mysql_query($sql);

    echo '<select size="1" name="evento">';

    while ($campos = mysql_fetch_array($resultado)) {
        echo "<option  value='$campos[codigo_evento]'>$campos[nome_evento]</option>";
    }
    echo '</select></td>
				</tr>		
				<tr>
					<td align="center">Local:</td>
					<td><input type="text" name="local" size="50"></td>
				</tr>		
				<tr>
					<td align="center">Titulo:</td>
					<td><input type="text" name="titulo" size="50"></td>
				</tr>		
				<tr>
					<td align="center">Descrição:</td>
					<td><textarea rows="10" cols="40" name="descricao"></textarea></td>
				</tr>		
				<tr>
					<td align="center">Lattes Palestrante:</td>
					<td><input type="text" name="lattes" size="50"></td>
				</tr>	
				<tr>
					<td align="center">Bloco:</td>
					<td><select name="bloco">
							';
    $sql1 = "select * from bloco order by codigo_bloco";
    $resultado1 = mysql_query($sql1);

    while ($campos1 = mysql_fetch_array($resultado1)) {
        echo "<option value='$campos1[codigo_bloco]'>$campos1[nome_bloco]</option>";
    }

    echo '
					</select></td>
				</tr>		
				<tr>
					<td></td>
					
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