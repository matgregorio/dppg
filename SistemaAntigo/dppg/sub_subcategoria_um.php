<?php
		include("includes/config2.php");
		include_once ('trataInjection.php');

		if (protectorString($_GET[codigo_sub_subcategoria]))
			return;
		
		$codigo = mysql_real_escape_string($_GET[codigo_sub_subcategoria]);
		
		$sql = "select * from menu_sub_subcategoria where menu_subcategoria='$codigo'";
		$resultado = mysql_query($sql);		

		 if($codigo == 0) 
       {
       	echo' <option value="0">Todos Formulários</option>';
       }
       else {
       			echo' <option value="0">Todos Formulários Sub Subcategoria</option>';
       		}
		
      while($row = mysql_fetch_array($resultado) ){
            echo "<option value='".$row['codigo_sub_subcategoria']."'>".$row['nome_sub_subcategoria']."</option>";

       }
      

?>   
