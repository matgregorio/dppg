<?php
	/*
		Vetor de pesquisa sequencial em vetor. Recebe como parâmetro dois vetores onde pesquisa um dentro do outro.
		Se achar pelo menos um valor igual nos dois vetores, retorna TRUE, caso contrário, retorna FALSE
	*/
	function pesquisa_vetor3($x, $y) {
   
		foreach ($x as $a)
			foreach ($y as $b) 
				if ($a == $b)
					return(true);
				
		return(false);  
	}

?>
