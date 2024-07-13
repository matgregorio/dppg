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
			
			echo '<center><h2>Excluir Subcategoria do Menu Sistema</h2></center>';
			echo '<hr>';
			
			while ($campos = mysql_fetch_array($resultado)) 
			{
				echo "<center><b>$campos[nome_menu]</b><br>";
				
				
				$sql1 = "select * from menu_sistemas_subcategoria where codigo_menu='$campos[codigo_menu]' order by nome_subcategoria asc"; 
				$resultado1 = mysql_query($sql1);
				while ($campos1 = mysql_fetch_array($resultado1)) 
				{
					echo "<a href=\"index.php?arquivo=excluir_sistema_subcategoria.php&codigo_subcategoria=$campos1[codigo_subcategoria]\"  onClick=\"return confirm('Confirma exclusão de $campos1[nome_subcategoria]?')\">$campos1[nome_subcategoria] <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a>";
					echo '<br><br>';
				}
				echo '<br></center>';
			}
		}	
		echo '<br><hr><center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';
		mysql_close($conexao);
	}
?>
