<?php 

class Router{
    public static function route($url){
        if($url == '/dppg/Simposio/'){ #homePage
            require __DIR__ . '/../controller/homeController.php';
            $controller = new HomeController();
            $controller->inicial();
        }
        elseif($url == '/dppg/Simposio/login'){ #viewLogin
            include_once __DIR__ . '/../controller/authController.php';
            $controller = new AuthController();
            $controller->viewLogin();
        }else if($url == '/dppg/Simposio/loginn'){ #solicitação de login
            require __DIR__ . '/../controller/authController.php';
            $controller = new AuthController();
            $controller->login();
        }else if($url == '/dppg/Simposio/forgotPassword'){#view recuperar senha
            include_once __DIR__ . '/../view/forgot_password.php';
        }else if($url == '/dppg/Simposio/logout'){
            include_once __DIR__ . '/../view/logout.php';
        }
        else{
            echo("Error 404 - Página não encontrada");
        }
    }
}
?>