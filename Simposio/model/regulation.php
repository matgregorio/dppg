<?php
class Regulation{
    private $conn;
    private $table_name = "regulations";

    public $id;
    public $file_name;
    public $id_user;

    public $updated_at;
    public $created_at;
    public $deleted_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function upload(){
        $query = "INSERT INTO " . $this->table_name . " (file_name,id_user,updated_at) VALUES (:file_name,:id_user,:updated_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':file_name', $this->file_name);
        $stmt->bindParam(':id_user', $this->id_user);
        date_default_timezone_set('America/Sao_Paulo');
        $dataEHora = date("Y-m-d H:i:s");
        $stmt->bindParam('updated_at', $dataEHora);
        return $stmt->execute();
    }

    public function getAll(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY updated_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>