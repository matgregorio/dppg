<?php
class EmailTemplate{
    public $conn;
    private $table_name = "email_templates";

    public $id;
    public $type;
    public $subject;
    public $body;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readAll(){
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id= :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  
    }

    public function readByType($type){
        $query = "SELECT * FROM " . $this->table_name . " WHERE type = :type LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(){
        $query = "UPDATE " . $this->table_name . " SET subject = :subject, body = :body WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':subject', $this->subject);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?> 