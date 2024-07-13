<?php
	session_start();
	include_once ('trataInjection.php');

	if(protectorString($_GET[codigo_grupo]))
		return;
	
	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
			
			$codigo_grupo = mysql_real_escape_string($_GET[codigo_grupo]);			
			
			$sql = "select * from grupo_usuario where codigo_grupo=$codigo_grupo";
			$resultado = mysql_query($sql);
		
			if(mysql_num_rows($resultado)) 
			{
				$campos = mysql_fetch_array($resultado);
				echo '
					<script src="subsistemas/usuario/valida_forms/valida_alterar_nivel.js" type="text/javascript"></script>
					
					<center><br><b>Alterar Nível de Usuario</b><br><br>
		
					<form name="form_alterar_nivel" method="POST" onsubmit="javascript: return checkaaltnivel()" action="index.php">
						<table border="0" width="500" class="esquerda">
							<tr>
								<td><b>Codigo do Nível: </b></td>
								<td><input type=text name=codigo size=2 value="&nbsp;&nbsp;'.$campos[codigo_grupo].'" readonly></td>
							</tr>
							<tr>
				  				<td><b>Nome do Nível:</b></td>
				  				<td><input type="text" name="nome" size="30" maxlength="60" value="'.$campos[nome_grupo].'"><font color="#FF0000"> *</font></td>
							</tr>
							<tr>
				  				<td colspan=2><b>Descrição do Nível:</b></td>
				  			</tr>
				  			<tr>	
				  				<td colspan=2><input type="text" name="descricao_nivel" size="47" value="'.$campos[descricao_grupo].'"><font color="#FF0000"> *</font></td>
							</tr>
						</table>
						
						<br>
						
							<input type="hidden" name="arquivo" value="subsistemas/usuario/alterar_nivel.php">
							<input type="hidden" name="codigo_grupo" value="'.$campos[codigo_grupo].'">
							<input type="submit" value="Alterar" class="submitVerde">
							<a href="index.php"><input type="button" value="Voltar"></a>
					</form>
					
					<br></center>';
			}
			else
				echo "<center><br><br><b>Dados inválidos!!!</b></center>";
		}		
		mysql_close($conexao);
	}
?>
