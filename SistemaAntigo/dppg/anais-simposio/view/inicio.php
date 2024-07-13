<?php
session_start();
include ("model/dao/InicioDao.class.php");
include ("model/Inicio.class.php");

$iniDao = new InicioDao("dppg_simposio");
$oInicio = new Inicio(NULL, NULL);
$oInicio = $iniDao->getObjects();
unset($iniDao);
?>
<section id="content" class="primary" role="main">
  <div id="post-5" class="post-5 page type-page status-publish hentry">
    <h2 class="page-title">Inicio</h2>
    <?php if ($_SESSION[anais_logado] == true) { ?>
      <br><h5><a href="?data=view/altInicio"><img src="images/alterar.gif"/>Editar Conteúdo</a></h5>
    <?php } ?>
    <div class="entry clearfix">
      <p style="text-align: justify;"><?php echo $oInicio->getTexto(); ?></p>
    </div>
  </div>
</section>