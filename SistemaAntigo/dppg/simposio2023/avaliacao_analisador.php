<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if (in_array("2", $_SESSION[codigo_grupo])) {
  ?>
  <title> Avaliação </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/valida_observacao.js"></script>
  <script>
    function fechar() {
      window.opener.location.reload();
    }
    function confirmar() {
        // só permitirá o envio se o usuário responder OK
        var resposta = window.confirm("De acordo com o item 3.2 da Chamada de Trabalhos, somente os resumos que apresentarem resultados, mesmo que parciais, mas que possam gerar uma conclusão, serão submetidos a avaliação externa.");
        if (resposta) {
            return true;
        } else {
            return false;
        }
    }
  </script>
  </head>
  <body onunload="opener.location.reload();">
    <?php
    include('includes/config.php');

    //histórico
    $codigopost = mysql_real_escape_string($_GET[codigo]);

    $sql3 = "select codigo_historico, observacao from historico where codigo_trab = '$codigopost'";
    $resultado3 = mysql_query($sql3);

    echo '<div id="conteudo3"><br>';

    if (mysql_num_rows($resultado3) > 0) {
      ?>
      <table border="0" class="esquerda" width="100%">
        <tr>
          <td align="center"><b>Histórico</b></td>
        </tr>
        <tr>
          <td align="center"><i>Observação feita pelo Professor Analisador</i></td>
        </tr>
        <?php
        while ($campos3 = mysql_fetch_array($resultado3)) {
          echo '<tr><td align="center"><img src="images/go-next.png" border="0" width="2%"> ' . $campos3[observacao] . '</td></tr>';
        }
        ?>
      </table>
      <hr align="center" width="90%"/>
      <?php
    }

    //Envio de trabalho
    $sql = "select * from trabalhos where codigo_trab = '$codigopost'";
    $resultado = mysql_query($sql);

    $cont = 0;

    while ($campos = mysql_fetch_array($resultado)) {
      ?>
      <form name="avaliacao" method="post" onsubmit="javascript: return checkcontatos()"  action="avaliacao1.php">
        <table border="0" class="esquerda" width="100%">
          <tr>
            <?php echo "<td align ='center'><b>Trabalho $campos[titulo]</b></td>"; ?>
          </tr>
          <tr>
            <td align ="center">Descreva as Observações abaixo</td></tr>
          <tr>
            <td align ="center"><textarea rows="20" cols="50" name="observacao"></textarea></td>
          </tr>
          <tr>
          </tr>
          <tr>
            <!-- <td align ="center"><input type="submit" value="Necessita de Modificações"></td> -->
          </tr>
        </table>
        <?php echo "<input type='hidden' name='codigot' value='$campos[codigo_trab]' >"; ?>
      </form>
      <?php echo '<form name="avaliacao' . $cont . '" method="post" action="aprovado.php">'; ?>
      <table border="0" class="esquerda" width="100%">
        <tr>
          <?php echo '<input type="hidden" name="codigot" value="' . $campos[codigo_trab] . '" >'; ?>
          <td><center><input type="submit" onClick="return confirmar()" value="Aprovado"></center></td>
    </tr>
    </table>
    </form>
    <?php echo '<form name="avaliacaon' . $cont . '" method="post" action="naprovado.php">'; ?>
    <table border="0" class="esquerda" width="100%">
      <tr>
        <?php echo '<input type="hidden" name="codigot" value="' . $campos[codigo_trab] . '" >'; ?>
        <td><center><input type="submit" value="Reprovado"></center></td>
    </tr>
    </table>
    </form>
    <?php
    $cont++;
  }
  ?>
  </div>
  </body>
  </html>
  <?php
}
?>
