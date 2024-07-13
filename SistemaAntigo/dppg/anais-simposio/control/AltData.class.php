<?php

class AltData {

  function AlterarInicio($codigo, $texto) {
    include 'model/dao/InicioDao.class.php';
    $inicioDao = new InicioDao("dppg_simposio");
    $resp = $inicioDao->Update($codigo, $texto);
    unset($inicioDao);
    return $resp;
  }

  function AlterarApresentacao($codigo, $texto) {
    include 'model/dao/ApresentacaoDao.class.php';
    $apresentacaoDao = new ApresentacaoDao("dppg_simposio");
    $resp = $apresentacaoDao->Update($codigo, $texto);
    unset($apresentacaoDao);
    return $resp;
  }

  function AlterarCorpoEditorial($codigo, $texto) {
    include 'model/dao/CorpoEditorialDao.class.php';
    $corpoEditorialDao = new CorpoEditorialDao("dppg_simposio");
    $resp = $corpoEditorialDao->Update($codigo, $texto);
    unset($corpoEditorialDao);
    return $resp;
  }

  function AlterarExpediente($codigo, $texto) {
    include 'model/dao/ExpedienteDao.class.php';
    $expedienteDao= new ExpedienteDao("dppg_simposio");
    $resp = $expedienteDao->Update($codigo, $texto);
    unset($expedienteDao);
    return $resp;
  }

  function AlterarNormas($codigo, $texto) {
    include 'model/dao/NormasPublicacaoDao.class.php';
    $normasDao = new NormasPublicacaoDao("dppg_simposio");
    $resp = $normasDao->Update($codigo, $texto);
    unset($normasDao);
    return $resp;
  }

}
