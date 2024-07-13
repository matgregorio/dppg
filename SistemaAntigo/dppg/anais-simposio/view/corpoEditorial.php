<?php
session_start();
include 'model/CorpoEditorial.class.php';
include 'model/dao/CorpoEditorialDao.class.php';

$corpDao = new CorpoEditorialDao("dppg_simposio");
$corpoEditorial = new CorpoEditorial(NULL, NULL);
$corpoEditorial = $corpDao->getObjects();
unset($corpDao);
?>
<section id="content" class="primary" role="main">
  <div id="post-5" class="post-5 page type-page status-publish hentry">
    <h2 class="page-title">Corpo Editorial</h2>
    <?php if ($_SESSION[anais_logado] == true) { ?>
      <br><h5><a href="?data=view/altCorpoEditorial"><img src="images/alterar.gif"/>Editar Conteúdo</a></h5>
    <?php } ?>
    <div class="entry clearfix">
      <p style="text-align: justify;"><?php echo $corpoEditorial->getTexto(); ?></p>
    </div>
  </div>
</section>