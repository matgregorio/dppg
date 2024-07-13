<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    include('includes/config.php');

    $aprov = mysql_real_escape_string($_GET[a]);
    $tipo = mysql_real_escape_string($_GET[ar]);
    $sql = "select trabalhos.*, sub_area.* from sub_area ,trabalhos where trabalhos.codigo_sa=sub_area.codigo_sa and trabalhos.tipo_projeto='$tipo' and aprovado='$aprov' order by nome_sa, codigo_trab";
   // echo "$sql";
    $resultado = mysql_query($sql);
    $num = mysql_num_rows($resultado);
    if ($num > 0) {

        if ($aprov == 1) {
            echo "<br><br><center><b>Listagem dos trabalhos aprovados<br>";
            echo "Total de trabalhos aprovados: $num";
        } elseif ($aprov == 2) {
            echo "<br><br><center><b>Listagem dos trabalhos em análise<br>";
            echo "Total de trabalhos em análise: $num";
        } elseif ($aprov == 0) {
            echo "<br><br><center><b>Listagem dos trabalhos reprovados<br>";
            echo "Total de trabalhos reprovados: $num";
        }

        $controle = 0;
        echo '<center>';
        $cor = "#95e197";

        while ($campos = mysql_fetch_array($resultado)) {
            if ($controle == 0) {
                echo '
		</b></center><br>
		<table width="100%">
                    <tr bgcolor=#61C02D>
                        <td ><font color="FFFFFF"><center><b><i>Código</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Área</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Subárea</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Autores</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Modalidade - Eixo</i></b></center></font></td>
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

            //echo "$eixo[nome_ga]</p>";
            echo "<tr bgcolor='$cor'>
            <td>$campos[codigo_trab]</td>
            <td>$eixo[nome_ga]</td>
            <td>$campos[nome_sa]</td>
            <td width='10'><a  class=\"link\" href=\"javascript:void(0)\" onClick=\"MM_openBrWindow('resumo.php?codigo=" . $campos[codigo_trab] . "','','scrollbars=yes, width=850, height=600, left=0, top=0')\">" . $campos[titulo] . "</a></td>
            <td>
               - $autor1[nome] <br>
               - $autor2[nome] <br>
               - $autor3[nome] <br>
               - $autor4[nome] <br>
               - $autor5[nome] <br>
               - $autor6[nome] <br>
               - $autor7[nome] <br>
               - Orientador(a): <br> $orientador[nome]
            </td>";
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
            echo "</tr>";

            if ($cor == "#78e07b") {
                $cor = "#95e197";
            } else {
                $cor = "#78e07b";
            }
            $autor1[nome] = "";
            $autor2[nome] = "";
            $autor3[nome] = "";
            $autor4[nome] = "";
            $autor5[nome] = "";
            $autor6[nome] = "";
            $autor7[nome] = "";
            $orientador[nome] = "";
        }
        echo '</table>';
        echo '</center><br>';
    } else {
        if ($aprov == 1) {
            echo "<br><br><center><b>Não há trabalhos aprovados<br>";
        } elseif ($aprov == 2) {
            echo "<br><br><center><b>Não há trabalhos em análise<br>";
        } elseif ($aprov == 0) {
            echo "<br><br><center><b>Não há trabalhos reprovados<br>";
        }
    }
    mysql_close($conexao);
}
?>
