<?php
session_start();
include_once ('trataInjection.php');

if(protectorString($_POST[data]) || protectorString($_GET[data]))
    exit();

//error_reporting(E_ERROR | E_WARNING | E_PARSE);
if (isset($_POST[data]))
    $data = $_POST["data"];
else
    $data = $_GET["data"]; /* view/edicaoAtual */

if (!$data)
    $data = "view/inicio";

if (file_exists($data . ".php"))
  $url = "$data.php";

?>
<html lang="pt-BR">
  <head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="jScript//bootstrap.js"></script>
    <script type="text/javascript" src="jScript//bootstrap.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--//**************************************************************************-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon/icone.ico" type="image/x-icon"/>
    <meta scheme="ISSN" name=" ISSN 2447-3375" content="ISSN 2447-3375">

    <title>Anais do Simpósio de Ciência, Inovação & Tecnologia - ISSN 2447-3375</title>

    <link rel="stylesheet" id="contact-form-7-css" href="css/styles.css" type="text/css" media="all">
    <link rel="stylesheet" id="themezee_zeeDynamic_stylesheet-css" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" id="themezee_default_font-css" href="css/css.css" type="text/css" media="all">
    <link rel="stylesheet" id="themezee_default_title_font-css" href="css/css(1).css" type="text/css" media="all">
    <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
      tinymce.init({
        selector: "textarea",
        theme: "modern",
        plugins: [
          "advlist autolink lists charmap hr",
          "searchreplace wordcount fullscreen",
          "save table contextmenu directionality paste textcolor"
        ],
        toolbar1: "undo redo | bold italic underline strikethrough superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
        toolbar2: "forecolor backcolor | fontselect fontsizeselect",
        image_advtab: true,
        templates: [
          {title: 'Test template 1', content: 'Test 1'},
          {title: 'Test template 2', content: 'Test 2'}
        ]
      });
    </script>

  </head>
  <body class="home page page-id-5 page-template-default custom-background">
    <div id="wrapper" class="hfeed">
        <nav class="navbar navbar-default">
      <!--<div id="custom-header" class="container">-->
        <img style="width: 100%" src="images/topo/novo_banner1.png">
      <!--</div>-->
      <div id="header-wrap">
      </div>
      <!--<div id="navi-wrap" class="container clearfix">-->
        <!--menu horizontal-->
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="?data=view/inicio">INÍCIO</a></li>
                <li><a href="?data=view/apresentacao">APRESENTAÇÃO</a></li>
                <li><a href="?data=view/corpoEditorial">CORPO EDITORIAL</a></li>
                <li><a href="?data=view/expediente">EXPEDIENTE</a></li>
                <li><a href="?data=view/normas">NORMAS PARA PUBLICAÇÃO</a></li>
                <li class="dropdown">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">EDIÇÕES <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="?data=view/edicaoAtual">ATUAL</a></li>
                    <li><a href="?data=view/edicaoAnterior">ANTERIORES</a></li>
                  </ul>
                </li>
                <?php
                if ($_SESSION[anais_logado] == true) {
                  ?>
                  <li>
                    <a href="?data=view/login">LOGOUT</a>
                  </li>
                <?php } else { ?>
                  <li>
                    <a href="?data=view/login">LOGIN</a>
                  </li>
                <?php } ?>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="jScript//bootstrap.min.js"></script>
        <!--        <div class="main clearfix">
                <div id="dl-menu" class="dl-menuwrapper">
                  <button id="dl-menu" class="dl-trigger">Open Menu</button>
                  <ul class="dl-menu">
                    <li>
                      <a href="?data=view/inicio">INÍCIO</a>
                    </li>
                    <li>
                      <a href="?data=view/apresentacao">APRESENTÇÃO</a>
                    </li>
                    <li>
                      <a href="?data=view/corpoEditorial">CORPO EDITORIAL</a>
                    </li>
                    <li>
                      <a href="?data=view/expediente">EXPEDIENTE</a>
                    </li>
                    <li>
                      <a href="?data=view/normas">NORMAS PARA PUBLICAÇÃO</a>
                    </li>
                    <li>
                      <a href="#">EDIÇÕES</a>
                      <ul class="dl-submenu">
                        <li>
                          <a href="?data=view/edicaoAtual">ATUAL</a>
                        </li>
                        <li><a href="?data=view/edicaoAnterior">ANTERIORES</a></li>
                      </ul>
                    </li>
        <?php
        if ($_SESSION[anais_logado] == true) {
          ?>
                          <li id="menu-item-102" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item page_item page-item-5 current_page_item menu-item-105">
                            <a href="?data=view/login">Logout</a>
                          </li>
        <?php } else { ?>
                          <li id="menu-item-102" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item page_item page-item-5 current_page_item menu-item-105">
                            <a href="?data=view/login">Login</a>
                          </li>
        <?php } ?>
                  </ul>
                </div> /dl-menuwrapper 
                </div> /container 
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                <script src="jScript/js/jquery.dlmenu.js"></script>
                <script>
              $(function() {
                $('#dl-menu').dlmenu();
              });
                </script>-->
      <!--</div>-->
      <!--      <div id="navi-wrap">
              <h3 id="mainnav-icon">Menu</h3>
              <nav id="mainnav" class="container clearfix" role="navigation">
                <ul id="mainnav-menu" class="menu">
                  <li id="menu-item-105" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-5 current_page_item menu-item-105">
                    <a href="?data=view/inicio">Início</a>
                  </li>
                  <li id="menu-item-105" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-5 current_page_item menu-item-105">
                    <a href="?data=view/apresentacao">Apresentação</a>
                  </li>
                  <li id="menu-item-103" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-5 current_page_item menu-item-105">
                    <a href="?data=view/corpoEditorial">Corpo Editorial</a>
                  </li>
                  <li id="menu-item-104" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-5 current_page_item menu-item-105">
                    <a href="?data=view/expediente">Expediente</a>
                  </li>
                  <li id="menu-item-101" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-5 current_page_item menu-item-105">
                    <a href="?data=view/normas">Normas para Publicação</a>
                  </li>
                  <li id="menu-item-153" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item page_item page-item-5 current_page_item menu-item-105">
                    <a href="?data=view/edicaoAtual">Edição Atual</a>
                  </li>
                  <li id="menu-item-153" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item page_item page-item-5 current_page_item menu-item-105">
                    <a href="?data=view/edicaoAnterior">Edições Anteriores</a>
                  </li>
      <?php
      if ($_SESSION[anais_logado] == true) {
        ?>
                                            <li id="menu-item-102" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item page_item page-item-5 current_page_item menu-item-105">
                                                <a href="?data=view/login">Logout</a>
                                              </li>
      <?php } else { ?>
                                              <li id="menu-item-102" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item page_item page-item-5 current_page_item menu-item-105">
                                                <a href="?data=view/login">Login</a>
                                              </li>
      <?php } ?>
                </ul>		
              </nav>
            </div>-->
      <div id="wrap" class="container">
        <?php
        include $url;
        ?>
      </div>
      <div>
        <section id="sidebar" class="secondary clearfix" role="complementary">
          <aside class="widget">
            <h3 class="widgettitle">Widget Area</h3>
            <p></p>
          </aside>
        </section>
      </div>
      <div id="footer-wrap">
        <footer id="footer" class="container clearfix" role="contentinfo">
          Organização: Diretoria de Pesquisa e Pós-Graduação (DPPG) - Instituto Federal de Educação, Ciência & Tecnologia - Sudeste de Minas Gerais (Campus Rio Pomba).<br>
          E-mail: <a href="mailto:dppg.riopomba@ifsudestemg.edu.br">dppg.riopomba@ifsudestemg.edu.br</a>
        </footer>
      </div>
    </div><!-- end #wrapper -->
  </body>
</html>