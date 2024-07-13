<?php
	session_start();
	
	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
			
			$sql= "select nome_grupo from grupo_usuario where codigo_grupo>2 and nome_grupo not in (select distinct nome_grupo from grupo_usuario gu, participa_grupos pg where gu.codigo_grupo=pg.codigo_grupo)"; 
			$resultado = mysql_query($sql);
			
			$linha = mysql_num_rows($resultado);
			
			echo '<br><br><b>&nbsp&nbsp Excluir Nível de Usuário</b><br>
			
			<hr>
			<br>';
			
			if($linha==0) 
			{
				echo '<br><font color="#006400"> >> Nenhum nível de usuário disponivel para alteração !</center><br><br>';		
			}
				
			while ($campos = mysql_fetch_array($resultado)) 
			{
				echo "<a href=\"index.php?arquivo=subsistemas/usuario/excluir_nivel.php&codigo_grupo=$campos[codigo_grupo]\"  onClick=\"return confirm('Se esse nível tiver relação com algum usuário essa relação será disfeita. Confirma exclusão do nível $campos[nome_grupo]?')\"> >> $campos[nome_grupo]  <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a><br><br>";
			}
			
			echo '</center><hr>';	
		}	
		mysql_close($conexao);
	}
?>