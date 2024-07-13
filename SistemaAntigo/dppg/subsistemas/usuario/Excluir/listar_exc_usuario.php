<?php
	session_start();
	
	if ($_SESSION['logado_site_dacg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
	
			$sql = "select * from usuarios order by nome asc"; 
			$resultado = mysql_query($sql);
			
			echo '<br><br><b>&nbsp&nbsp Excluir Usuario</b><br>
			<hr>';
			
			while ($campos = mysql_fetch_array($resultado)) 
			{
				echo "<a href=\"index.php?arquivo=subsistemas/usuario/excluir_usuario.php&cpf=$campos[cpf]\"  onClick=\"return confirm('Confirma exclusão de $campos[nome]?')\"> >> $campos[nome] <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a><br><br>";
			}
			
			echo '</center><hr>';	
		}
		mysql_close($conexao);
	}
?>
