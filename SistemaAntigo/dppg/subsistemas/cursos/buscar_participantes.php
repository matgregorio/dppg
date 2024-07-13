<?php

	include ('../../includes/config2.php');
	include_once ('trataInjection.php');

	if(protectorString($_POST[nome]) || protectorString($_POST[telefone]) || protectorString($_POST[email]) || protectorString($_POST[cpf]))
		return;

	if (isset($_POST['busca']))
	{
		$queryString = $_POST['busca'];
			
		$sql = "select * from participantes where nome like '$queryString%'";
			
		$resultado = mysql_query($sql);
		
		$linha = mysql_num_rows($resultado);
		
		$cor = "#E0EEE0";
		
		if($linha!=0){		
			echo '<table border=0>';
				echo "<tr bgcolor='#61C02D' height='25'>
							<td ><font color='FFFFFF'><center><b>CPF</b></center></font></td>
							<td ><font color='FFFFFF'><center><b>Nome</b></center></font></td>
							<td><font color='FFFFFF'><center><b>E-mail</b></center></font></td>
							<td><font color='FFFFFF'><center><b>Telefone</b></center></font></td>
						</tr>";
						
				while(  $camp = mysql_fetch_array($resultado) ) {
					echo "<tr bgcolor='".$cor."' height='25'>";
						echo "<td>".$camp[cpf]."</td>";					
						echo "<td>".$camp[nome]."</td>";	
						echo "<td>".$camp[email]."</td>";
						echo "<td>".$camp[telefone]."</td>";
						echo "<td><a href=\"index.php?arquivo=subsistemas/cursos/excluir_participante_interno.php&cpf=$camp[cpf]\"  onClick=\"return confirm('Confirma exclusão do participante $camp[nome]?')\"> <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>";
					echo "</tr>";
					
					if ($cor == "#C1FFC1")
		          	$cor = "#E0EEE0";
		       	else
		          	$cor = "#C1FFC1";
				}		
			echo '</table>';
		}		
	}
		
?>
