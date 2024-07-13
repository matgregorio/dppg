<?php

	include("includes/config2.php");
    include_once ('trataInjection.php');

    if (protectorString($_GET[codigo_menu]))
        return;

	$codigo_menu = mysql_real_escape_string($_GET[codigo_menu]);
	
	$sql = "select * from menu_sistemas where codigo_menu='$codigo_menu'";
	$resultado = mysql_query($sql);
	$campos = mysql_fetch_array($resultado);
	
	echo '<br><br><center><b>'.$campos[nome_menu].'</b></center>
			
		<table align=center>
		<tr>
			<td>			
			<p class="conteudo"> '.$campos[descricao_sistema].' </p> <br>
			</td>
		</tr>
		</table>
	';
	
	
	echo '<center><br><br><br><br><br><br><b>Para ter acesso ao conteúdo restrito do site faça o "Login" !</b></center>';
?>