<?php
session_start();

// função do gd, para criar uma imagem, com o tamanho definido largura, altura
$imagem = imagecreate(70, 15);

// função que define a cor de fundo da imagem gerada pelo gd
$fundo = imagecolorallocate($imagem, 190, 180, 180);

// função que define a cor da fonte
$fonte = imagecolorallocate($imagem, 0, 0, 0);

//echo 'gd <br>';
//echo $_SESSION['autenticagd'];

// desenhando a imagem, baseada nos padrões informados acima
// verificando a sessão aberta, para informar ao formulário o que foi digitado
imagestring($imagem, 4, 0, 0, $_SESSION['autenticagd'], $fonte);


// header, necessário
header("Content-type: image/png");

// formato da imagem PNG.
imagepng($imagem);
?>
