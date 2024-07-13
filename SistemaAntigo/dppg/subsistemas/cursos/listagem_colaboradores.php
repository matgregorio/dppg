<?php
    include_once ('trataInjection.php');

    if(protectorString($_POST[id_grande_area]))
        return;

    $resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){

		include('includes/config2.php');
		
		$id_grande_area = mysql_real_escape_string($_POST[id_grande_area]);
		
		
		$sql = "select nome_area from area_atuacao where id_grande_area=$id_grande_area";
		$resultado = mysql_query($sql);
		$campos = mysql_fetch_array($resultado);
		$nome_grandearea = $campos[nome_area];
		
		$sql = "select colaboradores.nome, colaboradores.email, colaboradores.instituicao, colaboradores.cargo, colaboradores.titulacao,
		 colaboradores.areatuacao, colaboradores.peqareatuacao, colaboradores.subareatuacao, peq_areas_atuacao.nome_peq_area from colaboradores 
		 join peq_areas_atuacao on colaboradores.peqareatuacao=peq_areas_atuacao.id_peq_area
				 	where colaboradores.areatuacao='$id_grande_area' order by colaboradores.nome";
		$resultado = mysql_query($sql);
		$total_colaboradores = mysql_num_rows($resultado);
		
		$controle = 0;
	   echo '<center>';
	   $cor = "#95e197";
	   
		if($total_colaboradores == 0) {   
			echo '<br>
					Nenhum cadastro de avaliador na àrea "'.$nome_grandearea.'"<br>';
		} else {	
	   
	   while ($campos = mysql_fetch_array($resultado))
		{
			if ($controle == 0)
			
				echo '<br><br><center><b>Listagem dos colaboradores da área '.$nome_grandearea.'<br>
						Total de colaboradores: '.$total_colaboradores.'</b></center><br>
				
				<table>
				<tr bgcolor=#61C02D>
					<td ><font color="FFFFFF"><center><b><i>Nome do Avaliador</i></b></center></font></td>				
					<td><font color="FFFFFF"><center><b><i>E-mail</i></b></center></font></td>
					<td><font color="FFFFFF"><center><b><i>Instituição</i></b></center></font></td>
					<td><font color="FFFFFF"><center><b><i>Cargo</i></b></center></font></td>
					<td><font color="FFFFFF"><center><b><i>Titulação</i></b></center></font></td>				
					<!-- <td><font color="FFFFFF"><center><b><i>Grande Área</i></b></center></font></td> -->
					<td><font color="FFFFFF"><center><b><i>Pequena Área</i></b></center></font></td>
					<td><font color="FFFFFF"><center><b><i>Subárea</i></b></center></font></td>
				</tr>';
			
			$controle = 1;
			echo '<tr bgcolor="'.$cor.'">
					<td>'.$campos[nome].'</td>';
			echo '<td>'.$campos[email].'</td>';
			echo '<td>'.$campos[instituicao].'</td>';
			echo '<td>'.$campos[cargo].'</td>';
			echo '<td>'.$campos[titulacao].'</td>';
			//echo '<td>'.$campos[areatuacao].'</td>';
			echo '<td>'.$campos[nome_peq_area].'</td>';	
			echo '<td>'.$campos[subareatuacao].'</td>';
			
				
				if ($cor == "#78e07b")
	          	$cor = "#95e197";
	       	else
	          	$cor = "#78e07b";
		} 
		}
		echo '</table>';
		echo '</center><br>';
	}
	mysql_close($conexao);

?>