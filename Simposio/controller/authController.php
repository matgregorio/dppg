<?php
session_start();
include_once '../config/database.php';
include_once '../model/user.php';
include_once '../util/validateCpf.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function login($email, $password) {
        $this->user->email = $email;
        $this->user->password = $password;

        if($this->user->login()) {
            $_SESSION['user_id'] = $this->user->id;
            $_SESSION['user_name'] = $this->user->name;
            $_SESSION['user_type'] = $this->user->user_type;
            header("Location: ../view/home.php");
        } else {
            $_SESSION['error_message'] = "Falha no login. CPF ou senha inválido.";
            header("Location: ../view/login.php");
        }
    }

    public function register($name, $cpf, $email, $password,$confirm_password, $user_type) {
        $_SESSION['form_data'] = [
            'name' => $name,
            'cpf' => $cpf,
            'email' => $email,
            'user_type' => $user_type
        ];
        if($password !== $confirm_password){
           $_SESSION['error_message'] = "Senhas não conferem.";
           header("Location: ../view/registrer.php");
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error_message'] = "Formato inválido de email.";
            header("Location: ../view/registrer.php");
            return;
        }

        if(!isValidCPF($cpf)){
            $_SESSION['error_message'] = "CPF inválido.";
            header("Location: ../view/registrer.php");
            return;

        }
        $this->user->cpf = $cpf;
        if($this->user->cpfExists()){
            $_SESSION['error_message'] = "CPF já cadastrado!";
            header("Location: ../view/registrer.php");
            return;
        }
        if($this->user->emailExists()){
            $_SESSION['error_message'] = "Email já utilizado na base de dados.";
            header("Location: ../view/registrer.php");
            return;
        }

        $this->user->name = $name;
        $this->user->email = $email;
        $this->user->password = $password;
        $this->user->user_type = $user_type;

        if($this->user->create()) {
            unset($_SESSION['form_data']);
            header("Location: ../view/login.php");
        } else {
            $_SESSION['error_message'] = "Erro ao registrar.";
            header("Location: ../view/registrer.php");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ../view/login.php");
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth = new AuthController();
    if(isset($_POST['login'])) {
        $auth->login($_POST['email'], $_POST['password']);
    } elseif(isset($_POST['register'])) {
        $auth->register($_POST['name'], $_POST['cpf'], $_POST['email'], $_POST['password'],$_POST['confirm_password'],$_POST['user_type']);
    }
}
?>
