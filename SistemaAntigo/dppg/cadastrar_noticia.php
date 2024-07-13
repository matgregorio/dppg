<?php
	session_start();
    include_once ('trataInjection.php');

    if (protectorString($_POST[titulo_noticia]) || protectorString($_POST[conteudo_noticia]))
        return;

	if ($_SESSION[logado_site_dppg])		
	{
		include('includes/config2.php');
          
      $titulo_noticia = mysql_real_escape_string($_POST[titulo_noticia]);
		$conteudo_noticia = mysql_real_escape_string($_POST[conteudo_noticia]);
		
      $data = date("Y-m-d");
      $hora = date("H:m:s");
      
		$pasta = mt_rand();
		
		$usuario = mysql_real_escape_string($_SESSION['cpf']);


      $sql = "insert into noticias (titulo_noticia, conteudo_noticia, arquivo_noticia, data_noticia, hora_noticia, codigo_usuario ) 
				values('$titulo_noticia','$conteudo_noticia','$pasta','$data','$hora','$usuario')";

		$resultado = mysql_query($sql);			
		
		echo '<div id="centralizar">';
		
		if ($resultado == 1) {
				
				echo '<br><center><font color=#006400><b>Notícia cadastrada com sucesso!</center></b></font><br><br>';
			
				$comando = 'mkdir galeria/noticias/'.$pasta;
				$caminho =  'galeria/noticias/'.$pasta.'/';
				
				for($i=0;$i<sizeof($_FILES[arq_noticia][name]);$i++)
					
						if($_FILES[arq_noticia][name][$i] != null) {
							system($comando);
							
							if(move_uploaded_file($_FILES[arq_noticia][tmp_name][$i], $caminho.$_FILES[arq_noticia][name][$i]))
								echo '<br><center><font color=#006400><b>'.$_FILES[arq_noticia][name][$i].'  - Enviado com sucesso!</center></b></font><br>';
							
							
						}	
		}			
		else 
			echo '<center><font color="#B22222"><b>Erro no cadastro!</center></font></b>';
		
		echo '</div>';	
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="3;index.php?arquivo=adm_geral.php" />';
	}
?>