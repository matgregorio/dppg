<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			$sql = "select * from menu_categoria order by posicao_menu asc"; 
			$resultado = mysql_query($sql);
			
			echo '<center><h2>Excluir Categoria do Menu</h2>';
			echo '<b><font color="red">Ao excluir uma categoria as subcategorias pertencentes a ela também serão excluidas !</b></font><br><br>';		
			echo '<hr>';
				
			while ($campos = mysql_fetch_array($resultado)) {
			echo "<a href=\"index.php?arquivo=excluir_menu_categoria.php&codigo_categoria=$campos[codigo_categoria]\"  onClick=\"return confirm('Confirma exclusão de $campos[nome_categoria]?')\">$campos[nome_categoria] <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a>";	
					
			echo '<br><br>';		
			}
			echo '</center>';
		}	
		echo '<hr><center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';	
		mysql_close($conexao);
	}
?>
