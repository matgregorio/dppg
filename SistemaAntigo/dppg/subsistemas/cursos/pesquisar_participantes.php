
<?php

include_once ('trataInjection.php');

if( protectorString($_POST[codigo_curso]) || protectorString($_POST[nome]))
    return;

$resultado = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

if (($_SESSION[logado_site_dppg]) && ($resultado)){

	include('includes/config2.php');	
	
	$codigo_curso = mysql_real_escape_string($_POST[codigo_curso]);
	$nome = mysql_real_escape_string($_POST[nome]);
	
	$sql = "select nome_curso from cursos where codigo_curso=$codigo_curso";
	$resultado = mysql_query($sql);
	$campos = mysql_fetch_array($resultado);
	$nome_curso = $campos[nome_curso];
	
	$sql = "select cpf, nome, email, telefone from participantes where nome like '%$nome%'
			 order by nome";
	
	$resultado = mysql_query($sql);
	$total_participantes = mysql_num_rows($resultado);

	$controle = 0;
   echo '<center>';
   $cor = "#95e197";

	while ($campos = mysql_fetch_array($resultado))
	{
		if ($controle == 0)
			echo '<br><br><center><b>Resultado da Pesqusia<br>
					Total de registros pesquisados: '.$total_participantes.'</b></center><br>
			<table>
			<tr bgcolor=#61C02D>
				<td ><font color="FFFFFF"><center><b><i>CPF</i></b></center></font></td>
				<td ><font color="FFFFFF"><center><b><i>Nome</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>E-mail</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Telefone</i></b></center></font></td>
			</tr>';
			
		$controle = 1;
		echo '<tr bgcolor="'.$cor.'">';
		echo	'<td>'.$campos[cpf].'</td>';		
		echo '<td>'.$campos[nome].'</td>';
		echo '<td>'.$campos[email].'</td>';
		echo '<td>'.$campos[telefone].'</td>';
		echo '<td><a href="index.php?arquivo=subsistemas/cursos/excluir_participante_interno.php&cpf='.$campos[cpf].'" title="Excluir Participante"><img src="images/delete.png" width="24" height="24" alt="" /></a></td></tr>';
			
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