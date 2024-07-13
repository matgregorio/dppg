<?php
	session_start();
	
	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
		
			//seleciona ultimo valor inserido na tabela grupo_usuario no banco
			$sql = "SELECT * FROM grupo_usuario order by codigo_grupo desc limit 1";
			$consulta = mysql_query($sql);
			
			$campo = mysql_fetch_array($consulta);
			$codigo = $campo[codigo_grupo] + 1;
			
			echo '
			<script src="subsistemas/usuario/valida_forms/valida_cad_nivel.js" type="text/javascript"></script>
			
			<center><br><h2>Cadastrar Nível de Usuário</h2><br>
		
			<form name="form_cad_nivel" method="POST" onsubmit="javascript: return checknivel()" action="index.php">
				<table border="0" align=center>
					<tr>
						<td><b>Codigo do Nível: </b></td>
						<td><input type=text name=codigo size=2 value="&nbsp;&nbsp;'.$codigo.'" readonly></td>
					</tr>
					<tr>
					 	<td><b>Nome Nível: </b></td>
					   <td><input type=text name=nome_nivel><font color="#FF0000"> *</font></td>
					</tr>
					<tr>
					 	<td colspan=2><b>Descrição Nível: </b></td>
					</tr>
					<tr> 	
					   <td colspan=2><input type=text name=descricao_nivel size=60><font color="#FF0000"> *</font></td>
					</tr>
					<tr>
						<td colspan=2><b><font color=red>IMPORTANTE</font>: O codigo do nível a cima deverá ser utilizado para fazer as<br> devidas restrições nos subsistemas</b></td>
					</tr>
				</table>
		  			
		  			<input type="hidden" name="arquivo" value="subsistemas/usuario/cadastrar_nivel.php">
		
				<br>
				
				<input type="submit" value="Enviar" class="submitVerde"><input type="reset" value="Limpar" class="submitVerde"><a href="index.php?arquivo=subsistemas/usuario/listar_ger_niveis.php"><input type="button" value="Voltar"></a>
				<input type="hidden" name="codigo_nivel" value="'.$codigo.'">
			</form>
			
			<br></center>';
		}
		mysql_close($conexao);
	}
?>
