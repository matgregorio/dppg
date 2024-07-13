<?php

	include_once ('trataInjection.php');

	if(protectorString($_POST[nome]) || protectorString($_POST[telefone]) || protectorString($_POST[email]) || protectorString($_POST[cpf]))
		return;


	$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){
		
		$cpf = $_POST[cpf];

		if (($cpf!='00000000000') && ($cpf!='11111111111') && ($cpf!='22222222222') && 
			($cpf!='3333333333') && ($cpf!='44444444444') && ($cpf!='55555555555') && 
			($cpf!='66666666666') && ($cpf!='77777777777') && ($cpf!='88888888888') && 
			($cpf!='99999999999') && strlen($cpf)==11)

		{
			include('validacpf.php');
			if ($cpfvalido)
			{
				include('includes/config2.php');
		
				$data = date("y-m-d");
				$nome = mysql_real_escape_string($_POST[nome]);		
				$nome = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
				$cpf = mysql_real_escape_string($_POST[cpf]);
				$email = mysql_real_escape_string($_POST[email]);
				$telefone = mysql_real_escape_string($_POST[telefone]);
		
	  			$sql = "insert into participantes(cpf,nome,email,telefone)
				values ('$cpf','$nome','$email','$telefone')";

				$resultado = mysql_query($sql);
			
				if ($resultado == 1)
					echo '<br><center><b>Cadastro efetuado com sucesso!</b></center><br><br>';
				elseif ($resultado == '')
					echo '<br><center><b>Participante já cadastrado!</b></center><br>';
				else
					echo '<br><center><b>Erro no cadastro!</b></center><br>';
	
				mysql_close($conexao);
			}
			else
				echo '<br><center><b>CPF inválido!</b></center><br>';
		}
		else
			echo '<br><center><b>CPF inválido!</b></center><br>';
	}
?>
