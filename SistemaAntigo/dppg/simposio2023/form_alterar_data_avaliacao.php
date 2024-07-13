<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
        <head>
            <title>Alterar Prazo para Avaliação</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <!--<script type="text/JavaScript" src="js/compara_data.js"></script>-->
            <script type="text/javascript">
                function mascara_data_inicio1(data_inicio) {
                    var mydata = '';
                    mydata = mydata + data_inicio;
                    if (mydata.length == 2) {
                        mydata = mydata + '/';
                        document.forms[0].data_inicio.value = mydata;
                    }
                    if (mydata.length == 5) {
                        mydata = mydata + '/';
                        document.forms[0].data_inicio.value = mydata;
                    }
                    if (mydata.length == 10) {

                    }
                }
            </script>
        </head>
        <body>
            <?php
            session_start();
            if ($_SESSION[logado_simposio_2021]) {
                ?>
            <head>
                <script type="text/javascript">
                    function opcao(a) {
                        if (a == '1') {
                            document.getElementById('avaliador').style.display = 'table';
                            document.getElementById('orientador').style.display = 'none';
                        } else if (a == '2') {
                            document.getElementById('avaliador').style.display = 'none';
                            document.getElementById('orientador').style.display = 'table';
                        }
                    }
                </script>
            </head>
            <div id="conteudo3">
                <br>
                <center><b>Alterar Prazo para Avaliação</b><br><br></center>
                <?php
                if ($_POST[confirma] == "S") {
                    include('includes/config.php');
                    $opc = mysql_real_escape_string($_POST[opc]);
                    $prazo = mysql_real_escape_string($_POST[data_inicio]);
                    $prazoExt = mysql_real_escape_string($_POST[data_fim]);
                    $prazo = implode('-', array_reverse(explode('/', $prazo)));
                    $prazoExt = implode('-', array_reverse(explode('/', $prazoExt)));

                    if ($opc == 2) {
                        $sql_data = "UPDATE formularios SET caminho_formulario = '$prazo' WHERE nome_formulario = 'prazo'";
                    } else if ($opc == 1) {
                        $sql_data = "UPDATE formularios SET caminho_formulario = '$prazoExt' WHERE nome_formulario='prazoexterno'";
                        $sql_data1 = "UPDATE avaliador_trab SET data = '$prazoExt'";
                        $resultado_data = mysql_query($sql_data1);
                    }
                    $resultado_data = mysql_query($sql_data);
                    //acionar script que atualiza os prazos dos trabalhos
                    include('./controle_prazos.php');
                    if ($resultado_data) {
                        echo '<center><font color="#006400"><b>Prazo alterado com Sucesso !!!</b></font><br><br></center>';
                    } else {
                        echo '<center><font color="#640000"><b>Erro na alteração do prazo !!!</b></font><br><br></center>';
                    }
                    echo '<meta http-equiv="refresh" content="3; URL=form_alterar_data_avaliacao.php" />';
                } else {
                    include('includes/config.php');
                    $sqlPrazo = "SELECT caminho_formulario FROM formularios WHERE nome_formulario='prazo'";
                    $resulPrazo = mysql_query($sqlPrazo);
                    $campoPrazo = mysql_fetch_array($resulPrazo);

                    $sqlPrazoExt = "SELECT caminho_formulario FROM formularios WHERE nome_formulario='prazoexterno'";
                    $resulPrazoExt = mysql_query($sqlPrazoExt);
                    $campoPrazoExt = mysql_fetch_array($resulPrazoExt);

                    $dataExt = implode("/", array_reverse(explode('-', $campoPrazoExt[caminho_formulario])));
                    $data = implode('/', array_reverse(explode('-', $campoPrazo[caminho_formulario])));
                    ?>
                    <center>
                        <form name='form_altera_data' method='POST' onsubmit='return  checkcontatos();'
                              action='form_alterar_data_avaliacao.php' enctype='multipart/form-data'>
                            <input type="radio" name="opc" value="1" onchange="javascript : opcao(this.value)"
                                   onclick="javascript : opcao(this.value)" checked="true">Avaliador Externo
                            <input type="radio" name="opc" value="2" onchange="javascript : opcao(this.value)"
                                   onclick="javascript : opcao(this.value)">Orientador
                            <table border='0' class='esquerda'>
                                <tr id="avaliador" style="display: table">
                                    <td align='center'>Prazo para Avaliação Externa:</td>
                                    <td align='center'><?php echo "<input type='text' name='data_fim' OnKeyUp='mascara_data_inicio1(this.value)' value='$dataExt' size='10' maxlength='10'>"; ?></td>
                                </tr>
                                <tr id="orientador" style="display: none">
                                    <td align='center'>Prazo para Avaliação Orientadores:</td>
                                    <td align='center'><?php echo "<input type='text' name='data_inicio' OnKeyUp='mascara_data_inicio1(this.value)' value='$data' size='10' maxlength='10'>"; ?></td>
                                </tr>
                                <tr>
                                    <td colspan='2' align='center'>
                                        <input type='hidden' name='confirma' value='S'>
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