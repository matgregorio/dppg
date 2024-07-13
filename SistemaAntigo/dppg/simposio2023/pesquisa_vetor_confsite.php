<?php
	
	function pesquisa_vetor_confsite($m1, $m2) {
   
		foreach ($m1 as $j1)
			foreach ($m2 as $j2) 
				if ($j1 == $j2)
					return(true);
				
		return(false);  
	}

?>
