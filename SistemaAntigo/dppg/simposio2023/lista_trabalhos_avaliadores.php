<?php
/*
 * Mostra os trabalhos avaliados pelos avaliadores externos
 */
if (in_array("1", $_SESSION[codigo_grupo])) {
  ?>
  <html>
    <body>
      <?php
      $sql = "SELECT sum(at.nota) as total, t.*, s.* FROM avaliador_trab at, sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.codigo_trab=at.codigo_trab AND at.avaliado='1' GROUP BY t.codigo_trab ORDER BY at.nota, s.nome_sa, t.codigo_trab";
      $resultado = mysql_query($sql);

      if (mysql_num_rows($resultado) > 0) {

        echo "<br><br><center><b>Listagem dos Trabalhos Avaliados<br>";

        $controle = 0;
        echo '<center>';
        $cor = "#95e197";

        while ($campos = mysql_fetch_array($resultado)) {
          if ($controle == 0) {
            echo '
                Total de trabalhos aprovados:' . mysql_num_rows($resultado) . '
		</b></center><br>
                
		<table width="90%">
                    <tr bgcolor=#61C02D>
                        <td ><font color="FFFFFF"><center><b><i>Código</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Subárea</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Autores</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Modalidade</i></b></center></font></td>
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

          echo "<tr bgcolor='$cor'>
            <td align='center'>$campos[codigo_trab]</td>
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
          if ($campos[modalidade] == "N") {
            echo "<td align='center'>Estudos Orientados</td>";
          } else if ($campos[modalidade] == "S") {
            if ($campos[tipo_iniciacao] == "G") {
              echo "<td align='center'>Iniciação Científica/Graduação</td>";
            } else if ($campos[tipo_iniciacao] == "M") {
              echo "<td align='center'>Iniciação Científica/Mestrado</td>";
            } else if ($campos[tipo_iniciacao] == "T") {
              echo "<td align='center'>Iniciação Científica/Técnico</td>";
            }
          }
          echo "<td align='center' width='60'>$campos[total] pts</td>";
          echo '<td align="center"><input type="button" id="botao" value="Mais" onclick="javascript:mostrar(this.value);"></td>';
          echo "</tr>";

          if ($cor == "#78e07b") {
            $cor = "#95e197";
          } else {
            $cor = "#78e07b";
          }
          $sql_avaliador = "SELECT p.nome, at.item1, at.item2, at.item3, at.item4, at.item5, at.item6, at.nota, at.obs FROM participantes p, avaliador_trab at WHERE p.cpf=at.cpf AND at.codigo_trab='$campos[codigo_trab]' AND at.avaliado='1'";
          $resultado_avaliador = mysql_query($sql_avaliador);
          echo '<tr>';
          echo "<table border='1' id='avaliadores' width='100%' style='display: none'>";
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
          echo "</tr>";
        }
        echo '</table>';
        echo '</center><br>';
      } else {
        echo "<br><center><b>Não trabalhos Avaliados<br><br>";
      }
      ?>
    </body>
  </html>
  <?php
}
?>