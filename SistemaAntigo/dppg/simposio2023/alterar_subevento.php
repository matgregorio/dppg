<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
<title> Alterar Subevento </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/valida_cadastro_sube.js"  type="text/javascript"></script>
</head>
<body>
<?php
    echo '<div id="conteudo3"><br>';
    echo '<center><b>Alterar Subeventos</b></center><br>';
    ?>

    <?php

    include('includes/config.php');

    $alt = mysql_real_escape_string($_POST[alt]);
    if ($alt == "S") {

        //echo $_POST[nome_alt];
        /*$sql2 = "update departamento set nome_depto='$_POST[nome_alt]' where codigo_depto='$_POST[codigo]'";
        $resultado2 = mysql_query($sql2);*/

        $entrada = trim($_POST["data"]);
        if (strstr($entrada, "/")) {
            $aux2 = explode("/", $entrada);
            $datai = $aux2[2] . "-" . $aux2[1] . "-" . $aux2[0];
        }

        $nome_se = mysql_real_escape_string($_POST[nome_se]);
        $duracao = mysql_real_escape_string($_POST[duracao]);
        $palestrante = mysql_real_escape_string($_POST[palestrante]);
        $vagas = mysql_real_escape_string($_POST[vagas]);
        $evento = mysql_real_escape_string($_POST[evento]);
        $local = mysql_real_escape_string($_POST[local]);
        $titulo = mysql_real_escape_string($_POST[titulo]);
        $descricao = mysql_real_escape_string($_POST[descricao]);
        $lattes = mysql_real_escape_string($_POST[lattes]);
        $bloco = mysql_real_escape_string($_POST[bloco]);
        $codigopost = mysql_real_escape_string($_POST[codigo]);

        $sql3 = " update sub_eventos set nome_sub_evento = '$nome_se', data ='$datai', horario='$_POST[hora]',
		duracao='$duracao', palestrante='$palestrante' , vagas ='$vagas', codigo_evento='$evento',
		local ='$local', titulo ='$titulo', descricao='$descricao', lattes_participante = '$lattes', codigo_bloco = '$bloco' where codigo_sub_evento='$codigopost'";
        $resultado = mysql_query($sql3);

        echo '<center><font color="#006400"><b>Alteração feita com sucesso!!!</b></font></center><br>';
        echo '<meta http-equiv="refresh" content="1; URL=form_alterar_subevento.php" />';
    }

    ?>

    <?php

    include('includes/config.php');

    $alterar = mysql_real_escape_string($_GET[alterar]);
    $codigo = mysql_real_escape_string($_GET[codigo]);

    if ($alterar == "S") {
        $sql4 = "SELECT * FROM sub_eventos se, eventos e where se.codigo_evento = e.codigo_evento and se.codigo_sub_evento ='$codigo'";
        $resultado4 = mysql_query($sql4);
        $campos = mysql_fetch_array($resultado4);

        $string = $campos[data];
        $entrada = trim("$string");
        if (strstr($entrada, "-")) {
            $aux2 = explode("-", $entrada);
            $datai2 = $aux2[2] . "/" . $aux2[1] . "/" . $aux2[0];
        }

        //$sql5 = "select * from eventos where "

        echo '<form name="form_cadastro_subevento" method="post" onsubmit="javascript: return checkcontatos()" action="alterar_subevento.php">
		 		<center>						
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Tipo:</td>
					<td><input type="text" name="nome_se" size="50" value="' . $campos[nome_sub_evento] . '"></td>
				</tr>
				<tr>
					<td align="center">Data:</td>
					<td>
						<input type="text" size="10" name="data" OnKeyUp="mascara_data(this.value)" maxlength="10" value="' . $datai2 . '"> dd/mm/aaaa<br>
					</td>
				</tr>
				<tr>
					<td align="center">Horário:</td>
					<td><input type="text" size="5" name="hora" OnKeyUp="mascara_hora(this.value)" maxlength="5" value="' . $campos[horario] . '"> hh:mm<br></td>
				</tr>	
				<tr>
					<td align="center">Duração:</td>
					<td><input type="text" name="duracao" size="5" value="' . $campos[duracao] . '">Minutos</td>
				</tr>	
				<tr>
					<td align="center">Palestrante:</td>
					<td><input type="text" name="palestrante" size="50" value="' . $campos[palestrante] . '"></td>
				</tr>		
				<tr>
					<td align="center">Vagas:</td>
					<td><input type="text" name="vagas" size="4" value="' . $campos[vagas] . '"></td>
				</tr>
				<tr>
					<td align="center">Evento:</td>
					<td>';

        $sql1 = "select * from eventos";
        $resultado1 = mysql_query($sql1);

        echo '<select size="1" name="evento">';

        while ($campos1 = mysql_fetch_array($resultado1)) {
            if ($campos1[codigo_evento] == $campos[codigo_evento])
                echo "<option  value='$campos1[codigo_evento]' selected>$campos1[nome_evento]</option>";
            else
                echo "<option  value='$campos1[codigo_evento]'>$campos1[nome_evento]</option>";
        }
        echo '</select></td>
				</tr>		
				<tr>
					<td align="center">Local:</td>
					<td><input type="text" name="local" size="50" value="' . $campos[local] . '"></td>
				</tr>		
				<tr>
					<td align="center">Titulo:</td>
					<td><input type="text" name="titulo" size="50" value="' . $campos[titulo] . '"></td>
				</tr>		
				<tr>
					<td align="center">Descrição:</td>
					<td><textarea rows="10" cols="40" name="descricao">' . $campos[descricao] . '</textarea></td>
				</tr>		
				<tr>
					<td align="center">Lattes Palestrante:</td>
					<td><input type="text" name="lattes" size="50" value="' . $campos[lattes_participante] . '"></td>
				</tr>
				<tr>
					<td align="center">Bloco:</td>
					<td><select name="bloco">';

        $sql2 = "select * from bloco order by nome_bloco";
        $resultado2 = mysql_query($sql2);

        while ($campos2 = mysql_fetch_array($resultado2)) {
            if ($campos2[codigo_bloco] == $campos[codigo_bloco])
                echo "<option value='$campos2[codigo_bloco]' selected >$campos2[nome_bloco]</option>";
            else
                echo "<option value='$campos2[codigo_bloco]'>$campos2[nome_bloco]</option>";
        }

        echo '</select></td>
				</tr>		
				<tr>
					<td><input type="hidden" name="codigo" value="' . $campos[codigo_sub_evento] . '"></td>
					<td><input type="hidden" name="alt" value="S"></td>				
				</tr>
				</table>
						<br>
		 				<br>
		 				<input type="submit" value="OK">
				</form>	 			
		 		</center>
		 	<br>';
    }
    ?>

</body>
</html>
<?php
    mysql_close($conexao);
}
?>