<?php

	session_start();

	if (in_array("1", $_SESSION[codigo_grupo]))
	{
			include("includes/config2.php");
			echo"
                    <html>
                        <head>
                            <title> Alterar Fluxograma</title>
                            <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\">
                            <script type=\"text/JavaScript\" src=\"js/valida_form_topo.js\"></script>                    
                        </head>                        
                        <div id='conteudo3'>
                        <br>
				        <center><b>Alterar Fluxograma<b><br><br><br></center>
                            <center>
                                <form name='form_altera_arquivo' method='POST'  action='alterar_fluxograma.php'  enctype='multipart/form-data'>
                                    <table border='0' class='esquerda'>				
                                        <tr>
                                            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\" />
                                            <td>Arquivo: </td>
                                            <td><input type='file' name='arquivo'> <br><br></td>	
                                        </tr>                                       				
                                        <tr>
                                            <td colspan='2' align='center'><input type='submit' value='OK'></td>
                                            <input type='hidden' name='codigo' value='" . $codigo . "'>
                                            <input type='hidden' name='confirma' value='S'>				
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



