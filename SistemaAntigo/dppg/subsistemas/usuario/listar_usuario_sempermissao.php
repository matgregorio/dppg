echo "<br>
<center>
<table id='borda2' width='100%'>
	<tr>
			<td align=center colspan=3>
				<b> &nbsp;&nbsp;&nbsp;&nbsp; Usuários &nbsp;&nbsp;&nbsp;&nbsp;</b>
			</td>
	</tr>
	<tr align=center bgcolor=$cor_tr>
				<td><b> &nbsp; Nome &nbsp;</b></td>
				<td colspan=2><b> &nbsp; Ações &nbsp;</b></td>      
   <tr>";
$i=1;
while ( $camposUsuarios = mysql_fetch_array($sqlUsuarios) ) 
{
		if($i %2 ==0) 
		{
				echo"
				<tr align=center bgcolor=$cor_td2>
					<td width='30%' align=left> &nbsp;&nbsp; $camposUsuarios[nome]</td>";
					
					echo "<td width='5%'><a href='index.php?arquivo=subsistemas/usuario/form_alterar_usuario.php&cpf=".$camposUsuarios[cpf]."'><img src=images/editar.png width=16 height=16 border=0 alt=editar> </td>";
					
				echo "	
					<td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_usuario.php&cpf=$camposUsuarios[cpf]\"  onClick=\"return confirm('Confirma exclusão de $camposUsuarios[nome]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
				</tr>";
		}
		else{
				echo"
				<tr align=center bgcolor=$cor_td1>
					<td width='30%' align=left> &nbsp;&nbsp; $camposUsuarios[nome]</td>";

						echo "<td width='5%'><a href='index.php?arquivo=subsistemas/usuario/form_alterar_usuario.php&cpf=".$camposUsuarios[cpf]."'><img src=images/editar.png width=16 height=16 border=0 alt=editar> </td>";

					echo "
					<td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_usuario.php&cpf=$camposUsuarios[cpf]\"  onClick=\"return confirm('Confirma exclusão de $camposUsuarios[nome]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
				</tr>"; 
				}
		$i++;
}
echo "</table>";