<?php

    include_once ('trataInjection.php');

    if(protectorString($_GET[codigo_curso]))
        return;

	$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){

			include("includes/config2.php");
			$codigo_curso = mysql_real_escape_string($_GET[codigo_curso]);
			$sql = "select codigo_curso, nome_curso, data_inicio, data_fim, descricao, vagas, data_realizacao, data_realizacao2, data_realizacao3, duracao, horario_realizacao,
					palestrante, ativo	from cursos where codigo_curso='$codigo_curso'";
			$resultado = mysql_query($sql);
			$campos_curso = mysql_fetch_array($resultado);
			$data_inicio = implode("/", array_reverse(explode("-", $campos_curso[data_inicio])));
			$data_final = implode("/", array_reverse(explode("-", $campos_curso[data_fim])));			
			$data_realizacao = implode("/", array_reverse(explode("-", $campos_curso[data_realizacao])));
                        $data_realizacao2 = implode("/", array_reverse(explode("-", $campos_curso[data_realizacao2])));
                        $data_realizacao3 = implode("/", array_reverse(explode("-", $campos_curso[data_realizacao3])));
			
			echo '<br>
					<h2>Manutenção de Curso</h2>
					<form name="tinymce" method="post" action="index.php">
					<b>Nome</b><br>
					<input type="text" name="nome_curso" size="40" maxlength="100" value="'.$campos_curso[nome_curso].'"><br>
					<b>Descrição do Curso</b><br>
					<textarea name="descricao" rows="20" cols="60">'.$campos_curso[descricao].'</textarea><br>
					<b>Palestrante:</b> <input type="text" name="palestrante" size="50" maxlength="100" value="'.$campos_curso[palestrante].'"><br>					
					<b>Vagas</b> <input type="text" name="vagas" size="10" maxlength="10" value="'.$campos_curso[vagas].'"><br>
					<b>Data Realização1:</b> <input type="text" name="data_realizacao" size="10" maxlength="10" value="'.$data_realizacao.'">dd/mm/aaaa<br>
					
                                        <b>Data Realização2:</b> <input type="text" name="data_realizacao2" size="10" maxlength="10" value="'.$data_realizacao2.'">dd/mm/aaaa<br>
                                        <b>Data Realização3:</b> <input type="text" name="data_realizacao3" size="10" maxlength="10" value="'.$data_realizacao3.'">dd/mm/aaaa<br>
                                        
                                        <b>Horário Realização:</b> <input type="text" name="horario_realizacao" size="5" maxlength="5" value="'.$campos_curso[horario_realizacao].'">hh:mm<br>
					<b>Carga Horária:</b> <input type="text" name="carga_horaria" size="2" maxlength="2" value="'.$campos_curso[duracao].'">hs<br>
					<b>Data Início Inscrição:</b> <input type="text" name="data_inicio" size="10" maxlength="10" value="'.$data_inicio.'">dd/mm/aaaa<br>
					<b>Data Final Inscrição:</b> <input type="text" name="data_final" size="10" maxlength="10" value="'.$data_final.'">dd/mm/aaaa<br>
					<b>Ativo: </b>
			';
					include("combo_ativo.php");
					
			echo '<input type="hidden" name="codigo_curso" value="'.$campos_curso[codigo_curso].'">
					<input type="hidden" name="arquivo" value="subsistemas/cursos/manut_curso.php">
					<br><br>
					<input type="submit" name="btManut" value="Alterar" class="submitVerde">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" name="btManut" value="Excluir" class="submitVerde">
					</form>';

			mysql_close($conexao);

	}
?>