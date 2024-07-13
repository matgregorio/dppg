<html xmlns="http://www.w3.org/1999/xhtml">

<head>

   <!--  <script src="js/jquery-1.3.2.min.js" type="text/javascript"></script> -->

    <script type="text/javascript">
        $(document).ready(function(){
            $('#categoria').change(function(){
                $('#subcategoria').load('subcategoria_um.php?codigo_subcategoria='+$('#categoria').val() );

            });
        });

    </script>
    
</head>

<body>

<?php

	include("includes/config2.php");
	
	//verificar se existe alguma banner cadastrado
	$busca_banner = mysql_query("select * from banner");
	$cont_b = mysql_num_rows($busca_banner);	

	if($cont_b == 0){
		$sql= 'select * from noticias order by codigo_noticia desc limit 0,15';
		
	}
	else{
				$sql= 'select * from noticias order by codigo_noticia desc limit 0,10';
		 }	
	
	$resultado = mysql_query($sql);
	
	//listar noticias
	echo '<div id="box4">';
		echo '<b>&nbsp&nbspNOTÍCIAS</b><br>';	
	
		while ($campos = mysql_fetch_array($resultado)) 
		{
			echo '<br><a href="index.php?arquivo=detal_noticia.php&codigo_noticia='.$campos[codigo_noticia].'">'.date("d/m", strtotime($campos[data_noticia])).' >> '.$campos[titulo_noticia].' <br> ';
		}
		echo '<br><a href="index.php?arquivo=listar_todas_noticias.php"><b>Outras notícias</b></a>';
	
	echo '</div>';
	
	//listar formularios 
	
	/*	
	echo '<div id="box4">';	
	
		echo '<b>&nbsp&nbspDOCUMENTOS</b><br>';
		//echo "<script src='valida_forms/validar_lis_form.js'></script>";
		
		
		echo'
		<form name="form_list_form" method="post" action="index.php" onsubmit="javascript: return checklistform()" enctype="multipart/form-data">
			<table border=0 >
				<tr>
					<td colspan=2>
						<select name="categoria" id="categoria" style="min-width:200px">
								 <option selected value="0">Selecione um menu</option>';
								 
						       include("includes/config2.php"); 
						       $result = mysql_query("select * from menu_categoria");
								 
						       while($row = mysql_fetch_array($result) ){
						             echo "<option value='".$row['codigo_categoria']."'>".$row['nome_categoria']."</option>";
						
						       }
						        echo '<option value="0">Todos Documentos</option>
						    
					   </select>
	 				</td>	
 				</tr>
 				<tr>
 					<td>
		 					<select name="subcategoria" id="subcategoria" style="min-width:200px">
		    					<option selected value="0">Selecione um menu</option>
							</select>
 					</td>
 					<td><input type="submit" value="Listar" class="submitCinza"></td>			
				</tr>
 			</table>
 				<input type="hidden" name="arquivo" value="listar_formulario.php">
 		</form>';
 		
 	
			
		//echo '<br><a href="index.php?arquivo=listar_todos_formularios.php"><b>Outros Documentos</b></a>';

	echo '</div>
	<br>';
	*/	  
	mysql_close($conexao);
?>
</body>
</html>