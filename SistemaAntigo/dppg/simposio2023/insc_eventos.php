<?php

//valores[0] -> código do evento
//valores[1] -> número de vagas
//valores[2] -> Nome da programação
session_start();

include('includes/config.php');

/*Total de eventos inscrito(a)*/
$total = mysql_num_rows(mysql_query("SELECT cpf FROM itens_inscricao WHERE cpf='$_SESSION[cpf]'"));

if ((count($_POST[insc_eventos]) < 1) && $total < 1)
  echo '<br><center><b>É necessário se inscrever em no mínimo 1 programação</b></center><br>';
else if ((count($_POST[insc_eventos]) < 1) && ($_POST[evento] == 2))
{
  echo '<br><center><b>É necessário se inscrever em no mínimo 10 programações</b></center><br>';
}
else
{
//  $vetor[] = $_POST["insc_eventos"];


  foreach ($_POST["insc_eventos"] as $insc)
  {
    $valores = explode("|", $insc);
    $dados[] = $valores[3] . '|' . $valores[4];
  }

  $dados = array_count_values($dados);
//  var_dump($dados);

  $data = date("y-m-d");
  $hora = date("i:h");
  $pagamento = "S";
  $erro = 0;
  foreach ($_POST["insc_eventos"] as $insc_eventos)
  {
    $valores = explode("|", $insc_eventos);
    if ($dados[$valores[3] . '|' . $valores[4]] == 1)
    {
      $sqlI[$valores[0]] = "INSERT INTO itens_inscricao (cpf, codigo_sub_evento, presenca) VALUES ('$_SESSION[cpf]', '$valores[0]', '')";
      //var_dump($sqlI[$valores[0]]);

/*/*      echo $sql . "<hr>";
//      echo $valores[0];
//      echo $_SESSION[cpf];
//      $resultado = mysql_query($sql);
//
//      if ($resultado == 1) {
//        if ($_SESSION[trabalhos] != 'S') {
//          $vagas = $valores[1] - 1;
//          $sql = "update sub_eventos set vagas=$vagas where codigo_sub_evento=$valores[0]";
//          $resultado = mysql_query($sql);
//        }
//        echo '<center><br><b>Inscrição realizada com sucesso na programação ' . $valores[2] . '</b></center><br>';
//      } else {
//        echo '<center><br><b><font color="red">Erro no cadastro da programação ' . $valores[2] . '<br/><br/>Verifique possíveis conflitos de horários.</font></b></center><br>';
//      }*/
    } else {
      $erro = 1;
    }
  }
//  var_dump($sqlI);
//  echo count($sqlI);
    if (count($sqlI) < 1 && $total < 1) {
    echo '<br><center><b>Devido aos conflitos de horários, sobrou menos de 4 programações selecionadas</b></center><br>';
  } else {
    foreach ($sqlI as $cod => $in) {
//      echo "$in<br>";
      $resultado = mysql_query($in);

      if ($resultado == 1) {
        if ($_SESSION[trabalhos] != 'S') {
          $vagas = mysql_fetch_array(mysql_query("SELECT vagas FROM sub_eventos WHERE codigo_sub_evento='$cod'"));
          $vagas = $vagas[vagas] - 1;
          $sql1 = "update sub_eventos set vagas=$vagas where codigo_sub_evento='$cod'";
//          echo "$sql1 --- $cod<br>";
          $resultado = mysql_query($sql1);
        }
        echo '<center><br><b>Inscrição realizada com sucesso na programação ' . $valores[2] . '</b></center>';

        //Fazer com que pessoa realize o pagamento assim que fizer a inscrição
        $sqlInscricao = "INSERT INTO inscricao(cpf, data_inscricao, hora_inscricao, pagamento) values ('$_SESSION[cpf]','$data','$hora','$pagamento')";
        mysql_query($sqlInscricao);

      } else {
        echo '<center><br><b><font color="red">Erro no cadastro da programação ' . $valores[2] . '<br/><br/>Verifique possíveis conflitos de horários.</font></b></center><br>';
      }
    }
  }
  if ($erro == 1) {
    echo '<center><br><b><font color="red">Conflito de horários em um ou mais eventos selecionados, portanto os mesmos não serão registrados. Verifique os horários e selecione novamente</font></b></center><br>';
  }
}
echo "<br><br><center><br><a href=simposio.php?arquivo2=eventos_insc.php&codigo=1>Voltar</a></center><br><br>";
mysql_close($conexao);
?>
