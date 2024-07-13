<?php
session_start();
include ("model/dao/NormasPublicacaoDao.class.php");
include ("model/NormasPublicacao.class.php");

$normasDao = new NormasPublicacaoDao("dppg_simposio");
$oNormas = new NormasPublicacao(NULL, NULL);
$oNormas = $normasDao->getObjects();
unset($apreDao);
?>
<section id="content" class="primary" role="main">
  <div id="post-5" class="post-5 page type-page status-publish hentry">
    <h2 class="page-title">Regulamento do Simpósio</h2>
    <?php if ($_SESSION[anais_logado] == true) { ?>
      <!--<br><h5><a href="?data=view/altNormas"><img src="images/alterar.gif"/>Editar Conteúdo</a></h5>-->
    <?php } ?>
    <div class="entry clearfix">
      <object type='application/pdf'  data='docs/<?php echo $oNormas->getTexto() ?>' style='height: 885px; width: 95%'>
        <img src='images/pdf.png' border="0"><a target="_blank" href='docs/<?php echo $oNormas->getTexto() ?>'>&nbsp;Regulamento do Simpósio</a><br><br>
      </object>
    </div>
  </div>
</section>