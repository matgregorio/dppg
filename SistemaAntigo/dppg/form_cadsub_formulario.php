<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#categoria').change(function(){
                $('#subcategoria').load('subcategoria.php?codigo_subcategoria='+$('#categoria').val() );

            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#subcategoria').change(function(){
                $('#sub_subcategoria').load('sub_subcategoria.php?codigo_sub_subcategoria='+$('#subcategoria').val() );

            });
        });

    </script>
</head>

<body>

<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$sql = "select * from menu_categoria";
		   $resultado = mysql_query($sql);
		   
		   $sql1 = "select * from menu_subcategoria";
		   $resultado1 = mysql_query($sql1);
	   
	   	echo "<script src='valida_forms/validar_cad_formulario.js'></script>";
	   	
			echo '<center><h2>Enviar Documento para Sub Subcategoria</h2></center>
			
				<form name="form_cadsub_formulario" method="post" action="index.php" onsubmit="javascript: return checksubformulario()" enctype="multipart/form-data">
					<table border=0 height="300" align=center>
						<tr>
								<td><b>Categoria:</b></td>
								<td>
									<select name="categoria" id="categoria">
										<option value="0">Selecione uma categoria</option>';
							    
							       		include("includes/config2.php"); 
							       		$result = mysql_query("select * from menu_categoria");
										
							       		while($row = mysql_fetch_array($result) )
							       		{
							            	echo "<option value='".$row['codigo_categoria']."'>".$row['nome_categoria']."</option>";
											}
							    
						 echo '</select>
		 				</td>
		 				</tr>	
		 				<tr>	
		 						<td><b>Subcategoria: </b></td>
		 						<td>
				 						<select name="subcategoria" id="subcategoria">
				    							<option value="0">Selecione uma categoria</option>
										</select>
		 						</td>			
						</tr>
						<tr>	
		 						<td><b>Sub Subcategoria: </b></td>
		 						<td>
				 						<select name="sub_subcategoria" id="sub_subcategoria">
				    							<option value="0">Selecione uma subcategoria</option>
										</select>
		 						</td>			
						</tr>
						<tr>
								<td><b>Título do Documento</b>: </td>
								<td><input type="text" name="titulo_formulario" size="40" maxlength="100"></td>
						</tr>
						<tr>	
								<td><b>Arquivo:<b></td>
				         	<td><input name="arq_formulario" type="file"></td>		  			
				  		</tr>
						<tr>	
								<td colspan=2 align=center>
										<input type="submit" value="Enviar" class="submitCinza">
										<a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a>
								</td>
						</tr>
						
				  			<input type="hidden" name="arquivo" value="cadastrar_sub_formulario.php">
				  			
					</table>
				</form>';
		}	
		mysql_close($conexao);
	}
?>
</body>
</html>