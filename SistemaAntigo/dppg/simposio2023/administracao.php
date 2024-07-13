Submissões<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    ?>
    <br>
    <center><font color="#FF0000" size="4px"><i>&Aacute;rea Administrativa</i></font></center><br>

    <table border="0" align="center" width="100%" cellspacing="0" cellpadding="4" bordercolor="#ccc">
        <tr>
            <td>
                <table border="0" width="100%" class="esquerda">
                    <tr align="center" bgcolor="#61C02D">
                        <td><font color="#FFFFFF"><b>&Aacute;rea de atua&ccedil;&atilde;o</b></font></td>
                        <td><font color="#FFFFFF"><b>Subeventos</b></font></td>
                        <td><font color="#FFFFFF"><b>Grande &Aacute;rea</b></font></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_cadastro_depto.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/add.png" border="0" width="10%">&nbsp;Cadastro</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_cadastro_subevento.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/add.png" border="0" width="10%">&nbsp;Cadastro</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_cadastro_grandearea.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/add.png" border="0" width="10%">&nbsp;Cadastro</a></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('mostra_depto.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/show.png" border="0" width="10%">&nbsp;Mostrar</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('mostra_subevento.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/show.png" border="0" width="10%">&nbsp;Mostrar</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('mostra_grandearea.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/show.png" border="0" width="10%">&nbsp;Mostrar</a></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_depto.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Alterar</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_subevento.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Alterar</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_grandearea.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Alterar</a></td>
                    </tr>

                    <tr class="linha">
                        <td>
                            <a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('#', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="" border="0" width="10%">

                            </a>
                        </td>

                        <td>
                            <a class="link" href="form_listar_participantes_sub_evento.php" target="_blank">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%" height="30px">
                                &nbsp;Listar participantes por subevento
                            </a>
                        </td>

                        <td>
                            <a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('#', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="" border="0" width="10%">

                            </a>
                        </td>
                    </tr>


                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_excluir_depto.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/delete.png" border="0" width="10%">&nbsp;Excluir</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_excluir_subevento.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/delete.png" border="0" width="10%">&nbsp;Excluir</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_excluir_grandearea.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/delete.png" border="0" width="10%">&nbsp;Excluir</a></td>
                    </tr>
                    <tr align="center" align="center" bgcolor="#61C02D">
                        <td><font color="#FFFFFF"><b>Subárea</b></font></td>
                        <td><font color="#FFFFFF"><b>Acervo</b></font></td>
                        <td><font color="#FFFFFF"><b>Alterar Datas</b></font></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_cadastro_subarea.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/add.png" border="0" width="10%">&nbsp;Cadastro</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_cadastro_acervo.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/add.png" border="0" width="10%">&nbsp;Cadastro</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_data_cadastro.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Cadastro</a></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('mostra_subarea.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/show.png" border="0" width="10%"> Mostrar</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_excluir_acervo.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/delete.png" border="0" width="10%">&nbsp;Excluir</a></td>
                        <!--<td><a  class="link" href="javascript:void(0)" onClick="MM_openBrWindow('form_selecionar_acervo.php', '', 'scrollbars=yes', width = 850, h<!--eight = 600, left = 0, top = 0);">&nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Alterar</a>&nbsp;</td>-->
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_data_inscricao.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Inscrição</a></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_subarea.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Alterar</a></td>
                        <td></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_data_certificado.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Certificado</a></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_excluir_subarea.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/delete.png" border="0" width="10%">&nbsp;Excluir</a></td>
                        <td></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_data_submissao.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Submissão</a></td>
                    </tr>
                    <tr class="linha">
                        <td></td>
                        <td></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_data_avaliacao.php', '', 'scrollbars=yes', width = 850, height = 500, left = 0, top = 0, bottom_margin = 1);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Prazo Avaliação</a></td>
                    </tr>
                    <tr class="linha">
                        <td></td>
                        <td></td>
                        <td>
                            <a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_data_nota_avaliacao_externa.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Notas avaliação externa
                            </a>
                        </td>
                    </tr>
                    <tr align="center" bgcolor="#61C02D">
                        <td><font color="#FFFFFF"><b>Participantes</b></font></td>
                        <td><font color="#FFFFFF"><b>Cadastrar Avaliadores</b></font></td>
                        <td><font color="#FFFFFF"><b>Alterar Permissões</b></font></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_cadastro_profsa.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/add.png" border="0" width="10%">&nbsp;Cadastro</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onclick="MM_openBrWindow('form_cad_avaliadores.php', '', 'scrollbars=yes', width = 750, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/add.png" border="0" width="10%">&nbsp;Cadastrar</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onclick="MM_openBrWindow('form_cadastro_permissao.php', '', 'scrollbars=yes', width = 850, height = 500, left = 0, top = 0);">
                                &nbsp;<img src="images/add.png" border="0" width="10%">&nbsp;Adicionar</a></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_excluir_profsa.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/delete.png" border="0" width="10%">&nbsp;Excluir</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onclick="MM_openBrWindow('form_excluir_avaliadores.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/delete.png" border="0" width="10%">&nbsp;Excluir</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onclick="MM_openBrWindow('form_excluir_permissao.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/delete.png" border="0" width="10%">&nbsp;Retirar</a></td>
                    </tr>
                    
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('gerar_codigo_barra.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/barcode.png" border="0" width="10%">&nbsp;Código de Barra</a>
                        </td>
                        <td><a class="link" href="javascript:void(0)"
                               onclick="MM_openBrWindow('mostra_avaliadores.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/show.png" border="0" width="10%">&nbsp;Visualizar</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onclick="MM_openBrWindow('mostra_permissoes.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/show.png" border="0" width="10%">&nbsp;Visualizar</a></td>
                    </tr>
                    
                    <tr class="linha">
                         <td>
                             <a class="link" href="javascript:void(0)" onClick="MM_openBrWindow('geraListaInscritos.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                               
                                &nbsp;<img src="images/show.png" border="0" width="10%">&nbsp;Lista de participantes
                                
                            </a>
                        </td>
                        
                        <td>
                            <a class="link" href="javascript:void(0)"
                               onclick="MM_openBrWindow('', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;&nbsp;
                            </a>
                        </td>
                        
                        <td>
                            <a class="link" href="javascript:void(0)"
                               onclick="MM_openBrWindow('', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;&nbsp;
                            </a>
                        </td>
                    </tr>
                    
                    <tr align="center" bgcolor="#61C02D">
                        <td colspan="3"><font color="#FFFFFF"><b>Alterar Estruturas</b></font></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_topo.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Topo</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_banner.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Banner</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_apresentacao.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Apresentação</a></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_menu.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Menu</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_arquivo.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Formulários</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_corpoEditorial.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Corpo Editorial</a>
                        </td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_conteudo.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Conteúdo</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_aviso.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/aviso.png" border="0" width="10%">&nbsp;Aviso</a></td>
                        <td>
                            <a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_expediente.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Expediente</a>
                        </td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_rodape.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Rodapé</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_normas.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/aviso.png" border="0" width="10%">&nbsp;Normas</a></td>
                        <td>
                            <a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_fluxograma.php', '', 'scrollbars=yes', width = 1200, height = 800, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Fluxograma</a>
                        </td>
                    </tr>
                    <tr class="linha">
                        <td>

                        </td>
                        <td>
                            <a class="link" href="form_listar_destinatarios_email.php" target="_blank">
                                &nbsp;<img src="images/email.png" border="0" width="10%">
                                &nbsp;Mensagens de e-mail
                            </a>
                        </td>
                        <td>
                            <a class="link" href="form_alterar_regulamento.php" target="_blank">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">
                                Regulamento
                            </a>
                        </td>
                    </tr>
                    <tr class="linha">
                        <td></td>
                        <td></td>
                        <td>
                            <a class="link" href="form_alterar_programacao.php" target="_blank">
                                <img src="images/alterar.gif" border="0" width="10%"> Programação
                            </a>
                        </td>
                    </tr>
                    <tr class="linha">
                        <td></td>
                        <td></td>
                        <td>
                            <a class="link" href="form_alterar_modelo_poster.php" target="_blank">
                                <img src="images/alterar.gif" border="0" width="10%"> Modelo de Pôster
                            </a>
                        </td>
                    </tr>


                    <tr align="center" bgcolor="#61C02D">
                        <td><font color="#FFFFFF"><b>Alterar Certificado</b></font></td>
                        <td><font color="#FFFFFF"><b>Sistema</b></font></td>
                        <td><font color="#FFFFFF"><b>Gerar PDF dos Trabalhos</b></font></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_topo_certificado.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Topo</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_backup.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/admin.png" border="0" width="10%">&nbsp;Backup</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_pdf_trabalhos.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/pdf.png" border="0" width="10%">&nbsp;Gerar PDF por Sub-&Aacute;rea</a>
                        </td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_assinatura.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Assinatura 1</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_recuperar.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/admin.png" border="0" width="10%">&nbsp;Recuperar</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onclick="MM_openBrWindow('form_pdf_iniciacao.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/pdf.png" border="0" width="10%">&nbsp;Gerar PDF por Tipo</a></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_logo_assinatura.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Assinatura 2 / Logo</a>
                        </td>
                        <!--<td><a  class="link" href="javascript:void(0)" onClick="MM_openBrWindow('form_limpar_BD.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">&nbsp;<img src="images/admin.png" border="0" width="10%">&nbsp;Limpar BD</a></td>-->
                        <td>&nbsp;
                            <!--<a  class="link" href="gerar_pdf_cd.php" target="_blanck">&nbsp;<img src="images/pdf.png" border="0" width="10%">&nbsp;Gerar PDF para CD</a>--></td>
                        <td></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_conteudo_certificado.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Período / Edição </a>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="window.open('alterarPrimeiroAutor.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Alterar primeiro autor </a>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr align="center" bgcolor="#61C02D">
                        <td><font color="#FFFFFF"><b>Submissões</b></font></td>
                        <td><font color="#FFFFFF"><b>Validar Certificados</b></font></td>

                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_adicionar_notas.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/add.png" border="0" width="10%">&nbsp;Adicionar Notas das
                                Apresentações&nbsp;</a></td>
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_validar_certificado.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/show.png" border="0" width="10%">&nbsp;Verificar Validação&nbsp;
                            </a></td>

                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_alterar_notas.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Editar Notas das
                                Apresentações&nbsp;</a></td>
                        <td>&nbsp;
                            <!--a  class="link" href="javascript:void(0)" onClick="MM_openBrWindow('form_visualizr_validado.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">&nbsp;<img src="images/show.png" border="0" width="10%">&nbsp;Certificados Validados&nbsp;</a--></td>

                    </tr>
                    <tr class="linha">
                        <td><a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('form_visualizar_notas.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/show.png" border="0" width="10%">&nbsp;Visualizar Notas das
                                Apresentações&nbsp;</a></td>
                        <td></td>

                    </tr>
                    <tr class="linha">
                        <td>
                            <a class="link" href="javascript:void(0)"
                               onClick="MM_openBrWindow('definir_tipo_apresentacao.php', '', 'scrollbars=yes', width = 850, height = 600, left = 0, top = 0);">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Definir apresentações orais/pôster
                            &nbsp;</a>
                        </td>
                        <td></td>

                    </tr>

                    <tr class="linha">
                        <td>
                            <a class="link" href="form_alterar_status_submissao.php" target = "_blank">
                                &nbsp;<img src="images/alterar.gif" border="0" width="10%">&nbsp;Alterar status submissão
                                &nbsp;</a>
                        </td>
                        <td></td>

                    </tr>

                    <tr class="linha">
                        <td></td>
                        <td></td>

                    </tr>
                    <tr class="linha">
                        <td></td>
                        <td></td>


                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--<center><i>&nbsp; <font color="#FF0000">*</font> A. A. P. = �?rea de Atuação dos Professores</i></center>-->
    <br><br>
<?php
}
?>
