<?php
			session_start();
	
			include("includes/config2.php");
			$sql = "select * from participantes order by nome"; 
			$resultado = mysql_query($sql);
			$linha = mysql_num_rows($resultado);
?>
			
			<script>
				<!-- Script busca de arquivos por nome --> 
				jQuery('document').ready(function(){
					jQuery('#loading').hide();
					jQuery('#buscarn').click(function(){
						jQuery('#buscarn').val('');
					});
					jQuery('#buscarn').keyup(function(){
						jQuery('#loading').ajaxStart(function(){
							jQuery('#alvo').hide();
							jQuery('#loading').show();	
						});
						jQuery('#loading').ajaxStop(function(){
							jQuery('#loading').hide();	
						});
						jQuery.post('subsistemas/cursos/buscar_participantes.php',
						{busca: jQuery('#buscarn').val()},
						function(data){
							if (jQuery('#buscarn').val()!=''){
								jQuery('#alvo').show();
								jQuery('#alvo').empty().html(data);
							}
							else{
								jQuery('#alvo').empty();
							}
						}
						);
					});
				});
				
			</script>

<?php			
			echo '<br><br><center><b>&nbsp&nbspPesquisar Participantes</b></center><br>
					
					<div id="buscan">
					
	               <form name="form_list_form" method="post" action="index.php" onsubmit="javascript: return checklistform()" enctype="multipart/form-data">
																
								
	               	<br><hr><br>
	               		Buscar participante:<br>
	                		<input type="text" id="buscarn" placeholder="Informe o nome do arquivo" size="37" name="buscan">
          		</div>
          			
          			<br><hr>
          			
          			<div id="alvo"></div>		
			
			<table border=0>
			';	
			if($linha==0) {
				echo '<tr><td><a href="#">Nenhum participante cadastrado !</b></td></tr>';
			}
			
			echo '
			</table>
			
			</center>';	
		
		echo '<center><br><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a><br><br></center>';	
		mysql_close($conexao);
	
?>
