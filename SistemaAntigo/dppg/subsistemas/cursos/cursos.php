<?php
 
	include('includes/config2.php');	
	
	$sql = "select * from cursos where ativo='S' order by codigo_curso desc";
	
	$resultado = mysql_query($sql);

	$controle = 0;
   echo '<center>';
   $cor = "#95e197";

	while ($campos = mysql_fetch_array($resultado))
	{
		if ($controle == 0)
			echo '<br><br><center><b>Listagem dos cursos ofertados</b></center><br>
			<table>
			<tr bgcolor=#61C02D>
				<td ><font color="FFFFFF"><center><b><i>Nome do Curso</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Palestrante</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Data Início Inscrição</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Data Fim Inscrição</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Vagas</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Data Realização</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Horário Realização</i></b></center></font></td>
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
		if ((implode("", explode("-", $campos[data_inicio])) <= date("Ymd")) &&
			(implode("", explode("-", $campos[data_fim])) >= date("Ymd")) && ($campos[vagas] >= 1))  
			echo '<td><a href="index.php?arquivo=subsistemas/cursos/form_verifica_inscricao.php&codigo_curso='.$campos[codigo_curso].'" title="Fazer Inscrição"><img src="images/add.png" width="24" height="24"/></a></td>';
		echo '<td><a href="index.php?arquivo=subsistemas/cursos/form_certificado.php&codigo_curso='.$campos[codigo_curso].'" title="Emitir Certificado"><img src="images/certificado_curso.png" width="24" height="24"/></a></td>';
		echo '</tr>';			
		if ($cor == "#78e07b")
        	$cor = "#95e197";
      else
        	$cor = "#78e07b";
	} 
	echo '</table>';
	echo '</center><br>';
	mysql_close($conexao);
?>
