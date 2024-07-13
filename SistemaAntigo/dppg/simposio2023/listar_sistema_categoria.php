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
			
			echo '<center><h2>Alterar Categoria do Menu Sistemas</h2></center>';
			echo '<hr>';
			
			while ($campos = mysql_fetch_array($resultado)) 
			{
				
				echo "
				<center><a href='index.php?arquivo=form_editar_sistema.php&codigo_menu=$campos[codigo_menu]'><img src=images/editar.png width=16 height=16 border=0 alt=editar>$campos[nome_menu]</a><br><br>
				</center>";
			}
		}	
		echo '<hr><center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';
		mysql_close($conexao);
	}
?>
