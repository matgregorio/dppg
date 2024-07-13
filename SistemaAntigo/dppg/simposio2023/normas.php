<?php

include('includes/config.php');


$sql_normas = "select * from conteudo where codigo_conteudo ='6'";
$resultado_normas = mysql_query($sql_normas);

$campos_normas = mysql_fetch_array($resultado_normas);

echo '<div class="normas">
			<div class="texto">';

echo $campos_normas[informacoes];

echo '</div>
			</div>';

mysql_close($conexao);
?>	