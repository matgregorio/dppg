<head>
<title>DPPG</title>
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div id="conteudo">
<?php

include_once ('trataInjection.php');

if(protectorString($_GET[codigo_curso]))
    return;

	header("Content-Type: text/html; charset=utf8",true);
 
//	include('../includes/config2.php');	
	include '../../includes/config2.php';
	$codigo_curso = mysql_real_escape_string($_GET[codigo_curso]);
	
	$sql = "select nome_curso, descricao from cursos where codigo_curso=$codigo_curso";
	$resultado = mysql_query($sql);
	$campos = mysql_fetch_array($resultado);
	$nome_curso = $campos[nome_curso];

	echo '<center>Descrição do curso <b>"'.$nome_curso.'"</b><br><br></center>';

	echo $campos[descricao];
	
	mysql_close($conexao);
?>
</div>
</body>
</html>