<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    include 'includes/config.php';

    $sa = mysql_real_escape_string($_GET[s]);
    $area = mysql_real_escape_string($_GET[a]);

    ?>
    <center>
        <div id="scroll">
            <center>Selecione os Trabalhos</center>
            <br>
            <table border="0">
                <?php
                $query_participante = mysql_query("SELECT t.codigo_trab, t.titulo FROM trabalhos t WHERE t.codigo_sa='$sa' AND t.tipo_projeto = '$area' AND aprovado='1' ORDER BY t.titulo");
            //    echo "SELECT t.codigo_trab, t.titulo FROM trabalhos t WHERE t.codigo_sa='$sa' AND t.tipo_projeto = '$area' AND aprovado='1' ORDER BY t.titulo";
                if (mysql_num_rows($query_participante) > 0) {
                    while ($campo_participante = mysql_fetch_array($query_participante)) {
                        $quantidade = mysql_fetch_array(mysql_query("SELECT count(at.cpf) as quant FROM avaliador_trab at WHERE at.codigo_trab=$campo_participante[codigo_trab]"));
                        echo "<tr bgcolor='#E0EEEE'>";
                        echo "<td><input type='checkbox' name='trabalhos[]' value='$campo_participante[codigo_trab]' onchange='liberar()'></td>";
                        echo "<td align='center'>$campo_participante[codigo_trab]</td>";
                        echo "<td width='900' align='left'>$campo_participante[titulo]</td>";
                        echo "<td>$quantidade[quant]</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<td>Nenhum trabalho encontrado!!!</td>";
                }
                ?>
            </table>
        </div>
    </center>
    <?php
    mysql_close($conexao);
}
?>
