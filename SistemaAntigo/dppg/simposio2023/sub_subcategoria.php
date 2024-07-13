<?php
		include("includes/config2.php");
		
		$codigo = mysql_real_escape_string($_GET[codigo_sub_subcategoria]);
		
		$sql = "select * from menu_sub_subcategoria where menu_subcategoria='$codigo'";
		
		$resultado = mysql_query($sql);		
		
	
		echo "<option value='0'> Selecione uma sub subcategoria </option>";
      while($row = mysql_fetch_array($resultado) ){
            echo "<option value='".$row['codigo_sub_subcategoria']."'>".$row['nome_sub_subcategoria']."</option>";

      }
    	
?>   
