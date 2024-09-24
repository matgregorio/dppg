<?php 
    session_start();
    include_once __DIR__ . '/../model/emailTemplate.php';
    include_once __DIR__ . '/../config/database.php';

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

        public function update(){
            $this->template->id = $_POST['id'];
            $this->template->subject = $_POST['subject'];
            $this->template->body = $_POST['body'];
            date_default_timezone_set('America/Sao_Paulo');
            $dataEHora = date("Y-m-d H:i:s");
            $this->template->updated_at = $dataEHora;
            $this->template->user_id = $_SESSION['user_id']; 

            if($this->template->update()){
                $_SESSION['message'] = "Template atualizado com sucesso.";
            }else{
                $_SESSION['error_message'] = "Falha ao atualizar o template.";
            }
            $this->viewEmailsTemplateController();
        }

        public function viewEmailTemplateController(){
            $emails = $this->template->readAll();
            include_once __DIR__ . '/../view/edit_email_template.php';
        }

        public function viewEmailsTemplateController(){
            $templates = $this->template->readAll();
            include_once __DIR__ . '/../view/edit_email_templates.php';
        }
    }
?> 