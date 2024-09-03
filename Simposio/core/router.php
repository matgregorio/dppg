<?php 

class router{
    public static function route($url){
        require '../controller/authController.php';



        switch($url){
            case '/login':
                $controller = new AuthController();
                $controller->login();
                break;
            case '/registrer':
                $controller = new AuthController();
                $controller->register();
                break;
            case '/resetPassword':
                $controller = new AuthController();
                $controller->resetPassword();
                break;
            case '/logout':
                $controller = new AuthController();
                $controller->logout();
                break;
            default:
                echo "404 - Página não encontrada";
        }
    }
}