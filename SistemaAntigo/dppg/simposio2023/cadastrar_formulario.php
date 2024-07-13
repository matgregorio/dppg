<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include('includes/config2.php');
					
			$titulo_formulario = mysql_real_escape_string($_POST[titulo_formulario]);
			$codigo_menu = mysql_real_escape_string($_POST[categoria]);
			$codigo_submenu = mysql_real_escape_string($_POST[subcategoria]);
			$codigo_sub_subcategoria=0;
			$codigo_usuario = mysql_real_escape_string($_SESSION['cpf']);
			
			//if (eregi('pdf',$_FILES[arq_trabalho][type])){
			$dir = 'galeria/formularios/';
			$numero = mt_rand();
			$arquivo = $numero.'_'.$_FILES[arq_formulario][name];
				
			if (move_uploaded_file($_FILES[arq_formulario][tmp_name], $dir.$numero.'_'.$_FILES[arq_formulario][name])) 
			{
					$sql = "insert into formularios (codigo_formulario, titulo_formulario, arquivo_formulario, codigo_menu, codigo_submenu, codigo_sub_subcategoria,codigo_usuario) 
					values('','$titulo_formulario','$arquivo','$codigo_menu','$codigo_submenu','$codigo_sub_subcategoria','$codigo_usuario')";
					$resultado = mysql_query($sql);		
									
					echo '<div id="centralizar">
								<center><font color=#006400><b>Documento cadastrado com sucesso!</b></font></center>
							</div>';
					
					echo '<br><center><font color=#006400><b>Arquivo enviado com sucesso!</center></b></font><br>';
			}
			else 
				echo '<center><font color="#B22222"><b>Erro no envio!</center></font></b>';
			//}
		}	
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>
