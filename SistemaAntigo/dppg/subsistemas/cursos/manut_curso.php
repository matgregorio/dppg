<?php

include_once ('trataInjection.php');

if( protectorString($_POST[data_inicio]) || protectorString($_POST[data_final]) || protectorString($_POST[data_realizacao]) ||
    protectorString($_POST[data_realizacao2]) || protectorString($_POST[data_realizacao3]) || protectorString($_POST[btManut]) ||
    protectorString($_POST[nome_curso]) || protectorString($_POST[descricao]) || protectorString($_POST[vagas]) ||
    protectorString($_POST[carga_horaria]) || protectorString($_POST[ativo]) || protectorString($_POST[horario_realizacao]) ||
    protectorString($_POST[palestrante]) || protectorString($_POST[codigo_curso]))
    return;

    $resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){

		$data_inicio = implode("-", array_reverse(explode("/", $_POST[data_inicio])));
		$data_final = implode("-", array_reverse(explode("/", $_POST[data_final])));
		$data_realizacao = implode("-", array_reverse(explode("/", $_POST[data_realizacao])));
                $data_realizacao2 = implode("-", array_reverse(explode("/", $_POST[data_realizacao2])));
                $data_realizacao3 = implode("-", array_reverse(explode("/", $_POST[data_realizacao3])));

		include("includes/config2.php");
		
		$btManut = mysql_real_escape_string($_POST[btManut]);
		$nome_curso = mysql_real_escape_string($_POST[nome_curso]);
		$descricao = mysql_real_escape_string($_POST[descricao]);
		$vagas = mysql_real_escape_string($_POST[vagas]);
		$carga_horaria = mysql_real_escape_string($_POST[carga_horaria]);
		$ativo = mysql_real_escape_string($_POST[ativo]);
		$horario_realizacao = mysql_real_escape_string($_POST[horario_realizacao]);
		$palestrante = mysql_real_escape_string($_POST[palestrante]);
		$codigo_curso = mysql_real_escape_string($_POST[codigo_curso]);
		
		if ($btManut == "Alterar") {
			
			$sql = "update cursos set nome_curso='$nome_curso', descricao='$descricao', data_inicio='$data_inicio', data_fim='$data_final', vagas='$vagas', duracao='$carga_horaria', ativo='$ativo',data_realizacao='$data_realizacao', data_realizacao2='$data_realizacao2', data_realizacao3='$data_realizacao3', horario_realizacao='$horario_realizacao', palestrante='$palestrante' where codigo_curso='$codigo_curso'";
			$resultado = mysql_query($sql);
			if ($resultado == 1)
				echo '<br><br><center><b>Alterado com sucesso!</b><center><br>';
			else 
				echo '<br><br><center><b>Erro na alteração!</b><center><br>';
		}		
		elseif ($btManut == "Excluir") {
			$sql = "delete from cursos where codigo_curso=$codigo_curso";
			$resultado = mysql_query($sql);
			if ($resultado == 1) {
				$sql = "delete from inscricao where codigo_curso=$codigo_curso";
				$resultado = mysql_query($sql);
				echo '<br><br><center><b>Excluído com sucesso!</b><center><br>';
			}
			else 
				echo '<br><br><center><b>Erro na exclusão!</b><center><br>';

		}
	}
?>