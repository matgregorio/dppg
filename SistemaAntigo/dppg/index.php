<?php
error_reporting(E_ALL);
ini_set('display_errors', 'OFF');
session_start();
header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html>
<head>

  <?php
  include("includes/config2.php");

  $sql = mysql_query("select titulo_janela from site");
  $reg = mysql_fetch_array($sql);


  echo "<title> $reg[titulo_janela] </title>"; ?>

  <link rel="stylesheet" type="text/css" href="css/style.css">

  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

  <meta name="keywords" content="" />
  <meta name="description" content="" />

  <link href="style.css" rel="stylesheet" type="text/css" media="screen" />

 <link rel="shortcut icon" href="images/icon.ico" type="image/x-icon"/>
 <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>

  <script type="text/javascript">


    ddaccordion.init({
      headerclass: "submenuheader", //Shared CSS class name of headers group
      contentclass: "submenu", //Shared CSS class name of contents group
      revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
      mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
      collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
      defaultexpanded: [index1], //index of content(s) open by default [index1, index2, etc] [] denotes no content
      onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
      animatedefault: false, //Should contents open by default be animated into view?
      persiststate: true, //persist state of opened contents within browser session?
      toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
      togglehtml: ["suffix", "<img src='images/menu/plus.gif' class='statusicon' />", "<img src='images/menu/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
      animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
      oninit: function(headers, expandedindices) { //custom code to run when headers have initalized
        //do nothing
      },
      onopenclose: function(header, index, state, isuseractivated) { //custom code to run whenever a header is opened or closed
        //do nothing
      }
    })


  </script>
  <style type="text/css">

    .glossymenu{
      position: relative;
      margin: 3px 0;
      margin-left: 1.5%; 
      padding: 0;
      width: 177px; /*width of menu*/
      border: 1px solid #9A9A9A;
      border-bottom: 0px solid #9A9A9A;
      border-left: 1px solid #9A9A9A;
    }

    .glossymenu a.menuitem{  /*Itens do menu*/
      background: url(../images/menu/glossyback.gif) repeat-x bottom left #E8E8E8;
      font: bold 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
      color: #000;
      display: block;
      position: relative; /*To help in the anchoring of the ".statusicon" icon image*/
      width: auto;
      height: 25px;
      text-decoration: none;
      padding-top: 5px;
      border-bottom: 1px solid #9A9A9A;
    }


    .glossymenu a.menuitem:visited, .glossymenu .menuitem:active{
      color: #000;
    }

    .glossymenu a.menuitem .statusicon{ /*CSS for icon image that gets dynamically added to headers*/
      position: absolute;
      top: 5px;
      right: 2px;
      border: none;
    }

    .glossymenu a.menuitem:hover{
      background-image: url(../images/menu/glossyback2.gif);
    }

    .glossymenu div.submenu{ /*DIV that contains each sub menu*/
      background: white;
      text-align: left;
    }

    .glossymenu div.submenu ul{ /*UL of each sub menu*/
      list-style-type: none;
      margin: 0;
      padding: 0;
    }

    .glossymenu div.submenu ul li{
      border-bottom: 1px solid #9A9A9A;
    }

    .glossymenu div.submenu ul li a{
      display: block;
      font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
      color: black;
      text-decoration: none;
      /*posicao submenu*/
      padding-top: 3px;
      padding-left: 15px;
      padding-bottom: 3px;

    }

    .glossymenu div.submenu ul li a:hover{ /*sub menu ativado*/
      background: #E8E8E8;
      color: #000;
    }

  </style>

  <script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
  <script language="javascript" type="text/javascript">
    tinyMCE.init({
      // General options
      mode: "textareas",
      theme: "advanced",
      plugins: "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
      // Theme options
      theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
      theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
      theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
      theme_advanced_toolbar_location: "top",
      theme_advanced_toolbar_align: "left",
      //theme_advanced_statusbar_location : "bottom",
      theme_advanced_resizing: true,
      // Example content CSS (should be your site CSS)
      content_css: "css/content.css",
      // Drop lists for link/image/media/template dialogs
      template_external_list_url: "lists/template_list.js",
      external_link_list_url: "lists/link_list.js",
      external_image_list_url: "lists/image_list.js",
      media_external_list_url: "lists/media_list.js",
      // Style formats
      style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
      ],
      // Replace values for the template plugin
      template_replace_values: {
        username: "Some User",
        staffid: "991234"
      }
    });
  </script>


</head>
<!--<body OnLoad="popup();"></body>-->

<body   OnLoad="horizontal();">
  <div id="fundo" class="shadow">	

    <div id="topo">  <!-- Div topo -->
<?php include 'topo.php'; ?> 
    </div>

    <div id="menu_horizontal">  	
      <?php include 'menu_horizontal.php'; ?> <!-- Menu horizontal -->
    </div>

<?php include 'menu_esquerdo.php'; ?>  <!-- Div menu Vertical Esquerdo -->
      <?php include 'menu_direito.php'; ?>  <!-- Div menu Vertical Direito -->
      <?php include 'conteudo.php'; ?> <!-- Div Conteudo -->

    <div id="rodape">
    <?php include 'rodape.php'; ?>	<!-- Div Rodapé -->
    </div>
  </div>
</body>

</html>
