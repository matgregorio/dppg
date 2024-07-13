<?php

function datapassada($data)
{
    $string = $data;
    $entrada = trim($string);
    if (strstr($entrada, "/")) {
        $aux2 = explode("/", $entrada);
        $datai = $aux2[2] . "-" . $aux2[1] . "-" . $aux2[0];
    }

    return $datai;
}

function datadobanco($data)
{
    $string = $data;
    $entrada = trim($string);
    if (strstr($entrada, "-")) {
        $aux2 = explode("-", $entrada);
        $datai2 = $aux2[2] . "/" . $aux2[1] . "/" . $aux2[0];
    }

    return $datai2;
}

function datasemcaracter($data)
{
    $string1 = $data;

    $entrada1 = trim($string1);

    if (strstr($entrada1, "/")) {
        $aux1 = explode("/", $entrada1);
        $data1 = $aux1[2] . $aux1[1] . $aux1[0];
    }

    return $data1;
}

/***
 * @param $codigoErro Código de erro do upload. Use a função "$_FILES['nome_arquivo']['error'] como parâmetro ao passar essa função"
 */
function uploadErrors($codigoErro)
{
    $mensagemErro = "Mensagem de erro não definida";
    echo"Erro ao fazer upload do arquivo\n\n";
    echo $codigoErro;
    switch ($codigoErro)
    {
        case 1:
            $mensagemErro = "Valor 1; O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.";
            break;
        case 2:
            $mensagemErro = "Valor: 2; O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML";
            break;
        case 3:
            $mensagemErro = "Valor: 3; O upload do arquivo foi feito parcialmente.";
            break;
        case 4:
            $mensagemErro = "Valor: 4; Nenhum arquivo foi enviado.";
            break;
        case 6:
            $mensagemErro = "Valor: 6; Pasta temporária ausente. Introduzido no PHP 5.0.3";
            break;
        case 7:
            $mensagemErro = "Valor: 7; Falha em escrever o arquivo em disco. Introduzido no PHP 5.1.0.";
            break;
        case 8:
            $mensagemErro = "Valor: 8; Uma extensão do PHP interrompeu o upload do arquivo.";
            break;
    }
    echo $mensagemErro;
}

?>