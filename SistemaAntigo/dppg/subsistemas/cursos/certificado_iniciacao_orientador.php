<?php

include("../../includes/config2.php");
include_once ('trataInjection.php');

if(protectorString($_POST[cpf]) || protectorString($_POST[id]))
    return;

$cpf = mysql_real_escape_string($_POST[cpf]);
$id = mysql_real_escape_string($_POST[id]);

$nomeOrientador = mysql_fetch_array(mysql_query("SELECT p.nome, pp.liberar FROM participantes p, projetosparticipantes pp WHERE pp.cpfOrientador=p.cpf AND p.cpf='$cpf' AND pp.idProjetoParticipante='$id'"));

if ($nomeOrientador[liberar] == 1)
{

  $camposProjeto = mysql_fetch_array(mysql_query("SELECT p.*, par.nome, pp.tipoBolsa FROM projetos p, projetosparticipantes pp, participantes par WHERE p.idProjeto=pp.idProjeto AND par.cpf=pp.cpfAluno AND pp.cpfOrientador='$cpf' AND pp.idProjetoParticipante='$id'"));

  $nomeOrientador = $nomeOrientador[nome];
  $aluno = $camposProjeto[nome];
  $projeto = $camposProjeto[projeto];
  $fomento = $camposProjeto[fomento];
  $vigencia = $camposProjeto[vigencia];

  setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
  $dataAtual = strftime(' %d de %B de %Y', strtotime('today'));

  $tipo = "orientador";

  mysql_close($conexao);

  $codigo_curso = $camposProjeto[idProjeto];
  include 'valida_certificado.php';

//background: url(../../images/dppg-certificado.jpg) no-repeat; background-image-resolution: 800 dbi; background-image-resize:6;
  $html = "
<body>
        <img src='../../images/dppg-certificado.jpg' style='width: 1300px; height: 1500px; opacity: 0.15; filter: alpha(opacity=15); -moz-opacity: 0.15; margin-top: 50px;'>
        <div style='border: 0px solid; vertical-align: central; width:1300px; height:1200px; margin-top: -650px;'>
          <table border='0' style='width:1300px; height:1100px; text-justify: auto'>
            <tr><td align=center>&nbsp;</br></td></tr>
            <tr><td style='text-align: center;'><font style='font-family: arial; font-size: 40' >CERTIFICADO</font></td>
          </table>
          <table border='0' style='margin-top: -85px; margin-left: 1000px; text-justify: auto;'>
            <tr>
                <td><img src='../../images/logoIf.png' style='width: 250px; height: 90px;'></td>
            </tr>
          </table>
          <div style='border:0 solid; margin: 50 auto; width:900px; height:300px;'>
            <table border=0 style='width:1300px; height:1100px; text-justify: auto; font-family: arial; font-size: 18px;'>
              <tr>
                <td style='line-height: 200%; text-align: justify;'><br><br>
                    <p>Certificamos para os devidos fins que <b>$nomeOrientador</b> foi orientador(a) de iniciação científica no $fomento no Instituto Federal de Educação, Ciência e Tecnologia do Sudeste de Minas Gerais - <i>Campus</i> Rio Pomba, do(a) aluno(a) <b>$aluno</b> com o projeto intitulado <b>\"$projeto\"</b>, no período de $vigencia.</p>
                </td>
              </tr>
              <tr><td align='right'><br>Rio Pomba, $dataAtual.</td></tr>
            </table>
            <div style='text-align: center; border:0 solid; margin: 80px auto; width:100%; height:100px; float: left;'>
              <img src='../../images/AssinaturaLarissaTrevizano.png' width='250' height='80'><br>
              <b>" . strtr(strtoupper("Larissa Mattos Trevizano"), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
              Diretora de Pesquisa e Pós-Graduação<br>
              <font style='font-family: arial; font-size: 12' >Código de Validação: " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "<br> Verifique a autenticidade deste documento na página: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/index.php?arquivo=subsistemas/cursos/form_validar_certificado.php</font>
            </div>
          </div>
        </div>
</body>
";

  include("../../MPDF56/mpdf.php");
  $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15);
  $mpdf->normalLineheight = 1.5;
  $mpdf->SetDisplayMode('fullpage', 'single');
  $mpdf->SetLineHeight("arial", "1.5");
  $mpdf->writeHTML($html);
  $mpdf->Output('mpdf.pdf', 'I');
  exit;
} else {
//    $texto = iconv("utf-8","ISO-8859-1", "Você não tem premição para gerar seu Certificado de Iniciação científica");
  $texto = "Você não tem permissão para gerar seu certificado de iniciação científica ";
  echo"<center><b><font color='red' >$texto</font></b></center>";
}
?>