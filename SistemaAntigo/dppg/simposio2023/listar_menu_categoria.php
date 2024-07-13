<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			$sql = "select * from menu_categoria order by posicao_menu asc"; 
			$resultado = mysql_query($sql);
			$resultado1 = mysql_query($sql);
					$cor_tr = '#9BCD9B';
			echo '<center><br><h2>Editar Categoria do Menu</h2>';
			echo '<br>';
			
			echo "
			<br>
			<center>
					
			<table border=0 id='borda2'>
				<tr><td align=center colspan=5><b>Posição do Menu Horizontal Atual</b></td></tr>
				<tr bgcolor=$cor_tr>
					";
							//listar posições dos menus horizontais
							while($campos = mysql_fetch_array($resultado)) {
								echo "<td align=center bgcolor=$cor_td> $campos[posicao_menu] </td>";
							}	
			echo "
				</tr>
				<tr bgcolor=$cor_tr>
					";
							//listar nome dos menus horizontais
							while($campos1 = mysql_fetch_array($resultado1)) {
								echo "<td align=center bgcolor=#F0FFF0> 						<a href='index.php?arquivo=form_editmenu_categoria.php&codigo_categoria=$campos1[codigo_categoria]'>$campos1[nome_categoria]<img src=images/editar.png width=16 height=16 border=0 alt=editar></a></td></td>";
							}				
			echo "
				</tr>
			</table>	";
			echo"<br><br><b>Obs:  'Clicar' no nome do menu desejado para realizar a alteração.</b>";
			echo'</center>';
		}
		echo '<br><br><center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';		
		mysql_close($conexao);
	}
?>
