<html>
<head>
	<!-- Carregar arquivos na mesma pagina-->	
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
    $(function conteudo(num){
        $("#link").click(function(){
            var num = $('#num_arq').val();
            $("#conteudo_arquivo").load("arquivo.php?num="+num+"");
        });
    })
    </script>
</head>    
</html>

<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
	
			echo "  
			<center><h2> Cadastro de Noticias</h2></center>
	
			<script src='valida_forms/validar_cad_noticia.js'></script>
			
			<form name='form_cad_noticia' method='post' action='index.php' onsubmit='javascript: return checknoticia()'  enctype='multipart/form-data'>
				<table  align='center'>
			    	<tr align='left'>
						<td><b>Titulo da Notícia </b></td>
						<td><input type='text' name='titulo_noticia' maxlength='150' size='60'></td>
					</tr>
					<tr align='left' >
						<td valign='top' colspan='2'><b><br>Conteudo :</b>
						<textarea name='conteudo_noticia' rows='10' cols='70'></textarea></td>
					</tr>
					<tr>
						<td colspan=2><b><br>O envio de arquivo ou imagens não é obrigatorio<br><br>
						<font color=#B22222>Obs: Ao cadastrar imagens utilize uma resolução ate 800 pixels x 600 pixels</font></b><br><br></td>
					</tr>
					<tr>
	         		<td colspan='2'><b>Quantidade de arquivos e imagens:</b></td>
	         	</tr>
		         <tr>
			            <td colspan=2>
			            	<div id='conteudo_arquivo'>
			            	
				            <table border='0'> 	
				                <tr>
				                    <td> <input type='text' id='num_arq' name='num_arq' size='2'/> </td>
				                    
				                    <td> <a href='javascript: conteudo();' id='link'><input type='button' value='Ok'></a> </td>
				                </tr>
				            </table>
				            
				            </div>    
							</td>
					</tr>		       
				</table>
			
			<center><br>
				<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
				<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>		
				<input type='hidden' name='arquivo' value='cadastrar_noticia.php'>
			</center>
				
			</form><br>"; 
		}		
		mysql_close($conexao);
	}	
?>
