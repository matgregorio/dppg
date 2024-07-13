<?php
    include_once ('trataInjection.php');

    if(protectorString($_GET[cpf]) || protectorString($_GET[codigo_curso]))
        return;

	$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){
		include("includes/config2.php");
		
		$cpf = mysql_real_escape_string($_GET[cpf]);
		$codigo_curso = mysql_real_escape_string($_GET[codigo_curso]);

		$sql = "delete from inscricao where cpf=$cpf and codigo_curso=$codigo_curso";
		$resultado = mysql_query($sql);
		
		if ($resultado == 1) {
			echo '<br><br><center><b>Excluído com sucesso!</b><center><br>';
			$sql = "update cursos set vagas=vagas+1 where codigo_curso=$codigo_curso";
			$resultado = mysql_query($sql);
		}
		else 
			echo '<br><br><center><b>Erro na exclusão!</b><center><br>';

		mysql_close($conexao);
	}
?>