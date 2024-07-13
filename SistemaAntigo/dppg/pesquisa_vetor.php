<?php
	/*
		Vetor de pesquisa sequencial em vetor. Recebe como parâmetro dois vetores onde pesquisa um dentro do outro.
		Se achar pelo menos um valor igual nos dois vetores, retorna TRUE, caso contrário, retorna FALSE
	*/
	function pesquisa_vetor($p1, $p2) {
   
		foreach ($p1 as $v1)
			foreach ($p2 as $v2) 
				if ($v1 == $v2)
					return(true);
				
		return(false);  
	}

?>
