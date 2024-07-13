<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			$sql = "select * from menu_sistemas order by nome_menu asc"; 
			$resultado = mysql_query($sql);
			
			echo '<center><h2>Excluir Categoria do Menu Sistemas</h2></center>';
			echo '<center>';
					echo '<b><font color="red">Ao excluir uma categoria as subcategorias pertencentes a ela também serão excluidas !</b></font><br><br>
					<hr>';		
			while ($campos = mysql_fetch_array($resultado)) 
			{
				echo "<a href=\"index.php?arquivo=excluir_categoria_sistema.php&codigo_menu=$campos[codigo_menu]\"  onClick=\"return confirm('Confirma exclusão de $campos[nome_menu]?')\">$campos[nome_menu] <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a>";
				echo '<br><br>';
			}
			echo"</center>";
		}	
		echo '<hr><center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';
		mysql_close($conexao);
	}
?>
