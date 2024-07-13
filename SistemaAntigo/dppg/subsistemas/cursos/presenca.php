<?php
	session_start();
    include_once ('trataInjection.php');

    if( protectorString($_POST[confirma]) || protectorString($_POST[codigo_curso]) || protectorString($_POST[cpf]))
        return;


	$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));


	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){
		include('includes/config2.php');
	
		echo '<br><center><b><i>Presença Participantes</i></b></center>';
	
		if($_POST[confirma] == 'S')
		{
		
			$sql1 = "select participantes.nome, inscricao.presenca from inscricao join participantes on participantes.cpf=inscricao.cpf where  
						inscricao.codigo_curso = '$_POST[codigo_curso]' and inscricao.cpf='$_POST[cpf]'"; 
		
		$resultado1 = mysql_query($sql1);

			$sql3 = "select nome_curso from cursos where codigo_curso='$_POST[codigo_curso]'";
			$resultado3 = mysql_query($sql3);
			$campos3 = mysql_fetch_array($resultado3);
		
		if(mysql_num_rows($resultado1) == 0)
		{
			echo '<br>';
			echo '<center>Participante não cadastrado no curso <b>'.$campos3[nome_curso].'</b>!!!<br></center>';
			echo '<center><meta http-equiv="refresh" content="4;URL=index.php?arquivo=subsistemas/cursos/presenca.php&codigo_curso='.$_POST[codigo_curso].'" /></center>';
		}
		else
		{		
			echo '<br>';
			while($campos1 = mysql_fetch_array($resultado1))
			{
				$sql2 = "update inscricao set presenca ='S' where cpf='$_POST[cpf]' and 
				codigo_curso ='$_POST[codigo_curso]'";
				$resultado2 = mysql_query($sql2);
				echo '<center><b>'.$campos1[nome].'</b></center>';
				echo '<center>Presença efetuada com sucesso no curso <b>'.$campos3[nome_curso].'</b>!!!</center>';	
			}
		
			//echo '<center>Presença efetuada com Sucesso!!!<br>';			
			echo '<center><meta http-equiv="refresh" content="4;URL=index.php?arquivo=subsistemas/cursos/presenca.php&codigo_curso='.$_POST[codigo_curso].'" /></center>';		
		}
	}	

	echo '<br>
			<form name="form_presenca" method="POST" action="index.php">
				<center>	
			<table border="0" width="50%">	
			<tr>
				<td align="center">Curso:</td>			
				<td><select name="codigo_curso" size="1">';
				
				
				$sql = "select * from cursos";
				$resultado = mysql_query($sql);
				
				
				while($campos = mysql_fetch_array($resultado))
				{
					if ($campos[codigo_curso] == $_REQUEST[codigo_curso])
					   echo "<option value='$campos[codigo_curso]' selected>$campos[nome_curso]</option>";
					else 
					   echo "<option value='$campos[codigo_curso]'>$campos[nome_curso]</option>";
				}
				
	echo	'</select></td>
			</tr>		
			<tr>
				<td align="center">CPF:</td>
				<td><input type="text" name="cpf" size="20" maxlength="11"></td>	
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Marcar Presença" class="submitVerde"></td>				
				<input type="hidden" name="arquivo" value="subsistemas/cursos/presenca.php">
				<input type="hidden" name="confirma" value="S">			
			</tr>
			</table>
			</center>
			</form>
			<br>
			<script language=\'JavaScript\' type=\'text/javascript\'>
  				document.form_presenca.cpf.focus()
			</script>
			
	';
	
	}
?>