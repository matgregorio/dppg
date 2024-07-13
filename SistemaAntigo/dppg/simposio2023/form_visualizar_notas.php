<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    include './includes/config.php';
    ?>
    <html>
    <head>
        <title> Visualizar Notas </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <center>
        <div id='conteudo3'>
            <div id="scroll">
                <p style="text-align: center"><b>Trabalhos Apresentados</b></p>
                <br>
                <table border="0" class="esquerda">
                    <?php
                    $dado = array();
                    $html = array();
                    $query_participante = mysql_query("SELECT t.codigo_trab, t.titulo, t.nota1, t.nota2 FROM trabalhos t WHERE t.aprovado='1' AND t.aprovado_ext='1' AND (t.nota1 !='' OR t.nota2!='') ORDER BY t.codigo_trab");
                    if (mysql_num_rows($query_participante) > 0) {
                        echo '<p style="text-align: center"><b>Total: ' . mysql_num_rows($query_participante) . '</b></p>';
                        echo '<tr bgcolor=#61C02D>
                        <td><center><b><font color="#FFFFFF">&nbsp;Código&nbsp;</font></b></center></td>
                        <td><center><b><font color="#FFFFFF">&nbsp;Título &nbsp;</font></b></center></td>
                        <td><center><b><font color="#FFFFFF">&nbsp;Nota1 &nbsp;</font></b></center></td>
                        <td><center><b><font color="#FFFFFF">&nbsp;Nota2 &nbsp;</font></b></center></td>
                        <td><center><b><font color="#FFFFFF">&nbsp;Média &nbsp;</font></b></center></td>
                      </tr>';

                        while ($campo_participante = mysql_fetch_array($query_participante)) {

                            if ($campo_participante[nota1] != '' && $campo_participante[nota2] != '') {
                                $dado[$campo_participante[codigo_trab]] = (($campo_participante[nota1] + $campo_participante[nota2]) / 2);
                            } elseif ($campo_participante[nota1] != '' && $campo_participante[nota2] == '') {
                                $dado[$campo_participante[codigo_trab]] = $campo_participante[nota1];
                            } elseif ($campo_participante[nota1] == '' && $campo_participante[nota2] != '') {
                                $dado[$campo_participante[codigo_trab]] = $campo_participante[nota2];
                            }

                            $a = "<tr bgcolor='#E0EEEE'>
                <td style='text-align: center' width='50' align='left'>$campo_participante[codigo_trab]</td>
                <td width='800' align='left'>$campo_participante[titulo]</td>
                <td align='left'><input readonly type='text' maxlength='3' id='nota1' name='nota1[]' value='$campo_participante[nota1]' size='5' onkeypress='return SomenteNumero(event)'></td>
                <td align='left'><input readonly type='text' maxlength='3' id='nota2' name='nota2[]' value='$campo_participante[nota2]' size='5' onkeypress='return SomenteNumero(event)'></td>";
                            if ($campo_participante[nota1] != '' && $campo_participante[nota2] != '') {
                                $a = $a . "<td width='50' align='right'>" . (($campo_participante[nota1] + $campo_participante[nota2]) / 2) . " pts</td>";
                            } elseif ($campo_participante[nota1] != '' && $campo_participante[nota2] == '') {
                                $a = $a . "<td width='50' align='right'>$campo_participante[nota1] pts</td>";
                            } elseif ($campo_participante[nota1] == '' && $campo_participante[nota2] != '') {
                                $a = $a . "<td width='50' align='right'>$campo_participante[nota2] pts</td>";
                            }
                            $a = $a . "</tr>";
                            $html[$campo_participante[codigo_trab]] = $a;
                        }
                        asort($dado, SORT_NUMERIC);
                        $dado = array_reverse($dado, TRUE);
                        foreach ($dado as $cod => $d) {
                            echo $html[$cod];
                        }
                    } else {
                        echo "<td>Nenhum trabalho encontrado!!!</td>";
                    }
                    ?>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
    </center>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>