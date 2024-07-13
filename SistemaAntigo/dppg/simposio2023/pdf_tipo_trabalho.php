<?php
include "acentuacao.php";
?>
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<center>
  <div id="conteudo3"><br>
    <center><b>Aguarde enquanto os arquivos são criados!!!</b><br><br></center>
  </div>
</center>
<?php
include('includes/config.php');
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

function Autores($codigo_trab, $condicao) {
  $campos = mysql_fetch_array(mysql_query("SELECT t.autor1, t.autor2, t.autor3, t.autor4, t.autor5, t.autor6, t.autor7, t.cpf_prof_analisador FROM trabalhos t WHERE codigo_trab='$codigo_trab'"));
  $analizador = mysql_fetch_array(mysql_query("SELECT nome, email FROM participantes WHERE cpf='$campos[cpf_prof_analisador]'"));
  $autor1 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor1]'"));
  if ($campos[autor2] != '') {
    $autor2 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor2]'"));
  }
  if ($campos[autor3] != '') {
    $autor3 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor3]'"));
  }
  if ($campos[autor4] != '') {
    $autor4 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor4]'"));
  }
  if ($campos[autor5] != '') {
    $autor5 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor5]'"));
  }
  if ($campos[autor6] != '') {
    $autor6 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor6]'"));
  }
  if ($campos[autor7] != '') {
    $autor7 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor7]'"));
  }
  if ($condicao == '0') {
    $cont = 1;
    $texto1 = $autor1[nome] . "<sup>$cont</sup>";
    $cont++;
    $texto1 = $texto1 . '; ' . $analizador[nome] . "<sup>$cont</sup>";
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
    $cont = 1;
    $texto1 = "<sup>$cont</sup>$autor1[tipo] do curso: " . $autor1[nome_curso] . "- IFSudesteMG/Campus Rio Pomba; " . $autor1[email] . "<br>";
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

$s = mysql_real_escape_string($_GET[s]);
$t = mysql_real_escape_string($_GET[t]);
$sub = mysql_real_escape_string($_GET[t]);

$quant = $s + 1;
// if ($t == 'N') {
//   $result_trab = mysql_query("SELECT t.codigo_trab, t.titulo, t.resumo, t.palavra_chave, t.modalidade, t.tipo_iniciacao FROM trabalhos as t, sub_area as sa WHERE t.codigo_sa=sa.codigo_sa AND t.modalidade='$t' ORDER BY t.titulo LIMIT $s, 16");
//   $total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where modalidade='$t'"));
// } else {
//   $result_trab = mysql_query("SELECT t.codigo_trab, t.titulo, t.resumo, t.palavra_chave, t.modalidade, t.tipo_iniciacao FROM trabalhos as t WHERE t.modalidade='S' AND t.tipo_iniciacao='$t' ORDER BY t.codigo_trab LIMIT $s, 16");
//   $total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where modalidade='S' and tipo_iniciacao='$t'"));
// }
    if ($sub == "Edu")
    {
    //    echo "Ensino<br />";
        $result_trab = mysql_query("SELECT t.codigo_trab, t.titulo, t.resumo, t.palavra_chave, t.modalidade, t.tipo_iniciacao FROM trabalhos t WHERE  t.tipo_projeto='$sub' ORDER BY t.titulo LIMIT $s, 16");
        $total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where tipo_projeto='$sub'"));
    //    echo "$sql";
    }
    elseif ($sub == "Ext")
    {
        //echo "Extensão";
        $result_trab = mysql_query("SELECT t.codigo_trab, t.titulo, t.resumo, t.palavra_chave, t.modalidade, t.tipo_iniciacao FROM trabalhos t WHERE  t.tipo_projeto='$sub' ORDER BY t.titulo LIMIT $s, 16");
        $total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where tipo_projeto='$sub'"));
        //echo "$sql";
    }
    elseif ($sub == "T")
    {
    //    echo "Técnico";
        $result_trab = mysql_query("SELECT t.codigo_trab, t.titulo, t.resumo, t.palavra_chave, t.modalidade, t.tipo_iniciacao FROM trabalhos t WHERE  t.tipo_iniciacao='$sub' ORDER BY t.titulo LIMIT $s, 16");
        $total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where tipo_iniciacao='$sub'"));
    //    echo "$sql";
    }
    elseif ($sub == "G")
    {
        //echo "Graduação";
        $result_trab = mysql_query("SELECT t.codigo_trab, t.titulo, t.resumo, t.palavra_chave, t.modalidade, t.tipo_iniciacao FROM trabalhos t WHERE  t.tipo_iniciacao='$sub' ORDER BY t.titulo LIMIT $s, 16");
        $total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where tipo_iniciacao='$sub'"));
        //echo "$sql";
    }
    elseif ($sub == "L")
    {
        //echo "Latu Sensus";
        $result_trab = mysql_query("SELECT t.codigo_trab, t.titulo, t.resumo, t.palavra_chave, t.modalidade, t.tipo_iniciacao FROM trabalhos t WHERE  t.tipo_iniciacao='$sub' ORDER BY t.titulo LIMIT $s, 16");
        $total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where tipo_iniciacao='$sub'"));
        //echo "$sql";
    }
    elseif ($sub == "S")
    {
        //echo "Stritu sensus";
        $result_trab = mysql_query("SELECT t.codigo_trab, t.titulo, t.resumo, t.palavra_chave, t.modalidade, t.tipo_iniciacao FROM trabalhos t WHERE  t.tipo_iniciacao='$sub' ORDER BY t.titulo LIMIT $s, 16");
        $total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where tipo_iniciacao='$sub'"));
        //echo "$sql";
    }

$resultado_edicao = mysql_query("select informacoes from conteudo where codigo_conteudo = '10'");
$campos_edicao = mysql_fetch_array($resultado_edicao);
$resultado_edicao1 = mysql_query("select informacoes from conteudo where codigo_conteudo = '11'");
$campos_edicao1 = mysql_fetch_array($resultado_edicao1);

$arquivo = "";
while ($campos_trabalho = mysql_fetch_array($result_trab)) {
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

if ($campos_trabalho[modalidade] == "N")
{
   if ($campos_trabalho[tipo_iniciacao] == "G"){
       $modalidade = "Pesquisa - Graduação";
       $arquivo = "Pesquisa_Graduacao_$campos_trabalho[codigo_trab].pdf";
       $pasta = "graduacao";
   }
   else if ($campos_trabalho[tipo_iniciacao] == "T"){
       $modalidade = "Pesquisa - Técnico";
       $arquivo = "Pesquisa_Tecnico_$campos_trabalho[codigo_trab].pdf";
       $pasta = "tecnico";
   }
   else if ($campos_trabalho[tipo_iniciacao] == "L"){
       $modalidade = "Pesquisa - Lato Sensu";
       $arquivo = "Pesquisa_LatoSensu_$campos_trabalho[codigo_trab].pdf";
       $pasta = "mestrado";
   }
   else if ($campos_trabalho[tipo_iniciacao] == "S") {
       $modalidade = "Pesquisa - Stricto Sensu";
       $arquivo = "Pesquisa_StrictoSensu_$campos_trabalho[codigo_trab].pdf";
       $pasta = "mestrado";
   }
}
else if ($campos_trabalho[modalidade] == "S")
{
   if ($campos_trabalho[tipo_iniciacao] == "G") {
       $modalidade = "Iniciação Científica - Graduação";
       $arquivo = "Ic_Graduacao_$campos_trabalho[codigo_trab].pdf";
       $pasta = "graduacao";
   }
   else if ($campos_trabalho[tipo_iniciacao] == "T"){
       $modalidade = "Iniciação Científica - Técnico";
       $arquivo = "Ic_Tecnico_$campos_trabalho[codigo_trab].pdf";
       $pasta = "tecnico";
   }
}
else if ($campos_trabalho[modalidade] == "0")
{
   if ($campos_trabalho[tipo_projeto] == "Ext")
   {
       $modalidade = "Estudos Orientados - Extensão";
       $arquivo = "Estudos_Orientados_Extensao_$campos_trabalho[codigo_trab].pdf";
       $pasta = "orientado";
   }
   else if ($campos_trabalho[tipo_projeto] == "Edu")
   {
       $modalidade = "Estudos Orientados - Ensino";
       $arquivo = "Estudos_Orientados_Ensino_$campos_trabalho[codigo_trab].pdf";
       $pasta = "orientado";
   }
}
  // Logo
  $image_file = "images/logo-ifete.png";
  $pdf->Image($image_file, 25, 7, 50, 25, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

  $pdf->SetFont('times', 'R', 9);

  $header = <<<EOD
      <font align="right">$campos_edicao[informacoes] Simpósio de Ciência, Inovação & Tecnologia – IF Sudeste MG - Campus Rio Pomba<br>
      Economia Verde, Sustentabilidade e Erradicação da Pobreza<br>
      $campos_edicao1[informacoes].<br></font>
EOD;
  $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '7', $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
  $header = '';
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  // Set font
  $pdf->SetFont('times', 'R', 9);
  $rodape = '';
  //pega os dados formatados
  $rodape = Autores($codigo, 1);

  // Page number
  $pdf->writeHTMLCell($w = 0, $h = 0, $x = 15, $y = 245, $rodape, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '');
  $rodape = '';
// //-------------------------------------------------------------------------------------------
//   if ($campos_trabalho[codigo_trab] == 72 || $campos_trabalho[codigo_trab] == 89 || $campos_trabalho[codigo_trab] == 107) {
//     $titulo = $campos_trabalho[titulo];
//   } else {
    $titulo = strtr(strtoupper($campos_trabalho[titulo]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß");
  // }
  $titulo = strtoupper($campos_trabalho[titulo]);
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
  $resumo = str_replace("<p>", "", $campos_trabalho[resumo]);
  $resumo = str_replace("</p>", "", $resumo);
  $resumo = htmlspecialchars_decode($campos_trabalho[resumo], ENT_QUOTES);
  $resumo = "<p>$resumo</p>";
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

  $pdf->Output("trabalhos/$arquivo", "F");
  $quant++;
  copy("trabalhos/$arquivo", "trabalhos/$pasta/$arquivo");
  unlink("trabalhos/$arquivo");
}

$s = $s + 16;
if ($s < $total) {
  echo '<meta http-equiv="refresh" content="0; URL=pdf_tipo_trabalho.php?t=' . $t . '&s=' . $s . '" />';
} else {

  $directory = "trabalhos/$pasta"; //diretorio para compactar
  $zipfile = "trabalhos/$pasta/trabalhos.zip"; // nome do zip gerado

  $filenames = array();

  function browse($dir) {
    global $filenames;
    if ($handle = opendir($dir)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && is_file($dir . '/' . $file)) {
          $filenames[] = $dir . '/' . $file;
        } else if ($file != "." && $file != ".." && is_dir($dir . '/' . $file)) {
          browse($dir . '/' . $file);
        }
      }
      closedir($handle);
    }
    return $filenames;
  }

  browse($directory);
// cria zip, adiciona arquivos...
  $zip = new ZipArchive();
  if ($zip->open($zipfile, ZIPARCHIVE::CREATE) !== TRUE) {
    exit("Não pode abrir: <$zipfile>\n");
  }

  foreach ($filenames as $filename) {
    $file = $filename;
    $arquivo = substr($file, -3);
    if ($arquivo == "pdf") {
      $zip->addFile($filename);
    }
  }
  $zip->close();
  foreach (glob("trabalhos/$pasta/*.pdf") as $arq) {
    unlink($arq);
  }

  // Enviando para o cliente fazer download
  header("Content-Type: application/zip");
  header("Content-Disposition: attachment; filename='trabalhos/$pasta/trabalhos.zip'");
  readfile("trabalhos/$pasta/trabalhos.zip");
  exit(0);
}
mysql_close($conexao);
?>
