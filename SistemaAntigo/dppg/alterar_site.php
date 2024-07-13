<?php
	session_start();

	include_once ('trataInjection.php');

	if (protectorString($_POST[titulo_janela]) || protectorString($_POST[nome_site]) || protectorString($_POST[titulo_rodape]) || protectorString($_POST[instituicao_rodape])
		|| protectorString(endereco_rodape) || protectorString(telefone_rodape) || protectorString(email_rodape) || protectorString(desenvolvido) || protectorString(codigo_site))
		return;

if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$titulo_janela = mysql_real_escape_string($_POST[titulo_janela]);
			$nome_site = mysql_real_escape_string($_POST[nome_site]);
			$titulo_rodape = mysql_real_escape_string($_POST[titulo_rodape]);
			$instituicao_rodape = mysql_real_escape_string($_POST[instituicao_rodape]);
			$endereco_rodape = mysql_real_escape_string($_POST[endereco_rodape]);
			$telefone_rodape = mysql_real_escape_string($_POST[telefone_rodape]);
			$email_rodape = mysql_real_escape_string($_POST[email_rodape]);		
			$desenvolvido = mysql_real_escape_string($_POST[desenvolvido]);
			$codigo_site = mysql_real_escape_string($_POST[codigo_site]);
	
			$sql = "update site SET titulo_janela= '$titulo_janela', nome_site= '$nome_site', titulo_rodape = '$titulo_rodape',instituicao_rodape = '$instituicao_rodape', 
			        endereco_rodape = '$endereco_rodape',telefone_rodape = '$telefone_rodape',email_rodape = '$email_rodape',	
			        desenvolvido = '$desenvolvido' where codigo_site='$codigo_site'";
			$resultado = mysql_query($sql);
			
			echo'<div id="centralizar">';
	
			if ($resultado == 1) 
			{
				echo '<br><br><center><font color=#006400><b>Alteração realizada com sucesso!!</b></font></center><br>';
			}
			else {
						echo '<br><br><center><font color="#B22222"><b>"Erro no cadastro !	</b></font></center><br>';
				  }
			
			echo'</div>';		
		}
 		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>
