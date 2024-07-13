<?php
		include("includes/config2.php");
		
		$codigo = mysql_real_escape_string($_GET[codigo]);
			
			$cpf = $_SESSION['cpf'];
			$cor_tr = '#7CCD7C';
			$cor_td1 = '#E0EEE0';
			$cor_td2 = '#C1FFC1';
			
			
			$sqlADM = mysql_query("select * from usuarios u, participa_grupos pg where u.cpf=pg.cpf and codigo_grupo=1");				
			$cpfADM = mysql_fetch_array($sqlADM);
			   
			//não lista permissoes relacionadas ao adm
			$sql = "select * from usuarios u, participa_grupos p where u.cpf=p.cpf and p.cpf!='$cpfADM[cpf]' and p.codigo_sistema=$codigo order by nome asc"; 
						
			$resultado = mysql_query($sql);
			
			echo "<br><table border=0 width='98%' id='borda2'>
			
			<tr align=center bgcolor=$cor_tr height='30px'>
					<td><b>Nome<b></td>
					<td><b>Nível<b></td>
					<td><b>Subsitema<b></td>
					<td><b>Excluir<b></td>
			</tr>";
			$i=0;
			while ($campos = mysql_fetch_array($resultado)) 
			{
				//selecionar nome do nivel
				$sqlTres = mysql_query("select * from grupo_usuario where codigo_grupo=$campos[codigo_grupo]");
				$campoN = mysql_fetch_array($sqlTres);
				
				//selecionar nome do subsistema			
				$sqlDois = mysql_query("select * from menu_sistemas s, participa_grupos p where s.codigo_menu=p.codigo_sistema and codigo_menu=$codigo");
				$campoS = mysql_fetch_array($sqlDois);
				if($i %2 ==0) {
				echo"
				<tr align=center bgcolor=$cor_td1 height='30px'>
					<td width='35%'>$campos[nome]</td>
					<td width='30%' >$campoN[nome_grupo]</td>
					<td width='30%'>$campoS[nome_menu]</td>
					
					<td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_permissao.php&cpf=$campos[cpf]\"  onClick=\"return confirm('Retirar permissão de $campos[nome] do subsistema $campoS[nome_menu]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
				</tr>";
				}
				else{
				echo"
				<tr align=center bgcolor=$cor_td2 height='30px'>
					<td width='35%'>$campos[nome]</td>
					<td width='30%' >$campoN[nome_grupo]</td>
					<td width='30%'>$campoS[nome_menu]</td>
					
					<td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_permissao.php&cpf=$campos[cpf]\"  onClick=\"return confirm('Retirar permissão de $campos[nome] do subsistema $campoS[nome_menu]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
				</tr>"; }
				$i++;	
			}
			echo "
				<tr align=right bgcolor=$cor_td2 height='30px'>
					<td colspan=4>
					<table border=0>
					<tr>					
						<td><a href=index.php?arquivo=subsistemas/usuario/form_permissao.php><b>Nova Permissão</b></a></td>
						<td><a href=index.php?arquivo=subsistemas/usuario/form_permissao.php><img src=images/cadastrar.png width=16 height=16 border=0 alt=Cadastrar></td></a>
					</tr>
					</table>
				<tr>	
			</table>";
		
    
?>   