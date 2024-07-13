<?php
	session_start();
	include_once ('trataInjection.php');

	if (protectorString($_GET[codigo_formulario]))
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_formulario = mysql_real_escape_string($_GET[codigo_formulario]);		
			
			$sql = "select * from formularios where codigo_formulario='$codigo_formulario'";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
			
			$caminho = 'galeria/formularios/'.$campos[arquivo_formulario];
			unlink("$caminho");
	
			$sql = "delete from formularios where codigo_formulario='$codigo_formulario'"; 
			$resultado = mysql_query($sql);
			
			echo '<div id="centralizar">';
			
				if ($resultado==1)
				   echo '<br><br><center><font color=#006400><b>Excluido com sucesso!</b></font></center><br>';
				else
				   echo '<br><br><center><font color="#B22222"><b>Erro na exclusão!</b></font></center><br>';
				   
			echo '</div>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2; URL=index.php?arquivo=listar_excluir_formulario.php" />';
	}
?>
