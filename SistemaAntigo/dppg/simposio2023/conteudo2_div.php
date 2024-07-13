<?php
        if (protectorString($_REQUEST[arquivo2]) === false)
        {
            /*
               Verifica se existe o arquivo que foi passado como par�metro na vari�vel $arquivo
               Se existir o arquivo � executado, caso contr�rio � executado o arquivo padr�o lista_dvds.php
            */
            if (is_file($_REQUEST[arquivo2]))
               include("$_REQUEST[arquivo2]");
            else
               include("principal2.php");
        }
        else
                include("principal2.php");
         
/*
if (is_file("$_REQUEST[arquivo2]")) //is_file função para verificar se o arquivo existe
    include("$_REQUEST[arquivo2]"); //inclui o arquivo existente
else
    include("principal2.php"); //chama a página principal onde está o conteudo.php
*/
?>
