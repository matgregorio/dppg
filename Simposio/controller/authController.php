<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../model/user.php';
include_once __DIR__ . '/../util/validateCpf.php';
include_once __DIR__ . '/../util/send_mail.php';
include_once __DIR__ . '/../model/emailTemplate.php';

class AuthController {
    private $db;
    private $user;
    private $emailTemplate;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
        $this->emailTemplate = new EmailTemplate($this->db);
    }

    public function viewLogin(){
        include_once __DIR__ . '/../view/login.php';
    }
    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];
        }

        if($this->user->login()) {
            if($this->user->is_approved == 0 && $this->user->user_type == 3){
                $_SESSION['error_message'] = "Seu cadastro como professor ainda não foi aprovado. Por favor, aguarde!";
                header("Location: /dppg/Simposio/");
                exit();
            }
            session_start();
            $_SESSION['user_id'] = $this->user->id;
            $_SESSION['user_name'] = $this->user->name;
            $_SESSION['user_type'] = $this->user->user_type;
            header("Location: /dppg/Simposio/");
        } else {
            $_SESSION['error_message'] = "Falha no login. email ou senha inválido.";
            header("Location: /dppg/Simposio/");
        }
    }

    public function register() {
        $_SESSION['form_data'] = [ #não apagar dados do formulário em caso de erro
            'name' => $_POST['name'],
            'cpf' => $_POST['cpf'],
            'email' => $_POST['email'],
            'user_type' => $_POST['user_type']
        ];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['password'] !== $_POST['confirm_password']){#verifica se as senhas conferem
                $_SESSION['error_message'] = "Senhas não conferem.";
                header("Location: ../view/registrer.php");
                 return;
             }
             if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){#verifica se o formato de email é valido(não faz busca no bd)
                $_SESSION['error_message'] = "Formato inválido de email.";
                header("Location: ../view/registrer.php");
                return;
            }
            if(!isValidCPF($_POST['cpf'])){#verifica se o cpf é válido(não faz busca no bd)
                $_SESSION['error_message'] = "CPF inválido.";
                header("Location: ../view/registrer.php");
                return;
            }
            $this->user->cpf = $_POST['cpf'];
            if($this->user->cpfExists()){#verifica se o cpf está sendo utlizado na base de dados
                $_SESSION['error_message'] = "CPF já cadastrado!";
                header("Location: ../view/registrer.php");
                return;
            }
            $this->user->email = $_POST['email'];
            if($this->user->emailExists()){#verifica se o email está sendo utilizado na base de dados
                $_SESSION['error_message'] = "Email já utilizado na base de dados.";
                header("Location: ../view/registrer.php");
                return;
            }
            if($_POST['user_type'] == 3){
                $this->user->is_approved = 0;
            }else{
                $this->user->is_approved = 1;
            }
            $this->user->name = $_POST['name'];
            $this->user->password = $_POST['password'];
            $this->user->user_type = $_POST['user_type'];
            if($this->user->create()){
                $template = $this->emailTemplate->readByType('registration_confirmation');
                $subject = $template['subject'];
                $name = $this->user->name;
                $body = str_replace('{name}', $name, $template['body']);

                $result = sendEmail($_POST['email'], $subject, $body);
                if($result === false){
                    $_SESSION['error_message'] = $result;
                }
                if($this->user->user_type == 3){
                    $_SESSION['message'] = "Usuário cadastrado. Por favor, aguarde sua aprovação";
                }else{
                    $_SESSION['message'] = "Usuário cadastrado com sucesso";
                }

                unset($_SESSION['form_data']);
                header("Location: ../view/login.php");
            }else{
                $_SESSION['error_message'] = "Erro ao registrar.";
                header("Location: ../view/registrer.php");
            }
        }
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $token = bin2hex(random_bytes(50)); // Gera um token aleatório

            // Verifica se o email existe
            $this->user->email = $email;
            if ($this->user->emailExists()) {
                $this->user->reset_token = $token;
                if ($this->user->updateResetToken()) {               
                    $template = $this->emailTemplate->readByType('password_reset');
                    $resetLink = "localhost/dppg/simposio/view/reset_password.php?token=$token";
                    $subject = $template['subject'];
                    $body = str_replace('{link}', $resetLink, $template['body']);

                    $result = sendEmail($email, $subject, $body);
                    if ($result === true) {
                        $_SESSION['message'] = "Verifique seu email para o link de recuperação de senha.";
                    } else {
                        $_SESSION['error_message'] = $result;
                    }
                } else {
                    $_SESSION['error_message'] = "Erro ao salvar o token de recuperação.";
                }
            } else {
                $_SESSION['error_message'] = "Email não encontrado.";
            }
        }
        header("Location: ../view/forgot_password.php");
        exit();
    }

    public function resetPassword(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $token = $_POST['token'];
            if($_POST['password'] !== $_POST['confirm_password']){
                $_SESSION['error_message'] = "Senhas não conferem.";
                header("Location: ../view/reset_password.php?token=$token");
                return;
            }
            $this->user->reset_token = $_POST['token'];
            if($this->user->validateToken()){
                $this->user->password = $_POST['password'];

                if($this->user->updatePassword()){
                    $_SESSION['message'] = "Senha alterada com sucesso";
                    header("Location: ../view/login.php");
                }else{
                    $_SESSION['error_message'] = "Falha ao alterar a senha.";
                    header("Location ../view/reset_password.php?token=$token");
                }
            }else{
                $_SESSION['error_message'] = "Token inválido ou expirado.";
                header("Location: ../view/reset_password.php?token=$token");
            }
        }
        
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../view/logout.php");
        exit();
    }
}
?>
