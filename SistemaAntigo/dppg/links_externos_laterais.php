<?php
		include("includes/config2.php");
		$sql = "select * from links_externos where tipo_link=1 order by nome_link asc"; 
		$resultado = mysql_query($sql);

		$linha = mysql_num_rows($resultado);
		if($linha==0) { echo '<br><font color=#006400><b>Nenhum link lateral cadastrado !</b></font>'; }		
		

		
		echo '<table align=center>';
		while ($campos = mysql_fetch_array($resultado)) 
		{
		echo '<tr>
		
					<td>
						<a href='.$campos[endereco_link].' target=_"blank"> 
			 			<img src="images/links/'.$campos[imagem_link].'" width="115" height="80"></a>
			 		</td>
			 		
			 	</tr>';	
		
		}
		
		
			/* echo '<a href='.$campos[endereco].' target=_"blank"> 
			 <img src="arquivo_links/'.$campos[imagem_link].'" width="90" height="50" border="1" ><br></a>';*/
			echo '</table>';
		mysql_close($conexao);
?>