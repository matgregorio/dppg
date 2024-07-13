<?php
		include("includes/config2.php");
		$sql = "select * from links_externos where tipo_link=2 order by nome_link asc"; 
		$resultado = mysql_query($sql);
		
		echo '<table align=center>';
		echo '<tr>';
		
		while ($campos = mysql_fetch_array($resultado)) {
	
		
		echo '<td>
					<a href='.$campos[endereco_link].' target=_"blank"> 
			 		<img src="images/links/'.$campos[imagem_link].'" width="85" height="50" border="2" ></a>
			 	</td>';	
		
		}

		echo '</tr>
		</table>';
		//mysql_close($conexao);
?>