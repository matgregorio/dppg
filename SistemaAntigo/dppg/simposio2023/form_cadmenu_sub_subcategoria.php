<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- <script src="js/jquery-1.3.2.min.js" type="text/javascript"></script> -->

   <script type="text/javascript">
        $(document).ready(function(){
            $('#combo_subcategoria').change(function(){
                $('#posicao').load('posicao_menu_sub_subcategoria.php?codigo_subcategoria='+$('#combo_subcategoria').val() );

            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#combo_categoria').change(function(){
                $('#combo_subcategoria').load('subcategoria.php?codigo_subcategoria='+$('#combo_categoria').val() );

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
			//selecionar apenas categorias que possuiem subcategorias permitindo o cadastro
			$sql = "select distinct nome_categoria, codigo_categoria, posicao_menu from menu_categoria mc, menu_subcategoria ms where mc.codigo_categoria=ms.categoria"; 
		   $resultado = mysql_query($sql);
			
			echo "  
				<center><h2> Cadastro da Sub-Subcategoria Menu Horizontal</h2></center>
		
				<script src='valida_forms/validar_cadsub_menu.js'></script>
				<form name='form_cadmenu_sub_subcategoria' method='post' onsubmit='javascript: return checkmenu()' action='index.php'>
					<table align='center'>
						<tr align=center>
							<td colspan=2><b> Categoria: </b>&nbsp;&nbsp; 
							
							<select id='combo_categoria' name='combo_categoria' size='1'>
							<option selected value='0'>Selecione uma opção</option>";
				  			while($campos = mysql_fetch_array($resultado)) 
				  			{
				  				echo"<option value=$campos[codigo_categoria]> $campos[nome_categoria] </option> ";
				 			}
				 			echo "</select>
				 			</td>
					   </tr>
					   <tr align=center>
		 						<td colspan=2><b> Subcategoria: </b>&nbsp;&nbsp; 
				 				
				 						<select name='combo_subcategoria' id='combo_subcategoria'>
				    							<option value='0'>Selecione uma categoria</option>
										</select>
		 						</td>			
						</tr>
					   <tr>
					   	<td colspan=2>
					   		<div id=posicao>
					   		
					   		</div>
					   	</td>
					   </tr>
				    	<tr>
						
							<td align='left'><b>Nome da Subcategoria </b></td>
							<td align='left'><input type='text' name='nome_sub_subcategoria' maxlength='60' size='50'></td>
							
						</tr>
						<tr align='left' >
							<td valign='top' colspan='2'><b>Conteudo </b>
							<textarea name='conteudo_sub_subcategoria' rows='10' cols='70'></textarea></td>
						</tr>
					</table>
				
					<center>
						<input type='hidden' name='arquivo' value='cad_menu_sub_subcategoria.php'>
						<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
						<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
					</center>	
				</form><br>";
				
			}		
			mysql_close($conexao);
	}		
?>
</body>
</html>
