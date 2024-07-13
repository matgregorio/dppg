<?php
/*
 * fun��o __autoload()
 * carrega uma classe quando ela � necess�ria,
 * ou seja, quando ela � instancia pela primeira vez.
 */
function __autoload($classe)
{
    $pastas = array('app.ado', 'app.model');
    foreach ($pastas as $pasta) {
        if (file_exists("{$pasta}/{$classe}.class.php")) {
            include_once "{$pasta}/{$classe}.class.php";
        }
    }
}

/*
 * classe ClienteFacade
 * Remote Facade para cadastro de Clientes
 */

class ClienteFacade
{
    /*
     * m�todo salvar()
     * recebe um array com dados de cliente e armazena no banco de dados
     */
    function salvar($dados)
    {
        try {
            // inicia transa��o com o banco 'pg_livro'
            TTransaction::open('pg_livro');
            // define um arquivo de log
            TTransaction::setLogger(new TLoggerTXT('/tmp/log.txt'));
            // instancia um Active Record para cliente

            $cliente = new Cliente;

            // alimenta o registro com dados do array

            $cliente->fromArray($dados);

            $cliente->store();           // armazena o objeto

            // fecha transa��o

            TTransaction::close();

        } catch (Exception $e) {
            // caso ocorra erros, volta a transa��o
            TTransaction::rollback();
            // retorna o erro na forma de um objeto SoapFault
            return new SoapFault("Server", $e->getMessage());
        }
    }
}

// instancia servidor SOAP
$server = new SoapServer(NULL, array('encoding' => 'ISO-8859-1', 'uri' => 'http://test-uri/'));
// define a classe que ir� responder �s chamadas remotas
$server->setClass('ClienteFacade');
// prepara-se para receber as chamadas remotas
$server->handle();
?>

