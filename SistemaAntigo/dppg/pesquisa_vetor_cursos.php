<?php
	/*
		Vetor de pesquisa sequencial em vetor. Recebe como parâmetro dois vetores onde pesquisa um dentro do outro.
		Se achar pelo menos um valor igual nos dois vetores, retorna TRUE, caso contrário, retorna FALSE
	*/
	function pesquisa_vetor_cursos($aux1, $aux2) {
   
		foreach ($aux1 as $x1)
			foreach ($aux2 as $y1) 
				if ($x1 == $y1)
					return(true);
				
		return(false);  
	}

?>
