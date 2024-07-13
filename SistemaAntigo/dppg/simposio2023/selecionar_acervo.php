<?php

include('includes/config.php');
include('acentuacao.php');
echo "2014";
$ano = mysql_real_escape_string($_GET[ano]);
if ($ano != '0') {
    $sql1 = "select * from ano where codigo_ano='$ano'";
    $resultado1 = mysql_query($sql1);
    $campos1 = mysql_fetch_array($resultado1);

    $palavra = mysql_real_escape_string($_POST[palavra]);
    $titulo = mysql_real_escape_string($_POST[titulo]);
    $autor = mysql_real_escape_string($_POST[autor]);
    $palavra_chave = mysql_real_escape_string($_POST[palavra_chave]);
    if ($ano < 6) {
        $sql = "select * from acervo ace, ano a where  ace.codigo_ano = a.codigo_ano and palavra_chave like '%" . $palavra_chave . "%' and titulo like '%" . $titulo . "%' and autores like '%" . $autor . "%' and ano like '%" . $campos1[ano] . "%' order by titulo";
    } else {
        $sql = "SELECT ace.*, t.titulo, t.codigo_trab FROM acervo ace, trabalhos t WHERE ace.codigo_ano=$ano AND t.codigo_trab=ace.codigo_trab ORDER BY t.titulo";
    }
    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) > 0) {
        ?>
        <center><br><b>Resultado Acervo</b><br><br>
            <table border="0" width="100%">
                <tr bgcolor=#61C02D>
                    <td align="center"><font color="#FFFFFF"><b><i>Nº</i></b></font></td>
                    <td align="center"><font color="#FFFFFF"><b><i>Título</i></b></font></td>
                    <td align="center"><font color="#FFFFFF"><b><i>Ano</i></b></font></td>
                </tr>
        <?php

        $cont = 1;
        $cor = "#95e197";
        while ($campos = mysql_fetch_array($resultado)) {
            echo "<tr bgcolor='$cor'>";
            echo "<td>$cont</td>";
            if ($ano < 6) {
                echo "<td><a href='form_alterar_acervo_old.php?c=$campos[codigo_acervo]'>$campos[titulo]</a></td>";
            } else {
                echo "<td><a href='form_alterar_acervo_new.php?c=$campos[codigo_trab]'>$campos[titulo]</a></td>";
            }
            echo "<td>$campos1[ano]</td>";
            echo "</tr>";
            $cont++;
            if ($cor == "#78e07b")
                $cor = "#95e197";
            else
                $cor = "#78e07b";
        }
        echo '</table><br>';
      } else {
        echo '<br><center><i>Nenhum registro encontrado!!!</i></center><br>';
    }
} else {
    echo '<div id="acervo">
                    <br><center><b>Selecione um Ano!</b></center><br>
                </div>';
}
?>