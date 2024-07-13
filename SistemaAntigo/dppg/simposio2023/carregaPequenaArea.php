<?php
 
	include ('includes/config2.php');

	$codArea = $_GET['codArea'];

	$sql = "SELECT id_peq_area, nome_peq_area FROM peq_areas_atuacao WHERE id_grandearea='$codArea'";
	$res = mysql_query($sql,$conexao);
	$num = mysql_num_rows($res);

?>
	<select name="peq_areas_atuacao" id="peq_areas_atuacao">
	<option value="0">Selecione a pequena área</option>
	<option value="0"></option>
	
	<?php 
	for($j = 0;$j < $num; $j++)
	{
		$dados = mysql_fetch_array($res);
		$id = $dados["id_peq_area"];
		$name = $dados["nome_peq_area"];
	?>
	<option value="<?php echo $id?>"><?php echo $name?></option>
<?php }?>
	</select>
