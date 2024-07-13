<?php
   session_start();
   header("Content-type: image/jpeg");
   
    function captcha($tamanho_fonte,$quantidade_letras)
    {
		  $fonte = rand(1,2);
        $imagem = imagecreate(90,35);
        $fonte = "images/fontes/$fonte.ttf";
        $preto  = imagecolorallocate($imagem,255,255,255);
        $branco = imagecolorallocate($imagem,0,0,0);
       
        $palavra = substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz23456789"),0,($quantidade_letras));
        $_SESSION["valor"] = strtolower($palavra);
        
        for($i = 1; $i <= $quantidade_letras; $i++)
        {
            imagettftext($imagem,$tamanho_fonte,rand(-25,25),($tamanho_fonte*$i),($tamanho_fonte + 5),$branco,$fonte,substr($palavra,($i-1),1));
        }
        
        imagejpeg($imagem);
        imagedestroy($imagem);
    }
   
    $tamanho_fonte = 18;
    $quantidade_letras = 4;
    
    captcha($tamanho_fonte,$quantidade_letras);
    
?>
