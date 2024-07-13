<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if IE]><link rel="shortcut icon" href="img/favicon.ico"><![endif]-->
<link rel="icon" href="img/favicon.ico">

<?php
session_start();

if (in_array(1, $_SESSION[codigo_grupo]))
{
    include('acentuacao.php');
    include('includes/config.php');
    include_once ('funcao.php');

    $nomeArquivo = $_FILES['arquivo_programacao']['name'];
    

    /*Retira acentos e substitui espaços por underlines*/
    $nomeExibicao = filter_input(INPUT_POST, 'nome_exibicao', FILTER_SANITIZE_SPECIAL_CHARS);
    $nomeExibicao = strtoupper( preg_replace("/[^a-zA-Z0-9-]/", "_", strtr(utf8_decode(trim($nomeExibicao)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),"aaaaeeiooouuncAAAAEEIOOOUUNC-"))); //Retira acentos e espaços
    $nomeExibicao .= ".pdf";

    $pastaUpload = getcwd() . "/documentos/";
    $caminhoArquivoServidor = $pastaUpload . $nomeExibicao;

    if(!chmod ($caminhoArquivoServidor, 0777))
        echo "Aviso: erro ao obter permissão do servidor, talvez o arquivo já exista..\n\n";

    echo '<pre>';
    if (move_uploaded_file($_FILES['arquivo_programacao']['tmp_name'], $caminhoArquivoServidor))
    {
        $formatoImagem = strtolower(pathinfo($pastaUpload . $_FILES['arquivo_programacao']['name'], PATHINFO_EXTENSION));

        if ($formatoImagem != "pdf")
        {
            echo "Erro: Apenas arquivo com formato PDF é permitido.";
            return;
        }
        else
        {
            if($nomeExibicao == "")
                $nomeExibicao = "PROGRAMACAO_SIMPOSIO.pdf";

            $queryNomeExibicao = "UPDATE arquivo SET nome_arquivo = '$nomeExibicao' WHERE codigo_arquivo = '9'";
            $updateNomeExibicao = mysql_query($queryNomeExibicao) or die("Erro ao alterar nome de exibição do arquivo");

            $query = "update arquivo set caminho_arquivo='$nomeExibicao' where codigo_arquivo='9'";

            if(mysql_query($query))
            {
                echo "<br><br><br><br><br><br><br>";
                echo "<center><font color='#006400'><b>Programação alterada com sucesso!!!</b></font></center>";
                echo "<font color='#006400'><b> <center>Fechando esta janela...</center></font>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<script type='text/javascript'>setTimeout('window.close();', 4000);</script>";
            }
            else
            {
                echo "<font color='red'><b> <center>Erro ao gravar dados no banco de dados</center></font>";
            }
        }
    }
    else
    {
        uploadErrors($_FILES['arquivo_programacao']['error']);
    }

    print "</pre>";
}
else
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Apenas administradores logados podem acessar esta página</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
}
?>