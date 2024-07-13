<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title>Alterar Prazo para exibição das notas das avaliações externas</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!--<script type="text/JavaScript" src="js/compara_data.js"></script>-->
    </head>
<body>
    <?php
    session_start();
    if ($_SESSION[logado_simposio_2021])
    {
        ?>
        <div id="conteudo3">
        <br>
        <center><b>Alterar data para exibição das notas das avaliações externas</b><br><br></center>
        <?php
        if ($_POST[confirma] == "S")
        {
            include('includes/config.php');
            $opc = mysql_real_escape_string($_POST[opc]);
            $prazo = mysql_real_escape_string($_POST[data_inicio]);
            $prazoExt = mysql_real_escape_string($_POST[data_fim]);
            $prazo = implode('-', array_reverse(explode('/', $prazo)));
            $prazoExt = implode('-', array_reverse(explode('/', $prazoExt)));

            try
            {
                $sql_data = "UPDATE formularios SET caminho_formulario = '$prazoExt' WHERE nome_formulario='prazoExibirNotaExterna'";
            }
            catch (mysqli_sql_exception $e)
            {
                echo "Erro ao gravar no banco de dados";
            }

            $resultado_data = mysql_query($sql_data);
            //acionar script que atualiza os prazos dos trabalhos
            include('./controle_prazos.php');
            if ($resultado_data) {
                echo '<center><font color="#006400"><b>Prazo alterado com Sucesso !!!</b></font><br><br></center>';
            } else {
                echo '<center><font color="#640000"><b>Erro na alteração do prazo !!!</b></font><br><br></center>';
            }
            echo '<meta http-equiv="refresh" content="3; URL=form_alterar_data_nota_avaliacao_externa.php" />';
        }
        else
        {
            include('includes/config.php');
            $dataHoje = date('d/m/Y');
            $sqlPrazo = "SELECT caminho_formulario FROM formularios WHERE nome_formulario='prazoExibirNotaExterna'";
            $resulPrazo = mysql_query($sqlPrazo);
            $campoPrazo = mysql_fetch_array($resulPrazo);
            $data = implode('/', array_reverse(explode('-', $campoPrazo[caminho_formulario])));

            ?>
            <center>
                <form name='form_alterar_data_nota_avaliacao_externa' method='POST' onsubmit='return  checkcontatos();'
                      action='form_alterar_data_nota_avaliacao_externa.php' enctype='multipart/form-data'>
                    <table border='0' class='esquerda'>
                        <tr id="avaliador" style="display: table">
                            <td align='center'>Exibir notas a partir de: </td>
                            <td align='center'>
                                <?php echo "<input type='text' name='data_fim' value='$data' size='10' maxlength='10' pattern=\"(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}\" title=\"O formato precisa estar em DD/MM/AAAA\"> "; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2' align='center'>
                                <input type='hidden' name='confirma' value='S'>
                                <br>
                                <input type='submit' name='OK' value='OK'>
                            </td>
                        </tr>
                    </table>
                </form>
            </center>
            </div>
            </body>
            </html>
            <?php
        }
    }
    mysql_close($conexao);
}
?>