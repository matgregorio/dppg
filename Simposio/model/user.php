<?php
class User {
    private $conn;
    private $table_name = "user";

    public $id;
    public $name;
    public $cpf;
    public $email;
    public $password;
    public $user_type;
    public $reset_token;
    public $is_approved;

    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, cpf=:cpf, email=:email, password=:password, user_type=:user_type, created_at=:created_at, updated_at='0000-00-00 00:00:00', deleted_at ='0000-00-00 00:00:00'";
        $stmt = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->user_type=htmlspecialchars(strip_tags($this->user_type));
        date_default_timezone_set('America/Sao_Paulo');
        $dataEHora = date("Y-m-d H:i:s");
        $this->created_at = $dataEHora;

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", password_hash($this->password, PASSWORD_BCRYPT));
        $stmt->bindParam(":user_type", $this->user_type);
        $stmt->bindParam("created_at", $this->created_at);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->cpf = $row['cpf'];
                $this->email = $row['email'];
                $this->user_type = $row['user_type'];
                $this->is_approved = $row['is_approved'];
                return true;
            }
        }
        return false;
    }

    public function cpfExists(){
        $query = "SELECT id FROM " . $this->table_name . " WHERE cpf = :cpf LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function emailExists(){
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function updateResetToken(){
        $query = "UPDATE " . $this->table_name . " SET reset_token = :reset_token WHERE email =:email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':reset_token' , $this->reset_token);
        $stmt->bindParam(':email' , $this->email);
        return $stmt->execute();
    }

    public function validateToken(){
        $query = "SELECT id FROM " . $this->table_name . " WHERE reset_token = :reset_token LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':reset_token', $this->reset_token);
        $stmt->execute();

        if($stmt->rowCount()==1){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            return true;
        }
        return false;
    }

    public function updatePassword(){
        $query = "UPDATE " . $this->table_name . " SET password = :password, reset_token = NULL, updated_at = :updated_at WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));
        date_default_timezone_set('America/Sao_Paulo');
        $dataEHora = date("Y-m-d H:i:s");
        $stmt->bindParam(':updated_at' , $dataEHora);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function getPendingTeachers(){
        $query = "SELECT id, name, email,cpf FROM " . $this->table_name . " WHERE user_type = 3 AND is_approved = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approveTeacher(){
        $query = "UPDATE " . $this->table_name . " SET is_approved = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>
