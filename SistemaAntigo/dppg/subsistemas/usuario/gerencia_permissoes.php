<?php
		include("includes/config2.php");
		include_once ('trataInjection.php');

		if(protectorString($_GET[codigo]))
			return;

		$codigo = mysql_real_escape_string($_GET[codigo]);
		

      
?>   