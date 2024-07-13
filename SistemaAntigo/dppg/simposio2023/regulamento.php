<?php
$sqlEdicaoEvento = mysql_query("SELECT informacoes FROM conteudo WHERE codigo_conteudo = '10'");
$edicaoEvento = mysql_fetch_array($sqlEdicaoEvento);

$sqlRegulamento = mysql_query("SELECT * FROM arquivo WHERE codigo_arquivo = '8'");
$regulamento = mysql_fetch_array($sqlRegulamento);

echo"<br><br>";
echo '<center>';

//$sql_arquivo = "select * from formularios f, arquivo a where f.codigo_formulario = a.codigo_formulario and
//		a.codigo_formulario = '4'";
//$resultado_arquivo = mysql_query($sql_arquivo);

echo '<center>';

echo "<embed src='documentos/$regulamento[caminho_arquivo]' width='800px' height='2100px' />";
echo '<br> <br>';
