
//carrega o resultado do combo nivel, do formulario de permissões de usuario 

<?php
session_start();
include("includes/config2.php");
include("subsistemas/usuario/pesquisa_vetor3.php");
include_once ('trataInjection.php');

if (protectorString($_GET[codigo_grupo]))
    return;

$codigo_nivel = mysql_real_escape_string($_GET[codigo_grupo]);
$pesquisa_adm = pesquisa_vetor3($_SESSION['grupos_usuarios'], array('1')); //usuario administrador
$pesquisa_subadm = pesquisa_vetor3($_SESSION['grupos_usuarios'], array('2')); //usuario subadministrador

$cpf_logado = $_SESSION['cpf'];

//ADM
if ($pesquisa_adm) {
  //listar subsistemas sem subadministradores
  if ($codigo_nivel == 2) {
    $sqlTres = mysql_query("select * from menu_sistemas where nome_menu not in (select distinct nome_menu from menu_sistemas s, participa_grupos p where s.codigo_menu=p.codigo_sistema and codigo_grupo='2' and cpf!='$cpf_logado') and codigo_menu>1");
  } else {
    $sqlTres = mysql_query("select distinct nome_menu, codigo_menu from menu_sistemas where codigo_menu>1");
  }
}
//SUB ADM
elseif ($pesquisa_subadm) {
  $sqlTres = mysql_query("select distinct nome_menu from menu_sistemas s, participa_grupos p where s.codigo_menu=p.codigo_sistema and cpf='$_SESSION[cpf]' and codigo_grupo='2'");
}

echo '<option selected value="0">Selecione uma opção</option>';
while ($camposTres = mysql_fetch_array($sqlTres)) {
  echo "<option value='" . $camposTres['codigo_menu'] . "'>" . $camposTres['nome_menu'] . "</option>";
}
?>   
