<?php


include('includes/config.php');

$sql = "SELECT informacoes FROM conteudo WHERE topo='expediente'";
$resultado = mysql_query($sql);
$campos = mysql_fetch_array($resultado);
echo "<br>";
echo $campos[informacoes];
echo "<br><br>";
mysql_close($conexao);
?>