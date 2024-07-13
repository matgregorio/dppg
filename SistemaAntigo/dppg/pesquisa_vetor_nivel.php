<?php
	/*
		Vetor de pesquisa sequencial em vetor. Recebe como parâmetro dois vetores onde pesquisa um dentro do outro.
		Se achar pelo menos um valor igual nos dois vetores, retorna TRUE, caso contrário, retorna FALSE
	*/
	function pesquisa_vetor_nivel($xx, $yy) {
   
		foreach ($xx as $aa)
			foreach ($yy as $bb) 
				if ($aa == $bb)
					return(true);
				
		return(false);  
	}

?>
