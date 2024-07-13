<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>
    <title> Excluir Representante Sub área </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php

include('includes/config.php');

$sql = "select * from sub_area order by nome_sa";
$resultado = mysql_query($sql);

$sql1 = "select * from participantes where iniciacao ='S' order by nome";
$resultado1 = mysql_query($sql1);

echo '<div id="conteudo3"><br>';

echo '<center><b><i>Excluir</i></b></center><br></center>';

echo '<center>
				<form name="form_excluir_profsa" method="post" action="excluir_profsa.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					 <i>Professores</i>
					<td align="center">Selecione a Sub área:
					<select name="sa" size="1">';

while ($campos = mysql_fetch_array($resultado)) {
    echo "<option value='$campos[codigo_sa]'>$campos[nome_sa]</option>";
}

echo '</select>
					 </td>
				</tr>
				</table>
				<input type="submit" value="OK">
				</form></center>';

?>

<?php
if ($_POST[excluir] == 'S') {

    $ic = mysql_real_escape_string($_POST[ic]);

    $sql3 = "delete from participantes where cpf='$ic'";
    $resultado3 = mysql_query($sql3);

    $sql4 = "delete from inscricao where cpf='$ic'";
    $resultado4 = mysql_query($sql4);

    echo '<center><b><i>Exclusão feita com sucesso !!!</i></b></center><br>';
    echo '<meta http-equiv="refresh" content="1; URL=form_excluir_profsa.php" />';
}

echo '<center><form name="form_excluir_aluno" method="POST" action="form_excluir_profsa.php">
				<table border="0" width="100%" class="esquerda">				
				<tr>
					 <i>Alunos Iniciação Científica e Tecnológica</i>
					<td align="center">Selecione o aluno:
					<select name="ic" size="1">';

while ($campos1 = mysql_fetch_array($resultado1)) {
    echo "<option value='$campos1[cpf]'>$campos1[nome]</option>";
}

echo '</select>
					 </td>
				</tr>
				</table>
				<input type="hidden" name="excluir" value="S">
				<input type="submit" value="OK">
				</form>';


echo '</center></div>';
?>

</body>
</html>
