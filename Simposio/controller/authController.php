<?php
session_start();
include_once '../config/database.php';
include_once '../model/user.php';
include_once '../util/validateCpf.php';
include_once '../util/send_mail.php';
include_once '../model/emailTemplate.php';

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
        #função para não apagar dados do formulário caso aconteça algum erro na hora do preenchimento
        $_SESSION['form_data'] = [
            'name' => $name,
            'cpf' => $cpf,
            'email' => $email,
            'user_type' => $user_type
        ];
        if($password !== $confirm_password){#verifica se as senhas conferem
           $_SESSION['error_message'] = "Senhas não conferem.";
           header("Location: ../view/registrer.php");
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){#verifica se o formato de email é valido(não faz busca no bd)
            $_SESSION['error_message'] = "Formato inválido de email.";
            header("Location: ../view/registrer.php");
            return;
        }

        if(!isValidCPF($cpf)){#verifica se o cpf é válido(não faz busca no bd)
            $_SESSION['error_message'] = "CPF inválido.";
            header("Location: ../view/registrer.php");
            return;

        }
        $this->user->cpf = $cpf;
        if($this->user->cpfExists()){#verifica se o cpf está sendo utlizado na base de dados
            $_SESSION['error_message'] = "CPF já cadastrado!";
            header("Location: ../view/registrer.php");
            return;
        }
        if($this->user->emailExists()){#verifica se o email está sendo utilizado na base de dados
            $_SESSION['error_message'] = "Email já utilizado na base de dados.";
            header("Location: ../view/registrer.php");
            return;
        }

        $this->user->name = $name;
        $this->user->email = $email;
        $this->user->password = $password;
        $this->user->user_type = $user_type;

        if($this->user->create()) { #se o usuário foi criado, então resete os dados do formulário
            $_SESSION['message'] = "Usuário cadastrado com sucesso";
            unset($_SESSION['form_data']);
            header("Location: ../view/login.php");
        } else {#se não, emite erro!
            $_SESSION['error_message'] = "Erro ao registrar.";
            header("Location: ../view/registrer.php");
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
                    $resetLink = "localhost/view/reset_password.php?token=$token";
                    $subject = $template['subject'];
                    $body = str_replace('{resetLink}', $resetLink, $template['body']);

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
    public function resetPassword($token,$password, $confirm_password){
        if($password !== $confirm_password){
            $_SESSION['error_message'] = "Senhas não conferem.";
            header("Location: ../view/reset_password.php?token=$token");
            return;
        }
        $this->user->reset_token = $token;
            if($this->user->validateToken()){
                $this->user->password = $password;

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

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../view/login.php");
        exit();
    }
}

if(isset($_GET['action'])){
    $controller = new AuthController();
    switch($_GET['action']){
        case 'login':
            $controller->login($_POST['email'], $_POST['password']);
            break;
        case 'register':
            $controller->register($_POST['name'], $_POST['cpf'], $_POST['email'], $_POST['password'], $_POST['confirm_password'], $_POST['user_type']);
            break;
        case 'forgotPassword':
            $controller->forgotPassword();
            break;
        case 'resetPassword':
            $controller->resetPassword(
                $_POST['token'],
                $_POST['password'],
                $_POST['confirm_password']
            );
            break;
        case 'logout':
            $controller->logout();
            break;
    }
}
?>
