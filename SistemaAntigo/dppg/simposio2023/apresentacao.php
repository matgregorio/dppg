<?php


include('includes/config.php');

$sql = "SELECT informacoes FROM conteudo WHERE topo='apresentacao'";
$resultado = mysql_query($sql);
$campos = mysql_fetch_array($resultado);
echo "<br>";
echo $campos[informacoes];

$sqlArquivo = mysql_query("select * from arquivo where codigo_arquivo ='5'");
$arquivo = mysql_fetch_array($sqlArquivo);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $arquivo[nome_arquivo];?></title>
</head>
<body>
<h2 style="text-align: center;"><?php echo $arquivo[nome_arquivo];?></h2>
<iframe src="documentos/<?php echo $arquivo[caminho_arquivo];?>#zoom=87" width="100%" height="1500px">
</iframe>
</body>
</html>
<?php
mysql_close($conexao);
?>
