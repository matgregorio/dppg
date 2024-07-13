<?php

/*
 * This file will be connecting to the database, but the database selection depends on the accessed page.
 */

class ConnectionFactory extends PDO {

  private $handle = null;

  function __construct($database) {
    $this->handle = NULL;
    define('DB_DRIVER', 'mysql');
    define('DB_HOST', 'dbmysql');
    define('DB_USER', 'userdppg');
    define('DB_PWD', 'n!t#cS!MP)S!)US#RDPPG');
    define('DB_DATABASE', $database);

    try {
      $this->handle = parent::__construct(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USER, DB_PWD, array(PDO::ATTR_PERSISTENT => FALSE));
//      $this->handle = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USER, DB_PWD);

      return $this->handle;
    } catch (PDOException $exc) {
      echo "Erro na conexão com a Base de Dados! Contacte o Administrador do Sitema.";
    }
  }

  function __destruct() {
    $this->handle = NULL;
  }

}

?>
