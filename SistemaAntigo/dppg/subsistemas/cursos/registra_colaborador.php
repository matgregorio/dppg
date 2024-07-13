<?php

			include('includes/config2.php');
            include_once ('trataInjection.php');

            if( protectorString($_POST[nome]) || protectorString($_POST[email]) || protectorString($_POST[usuario]) ||
                protectorString($_POST[senha]) || protectorString($_POST[instituicao]) || protectorString($_POST[cargo]) ||
                protectorString($_POST[titulacao]) || protectorString($_POST[atuacao]) || protectorString($_POST[peq_areas_atuacao]) ||
                protectorString($_POST[subareatuacao]))
                return;
				
			$nome = mysql_real_escape_string($_POST[nome]);
			$nome = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
			$email = mysql_real_escape_string($_POST[email]);
			$usuario = mysql_real_escape_string($_POST[usuario]);
			$senha = mysql_real_escape_string($_POST[senha]);
			$instituicao = mysql_real_escape_string($_POST[instituicao]);
			$cargo = mysql_real_escape_string($_POST[cargo]);
			$titulacao = mysql_real_escape_string($_POST[titulacao]);						
			$atuacao = mysql_real_escape_string($_POST[atuacao]);			
			$peq_areas_atuacao = mysql_real_escape_string($_POST[peq_areas_atuacao]);			
			$subareatuacao = mysql_real_escape_string($_POST[subareatuacao]);
			 
			$sql = "insert into colaboradores (id_colaborador, nome, email, usuario, senha, instituicao, cargo, titulacao, areatuacao, peqareatuacao, subareatuacao)
					values('','$nome','$email','$usuario','$senha','$instituicao', '$cargo','$titulacao', '$atuacao', '$peq_areas_atuacao', '$subareatuacao')";
			
			$resultado = mysql_query($sql);
			
		

		echo'<div id="centralizar">';
			if($resultado == 1)
			
				echo '<br><br><center><b>Cadastrado com sucesso!</b><center><br>';
				
			elseif($resultado == '')
			
				echo '<br><center><b>Participante já cadastrado!</b></center><br>';
												
			else 
			
				echo '<br><br><center><b>Erro no cadastro!</b><center><br>';
		echo '</div>';
				
			mysql_close($conexao);	
			
			echo '<meta http-equiv="refresh" content="1; index.php" />';	

?>