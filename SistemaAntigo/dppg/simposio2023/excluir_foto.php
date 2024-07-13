<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>
    <title> Excluir Foto Galeria de Fotos </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php

echo '<div id="conteudo3"><br>';

echo '<center><b>Excluir Foto</b></center><br>';


if ($_POST[alterar] == "S") {
    include('includes/config.php');

    $ano1 = mysql_real_escape_string($_POST[ano1]);

    $sql1 = "select * from album alb, ano a  where alb.pasta = a.codigo_ano and
		alb.pasta = '$ano1'";
    $resultado1 = mysql_query($sql1);
    $campos1 = mysql_fetch_array($resultado1);

    //echo $_POST[ano1];
    chmod('images/fotos/', 777);

    $pasta = $campos1[ano];
    //echo $pasta;
    $dir = "images/fotos/" . $pasta . "/";
    //echo $dir;

    $arquivo1 = $campos1[nome_foto];

    chmod($dir, 0777);

    //Fução para deletar o arquivo de uma pasta, se não deletar dar permissão 777 na pasta trabalhos
    unlink($dir . $arquivo1);

    //chmod('acervo/', 777);

    $codigo = $campos1[codigo_foto];

    $sql2 = "delete from album where codigo_foto = '$codigo'";
    $resultado2 = mysql_query($sql2);

    echo '<center><font color="#006400"><b>Exclusão feita com sucesso !!!</b></font></center><br>';
    echo '<meta http-equiv="refresh" content="3; URL=form_excluir_foto.php" />';
}


?>

<?php

include('includes/config.php');

echo '<center>
				<form name="form_excluir_foto" method="post" action="excluir_foto.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Selecione a foto:&nbsp;
					';

$sql = "select * from album where pasta = '$_POST[ano]'";
$resultado = mysql_query($sql);

echo '<select size="1" name="ano1">';
while ($campos = mysql_fetch_array($resultado)) {
    echo "<option value='$campos[pasta]'>$campos[nome_foto]</option>";
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