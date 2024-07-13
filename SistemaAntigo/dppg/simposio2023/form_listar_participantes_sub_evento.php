<?php
session_start();
if (!in_array("1", $_SESSION[codigo_grupo]))
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Somente administradores logados podem acessar esse conteúdo</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    return;
}

  include_once ('includes/config.php');

  $tabelaSubEventos = mysql_query("SELECT * FROM `sub_eventos`");
?>

  <html>
    <head>
      <script type="text/javascript" src="js/subeventos.js"></script>
    </head>
    <body>
    <center>
      <br><br>
        <h2><b style="text-align: center;">Selecione o subevento</b></h2>
      <br>
      <table>
        <tr>
          <td>
            <select id="selectSubEventos" name="subeventos" onchange="script : listar_subeventos(this.value)">
                <option value="null">Selecione o subevento</option>
                <?php
                    while($subEvento = mysql_fetch_array($tabelaSubEventos))
                        echo "<option value='$subEvento[codigo_sub_evento]'> $subEvento[nome_sub_evento] </option>";
                ?>
            </select>
          </td>
        </tr>
      </table>
      <br><hr><br>
    </center>
    <center>
      <div id="lista_subeventos"></div>
    </center>
    <script type="text/javascript">
      document.getElementById('lista_subeventos').focus();
    </script>
  </body>
  </html>
  <body>
    <?php

  ?>
