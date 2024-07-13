<?php
		include("includes/config2.php");
		include_once ('trataInjection.php');

		if(protectorString($_GET[codigo_categoria]))
			return;
		
		$codigo = mysql_real_escape_string($_GET[codigo_categoria]);
		
		$sql = "select * from menu_subcategoria where categoria='$codigo' order by posicao asc";
		$resultadoUm = mysql_query($sql);
		$resultadoDois = mysql_query($sql);
		
		$cor_tr = '#9BCD9B';		

		echo "<br>
		<center>
		<table id='borda2'>
		
				<tr><td align=center colspan=2><b> &nbsp;&nbsp;&nbsp;&nbsp;Posições das Subcategorias &nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr>
				<tr align=center bgcolor=$cor_tr>
							<td><b> &nbsp; Posição &nbsp;</b></td>
         			   <td><b> Nome </b></td>      
            <tr>";
		
      while($rowUm = mysql_fetch_array($resultadoUm) )
      {
      		echo "<tr align=center>

			            <td bgcolor=$cor_tr>".$rowUm['posicao']."</td>
         			   <td>".$rowUm['nome_subcategoria']."</td>
            
            <tr>";
      }
      echo "</table></center>";
      
		echo "<br><br>
				<b> Posição Nova Subcategoria</b> &nbsp;&nbsp;  
				
				<select name=combo_posicao>
						<option selected value=''>Selecione uma opção</option>";
						
						while($rowDois = mysql_fetch_array($resultadoDois)) 
						{
							echo "<option value=$rowDois[posicao]>$rowDois[posicao]</option>";
							$aux = $rowDois[posicao]+1;
						}					
						echo "<option value='0'>$aux</option>";
		echo "</select>";
      
?>   