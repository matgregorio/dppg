<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$randomico = mt_rand();
			$arquivo = $randomico.'_'.$_FILES[imagem_banner][name];
			
			$nome_banner = mysql_real_escape_string($_POST[nome_banner]);
			$link_banner = mysql_real_escape_string($_POST[link_banner]);
			$cpf_usuario = mysql_real_escape_string($_SESSION['cpf']);
			
			$sql = "insert into banner (codigo_banner,nome_banner,arquivo_banner,link_banner,cpf_usuario) values ('','$nome_banner','$arquivo','$link_banner','$cpf_usuario')";
			$resultado = mysql_query($sql);
			
			echo'<div id="centralizar">';
	
				if ($resultado == 1) 
				{
					$caminho = 'images/banner/';
					if(move_uploaded_file($_FILES[imagem_banner][tmp_name], $caminho.$randomico.'_'.$_FILES[imagem_banner][name]))
							echo '<br><br><center><font color=#006400><b>'.$_FILES[arquivo][name].' Enviado com sucesso!</b></font></center><br>';
				
					echo '<br><br><center><font color=#006400><b> Cadastrado realizado com sucesso!</b></font></center><br>';
				}
				else{ 
						 	echo '<br><br><center><font color="#B22222"><b> Erro no cadastro!</b></font></center><br>';
					 }
					 
			echo'</div>';
		}	
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>
