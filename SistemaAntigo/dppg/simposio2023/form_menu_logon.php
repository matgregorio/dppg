<?php
	session_start();
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
    <head>
        <title>Exemplo Menu</title>
			
			<meta name="content-type" content="text/html; charset=UTF-8"/>
						
				
			 <!-- FIM Script login menu horizontal --> 
			 
			 <!-- Script menu horizontal -->  
          <script src="js/jquery_menu_horizontal.js" type="text/javascript"></script>
		
		    <script>
            $(function(){
                $("a:first", ".menuv li.submenu", ".menuh li.submenu").addClass("seta");
                
                $(".menuv li.submenu, .menuh li.subv").each(function(){
                    var el = $('#' + $(this).attr('id') + ' ul:eq(0)');
                    
                    $(this).hover(function(){
                        el.show();
                    }, function(){
                        el.hide();
                    });
                });
            });
        </script>
        <!-- FIM Script login menu horizontal --> 
	</head>
<body>	
<?php
		
		//formulario de login
		if ($_SESSION[logado_site_dppg]){
		echo' 
			<a href="index.php?arquivo=logout.php"><span>Sair</span></a>';				
		}
 		else {
 				echo "<script src='valida_forms/validar_logon.js'></script>";
 				echo '<link rel="stylesheet" type="text/css" href="css/style.css">';	
				echo' <a href="" class="signin"><span>Login</span></a>

				<fieldset id="signin_menu">
					<form name="form_login" method="post" action="index.php" onsubmit="javascript: return checklogin()" enctype="multipart/form-data" id="signin">
		 				<p>
								<label for="username">Login</label>
								<input id="username" name="cpf" value="" title="Informe o CPF" tabindex="4" type="text" size="21">
			      	</p>
						<p>
		  						<label for="password">Senha</label>
		  						<input id="password" name="senha" value="" title="Informe a senha" tabindex="5" type="password" size="21">
						</p>
						<p>
								<table>
								<tr>
										<td>
		     									<label for="valor">Valor</label>
		     									<input id="valor" name="valor" value="" title="Valor da imagem " tabindex="5" type="text" size="4">
		     							</td>
		     							<td>		
		   									<div id="borda"> 
		  											<img src="captcha.php">
		  										</div>
		  								</td>
		  						</tr>
		  						</table>			
		  				</p>	
						<p class="remember">
		  						<input id="signin_submit" value="Entrar" tabindex="6" type="submit">
		  						<input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">
		  						<label for="remember">Lembrar-me</label>
						</p>
								<input type="hidden" name="arquivo" value="logon.php">
	 				</form>
	  				</fieldset>';

 				}
?> 	
	
    </body>
</html>				