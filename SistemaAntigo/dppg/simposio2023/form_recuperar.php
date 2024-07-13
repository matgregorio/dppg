<?php
	
	session_start();
	if(in_array("1", $_SESSION[codigo_grupo]))
	{
		header( 'Content-Type: text/html; charset=utf-8' );
?>
<html>
<head>
<title> Restaurar BD</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/JavaScript" src="js/valida_recuperar.js"></script> 
</head>
<body>
<?php
	session_start();
	
	if ($_SESSION[logado_simposio_2014])
	{

		include('includes/config.php');
								
		echo "<div id='conteudo3'>
				<br>
				<center><b>Restaurar Banco de Dados<b><br><br></center>
				<center>
				<form name='form_recuperar' method='POST' onsubmit='javascript: return checkcontatos()' action='recuperar.php' enctype='multipart/form-data'>
				<table border='0' class='esquerda'>
				<tr>			
					<td align='center'>Arquivo Banco de Dados:</td>			
				</tr>		
				<tr>
					<td align='center'><input type='file' name='arquivo'></td>
				</tr>
				<tr>
					<td><br></td>
				<tr>	
				<tr>	
					<td colspan='2' align='center'>
						<input type='submit' name='OK' value='OK'>
					</td>			
				</tr>
				</table>
							
				</form> 
				</center>
				</div>";
		
	}
	
	mysql_close($conexao);	
	?>
</body>
</html>
<?php
	}
?>