<?php
	session_start();

	include_once ('trataInjection.php');

	if (protectorString($_POST[nome_sistema]) || protectorString($_POST[combo_categoria]) || protectorString($_POST[link_sistema]) ||
		protectorString($_POST[link_index]) || protectorString($_POST[descricao_sistema])|| protectorString($_POST[cpf_usuario])||
		protectorString($_POST[senha])|| protectorString($_POST[nome]))
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			//dados subsistema		
			$nome_menu = mysql_real_escape_string($_POST[nome_sistema]);
			$codigo_grupo = mysql_real_escape_string($_POST[combo_categoria]);
			$link_menu = mysql_real_escape_string($_POST[link_sistema]);
			$link_index = mysql_real_escape_string($_POST[link_index]);
			$descricao_menu = mysql_real_escape_string($_POST[descricao_sistema]);	
			
			//dados usuario
			$cpf_sub_adm = mysql_real_escape_string($_POST[cpf_usuario]);
			$senha_tmp = mysql_real_escape_string($_POST[senha]);
			$senha = md5($senha_tmp);
			$nome = mysql_real_escape_string($_POST[nome]);
			
			
			if($cpf_sub_adm!="")
			{
					//inserindo dados do subsistema
					$sqlSistema ="insert into menu_sistemas values('','$nome_menu','$descricao_menu','$link_menu','$link_index')";
					$resultadoSistema = mysql_query($sqlSistema);
			
					//inserindo dados do usuario
					$sqlUsuario ="insert into usuarios values('$cpf_sub_adm','$senha','$nome','','')";
					$resultadoUsuario = mysql_query($sqlUsuario);
					
					//dar permissao de sub adm para o usuario
					$buscar = mysql_query("select * from menu_sistemas where nome_menu=$nome_menu and descricao_sistema=$descricao_menu");
					$result = mysql_fetch_array($buscar);
					
					mysql_query("insert into participa_grupos values('2','$cpf_sub_adm','$result[codigo_menu]')");
					
			}else {
						$query = mysql_query("select * from participa_grupos where codigo_grupo=1");
						$valor = mysql_fetch_array($query);
						$cpf_adm = $valor[cpf];
						
						//inserindo dados do subsistema
						$sqlSistema ="insert into menu_sistemas values('','$nome_menu','$descricao_menu','$link_menu','$link_index')";
						$resultadoSistema = mysql_query($sqlSistema);
						
					}		
			
			echo'<div id="centralizar">';
				
				if (($resultadoSistema == 1)&&($resultadoUsuario == 1 )) 
				{
					 echo '<br><br><center><font color=#006400><b>Cadastrado realizado com sucesso!</b></font></center><br>';
				}
				elseif($resultadoSistema == 1)
		 			 { 
							echo '<br><br><center><font color=#006400><b>Cadastrado do Subsistema realizado com sucesso!<br><br></font>
							Nenhum Usuario foi cadastrado !</b></center>';	
					 }
					 else 
				 		echo '<br><br><center><font color="#B22222"><b>Erro no cadastro!</b></font></center><br>';
				
			echo'</div>';
		}
		mysql_close($conexao);				
		echo '<meta http-equiv="refresh" content="3;index.php?arquivo=adm_geral.php" />';
	}
?>
