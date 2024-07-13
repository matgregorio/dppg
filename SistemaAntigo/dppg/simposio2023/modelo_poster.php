<?php
    include('includes/config.php');

    $sqlProgramacao = "SELECT * FROM arquivo WHERE codigo_arquivo = 10";
    $queryProgramacao = mysql_query($sqlProgramacao) or die("Não foi possível exibir o modelo de pôster");
    $programacao = mysql_fetch_array($queryProgramacao);

    $sqlProgramacaoPPT = "SELECT * FROM arquivo WHERE codigo_arquivo = 11";
    $queryProgramacaoPPT = mysql_query($sqlProgramacaoPPT) or die("Não foi possível exibir o modelo de pôster");
    $programacaoPPT = mysql_fetch_array($queryProgramacaoPPT);
    ?>

    <div style="margin-bottom: 20px;">
        <a style="text-decoration: underline; margin-bottom: 15px;" href="documentos/<?php echo $programacaoPPT[caminho_arquivo]?>" download>
            <h1><center>Clique aqui para baixar o arquivo editável em Power Point</center></h1>
        </a>
    </div>

    <div style="height: 100%">
        <embed src="documentos/<?php echo $programacao[caminho_arquivo];?>#zoom=FitH" width="800" height="1000px" alt="<?php echo "$programacao[nome_arquivo]";?>">
    </div>

    <?php
    echo '</table><br>';
    mysql_close($conexao);

?>
