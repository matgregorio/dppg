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
            unset($_SESSION['form_data']);
            header("Location: ../view/login.php");
        } else {#se não, emite erro!
            $_SESSION['error_message'] = "Erro ao registrar.";
            header("Location: ../view/registrer.php");
        }
    }

    public function forgotPassword($email){
        $this->user->email = $email;
        if($this->user->emailExists()){//se o email inserido existir
            $reset_token = bin2hex(random_bytes(16));
            $this->user->reset_token = $reset_token;

            if($this->user->updateResetToken()){
                $reset_link = "localhost/dppg/simposio/view/reset_password.php?token=$reset_token";
                $to = $email;
                $subject = "DPPG - Recuperação de senha";
                $message = "Clique aqui para redefinir sua senha: $reset_link";
                $headers = "dppg@ifsudestemg.com";

                if(mail($to,$subject,$message,$headers)){
                    $_SESSION['message'] = "Um link de recuperação de senha foi enviado para o seu email.";
                }else{
                   $_SESSION['error_message'] = "Falha ao enviar o email de recuperação."; 
                }
            }else{
                $_SESSION['error_message'] = "Falha ao gerar o token de recuperação.";
            }
        }else{
            $_SESSION['error_message'] = "Email não encontrado.";
        }
        header("Location: ../view/forgot_password.php");
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
                header("Location: ../views/reser_password.php?token=$token");
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
    } elseif(isset($_POST['forgot_password'])){
        $auth->forgotPassword($_POST['email']);
    } elseif(isset($_POST['reset_password'])){
        $auth->resetPassword(
            $_POST['token'],
            $_POST['password'],
            $_POST['confirm_password']
        );
    }
}
?>
