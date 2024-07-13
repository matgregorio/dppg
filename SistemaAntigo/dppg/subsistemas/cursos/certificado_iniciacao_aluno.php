<?php
include("../../includes/config2.php");
include_once ('trataInjection.php');

if(protectorString($_POST[cpf]) || protectorString($_POST[id]))
    return;

$cpf = mysql_real_escape_string($_POST[cpf]);
$id = mysql_real_escape_string($_POST[id]);

$nomeAluno = mysql_fetch_array(mysql_query("SELECT p.nome, pp.liberar FROM participantes p, projetosparticipantes pp WHERE pp.cpfAluno=p.cpf AND p.cpf='$cpf' AND pp.idProjetoParticipante='$id'"));

if ($nomeAluno[liberar] == 1) {
    $camposProjeto = mysql_fetch_array(mysql_query("SELECT p.idProjeto, p.projeto, p.fomento, p.vigencia, par.nome, pp.tipoBolsa FROM projetos p, projetosparticipantes pp, participantes par WHERE p.idProjeto=pp.idProjeto AND par.cpf=pp.cpfOrientador AND pp.cpfAluno='$cpf' AND pp.idProjetoParticipante='$id'"));

    $nomeAluno = $nomeAluno[nome];
    $orientador = $camposProjeto[nome];
    $projeto = $camposProjeto[projeto];
    $fomento = $camposProjeto[fomento];
    $vigencia = $camposProjeto[vigencia];

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $dataAtual = strftime(' %d de %B de %Y', strtotime('today'));

    if ($camposProjeto[tipoBolsa] == "B"){
        $tipoAluno = "bolsista";
        $tipo = "bolsista";
    }else if ($camposProjeto[tipoBolsa] == "V"){
        $tipoAluno = "Voluntário (a)";
        $tipo = "voluntario";
    }

    mysql_close($conexao);

    $codigo_curso = $camposProjeto[idProjeto];
    include 'valida_certificado.php';

//background: url(../../images/dppg-certificado.jpg) no-repeat; background-image-resolution: 800 dbi; background-image-resize:6;
    $html = "
<body>
        <img src='../../images/dppg-certificado.jpg' style='width: 1300px; height: 1500px; opacity: 0.35; filter: alpha(opacity=35); -moz-opacity: 0.35; margin-top: 50px;'>
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
                    <p>Certificamos para os devidos fins que <b>$nomeAluno</b> foi $tipoAluno de iniciação científica no $fomento no Instituto Federal de Educação, Ciência e Tecnologia do Sudeste de Minas Gerais - <i>Campus</i> Rio Pomba, com o projeto intitulado <b>\"$projeto\"</b>, sob a orientação do(a) professor(a) <b>$orientador</b>, no período de $vigencia.</p>
                </td>
              </tr>
              <tr><td align='right'><br>Rio Pomba, $dataAtual.</td></tr>
            </table>
            
			<!-- Assinatura da Direção de Pesquisa centralizada
			<div style='text-align: center; border:0 solid; margin: 10px auto; width:100%; height:100px; float: left;'>
              <img src='../../images/AssinaturaLarissaTrevizano.png' width='250' height='80'><br>
              <b>" . strtr(strtoupper("Larissa Mattos Trevizano"), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
              Diretora de Pesquisa e Pós-Graduação<br><br><br><br><br>
              <font style='font-family: arial; font-size: 12' >Código de Validação: " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "<br> Verifique a autenticidade deste documento na página: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/index.php?arquivo=subsistemas/cursos/form_validar_certificado.php</font>
            </div>
			-->
			<br>
			<div>
			  <div style='text-align: center; border:0 solid; margin-top: 10px; margin-buttom: 30px ; margin-left: 30px; width:300px; height:100px; float: left;'>
				<img src='../../images/AssinaturaLarissaTrevizano.png' width='180' height='60'><br>
				<b>" . strtr(strtoupper("Larissa Mattos Trevizano"), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
				Diretora de Pesquisa e Pós-Graduação
			  </div>
			  <div style='text-align: center; border:0 solid; margin-top: 10px; margin-buttom: 30px ; margin-left: 243px; margin-right: 50px; width:300px; height:100px; float:left;'>
				<img src='../../images/AssinaturaFranciano.png' width='180' height='60'><br>
				<b>" . strtr(strtoupper("Franciano Benevenuto Caetano"), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß") . "</b><br>
				Gerente de Pesquisa e Pós-Graduação				
			  </div>
		  
		  <br><br><br><br>
		  <div style='text-align: center'>
		  <font style='font-family: arial; font-size: 12' >
		  Código de Validação: " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "<br> Verifique a autenticidade deste documento na página: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/index.php?arquivo=subsistemas/cursos/form_validar_certificado.php
		  </font>
		  </div>
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
}else{
    $texto = iconv("utf-8","ISO-8859-1", "Voc&ecirc; n&atilde;o tem permiss&atilde;o para gerar seu certificado de inicia&ccedil;&atilde;o cient&iacute;fica");
    echo"<center><b><font color='red' >$texto</font></b></center>";
}
?>