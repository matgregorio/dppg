<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			$sql = "select * from menu_categoria order by nome_categoria desc"; 
			$resultado = mysql_query($sql);
			
			echo '<center><h2>Excluir Subcategoria do Menu</h2>';
			echo '<b><font color="red">Ao excluir uma subcategoria as sub-subcategorias pertencentes a ela também serão excluidas !</b></font><br><br>';
			echo '</center><hr>';
			
			while ($campos = mysql_fetch_array($resultado)) 
			{
				echo "<center><b>$campos[nome_categoria]</b><br>";
				
				
				$sql1 = "select * from menu_subcategoria where categoria='$campos[codigo_categoria]' order by nome_subcategoria asc"; 
				$resultado1 = mysql_query($sql1);
				while ($campos1 = mysql_fetch_array($resultado1)) 
				{
							echo "<a href=\"index.php?arquivo=excluir_menu_subcategoria.php&codigo_subcategoria=$campos1[codigo_subcategoria]\"  onClick=\"return confirm('Confirma exclusão de $campos1[nome_subcategoria]?')\">$campos1[nome_subcategoria] <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a><br>";
					
				}
				echo '<br></center>';
			}
		}	
		echo '<hr><center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';	
		mysql_close($conexao);
	}
?>
