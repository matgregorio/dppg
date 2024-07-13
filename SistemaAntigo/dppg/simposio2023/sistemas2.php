<?php

session_start();

include('includes/config.php');

if ($_SESSION[logado_simposio_2021])
{
    $sql1 = "select * from grupo_pro where cpf='$_SESSION[cpf]'";
    $resultado1 = mysql_query($sql1);

    while ($campos1 = mysql_fetch_array($resultado1))
    {
        $codigo_grupo[] = $campos1[codigo_grupo];
        $_SESSION[codigo_grupo] = $codigo_grupo;
    }

    //echo '<br>&nbsp;&nbsp;Simpósio<hr align="center" width="195"/><br>';
    echo '<br><b><center>SIMPÓSIO</center></b><br>';

    echo '<table border="0" cellspacing="4" cellpadding="3" align="center">';

    $sql = "SELECT * FROM grupo_link gl, grupo g, link_menu l WHERE g.codigo_grupo = gl.codigo_grupo AND gl.codigo_link = l.codigo_link AND (gl.codigo_grupo >= '5' AND gl.codigo_grupo <= '6') AND (l.codigo_link <> '4' AND l.codigo_link <> '28') ORDER BY gl.ordem";
    $resultado = mysql_query($sql);

    while ($campos = mysql_fetch_array($resultado)) {
        if (($campos[codigo_link] == 18) || ($campos[codigo_link] == 24) || ($campos[codigo_link] == 29))
        {
            if ($campos[codigo_link] == 29)
            {
                $sql_trabalho = "select * from trabalhos where cpf='$_SESSION[cpf]' and aprovado='1' and presenca='S'";
                $resultado_trabalho = mysql_query($sql_trabalho);

                if (mysql_num_rows($resultado_trabalho) > 0)
                {
                    echo '<tr>
                  <td>
                    <img heigth=32 width=32 src="images/' . $campos[icone] . '" border="0">
                  </td>
		<td>
                &nbsp;&nbsp;<a target="_blank" href=' . $campos[caminho] . '>' . $campos[nome_link]  . '</a>';
                }
            }
            else /*Certificado e comprovante de inscrição*/
            {
                echo '<tr>
                <td>
                  <img heigth=32 width=32 src="images/' . $campos[icone] . '" border="0">
		      </td>
              <td>
              <a target="_blank" href=' . $campos[caminho] . '>' . $campos[nome_link] . '</a>';
            }
            echo '</td></tr>';
        }
        else /*Todos os links (Menos certificado e comprovante de inscrição)*/
        {
            if ($campos[codigo_link] == 58) //Monta um link só para os sistema Anais
            {
                echo"
                    <tr>
                      <td>
                        <img heigth=32 width=32 src='images/$campos[icone]' border=0'>
                      </td>
                      <td> &nbsp;&nbsp;<a target='_blank' href='https://dppg.riopomba.ifsudestemg.edu.br/anais-simposio/'>  Anais  </a>
                 ";
            }
            elseif($campos[codigo_link] == 59) //Monta um link só para o DPPG
            {
                echo"
                    <tr>
                      <td>
                        <img heigth=32 width=32 src='images/dppg.png' border=0'>
                      </td>
                      <td> &nbsp;&nbsp;<a target='_blank' href='https://dppg.riopomba.ifsudestemg.edu.br/index.php?arquivo=listar_noticias.php'>  DPPG  </a>
                 ";
            }
            else //Monta os demais links
            {
                echo
                    '<tr>
                  <td>
		                <img heigth=32 width=32 src="images/' . $campos[icone] . '" border="0">
                  </td>
                   <td>
		                <a href=simposio.php?arquivo2=' . $campos[caminho] . '>' . $campos[nome_link] . '</a>
                   </td>
              </tr>';
            }
        }
    }

    echo "<tr><td colspan='2'> <table width='100%'>
        <tr align='center' bgcolor='#F0F0F0'><td></td></tr>
    </table></td></tr>";
    $flag = 0;
    
    foreach ($codigo_grupo as $codigo)
    {
        if ($flag == 0)
        {
            $campobanco = "gl.codigo_grupo='$codigo'";
            $flag++;
        }
        else
            $campobanco = "$campobanco OR gl.codigo_grupo='$codigo'";
    }

    $sql1 = "SELECT * FROM grupo_link gl, grupo g, link_menu l WHERE g.codigo_grupo = gl.codigo_grupo AND gl.codigo_link = l.codigo_link AND ($campobanco) GROUP BY gl.codigo_link ORDER BY l.nome_link, l.codigo_link";
    $resultado1 = mysql_query($sql1);
    while ($campos1 = mysql_fetch_array($resultado1)) {
        if ($campos1[codigo_link] == 50) {
            echo '<tr>
          <td>
            <img heigth=32 width=32 src="images/' . $campos1[icone] . '" border="0">
          </td>
          <td>
            &nbsp;&nbsp;<a target="_blank" href=' . $campos1[caminho] . '>' . $campos1[nome_link] . '</a>
          </td>
 	</tr>';
        } else {
            echo '<tr>
              <td>
		<img heigth=32 width=32 src="images/' . $campos1[icone] . '" border="0">
              </td>
              <td >
                <a href=simposio.php?arquivo2=' . $campos1[caminho] . '>' . $campos1[nome_link] . '</a>
              </td>
            </tr>';
        }
    }

    echo "<tr><td colspan='2'> <table width='100%'>
        <tr align='center' bgcolor='#F0F0F0'><td></td></tr>
    </table></td></tr>";

    $sql2 = "select * from grupo_link gl, grupo g, link_menu l where g.codigo_grupo = gl.codigo_grupo and
gl.codigo_link = l.codigo_link and gl.codigo_grupo = '5' and l.codigo_link = '28' ORDER BY l.nome_link";
    $resultado2 = mysql_query($sql2);
    $campos2 = mysql_fetch_array($resultado2);

    echo '<tr>
          <td>
            <img heigth=32 width=32 src="images/' . $campos2[icone] . '" border="0">
          </td>
          <td>
            &nbsp;&nbsp;<a href=simposio.php?arquivo2=' . $campos2[caminho] . '>' . $campos2[nome_link] . '</a>
          </td>
 	</tr>';

    echo '</table>';
} else {
    echo '<br><b><center>ACESSO</center></b><br>';

    $sql_banner = "select informacoes, link from conteudo where codigo_conteudo ='4'";
    $resultado_banner = mysql_query($sql_banner);
    $campos_banner = mysql_fetch_array($resultado_banner);

    echo '<center><a href="' . $campos_banner[link] . '" target="_blank"><img src="./images/' . $campos_banner[informacoes] . '" border="0"  "></a></center></p>';

    echo "<table width='100%'>
        <tr align='center' bgcolor='#F0F0F0'><td></td></tr>
    </table>";
    echo '<br><b><center>SIMPÓSIO</center></b><br>';

    /*Menu apresentado a esquerda na pagina inicial, mesmo que a pessoa nao esteja logada no sistema
     *Codigo grupo 6 = Geral
     * codigo_link's que estao este grupo -> 1,4,5,51,52,53,54,57,58
     * Significado dos links 1->Home, 4->Cadastro Simpsio, 5-> Programacao, 51-> Apresentacao, 52->Corpo Editorial, 53->Expediente, 54-> normas para publicacao, 57-> Validar certificado 58->Anais
     * Cada codigo de link esta ligado a um icone (ex.: codigo 1 = casa.png) que se encontra na pasta images
     * Cada codigo de link esta ligado a um arquivo (ex.: codigo 1 = principal2.php)
     */
    $sql3 = "select * from grupo_link gl, grupo g, link_menu l where g.codigo_grupo = gl.codigo_grupo and gl.codigo_link = l.codigo_link and gl.codigo_grupo = '6' ORDER BY ordem";
    $resultado3 = mysql_query($sql3);

    echo '<table border="0" cellspacing="4" cellpadding="3">';

    /*
     *  Este while monta os links e as imagens na p�gina inicial, no menu vertical esquerdo
     */
    while ($campos3 = mysql_fetch_array($resultado3))
    {
        //Abre o endereco em uma nova aba (58 e o link para a pagina dos anais)
        if($campos3[codigo_link] == 58)
        {
            echo'
            <tr> 
                <td> 
                    <img heigth=32 width=32 src="images/' . $campos3[icone] . '" border="0"> 
                </td>
                <td> 
                     &nbsp;&nbsp;<a href=https://dppg.riopomba.ifsudestemg.edu.br/anais-simposio/ target = "blank"> ' . $campos3[nome_link] . '</a>
                </td>
            </tr>';
        }
        elseif($campos3[codigo_link] == 59) // Link DPPG
        {
            echo"
                    <tr>
                      <td>
                        <img heigth=32 width=32 src='images/dppg.png' border=0'>
                      </td>
                      <td> &nbsp;&nbsp;<a target='_blank' href='https://dppg.riopomba.ifsudestemg.edu.br/index.php?arquivo=listar_noticias.php'>  DPPG  </a>
                 ";
        }
        else//Abre os enderecos na mesma aba
        {
            echo '
            <tr>
                <td>
                  <img heigth=32 width=32 src="images/' . $campos3[icone] . '" border="0">
                </td>
            <td>
              &nbsp;&nbsp;<a href=simposio.php?arquivo2=' . $campos3[caminho] . '>' . $campos3[nome_link] . '</a>
            </td>
          </tr>';
        }
    }

    echo '</table>';
    echo "<table width='100%'>
        <tr align='center' bgcolor='#F0F0F0'><td></td></tr>
    </table>";
    echo '<br><b><center>ACESSO SIMPÓSIO</center></b><br>';


    //echo '<a href="simposio.php?arquivo2=acesso2.php">Acesso Simposio</a>';
    include('acesso2.php');
}
?>
