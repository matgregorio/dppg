<?php

    include_once ('trataInjection.php');

    if(protectorString($_POST[data_inicio]) || protectorString($_POST[data_final]) || protectorString($_POST[data_realizacao]) || protectorString($_POST[data_realizacao2]) ||
       protectorString($_POST[data_realizacao3]) || protectorString($_POST[nome]) || protectorString($_POST[descricao]) || protectorString($_POST[vagas]) ||
       protectorString($_POST[carga_horaria]) || protectorString($_POST[horario_realizacao]) || protectorString($_POST[palestrante]) || protectorString($_POST[ativo]))
            return;

	$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){
		include("includes/config2.php");
		
		$data_inicio = implode("-", array_reverse(explode("/", $_POST[data_inicio])));
		$data_final = implode("-", array_reverse(explode("/", $_POST[data_final])));
		$data_realizacao = implode("-", array_reverse(explode("/", $_POST[data_realizacao])));
                $data_realizacao2 = implode("-", array_reverse(explode("/", $_POST[data_realizacao2])));
                $data_realizacao3 = implode("-", array_reverse(explode("/", $_POST[data_realizacao3])));
		
		$nome = mysql_real_escape_string($_POST[nome]);
		$descricao = mysql_real_escape_string($_POST[descricao]);
		$vagas = mysql_real_escape_string($_POST[vagas]);
		$carga_horaria = mysql_real_escape_string($_POST[carga_horaria]);
		$horario_realizacao = mysql_real_escape_string($_POST[horario_realizacao]);
		$palestrante = mysql_real_escape_string($_POST[palestrante]);
		$ativo = mysql_real_escape_string($_POST[ativo]);
		
		$sql = "insert into cursos (nome_curso, descricao, vagas, data_inicio, data_fim, duracao, data_realizacao, data_realizacao2, data_realizacao3, horario_realizacao, palestrante, ativo) values('$nome','$descricao','$vagas','$data_inicio','$data_final', 	'$carga_horaria','$data_realizacao', '$data_realizacao2', '$data_realizacao3', '$horario_realizacao','$palestrante','$ativo')";
		$resultado = mysql_query($sql);

		if ($resultado == 1) {
			echo '<br><br><center><b>Cadastrado com sucesso!</b><center><br>';
		}
		else 
			echo '<br><br><center><b>Erro no cadastro!</b><center><br>';
			
		mysql_close($conexao);
	}

?>