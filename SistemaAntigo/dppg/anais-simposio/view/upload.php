<?php
session_start();
include_once ('../trataInjection.php');

if(protectorString($_POST[ok]) || protectorString($_POST[code]))
    return;


if ($_SESSION[anais_logado] == TRUE) {
  $ok = $_POST[ok];
  if ($ok == 'ok') {

    $upFile = $_FILES['arq']; //Esse índice 'file' é o atributo NAME do input do formulário
    $tmpName = $upFile['tmp_name'];
    $fileName = str_replace(" ", "", $upFile['name']);
//    $error = (int) $upFile['error'];

//    if ($error == 0) {
      if (@move_uploaded_file($tmpName, 'docs/' . $fileName)) {
        include '../control/AltData.class.php';
        
        $altData = new AltData();
        
        $oNormas = $altData->AlterarNormas($_POST[code], $fileName);
        unset($altData);
      } else {
        $oNormas = NULL;
      }
//    }
    ?>
    <section id="content" class="primary" role="main">
      <div id="post-5" class="post-5 page type-page status-publish hentry">
        <h2 class="page-title">Regulamento do Simpósio</h2>
        <div class="entry clearfix">
          <?php
          if ($ok == "ok") {
            if ($oNormas != NULL) {
              echo'<h6 class="page-title"><font style="color: #006400">Editado com sucesso !!!</font></h6>';
//            . '<!--meta http-equiv="refresh" content="2; URL=?data=view/normas" /-->';
            } else if ($ok == 'ok') {
              echo'<h6 class="page-title"><font style="color: #a00">Falha na edição !!!</font></h6>';
//            . '<!--meta http-equiv="refresh" content="2; URL=?data=view/normas" /-->';
            }
          }
          ?>
        </div>
      </div>
    </section>
    <?php
    unset($oNormas);
  }
}
?>