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
}
?>
