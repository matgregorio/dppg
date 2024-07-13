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

echo '<div id="conteudo3"><br>';

echo '<center><b><i>Excluir</i></b></center><br>';


if ($_POST[alterar] == "S") {
    include('includes/config.php');

    $sa1 = mysql_real_escape_string($_POST[sa1]);

    $sql2 = "delete from sub_area where cpf_representante = '$sa1'";
    $resultado2 = mysql_query($sql2);

    $sql1 = "delete from participantes where cpf='$sa1'";
    $resultado1 = mysql_query($sql1);

    $sql4 = "delete from inscricao where cpf='$sa1'";
    $resultado4 = mysql_query($sql4);

    echo '<center><b><i>Exclusão feita com sucesso !!!</i></b></center><br>';
    echo '<center><b><i>Sub área com o cpf do professor representante foi excluída!!!</i></b></center><br>';
    echo '<meta http-equiv="refresh" content="1; URL=form_excluir_profsa.php" />';
}


?>

<?php

include('includes/config.php');

echo '<center>
				<form name="form_excluir_profsa" method="post" action="excluir_profsa.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Selecione o Representante da Sub área:&nbsp;
					';
$sa = mysql_real_escape_string($_POST[sa]);

$sql = "select * from sub_area sa, participantes p where sa.cpf = p.cpf and codigo_sa = '$sa'";
$resultado = mysql_query($sql);

echo '<select size="1" name="sa1">';
while ($campos = mysql_fetch_array($resultado)) {
    echo "<option value='$campos[cpf_representante]'>$campos[nome]</option>";
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