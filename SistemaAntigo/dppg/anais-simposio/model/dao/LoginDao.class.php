<?php
session_start();
class LoginDao {
  private $connection = null;
  
  function __construct() {
    include 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory("dppg_simposio");
  }
  
  function Login($login, $senha){
    $quuerySelectLogin = "SELECT * FROM usuario WHERE login = ? AND senha = ?";
    $sttm = $this->connection->prepare($quuerySelectLogin);
    $sttm->bindParam(1, $login, PDO::PARAM_STR);
    $sttm->bindParam(2, $senha, PDO::PARAM_STR);
    $sttm->execute();
    if ($sttm->rowCount() > 0){
      $_SESSION[anais_logado] = TRUE;
      return TRUE;
    }
    return FALSE;
  }
  
  function Logout(){
    session_destroy();
    session_unset();
    return TRUE;
  }
}
?>