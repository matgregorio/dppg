<?php
/*
 * Utiliza um arquivo java script na pasta js e outro que seleciona os trabalhos de acordo
 * com a opção selecionada chamado seleciona_trabalhos.php
 */
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    ?>
    <html>
    <head>
        <script type="text/javascript" src="js/trabalhos.js"></script>
        <script type="text/javascript">
            /**
             * Função que exibe a div com os detalhes de avaliação do trabalho
             * @param a String 'Mais' exibe a div, 'Menos' esconde a div
             * @param c Código do trabalho
             */
            function mostrar(a, c)
            {
                if (a == 'Mais') {
                    document.getElementById('avaliadores' + c).style.display = 'table';
                    document.getElementById('botao' + c).value = 'Menos';
                }
                else
                {
                    document.getElementById('avaliadores' + c).style.display = 'none';
                    document.getElementById('botao' + c).value = 'Mais';
                }
            }
        </script>
    </head>
    <body>
    <center>
        <br><br>
        <center><b>Selecione a Situação do Trabalho</b></center>
        <br>
        <table>
            <tr>
                <td>
                </p>Selecione o Tipo:
                    <input type="radio"   name="area" value="Pes" checked="checked">Pesquisa
<!--                    <input type="radio"   name="area" value="Ext" checked="checked" >Extensão-->
<!--                    <input type="radio"   name="area" value="Edu">Ensino-->
                </p>
                </td>
            </tr>
            <tr>
                <td>
                    <select id="estado" name="estado" onchange="script : listar_trabalhos(this.value)">
                        <option value="4">Situação do trabaho</option>
                        <option value="1">Aprovado</option>
                        <option value="2">Em Análise</option>
                        <option value="0">Reprovado</option>
                        <option value="e">Avaliados Externo</option>
                        <option value="ne">Não Avaliados Externo</option>
                    </select>
                </td>
            </tr>
        </table>
        <hr>
    </center>
    <center>
        <div id="lista_trabalhos"></div>
        <div id="externo" style="display:none">
            <?php

             //echo "P=$tipo";
            $sql = "SELECT sum(at.nota) as total, t.*, s.* FROM avaliador_trab at, sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.codigo_trab=at.codigo_trab AND at.avaliado='1' GROUP BY t.codigo_trab ORDER BY at.nota DESC";
            //echo "</p>$sql";
            $resultado = mysql_query($sql);

            if (mysql_num_rows($resultado) > 0) {
                echo "<br><br><center><b>Listagem dos Trabalhos Avaliados<br>";

                $controle = 0;
                echo '<center>';
                $cor = "#95e197";
                echo 'Total de trabalhos:' . mysql_num_rows($resultado);
                echo "<a href='https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2023/simposio.php?arquivo2=listagem_trabalhos_avaliados_externo_ordem_descrescente_notas.php' target='_blank'>
                        <p style='text-align: center; text-decoration: underline; margin-top: 20px; font-size: 16px;'>Clique para listar trabalhos avaliados externos por ordem descrescente de nota</p>
                      </a>";
                while ($campos = mysql_fetch_array($resultado)) {
                    $sql_avaliador = "SELECT p.nome, at.item1, at.item2, at.item3, at.item4, at.item5, at.item6, at.nota, at.obs FROM participantes p, avaliador_trab at WHERE p.cpf=at.cpf AND at.codigo_trab='$campos[codigo_trab]' AND at.avaliado='1'";
                    $resultado_avaliador = mysql_query($sql_avaliador);
                    $quant = mysql_num_rows($resultado_avaliador);

                    $t = $campos[total] / $quant;
                    if ($t >= 60 || $t <= 60) {
                        if ($controle == 0) {
                            echo '
		</b></center><br>
		<table width="100%">
                    <tr bgcolor=#61C02D>
                        <td ><font color="FFFFFF"><center><b><i>Código</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Área</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Subárea</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Autores</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Modalidade - Eixo</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Nota</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Detalhes</i></b></center></font></td>
                    </tr>';
                        }
                        $orientador = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[cpf_prof_analisador]'"));
                        $autor1 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor1]'"));
                        if ($campos[autor2]) {
                            $autor2 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor2]'"));
                        }
                        if ($campos[autor3]) {
                            $autor3 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor3]'"));
                        }
                        if ($campos[autor4]) {
                            $autor4 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor4]'"));
                        }
                        if ($campos[autor5]) {
                            $autor5 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor5]'"));
                        }
                        if ($campos[autor6]) {
                            $autor6 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor6]'"));
                        }
                        if ($campos[autor7]) {
                            $autor7 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor7]'"));
                        }
                        $controle = 1;
                        $eixo = mysql_fetch_array(mysql_query("select * from grande_area where codigo_ga = '$campos[codigo_ga]'"));
                        echo "<tr bgcolor='$cor'>
            <td align='center'>$campos[codigo_trab]</td>
            <td align='center'>$eixo[nome_ga]</td>
            <td align='center'>$campos[nome_sa]</td>
            <td width='200'>$campos[titulo]</a></td></td>
            <td>
              - $autor1[nome]<br>
              - $autor2[nome]<br>
              - $autor3[nome]<br>
              - $autor4[nome]<br>
              - $autor5[nome]<br>
              - $autor6[nome]<br>
              - $autor7[nome]<br>
              - Orientador(a):<br> $orientador[nome]
            </td>";
                        $autor1[nome] = "";
                        $autor2[nome] = "";
                        $autor3[nome] = "";
                        $autor4[nome] = "";
                        $autor5[nome] = "";
                        $autor6[nome] = "";
                        $autor7[nome] = "";
                        $orientador[nome] = "";

                        if ($campos[modalidade] == "N")
                        {
                            if ($campos[tipo_iniciacao] == "G") {
                                echo "<td>Pesquisa - Graduação</td>";
                            }
                            else if ($campos[tipo_iniciacao] == "T") {
                                echo "<td>Pesquisa - Técnico</td>";
                            }
                            else if ($campos[tipo_iniciacao] == "L") {
                                echo "<td>Pesquisa - Lato Sensu</td>";
                            }
                            else if ($campos[tipo_iniciacao] == "S") {
                                echo "<td>Pesquisa - Stricto Sensu</td>";
                            }
                        }
                        else if ($campos[modalidade] == "S")
                        {
                            if ($campos[tipo_iniciacao] == "G") {
                                echo "<td>Iniciação Científica - Graduação</td>";
                            }
                            else if ($campos[tipo_iniciacao] == "T") {
                                echo "<td>Iniciação Científica - Técnico</td>";
                            }
                        }
                        else if ($campos[modalidade] == "0")
                        {
                            if ($campos[tipo_projeto] == "Ext")
                            {
                                echo "<td>Estudos Orientados - Extensão</td>";
                            }
                            else if ($campos[tipo_projeto] == "Edu")
                            {
                                echo "<td>Estudos Orientados - Ensino</td>";
                            }
                        }

                        if ($t < 60) {
                            echo "<td align='center' width='60'><font color='#dd0000'>$t</font> pts</td>";
                        } else {
                            echo "<td align='center' width='60'><font color='#000000'>$t</font> pts</td>";
                        }
                        echo '<td align="center"><input type="button" id="botao' . $campos[codigo_trab] . '" value="Mais" onclick="javascript:mostrar(this.value, ' . $campos[codigo_trab] . ');"></td>';
                        echo "</tr>";

                        if ($cor == "#78e07b") {
                            $cor = "#95e197";
                        } else {
                            $cor = "#78e07b";
                        }

                        $controle = 0;
                        echo '<tr><td colspan="7">';
                        echo "<table border='1' id='avaliadores$campos[codigo_trab]' width='100%' style='display: none'>";
                        while ($campos_avaliador = mysql_fetch_array($resultado_avaliador)) {
                            echo "<tr bgcolor=#61C02D><td align='center' colspan='7'><font color='FFFFFF'>$campos_avaliador[nome]</font></td></tr>";
                            echo "<tr align='center'>";
                            echo "<td>Item1</td>";
                            echo "<td>Item2</td>";
                            echo "<td>Item3</td>";
                            echo "<td>Item4</td>";
                            echo "<td>Item5</td>";
                            echo "<td>Item6</td>";
                            echo "<td>Total</td>";
                            echo "</tr>";
                            echo "<tr align='center'>";
                            echo "<td>$campos_avaliador[item1]</td>";
                            echo "<td>$campos_avaliador[item2]</td>";
                            echo "<td>$campos_avaliador[item3]</td>";
                            echo "<td>$campos_avaliador[item4]</td>";
                            echo "<td>$campos_avaliador[item5]</td>";
                            echo "<td>$campos_avaliador[item6]</td>";
                            echo "<td>$campos_avaliador[nota]</td>";
                            echo "</tr>";
                            if (htmlspecialchars_decode($campos_avaliador[obs], ENT_QUOTES) != '') {
                                if ($controle == 0) {
                                    echo "<tr>";
                                    echo "<td colspan='7'><b>Observação do Avaliador:</b></td>";
                                    echo "</tr>";
                                    $controle = 1;
                                }
                                echo "<tr>";
                                echo "<td colspan='7'>" . htmlspecialchars_decode($campos_avaliador[obs], ENT_QUOTES) . "</td>";
                                echo "</tr>";
                            }
                        }
                        echo "</table>";
                        echo "<hr></td></tr>";
                    }
                }
                echo '</table>';
                echo '</center><br>';
            } else {
                echo "<br><center><b>Não há trabalhos a serem avaliados</b><br><br>";
            }
            ?>
        </div>
        <div id="nexterno" style="display:none">
            <?php
            // include './lista_trabalhos_avaliadores.php';
            $sql = "SELECT sum(at.nota) as total, t.*, s.* FROM avaliador_trab at, sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.codigo_trab=at.codigo_trab AND at.avaliado='0' AND at.codigo_trab NOT IN (SELECT codigo_trab FROM avaliador_trab WHERE avaliado='1') GROUP BY t.codigo_trab ORDER BY at.nota DESC, s.nome_sa, t.codigo_trab";
            $resultado = mysql_query($sql);

            if (mysql_num_rows($resultado) > 0) {

                echo "<br><br><center><b>Listagem dos Trabalhos Avaliados<br>";

                $controle = 0;
                echo '<center>';
                $cor = "#95e197";
                echo 'Total de trabalhos não avaliados:' . mysql_num_rows($resultado);
                while ($campos = mysql_fetch_array($resultado)) {
                    if ($controle == 0) {
                        echo '
		</b></center><br>
		<table width="90%">
                    <tr bgcolor=#61C02D>
                        <td ><font color="FFFFFF"><center><b><i>Código</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Área</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Subárea</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Autores</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Modalidade - Eixo</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Nota</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Detalhes</i></b></center></font></td>
                    </tr>';
                    }
                    $orientador = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[cpf_prof_analisador]'"));
                    $autor1 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor1]'"));
                    if ($campos[autor2]) {
                        $autor2 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor2]'"));
                    }
                    if ($campos[autor3]) {
                        $autor3 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor3]'"));
                    }
                    if ($campos[autor4]) {
                        $autor4 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor4]'"));
                    }
                    if ($campos[autor5]) {
                        $autor5 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor5]'"));
                    }
                    if ($campos[autor6]) {
                        $autor6 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor6]'"));
                    }
                    if ($campos[autor7]) {
                        $autor7 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor7]'"));
                    }
                    $controle = 1;
                    $eixo = mysql_fetch_array(mysql_query("select * from grande_area where codigo_ga = '$campos[codigo_ga]'"));
                    echo "<tr bgcolor='$cor'>
            <td align='center'>$campos[codigo_trab]</td>
            <td align='center'>$eixo[nome_ga]</td>
            <td align='center'>$campos[nome_sa]</td>
            <td width='200'>$campos[titulo]</a></td></td>
            <td>
              - $autor1[nome]<br>
              - $autor2[nome]<br>
              - $autor3[nome]<br>
              - $autor4[nome]<br>
              - $autor5[nome]<br>
              - $autor6[nome]<br>
              - $autor7[nome]<br>
              - Orientador(a):<br> $orientador[nome]
            </td>";
                    $autor1[nome] = "";
                    $autor2[nome] = "";
                    $autor3[nome] = "";
                    $autor4[nome] = "";
                    $autor5[nome] = "";
                    $autor6[nome] = "";
                    $autor7[nome] = "";
                    $orientador[nome] = "";

                    if ($campos[modalidade] == "N")
                    {
                        if ($campos[tipo_iniciacao] == "G") {
                            echo "<td>Pesquisa - Graduação</td>";
                        }
                        else if ($campos[tipo_iniciacao] == "T") {
                            echo "<td>Pesquisa - Técnico</td>";
                        }
                        else if ($campos[tipo_iniciacao] == "L") {
                            echo "<td>Pesquisa - Lato Sensu</td>";
                        }
                        else if ($campos[tipo_iniciacao] == "S") {
                            echo "<td>Pesquisa - Stricto Sensu</td>";
                        }
                    }
                    else if ($campos[modalidade] == "S")
                    {
                        if ($campos[tipo_iniciacao] == "G") {
                            echo "<td>Iniciação Científica - Graduação</td>";
                        }
                        else if ($campos[tipo_iniciacao] == "T") {
                            echo "<td>Iniciação Científica - Técnico</td>";
                        }
                    }
                    else if ($campos[modalidade] == "0")
                    {
                        if ($campos[tipo_projeto] == "Ext")
                        {
                            echo "<td>Estudos Orientados - Extensão</td>";
                        }
                        else if ($campos[tipo_projeto] == "Edu")
                        {
                            echo "<td>Estudos Orientados - Ensino</td>";
                        }
                    }

                    $sql_avaliador = "SELECT p.nome, at.item1, at.item2, at.item3, at.item4, at.item5, at.item6, at.nota, at.obs FROM participantes p, avaliador_trab at WHERE p.cpf=at.cpf AND at.codigo_trab='$campos[codigo_trab]' AND at.avaliado='0'";
                    $resultado_avaliador = mysql_query($sql_avaliador);
                    $quant = mysql_num_rows($resultado_avaliador);

                    $t = $campos[total] / $quant;
                    echo "<td align='center' width='60'>$t pts</td>";
                    echo '<td align="center"><input type="button" id="botao' . $campos[codigo_trab] . '" value="Mais" onclick="javascript:mostrar(this.value, ' . $campos[codigo_trab] . ');"></td>';
                    echo "</tr>";

                    if ($cor == "#78e07b") {
                        $cor = "#95e197";
                    } else {
                        $cor = "#78e07b";
                    }

                    echo '<tr><td colspan="7">';
                    echo "<table border='1' id='avaliadores$campos[codigo_trab]' width='100%' style='display: none'>";
                    while ($campos_avaliador = mysql_fetch_array($resultado_avaliador)) {
                        echo "<tr bgcolor=#61C02D><td align='center' colspan='7'><font color='FFFFFF'>$campos_avaliador[nome]</font></td></tr>";
                        echo "<tr align='center'>";
                        echo "<td>Item1</td>";
                        echo "<td>Item2</td>";
                        echo "<td>Item3</td>";
                        echo "<td>Item4</td>";
                        echo "<td>Item5</td>";
                        echo "<td>Item6</td>";
                        echo "<td>Total</td>";
                        echo "</tr>";
                        echo "<tr align='center'>";
                        echo "<td>$campos_avaliador[item1]</td>";
                        echo "<td>$campos_avaliador[item2]</td>";
                        echo "<td>$campos_avaliador[item3]</td>";
                        echo "<td>$campos_avaliador[item4]</td>";
                        echo "<td>$campos_avaliador[item5]</td>";
                        echo "<td>$campos_avaliador[item6]</td>";
                        echo "<td>$campos_avaliador[nota]</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<hr></td></tr>";
                }
                echo '</table>';
                echo '</center><br>';
            } else {
                echo "<br><center><b>Não há trabalhos para serem Avaliados<br><br>";
            }
            ?>
        </div>
    </center>
    <script type="text/javascript">
        document.getElementById('estado').focus();
    </script>
    </body>
    </html>
<?php
}
?>
