<?php

if ($_SESSION['logado_site_dacg'])
{
	include("includes/config2.php");

	$sql= "select * from usuarios order by nome asc";
	$resultado = mysql_query($sql);
	
	$linha = mysql_num_rows($resultado);
	
	echo '<br><br><b>&nbsp&nbspAlterar Usuario</b><br>
	<hr>';
	
	if($linha == 0) 
	{
		echo '<br><font color="#006400"> >> Nenhum usuário cadastrado !</center><br><br>';
	}
		
	while ($campos = mysql_fetch_array($resultado)) 
	{
		echo '<br><a href="index.php?arquivo=subsistemas/usuario/form_alterar_usuario.php&cpf='.$campos[cpf].'">>> '.$campos[nome].'  <img src=images/editar.png width=16 height=16 border=0 alt=editar> <br> ';
	}

	echo'<br><hr>';
	mysql_close($conexao);
}		
?>

	
