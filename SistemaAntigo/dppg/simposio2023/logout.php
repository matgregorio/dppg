<?php
	session_start();
	session_unset();
	session_destroy();
	//echo '<meta http-equiv="refresh" content="1;simposio.php" />';
	echo'<div id="centralizar">';
		echo '<br><center><font color=#006400><b>Saída com sucesso!</b></font></center><br>';
	echo'</div>';

	echo '<META HTTP-EQUIV="Refresh" Content="2; URL=index.php">';
		
?>
