<?php

session_start();

if ($_SESSION[logado_simposio_2021]) {
  include('includes/config.php');
  include('funcao.php');

  $sql_data = "select data_inicio, data_fim from formularios where codigo_formulario = '6'";
  $resultado_data = mysql_query($sql_data);

  $campos_data = mysql_fetch_array($resultado_data);

  $data_inicio = datadobanco($campos_data[data_inicio]);
  $data_fim = datadobanco($campos_data[data_fim]);

  $data = $data_inicio;

  $data_i = datasemcaracter($data_inicio);
  $data_f = datasemcaracter($data_fim);

  $cod = mysql_real_escape_string($_GET[codigo]);

  if ((date("Ymd") >= $data_i) && (date("Ymd") <= $data_f))
  {
        $sql = "SELECT eventos.codigo_evento, eventos.nome_evento, sub_eventos.palestrante,
              sub_eventos.nome_sub_evento, sub_eventos.data, sub_eventos.codigo_sub_evento,
                sub_eventos.vagas, sub_eventos.horario, sub_eventos.titulo, sub_eventos.lattes_participante, sub_eventos.local 
                FROM eventos JOIN sub_eventos on eventos.codigo_evento = sub_eventos.codigo_evento 
                WHERE eventos.codigo_evento ='$cod' ORDER BY data, horario";

        $resultado = mysql_query($sql);

        $sqlTemp = "SELECT t.codigo_sub_evento, s.data, s.horario FROM itens_inscricao t, sub_eventos s WHERE t.cpf='$_SESSION[cpf]' AND s.codigo_sub_evento=t.codigo_sub_evento";
        $resultTemp = mysql_query($sqlTemp);
        $itensInscritos[] = array();

        while ($campoTemp = mysql_fetch_array($resultTemp)) {
          $itensInscritos[] = $campoTemp[codigo_sub_evento];
        }
        mysql_data_seek($resultTemp, 0);
        while ($campoTemp = mysql_fetch_array($resultTemp)) {
          $itensInscritosConflitos[] = $campoTemp[data].'|'.$campoTemp[horario];
        }
    //    var_dump($itensInscritosConflitos);
    //    $sqlTemp1 = "SELECT codigo_sub_evento FROM sub_evento WHERE date";
    //    $resultTemp1 = mysql_query($sqlTemp1);
    //    $itensInscritos1[] = array();
    //
    //    while ($campoTemp1 = mysql_fetch_array($resultTemp1)) {
    //      $itensInscritos1[] = $campoTemp1[codigo_sub_evento];
    //    }

        if ($_GET[codigo] == 2)
          echo '<img src="images/nittec.png" width="150" height="72" border="0" alt="" align="right"><br><br><br>';

        $controle = 0;
        ?>
        <script type="text/javascript">
          function selecionar() {
            document.getElementById('s').checked = true;
          }
        </script>
        <?php

        echo '<center><form name="form_insc_eventos" method="post" action="simposio.php">';
        $cor = "#95e197";
        $c = 0;

    //    while ($campos = mysql_fetch_array($resultado)) {
    //      $dados[$campos[codigo_sub_evento]] = $campos[data] . '|' . $campos[horario];
    //    }
    ////    var_dump($dados);
    //    $dados = array_count_values($dados);



        while ($campos = mysql_fetch_array($resultado)) {
          if ($controle == 0) {
            echo '<br><br><center><b>Inscrição na programação do ' . $campos[nome_evento] . '</b></center>
                        <br><b><center><font size="3" color="#FF0000">ATENÇÃO</font></b>
                        <br>Selecione a programação desejada.
                        <br>Após a escolha clique no botão <b>"Inscrever"</b>.</center><br>';


            if ($_GET[codigo] == 1) {
              echo '<b><center>Somente terão direito à certificação, os inscritos com presença comprovada na palestra de abertura e em pelo menos duas atividades (apresentações de pôsteres e apresentações orais).</center></b>';
              echo '<b><center><font color="red">Fique atento aos horários, para não selecionar eventos que ocorrerão simultaneamente.</font></center></b>';
              echo '<p align="justify"><font size="3" color="#0000FF">
                            <b><!--- Todos os inscritos com presença comprovada pela Comissão Organizadora
                            nos eventos do Simpósio,como "Palestras", "Apresentações Orais" e "Experiências 
                            Profissionais", terão direito à certificação nas respectivas modalidades.<br>
                            - Os inscritos que participarem de 10 a 15 eventos receberão um certificado parcial de participação
                            do evento, que constará no verso as atividades das quais participaram.<br>
                        - Os inscritos que participarem de mais de 15 eventos receberão um certificado de participação
                        integral do evento, constando uma carga horária de 30 horas.--></b></font></p>';
            }
            echo '<center>
                        <table>
                        <tr bgcolor=#61C02D>
                            <td><font color="black"><center><b><i>Tipo</i></b></center></font></td>
                            <!--<td><font color="FFFFFF"><center><b><i>Programação</i></b></center></font></td>-->
                            <td><font color="black"><center><b><i>Título</i></b></center></font></td>
                            <td><font color="black"><center><b><i>Palestrante</i></b></center></font></td>
                            <td><font color="black"><center><b><i>Lattes</i></b></center></font></td>
                            <td><font color="black"><center><b><i>Local</i></b></center></font></td>
                            <td><font color="black"><center><b><i>Vagas</i></b></center></font></td>
                            <td><font color="black"><center><b><i>Data</i></b></center></font></td>
                            <td><font color="black"><center><b><i>Hora</i></b></center></font></td>
                        </tr>';
          }

          $controle = 1;

          if ($campos[vagas] > 0)
          {

            if ($c == 0)
            {
              echo "<tr bgcolor='$cor'>";
              echo "<td>$campos[nome_sub_evento]</td>";
              //echo "<td>$campos[nome_evento]</td>";
              echo "<td>$campos[titulo]</td>";
              echo "<td>$campos[palestrante]</td>";
              echo "<td align='center'><a href='$campos[lattes_participante]' target='_blank' style='color: black'><img src='images/lattes.png' width='15px' height='15px'></a></td>";
              echo "<td>$campos[local]</td>";
              echo "<td align='center'>$campos[vagas]</td>";
              echo "<td>" . date("d/m/Y", strtotime($campos[data])) . "</td>";
              echo "<td>$campos[horario]</td>";

              //Retirado -> onclick="javascript : selecionar()
              if (in_array($campos[codigo_sub_evento], $itensInscritos)) //
              {
                echo '<td ><input type="checkbox" id="s" name="insc_eventos[]"  size="1" disabled value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '" >';
              }
              else
              {
                  if ($campos[codigo_sub_evento] == 78)
                  {
                      echo '<td ><input type="checkbox" id="s" onclick="return false;" name="insc_eventos[]"  size="1"  value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '" checked>';
                  }
                  else
                  {
                      echo '<td ><input type="checkbox" id="s" name="insc_eventos[]"  size="1"  value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '" >';
                  }

              }
              echo '</td></tr>';
              $c++;
            }
            else
            {
              echo "<tr bgcolor='$cor'>";
              echo "<td>$campos[nome_sub_evento]</td>";
              //echo "<td>$campos[nome_evento]</td>";
              echo "<td>$campos[titulo]</td>";
              echo "<td>$campos[palestrante]</td>";
              echo "<td align='center' '><a href='$campos[lattes_participante]' target='_blank' style='color: #000000'><img src='images/lattes.png' width='15px' height='15px'></a></td>";
              echo "<td>$campos[local]</td>";
              echo "<td align='center'>$campos[vagas]</td>";
              echo "<td>" . date("d/m/Y", strtotime($campos[data])) . "</td>";
              echo "<td>$campos[horario]</td>";

              if (in_array($campos[codigo_sub_evento], $itensInscritos))
              {
                //echo '<td><input type="checkbox" id="s" disabled name="insc_eventos[]" size="1" onclick="javascript : selecionar()" value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '" checked>';
                  echo '<td><input type="checkbox" id="s" disabled name="insc_eventos[]" size="1" value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '" checked>';

              }
              else if(in_array("$campos[data]|$campos[horario]", $itensInscritosConflitos))
              {
                //echo '<td><input type="checkbox" id="s" disabled name="insc_eventos[]" size="1" onclick="javascript : selecionar()" value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '">';
                  echo '<td><input type="checkbox" id="s" disabled name="insc_eventos[]" size="1"  value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '">';
              }
              else
              {
                  if ($campos[codigo_sub_evento] == 78) //Obrigatória a participação nesse evento
                  {
                      //echo '<td><input type="checkbox" id="s" disabled name="insc_eventos[]" size="1" onclick="javascript : selecionar()" value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '" checked>';
                      echo '<td><input type="checkbox" id="s"  onclick="return false;" name="insc_eventos[]" size="1"  value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '" checked>';
                  }
                  else
                  {
                      //echo '<td><input type="checkbox" id="s" name="insc_eventos[]" size="1" onclick="javascript : selecionar()" value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '">';
                      echo '<td><input type="checkbox" id="s" name="insc_eventos[]" size="1"  value="' . $campos[codigo_sub_evento] . '|' . $campos[vagas] . '|' . $campos[nome_sub_evento] . '|' . $campos[data] . '|' . $campos[horario] . '">';
                  }

              }
              //if ($campos[codigo_evento] == 78)

    //          echo '></td></tr>';
              echo '</td></tr>';
              //echo '<input type="hidden" name="vagas" value="'.$campos[vagas].'">';
            }
          }
          //echo '</tr>';
          if ($cor == "#78e07b")
            $cor = "#95e197";
          else
            $cor = "#78e07b";
        }

        echo '</table>';
        echo '<br>';
        echo '<input type="hidden" name="evento" value="' . $_GET[codigo] . '">
                        <input type="hidden" name="arquivo2" value="insc_eventos.php">					
                        <input type="submit" value="Inscrever">&nbsp;<input type="reset" value="Limpar">
                        </form></center>
                        <br>';
  }

  if ((date("Ymd") < $data_i))
    echo '<center><font color="#FF0000">Inscrição em eventos começará na data ' . $data . '.</font><center>';

  if (date("Ymd") > $data_f)
    echo '<center><font color="#FF0000">Expirou a data de Inscrição em eventos no simpósio!!!</font><center>';

  mysql_close($conexao);
}
?>
