<?php
session_start();
include 'acentuacao.php';
?>
<head>
    <title> Lista de inscritos </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>*{font-size: 1rem;}</style>
</head>
<?php
if(in_array("1", $_SESSION[codigo_grupo]))
{   
    //Essa linha abre a conexão como banco de dados
    include ("includes/config.php"); 
	
    $sqlParticipantes = "SELECT distinct p.nome, i.cpf, p.campus, p.email FROM participantes p, itens_inscricao i WHERE p.cpf = i.cpf AND p.cpf <> 'admin' order by nome asc";

    $participantes = mysql_query($sqlParticipantes);   
        
    echo "<h2> Participantes inscritos: ". mysql_num_rows($participantes). "</h2> <hr>";
    
    //Cabe�alho da tabela
    echo "  
            <table width='100%' border='1' style='TABLE-LAYOUT: fixed'>
                
                <tr style='background-color:#BDE890'>
                         
                    <th style = 'width: 35%'> <center> Nome </center> </th>

                    <th style = 'width: 15%'> <center> CPF </center> </th>

                    <th  style = 'width: 10%' > <center> Campus </center> </th>
                    
                    <th  style = 'width: 40%' > <center> Email </center> </th>
                          
                </tr>
                
            <table>";
    
    while($dadosParticipantes = mysql_fetch_array($participantes))
    {      
        //Troca a cor da linha cada vez que o while � executado
        if($corTR)
        {
            $cor = '#D2D2D2';
        }
        else
        {
            $cor = '#E1E1E1';           
        }
                
        echo"       
             
            <!--  Tabela de participantes com nome, cpf e campus de origem  --!>
            <!DOCTYPE>
                <table width='100%' border='1' cellspacing='1' cellpadding='2' style='TABLE-LAYOUT: fixed'>

                    <tr style='background-color:$cor'>
                                                  
                        <td style = 'width: 35%'> <center>  $dadosParticipantes[nome]  </center> </td>

                        <td style = 'width: 15%'> <center>  $dadosParticipantes[cpf]  </center> </td>

                        <td style = 'width: 10%'> <center>  $dadosParticipantes[campus]  </center> </td>
                              
                        <td style = 'width: 40%'> <center>  $dadosParticipantes[email]  </center> </td>
                              
                    </tr>

                </table>
            </html>
        ";
        
        $corTR = !$corTR;//Troca a cor para a pr�xima linha da tabela
    }
	
    mysql_close($conexao); //Essa linha fecha a conexão com o banco de dados
}
else
{
    echo"<center> <h2> Voc&ecirc; n&atilde;o est&aacute; autorizado a ver este conte&uacute;do </h2> </center>";
}
?>
