<?php
		include("includes/config2.php");
		include_once ('trataInjection.php');

		if (protectorString($_GET[codigo_subcategoria]))
			return;

		$codigo = mysql_real_escape_string($_GET[codigo_subcategoria]);
		
		$sql = "select * from menu_sub_subcategoria where menu_subcategoria='$codigo' order by posicao asc";
		$resultadoUm = mysql_query($sql);
		$resultadoDois = mysql_query($sql);
		$linha = mysql_num_rows($resultadoUm);
		
		$cor_tr = '#9BCD9B';		
	
		if($linha!=0){
			
					echo "<br>
					<center>
					<table id='borda2'>
					
							<tr><td align=center colspan=2><b> &nbsp;&nbsp;&nbsp;&nbsp;Posições das Sub-Subcategorias &nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr>
							<tr align=center bgcolor=$cor_tr>
										<td><b> &nbsp; Posição &nbsp;</b></td>
			         			   <td><b> Nome </b></td>      
			            <tr>";
					
			      while($rowUm = mysql_fetch_array($resultadoUm) )
			      {
			      		echo "<tr align=center>
			
						            <td bgcolor=$cor_tr>".$rowUm['posicao']."</td>
			         			   <td>".$rowUm['nome_sub_subcategoria']."</td>
			            
			            <tr>";
			      }
			      echo "</table></center>";
		}	      
					
		echo "<br><br>
				<b> Posição Nova Sub-Subcategoria</b> &nbsp;&nbsp;  
				
				<select name=combo_posicao>
						<option selected value='0'>Selecione uma opção</option>";
						
						while($rowDois = mysql_fetch_array($resultadoDois)) 
						{
							echo "<option value=$rowDois[posicao]>$rowDois[posicao]</option>";
							$aux=$rowDois[posicao]+1;
						}
												
						
						if($linha!=0){
							echo "<option value=$aux>$aux</option>";
						}	
						if($linha==0){
							echo "<option value=1>1</option>";
						}	
		echo "</select>";
		
				
		
 
?>   