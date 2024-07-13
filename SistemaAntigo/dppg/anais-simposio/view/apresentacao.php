<?php
session_start();
include ("model/dao/ApresentacaoDao.class.php");
include ("model/Apresentacao.class.php");

$apreDao = new ApresentacaoDao("dppg_simposio");
$oApresentacao = new Apresentacao(NULL, NULL);
$oApresentacao = $apreDao->getObjects();
unset($apreDao);
?>
<section id="content" class="primary" role="main">
  <div id="post-5" class="post-5 page type-page status-publish hentry">
    <h2 class="page-title">Apresentação</h2>
    <?php if ($_SESSION[anais_logado] == true) { ?>
      <br><h5><a href="?data=view/altApresentacao"><img src="images/alterar.gif"/>Editar Conteúdo</a></h5>
    <?php } ?>
    <div class="entry clearfix">
      <p style="text-align: justify;"><?php echo $oApresentacao->getTexto(); ?></p>
    </div>
  </div>
</section>
