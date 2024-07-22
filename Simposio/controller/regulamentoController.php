<?php
class regulamentoController{
    private $regulamento;

    public function __construct()
    {
        $this->regulamento = new Regulamento();
    }

    public function salvar(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $upload_dir = '../arquivos/';
                $upload_file = $upload_dir . basename($_FILES['file']['name']);
                
                if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                    echo "O arquivo " . htmlspecialchars(basename($_FILES['file']['name'])) . " foi enviado com sucesso.";
                    
                } else {
                    echo "Desculpe, houve um erro ao enviar seu arquivo.";
                }
            } else {
                echo "Nenhum arquivo foi enviado ou ocorreu um erro.";
            }
        } else {
            echo "Método de solicitação inválido.";
        }
    }
    
}
?>