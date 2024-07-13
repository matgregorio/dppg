<?php

include('includes/config.php');
include('acentuacao.php');


$dir = getcwd() . "/" . "images/";
echo $dir . "\n";
$arquivo = $_FILES[arquivo][name];

$tamanho = getimagesize($_FILES[arquivo][tmp_name]);

if (eregi("^image\/(pjpeg|jpeg|png|gif|bmp)", $_FILES[arquivo]["type"]))
{echo"formato aceito\n";
    if ($_FILES[arquivo][size] <= 2000000) /*2MB*/
    {echo "Tamanho: " . $_FILES[arquivo][size] . "\n";
        /*Verificar a largura e altura da imagem*/
        if (($tamanho[0] <= 3800) && ($tamanho[1] <= 750))
        {echo "Dimens: $tamanho[0]" . " $tamanho[1]\n";
            $sql = "select topo from conteudo where codigo_conteudo ='1'";
            $resultado = mysql_query($sql);
            $campos = mysql_fetch_array($resultado);

            chmod($dir, 777);

            unlink($dir . $campos[topo]);

            if (move_uploaded_file($_FILES[arquivo][tmp_name], $dir . $arquivo))
            { "Está no servidor \n";
                $sql1 = "update conteudo set topo='$arquivo' where codigo_conteudo='1'";
                $resultado1 = mysql_query($sql1);
                echo "SQL : ". $resultado1 . "\n";

                echo '<center><font color="#006400"><b>Imagem Topo alterada com sucesso!!!</b></font></center>';
            }
            else
                echo "Erro: " .  $_FILES['arquivo']['error'];
        }
        else
            echo '<center><font color="#FF0000"><b>A imagem deve ter no máximo, dimensão 3800(largura) X 750(Altura) pixels!!!</b></font></center>';
    }
    else
        echo '<center><font color="#FF0000"><b>Tamanho  da imagem tem que conter no máximo 2 Mb</b></font></center>';
}
else
{
    echo '<center><font color="#FF0000"><b>Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png.</b></font></center>';
}

echo '<meta http-equiv="refresh" content="3; URL=form_alterar_topo.php">';
?>