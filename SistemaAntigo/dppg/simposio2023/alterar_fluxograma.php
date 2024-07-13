<?php
session_start();

if (in_array(1, $_SESSION[codigo_grupo]))
{
    include('acentuacao.php');
    include('includes/config.php');  
    include_once ('funcao.php');

    $nomeArquivo = $_FILES['arquivo']['name'];
    $pastaUpload = '/var/www/dppg/simposio2021/documentos/';
    $caminhoArquivoServidor = $pastaUpload . basename($_FILES['arquivo']['name']);

    echo '<pre>';
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminhoArquivoServidor))
        {
            $formatoImagem = strtolower(pathinfo($caminhoArquivoServidor, PATHINFO_EXTENSION));

            if ($formatoImagem != "jpg" && $formatoImagem != "png" && $formatoImagem != "jpeg" && $formatoImagem != "gif" && $formatoImagem != "pdf")
            {
                echo "Erro: Apenas JPG, JPEG, PNG, GIF e PDF são permitidos.";
                return;
            }
            else
            {
                $query = "update arquivo set caminho_arquivo='$nomeArquivo' where codigo_arquivo='7'";
                if(mysql_query($query))
                {
                    echo "<br><br><br><br><br><br><br>";
                    echo "<center><font color='#006400'><b>Fluxograma alterado com sucesso!!!</b></font></center>";
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
            uploadErrors($_FILES['arquivo']['error']);
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