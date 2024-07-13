<?php
session_start();


header('Content-Type: text/html; charset=utf-8');

if ($_SESSION[logado_simposio_2021]) {
    include('includes/config.php');

    /*
    $sql = 
      "select participantes.nome, sub_eventos.nome_sub_evento, sub_eventos.data, sub_eventos.horario, sub_eventos.titulo, sub_eventos.local,
	inscricao.cpf, conteudo.topo from sub_eventos, inscricao, itens_inscricao, participantes, conteudo where (inscricao.cpf='$_SESSION[cpf]') and 
	(inscricao.cpf =  itens_inscricao.cpf) and (itens_inscricao.codigo_sub_evento=sub_eventos.codigo_sub_evento) and  
	participantes.cpf='$_SESSION[cpf]' and conteudo.codigo_conteudo = 1 order by sub_eventos.data,sub_eventos.horario";
    */

    $sql = "select participantes.nome, sub_eventos.nome_sub_evento, sub_eventos.data, sub_eventos.horario, sub_eventos.titulo, sub_eventos.local,
	participantes.cpf, conteudo.topo from sub_eventos, itens_inscricao, participantes, conteudo where (participantes.cpf='$_SESSION[cpf]') and 
	(participantes.cpf =  itens_inscricao.cpf) and (itens_inscricao.codigo_sub_evento=sub_eventos.codigo_sub_evento) and  
	participantes.cpf='$_SESSION[cpf]' and conteudo.codigo_conteudo = 1 order by sub_eventos.data,sub_eventos.horario";
    
//    $sql = "select distinct participantes.nome, participantes.cpf, sub_eventos.nome_sub_evento, sub_eventos.data, sub_eventos.horario, sub_eventos.titulo, sub_eventos.local
//	    from sub_eventos, inscricao, itens_inscricao, participantes where (participantes.cpf = '$_SESSION[cpf]') and
//           (inscricao.cpf =  itens_inscricao.cpf) and (itens_inscricao.codigo_sub_evento=sub_eventos.codigo_sub_evento) and
//	    participantes.cpf = '$_SESSION[cpf]' order by sub_eventos.data,sub_eventos.horario";
				

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) < 1)
        echo '<center><br><b>Para o comprovante ser gerado é necessário se inscrever<br>
			 no mínimo em um evento</b><br><br></center>';
    else {
        $controle = 0;
        echo '<table border="0" bgcolor="#309F41" cellpadding="0" cellspacing="1" width="80%" align="center">';

        while ($campos = mysql_fetch_array($resultado)) {
            if ($controle == 0) {
                echo "<tr bgcolor='#FFFFFF'>
							<td>
								<center><img src='images/$campos[topo]' width='100%' height='180' border='0' alt='' align='center'></center>
								<br><center><b><h3>Comprovante de Inscrição</h3></b></center>
								<center><b>CPF:</b>  $campos[cpf] &nbsp;&nbsp;&nbsp; <b>Nome:</b>  $campos[nome] </center><br>
								<!--center>Credenciamento dia 19/11/2011 de 7:00 às 8:00 horas e 18:00 às 19:00 horas<br></center-->
							</td>
					    </tr>";

                $nome = $campos[nome];
                $cpf = $campos[cpf];
            }

            $controle = 1;
            
            echo '<tr bgcolor="#FFFFFF">
                  <td style="padding-left: 20px;">
                  <br>
                  <b style="color:#006400 ">Evento: </b>' . $campos[nome_sub_evento] . '<br><br>' .
                ' <b style="color: #006400">Título:</b> ' . $campos[titulo] .  '<br><br>'.
                ' <b style="color: #006400"p>Data:</b> ' . $campos[data] . '<br><br>' .
                ' <b style="color: #006400">Horário:</b> ' . $campos[horario] . '<br><br>' .
                ' <b style="color: #006400">Local:</b> ' . $campos[local] .
                ' <br><br><br><!--b>Assinatura Comissão: _________________________________________</b--></tr>';
        }
        echo '<!--tr bgcolor="#FFFFFF"><td><b>Comprovante de Pagamento 1ª via do participante<br><br><br>
					Assinatura Setor:</b></td></tr></table>';
        echo '<b><font size="3" color="#FF0000">ATENÇÃO</font></b><br>
					A confirmação das inscrições será feita por boleto bancário que segue no link abaixo:
					<br> 
					http://conveniar.fundeprp.org.br/eventos/Forms/Servicos/EventoDados.aspx?CodEvento=7<br>
					<br>';

        echo '<img src="images/tesoura.gif" width="640" height="21" border="0" alt="">';
        echo '<table border="0" bgcolor="#000000" cellpadding="0" cellspacing="1" width="80%">
					<tr bgcolor="#FFFFFF"><td><b>Comprovante de Pagamento 2ª via do setor DPPG<br--><br><br>
					</td></tr>';
        echo '</table><br>';
        echo '<a href="javaScript:window.print()"><img src="images/impressora.png" width="32" height="32" border="0" alt="" align="middle"> Imprimir</a>';
    }
    mysql_close($conexao);
}



?>
