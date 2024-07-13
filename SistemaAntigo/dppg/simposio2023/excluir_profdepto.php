<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>
    <title> Excluir Professor Área de Atuação </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php

echo '<div id="conteudo3"><br>';

echo '<center><b>Excluir A.A.P.</b></center><br>';


if ($_POST[alterar] == "S") {
    include('includes/config.php');

    $prof = mysql_real_escape_string($_POST[prof]);

    $sql1 = "update participantes set codigo_depto = '0', pesquisa='', visitante='2' where cpf = '$prof'";
    $resultado1 = mysql_query($sql1);

    $sql2 = "delete from grupo_pro where codigo_grupo='2' and cpf='$prof'";
    $resultado2 = mysql_query($sql2);

    echo '<center><font color="#006400"><b>Exclusão feita com sucesso !!!</b></font></center><br>';
    echo '<meta http-equiv="refresh" content="3; URL=form_excluir_profdepto.php" />';
}


?>

<?php

include('includes/config.php');

echo '<center>
				<form name="form_excluir_profdepto1" method="post" action="excluir_profdepto.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Selecione o Professor:&nbsp;
					';

$sql = "select * from participantes p, grupo_pro gp where p.cpf = gp.cpf and p.codigo_depto='$_POST[depto]'  and codigo_grupo = '2'  order by nome";
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
					<input type="hidden" name="alterar" value="S"></td>
				</tr>
				</table>
				</form>
				</center>';


echo '</div>';
?>

</body>
</html>