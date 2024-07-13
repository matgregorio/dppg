<?php

session_start();
include('acentuacao.php');

if (logado_simposio_2015)
{


    include("MPDF56/mpdf.php");
    //=================================================================================================================    

    $estruturaHtml = 
        "<html> 
        
            <body>
                    teste
                    <img src = 'images/Topo.png'> 
                    
            </body>

        </html>";

//======================================================================================================================    
    $nomePdf = "certificadoParticipacao.pdf";

    //Instanciação da classe mPDF
    $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15); 

    //Escreve a página em pdf
    $mpdf -> WriteHtml($estruturaHtml);

    //Nome do arquivo, e o parâmetro I para o navegador não salvar, apenas imprimir
    $mpdf->Output($nomePdf, 'I');
    
    exit;
    
    
} 
else
{
    echo 'Não logado';
}
?>