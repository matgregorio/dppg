<?php
session_start();
include 'model/Expediente.class.php';
include 'model/dao/ExpedienteDao.class.php';
$expedienteDao = new ExpedienteDao();
$expediente = new Expediente(NULL, NULL);
$expediente = $expedienteDao->getObjects();
unset($expedienteDao);
?>
<section id="content" class="primary" role="main">
  <div id="post-5" class="post-5 page type-page status-publish hentry">
    <h2 class="page-title">Expediente</h2>
    <?php if ($_SESSION[anais_logado] == true) { ?>
      <br><h5><a href="?data=view/altExpediente"><img src="images/alterar.gif"/>Editar Conteúdo</a></h5>
    <?php } ?>
    <div class="entry clearfix">
      <p style="text-align: justify;"><?php echo $expediente->getTexto(); ?></p>
    </div>
  </div>
</section>