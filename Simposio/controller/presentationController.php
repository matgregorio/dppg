<?php
session_start();
include_once '../config/database.php';
include_once '../model/presentation.php';

class PresentationController{
    private $database;
    private $db;
    private $presentation;

    public function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->getConnection();
        $this->presentation = new Presentation($this->db);
    }

    public function view(){
        return $this->presentation->getPresentation();
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

if(isset($_GET['action'])){
    $controller = new PresentationController();
    switch($_GET['action']){
        case 'view':
            $controller->view();
            break;
        case 'edit':
            $controller->edit();
            break;
        default:
            header("Location: ../view/login.php");
    }
}