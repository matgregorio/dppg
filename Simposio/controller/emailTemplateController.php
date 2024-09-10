<?php 
    session_start();
    include_once __DIR__ . '/../model/emailTemplate.php';
    include_once __DIR__ . '../config/database.php';

    class EmailTemplateController{
        private $db;
        private $template;

        public function __construct()
        {
            $database = new Database();
            $this->db = $database->getConnection();
            $this->template = new EmailTemplate($this->db);
        }

        public function view(){
            return $this->template->readAll();
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
            date_default_timezone_set('America/Sao_Paulo');
            $dataEHora = date("Y-m-d H:i:s");
            $this->template->updated_at = $dataEHora;
            $this->template->user_id = $_SESSION['user_id']; 

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