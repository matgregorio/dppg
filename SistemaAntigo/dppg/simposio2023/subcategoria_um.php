<?php
		include("includes/config2.php");
		
		$codigo = mysql_real_escape_string($_GET[codigo_subcategoria]);
		
		$sql = "select * from menu_subcategoria where categoria='$codigo'";
		$resultado = mysql_query($sql);		

       while($row = mysql_fetch_array($resultado) ){
            echo "<option value='".$row['codigo_subcategoria']."'>".$row['nome_subcategoria']."</option>";

       }
       if($codigo == 0) 
       {
       	echo' <option value="0">Todos Formulários</option>';
       }
       else {
       			echo' <option value="0">Todos Formulários Categoria</option>';
       		}

?>   
