<?php
$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));
if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm)) {
  include('includes/config2.php');

  $sql = "SELECT * FROM projetos ORDER BY projeto ASC";
  $resultado = mysql_query($sql);

  $controle = 0;
  echo '<center>';
  $cor = "#95e197";

  while ($campos = mysql_fetch_array($resultado)) {
    if ($controle == 0) {
      ?>
      <br><br>
      <center>
        <b>
          Listagem dos projetos cadastrados<br>Total de projetos cadastrados: <?php echo mysql_num_rows($resultado); ?>
        </b>
        <!--</center>-->
        <br>
        <table>
          <tr bgcolor=#61C02D>
            <td><font color="FFFFFF"><center><b><i>Nome do Projeto</i></b></center></font></td>
          <td><font color="FFFFFF"><center><b><i>Fomento</i></b></center></font></td>
          <td><font color="FFFFFF"><center><b><i>Vigência</i></b></center></font></td>
      <!--           <td><font color="FFFFFF"><center><b><i>Data Realização</i></b></center></font></td>-->
          <td><font color="FFFFFF"><center><b><i>Editar Projetos</i></b></center></font></td>
          </tr>
          <?php
        }
//        $data_inicio = implode("/", array_reverse(explode("-", $campos[data_inicio])));
//        $data_final = implode("/", array_reverse(explode("-", $campos[data_fim])));
//        $data_realizacao = implode("/", array_reverse(explode("-", $campos[data_realizacao])));

        $controle = 1;
        echo '<tr bgcolor="' . $cor . '">';
        echo '<td>' . $campos[projeto] . '</td>';
        echo '<td>' . $campos[fomento] . '</td>';
        echo '<td>' . $campos[vigencia] . '</td>';
//        echo '<td style="text-align: center">' . $data_realizacao . '</td>';
        echo '<td style="text-align: center"><a target="_blank" href="subsistemas/cursos/certificado_palestrantes.php?codigo_curso=' . $campos[idProjeto] . '" title="Certificado"><img src="images/editar.png" width="24" height="24" alt="" /></a></td>';
        echo'</tr>';
        if ($cor == "#78e07b")
          $cor = "#95e197";
        else
          $cor = "#78e07b";
      }
      ?>
    </table>
  </center>
  <br>
  <?php
}
mysql_close($conexao);
?>
