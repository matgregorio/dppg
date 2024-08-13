<?php
session_start();
include_once '../config/database.php';
include_once '../model/regulation.php';

class RegulationController{
    private $database;
    private $db;
    private $regulation;

    public function __construct()
    {
        $this->database = new Database();
        $this->db = $this->database->getConnection();
        $this->regulation = new Regulation($this->db);
    }

    public function upload(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_FILES['regulation']) && $_FILES['regulation']['error'] == 0){
                $allowed = ['pdf' => 'application/pdf'];
                $file_name = $_FILES['regulation']['name'];
                $file_type = $_FILES['regulation']['type'];
                $file_size = $_FILES['regulation']['size'];

                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                if(!array_key_exists($ext, $allowed) || $file_type != $allowed[$ext]){
                    $_SESSION['error_message'] = "Formato de arquivo inválido. Apenas PDFs são aceitos";
                    header("Location: ../view/upload_regulation.php");
                    exit();
                }

                if($file_size > 5 * 1024 * 1024){
                    $_SESSION['error_message'] = "O arquivo excede o tamanho máximo permitido de 5MB.";
                    header("Location: ../view/upload_regulation.php");
                    exit();
                }

                $new_file_name = uniqid() . "." . $ext;
                $destination = "../uploads/" . $new_file_name;

                if(move_uploaded_file($_FILES['regulation']['tmp_name'], $destination)){
                    $this->regulation->file_name = $new_file_name;
                    $this->regulation->id_user = $_SESSION['user_id'];
                    if($this->regulation->upload()){
                        $_SESSION['message'] = "Regulamento enviado com sucesso.";
                        header("Location: ../view/home_page.php");
                        exit();
                    }else{
                        $_SESSION['error_message'] = "Erro ao salvar o regulamento no banco de dados";
                    }
                }else{
                    $_SESSION['error_message'] = "Erro ao mover o arquivo. ";
                }
            }else{
                $_SESSION['erorr_message'] = "Erro ao enviar o arquivo.";
            }
        }
    }
    
    public function viewAll(){
        return $this->regulation->getAll();
    }

}

if(isset($_GET['action'])){
    $controller = new RegulationController();
    switch($_GET['action']){
        case 'upload':
            $controller->upload();
            break;
        case 'viewAll':
            $controller->viewAll();
            break;
        default:
            header("Location ../view/login.php");
            break;
    }
}

?>