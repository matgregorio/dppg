<?php

include('includes/config.php');

$t = mysql_real_escape_string($_GET[t]);
$sub = mysql_real_escape_string($_GET[t]);

// $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1 FROM trabalhos as t WHERE t.modalidade='S' AND tipo_iniciacao='$t' and avaliado='1' ORDER BY t.titulo");
//
// if ($t == 'N') {
//     $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1 FROM trabalhos t WHERE t.modalidade='$t' ORDER BY t.titulo");
// } else {
//     $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1 FROM trabalhos t WHERE t.modalidade='S' AND t.tipo_iniciacao='$t' ORDER BY t.titulo");
// }
if ($sub == "Edu")
    {
    //    echo "Ensino<br />";
        $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1 FROM trabalhos t WHERE  t.tipo_projeto='$sub' ORDER BY t.titulo");
    //    echo "$sql";
    }
    elseif ($sub == "Ext")
    {
        //echo "Extensão";
        $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1 FROM trabalhos t WHERE  t.tipo_projeto='$sub' ORDER BY t.titulo");
        //echo "$sql";
    }
    elseif ($sub == "T")
    {
    //    echo "Técnico";
        $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1 FROM trabalhos t WHERE  t.tipo_iniciacao='$sub' ORDER BY t.titulo");
    //    echo "$sql";
    }
    elseif ($sub == "G")
    {
        //echo "Graduação";
        $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1 FROM trabalhos t WHERE  t.tipo_iniciacao='$sub' ORDER BY t.titulo");
        //echo "$sql";
    }
    elseif ($sub == "L")
    {
        //echo "Latu Sensus";
        $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1 FROM trabalhos t WHERE  t.tipo_iniciacao='$sub' ORDER BY t.titulo");
        //echo "$sql";
    }
    elseif ($sub == "S")
    {
        //echo "Stritu sensus";
        $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1 FROM trabalhos t WHERE  t.tipo_iniciacao='$sub' ORDER BY t.titulo");
        //echo "$sql";
    }

if (mysql_num_rows($query_tt) > 0) {
    $controle = 0;
    echo '<center>';
    $cor = "#95e197";
    while ($campos_tt = mysql_fetch_array($query_tt)) {
        $query_pa = mysql_query("SELECT nome FROM participantes WHERE cpf=$campos_tt[autor1]");
        $campos_pa = mysql_fetch_array($query_pa);
        if ($controle == 0) {
            $s = 0;
            echo "<br><br><b>Total de Trabalhos: " . mysql_num_rows($query_tt) . "</b><br>";
            echo '<br>';
            echo '<br>';
            echo "<a href='pdf_tipo_trabalho.php?t=$t&s=$s' target='_blanck'><img src='images/pdf.png'> Gerar PDF</a>";
            echo '<br>';
            echo '<br>';
            echo '<table>';
            echo '<tr bgcolor=#61C02D>';
            echo '<td ><font color="FFFFFF"><center><b><i>Código</i></b></center></font></td>';
            echo '<td ><font color="FFFFFF"><center><b><i>EIXO</i></b></center></font></td>';
            echo '<td width="300px"><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>';
            echo '<td><font color="FFFFFF"><center><b><i>Autor 1</i></b></center></font></td>';
            echo '</tr>';
        }
        $controle = 1;
        if ($sub == "Edu")
        {
            $tipo = "Estudos Orientados - Ensino";
        }
        elseif ($sub == "Ext")
        {
                echo "<br><br><center><b>Listagem de Estudos Orientados - Extensão<br>";
                $tipo = "Estudos Orientados - Ensino";
        }
        elseif ($sub == "T")
        {
            $tipo = "Iniciação Cinetífica/Pesquisa - Técnico";
        }
        elseif ($sub == "G")
        {
            $tipo = "Iniciação Cinetífica/Pesquisa - Graduação";
        }
        elseif ($sub == "L")
        {
            $tipo = "Pesquisa - Lato Sensu";
        }
        elseif ($sub == "S")
        {
            $tipo = "Pesquisa - Stricto Sensu";
        }

        echo "<tr bgcolor='$cor'>";
        echo "<td align='center'>$campos_tt[codigo_trab]</td>";
        echo "<td align='center'>$tipo</td>";
        echo "<td width='10'>$campos_tt[titulo]</td>";
        echo "<td> $campos_pa[nome] </td>";
        echo "</tr>";
        if ($cor == "#78e07b") {
            $cor = "#95e197";
        } else {
            $cor = "#78e07b";
        }
    }
    echo '</table></center><br>';
} else {
    echo "<br><br><center><b>Não há de Trabalhos nessa Categoria!<br>";
}

mysql_close($conexao);
?>
