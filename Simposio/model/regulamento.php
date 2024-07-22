<<?php
    class Regulamento
    {
        private $idRegulamento;
        private $textoRegulamento;
        private $arquivoRegulamento;
        private $idUsuario;

        private $created_at;
        private $updated_at;
        private $deleted_at;

        public function __construct(){
            
        }
        public function salvar()
        {
            include '../controller/DAO/daoRegulamento.php';
            
        }
    }


    ?>