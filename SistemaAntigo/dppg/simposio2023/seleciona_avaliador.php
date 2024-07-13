<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    include 'includes/config.php';
    ?>
  <p><center><b>Lista de Avaliadores Cadastrados</b></font></center></p>
  <table border="0">
    <?php
    $query_participante = mysql_query("SELECT p.nome, p.cpf FROM participantes AS p WHERE p.nome LIKE '$nome%' AND codigo_tipo_participante > 2 AND p.cpf NOT IN (SELECT gp.cpf FROM grupo_pro AS gp WHERE gp.cpf=p.cpf AND gp.codigo_grupo='7') ORDER BY p.nome");

    if (mysql_num_rows($query_participante) > 0) {
        $cont = 1;
        while ($campo_participante = mysql_fetch_array($query_participante)) {
            if ($cont == 1) {
                echo "
			<tr bgcolor='#E0EEEE'>";
            }
            if (($funcao != "mo") && ($funcao != 'aexmo')) {
                echo "<td><input type='checkbox' name='participante' value='$campo_participante[cpf]' onclick='alterar_permissao(this.value)'></td>";
            }
            echo "<td width='300' align='left'>$campo_participante[nome]</td>";
            if ($cont == 2) {
                echo "</tr>";
                $cont = 0;
            }
            $cont++;
        }
    } else {
        echo "<td>Nenhum avaliador encontrado!!!</td>";
    }
    ?>
  </table>
  <br>
  <!--<input type="submit" value="OK" >&nbsp;<input type="reset" value="Limpar" class="submitverde">-->
  <!--<br>&nbsp;-->
  <?php
    mysql_close($conexao);
}
?>