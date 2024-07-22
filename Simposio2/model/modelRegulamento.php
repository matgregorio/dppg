<?php 
    class regulamento{
        private $idRegulamento;
        private $textoRegulamento;
        private $idUsuario;
        private $nomeArquivo;

        private $created_at;
        private $updated_at;
        private $deleted_at;

        public function __construct($idRegulamento,$textoRegulamento,$idUsuario,$nomeArquivo,$created_at,$updated_at,$deleted_at){
            $this->idRegulamento = $idRegulamento;
            $this->textoRegulamento = $textoRegulamento;
            $this->idUsuario = $idUsuario;
            $this->nomeArquivo = $nomeArquivo;
            $this->created_at = $created_at;
            $this->updated_at = $updated_at;
            $this->deleted_at = $deleted_at;
        }

        public function getIdRegulamento(){
            return $this->idRegulamento;
        }

        public function getTextoRegulamento(){
            return $this->textoRegulamento;
        }

        public function getIdUsuario(){
            return $this->idUsuario;
        }

        public function getNomeArquivo(){
            return $this->nomeArquivo;
        }

        public function getCreated_at(){
            return $this->created_at;
        }

        public function getUpdated_at(){
            return $this->updated_at;
        }

        public function getDeleted_at(){
            return $this->deleted_at;
        }

        public function setIdRegulamento($idRegulamento){
            $this->idRegulamento = $idRegulamento;
        }
    }
?>