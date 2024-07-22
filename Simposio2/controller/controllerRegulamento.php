<?php
    require_once '../model';

    class RegulamentoController{
        private $db;

        public function __construct(PDO $pdo){
            $this->db = $pdo;
        }

        public function novoRegulamento(Regulamento $regulamento){
            $query = "INSERT INTO regulamento (textoRegulamento, idUsuario, nomeArquivo, created_at, updated_at, deleted_at) VALUES (:textoRegulamento,:idUsuario,:nomeArquivo,:created_at,:updated_at,:deleted_at)";
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':textoRegulamento', $regulamento->getTextoRegulamento());
            $stmt->bindParam(':idUsuario', $regulamento->getIdUsuario());
            $stmt->bindParam(':nomeArquivo', $regulamento->getNomeArquivo());
            $stmt->bindParam(':created_at', $regulamento->getCreated_at());
            $stmt->bindParam(':updated_at', $regulamento->getUpdated_at());
            $stmt->bindParam(':deleted_at', $regulamento->getDeleted_at());

            $stmt->execute();
            return $this->db->lastInsertId();
        }

        public function excluirRegulamento($idRegulamento){
            $query = "UPDATE INTO regulamento SET deleted_at = :";
        }
    }
?>