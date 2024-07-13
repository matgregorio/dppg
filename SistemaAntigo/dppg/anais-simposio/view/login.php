<?php

session_start();
include_once ('../trataInjection.php');

if(protectorString($_POST[l]) || protectorString($_POST[login]) || protectorString($_POST[senha]))
    return;

if ($_SESSION[anais_logado] == false) {
  if ($_POST[l] == 'l') {
    include 'model/dao/LoginDao.class.php';
    $loginDao = new LoginDao();
    $login = $loginDao->Login($_POST[login], md5($_POST[senha]));
    if ($login == true) {
      ?>
      <section id="content" class="primary" role="main">
        <div id="post-5" class="post-5 page type-page status-publish hentry">
          <div class="entry clearfix"><center><h5>Login efetuado com sucesso.</h5></center></div>
          <meta http-equiv="refresh" content="2; URL=?data=view/inicio" />
        </div>
      </section>
      <?php

    }
  } else {
    ?>
    <section id="content" class="primary" role="main">
      <div id="post-5" class="post-5 page type-page status-publish hentry">
        <h2 class="page-title">Login</h2>
        <div class="entry clearfix">
          <form name="form_logon" method="POST" action="?data=control/login">
            <br>
            <center>
              <table border="" align="center" style='width: 200px; alignment-adjust: central;'>
                <tr>
                  <td><font color="#000"><b><center>Login:</center></b></font></td>
                  <td><input type="text" name="login" placeholder="login" size="11" maxlength="11"></td>
                </tr>
                <tr>
                  <td><font color="#000"><b><center>Senha:</center></b></font></td>
                  <td><input  type="password" name="senha" size="11" placeholder= "***********" maxlength="30"></td>
                </tr>			
                <tr>	  				
                <input type="hidden" name="data" value="view/login">	  			
                </tr>	 			
                <tr>
                  <td colspan="2">
                <center>
                  <br>
                  &nbsp;&nbsp;
                  <input type="hidden" name="l" value="l">
                  <input type="submit" name="logar" value="Login">
                </center>
                <br>
                </td>
                </tr>
              </table>
            </center>
          </form>
        </div>
      </div>
    </section>
    <?php

  }
} else {
  include 'model/dao/LoginDao.class.php';
  $loginDao = new LoginDao();
  $resp = $loginDao->Logout();
  ?>
  <section id="content" class="primary" role="main">
    <div id="post-5" class="post-5 page type-page status-publish hentry">
      <div class="entry clearfix"><center><h5>Logout efetuado com sucesso.</h5></center></div>
      <meta http-equiv="refresh" content="2; URL=?data=view/inicio" />
    </div>
  </section>
  <?php

}
?>