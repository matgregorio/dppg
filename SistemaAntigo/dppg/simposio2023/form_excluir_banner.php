<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			echo '<center><h2> Excluir Banner</h2><hr>
			<br>
			Para excluir clique em um banner !
			<br><br></center>';
			
			$sql = "select * from  banner"; 
			$resultado = mysql_query($sql);
			
			$linhas_lat = mysql_num_rows($resultado);
			if($linhas_lat==0) { echo '<br><center><font color=#006400><b>Nenhum banner cadastrado !</b></font></center>'; }
			
			
			echo '<table border=0 align=center>';
				while ($campos = mysql_fetch_array($resultado)) 
				{
					echo '<center><tr>';
					
								 
					
						echo "<td><a href=\"index.php?arquivo=excluir_banner.php&codigo_banner=$campos[codigo_banner]\"  onClick=\"return confirm('Confirma exclusão do banner $campos[nome_banner]?')\"><img src=images/banner/".$campos[arquivo_banner]." width='200' height='50'/> </a><br><br></td>
						
							</tr></center>";
				}
		   echo '</table>';
		}	
		echo '<hr><center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';
		mysql_close($conexao);
	}
?>