<?php
require_once __DIR__ . '/../config/database.php';
class Presentation{
    private $conn;
    private $table_name = "presentation";

    public $id;
    public $content;
    public $id_user;
    
    public $created_at;
    public $updated_at;
    public $deleted_at;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getPresentation(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = 1 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['content'];
    }

    public function updatePresentation($content){
        $query = "UPDATE " . $this->table_name . " SET content = :content WHERE id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':content', $content);
        return $stmt->execute(['content' => $content]);
    }
}
?>