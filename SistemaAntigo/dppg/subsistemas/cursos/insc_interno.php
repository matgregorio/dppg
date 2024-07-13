<?php
	include_once ('trataInjection.php');

	if(protectorString($_POST[cpf]) || protectorString($_POST[codigo_curso]))
		return;

	$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){

		if (($_POST[cpf]!='00000000000') && ($_POST[cpf]!='11111111111') && ($_POST[cpf]!='22222222222') && 
			($_POST[cpf]!='3333333333') && ($_POST[cpf]!='44444444444') && ($_POST[cpf]!='55555555555') && 
			($_POST[cpf]!='66666666666') && ($_POST[cpf]!='77777777777') && ($_POST[cpf]!='88888888888') && 
			($_POST[cpf]!='99999999999') && strlen($_POST[cpf])==11)

		{
			include('validacpf.php');
			if ($cpfvalido)
			{
				include('includes/config2.php');
				
				$cpf = mysql_real_escape_string($_POST[cpf]);
				$codigo_curso = mysql_real_escape_string($_POST[codigo_curso]);
						
				$sql = "select * from participantes where cpf='$cpf'";
				$resultado = mysql_query($sql);
				
				if (mysql_num_rows($resultado) == 1) {
		
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
					elseif ($resultado == '')
						echo '<br><center><b>Participante já inscrito!</b></center><br>';
					else
						echo '<br><center><b>Erro na inscrição!</b></center><br>';
				}
				else 
					echo '<br><center><b>Participante não cadastrado.<br>Cadastre-o primeiro para depois fazer sua inscrição.</b></center><br>';
				mysql_close($conexao);
			}
			else
				echo '<br><center><b>CPF inválido!</b></center><br>';
		}
		else
			echo '<br><center><b>CPF inválido!</b></center><br>';
	}
?>
