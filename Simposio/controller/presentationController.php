<?php
session_start();
include_once __DIR__ . '/../model/presentation.php';
require_once __DIR__ . '/../config/database.php';

class PresentationController{
    private $presentation;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->presentation = new Presentation($db);
    }

    public function view(){
        $content = $this->presentation->getPresentation();
        include_once __DIR__ . '/../view/presentation.php';
    }

    public function edit(){
        if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2){
            $presentation = $this->presentation->getPresentation();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $content = $_POST['content'];
                if($this->presentation->updatePresentation($content)){
                    $_SESSION['message'] = "Texto de apresentação atualizado com sucesso. ";
                }else{
                    $_SESSION['error_message'] = "Erro ao atualizar o texto de apresentação.";
                }
                header("Location: ../view/home.php");
            }else{
                include '../view/edit_presentation.php';
            }
        }else{
            $_SESSION['error_message'] = "Você não tem permissão para editar o texto de apresentação.";
            header("Location: ../view/home.php");
        }
    }
}