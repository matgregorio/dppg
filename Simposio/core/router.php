<?php

use Google\Service\ServiceControl\Auth;

class Router{
    public static function route($url){
        #menu completo
        #homePage
        if($url == '/dppg/Simposio/'){
            require __DIR__ . '/../controller/homeController.php';
            $controller = new HomeController();
            $controller->inicial();
        }
        #apresentação
        else if($url == '/dppg/Simposio/apresentacao'){
            include_once __DIR__ . '/../controller/presentationController.php';
            $controller = new PresentationController();
            $controller->view();
        }
        #regulamento
        else if($url == '/dppg/Simposio/regulamento'){
            include_once __DIR__ . '/../controller/regulationController.php';
            $controller = new RegulationController();
            $controller->viewAll();
        }
        #corpo editorial
        #expediente
        #Normas para publicação
        #Programação
        #Modelo de Pôster
        #Validar certificado
        #Anais
        #DPPG - Já inserido no HREF do código
        #Se o usuário não tiver feito login
        #Cadastrar
        #Mostar view login
        else if($url == '/dppg/Simposio/login'){ #viewLogin
            include_once __DIR__ . '/../controller/authController.php';
            $controller = new AuthController();
            $controller->viewLogin();
        }else if($url == '/dppg/Simposio/loginn'){ #solicitação de login
            require __DIR__ . '/../controller/authController.php';
            $controller = new AuthController();
            $controller->login();
        }else if($url == '/dppg/Simposio/forgotPassword'){#view recuperar senha
            include_once __DIR__ . '/../view/forgot_password.php';
        }else if($url == '/dppg/Simposio/logout'){#view logout
            include_once __DIR__ . '/../view/logout.php';
        }else if($url == '/dppg/Simposio/editPresentation'){#view editar apresentação
            require __DIR__ . '/../controller/presentationController.php';
            $controller = new PresentationController();
            $controller->edit();
        }
        #parte administrativa
        #view de administração
        else if($url == '/dppg/Simposio/administracao'){
            include_once __DIR__ . '/../view/administrator.php';
        }
        #view de aprovar professores
        else if($url == '/dppg/Simposio/administracao/aprovarProfessores'){
            require __DIR__ . '/../controller/authController.php';
            $controller = new AuthController();
            $controller->viewApproveTeachers();
        }
        #confirmação de formulário
        else if($url == '/dppg/Simposio/administracao/aprovarProfessor'){
            require __DIR__ . '/../controller/authController.php';
            $controller = new AuthController();
            $controller->approveTeachers();
        }
        #view de editar template de email
        else if($url == '/dppg/Simposio/administracao/editarEmail'){
            require __DIR__ . '/../controller/emailTemplateController.php';
            $controller = new EmailTemplateController();
            $controller->viewEmailsTemplateController();
        }
        #formulário de envio de edição de template de email
        else if($url == '/dppg/Simposio/administracao/editEmailTemplate'){
            require __DIR__ . '/../controller/emailTemplateController.php';
            $controller = new EmailTemplateController();
            $controller->update();
 
        }
        #view de editar apresentação
        else if($url == '/dppg/Simposio/administracao/editarApresentacao'){
            require __DIR__ . '/../controller/presentationController.php';
            $controller = new PresentationController();
            $controller->edit();
        }
        else{
            echo("Error 404 - Página não encontrada");
        }
    }
}
?>