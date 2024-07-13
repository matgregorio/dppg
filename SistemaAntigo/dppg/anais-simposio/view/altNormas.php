<?php
session_start();
include 'control/AltData.class.php';
include_once ('../trataInjection.php');

if(protectorString($_POST[ok]) || protectorString($_POST[code]))
    return;


if ($_SESSION[anais_logado] == TRUE) {
  if ($_POST[ok] == 'ok') {
    $altData = new AltData();

    $arquivo = str_replace(" ", "_", $_FILES[arq][name]);
    $dir = "docs/";
//    chmod($dir, 777);
    if (move_uploaded_file($_FILES[arq][tmp_name], $dir . "" . $arquivo)) {
      $oNormas = $altData->AlterarNormas($_POST[code], $arquivo);
    } else {
      $oi = "aui";
      $oNormas = NULL;
    }
    

    unset($altData);
  } else {
    session_start();
    include ("model/dao/NormasPublicacaoDao.class.php");
    include ("model/NormasPublicacao.class.php");

    $normasDao = new NormasPublicacaoDao("dppg_simposio");
    $oNormas = new NormasPublicacao(NULL, NULL);
    $oNormas = $normasDao->getObjects();
    unset($normasDao);
  }
  ?>
  <section id="content" class="primary" role="main">
    <div id="post-5" class="post-5 page type-page status-publish hentry">
      <h2 class="page-title">Regulamento do Simpósio</h2>
      <?php if ($_SESSION[anais_logado] == true) { ?>
        <!--<br><h5><a href="?data=view/altNormas"><img src="images/alterar.gif"/>Editar Conteúdo</a></h5>-->
      <?php } ?>
      <div class="entry clearfix">
        <?php
        if ($_POST[ok] == "ok") {
          if ($oNormas != NULL) {
            echo'<h6 class="page-title"><font style="color: #006400">Editado com sucesso !!!</font></h6>';
//            . '<meta http-equiv="refresh" content="2; URL=?data=view/normas" />';
          } else if ($_POST[ok] == 'ok') {
            echo'<h6 class="page-title"><font style="color: #a00">Falha na edição !!! '.$oi.'</font></h6>';
//            . '<meta http-equiv="refresh" content="2; URL=?data=view/normas" />';
          }
        } else {
          ?>
          <p style="text-align: justify;">
          <h5>Arquivo Atual:<a target="_blank" href="docs/<?php echo $oNormas->getTexto(); ?>"><?php echo $oNormas->getTexto(); ?></a></h5>
          </p>
          <form name="normas" action="index.php?data=view/altNormas" method="post" enctype="multipart/form-data">
            <h5>Selecione o novo Arquivo: <input type="file" name="arq"/></h5>
            <input type="hidden" name="ok" value="ok">
            <input type="hidden" name="code" value="<?php echo $oNormas->getCodigo() ?>">
            <input type="submit" name="salvar" value="Salvar">
          </form>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php
  unset($oNormas);
}
?>