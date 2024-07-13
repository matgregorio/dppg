<?php
	
	 include('includes/config2.php');
    $sql = "SELECT * FROM area_atuacao ORDER BY nome_area";
    $res = mysql_query($sql,$conexao);
    $num = mysql_num_rows($res);
    

	echo '	<script language="javascript">
				function CarregaCurso(codArea)
				{
					if(codArea){
        			var myAjax = new Ajax.Updater("chamaPeqArea","carregaPequenaArea.php?codArea=" + codArea,
					{
						method : "get",
					}) ;
    				}	
				}
				</script>
	
			<script src="validar2.js" type="text/javascript"></script>
			<center>
			<br>
			<b>Formulário de Registros</b>
			<br><br>
			<form name="form_registro" method="POST" onsubmit="javascript: return checkregistro()" action="index.php">
			
		<table border="0" width="500" class="esquerda">
			<tr>
  				<td>Nome completo:</td>
  				<td><input type="text" name="nome" size="50" maxlength="80"><font color="#FF0000"></font></td>
			</tr>
			<tr>
  				<td>E-mail:</td>
  				<td><input type="text" name="email" size="50" maxlength="50"><font color="#FF0000"></font></td>
			</tr>
			<tr>
				<td>Usuário:</td>
				<td><input type="text" name="usuario" size="20" maxlength="20"><font color="#FF0000"></font></td>
			</tr>
			<tr>
				<td>Senha:</td>
				<td><input type="password" name="senha" size="12" maxlength="16"><font color="#FF0000"></font></td>
			</tr>
			<tr>
				<td>Verificar senha:</td>
				<td><input type="password" name="verificasenha" size="12" maxlength="16"><font color="#FF0000"></font></td>
			</tr>
			<tr>
				<td>Instituição de Origem:</td>
				<td><input type="text" name="instituicao" size="50" maxlength="150"><font color="#FF0000"></font></td>
			</tr>			
			<tr>
				<td>Cargo/Emprego:</td>
				<td>
				<select name="cargo" size="0">
					<option value=""></option>
					<option value="Docente">Docente</option>
					<option value="Técnico Administrativo">Técnico Administrativo</option>
					<option value="Outro">Outro</option>
				</select>
				</td>
			</tr>		
				
			<tr>
				<td>Titulação:</td>
				<td>
				<select name="titulacao" size="0">
					<option value=""></option>
					<option value="Graduação">Graduação</option>
					<option value="Especialização">Especialização</option>
					<option value="Mestrado">Mestrado</option>
					<option value="Doutorado">Doutorado</option>
				</select>			
				</td>
			</tr>	
			
			<tr>
				<td>Área de atuação:</td>
				<td>
				<select name="atuacao" size="0" id="atuacao" onchange="CarregaCurso(this.value)">
				<option value="0">Selecione a grande área</option>
				<option value="0"></option>';
				//for($j = 0; $j < ($num - 1); $j++){
				while($dados = mysql_fetch_array($res)){
					//$dados = mysql_fetch_array($res);
					$id = $dados['id_grande_area'];
					$name = $dados['nome_area'];
					echo '<option value="'.$id.'">'.$name.'</option>';
				}
				
		echo'
				</select>
				</td>
			</tr>			
			
			<tr>
				<td></td>
				<td>';
?>
				<div id="chamaPeqArea">
				<select name="peq_areas_atuacao" size="0" id="peq_areas_atuacao">
					<option value="0">Selecione a pequena área</option>
				</select>	
				</div>
<?php

	echo '						
			</td>
			</tr>	
			
			<tr>
				<td>Subárea de atuação:</td>
				<td><input type="text" name="subareatuacao" size="50" maxlength="50"><font color="#FF0000"></font></td>
			</tr>		
			
			<tr>  
  				<input type="hidden" name="arquivo" value="registra_colaborador.php">
			</tr>			
			
			</table>
			
			<br><br>
		<input type="submit" value="Cadastrar" class="submitVerde">&nbsp;<input type="reset" value="Limpar" class="submitVerde">
		</form>
		<br>
		</center>';
?>
