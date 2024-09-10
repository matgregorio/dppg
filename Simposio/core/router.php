<?php 

class Router{
    public static function route($url){
        if($url == '/dppg/simposio/'){ #homePage
            require __DIR__ . '/../controller/homeController.php';
            $controller = new HomeController();
            $controller->inicial();
        }
        elseif($url == '/dppg/simposio/login'){ #viewLogin
            include_once __DIR__ . '/../controller/authController.php';
            $controller = new AuthController();
            $controller->viewLogin();
        }else if($url == '/dppg/simposio/loginn'){ #solicitação de login
            require __DIR__ . '/../controller/authController.php';
            $controller = new AuthController();
            $controller->login();
        }else if($url == '/dppg/simposio/'){

        }
        else{
            echo("Error 404 - Página não encontrada");
        }
    }
}
?>