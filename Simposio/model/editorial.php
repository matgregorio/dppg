<?php 

require_once __DIR__ . '/../config/database.php';

class Editorial{
    private $conn;
    private $table_name = "editorial";

    public $id;
    public $content;
    public $id_user;

    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getEditorial(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = 1 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fecth(PDO::FETCH_ASSOC);
    }
    
    public function updateEditorial(){
        $query = "UPDATE " . $this->table_name . " SET content"
    }

    public function setEditorial(){
        $query = "INSERT INTO "
    }
        
}
?>
