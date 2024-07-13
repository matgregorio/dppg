<?php
session_start();

if (in_array("2", $_SESSION[codigo_grupo])) {
  include './controle_prazos.php';
  include('includes/config.php');

  $sql = "SELECT trabalhos.*, participantes.nome FROM trabalhos, participantes WHERE participantes.cpf=trabalhos.autor1 AND cpf_prof_analisador='$_SESSION[cpf]' AND aprovado='2'";
  $resultado = mysql_query($sql);
  $cor = "#95e197";
  $cont = 0;
  ?>
  <br>
  <center><b>Trabalhos para avaliação</b></center><br>
  <center>
    <?php
    if (mysql_num_rows($resultado) > 0) {
      ?>
      <!-- <font color="#FF0000"><b>Os Trabalhos que não apresentarem resultados, mesmo que parciais, deverão receber <b>NOTA "0"</b> em todos os requisitos, para atender ao item 3.2 da Chamada de Trabalhos</b></font> -->
  </p><font color="#FF0000">Para visualizar e/ou editar o trabalho, basta clicar no nome do mesmo. Para avaliar clique
      em <u>"Avaliação"</u></font>
      <br>
      <table border="0" class="esquerda" width="90%">
        <tr bgcolor=#61C02D>
          <td><font color="FFFFFF">
        <center><b><i>&nbsp;Código&nbsp;</i></b></center>
        </font></td>
        <td><font color="FFFFFF">
        <center><b><i>&nbsp;Título&nbsp;</i></b></center>
        </font></td>
        <td><font color="FFFFFF">
        <center><b><i>&nbsp;Autor&nbsp;</i></b></center>
        </font></td>
        <td><font color="FFFFFF">
        <center><b><i>&nbsp;Situação&nbsp;</i></b></center>
        </font></td>
        <td><font color="FFFFFF">
        <center><b><i>&nbsp;Avaliação&nbsp;</i></b></center>
        </font></td>
        <td><font color="FFFFFF">
        <center><b><i>&nbsp;Prazo(dias)&nbsp;</i></b></center>
        </font></td>
        </tr>
        <?php
        while ($campos = mysql_fetch_array($resultado)) {
          echo '<form name="form_trabalhos' . $cont . '" method="POST" action="simposio.php">	';
          echo '<tr bgcolor="' . $cor . '">
            <td>' . $campos[codigo_trab] . '</td>
              <input type="hidden" name="codigo" value="' . $campos[codigo_trab] . '">
            <td>';
          echo "<center><a  class=\"link\" href=\"javascript:void(0)\" onClick=\"window.open('resumo.php?codigo=" . $campos[codigo_trab] . "','','scrollbars=yes, width=850, height=600, left=0, top=0')\">" . $campos[titulo] . "</a>
				<input type='hidden' name='titulo' value='" . $campos[titulo] . "' ></center></td>";

          echo '</td>
		<td><input type="hidden" name="autor1" value="' . $campos[autor1] . '">' . $campos[nome] . '</td>
		<td>' . $campos[situacao] . '</td>
		<td><center>';

          if ($campos[aprovado] == 2) {
            echo "<a href=\"javascript:void(0)\" onClick=\"MM_openBrWindow('avaliacao_analisador.php?codigo=" . $campos[codigo_trab] . "','',
						'scrollbars=yes, width=850, height=600, left=0, top=0')\")\"><img src=\"images/report1.png\" border= \"0\" width=\"40%\"></a>";
          }
          echo "<td align='center'>$campos[dias_restantes]</td>";

          echo '</center>
		</td>
		</tr>
		<!--<input type="submit" value="Enviar">-->
		<!--<input type="hidden" name="arquivo2" value="enviar_trabalho.php">-->';

          if ($cor == "#78e07b")
            $cor = "#95e197";
          else
            $cor = "#78e07b";

          echo '</form>';
          $cont++;
        }
        echo '</table><br>';
        echo '<font color="#FF0000">Atenção, os trabalhos não avaliados dentro do prazo, serão automaticamente reprovados.</font>';
        echo '<font color="#FF0000">OBSERVAÇÃO</font><br>
					<!--i> Click no título do trabalho para ver o resumo.</i--><br>
					<!--<i> Click no nome do arquivo para download.</i><br><br>-->
					';
      } else
        echo '<center><i>Nenhum trabalho para ser avaliado!!!</i></center><br>';

      $sql_arquivo = "select * from formularios f, arquivo a where f.codigo_formulario = a.codigo_formulario and a.codigo_formulario = '3'";
      $resultado_arquivo = mysql_query($sql_arquivo);
      echo "<center>";
      echo "<table>";
      echo "<tr>";
      while ($campos_arquivo = mysql_fetch_array($resultado_arquivo)) {
        echo "<td>";
        echo '&nbsp;<a href="documentos/' . $campos_arquivo[caminho_arquivo] . '" target="_blank"><img src="images/' . $campos_arquivo[icone] . '" border="0">&nbsp;' . $campos_arquivo[nome_arquivo] . '</a><br><br>';
        echo "</td>";
      }
      echo "</tr>";
      echo "</table>";
      echo "</center>";

      mysql_close($conexao);
    }
    ?>
