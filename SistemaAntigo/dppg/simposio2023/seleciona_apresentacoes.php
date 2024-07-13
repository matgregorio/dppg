<?php

//if (in_array("1", $_SESSION[codigo_grupo])) {
include('includes/config.php');
$sub = "";
$sub = mysql_real_escape_string($_GET[a]);
if ($sub != "A")
{
    // if ($sub == "N"){$sql = "SELECT * FROM sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.modalidade='$sub' ORDER BY s.nome_sa, t.codigo_trab";
    // }else if ($sub == "G" || $sub == "T" || $sub == "M")
    // {$sql = "SELECT * FROM sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.modalidade='S' AND t.tipo_iniciacao='$sub' ORDER BY s.nome_sa, t.codigo_trab";
    // }
    /**/
    if ($sub == "Edu")
    {
    //    echo "Ensino<br />";
        $sql = "SELECT * FROM sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.tipo_projeto='$sub' ORDER BY s.nome_sa, t.codigo_trab";
    //    echo "$sql";
    }
    elseif ($sub == "Ext")
    {
        //echo "Extensão";
        $sql = "SELECT * FROM sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.tipo_projeto='$sub' ORDER BY s.nome_sa, t.codigo_trab";
        //echo "$sql";
    }
    elseif ($sub == "T")
    {
    //    echo "Técnico";
        $sql = "SELECT * FROM sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.tipo_iniciacao='$sub' ORDER BY s.nome_sa, t.codigo_trab";
    //    echo "$sql";
    }
    elseif ($sub == "G")
    {
        //echo "Graduação";
        $sql = "SELECT * FROM sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.tipo_iniciacao='$sub' ORDER BY s.nome_sa, t.codigo_trab";
        //echo "$sql";
    }
    elseif ($sub == "L")
    {
        //echo "Latu Sensus";
        $sql = "SELECT * FROM sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.tipo_iniciacao='$sub' ORDER BY s.nome_sa, t.codigo_trab";
        //echo "$sql";
    }
    elseif ($sub == "S")
    {
        //echo "Stritu sensus";
        $sql = "SELECT * FROM sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.tipo_iniciacao='$sub' ORDER BY s.nome_sa, t.codigo_trab";
        //echo "$sql";
    }

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) > 0)
    {

        if ($sub == "Edu")
        {
                echo "<br><br><center><b>Listagem de Estudos Orientados - Ensino<br>";
        }
        elseif ($sub == "Ext")
        {
                echo "<br><br><center><b>Listagem de Estudos Orientados - Extensão<br>";
        }
        elseif ($sub == "T")
        {
            echo "<br><br><center><b>Listagem de Iniciação Cinetífica/Pesquisa - Técnico<br>";
        }
        elseif ($sub == "G")
        {
            echo "<br><br><center><b>Listagem de Iniciação Cinetífica/Pesquisa - Graduação<br>";
        }
        elseif ($sub == "L")
        {
            echo "<br><br><center><b>Listagem de Pesquisa - Lato Sensu<br>";
        }
        elseif ($sub == "S")
        {
            echo "<br><br><center><b>Listagem de Pesquisa - Stricto Sensu<br>";
        }

        $controle = 0;
        echo '<center>';
        $cor = "#95e197";

        while ($campos = mysql_fetch_array($resultado)) {
            if ($controle == 0) {
                echo '
                Total de trabalhos aprovados:' . mysql_num_rows($resultado) . '
		</b></center><br>
		<table>
                    <tr bgcolor=#61C02D>
                        <td ><font color="FFFFFF"><center><b><i>Código</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Área</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Subárea</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Autores</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Modalidade - Eixo</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Editar</i></b></center></font></td>
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
            <td>$campos[codigo_trab]</td>
            <td align='center'>$eixo[nome_ga]</td>
            <td>$campos[nome_sa]</td>
            <td width='8'><a  class=\"link\" href=\"javascript:void(0)\" onClick=\"MM_openBrWindow('resumo.php?codigo=" . $campos[codigo_trab] . "','','scrollbars=yes, width=850, height=600, left=0, top=0')\">" . $campos[titulo] . "</a></td></td>
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

            // if ($campos[modalidade] == "N") {
            //     echo "<td>Estudos Orientados</td>";
            // } else if ($campos[modalidade] == "S") {
            //     if ($campos[tipo_iniciacao] == "G") {
            //         echo "<td>Iniciação Científica/Graduação</td>";
            //     }  else if ($campos[tipo_iniciacao] == "M") {
            //         echo "<td>Iniciação Científica/Mestrado</td>";
            //     } else if ($campos[tipo_iniciacao] == "T") {
            //         echo "<td>Iniciação Científica/Técnico</td>";
            //     }
            // }

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

            if ($campos[acervo] == 0) {
                echo "<td><a  class=\"link\" href=\"javascript:void(0)\" onClick=\"MM_openBrWindow('editar_trabalhos.php?codigo=" . $campos[codigo_trab] . "','','scrollbars=yes, width=850, height=600, left=0, top=0')\"><img src='images/alterar.gif'></a></td>";
            } else {
                echo "<td><img src='images/excluir.png'></td>";
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
        if ($sub == 'Ext' or $sub == 'Edu')
        {
            echo "<br><center><b>Não trabalhos de Estudos Orientados<br><br>";
        } elseif ($sub == 'G') {
            echo "<br><center><b>Não trabalhos de Iniciação Cinetífica - Graduação<br><br>";
        } elseif ($sub == 'T') {
            echo "<br><center><b>Não trabalhos de Iniciação Cinetífica - Técnico<br><br>";
        }elseif ($sub == 'L') {
           echo "<br><center><b>Não trabalhos de Pesquisa - Lato Sensu<br><br>";
       }elseif ($sub == 'S') {
          echo "<br><center><b>Não trabalhos de Pesquisa - Stricto Sensu<br><br>";
      }
    }
}
mysql_close($conexao);
?>
