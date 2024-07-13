<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Adcionar Notas </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script language='JavaScript'>
            function SomenteNumero(e) {
                var tecla = (window.event) ? event.keyCode : e.which;
                if ((tecla > 47 && tecla < 58))
                    return true;
                else {
                    if (tecla == 8 || tecla == 0)
                        return true;
                    else
                        return false;
                }
            }
        </script>
    </head>
    <?php
    include './includes/config.php';
    if ($_POST[s] == 's') {
        echo "<div id='conteudo3'>";
        $cont = 0;
        $cont1 = 0;
        $codigo = $_POST[codigo];
        $nota1 = $_POST[nota1];
        $nota2 = $_POST[nota2];
        foreach ($codigo as $cod) {
            if ($nota1[$cont] != '' && $nota2[$cont] != '') {
                $sql = "UPDATE trabalhos SET nota1=$nota1[$cont], nota2=$nota2[$cont] WHERE codigo_trab=$cod";
            } elseif ($nota1[$cont] != '' && $nota2[$cont] == '') {
                $sql = "UPDATE trabalhos SET nota1=$nota1[$cont] WHERE codigo_trab=$cod";
            } elseif ($nota1[$cont] == '' && $nota2[$cont] != '') {
                $sql = "UPDATE trabalhos SET nota2=$nota2[$cont] WHERE codigo_trab=$cod";
            } elseif ($nota1[$cont] == '' && $nota2[$cont] == '') {
                $sql = "1";
            }
//        echo $sql."<br>";
            if ($sql != '1') {
                if (mysql_query($sql)) {
                    $cont1++;
                }
            }
            $sql = '1';
            $cont++;
        }
        echo '<br><br><center><font color="#61C02D"><b>' . $cont1 . ' notas salvas com sucesso!!!</b></font></center><br>';
        echo "</div>";
        echo '<meta http-equiv="refresh" content="3; URL=form_adicionar_notas.php" />';
    } else {
        ?>
        <body>
        <center>
            <div id='conteudo3'>
                <div id="scroll">
                    <p style="text-align: center"><b>Trabalhos Apresentados</b></p>
                    <br>

                    <form name="form_adcionar_notas" method="post" action="form_adicionar_notas.php">
                        <table border="0" class="esquerda">
                            <?php
                            $query_participante = mysql_query("SELECT t.codigo_trab, t.titulo FROM trabalhos t WHERE t.aprovado='1' AND t.aprovado_ext='1' AND t.nota1='' AND t.nota2='' ORDER BY t.codigo_trab");
                            if (mysql_num_rows($query_participante) > 0) {
                                echo '<p style="text-align: center"><b>Total: ' . mysql_num_rows($query_participante) . '</b></p>';
                                echo '<tr bgcolor=#61C02D>
                        <td><center><b><font color="#FFFFFF">&nbsp;Código&nbsp;</font></b></center></td>
                        <td><center><b><font color="#FFFFFF">&nbsp;Título &nbsp;</font></b></center></td>
                        <td><center><b><font color="#FFFFFF">&nbsp;Nota1 &nbsp;</font></b></center></td>
                        <td><center><b><font color="#FFFFFF">&nbsp;Nota2 &nbsp;</font></b></center></td>
                      </tr>';
                                while ($campo_participante = mysql_fetch_array($query_participante)) {
                                    echo "<tr bgcolor='#E0EEEE'>";
                                    echo "<td style='text-align: center' width='50' align='left'>$campo_participante[codigo_trab]</td>";
                                    echo "<td width='900' align='left'>$campo_participante[titulo]</td>";
                                    echo "<td align='left'><input type='text' maxlength='3' id='nota1' name='nota1[]' value='' size='5' onkeypress='return SomenteNumero(event)'></td>";
                                    echo "<td align='left'><input type='text' maxlength='3' id='nota2' name='nota2[]' value='' size='5' onkeypress='return SomenteNumero(event)'></td>";
                                    echo "<td align='left'><input type='hidden' id='nota2' name='codigo[]' value='$campo_participante[codigo_trab]' size='5' onkeypress='return SomenteNumero(event)'></td>";
                                    echo "</tr>";
                                }
                                echo '<tr><td colspan="4" style="text-align: center;"><input type="submit" name="salva" value="Cadastrar Notas"</td></tr>';
                            } else {
                                echo "<td>Nenhum trabalho encontrado!!!</td>";
                            }
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <input type="hidden" value="s" name="s">
                    </form>
                </div>
            </div>
        </center>
        </body>
        </html>
    <?php
    }
    mysql_close($conexao);
}
?>