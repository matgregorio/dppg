<?php

if ($_SESSION['logado_site_dacg'])
{
	include("includes/config2.php");

	$sql= "select nome_grupo from grupo_usuario where codigo_grupo>2 and nome_grupo not in (select distinct nome_grupo from grupo_usuario gu, participa_grupos pg where gu.codigo_grupo=pg.codigo_grupo)";
	$resultado = mysql_query($sql);
		
	$linha = mysql_num_rows($resultado);
	
	echo '<br><br><b>&nbsp&nbspAlterar Nível de Usuario</b><br>
	<hr>';
	
	if($linha==0) 
	{
		echo '<br><font color="#006400"> >> Nenhum nível de usuário disponivel para alteração !</center><br><br>';		
	}
		
	while ($campos = mysql_fetch_array($resultado)) 
	{
		echo '<br><a href="index.php?arquivo=subsistemas/usuario/form_alterar_nivel.php&codigo_grupo='.$campos[codigo_grupo].'">>> '.$campos[nome_grupo].'  <img src=images/editar.png width=16 height=16 border=0 alt=editar> <br> ';
		while($campos1 = mysql_fetch_array($resultado1)) 
		{
			
		}
	}
	
	echo'<br><hr>';
	mysql_close($conexao);
}	
	
?>

	
