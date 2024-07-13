<head>
<title>DPPG</title>
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div id="conteudo">
<?php

session_start();
header("Content-Type: text/html; charset=utf8",true);
include('subsistemas/cursos/pesquisa_vetor_cursos.php');
include_once ('trataInjection.php');

if(protectorString($_GET[codigo_curso]))
    return;

$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){
	
	include('gera_barcode.php');
	
	include('../includes/config2.php');	
	
	$sql = "select nome_curso from cursos where codigo_curso=$_GET[codigo_curso]";
	$resultado = mysql_query($sql);
	$campos = mysql_fetch_array($resultado);
	$nome_curso = $campos[nome_curso];

	echo '<center>Lista presença do curso <b>"'.$nome_curso.'"<br><br></center>';
	
	$sql = "select participantes.cpf, participantes.nome from participantes join inscricao on inscricao.cpf=participantes.cpf 
			 	where inscricao.codigo_curso='$_GET[codigo_curso]' order by participantes.nome";
	
	$resultado = mysql_query($sql);
	$total_participantes = mysql_num_rows($resultado);

	$controle = 0;
   echo '<center>';

	while ($campos = mysql_fetch_array($resultado))
	{
		echo '<table border="0">';
		echo '<tr>
				<td>'.$campos[nome].'<br>';
				echo fbarcode($campos[cpf]); 
				echo '<br>Ass.:<hr align="left" width="350"/></td>';
		if ($campos = mysql_fetch_array($resultado)) {
			echo '<td>'.$campos[nome].'<br>';
			echo fbarcode($campos[cpf]); 
			echo '<br>Ass.:<hr align="left" width="350"/></td>';
		}
		echo '</tr>';
	} 
	echo '</table>';
	echo '</center><br>';
	}
	mysql_close($conexao);
?>
</div>
</body>
</html>