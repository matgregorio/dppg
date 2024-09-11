<?php 

class Router{
    public static function route($url){
        if($url == '/dppg/Simposio/'){ #homePage
            require __DIR__ . '/../controller/homeController.php';
            $controller = new HomeController();
            $controller->inicial();
        }
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
        }else if($url == '/dppg/Simposio/presentation'){#view apresentação
            include_once __DIR__ . '/../controller/presentationController.php';
            $controller = new PresentationController();
            $controller->view();
        }else if($url == '/dppg/Simposio/editPresentation'){#view editar apresentação
            require __DIR__ . '/../controller/presentationController.php';
            $controller = new PresentationController();
            $controller->edit();
        }else if($url == '/dppg/Simposio/administracao'){
            include_once __DIR__ . '/../view/administrator.php';
        }else if($url == '/dppg/Simposio/saveEditPresentation'){
            require __DIR__ . '/../controller/presentationController.php';
            
        }
        else{
            echo("Error 404 - Página não encontrada");
        }
    }
}
?>