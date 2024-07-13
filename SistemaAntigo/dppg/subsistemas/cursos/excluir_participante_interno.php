<?php

    include_once ('trataInjection.php');

    if(protectorString($_GET[cpf]))
        return;

	$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){
		include("includes/config2.php");
		
		$cpf = mysql_real_escape_string($_GET[cpf]);

		$sql = "update inscricao join cursos on inscricao.codigo_curso=cursos.codigo_curso set cursos.vagas=cursos.vagas+1 
					where	cpf='$cpf'";
		$resultado1 = mysql_query($sql);

		$sql = "delete from inscricao where cpf='$cpf'";
		$resultado2 = mysql_query($sql);
		
		$sql = "delete from participantes where cpf='$cpf'";
		$resultado3 = mysql_query($sql);
		
		if (($resultado1 == 1) && ($resultado2 == 1) && ($resultado3 == 1))
			echo '<br><br><center><b>Excluído com sucesso!</b><center><br>';
		else 
			echo '<br><br><center><b>Erro na exclusão!</b><center><br>';

		mysql_close($conexao);
	}
?>