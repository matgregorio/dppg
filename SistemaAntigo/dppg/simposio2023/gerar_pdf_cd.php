<?php

include('includes/config.php');
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

function Autores($codigo_trab, $condicao) {
  $campos = mysql_fetch_array(mysql_query("SELECT * FROM trabalhos WHERE codigo_trab='$codigo_trab'"));
  $analizador = mysql_fetch_array(mysql_query("SELECT cpf, nome, email FROM participantes WHERE cpf='$campos[cpf_prof_analisador]'"));

  $autor1 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor1]'"));
  if ($campos[autor2] != '') {
    $autor2 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor2]'"));
  }
  if ($campos[autor3] != '') {
    $autor3 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor3]'"));
  }
  if ($campos[autor4] != '') {
    $autor4 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor4]'"));
  }
  if ($campos[autor5] != '') {
    $autor5 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor5]'"));
  }
  if ($campos[autor6] != '') {
    $autor6 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor6]'"));
  }
  if ($campos[autor7] != '') {
    $autor7 = mysql_fetch_array(mysql_query("SELECT participantes.cpf, participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor7]'"));
  }
  if ($condicao == '0') {
    $cont = 1;
    $texto1 = $autor1[nome] . "<sup>$cont</sup>";
    $cont++;
    if ($autor1[cpf] != $analizador[cpf]) {
      $texto1 = $texto1 . '; ' . $analizador[nome] . "<sup>$cont</sup>";
    }
    if ($autor2[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor2[nome] . "<sup>$cont</sup>";
    }
    if ($autor3[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor3[nome] . "<sup>$cont</sup>";
    }
    if ($autor4[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor4[nome] . "<sup>$cont</sup>";
    }
    if ($autor5[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor5[nome] . "<sup>$cont</sup>";
    }
    if ($autor6[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor6[nome] . "<sup>$cont</sup>";
    }
    if ($autor7[nome] != '') {
      $cont++;
      $texto1 = $texto1 . '; ' . $autor7[nome] . "<sup>$cont</sup>";
    }
  } else if ($condicao == '1') {
    //colocar condição que diz qual tipo de participante
    $cont = 0;
    if ($autor1[cpf] != $analizador[cpf]) {//caso o autor 1 seja o orientador
      $cont++;
      $texto1 = "<sup>$cont</sup>$autor1[tipo] do curso: " . $autor1[nome_curso] . "- IFSudesteMG/Campus Rio Pomba; " . $autor1[email] . "<br>";
    }
    $cont++;
    $texto1 = $texto1 . "<sup>$cont</sup>Professor Orientador - IFSudesteMG/Campus Rio Pomba; " . $analizador[email] . "<br>";
    if ($autor2[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor2[tipo] do curso: " . $autor2[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor2[email] . "<br>";
    }
    if ($autor3[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor3[tipo] do curso: " . $autor3[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor3[email] . "<br>";
    }
    if ($autor4[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor4[tipo] do curso: " . $autor4[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor4[email] . "<br>";
    }
    if ($autor5[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor5[tipo] do curso: " . $autor5[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor5[email] . "<br>";
    }
    if ($autor6[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor6[tipo] do curso: " . $autor6[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor6[email] . "<br>";
    }
    if ($autor7[nome] != '') {
      $cont++;
      $texto1 = $texto1 . "<sup>$cont</sup>$autor7[tipo] do curso: " . $autor7[nome_curso] . " - IFSudesteMG/Campus Rio Pomba; " . $autor7[email];
    }
  }
  $autor1[nome] = "";
  $autor2[nome] = "";
  $autor3[nome] = "";
  $autor4[nome] = "";
  $autor5[nome] = "";
  $autor6[nome] = "";
  $autor7[nome] = "";
  return $texto1;
}

$s = 0;
if (isset($_GET[s])) {
  $s = $_GET[s];
}

$result_trab = mysql_query("SELECT sa.codigo_sa, sa.nome_sa, t.* FROM trabalhos t, sub_area sa WHERE t.codigo_sa=sa.codigo_sa AND t.aprovado='1' LIMIT $s, 15");

$total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where aprovado='1'"));

$resultado_edicao = mysql_query("select informacoes from conteudo where codigo_conteudo = '10'");
$campos_edicao = mysql_fetch_array($resultado_edicao);
$resultado_edicao1 = mysql_query("select informacoes from conteudo where codigo_conteudo = '11'");
$campos_edicao1 = mysql_fetch_array($resultado_edicao1);

$quant = $s + 1;
while ($campos_trabalho = mysql_fetch_array($result_trab)) {
  $arquivo = "";
  $codigo = $campos_trabalho[codigo_trab];

  $result_apoios = mysql_query("SELECT apoio.nome FROM apoio, apoio_trabalho WHERE apoio.codigo_apoio=apoio_trabalho.codigo_apoio AND apoio_trabalho.codigo_trabalho='$codigo' ORDER BY apoio.nome");
  $cont = 0;
  $apoios = '';
  while ($campos_apoio = mysql_fetch_array($result_apoios)) {
    if ($cont == 0) {
      $apoios = $campos_apoio[nome];
      $cont++;
    } else {
      $apoios = "$apoios - $campos_apoio[nome]";
    }
  }
// ---------------------------------------------------------
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Add a page
  $pdf->AddPage();
//-------------------------------------------------------------------------------------------
  $trabalho = '';
  $arquivo = '';
  if ($campos_trabalho[modalidade] == "N") {
    $modalidade = "Estudos Orientados";
    $pasta = str_replace(' ', '_', $campos_trabalho[nome_sa]);
//        $pasta = $campos_trabalho[nome_sa];
    $vowels = array('/', '|', '>', '<', '*', '?', ':', '“', "!");
    $trabalho = str_replace($vowels, "-", $campos_trabalho[titulo]);
    $arquivo = strip_tags($trabalho);
  } else {
    if ($campos_trabalho[tipo_iniciacao] == "G") {
      $modalidade = "Iniciação Científica/Graduação";
      $pasta = str_replace(' ', '_', $campos_trabalho[nome_sa]);
//            $pasta = $campos_trabalho[nome_sa];
      $vowels = array('/', '|', '>', '<', '*', '?', ':', '“', "!");
      $trabalho = str_replace($vowels, "-", $campos_trabalho[titulo]);
      $arquivo = strip_tags($trabalho);
    } else if ($campos_trabalho[tipo_iniciacao] == "M") {
      $modalidade = "Iniciação Científica/Mestrado";
      $pasta = str_replace(' ', '_', $campos_trabalho[nome_sa]);
//            $pasta = $campos_trabalho[nome_sa];
      $vowels = array('/', '|', '>', '<', '*', '?', ':', '“', "!");
      $trabalho = str_replace($vowels, "-", $campos_trabalho[titulo]);
      $arquivo = strip_tags($trabalho);
    } else {
      $modalidade = "Iniciação Científica/Técnico";
      $pasta = str_replace(' ', '_', $campos_trabalho[nome_sa]);
//            $pasta = $campos_trabalho[nome_sa];
      $vowels = array('/', '|', '>', '<', '*', '?', ':', '“', "!");
      $trabalho = str_replace($vowels, "-", $campos_trabalho[titulo]);
      $arquivo = strip_tags($trabalho);
    }
  }
  mkdir("trabalhos/cd/$pasta");
  // Logo
  $image_file = "images/logo-ifete.png";
  $pdf->Image($image_file, 25, 7, 50, 25, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

  $pdf->SetFont('times', 'R', 9);

  $header = <<<EOD
      <font align="right">$campos_edicao[informacoes] Simpósio de Ciência, Inovação & Tecnologia – IF Sudeste MG - Campus Rio Pomba<br>
      Ciência e Tecnologia para o Desenvolvimento Social<br>
      $campos_edicao1[informacoes].<br></font>
EOD;
  $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '7', $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
  $header = '';
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  // Set font
  $pdf->SetFont('times', 'R', 9);
  //pega os dados formatados
  $rodape = Autores($codigo, 1);

  // Page number
  $pdf->writeHTMLCell($w = 0, $h = 0, $x = 15, $y = 245, $rodape, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '');
  $rodape = '';
//-------------------------------------------------------------------------------------------
  if ($campos_trabalho[codigo_trab] == 72 || $campos_trabalho[codigo_trab] == 89 || $campos_trabalho[codigo_trab] == 107) {
    $titulo = $campos_trabalho[titulo];
  } else {
    $titulo = strtr(strtoupper($campos_trabalho[titulo]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß");
  }
  $arq_name = $titulo;
  $autores = Autores($codigo, 0);
  $autores = strtr(strtoupper($autores), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß");
// Set some content to print
  $html = <<<EOD
<font align="center" size="11"><b>$titulo</b></font>
EOD;
// Print text using writeHTMLCell()
  $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '35', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

  $html = <<<EOD
<font align="justfy" size="9"><b>$autores</b></font>
EOD;
  $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '60', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

  $resumo = htmlspecialchars_decode($campos_trabalho[resumo], ENT_QUOTES); //decodifica o texto
  $html = <<<EOD
<font align="justfy" size="11">$resumo</font><br><br><br>
EOD;
  $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '75', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

  $html = <<<EOD
    <font align="left" size="12"><b>PALAVRAS CHAVE:</b> $campos_trabalho[palavra_chave]</font><br><br>
    <font align="left" size="12"><b>Apoio(s):</b>
    <br>$apoios
    <br><br></font>
EOD;
  $pdf->writeHTMLCell($w = '0', $h = '0', $x = '15', $y = '210', $html, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '', $autopadding = true);

  $html = '';
  $apoios = '';
  $resumo = '';
  $titulo = '';
  $autores = '';

  $pdf->Output("trabalhos/$arquivo", "F");
  $quant++;
  copy("trabalhos/$arquivo", "trabalhos/cd/$pasta/$arquivo");
  unlink("trabalhos/$arquivo");
}
$s = $s + 15;
if ($s < $total) {
  echo '<meta http-equiv="refresh" content="0; URL=gerar_pdf_cd.php?s=' . $s . '" />';
} else {

//    $directory = "trabalhos/cd"; //diretorio para compactar
//    $zipfile = "trabalhos/cd/cd_anais.zip"; // nome do zip gerado
//
//    $filenames = array();
//
//    function browse($dir) {
//        global $filenames;
//        if ($handle = opendir($dir)) {
//            while (false !== ($file = readdir($handle))) {
//                if ($file != "." && $file != ".." && is_file($dir . '/' . $file)) {
//                    $filenames[] = $dir . '/' . $file;
//                } else if ($file != "." && $file != ".." && is_dir($dir . '/' . $file)) {
//                    browse($dir . '/' . $file);
//                }
//            }
//            closedir($handle);
//        }
//        return $filenames;
//    }
//
//    browse($directory);
//// cria zip, adiciona arquivos...
//    $zip = new ZipArchive();
//    if ($zip->open($zipfile, ZIPARCHIVE::CREATE) !== TRUE) {
//        exit("Não pode abrir: <$zipfile>\n");
//    }
//
//    foreach ($filenames as $filename) {
//        $file = $filename;
//        $arquivo = substr($file, -3);
//        if ($arquivo == "pdf") {
//            $zip->addFile($filename);
//        }
//    }
//    $zip->close();
//    foreach (glob("trabalhos/cd/*.pdf") as $arq) {
//        unlink($arq);
//    }
//-----------------------------------------------------------------------
//    // diretório que será compactado
//    $diretorio = 'trabalhos/cd/';
//
//    // inicializa a classe ZipArchive
//    $zip = new ZipArchive();
//    // abre o arquivo .zip
//    if ($zip->open("trabalhos/cd/Trabalhos_CD.zip", ZIPARCHIVE::CREATE) !== TRUE) {
//        die("Erro!");
//    }
//    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($diretorio));
//
//    // itera cada pasta/arquivo contido no diretório especificado
//    foreach ($iterator as $key => $value) {
//        // adiciona o arquivo ao .zip
//        $zip->addFile(realpath($key), iconv('ISO-8859-1', 'IBM850', $key)) or die("ERRO: Não é possível adicionar o arquivo: $key");
//    }
//    // fecha e salva o arquivo .zip gerado
//    $zip->close();
//    // Enviando para o cliente fazer download
//    header("Content-Type: application/zip");
//    header("Content-Disposition: attachment; filename='Trabalhos_CD.zip'");
//    readfile("trabalhos/cd/Trabalhos_CD.zip");
//    exit(0);
  chmod("trabalhos/cd/", 0777);
  chdir("/var/www/dppg/simposio2014/trabalhos/");
  exec("rar a -r Trabalhos_CD.rar cd/");

  header("Content-Disposition: attachment; filename=Trabalhos_CD.rar");
  header("Content-type: " . mime_content_type("/var/www/dppg/simposio2014/trabalhos/Trabalhos_CD.rar"));
  readfile("/var/www/dppg/simposio2014/trabalhos/Trabalhos_CD.rar");
}
mysql_close($conexao);
?>
