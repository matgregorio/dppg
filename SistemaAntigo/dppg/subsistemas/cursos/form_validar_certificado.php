<?php
session_start();

include_once ('trataInjection.php');

if(protectorString($_POST[s]) || protectorString($_POST[codigo]))
    return;



//$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
//$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));
//
//if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm)) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
        <head>
            <title> Verificar Certificados </title>
            <!--<link rel="stylesheet" type="text/css" href="css/style.css">-->
        </head>
        <?php
        include './includes/config.php';
        if ($_POST[s] == 's') {
           
            $codigo = mysql_real_escape_string($_POST[codigo]);
            $sql = "SELECT * FROM valida_certificado WHERE codigo='$codigo'";
            
            $result = mysql_query($sql);
            $campos = mysql_fetch_array($result);
            echo "<div><center>";
            echo"<h1>Validação de certificados</h1>";
            if (mysql_num_rows($result) > 0) {
                var_dump($campos);

                if ($campos[tipo] == "palestrante"){
                    $result = mysql_query("SELECT palestrante AS nomep, nome_curso FROM cursos WHERE codigo_curso='$campos[codigo_curso]'");
                }else if ($campos[tipo] == "curso"){
                    $result = mysql_query("SELECT participantes.nome AS nomep, cursos.nome_curso FROM participantes JOIN (inscricao JOIN cursos ON inscricao.codigo_curso=cursos.codigo_curso) ON participantes.cpf=inscricao.cpf WHERE inscricao.presenca='S' AND inscricao.codigo_curso='$campos[codigo_curso]' and participantes.cpf='$campos[cpf]'");
                }else if ($campos[tipo] == "voluntario"){
                    $result = mysql_query("SELECT participantes.nome AS nomep, projetos.projeto FROM participantes JOIN (projetos) WHERE projetos.idProjeto='$campos[codigo_curso]' AND participantes.cpf='$campos[cpf]'");
                }else if ($campos[tipo] == "bolsista"){
                    $result = mysql_query("SELECT participantes.nome AS nomep, projetos.projeto FROM participantes JOIN (projetos) WHERE projetos.idProjeto='$campos[codigo_curso]' AND participantes.cpf='$campos[cpf]'");
                }else if ($campos[tipo] == "orientador"){
                    $result = mysql_query("SELECT participantes.nome AS nomep, projetos.projeto FROM participantes JOIN (projetos) WHERE projetos.idProjeto='$campos[codigo_curso]' AND participantes.cpf='$campos[cpf]'");
                }

                echo"<p><b>Código de Validação:</b> " . str_pad($campos[codigo], 11, "0", STR_PAD_LEFT) . "</p>";
                $nome = mysql_fetch_array($result);
                echo"<p><b>Certificado liberado para:</b> " . strtr(strtoupper($nome[nomep]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß") . "</p>";
                if ($campos[tipo] == "curso") {
                    $trab = mysql_fetch_array(mysql_query("SELECT titulo FROM trabalhos WHERE codigo_trab=$campos[codigo_trab]"));
                    echo"<p><b>Certificado de participação no:</b> " . strtr(strtoupper($nome[nome_curso]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß") . "</p>";
                } else if ($campos[tipo] == "palestrante") {
                    echo"<p><b>Tipo de Certificado:</b> Palestrante</p>";
                } else if ($campos[tipo] == "bolsista"){
                    echo"<p><b>Certificado do Projeto:</b> $nome[projeto]</p>";
                    echo "<p><b>Tipo de Certificado:</b> Bolsista</b></p>";
                } else if ($campos[tipo] == "voluntario"){
                    echo"<p><b>Certificado do Projeto:</b> $nome[projeto]</p>";
                    echo "<p><b>Tipo de Certificado:</b> Voluntário</b></p>";
                } else if ($campos[tipo] == "orientador"){
                    echo"<p><b>Certificado do Projeto:</b> $nome[projeto]</p>";
                    echo "<p><b>Tipo de Certificado:</b> Orientador</b></p>";
                }
            } else {
                echo"<h2><font color='#aa0000'>Código de Validação não encontrado</font></h2>";echo $sql;
            }
            echo '</br></br><a href="index.php?arquivo=subsistemas/cursos/form_validar_certificado.php"><font size="4">Voltar</font></a></br></br></br>';
            echo "</center></div>";
        } else {
            ?>
            <body>
            <center>
                <div>
                    <div>
                        <p style="text-align: center"><b>Trabalhos Apresentados</b></p>
                        <br>
                        <form name="form_validar_certificado" method="post" action="index.php?arquivo=subsistemas/cursos/form_validar_certificado.php">
                            <center>
                                Digite o código de validação:
                                <input type="text" maxlength="11" name="codigo" >
                                <input type="submit" value="Verificar">
                                <input type="hidden" name='s' value="s">
                            </center>
                        </form>
                    </div>
                </div>
            </center>
        </body>
        </html>
        <?php
//    }
    mysql_close($conexao);
}
?>