<?php
/*
 * Utiliza um arquivo java script na pasta js e outro que seleciona os trabalhos de acordo
 * com a opção selecionada chamado seleciona_trabalhos.php
 */
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    include('includes/config.php');

    $sql = "SELECT * FROM sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.aprovado=1 AND (t.codigo_trab!=14 AND t.codigo_trab!=57 AND t.codigo_trab!=61 AND t.codigo_trab!=69 AND t.codigo_trab!=83 AND t.codigo_trab!=129 AND t.codigo_trab!=144) ORDER BY s.nome_sa, t.codigo_trab";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) > 0) {

        $controle = 0;
        $cor = "#95e197";

        while ($campos = mysql_fetch_array($resultado)) {
            if ($controle == 0) {
                echo 'total ' . mysql_num_rows($resultado) . '<br>
		<table>
                    <tr bgcolor=#61C02D>
                        <td><font color="FFFFFF"><center><b><i>Subárea</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Autores</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Modalidade</i></b></center></font></td>
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
            echo "<tr bgcolor='$cor'>
        <td>$campos[codigo_trab]</td>
            <td>$campos[nome_sa]</td>
            <td width='8'><a  href='trabalhos/" . $campos[codigo_trab] . ".pdf'>" . $campos[titulo] . "</a></td></td>
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
            if ($campos[modalidade] == "N") {
                echo "<td>Estudos Orientados</td>";
            } else if ($campos[modalidade] == "S") {
                if ($campos[tipo_iniciacao] == "G") {
                    echo "<td>Iniciação Científica/Graduação</td>";
                }  else if ($campos[tipo_iniciacao] == "M") {
                    echo "<td>Iniciação Científica/Mestrado</td>";
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
        echo '</table>';
        echo '</center><br>';
    } else {
        if ($sub == 'N') {
            echo "<br><center><b>Não trabalhos de Estudos Orientados<br><br>";
        } elseif ($sub == 'G') {
            echo "<br><center><b>Não trabalhos de Iniciação Cinetífica/Graduação<br><br>";
        } elseif ($sub == 'T') {
            echo "<br><center><b>Não trabalhos de Iniciação Cinetífica/Técnico<br><br>";
        }
    }
}
?>