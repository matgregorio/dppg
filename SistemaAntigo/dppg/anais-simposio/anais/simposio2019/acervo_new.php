<head>
  <script type="text/javascript" src="jScript/jquery.js"></script>
  <script type="text/javascript">
    jQuery.fn.toggleText = function (a, b) {
      return this.html(this.html().replace(new RegExp("(" + a + "|" + b + ")"), function (x) {
        return (x == a) ? b : a;
      }));
    }

    $(document).ready(function () {
      $('.tgl').css('display', 'none')
      $('span', '#box-toggle').click(function () {
        $(this).next().slideToggle('slow')
                .siblings('.tgl:visible').slideToggle('fast');

        $(this).toggleText('plus', 'minus')
                .siblings('span').next('.tgl:visible').prev()
                .toggleText('plus', 'minus')
      });
    })
  </script>
</head>
<?php
include('/var/www/html/simposio2019/includes/config.php');
include_once ('../../../trataInjection.php');

if(protectorString($_POST[sa]) || protectorString($_POST[ano]) || protectorString($_POST[titulo])  || protectorString($_POST[autor1])  || protectorString($_POST[palavrachave]))
    return;

$sa = mysql_real_escape_string($_POST[sa]);
$ano = mysql_real_escape_string($_POST[ano]);
$sql_ano = "select * from ano where codigo_ano='$ano'";
$resultado_ano = mysql_query($sql_ano);
$campos_ano = mysql_fetch_array($resultado_ano);
$titulo = mysql_real_escape_string($_POST[titulo]);
$autor1 = mysql_real_escape_string($_POST[autor1]);
$palavra_chave = mysql_real_escape_string($_POST[palavra_chave]);

if ($sa == 't')
{
  $sql_trab = "SELECT a.codigo_trab, a.codigo_ano, a.codigo_acervo, t.* FROM acervo AS a, trabalhos AS t WHERE a.codigo_ano='$ano' AND (t.titulo LIKE '%$titulo%' AND t.palavra_chave LIKE '%$palavra_chave%' AND t.autor1 LIKE '%$autor1%' AND t.acervo='1') AND a.codigo_trab=t.codigo_trab ORDER BY t.titulo";
}
else
{
  $sql_trab = "SELECT a.codigo_trab, a.codigo_ano, a.codigo_acervo, t.* FROM acervo AS a, trabalhos AS t WHERE a.codigo_ano='$ano' AND (t.titulo LIKE '%$titulo%' AND t.palavra_chave LIKE '%$palavra_chave%' AND t.autor1 LIKE '%$autor1%' AND t.acervo='1') AND a.codigo_trab=t.codigo_trab AND t.codigo_sa='$sa' ORDER BY t.titulo";
}

$query_trab = mysql_query($sql_trab);
?>
<section id="content" class="primary" role="main">
  <div id="post-5" class="post-5 page type-page status-publish hentry">
    <h2 class="page-title"><b>Consultar Sumário de <?php echo $campos_ano[ano]; ?></b></h2>
    <div class="entry clearfix">
      <center><a href="?data=view/edicaoAtual">Voltar</a></center>

      <div id="box-toggle">
        <?php
        if (mysql_num_rows($query_trab) > 0)
        {
          echo '<br><br>';
          echo "<font><h6><b>Código - Título:</b></h6></font><br>";
          $cor = "#95e197";
          while ($campos = mysql_fetch_array($query_trab))
          {
            $titulo = '';
            $autor1 = '';
            $autor2 = '';
            $autor3 = '';
            $autor4 = '';
            $autor5 = '';
            $autor6 = '';
            $autor7 = '';
            $orientador = '';
            $apoios = '';
            $titulo = htmlspecialchars_decode($campos[titulo], ENT_QUOTES);
            echo "<span><p><img src='images/plus.gif' />&nbsp;&nbsp;<b>$campos[codigo_trab] - $titulo</b></p></span>";
            $autor1 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor1]'"));
            $orientador = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[cpf_prof_analisador]'"));
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
            $texto1 = $autor1[nome];
            $texto1 = $texto1 . ', ' . $orientador[nome];
            if ($autor2 != '') {
              $texto1 = $texto1 . ', ' . $autor2[nome];
            }
            if ($autor3 != '') {
              $texto1 = $texto1 . ', ' . $autor3[nome];
            }
            if ($autor4 != '') {
              $texto1 = $texto1 . ', ' . $autor4[nome];
            }
            if ($autor5 != '') {
              $texto1 = $texto1 . ', ' . $autor5[nome];
            }
            if ($autor6 != '') {
              $texto1 = $texto1 . ', ' . $autor6[nome];
            }
            if ($autor7 != '') {
              $texto1 = $texto1 . ', ' . $autor7[nome];
            }
            $result_apoios = mysql_query("SELECT apoio.nome FROM apoio, apoio_trabalho WHERE apoio.codigo_apoio=apoio_trabalho.codigo_apoio AND apoio_trabalho.codigo_trabalho='$campos[codigo_trab]'");
            $cont = 0;
            while ($campos_apoio = mysql_fetch_array($result_apoios)) {
              if ($cont == 0) {
                $apoios = $campos_apoio[nome];
                $cont++;
              } else {
                $apoios = "$apoios - $campos_apoio[nome]";
              }
            }
            $resumo = htmlspecialchars_decode($campos[resumo], ENT_QUOTES); //decodifica o texto
//          $resumo = str_replace("<p>", "", $campos[resumo]);
//          $resumo = str_replace("</p>", "", $resumo);
            ?>
            <div class="tgl">
              <br>
              <b><u>Autor(es):</u></b><br><br><?php echo $texto1; ?><br><br>
              <b><u>Resumo:</u></b><br>

              <p><?php echo $resumo; ?></p><br>
              <b><u>Palavra Chave:</u></b> <?php echo "$campos[palavra_chave]"; ?><br><br>
              <b><u>Apoio(s):</u></b><br><br>
              <?php echo "$apoios"; ?><br><br><br><br>
              <?php echo "<a href='../simposio2019/../simposio2019/gerar_pdf_trabalhos.php?codigot=$campos[codigo_trab]' target='_blanck' align='rigth'><img src='images/pdf.png'> Gerar PDF</a>"; ?>
            </div>
            <hr>
            <?php
          }
          mysql_close($conexao);
        }
        else
        {
          echo '<br><center><i>Nenhum registro encontrado</i></center><br>';
        }
        ?>
      </div>
    </div>
  </div>
</section>
