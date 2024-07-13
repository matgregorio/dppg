<?php

		include("includes/config2.php");
		include_once ('trataInjection.php');

        if(protectorString($_POST[nome]) || protectorString($_POST[telefone]) || protectorString($_POST[email]) || protectorString($_POST[cpf]))
            return;

		$nome = mysql_real_escape_string($_POST[nome]);
		$telefone = mysql_real_escape_string($_POST[telefone]);
		$email = mysql_real_escape_string($_POST[email]);
		$cpf = mysql_real_escape_string($_POST[cpf]);
		$nome = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
		$sql = "update participantes set nome='$nome', telefone='$telefone', email='$email'  
				where cpf='$cpf'";
		$resultado = mysql_query($sql);
		if ($resultado == 1)
			echo '<br><br><center><b>Alterado com sucesso!</b><center><br>';
		else 
			echo '<br><br><center><b>Erro na alteração!</b><center><br>';

		mysql_close($conexao);
		
?>