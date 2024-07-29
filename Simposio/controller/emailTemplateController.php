<?php 
    session_start();
    include_once '../config/database.php';
    include_once '../model/emailTemplate.php';

    class EmailTemplateController{
        private $db;
        private $template;

        public function __construct()
        {
            $database = new Database();
            $this->db = $database->getConnection();
            $this->template = new EmailTemplate($this->db);
        }

        public function index(){
            $stmt = $this->template->readAll();
            $templates = $stmt->fetchAll(PDO::FETCH_ASSOC);
            include_once '../view/edit_email_templates.php';
        }

        public function edit($id){
            $this->template->id = $id;
            $template = $this->template->readOne();
            include_once '../view/edit_email_template.php';
        }

        public function update($id, $subject, $body){
            $this->template->id = $id;
            $this->template->subject = $subject;
            $this->template->body = $body;

            if($this->template->update()){
                $_SESSION['message'] = "Template atualizado com sucesso.";
            }else{
                $_SESSION['error_message'] = "Falha ao atualizar o template.";
            }
            header("Location: ../controller/emailTemplateController.php?action=index");
        }
    }
    if(isset($_GET['action'])){
        $controller = new EmailTemplateController();
        switch($_GET['action']){
            case 'index':
                $controller->index();
                break;
            case 'edit':
                if(isset($_GET['id'])){
                    $controller->edit($_GET['id']);
                }
                break;
            case 'update':
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $controller->update($_POST['id'], $_POST['subject'], $_POST['body']);
                }
                break;
        }
    }
?> 