<?php
session_start();
include 'control/AltData.class.php';
include_once ('../trataInjection.php');

if(protectorString($_POST[ok]) || protectorString($_POST[code]) || protectorString($_POST[inicio]))
    return;

if ($_SESSION[anais_logado] == TRUE) {
  if ($_POST[ok] == 'ok') {
    $altData = new AltData();
    $oCorpoEditorial = $altData->AlterarCorpoEditorial($_POST[code], $_POST[inicio]);
    unset($altData);
  } else {
    include "model/dao/CorpoEditorialDao.class.php";
    include "model/CorpoEditorial.class.php";
    $CorpoDao = new CorpoEditorialDao("dppg_simposio");
    $oCorpoEditorial = new CorpoEditorial(NULL, NULL);
    $oCorpoEditorial = $CorpoDao->getObjects();
    unset($CorpoDao);
  }
  ?>
  <section id="content" class="primary" role="main">
    <div id="post-5" class="post-5 page type-page status-publish hentry">
      <h2 class="page-title">Editar Conteúdo do Corpo Editorial</h2>
      <div class="entry clearfix">
        <p style="text-align: justify;">
          <?php
          if ($_POST[ok] == "ok") {
            if ($oCorpoEditorial != NULL) {
              echo'<h6 class="page-title"><font style="color: #006400">Editado com sucesso !!!</font></h6>'
              . '<meta http-equiv="refresh" content="2; URL=?data=view/corpoEditorial" />';
            } else if ($_POST[ok] == 'ok') {
              echo'<h6 class="page-title"><font style="color: #a00">Falha na edição !!!</font></h6>'
              . '<meta http-equiv="refresh" content="2; URL=?data=view/corpoEditorial" />';
            }
          } else {
            ?>
          <form name="altInicio" action="index.php?data=view/altCorpoEditorial" method="POST">
            <center><input type="submit" name="salar" value="Salvar"/></center><br>
            <input type="hidden" name="ok" value="ok"/>
            <input type="hidden" name="code" value="<?php echo $oCorpoEditorial->getCodigo() ?>"/>
            <textarea name="inicio" style="width: 100%; min-height: 40%">
              <?php echo $oCorpoEditorial->getTexto(); ?>
            </textarea>
          </form>
        <?php } ?>
        </p>
      </div>
    </div>
  </section>

  <?php
  unset($oApresentacao);
}
?>