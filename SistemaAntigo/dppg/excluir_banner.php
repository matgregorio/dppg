<?php
	session_start();

	include_once ('trataInjection.php');

	if (protectorString($_GET[codigo_banner]))
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_banner = mysql_real_escape_string($_GET[codigo_banner]);
			
			$sql = "select * from banner where codigo_banner='$codigo_banner'";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
		
			$caminho = 'images/banner/'.$campos[arquivo_banner];
			unlink("$caminho");
		
			$sql = "delete from banner where codigo_banner='$codigo_banner'"; 
			$resultado = mysql_query($sql);
		
			echo'<div id="centralizar">';
			
					if ($resultado==1)
					  echo '<br><br><center><font color=#006400><b>Excluido com sucesso!</b></font></center><br>';
					  
					else
					   echo '<br><br><center><font color="#B22222"><b>Erro na exclusão!</b></font></center><br>';
					   
	   	echo'</div>';
   	}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>
