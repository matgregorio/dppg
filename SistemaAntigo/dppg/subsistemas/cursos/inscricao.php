<?php

		include_once ('trataInjection.php');

		if(protectorString($_POST[cpf]) || protectorString($_POST[btCadastrar]) || protectorString($_POST[nome]) ||
		   protectorString($_POST[email])|| protectorString($_POST[telefone]))
			return;

		if (($_POST[cpf]!='00000000000') && ($_POST[cpf]!='11111111111') && ($_POST[cpf]!='22222222222') && 
			($_POST[cpf]!='3333333333') && ($_POST[cpf]!='44444444444') && ($_POST[cpf]!='55555555555') && 
			($_POST[cpf]!='66666666666') && ($_POST[cpf]!='77777777777') && ($_POST[cpf]!='88888888888') && 
			($_POST[cpf]!='99999999999') && strlen($_POST[cpf])==11)

		{
			include('validacpf.php');
			$btCadastrar = $_POST[btCadastrar];

			if (($cpfvalido) && ($btCadastrar == 'Cadastrar'))
			{
				include('includes/config2.php');
				$data = date("y-m-d");

				$nome = mysql_real_escape_string($_POST[nome]);
				$cpf = mysql_real_escape_string($_POST[cpf]);
				$email = mysql_real_escape_string($_POST[email]);
				$telefone = mysql_real_escape_string($_POST[telefone]);
				$nome = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
		
	  			$sql1 = "insert into participantes(cpf,nome,email,telefone)
				values ('$cpf','$nome','$email','$telefone')";
				$resultado1 = mysql_query($sql1);

	  			$sql2 = "insert into inscricao(cpf, codigo_curso, data_inscricao) values 
	  						('$cpf','$codigo_curso','$data')";
				$resultado2 = mysql_query($sql2);
			
				if (($resultado1 == 1) && ($resultado2 == 2)) {
					echo '<br><center><b>Cadastro efetuado com sucesso!</b></center><br><br>';
					$sql = "update cursos set vagas=vagas-1 where codigo_curso=$codigo_curso";
					$resultado = mysql_query($sql);
				}
				else
					echo '<br><center><b>Erro no cadastro!</b></center><br>';
	
				mysql_close($conexao);
			}
			elseif(($cpfvalido) && ($btCadastrar != 'Cadastrar')) 
			{
					$data = date("y-m-d");

					$sql = "insert into inscricao(cpf, codigo_curso, data_inscricao) values 
					('$cpf','$codigo_curso','$data')";	
					
					$resultado = mysql_query($sql);
			
					if ($resultado == 1)
					{	
						echo '<br><center><b>Inscrição efetuada com sucesso!</b></center><br><br>';
						$sql = "update cursos set vagas=vagas-1 where codigo_curso=$codigo_curso";
						$resultado = mysql_query($sql);
					}
			}			
			else
				echo '<br><center><b>CPF inválido!</b></center><br>';
		}
		else
			echo '<br><center><b>CPF inválido!</b></center><br>';
?>
