<?php

session_start();

header("Content-Type: text/html; charset=utf-8", true);


if ($_SESSION[logado_simposio_2021]) {
  include("includes/config.php");
  include("funcao.php");

    /*Função que transforma minutos em horas*/
    function m2h($mins)
    {
        // Se os minutos estiverem negativos
        if ($mins < 0)
            $min = abs($mins);
        else
            $min = $mins;
        // Arredonda a hora
        $h = floor($min / 60);
        $m = ($min - ($h * 60)) / 100;
        $horas = $h + $m;
        // Matemática da quinta série
        // Detalhe: Aqui também pode se usar o abs()
        if ($mins < 0)
            $horas *= -1;
        // Separa a hora dos minutos
        $sep = explode('.', $horas);
        $h = $sep[0];
        if (empty($sep[1]))
            $sep[1] = 00;
        $m = $sep[1];
        // Aqui um pequeno artifício pra colocar um zero no final
        if (strlen($m) < 2)
            $m = $m . 0;

        if ($m == 0)
            return sprintf('%2d', $h) . " horas";

        if ($h < 1 && $m > 0)
            return sprintf('%2d', $m) . " minutos";

        if($h == 1 && $m > 0)
            return sprintf('%2d', $h) . " hora e " . sprintf('%2d', $m) . " minutos";

        if($h == 1 && $m <= 0)
            return sprintf('%2d', $h) . " hora";

        return sprintf('%2d', $h) . " horas e " . sprintf('%2d', $m) . " minutos";
    }

  $tipo = "simposio";

  $sql_data = "select data_inicio from formularios where codigo_formulario = '7'";
  $resultado_data = mysql_query($sql_data);
  $campos_data = mysql_fetch_array($resultado_data);

  $data_inicio = datadobanco($campos_data[data_inicio]);
  $data_fim = datadobanco($campos_data[data_fim]);

  $data = $data_inicio;
  $data_i = datasemcaracter($data_inicio);

  $sqlMinutosTotais = "SELECT sub_eventos.duracao FROM sub_eventos INNER JOIN itens_inscricao ON sub_eventos.codigo_sub_evento = itens_inscricao.codigo_sub_evento AND itens_inscricao.cpf = $_SESSION[cpf] and itens_inscricao.presenca = 'S'";
  $resultadoMinutosTotais = mysql_query($sqlMinutosTotais);

   while($dadosMinutos = mysql_fetch_array($resultadoMinutosTotais))
   {
       $minutosTotais += $dadosMinutos[duracao];
   }


  if ((date("Ymd") >= $data_i)) 
  {

//    $sql_texto_edicao = "select informacoes from conteudo where codigo_conteudo = '10'";
//    $resultado_edicao = mysql_query($sql_texto_edicao);
//    $campos_edicao = mysql_fetch_array($resultado_edicao);
//
//    $sql_texto_periodo = "select informacoes from conteudo where codigo_conteudo = '11'";
//    $resultado_periodo = mysql_query($sql_texto_periodo);
//    $campos_periodo = mysql_fetch_array($resultado_periodo);

    $sql = "select participantes.nome as nomep, sub_eventos.nome_sub_evento, sub_eventos.descricao as titulo, sub_eventos.duracao from participantes
           join (inscricao join (itens_inscricao join sub_eventos on itens_inscricao.codigo_sub_evento=sub_eventos.codigo_sub_evento) on inscricao.cpf=itens_inscricao.cpf)
           on participantes.cpf=itens_inscricao.cpf where 
           itens_inscricao.presenca='S' and inscricao.pagamento='S' and participantes.cpf='$_SESSION[cpf]'";

    //Nome participante, nome do sub evento, titulo e duracao da participacao nos eventos
    $resultado = mysql_query($sql);
    $campos = mysql_fetch_array($resultado);
    $quantidadeEventosInscrito = mysql_num_rows($resultado);
    $horasTotais = m2h($minutosTotais);

    $sqlSubEnventos = "SELECT * FROM sub_eventos";
    $subEventosResult = mysql_query($sqlSubEnventos);
    $camposSubEventos = mysql_fetch_array($subEventosResult);
        
    //Participante codigo do sub evento e descricao do subevento inscrito
    $codigoEventoParticipou =
    "SELECT sub_eventos.codigo_sub_evento, sub_eventos.duracao, sub_eventos.data, sub_eventos.nome_sub_evento, sub_eventos.descricao
     FROM sub_eventos
     INNER JOIN itens_inscricao ON itens_inscricao.codigo_sub_evento = sub_eventos.codigo_sub_evento 
     AND itens_inscricao.cpf = '$_SESSION[cpf]' 
     AND itens_inscricao.presenca = 'S'
     order by codigo_sub_evento ASC";

    $resultadoEvento = mysql_query($codigoEventoParticipou);

      $contadorEvento = 0;
      $array = array();

      //Guarda os dados de cada evento que o participante esteve
      while($dadosEvento = mysql_fetch_array($resultadoEvento))
      {
          $array[$contadorEvento] = date('d/m/Y',  strtotime($dadosEvento[data])) . " - " . $dadosEvento[descricao] . ", " . " duração de " . " $dadosEvento[duracao]" . " minutos" . "<br> <hr>";
          $contadorEvento++;
      }

      //Coloco os dados em uma variável
      foreach ($array as $item)
          $descricaoEventos .= $item;

    
    //Se o participante participou de mais de um sub_evento o certificado sai com esta palavra no plural, senao, no singular
    if(mysql_num_rows($resultadoEvento) > 1)
    {
        $palavra = "Programa&ccedil;&otilde;es";
    }
    else
    {
        $palavra = "Programa&ccedil;&atilde;o";
    }

    //Se o participante estiver inscrito em menos de um evento
    if (mysql_num_rows($resultado) < 1)
    {
      echo "<br><br><br><center><b>O certificado não foi gerado, pois não consta presença nos eventos que você se inscreveu ou não foi efetuado o pagamento para participar do Simpósio.</center></b>";
    }
    else 
    {
      $sql_topo = "select topo from conteudo where codigo_conteudo = '7'";
      $resultado_topo = mysql_query($sql_topo);
      $campos_topo = mysql_fetch_array($resultado_topo);

//      $sql1 = "SELECT (sum(duracao)/60) as duracaototal FROM itens_inscricao i, sub_eventos se where i.codigo_sub_evento = se.codigo_sub_evento and presenca ='S' and cpf='$_SESSION[cpf]'";
//      $resultado1 = mysql_query($sql1);
//      $campos1 = mysql_fetch_array($resultado1);

//      $tmp = $campos1[duracaototal];
//      $duracao = round($campos1[duracaototal]);
//      $tmp = $tmp - $duracao;

//      $duracao = $duracao . "h" . round($tmp * 60) . "min";

//      $texto = "participou do $campos_edicao[informacoes] Simpósio de Ciência, Inovação & Tecnologia - IF Sudeste MG - Campus Rio Pomba com carga horária de $duracao.";


////
//      $sql_assinatura1 = "select assinatura, cargo, imagem_assinatura from conteudo where codigo_conteudo = '8'";
//      $resultado_assinatura1 = mysql_query($sql_assinatura1);
//      $campos_assinatura1 = mysql_fetch_array($resultado_assinatura1);
////
//
////
//      $sql_assinatura2 = "select assinatura, cargo, imagem_assinatura from conteudo where codigo_conteudo = '9'";
//      $resultado_assinatura2 = mysql_query($sql_assinatura2);
//      $campos_assinatura2 = mysql_fetch_array($resultado_assinatura2);
//

      include './valida_certificado.php';

        $dizeres = "          
        Certificamos que $campos[nomep] participou do XV Simpósio de
        Ciência, Inovação e Tecnologia do Campus Rio Pomba, realizado entre os dias
        25 e 26 de outubro de 2023, com carga horária de $horasTotais.";
        
        $numeroCaracteresEvento = (strlen($primeiroDia) + strlen($segundoDia) + strlen($terceiroDia));
        $numeroCaracteresDizeres = strlen($dizeres);
        
        //Ajusta o tamanho da fonte de acordo com o numero de caracteres
        if($numeroCaracteresEvento >= 2100 && $numeroCaracteresEvento < 2200)
        {
            $tamanhoFonte = 14;
        }
        
        if($numeroCaracteresDizeres >= 400 && $numeroCaracteresDizeres < 600)
        {
            $tamanhoFonte = 25;
        }

        if($numeroCaracteresDizeres < 300)
        {
            $tamanhoFonte = 25;
        }


        /*Se houverem muitos eventos no certificado, diminua a fonte*/
        if($contadorEvento <= 9) //Se participou de até 9 eventos
            $tamanhoFonteEventos = '14px';
        else if($contadorEvento > 9 and $contadorEvento <= 20) // Se participou de 10 a 20 eventos
            $tamanhoFonteEventos = '11px';
        else
            $tamanhoFonteEventos = '9px';


        $htmlDizeres = "
            
                    <!DOCTYPE html>
                    <html>
                    
                    <head>
                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    </head>
                    
                    <body>
                    
                        <!--Esta div contem todas as divs do certificado -->
                        <div id = 'container' style='position: absolute; left: 0; right: 0; top: 0; bottom: 0; z-index: 0;'>
                            
                            <!--Carregamento da marca d'agua no pdf-->
                             <img style=' position:fixed; width: 100% !important; height: 100% !important;  margin: 0 !important;' src='images/b2certificado.jpg'; />
                            
                            <!--Palavra 'Certificado'-->
                            <div style='position: fixed; width: 250px;  margin-top: -540px; z-index: 0; margin-left:500px; background-color:orange;'>
                            
                                <h1> <b> Certificado </b> </h1> 
                                
                            </div>
                            
                            <!--Resto dos dizeres do certificado-->
                            <div style ='width:1000px;  min-height:500px;  margin-top: 52px; margin-left:60px; margin-bottom:5px; font-size:$tamanhoFonte; text-align:justify;'>
                              $dizeres
                            </div>
                            
                            <div style ='width: 970px; height: 120px; margin: 40px 0px 0px 60px;'>
                                <div style='text-align: center; margin-left: 100px; width:300px; height:100px; float: left;'>
                                   <img src='images/assinaturaLarissa.png' width='250' height='80'><br>
                                   <b>LARISSA MATTOS TREVIZANO</b><br>
                                   Diretora de Pesquisa e Pós-graduação
                            </div>
                            <div style='text-align: center;  margin-buttom: 10px ; margin-left: 160px; margin-right: 50px; width:300px; height:100px; float:left;'>
                               <img src='images/assinaturaFranciano.png' width='200' height='80'><br>
                                  <b>FRANCIANO BENEVENUTO CAETANO</b><br>
                                  Gerente de Pesquisa e Pós-graduação
                              </div>
                            </div>
                            
                            <!--Cidade e data de expedicao-->
                            <div style ='position: fixed; margin-top: 15px; margin-left:-30px; font-size:23px; text-align:center;'>
                                Rio Pomba - MG, 26 de outubro de 2023
                            </div>
                            
                            <!--Imortante para formatacao do pdf-->
                            <div sytle = 'clear:both;'>                                
                                <br>                                                      
                            </div>
                            
                           <!--Codigo de validacao -->
                            <div style =' font-family: arial; font-size: 13px; width: 800px;  position: fixed; margin: 20px auto auto 120px; font-size:21px; text-align:center;'>
                                <font style='font-family: arial; font-size: 13px' >
                                    C&oacute;digo de Valida&ccedil;&atilde;o: " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . "
                                    <br> 
                                    Autenticidade em: https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2023/simposio.php?arquivo2=form_validar_certificado.php
                                </font>
                                
                                
                            </div>  
                            
                        </div>

                    </body>

                </html>
        ";
        
        
        $htmlEventos = "
            
                    <!DOCTYPE html>
                    <html>
                    
                    <head>
                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                    </head>
                    
                    <body>

                                                                      
                            <!--Resto dos dizeres do certificado-->
                            <div style ='width:1080px; bottom: 0px;  margin-top: 15px; margin-left:20px; margin-bottom:5px; font-size: $tamanhoFonteEventos; text-align:justify;' >
                                $descricaoEventos     
                            </div>   
                            
                          <!--Codigo de validacao -->
                         <div style=' position:absolute; bottom:0; width:100%; margin:110px 0px 0px 50px; padding:0;'>
                            <font style='font-family: arial; font-size: 13px' >
                                C&oacute;digo de Valida&ccedil;&atilde;o: " . strip_tags(str_pad($codigoCertificado, 11, "0", STR_PAD_LEFT)) . " - Autenticidade em: http://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2023/simposio.php?arquivo2=form_validar_certificado.php
                            </font>                                                   
                         </div>                      
                    </body>
                    
                                                


                </html>";
         
        
  include("./MPDF56/mpdf.php");
  $html = utf8_encode($html);
  $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15);
  $mpdf->SetDisplayMode('fullpage', 'continuous');
  $mpdf->writeHTML($htmlDizeres);
  $mpdf->AddPage();
  $mpdf->writeHTML($htmlEventos);
  $mpdf->Output('certificadoGeral.pdf', 'I');
  
//  $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15);
//  $mpdf->SetDisplayMode('fullpage', 'single');
//  $mpdf->writeHTML($html);
//  
//  $mpdf = new mPDF('c', 'A4-L', '', '', 10, 10, 10, 10, 20, 15);
//  $mpdf->SetDisplayMode('fullpage', 'single');
//  $mpdf->writeHTML($htmlEventos);
//  $mpdf->Output('certificado.pdf', 'I');
  
  exit;
  mysql_close($conexao);
    }
  }

  if ((date("Ymd") < $data_i))
    echo '<center><font color="#FF0000"><b>O certificado poderá ser gerado a partir da data ' . $data . '.</b></font><center>';

  mysql_close($conexao);
}
?>