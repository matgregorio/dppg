<?php
		include("includes/config2.php");
		
		$codigo = mysql_real_escape_string($_GET[codigo]);
		
		$sqlADM = mysql_query("select * from usuarios u, participa_grupos pg where u.cpf=pg.cpf and codigo_grupo=1");				
		$cpfADM = mysql_fetch_array($sqlADM);
			   
	   //não lista usuarios adm
		$sql = "select * from usuarios u, participa_grupos p where u.cpf=p.cpf and p.cpf!='$cpfADM[cpf]' and p.codigo_sistema=$codigo order by nome asc";		
			
		//$sql = "select * from usuarios u, participa_grupos p where u.cpf=p.cpf and codigo_grupo!=1 and p.codigo_sistema=$codigo";
		$resultadoUm = mysql_query($sql);
		$linha = mysql_num_rows($resultadoUm); 
		
		$cor_tr = '#7CCD7C';
		$cor_td1 = '#E0EEE0';
		$cor_td2 = '#C1FFC1';				

		echo "<br>
		<center>
		<table id='borda2' width='100%'>
		
				<tr><td align=center colspan=3><b> &nbsp;&nbsp;&nbsp;&nbsp; Usuários &nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr>
				
				<tr align=center bgcolor=$cor_tr>
							<td><b> &nbsp; Nome &nbsp;</b></td>
							<td colspan=2><b> &nbsp; Ações &nbsp;</b></td>      
            <tr>";
      if($linha==0){
			echo "<tr>		
							<td colspan=3 bgcolor=$cor_td1 align=center><b> &nbsp; Usuários não econtrados &nbsp;</b></td>      
         </tr>";      
      }      
		
      $i=1;
				
		while ( $campos = mysql_fetch_array($resultadoUm) ) 
		{
				if($i %2 ==0) 
				{
						echo"
						<tr align=center bgcolor=$cor_td2>
							<td width='30%' align=left> &nbsp;&nbsp; $campos[nome]</td>";
							
							echo "<td width='5%'><a href='index.php?arquivo=subsistemas/usuario/form_alterar_usuario.php&cpf=".$campos[cpf]."'><img src=images/editar.png width=16 height=16 border=0 alt=editar> </td>";
							
						echo "	
							<td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_usuario.php&cpf=$campos[cpf]\"  onClick=\"return confirm('Confirma exclusão de $campos[nome]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
						</tr>";
				}
				else{
						echo"
						<tr align=center bgcolor=$cor_td1>
							<td width='30%' align=left> &nbsp;&nbsp; $campos[nome]</td>";
		
								echo "<td width='5%'><a href='index.php?arquivo=subsistemas/usuario/form_alterar_usuario.php&cpf=".$campos[cpf]."'><img src=images/editar.png width=16 height=16 border=0 alt=editar> </td>";
		
							echo "
							<td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_usuario.php&cpf=$campos[cpf]\"  onClick=\"return confirm('Confirma exclusão de $campos[nome]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
						</tr>"; 
						}
						
				$i++;
		}
      echo "
				<tr align=right bgcolor=$cor_td2>
					<td colspan=4>
					<table border=0>
					<tr>					
						<td><a href=index.php?arquivo=subsistemas/usuario/form_cad_usuario.php><b>Novo Usuário</b></a></td>
						<td><a href=index.php?arquivo=subsistemas/usuario/form_cad_usuario.php><img src=images/cadastrar.png width=16 height=16 border=0 alt=Cadastrar></td></a>
					</tr>
					</table>
				<tr>	
			</table>";
      
?>   