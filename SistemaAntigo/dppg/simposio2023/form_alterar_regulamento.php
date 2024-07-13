<?php

session_start();

if (in_array("1", $_SESSION[codigo_grupo]))
{
    include("includes/config2.php");
    echo"
                    <html>
                        <head>
                            <title> Alterar Regulamento</title>
                            <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\">    
                            <!--[if IE]><link rel=\"shortcut icon\" href=\"img/favicon.ico\"><![endif]-->  
                            <link rel=\"icon\" href=\"img/favicon.ico\">                                         
                        </head>                        
                        <div id='conteudo3'>
                        <br>
				        <center><b>Alterar Regulamento<b><br><br><br></center>
                            <center>
                                <form name='form_altera_regulamento' method='POST'  action='alterar_regulamento.php'  enctype='multipart/form-data'>
                                    <table border='0' class='esquerda'>	
                                        <tr>      
                                            <td>Nome do arquivo: </td>
                                            <td><input type='text' name='nome_exibicao' size='50px'> <br><br></td>	
                                        </tr>   			
                                        <tr>
                                            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\" />
                                            <td>Arquivo: </td>
                                            <td><input type='file' name='arquivo'> <br><br></td>	
                                        </tr>                                       				
                                        <tr>
                                            <td colspan='2' align='center'><input type='submit' value='Confirmar'></td>                                                                                        				
                                        </tr>
                                    </table>
                                </form>
                               </center>
                               <br>
                               <br>
                        </div>
                    </html>";

}
else
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Apenas administradores logados podem acessar esta página</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
}



