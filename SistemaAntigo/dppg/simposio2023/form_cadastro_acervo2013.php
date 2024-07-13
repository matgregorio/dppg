<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    include("includes/config.php");
    $sql = "SELECT trabalhos.*, participantes.nome, participantes.cpf, sub_area.nome_sa FROM sub_area, trabalhos, participantes WHERE participantes.cpf=trabalhos.cpf AND trabalhos.codigo_sa=sub_area.codigo_sa AND trabalhos.aprovado='1' AND trabalhos.acervo='0' ORDER BY sub_area.nome_sa, trabalhos.titulo";
    $resultado_trab = mysql_query($sql);
    $result_autores = mysql_query("SELECT cpf, nome FROM participantes WHERE cpf!='admin' ORDER BY nome");
    ?>

    <center>
        <center>
            <input type="radio" name="tipo" value="i" checked="true" onclick="alterar_tipo(this.value)">Individual
            <input type="radio" name="tipo" value="t" onclick="alterar_tipo(this.value)">Todos Trabalhos Aprovados
        </center>
        <div id="individual">
            <table border="0" width="90%" class="esquerda">
                <tr>
                    <td>Título</td>
                    <td><input type="text" name="titulo" size="40"><font color="#FF0000"> *</font></td>
                </tr>
                <tr>
                    <td><font color="#FF0000">Autor Apresentador</font></td>
                    <td>
                        <select name="autor1">
                            <option value="0">Selecione o Autor Apresentador</option>
                            <?php
                            while ($campo_autores = mysql_fetch_array($result_autores)) {
                                echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                            }
                            ?>
                        </select><font color="#FF0000"> *</font>
                    </td>
                </tr>
                <tr>
                    <td>Autor 2</td>
                    <td>
                        <select name="autor2">
                            <option value="0">Selecione o Autor2</option>
                            <?php
                            mysql_data_seek($result_autores, 0);
                            while ($campo_autores = mysql_fetch_array($result_autores)) {
                                echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Autor 3</td>
                    <td>
                        <select name="autor3">
                            <option value="0">Selecione o Autor3</option>
                            <?php
                            mysql_data_seek($result_autores, 0);
                            while ($campo_autores = mysql_fetch_array($result_autores)) {
                                echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Autor 4</td>
                    <td>
                        <select name="autor4">
                            <option value="0">Selecione o Autor4</option>
                            <?php
                            mysql_data_seek($result_autores, 0);
                            while ($campo_autores = mysql_fetch_array($result_autores)) {
                                echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Autor 5</td>
                    <td>
                        <select name="autor5">
                            <option value="0">Selecione o Autor5</option>
                            <?php
                            mysql_data_seek($result_autores, 0);
                            while ($campo_autores = mysql_fetch_array($result_autores)) {
                                echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Autor 6</td>
                    <td>
                        <select name="autor6">
                            <option value="0">Selecione o Autor6</option>
                            <?php
                            mysql_data_seek($result_autores, 0);
                            while ($campo_autores = mysql_fetch_array($result_autores)) {
                                echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Autor 7</td>
                    <td>
                        <select name="autor7">
                            <option value="0">Selecione o Autor7</option>
                            <?php
                            mysql_data_seek($result_autores, 0);
                            while ($campo_autores = mysql_fetch_array($result_autores)) {
                                echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr></tr>
                <tr>
                    <td>Este resumo refere-se ao seu projeto de Iniciação Científica?</td>
                    <td>
                        <input type="radio" onclick="script : mostrarIC(this.value)"
                               onchange="script : mostrarIC(this.value)" name="modalidade" value="S">Sim
                        <input type="radio" onclick="script : mostrarIC(this.value)"
                               onchange="script : mostrarIC(this.value)" name="modalidade" value="N" checked="true">Não
                    </td>
                </tr>
                <tr><br></tr>
                <tr id="tipoIC" style="display: none">
                    <td>Qual Modalidade?</td>
                    <td>
                        <input type="radio" name="tipoIniciacao" value="G">Graduação
                        <input type="radio" name="tipoIniciacao" value="T" checked="true">Ensino Médio/Técnico
                    </td>
                </tr>
                <tr><br></tr>
                <tr>
                    <td>Subárea</td>
                    <td>
                        <select id="sa" name="subarea" onchange="list_orientador(this.value)">
                            <?php
                            $sql1 = "select * from sub_area order by nome_sa asc";
                            $resultado1 = mysql_query($sql1);
                            while ($campos1 = mysql_fetch_array($resultado1)) {
                                echo "<option value='$campos1[codigo_sa]'>$campos1[nome_sa]</option>";
                            }
                            ?>
                        </select><font color="#FF0000"> *</font></td>
                </tr>
                <tr>
                    <td>Orientador:</td>
                    <td><select id="orientador" name="orientador" onload="list_orientador(this.value)"></select><font
                            color="#FF0000"> *</font></td>
                </tr>
                <tr>
                    <td>Palavra-Chave</td>
                    <td><input type="text" name="palavrachave" size="40"><font color="#FF0000"> *</font></td>
                </tr>
                <tr>
                    <td>Apoio</td>
                    <td>
                        <?php
                        $cons = "select * from apoio";
                        $res = mysql_query($cons);
                        while ($camp = mysql_fetch_array($res)) {
                            echo '<input type="checkbox" name="item[]" size="1" value="' . $camp[codigo_apoio] . '"> ' . $camp[nome] . '<br>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Resumo:<font color="#FF0000"> *</font></td>
                </tr>
            </table>
            <textarea name="resumo" id="resumo" rows="20" cols="10"></textarea>
            <!--<div id="divResumo"></div>-->
            <br>
            Leia com atenção as Normas para envio de trabalhos:
            <?php include('normas.php'); ?>
            <table border="0" width="80%" class="center">
                <tr>
                    <td>Li e concordo com as normas:
                        <input type="checkbox" name="acordo"><font color="#FF0000"> *</font></td>
                </tr>
                <tr>
                    <td colspan="2"><br>
                        <font size="3" color="#FF0000">* </font>Campo de preenchimento obrigatório
                    </td>
                </tr>
            </table>
            <script type="text/javascript">
                var id = document.getElementById('sa').value;
                list_orientador(id);
            </script>
            <br>
            <input type="submit" value="OK">
        </div>
        <div id="todos" style="display: none">
            <br>
            <center>
                <b>Listagem dos trabalhos aprovados</b>
                <br>
            </center>
            <?php
            if (mysql_num_rows($resultado_trab)) {
                $controle = 0;
                echo '<center>';
                $cor = "#95e197";
                while ($campos = mysql_fetch_array($resultado_trab)) {
                    if ($controle == 0) {
                        echo "<b>Total de trabalhos aprovados: " . mysql_num_rows($resultado_trab) . "</b><br>";
                        echo '
                    <br>
                    <br>
                    <input type="submit" value="OK">
                    <br>
                    <br>
                    <table>
                      <tr bgcolor=#61C02D>
                        <td ><font color="FFFFFF"><center><b><i>Código</i></b></center></font></td>
                      <td><font color="FFFFFF"><center><b><i>Subárea</i></b></center></font></td>
                      <td width="300px"><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
                      <td><font color="FFFFFF"><center><b><i>Autor 1</i></b></center></font></td>
                      <td><font color="FFFFFF"><center><b><i>Modalidade</i></b></center></font></td>
                      </tr>';
                    }
                    $controle = 1;
                    echo "<tr bgcolor='$cor'>
                                <td align='center'>$campos[codigo_trab]</td>
                                <td>$campos[nome_sa]</td>
                                <td width='10'>$campos[titulo]</td>
                                <td>$campos[nome]</td>";
                    if ($campos[modalidade] == "N") {
                        echo "<td>Estudos Orientados</td>";
                    } else if ($campos[modalidade] == "S") {
                        if ($campos[tipo_iniciacao] == "G") {
                            echo "<td>Iniciação Científica/Graduação</td>";
                        } else if ($campos[tipo_iniciacao] == "T") {
                            echo "<td>Iniciação Científica/Técnico</td>";
                        }
                    }
                    echo "</tr>";
                    if ($cor == "#78e07b") {
                        $cor = "#95e197";
                    } else {
                        $cor = "#78e07b";
                    }
                }
                echo '</table></center><br>';
            } else {
                echo "<center><i>Não há trabalhos aprovados.</i></center><br><br>";
            }
            ?>
            <br><br>
        </div>
        <input type="hidden" name="envio" value="S">
        </form>
    </center>
<?php
}
?>
