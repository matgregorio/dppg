<?php

include('includes/config2.php');

include('pesquisa_vetor.php');
//se achar 1 usuario é administrador
$vetor_adm = pesquisa_vetor($_SESSION['grupos_usuarios'], array('1'));

//se achar 2 usuario é sub administrador
$vetor_sub_adm = pesquisa_vetor($_SESSION['grupos_usuarios'], array('2'));


if ($_SESSION[menu_sistema] == FALSE) {

    //selecionar todos sub-sistemas para o administrador

    if ($vetor_adm) {
        echo'<div id="link2">';
        echo '
							
							<table align=center id="tabela">
							<tr>
								<td><a href="index.php?arquivo=adm_geral.php"><img src="images/adm_site.png"></a></td>
								<td><a href="index.php?arquivo=adm_geral.php">Configurações do Site</a></td>
							</tr>
							</table>						
							';

        echo '
							<table align=center id="tabela">
							<tr>
									<td colspan=2 height=20><a href="index.php?arquivo=form_alterar_perfil.php">Alterar Perfil</a></td>	
							</tr>
							</table>						
							</a>';
        echo'</div>';

        //mostrar menu de sistemas
        echo'<div id="titulo">';
        echo '<center>Sistemas</center><br>';
        echo'</div>';

        //selecionar todos os subsistemas					
        $sql = " select * from menu_sistemas order by codigo_menu asc";
        $linha = mysql_num_rows($sql);
    }

    //selecionar de acordo com os sub adms dos sistemas				
    elseif ($vetor_sub_adm) {
        echo'<div id="link2">';

        echo '
							<table align=center id="tabela">
							<tr>
									<td colspan=2 height=20><a href="index.php?arquivo=form_alterar_perfil.php">Alterar Perfil</a></td>	
							</tr>
							</table>						
							</a>';
        echo'</div>';

        //mostrar menu de sistemas
        echo'<div id="titulo">';
        echo '<center>Sistemas</center><br>';
        echo'</div>';

        $sql = "select distinct codigo_menu,nome_menu from menu_sistemas ms, participa_grupos pg where ms.codigo_menu=pg.codigo_sistema and pg.cpf=$_SESSION[cpf] or ms.codigo_menu=1 order by codigo_menu asc";
    }
    //seleciona demais subsistemas
    else {
        echo'<div id="link2">';
        echo '
									<a href="index.php?arquivo=form_alterar_perfil.php">
									<table align=center id="tabela">
									<tr>
											<td colspan=2 height=20>Alterar Perfil</td>
											
									</tr>
									</table>						
									</a>';
        echo'</div>';

        //mostrar menu de sistemas
        echo'<div id="titulo">';
        echo '<center>Sistemas</center><br>';
        echo'</div>';

        $sql = "select distinct codigo_menu,nome_menu from menu_sistemas ms, participa_grupos pg where ms.codigo_menu=pg.codigo_sistema and pg.cpf=$_SESSION[cpf] order by codigo_menu asc";
    }


    //resultado recebo camando de consulta acima
    $resultado = mysql_query($sql);

    //testar se ouve resultado
    $teste = mysql_num_rows($resultado);
    if ($teste == 0) {
        echo '<br><center><font color=#006400><b>Usuário sem permissão para acesso aos subsistemas disponíveis</b></font></center><br>';
    }
    echo ' 
				<div class="glossymenu">
					';
    while ($campos = mysql_fetch_array($resultado)) {
        echo '<a class="menuitem submenuheader" href="index.php?arquivo=principal_aviso.php">' . $campos[nome_menu] . '</a>';

        $sql1 = "select * from menu_sistemas_subcategoria where codigo_menu='$campos[codigo_menu]' order by codigo_subcategoria asc";
        $resultado1 = mysql_query($sql1);

        echo '<div class="submenu">
		  				<ul>';
        echo '<li><a href="index.php?arquivo=menu_sistemas.php&codigo_menu=' . $campos[codigo_menu] . '"><img src="images/seta_menu.gif"> ' . $campos[nome_menu] . '</a></li>';
        while ($campos1 = mysql_fetch_array($resultado1)) {
            echo '<li><a href="index.php?arquivo=' . $campos1[link_subcategoria] . '">' . $campos1[nome_subcategoria] . '</a></li>';
        }
        echo '<li><a href="index.php?arquivo=subsistemas/cursos/form_validar_certificado.php">Validar Certificados</a></li>';
        echo '</ul></div>';
    }
    echo '
   			</div>';
}
//se algum subsistema estiver logado
else {
    //menu configuração apenas para adm
    if ($vetor_adm) {
        echo'<div id="link2">';
        echo '
							
							<table align=center id="tabela">
							<tr>
								<td><a href="index.php?arquivo=adm_geral.php"><img src="images/adm_site.png"></a></td>
								<td><a href="index.php?arquivo=adm_geral.php">Configurações do Site</a></td>
							</tr>
							</table>						
							';

        echo '
							<table align=center id="tabela">
							<tr>
									<td colspan=2 height=20><a href="index.php?arquivo=form_alterar_perfil.php">Alterar Perfil</a></td>	
							</tr>
							</table>						
							</a>';
        echo'</div>';
    } else {
        //mostrar perfil para todos usuarios logados
        echo'<div id="link2">';
        echo '
							<table align=center id="tabela">
							<tr>
									<td colspan=2 height=20><a href="index.php?arquivo=form_alterar_perfil.php">Alterar Perfil</a></td>	
							</tr>
							</table>						
							</a>';
        echo'</div>';
    }
    //mostrar menu de sistemas 
    echo'<div id="titulo">';
    echo '<center>Sistemas</center><br>';
    echo'</div>';

    //mostrar menu de sistemas apenas o logado				
    $sql = " select * from menu_sistemas where codigo_menu=$_SESSION[codigo_menu] order by codigo_menu asc";
    $resultado = mysql_query($sql);

    echo ' 
				<div class="glossymenu">
					';
    while ($campos = mysql_fetch_array($resultado)) {
        echo '<a class="menuitem submenuheader" href="index.php?arquivo=principal_aviso.php">' . $campos[nome_menu] . '</a>';

        $sql1 = "select * from menu_sistemas_subcategoria where codigo_menu='$campos[codigo_menu]' order by codigo_subcategoria asc";
        $resultado1 = mysql_query($sql1);

        echo '<div class="submenu">
		  				<ul>';
        echo '<li><a href="index.php?arquivo=menu_sistemas.php&codigo_menu=' . $campos[codigo_menu] . '"><img src="images/seta_menu.gif"> ' . $campos[nome_menu] . '</a></li>';
        while ($campos1 = mysql_fetch_array($resultado1)) {
            echo '<li><a href="index.php?arquivo=' . $campos1[link_subcategoria] . '">' . $campos1[nome_subcategoria] . '</a></li>';
        }

        echo '<li><a href="index.php?arquivo=subsistemas/cursos/form_certificado_iniciacao.php">Certificado Iniciação</a></li>';
        echo '<li><a href="index.php?arquivo=subsistemas/cursos/form_validar_certificado.php">Validar Certificados</a></li>';

        echo '</ul></div>';
    }
    echo '
   			</div>';
}
mysql_close($conexao);
?>
