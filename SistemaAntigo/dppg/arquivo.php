<?php

    include_once ('trataInjection.php');

    if (protectorString($_GET['num']))
        return;

    $qtd= $_GET['num'];
    
    echo '
    <table border="0">
        <tr>
            <td colspan=2> <input type="text" name="num_arq" size="2" value="'.$qtd.'" readonly/> </td>
        </tr>
    </table>
    ';
    
    for( $x=1; $x <= $qtd; $x++ ){
        
        echo "<table border=0>
        		  <tr>	
						<td width='70'><b> Arquivo ".$x." :<b></td>
			         <td width='300'><input name='arq_noticia[]' type='file'></td>		  			
			  	  </tr>
			  	  </table>";
    }
?>