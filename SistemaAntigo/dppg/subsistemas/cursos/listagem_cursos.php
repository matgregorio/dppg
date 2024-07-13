
<?php
 
$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){

	include('includes/config2.php');	
	
	$sql = "select * from cursos order by codigo_curso desc";
	
	$resultado = mysql_query($sql);

	$controle = 0;
   echo '<center>';
   $cor = "#95e197";

	while ($campos = mysql_fetch_array($resultado))
	{
		if ($controle == 0)
			echo '<br><br><center><b>Listagem dos cursos ofertados<br>
					Total de cursos ofertados: '.mysql_num_rows($resultado).'</b></center><br>
			<table>
			<tr bgcolor=#61C02D>
				<td ><font color="FFFFFF"><center><b><i>Nome do Curso</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Palestrante</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Data Início Inscrição</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Data Fim Inscrição</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Vagas</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Data Realização</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Horário</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Ativo</i></b></center></font></td>
			</tr>';
		
		$data_inicio = implode("/", array_reverse(explode("-", $campos[data_inicio])));
		$data_final = implode("/", array_reverse(explode("-", $campos[data_fim])));	
		$data_realizacao = implode("/", array_reverse(explode("-", $campos[data_realizacao])));	
			
		$controle = 1;
		echo '<tr bgcolor="'.$cor.'">
					<td>'.$campos[nome_curso].'<br><br><a href="" onClick="window.open(\'subsistemas/cursos/descricao_curso.php?codigo_curso='.$campos[codigo_curso].'\',\'Janela\',\'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=760,height=350,left=25,top=25\'); return false;"><b>+Descrição do Curso</b></a></td>';
		echo '<td>'.$campos[palestrante].'</td>';
		echo '<td>'.$data_inicio.'</td>';
		echo '<td>'.$data_final.'</td>';
		echo '<td>'.$campos[vagas].'</td>';
		echo '<td>'.$data_realizacao.'</td>';
		echo '<td>'.$campos[horario_realizacao].'</td>';
		echo '<td>'.$campos[ativo].'</td>';
		echo '<td><a href="index.php?arquivo=subsistemas/cursos/form_manut_curso.php&codigo_curso='.$campos[codigo_curso].'" title="Editar Curso"><img src="images/curso.png" width="24" height="24" alt="" /></a></td></tr>';
			
			if ($cor == "#78e07b")
          	$cor = "#95e197";
       	else
          	$cor = "#78e07b";
	} 
	echo '</table>';
	echo '</center><br>';
	}
	mysql_close($conexao);
?>