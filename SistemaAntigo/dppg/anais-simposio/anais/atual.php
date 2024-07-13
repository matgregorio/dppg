<?php
include 'model/dao/ParticipanteDao.class.php';
include 'model/dao/TrabalhoDao.class.php';
include 'model/dao/ApoioDao.class.php';
include 'model/Trabalho.class.php';

$year = date("Y");

$sa = $_POST[sa];
$ano = $_POST[ano]; 
$titulo = $_POST[titulo];
$autor1 = $_POST[autor1];
$palavra_chave = $_POST[palavrachave];
$trabalhoDao = new TrabalhoDao("dppg_simposio$year");
$objListTrabalho = $trabalhoDao->getListObjectsFull($sa, $ano, "%$titulo%", "%$autor1%", "%$palavra_chave%");

$participanteDao = new ParticipanteDao("dppg_simposio$year");
$objListParticipante = $participanteDao->getObjects();

$_REQUEST[participante] = $objListParticipante;

?>

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
                .toggleText('plus', 'minus');
      });
    });
  </script>
</head>
<section id="content" class="primary" role="main">
  <div id="post-5" class="post-5 page type-page status-publish hentry">
    <h2 class="page-title"><b>Consultar Sumário de <?php echo $year; ?></b></h2>
    <div class="entry clearfix">
      <center><a href="?data=view/edicaoAtual">Voltar</a></center>
      <font><h6><u>Código - Título:</u></h6></font><br>
      <div id="box-toggle" style="overflow: auto; height: 500px; width: 100%;">
        <?php

        if (count($objListTrabalho) > 0)
        {
          $cor = "#95e197";
          foreach ($objListTrabalho as $trab) {
            $objTrabalho = new Trabalho();
            $objTrabalho = $trab;
            $titulo = '';
            $apoios = '';

            $titulo = strtr(strtoupper($objTrabalho->getTitulo()), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

            $texto1 = $objListParticipante[$objTrabalho->getAutor1()]->getNome();

            if ($objTrabalho->getAutor1() != $objTrabalho->getProf_analisador()) {
              $texto1 = $texto1 . ', ' . $objListParticipante[$objTrabalho->getProf_analisador()]->getNome();
            }
            if ($objTrabalho->getAutor2() != NULL) {
              $texto1 = $texto1 . ', ' . $objListParticipante[$objTrabalho->getAutor2()]->getNome();
            }
            if ($objTrabalho->getAutor3() != NULL) {
              $texto1 = $texto1 . ', ' . $objListParticipante[$objTrabalho->getAutor3()]->getNome();
            }
            if ($objTrabalho->getAutor4() != NULL) {
              $texto1 = $texto1 . ', ' . $objListParticipante[$objTrabalho->getAutor4()]->getNome();
            }
            if ($objTrabalho->getAutor5() != NULL) {
              $texto1 = $texto1 . ', ' . $objListParticipante[$objTrabalho->getAutor5()]->getNome();
            }
            if ($objTrabalho->getAutor6() != NULL) {
              $texto1 = $texto1 . ', ' . $objListParticipante[$objTrabalho->getAutor6()]->getNome();
            }
            if ($objTrabalho->getAutor7() != NULL) {
              $texto1 = $texto1 . ', ' . $objListParticipante[$objTrabalho->getAutor7()]->getNome();
            }
            echo "<span><p><img src='images/plus.gif' />&nbsp;<b>" . $objTrabalho->getCodigo() . "</b> - <b>$titulo</b></p></span>";

            $apoioDao = new ApoioDao("dppg_simposio$year");
            $objListApoio = $apoioDao->getListObjects($objTrabalho->getCodigo());
            for ($i = 0; $i < count($objListApoio); $i++) {
              if ($i == 0) {
                $apoios = $objListApoio[$i]->getNome();
                $cont++;
              } else {
                $apoios = "$apoios - " . $objListApoio[$i]->getNome();
              }
            }

            $resumo = htmlspecialchars_decode($objTrabalho->getResumo(), ENT_QUOTES); //decodifica o texto
            ?>
            <div class="tgl">
              <!--<br>-->
              <b><u>Autor(es):</u></b><br><br><?php echo $texto1; ?>
              <br><br><b><u>Resumo:</u></b>

              <?php echo $resumo; ?>
              <b><u>Palavra Chave:</u></b> <?php echo $objTrabalho->getPalavra_chave(); ?><br><br>
              <b><u>Apoio(s):</u></b><br><br>
              <?php echo "$apoios"; ?><br><br><br><br>
              <?php echo "<a href='http://dppg.riopomba.ifsudestemg.edu.br/simposio".$year."/gerar_pdf_trabalhos.php?codigot=".$objTrabalho->getCodigo()."' target='_blanck' align='rigth'><img src='images/pdf.png'> Gerar PDF</a>"; ?>
            </div>
            <hr>
            <?php
          }
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
