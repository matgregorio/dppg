
<?php

include_once ('trataInjection.php');

if(protectorString($_POST[codigo_curso]))
    return;

$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){

	include('includes/config2.php');	
	
	$codigo_curso = mysql_real_escape_string($_POST[codigo_curso]);
	
	$sql = "select nome_curso from cursos where codigo_curso=$codigo_curso";
	$resultado = mysql_query($sql);
	$campos = mysql_fetch_array($resultado);
	$nome_curso = $campos[nome_curso];
	
	$sql = "select participantes.cpf, participantes.nome, participantes.email, participantes.telefone, inscricao.data_inscricao,
			 	inscricao.presenca from participantes join inscricao on inscricao.cpf=participantes.cpf 
			 	where inscricao.codigo_curso='$codigo_curso' order by participantes.nome";
	
	$resultado = mysql_query($sql);
	$total_participantes = mysql_num_rows($resultado);

	$controle = 0;
   echo '<center>';
   $cor = "#95e197";

	while ($campos = mysql_fetch_array($resultado))
	{
		if ($controle == 0)
			echo '<br><br><center><b>Listagem de participantes do curso '.$nome_curso.'<br>
					Total de participantes: '.$total_participantes.'</b></center><br>
			<table>
			<tr bgcolor=#61C02D>
				<td><font color="FFFFFF"><center><b><i>Nome</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>E-mail</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Telefone</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Data Inscrição</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Presença</i></b></center></font></td>
			</tr>';
			
		$controle = 1;
		echo '<tr bgcolor="'.$cor.'">
					<td>'.$campos[nome].'</td>';
		echo '<td>'.$campos[email].'</td>';
		echo '<td>'.$campos[telefone].'</td>';
		echo '<td>'.implode("/", array_reverse(explode("-", $campos[data_inscricao]))).'</td>';
		echo '<td>'.$campos[presenca].'</td>';
		echo '<td><a href="index.php?arquivo=subsistemas/cursos/excluir_inscricao_interno.php&codigo_curso='.$codigo_curso.'&cpf='.$campos[cpf].'" title="Excluir Inscrição"><img src="images/delete.png" width="24" height="24" alt="" /></a></td></tr>';
			
			if ($cor == "#78e07b")
          	$cor = "#95e197";
       	else
          	$cor = "#78e07b";
	} 
	echo '</table>';
	echo '<a href="subsistemas/cursos/gerar_lista_presenca.php?codigo_curso='.$codigo_curso.'" target="_blank"><img src="images/barcode.png" width="32" height="32" alt="" />&nbsp;&nbsp;Gerar Lista de Presença</a>';
	echo '</center><br>';
	}
	mysql_close($conexao);
?>