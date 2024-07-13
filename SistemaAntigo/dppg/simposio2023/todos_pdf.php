<?php

include('includes/config.php');
include('acentuacao.php');
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

function Autores($codigo_trab, $condicao)
{
    //Informacoes do trabalho
    $campos = mysql_fetch_array(mysql_query("SELECT * FROM trabalhos WHERE codigo_trab='$codigo_trab'"));
    
    //Segundo autor (Orientador)
    $analizador = mysql_fetch_array(mysql_query("SELECT * FROM participantes, tipo_participante tp  WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cpf='$campos[cpf_prof_analisador]'"));
    $tipoParticipanteAutor2 = "Orientador";
    
    //$autor1 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, cursos.nome_curso, tp.tipo FROM participantes, cursos, tipo_participante tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND participantes.cpf = '$campos[autor1]'"));
    $autor1 = mysql_fetch_array(mysql_query("SELECT * FROM participantes, tipo_participante, cursos, trabalhos WHERE participantes.cpf like '$campos[autor1]' AND participantes.codigo_tipo_participante = tipo_participante.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND trabalhos.autor1 = participantes.cpf"));
    
    $tipoParticipanteAutor1 = $autor1[tipo];
    
    if($autor1[codigo_curso] < 2 || $autor1[codigo_curso] > 22 )
    {
        $autor1 = mysql_fetch_array(mysql_query("SELECT * FROM participantes, tipo_participante, trabalhos WHERE participantes.cpf like '$campos[autor1]' AND participantes.codigo_tipo_participante = tipo_participante.codigo_tipo_participante AND trabalhos.autor1 = participantes.cpf"));
        //$autor1[nome] =  "CURSO NAO CADASTRADO";
        $tipoParticipanteAutor1 = $autor1[tipo];
    }
    if ($campos[autor2] != '') {
        //$autor2 = "SELECT * FROM participantes, tipo_participante, cursos, trabalhos WHERE participantes.cpf like '$campos[autor2]' AND participantes.codigo_tipo_participante = tipo_participante.codigo_tipo_participante AND cursos.codigo_curso = participantes.codigo_curso AND trabalhos.autor2 = participantes.cpf";
        $autor2 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor2]'"));
    }
    if ($campos[autor3] != '') {
        $autor3 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor3]'"));
    }
    if ($campos[autor4] != '') {
        $autor4 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor4]'"));
    }
    if ($campos[autor5] != '') {
        $autor5 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor5]'"));
    }
    if ($campos[autor6] != '') {
        $autor6 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor6]'"));
    }
    if ($campos[autor7] != '') {
        $autor7 = mysql_fetch_array(mysql_query("SELECT participantes.nome, participantes.email, tp.tipo FROM participantes, tipo_participante as tp WHERE tp.codigo_tipo_participante=participantes.codigo_tipo_participante AND participantes.cpf = '$campos[autor7]'"));
    }
    
    //Autores abaixo do titulo, acima do resumo
    if ($condicao == '0') 
    {
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
    } 
    //Autores no fim do documento
    else if ($condicao == '1') 
    {
        $cont = 1;
        
        //Verificacoes para saber se o dado 'campus' esta vazio
        if($autor1[campus]!= "" && $autor1[campus] != "outros")
        {
            //Ex.: Aluno - IFSudesteMG/Campus Rio Pomba - fulano@email.com
            $texto1 = "<sup>$cont</sup>$tipoParticipanteAutor1 " . " - " . "IFSudesteMG/Campus $autor1[campus]" . " - " . $autor1[email] . "<br>";
        }
        else
        {
            //Ex.: Aluno - IFSudesteMG - fulano@email.com
            $texto1 = "<sup>$cont</sup>$tipoParticipanteAutor1 " . " - " . "IFSudesteMG" . " - " . $autor1[email] . "<br>";
        }
        
        $cont++;
              
        if($analizador[cpf] != $autor1[cpf])
        {
            if($analizador[campus] != "" && $analizador[campus] != "outros")
            {
                //Docente - IFSudesteMG/Campus Rio Pomba- fulano@email.comr
                $texto1 = $texto1 . "<sup>$cont</sup>" . " Orientador " . " - IFSudesteMG/Campus $analizador[campus] - " . $analizador[email] . "<br>";
            }
            else
            {
                //Docente - IFSudesteMG - fulano@email.comr
                $texto1 = $texto1 . "<sup>$cont</sup>" . " Orientador " . " - IFSudesteMG - " . $analizador[email] . "<br>";
            }
        }
        
        if ($autor2[nome] != '' ) {
            $cont++;
            
            if($autor2[campus]!= "" && $autor2[campus] != "outros" )
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor2[tipo]" . "  IFSudesteMG/Campus $autor2[campus] - " . $autor2[email] . "<br>";
            }
            else
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor2[tipo]" . "  IFSudesteMG - " . $autor2[email] . "<br>";
            }
        }
        if ($autor3[nome] != '') 
        {
            $cont++;
            
            if($autor3[campus]!= "" && $autor3[campus] != "outros" )
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor3[tipo]" . "  IFSudesteMG/Campus $autor3[campus] - " . $autor3[email] . "<br>";
            }
            else
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor3[tipo]" . "  IFSudesteMG - " . $autor3[email] . "<br>";
            }
            
            //$texto1 = $texto1 . "<sup>$cont</sup>$autor3[tipo]" . " - IFSudesteMG/Campus $autor3[campus] - " . $autor3[email] . "<br>";
        }
        if ($autor4[nome] != '') 
        {
            $cont++;
            
            if($autor4[campus]!= "" && $autor4[campus] != "outros" )
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor4[tipo]" . "  IFSudesteMG/Campus $autor4[campus] - " . $autor4[email] . "<br>";
            }
            else
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor4[tipo]" . "  IFSudesteMG - " . $autor4[email] . "<br>";
            }
            
            //$texto1 = $texto1 . "<sup>$cont</sup>$autor4[tipo]" . " - IFSudesteMG/Campus $autor4[campus] - " . $autor4[email] . "<br>";
        }
        if ($autor5[nome] != '') 
        {
            $cont++;
            
            if($autor5[campus]!= "" && $autor5[campus] != "outros" )
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor5[tipo]" . "  IFSudesteMG/Campus $autor5[campus] - " . $autor5[email] . "<br>";
            }
            else
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor5[tipo]" . "  IFSudesteMG - " . $autor5[email] . "<br>";
            }
            //$texto1 = $texto1 . "<sup>$cont</sup>$autor5[tipo]" . " - IFSudesteMG/Campus $autor5[campus] - " . $autor5[email] . "<br>";
        }
        if ($autor6[nome] != '') 
        {
            $cont++;
            if($autor6[campus]!= "" && $autor6[campus] != "outros")
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor6[tipo]" . "  IFSudesteMG/Campus $autor6[campus] - " . $autor6[email] . "<br>";
            }
            else
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor6[tipo]" . "  IFSudesteMG - " . $autor6[email] . "<br>";
            }
            
            //$texto1 = $texto1 . "<sup>$cont</sup>$autor6[tipo]" . " - IFSudesteMG/Campus $autor6[campus] - " . $autor6[email] . "<br>";
        }
        if ($autor7[nome] != '') 
        {
            $cont++;
            
            if($autor7[campus]!= "" && $autor7[campus] != "outros")
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor7[tipo]" . "  IFSudesteMG/Campus $autor7[campus] - " . $autor7[email] . "<br>";
            }
            else
            {
                $texto1 = $texto1 . "<sup>$cont</sup>$autor7[tipo]" . "  IFSudesteMG - " . $autor7[email] . "<br>";
            }
           //$texto1 = $texto1 . "<sup>$cont</sup>$autor7[tipo]" .  " - IFSudesteMG/Campus $autor7[campus] - " . $autor7[email];
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

$codigo_sa = mysql_real_escape_string($_GET[sa]);//Zootecnia(22), engenharia(18), quimica(29), etc...
$area = mysql_real_escape_string($_GET[a]);//Ensino, pesquisa ou extensao
$s = mysql_real_escape_string($_GET[s]);//Ate hoje so vi essa porcaria recebendo 0

$camposa = mysql_fetch_array(mysql_query("SELECT * FROM sub_area WHERE codigo_sa='$codigo_sa'"));

//Seleciona 16 trabalhos por vez
//$result_trab = mysql_query("SELECT * FROM trabalhos WHERE codigo_sa='$codigo_sa' AND tipo_projeto = '$area' LIMIT $s, 16");*******************************************************
$result_trab = mysql_query("SELECT * FROM trabalhos WHERE codigo_sa='$codigo_sa' AND tipo_projeto = '$area' LIMIT $s, 5");


//Numero total de trabalhos dado um codigo e uma determinada area
$total = mysql_num_rows(mysql_query("SELECT codigo_trab from trabalhos where codigo_sa='$codigo_sa' AND tipo_projeto = '$area'"));

$resultado_edicao = mysql_query("select informacoes from conteudo where codigo_conteudo = '10'");
$campos_edicao = mysql_fetch_array($resultado_edicao);
$resultado_edicao1 = mysql_query("select informacoes from conteudo where codigo_conteudo = '11'");
$campos_edicao1 = mysql_fetch_array($resultado_edicao1);

$quant = $s + 1;
//Loop de no maximo 16 vezes
while ($campos_trabalho = mysql_fetch_array($result_trab)) 
{
    $arquivo = "";
    $codigo = $campos_trabalho[codigo_trab];

    $result_apoios = mysql_query("SELECT apoio.nome FROM apoio, apoio_trabalho WHERE apoio.codigo_apoio=apoio_trabalho.codigo_apoio AND apoio_trabalho.codigo_trabalho='$codigo' ORDER BY apoio.nome");
    $cont = 0;
    $apoios = '';
    while ($campos_apoio = mysql_fetch_array($result_apoios)) 
    {
        //Olha o tamanho dessa gambiarra
        if ($cont == 0) 
        {
            $apoios = $campos_apoio[nome];
            $cont++;
        } 
        else 
        {
            $apoios = "$apoios - $campos_apoio[nome]";
        }
    }


// ---------------------------------------------------------
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Add a page
    $pdf->AddPage();
//-------------------------------------------------------------------------------------------
    $pasta = "sa";
    if ($campos_trabalho[modalidade] == "N")
    {
        if ($campos_trabalho[tipo_iniciacao] == "G"){
            $modalidade = "Pesquisa - Graduação";
            $arquivo = "Pesquisa_Graduacao_$campos_trabalho[codigo_trab].pdf";
        }
        else if ($campos_trabalho[tipo_iniciacao] == "T"){
            $modalidade = "Pesquisa - Técnico";
            $arquivo = "Pesquisa_Tecnico_$campos_trabalho[codigo_trab].pdf";
        }
        else if ($campos_trabalho[tipo_iniciacao] == "L"){
            $modalidade = "Pesquisa - Lato Sensu";
            $arquivo = "Pesquisa_LatoSensu_$campos_trabalho[codigo_trab].pdf";
        }
        else if ($campos_trabalho[tipo_iniciacao] == "S") {
            $modalidade = "Pesquisa - Stricto Sensu";
            $arquivo = "Pesquisa_StrictoSensu_$campos_trabalho[codigo_trab].pdf";
        }
        //$modalidade = "Estudos Orientados";
        //$arquivo = "Estudos_Orientados_$campos_trabalho[codigo_trab].pdf";
    }
    else if ($campos_trabalho[modalidade] == "S")
    {
        if ($campos_trabalho[tipo_iniciacao] == "G") {
            $modalidade = "Iniciação Científica - Graduação";
            $arquivo = "Ic_Graduacao_$campos_trabalho[codigo_trab].pdf";
        }
        else if ($campos_trabalho[tipo_iniciacao] == "T"){
            $modalidade = "Iniciação Científica - Técnico";
            $arquivo = "Ic_Tecnico_$campos_trabalho[codigo_trab].pdf";
        }
        // else{
        //     $modalidade = "Iniciação Científica/Técnico";
        //     $arquivo = "ic_tecnico_$campos_trabalho[codigo_trab].pdf";
        // }
    }
    else if ($campos_trabalho[modalidade] == "0")
    {
        if ($campos_trabalho[tipo_projeto] == "Ext")
        {
            $modalidade = "Estudos Orientados - Extensão";
            $arquivo = "Estudos_Orientados_Extensao_$campos_trabalho[codigo_trab].pdf";
        }
        else if ($campos_trabalho[tipo_projeto] == "Edu")
        {
            $modalidade = "Estudos Orientados - Ensino";
            $arquivo = "Estudos_Orientados_Ensino_$campos_trabalho[codigo_trab].pdf";
        }
    }
    // Logo
    $image_file = "images/logo_simposio.png";
    $pdf->Image($image_file, 25, 7, 50, 25, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $pdf->SetFont('times', 'R', 9);
    //$imprimeCodTrab = $codigo;
    $header = <<<EOD
        <div style = 'margin:0%, 25%, 97%, 50%;'>
            <font align="center">
                <br>
                $campos_edicao[informacoes]  Simpósio de Ciência, 
                <br> 
                Inovação & Tecnologia – IF Sudeste MG - Campus Rio Pomba
                <br>
                Ciência para redução das desigualdades<br>
                $campos_edicao1[informacoes]. 
                <br> 
            </font>
        </div>
EOD;
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '4', $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
    $header = '';
    
    //$image_file = "images/logo_simposio.png";
    
                          // $x, $y,$w, $h, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
   // $pdf->Image($image_file, 156, 5, 50, 25, 'PNG', '', 'T', false, 500, '', false, false, 0, false, false, false);
    
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    // Set font
    $pdf->SetFont('times', 'R', 9);
    //pega os dados formatados
    $rodape = Autores($codigo, 1);

    // Page number
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = 15, $y = 245, $rodape, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '');
    $rodape = '';
//-------------------------------------------------------------------------------------------
    // if ($campos_trabalho[codigo_trab] == 72 || $campos_trabalho[codigo_trab] == 89 || $campos_trabalho[codigo_trab] == 107) {
    //     $titulo = $campos_trabalho[titulo];
    // } else {
        $titulo = strtr(strtoupper($campos_trabalho[titulo]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß");
    //}
    $arq_name = $titulo;
    $autores = Autores($codigo, 0) ;
    $autores = strtr(strtoupper($autores), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "À�?ÂÃÄÅÆÇÈÉÊËÌ�?Î�?�?ÑÒÓÔÕÖ×ØÙÜÚÞß");
// Set some content to print
    $html = <<<EOD
<font align="center" size="11"><b>$titulo</b></font>
EOD;
// Print text using writeHTMLCell
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '35', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

    $html = <<<EOD
<font align="justfy" size="9"><b>$autores</b></font>
EOD;
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '57', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
    
    //Codifico o texto para ir para o banco no arquivo 'form_sub_trabalhos.php', e aqui tenho que decodificar
    $resumo = htmlspecialchars_decode($campos_trabalho[resumo], ENT_QUOTES); //decodifica o texto
    
    echo $resumo;

    $html = <<<EOD
        <font align="justfy" size="10">
             
            $resumo
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            
            
        </font>
        

EOD;
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '62', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

    $html = <<<EOD
        <div>
            
            <font align="left" size="10">
                <br><br><br>
                <b>PALAVRAS CHAVE:</b> $campos_trabalho[palavra_chave]

            </font>
            
            <br><br>
            
            <font align="left" size="10">
                <b>Apoio(s):</b>
                
                $apoios
                <br><br>
            </font>
        </div>
EOD;
    $pdf->writeHTMLCell($w = '0', $h = '0', $x = '15', $y = '220', $html, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '', $autopadding = true);

    $html = '';
    $apoios = '';
    $resumo = '';
    $titulo = '';
    //$autores = '';

    $pdf->Output("trabalhos/$arquivo", "F");
    $quant++;
    copy("trabalhos/$arquivo", "trabalhos/$pasta/$arquivo");
    unlink("trabalhos/$arquivo");
}
//$s = $s + 16;
$s = $s + 5;

if ($s < $total) 
{
    echo '<meta http-equiv="refresh" content="0; URL=todos_pdf.php?sa=' . $codigo_sa . '&a=' . $area . '&s=' . $s . '" />';
}
else 
{
    $directory = "trabalhos/$pasta"; //diretorio para compactar
    $zipfile = "trabalhos/$pasta/$camposa[nome_sa].zip"; // nome do zip gerado

    $filenames = array();

    function browse($dir)
    {
        global $filenames;
        if ($handle = opendir($dir)) 
        {
            while (false !== ($file = readdir($handle))) 
            {
                if ($file != "." && $file != ".." && is_file($dir . '/' . $file)) 
                {
                    $filenames[] = $dir . '/' . $file;
                } 
                else if ($file != "." && $file != ".." && is_dir($dir . '/' . $file)) 
                {
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
    if ($zip->open($zipfile, ZIPARCHIVE::CREATE) !== TRUE) 
    {
        exit("Não pode abrir: <$zipfile>\n");
    }

    foreach ($filenames as $filename) 
    {
        $file = $filename;
        $arquivo = substr($file, -3);
        if ($arquivo == "pdf") 
        {
            $zip->addFile($filename);
        }
    }
    $zip->close();
    foreach (glob("trabalhos/$pasta/*.pdf") as $arq) 
    {
        unlink($arq);
    }

    // Enviando para o cliente fazer download
    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename='trabalhos/$pasta/$camposa[nome_sa].zip'");
    readfile("trabalhos/$pasta/$camposa[nome_sa].zip");
    exit(0);
}
mysql_close($conexao);
?>
