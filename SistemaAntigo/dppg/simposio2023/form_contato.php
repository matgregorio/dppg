<?php
	header( 'Content-Type: text/html; charset=utf-8' );
?>

<script type="text/javascript" src="valida_contato.js"></script>

<?php

	 
	echo '<br><center><b>Contato</b></center>
			
			<br>
			<script src="valida_forms/validar_contato.js"></script>
			
			<table align=center>
				<form name="form_contato" method="POST" onsubmit="javascript: return checkcontatos()" action="index.php" enctype="multipart/form-data">
			<tr>
				<td>Nome:</td>
				<td><input name="nome" type="text" size="60"></td>
			</tr>			
			<tr>	
				<td>E-mail:</td>
				<td><input name="email" type="text" size="60"></td>
			</tr>			
			<tr>
				<td>Assunto:</td>
				<td><input name="assunto" type="text" size="60"></td>
			</tr>	
			<tr>	
				<td colspan=2>Mensagem:</td>
			</tr>
			<tr>	
				<td colspan=2><textarea name="mensagem" size="60" rows="10"></textarea></td>
			</tr>	
			<tr>
				<input type="hidden" name="arquivo" value="enviar_contato.php">
				<!--<input type="reset"  value="Limpar">-->
				<td colspan=2 align=center><input type="submit" value="Enviar"></td>
			</tr>
			</form>
			</table>		
			<br><br>
';
 
?>
