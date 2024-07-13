<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>
    <title> Alterar Professor Área de Atuação </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/validaprofdepto.js" type="text/javascript"></script>
</head>
<body>
<?php
include('includes/config.php');

echo '<div id="conteudo3"><br>';
echo '<center><b>Alterar Professores Área de Atuação</b></center><br>';

$depto = mysql_real_escape_string($_POST[depto]);
$cpf = mysql_real_escape_string($_POST[cpf]);
$profdepto = mysql_real_escape_string($_POST[profdepto]);
$pesquisa = mysql_real_escape_string($_POST[pesquisa]);
$visitante = mysql_real_escape_string($_POST[visitante]);
$cpfold = mysql_real_escape_string($_POST[cpfold]);

if ($_POST[alterar] == "S") {
    $sql2 = "update grupo_pro set cpf='$cpf' where cpf='$cpfold'";
    $resultado2 = mysql_query($sql2);

    $sql3 = "update participantes set codigo_depto='$profdepto', pesquisa='$pesquisa',
		visitante='$visitante' where cpf='$cpfold'";
    $resultado3 = mysql_query($sql3);

    echo '<center><font color="#006400"><b>Alteração feita com sucesso!!!</b></font></center><br>';
    echo '<meta http-equiv="refresh" content="3; URL=form_alterar_profdepto.php" />';
}

?>
<?php

include('includes/config.php');


echo '<center>
				<form name="form_cadastro_profdepto" method="post" onsubmit="javascript: return checkcontatos()"  action="alterar_profdepto1.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">CPF Professor (a):</td>
					<td>';

$prof = mysql_real_escape_string($_POST[prof]);

$sql1 = "select * from participantes where cpf='$prof'";
$resultado1 = mysql_query($sql1);
$campos1 = mysql_fetch_array($resultado1);

echo '<input type="text" name="cpf" size="11" value="' . $campos1[cpf] . '" maxlength="11"><font color="#FF0000">*</font> Somente Números
							<input type="hidden" name="cpfold" value="' . $campos1[cpf] . '">';

echo '</td>
				</tr>
				<tr>
					<td align="center">Área de Atuação:</td>
					<td>';

$sql = "select * from departamento";
$resultado = mysql_query($sql);

echo '<select size="1" name="profdepto">';

while ($campos = mysql_fetch_array($resultado)) {
    if ($campos[codigo_depto] == $campos1[codigo_depto])
        echo "<option value=$campos[codigo_depto] selected > $campos[nome_depto]</option>";
    else
        echo "<option value=$campos[codigo_depto]> $campos[nome_depto]</option>";
}

echo '</td>
				</tr>	
				<tr>
					<td align="center">Linha de Pesquisa: </td>	
					<td><input type="text" name="pesquisa" size="40" maxlength="100" value="' . $campos1[pesquisa] . '"></td>
				</tr>
				<tr>
					<td align="center">Visitante: </td>	
					<td>';

if ($campos1[visitante] == 1) {
    echo '<input type="radio" name="visitante" value="1" checked>Sim
								<input type="radio" name="visitante" value="0">Não';
} else {
    echo '<input type="radio" name="visitante" value="1">Sim
								<input type="radio" name="visitante" value="0" checked>Não';
}
echo '</td>
				</tr>
				</table>
				<input type="hidden" name="alterar" value="S">
				<input type="submit" value="OK">
				</form>
				</center>';
echo '</div>';
?>

</body>
</html>
