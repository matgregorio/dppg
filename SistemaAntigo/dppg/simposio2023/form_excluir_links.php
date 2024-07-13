<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			echo '<center><h2> Excluir Links</h2></center><hr>';
			
			//listar links externos laterais
			$sql = "select * from  links_externos where tipo_link=1 order by nome_link desc"; 
			$resultado = mysql_query($sql);
			
			echo '<center><font size=3><b> Links Laterais </b></font></center>';
	
			$linhas_lat = mysql_num_rows($resultado);
			if($linhas_lat==0) { echo '<br><center><font color=#006400><b>Nenhum link lateral cadastrado !</b></font></center>'; }
			
			while ($campos = mysql_fetch_array($resultado)) 
			{
				echo '<center>
				
							<br><font color=#006400>&nbsp;&nbsp;'.$campos[nome_link].'&nbsp;&nbsp;</font>'; 
					echo "<a href=\"index.php?arquivo=excluir_links.php&codigo_link=$campos[codigo_link]\"  onClick=\"return confirm('Confirma exclusão de $campos[nome_link]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a>
					
						</center>";
			}
			
			//listar links externos no rodape
			$sql = "select * from  links_externos where tipo_link=2 order by nome_link desc"; 
			$resultado = mysql_query($sql);
			
			echo '<br><br><br><center><font size=3><b> Links Rodape </b></font></center>';		
			
			$linhas_rod = mysql_num_rows($resultado);
			if($linhas_rod==0) { echo '<br><center><font color=#006400><b>Nenhum link no rodape cadastrado !</b></font></center>'; }
			
			while ($campos = mysql_fetch_array($resultado)) 
			{
				echo '<center>
				
							<br><font color=#006400>&nbsp;&nbsp;'.$campos[nome_link].'&nbsp;&nbsp;</font>'; 
					echo "<a href=\"index.php?arquivo=excluir_links.php&codigo_link=$campos[codigo_link]\"  onClick=\"return confirm('Confirma exclusão de $campos[nome_link]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a>
					
						</center>";
			}
		}	
		echo '<br><hr><center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';
		mysql_close($conexao);
	}
?>