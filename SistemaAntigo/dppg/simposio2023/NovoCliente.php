<?php

/*
 * classe NovoCliente
 * Formul�rio de cadastro de Clientes GTK
 */

class NovoCliente extends GtkWindow
{
    private $window;
    private $campos;
    private $labels;

    /*
     * m�todo construtor
     * instancia a janela e constr�i os campos
     */
    public function __construct()
    {
        parent::__construct();
        parent::set_title('Incluir');
        parent::connect_simple('destroy', array('Gtk', 'main_quit'));
        parent::set_default_size(400, 240);
        parent::set_border_width(10);
        parent::set_position(GTK::WIN_POS_CENTER);

        $vbox = new GtkVBox;

        $this->labels['id'] = new GtkLabel('C�digo:');
        $this->campos['id'] = new GtkEntry;
        $this->campos['id']->set_size_request(80, -1);

        $this->labels['nome'] = new GtkLabel('Nome: ');
        $this->campos['nome'] = new GtkEntry;
        $this->campos['nome']->set_size_request(240, -1);

        $this->labels['endereco'] = new GtkLabel('Endere�o: ');
        $this->campos['endereco'] = new GtkEntry;
        $this->campos['endereco']->set_size_request(240, -1);

        $this->labels['telefone'] = new GtkLabel('Telefone: ');
        $this->campos['telefone'] = new GtkEntry;
        $this->campos['telefone']->set_size_request(140, -1);

        $this->labels['id_cidade'] = new GtkLabel('Cidade: ');
        $this->campos['id_cidade'] = GtkComboBox::new_text();
        $this->campos['id_cidade']->set_size_request(240, -1);

        $this->campos['id_cidade']->insert_text(0, 'Porto Alegre');
        $this->campos['id_cidade']->insert_text(1, 'S�o Paulo');
        $this->campos['id_cidade']->insert_text(2, 'Rio de Janeiro');
        $this->campos['id_cidade']->insert_text(3, 'Belo Horizonte');

        foreach ($this->campos as $chave => $objeto) {
            $hbox = new GtkHBox;
            $hbox->pack_start($this->labels[$chave], false, false);
            $hbox->pack_start($this->campos[$chave], false, false);

            $this->labels[$chave]->set_size_request(100, -1);
            $this->labels[$chave]->set_alignment(1, 0.5); // xAlign, yalign (0.5, 1)

            $vbox->pack_start($hbox, false, false);
        }
        $vbox->pack_start(new GtkHSeparator, true, true);

        // cria uma caixa de bot�es
        $buttonbox = new GtkHButtonBox;
        $buttonbox->set_layout(Gtk::BUTTONBOX_START);

        // cria um bot�o de salvar
        $botao = GtkButton::new_from_stock(Gtk::STOCK_SAVE);
        // conecta o bot�o ao m�todo onSaveClick()
        $botao->connect_simple('clicked', array($this, 'onSaveClick'));
        $buttonbox->pack_start($botao, false, false);

        // cria um bot�o de fechar a aplica��o
        $botao = GtkButton::new_from_stock(Gtk::STOCK_CLOSE);
        $botao->connect_simple('clicked', array('Gtk', 'main_quit'));
        $buttonbox->pack_start($botao, false, false);

        $vbox->pack_start($buttonbox, false, false);

        parent::add($vbox);
        // exibe a janela
        parent::show_all();
    }

    /*
     * m�todo onSaveClick()
     * Executado quando usu�rio clica no bot�o salvar
     */
    public function onSaveClick()
    {
        // obt�m os valores dos campos
        $dados['id'] = $this->campos['id']->get_text();
        $dados['nome'] = $this->campos['nome']->get_text();
        $dados['endereco'] = $this->campos['endereco']->get_text();
        $dados['telefone'] = $this->campos['telefone']->get_text();
        $dados['id_cidade'] = $this->campos['id_cidade']->get_active();

        try {
            // instancia cliente SOAP
            $client = new SoapClient(NULL, array('encoding' => 'ISO-8859-1',
                'exceptions' => TRUE,
                'location' => "http://127.0.0.1/server.php",
                'uri' => "http://test-uri/"));

            // realiza chamada remota de m�todo
            $retorno = $client->salvar($dados);
            // exibe di�logo de mensagem
            $dialog = new GtkMessageDialog(null, Gtk::DIALOG_MODAL, Gtk::MESSAGE_INFO,
                Gtk::BUTTONS_OK, 'Registro inserido com sucesso!');
            $dialog->run();
            $dialog->destroy();
        } catch (SoapFault $excecao) // ocorr�ncia de erro
        {
            // exibe di�logo de erro
            $error = new GtkMessageDialog(null, Gtk::DIALOG_MODAL, Gtk::MESSAGE_ERROR,
                Gtk::BUTTONS_OK, $excecao->getMessage());
            $error->run();
            $error->destroy();
        }
    }
}

// instancia janela NovoCliente
new NovoCliente;
Gtk::Main();
?>
