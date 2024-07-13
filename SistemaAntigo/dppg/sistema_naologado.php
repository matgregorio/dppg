<?php

include('includes/config2.php');


//mostrar menu de sistemas completo
echo'<div id="titulo">';
echo '<center> Sistemas </center><br>';
echo'</div>';


$sql = "select * from menu_sistemas where codigo_menu!=1";
$resultado = mysql_query($sql);
$linha = mysql_num_rows($resultado);

if ($linha == 0) {
    echo "<br><b>Nenhum subsistema cadastrado!<b><br><br>";
}

echo '<div class="glossymenu">';
while ($campos = mysql_fetch_array($resultado)) {
    echo '<a class="menuitem submenuheader" href="index.php?arquivo=principal_aviso.php">' . $campos[nome_menu] . '</a>';

    $sql1 = "select * from menu_sistemas_subcategoria where codigo_menu='$campos[codigo_menu]' order by codigo_subcategoria asc";
    $resultado1 = mysql_query($sql1);

    echo '<div class="submenu">
		  				<ul>';
    echo '<li><a href="index.php?arquivo=principal_subsistemas1.php&codigo_menu=' . $campos[codigo_menu] . '"><img src="images/seta_menu.gif"> ' . $campos[nome_menu] . '</a></li>';
    while ($campos1 = mysql_fetch_array($resultado1)) {
        echo '<li><a href="index.php?arquivo=' . $campos1[link_subcategoria] . '">' . $campos1[nome_subcategoria] . '</a></li>';
    }

    echo '<li><a href="index.php?arquivo=subsistemas/cursos/form_certificado_iniciacao.php">Certificado Iniciação</a></li>';
    echo '<li><a href="index.php?arquivo=subsistemas/cursos/form_validar_certificado.php">Validar Certificados</a></li>';
    echo '</ul></div>';
}
echo '
   			</div>';



mysql_close($conexao);
?>