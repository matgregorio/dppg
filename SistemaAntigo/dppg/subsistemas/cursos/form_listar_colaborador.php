<?php

	$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){

	echo '
				<center>
				<br>
				<b>Listar Avaliadores</b>
				<br><br>
	
				<form name="form_listagem" method="POST" action="index.php">
				<table border="0" width="500" class="esquerda">
				<tr>
	  				<td><b>Área de atuação:</b></td>
	  				<td>';
	  					include("subsistemas/cursos/combo_grandearea.php");
	  			echo '</td>
				</tr>
				<tr>  
	  				<input type="hidden" name="arquivo" value="subsistemas/cursos/listagem_colaboradores.php">
				</tr>
				</table>
				<br>
				<input type="submit" value="Listar" class="submitVerde">&nbsp;<input type="reset" value="Limpar" class="submitVerde">
				</form>
				<br>
				</center>';
		}
?>