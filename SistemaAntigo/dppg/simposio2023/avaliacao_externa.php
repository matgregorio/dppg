<?php
/*
 * Neste arquivo, será mostrado a lista de trabalhos enviado para o avaliador
 */
session_start();
if (in_array("7", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    include 'includes/config.php';

    include 'controle_prazos.php';
    ?>
    <head>
        <style type="text/css">
            #scroll {
                width: 750px;
                overflow: auto;
            }
        </style>
    </head>
    <body>
    <center>
        <div id="scroll">
            <center>
                <br>
                Clique no link para baixar o
                <u><b><a href="documentos/Manual_avaliador_externo.pdf" target="_blank">Manual do Avaliador Externo</a></b></u>
            </center>
            <br>
            <center><b>Selecione um dos Trabalhos</b></center>
            <br>
            <table border="0">
                <?php
                $query_participante = mysql_query("SELECT t.codigo_trab, t.titulo, at.dias FROM trabalhos t, avaliador_trab at WHERE t.codigo_trab=at.codigo_trab AND at.cpf=$_SESSION[cpf] AND at.avaliado!='1' ORDER BY t.titulo");
                if (mysql_num_rows($query_participante) > 0) {
                    while ($campo_participante = mysql_fetch_array($query_participante)) {
                        ?>
                        <tr bgcolor='#E0EEEE'>
                            <td width="900"><a class="link" href="javascript:void(0)"
                                               onClick="window.open('form_avaliar.php?a=<?php echo $campo_participante[codigo_trab]; ?>', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                    &nbsp;<img src="images/report.png" border="0"
                                               width="25px">&nbsp;<?php echo $campo_participante[titulo]; ?></a></td>
                            <td><?php echo $campo_participante[dias]; ?> dias restantes.</td>
                        </tr>
                    <?php
                    }
                } else {
                    echo "<td>Nenhum trabalho encontrado!!!</td>";
                }
                ?>
            </table>
        </div>
    </center>
    </body>
    <?php
    mysql_close($conexao);
}
?>
