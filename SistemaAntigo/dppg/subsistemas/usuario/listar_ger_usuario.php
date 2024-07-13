<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- <script src="js/jquery-1.3.2.min.js" type="text/javascript"></script> -->

   <script type="text/javascript">
        $(document).ready(function(){
            $('#combo_categoria').change(function(){
                $('#posicao').load('gerencia_usuario.php?codigo='+$('#combo_categoria').val() );

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
		$pesquisa_subadm = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('2'));
		
		$cpf = $_SESSION[cpf];
		
  			include("includes/config2.php");
			
			if($pesquisa_admgeral) 
			{
				$sql = "select * from menu_sistemas where codigo_menu>1";
			}
			elseif($pesquisa_subadm) {
					$sql = "select * from menu_sistemas s, participa_grupos p where s.codigo_menu=p.codigo_sistema and p.cpf=$cpf";
				}	
		   $resultado = mysql_query($sql);
			
			echo "  
				<center><h2> Gerência de Usuário </h2></center>
					<table align='center'>
						<tr align=center>
							<td colspan=2><b> Subsistema: </b>&nbsp;&nbsp; 
							
							<select id='combo_categoria' name='combo_categoria' size='1'>
							<option selected value='0'>Selecione um subsistema</option>";
				  			while($campos = mysql_fetch_array($resultado)) 
				  			{
				  				echo"<option value=$campos[codigo_menu]> $campos[nome_menu] </option> ";
				 			}
				 			echo "</select>
				 			</td>
					   </tr>
					   <tr>
					   	<td colspan=2>
					   		<div id=posicao>
					   		
					   		</div>
					   	</td>
					   </tr>
				    	
					</table>
				
					"; 
					
			mysql_close($conexao);
	}		
?>
</body>
</html>
