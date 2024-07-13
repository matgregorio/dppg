<?php
	session_start();
	
	if ($_SESSION['logado_site_dppg'])
	{
		include("includes/config2.php");
		
		$cor_tr = '#7CCD7C';
		$cor_td1 = '#E0EEE0';
		$cor_td2 = '#C1FFC1';		
		
		if ($pesquisa_adm) 
		{
			echo '<center><br><br><b>&nbsp&nbsp Gerência de Níveis</b><br><br>';
			
			echo "<table border=0 width='50%' id='borda2'>
			
			<tr align=center bgcolor=$cor_tr>
					<td ><b>Nome<b></td>
					<td colspan=3><b>Ações<b></td>
			</tr>";
			
			//seleciona os grupo que não possuem relacionamentos
			$sql= "select * from grupo_usuario where codigo_grupo>2 and nome_grupo not in (select distinct nome_grupo from grupo_usuario gu, participa_grupos pg where gu.codigo_grupo=pg.codigo_grupo)";
			$resultado = mysql_query($sql);
		
			$linha = mysql_num_rows($resultado);
			if($linha==0) 
			{
				echo '<br><font color="#006400"> >> Nenhum nível de usuário disponivel para alteração !</center><br><br>';		
			}
			
			$i=1;
				
			while ( $campos = mysql_fetch_array($resultado) ) 
			{
					if($i %2 ==0) 
					{
							echo"
							<tr align=center bgcolor=$cor_td1>
								<td width='30%' align=left> &nbsp;&nbsp; $campos[nome_grupo]</td>
								
								<td width='5%'><a href='index.php?arquivo=subsistemas/usuario/form_alterar_nivel.php&codigo_grupo=".$campos[codigo_grupo]."'><img src=images/editar.png width=16 height=16 border=0 alt=editar> </td>
								
								<td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_nivel.php&codigo_grupo=$campos[codigo_grupo]\"  onClick=\"return confirm('Confirma exclusão de $campos[nome_grupo]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
							</tr>";
					}
					else{
							echo"
							<tr align=center bgcolor=$cor_td2>
								<td width='30%' align=left> &nbsp;&nbsp; $campos[nome_grupo]</td>
								
								<td width='5%'><a href='index.php?arquivo=subsistemas/usuario/form_alterar_nivel.php&codigo_grupo=".$campos[codigo_grupo]."'><img src=images/editar.png width=16 height=16 border=0 alt=editar> </td>
								
								<td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_nivel.php&codigo_grupo=$campos[codigo_grupo]\"  onClick=\"return confirm('Confirma exclusão de $campos[nome_grupo]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
							</tr>"; 
							}
					$i++;
			}
			echo "
				<tr align=right bgcolor=$cor_td2>
					<td colspan=4>
					<table border=0>
					<tr>					
						<td><a href=index.php?arquivo=subsistemas/usuario/form_cad_usuario.php><b>Novo Nível</b></a></td>
						<td><a href=index.php?arquivo=subsistemas/usuario/form_cad_nivel.php><img src=images/cadastrar.png width=16 height=16 border=0 alt=Cadastrar></td></a>
					</tr>
					</table>
				<tr>	
			</table>";			
					
		}
				  
	}	
?>
