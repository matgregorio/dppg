<?php
		include("includes/config2.php");
		
		$codigo = mysql_real_escape_string($_GET[codigo_subcategoria]);
		
		$sql = "select * from menu_subcategoria where categoria='$codigo'";
		$resultado = mysql_query($sql);		
		$auxx = mysql_num_rows($resultado);
		
		echo "<option value='0'> Selecione categoria </option>";
      while($row = mysql_fetch_array($resultado) ){
            echo "<option value='".$row['codigo_subcategoria']."'>".$row['nome_subcategoria']."</option>";

      }
    
?>   
