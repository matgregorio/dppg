<?php
session_start();

if (in_array("3", $_SESSION[codigo_grupo])) {
    include('includes/config.php');

    echo '<br>
 		<center><b>Trabalhos Submetidos</b></center>
 		<br>';

    $sql = "select * from trabalhos t, sub_area s where t.codigo_sa = s.codigo_sa and s.cpf_representante = '$_SESSION[cpf]' and
	cpf_prof_analisador='0'";

    $resultado = mysql_query($sql);

    //$controle = 0;

    echo '<center>';

    $cor = "#95e197";
    $cont = 0;

    $campos1 = mysql_fetch_array($resultado);

    //Retorna para  0 o ponteiro para linha do select
    mysql_data_seek($resultado, 0);

    if (mysql_num_rows($resultado) >= 1) {
        echo '<center><i>Subárea&nbsp;&nbsp;<img src="images/go-next.png"  width="2%" border="0"> ' . $campos1[nome_sa] . '</i></center>
				<br>					
				<table border ="0" class="esquerda">
				<tr bgcolor=#61C02D >
				<td><font color="FFFFFF"><center><b><i>&nbsp;Título&nbsp;</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>&nbsp;Autor&nbsp;</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>&nbsp;Avaliadores&nbsp;</i></b></center></font></td>			
				</tr>';

        while ($campos = mysql_fetch_array($resultado)) {
            //Fazer um javascript para mostrar se o usuário não for selecionado
            echo '<form name="form_trabalhos' . $cont . '" method="POST" action="simposio.php">	';

            echo '<tr bgcolor="' . $cor . '">
					<input type="hidden" name="codigo" value="' . $campos[codigo_trab] . '">
					<td>';

            echo "<a  class=\"link\" href=\"javascript:void(0)\" onClick=\"MM_openBrWindow('resumo.php?codigo=" . $campos[codigo_trab] . "','',
			'scrollbars=no, width=850, height=600, left=0, top=0')\">&nbsp;&nbsp;" . $campos[titulo] . "</a>
			<input type='hidden' name='titulo' value='" . $campos[titulo] . "' >&nbsp;&nbsp;</td>";

            echo '</td>
					<td><input type="hidden" name="autor1" value="' . $campos[autor1] . '">' . $campos[autor1] . '</td>
					<td>';
            include('prof_depto.php');
            echo '</td>
					
			 		<input type="hidden" name="arquivo2" value="enviar_trabalho.php">	
					<td>				
					<input type="submit" value="Enviar"></td>
					</tr>';

            if ($cor == "#78e07b")
                $cor = "#95e197";
            else
                $cor = "#78e07b";

            echo '</form>';
            $cont++;
        }
        echo '</table><br>';
        echo '<font color="#FF0000">OBS:</font><i> Click no título do trabalho para ver o resumo.</i>';
    } else
        echo '<center><i>Nenhum trabalho submetido!!!</i></center><br>';

    $sql_arquivo = "select * from formularios f, arquivo a where f.codigo_formulario = a.codigo_formulario and
		a.codigo_formulario = '2'";
    $resultado_arquivo = mysql_query($sql_arquivo);

    $campos_arquivo = mysql_fetch_array($resultado_arquivo);

    echo '<center>
			<br>	
			&nbsp;<a href="documentos/' . $campos_arquivo[caminho_arquivo] . '" target="_blank"><img src="images/' . $campos_arquivo[icone] . '" border="0">&nbsp;' . $campos_arquivo[nome_arquivo] . '</a>
			<br><br>
			</center>';

    mysql_close($conexao);
}
?>