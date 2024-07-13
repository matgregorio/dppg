<?php
	
	$_SESSION['menu_sistema'] = FALSE;	   
	
	echo'<div id="centralizar">';
	
		echo '<br><center><font color=#006400><b>Saída do Sub-Sistema '.$_SESSION['nome_menu'].' com sucesso!</b></font></center><br>';
		echo '<META HTTP-EQUIV="Refresh" Content="1; URL=index.php">';
	echo'</div>';
		
?>
