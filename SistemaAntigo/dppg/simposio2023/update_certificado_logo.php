<?php

include('includes/config.php');
include('acentuacao.php');

if ($_FILES[arquivo][name] != "") {

    $dir = "images/";

    $arquivo = $_FILES[arquivo][name];

    //$tamanho = getimagesize($_FILES[arquivo][tmp_name]);


    if (eregi("^image\/(pjpeg|jpeg|png|gif|bmp)", $_FILES[arquivo]["type"])) {
        //if($_FILES[arquivo][size] <= 204800) /*200kB*/
        //{
        /*Verificar a largura e altura da imagem*/
        //if(($tamanho[0] == 175) &&  ($tamanho[1] == 102))
        //{
        $sql = "select imagem_assinatura from conteudo where codigo_conteudo ='9'";
        $resultado = mysql_query($sql);
        $campos = mysql_fetch_array($resultado);

        chmod($dir, 777);

        unlink($dir . $campos[imagem_assinatura]);

        if (move_uploaded_file($_FILES[arquivo][tmp_name], $dir . $arquivo)) {
            $sql1 = "update conteudo set assinatura = '', cargo='', imagem_assinatura='$arquivo', assinatura_certificado='2'  where codigo_conteudo='9'";
            $resultado1 = mysql_query($sql1);

            echo '<center><font color="#006400"><b>Imagem Direita Inferior Certificado alterado com sucesso!!!</b></font></center>';
            echo '<meta http-equiv="refresh" content="3; URL=form_alterar_certificado_logo.php">';
        }
        //}
        ///	else
        //		{
        //			echo '<center><font color="#FF0000"><b>A imagem deve ter dimensão 175(largura) X 102(Altura) pixels!!!</b></font></center>';
        //			echo '<meta http-equiv="refresh" content="3; URL=form_alterar_banner.php">';
        //		}
        /*}
        else
            {
                echo '<center><font color="#FF0000"><b>Tamanho  da imagem tem que ser no máximo 200kb</b></font></center>';
                 echo '<meta http-equiv="refresh" content="3; URL=form_alterar_banner.php">';
             }*/
    } else {
        echo '<center><font color="#FF0000"><b>Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png.</b></font></center>';
        echo '<meta http-equiv="refresh" content="3; URL=form_alterar_certificado_logo.php">';
    }
}

?>