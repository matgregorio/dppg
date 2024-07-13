<?php

if (in_array("1", $_SESSION[codigo_grupo])) {
    include('includes/config.php');

    $sql = "select trabalhos.codigo_trab, trabalhos.titulo, trabalhos.autor1, trabalhos.autor2, trabalhos.autor3, trabalhos.autor4, trabalhos.autor5, trabalhos.autor6, trabalhos.autor7, trabalhos.arquivo, sub_area.nome_sa, modalidade.nome_modalidade from sub_area join (trabalhos join modalidade on trabalhos.cod_modalidade=modalidade.cod_modalidade) on trabalhos.codigo_sa=sub_area.codigo_sa where aprovado='0' order by nome_sa, codigo_trab";
//faltou o atributo local e título tabela sub eventos

    $resultado = mysql_query($sql);
    echo "<br><br><center><b>Listagem dos trabalhos reprovados<br>";
    if (mysql_num_rows($resultado) > 0) {

        $controle = 0;
        echo '<center>';
        $cor = "#95e197";

        while ($campos = mysql_fetch_array($resultado)) {
            if ($controle == 0) {
                echo '
                Total de trabalhos aprovados:' . mysql_num_rows($resultado) . '
		</b></center><br>
		<table>
                    <tr bgcolor=#61C02D>
                        <td ><font color="FFFFFF"><center><b><i>Código</i></b></center></font></td>
                        <td><font color="FFFFFF"><center><b><i>Subárea</i></b></center></font></td>
                        <td ><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Autores</i></b></center></font></td>
			<td><font color="FFFFFF"><center><b><i>Modalidade</i></b></center></font></td>
                    </tr>';
            }
            $controle = 1;
            echo "<tr bgcolor='$cor'>
            <td>$campos[codigo_trab]</td>
            <td>$campos[nome_sa]</td>
            <td width='10'><a href='trabalhos/$campos[arquivo]'>$campos[titulo]</a></td>
            <td>
              - $campos[autor1]<br>
              - $campos[autor2]<br>
              - $campos[autor3]<br>
              - $campos[autor4]<br>
              - $campos[autor5]<br>
              - $campos[autor6]<br>
              - $campos[autor7]
            </td>
            <td>$campos[nome_modalidade]</td>
          </tr>";

            if ($cor == "#78e07b") {
                $cor = "#95e197";
            } else {
                $cor = "#78e07b";
            }
        }
        echo '</table>';
        echo '</center><br>';
    } else {

        echo "<center><i>Não há trabalhos reprovados.</i></center><br><br>";
    }
}
mysql_close($conexao);
?>