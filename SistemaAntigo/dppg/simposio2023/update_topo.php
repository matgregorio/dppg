<?php

include('includes/config.php');
include('acentuacao.php');
include_once ('funcao.php');


$dir = getcwd() . "/" . "images/";
$arquivo = $_FILES[arquivo][name];

$tamanho = getimagesize($_FILES[arquivo][tmp_name]);

if (eregi("^image\/(pjpeg|jpeg|png|gif|bmp)", $_FILES[arquivo]["type"]))
{
    if ($_FILES[arquivo][size] <= 2000000) /*2MB*/
    {
        /*Verificar a largura e altura da imagem*/
        if (($tamanho[0] <= 3800) && ($tamanho[1] <= 750))
        {
            $sql = "select topo from conteudo where codigo_conteudo ='1'";
            $resultado = mysql_query($sql);
            $campos = mysql_fetch_array($resultado);

            chmod($dir, 777);

            unlink($dir . $campos[topo]);

            if (move_uploaded_file($_FILES[arquivo][tmp_name], $dir . $arquivo))
            {
                $sql1 = "update conteudo set topo='$arquivo' where codigo_conteudo='1'";
                $resultado1 = mysql_query($sql1);

                echo '<center><font color="#006400"><b>Imagem Topo alterada com sucesso!!!</b></font></center>';
            }
            else
            {
                uploadErrors($_FILES[arquivo][error]);
                return;
            }
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