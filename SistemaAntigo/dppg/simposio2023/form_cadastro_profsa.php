<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Cadastro Participante </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/validar.js" type="text/javascript"></script>
        <script type="text/javascript">//Script que mostará a combo ou não
            function mostrar_combo() {
                if (document.getElementById('part').value == "3") {
                    document.getElementById('docente').style.display = '';
                    document.getElementById('docente01').style.display = '';
                    document.getElementById('docente02').style.display = '';
                    document.getElementById('docente03').style.display = '';
                    document.getElementById('docente04').style.display = 'none';
                } else {
                    document.getElementById('docente').style.display = 'none';
                    document.getElementById('docente01').style.display = 'none';
                    document.getElementById('docente02').style.display = 'none';
                    document.getElementById('docente03').style.display = 'none';
                    document.getElementById('docente04').style.display = '';
                }
            }
        </script>
    </head>
    <body>
    <div id="conteudo3"><br>
        <center><b>Cadastro Participante</b></center>
        <br>
        <center>
            <form name="form_insc" method="POST" onsubmit="javascript: return checkcontatos()" action="inscricao1.php">
                <table border="0" class="esquerda">
                    <tr>
                        <td>CPF:</td>
                        <td><input type="text" name="cpf" size="11" maxlength="11"><font color="#FF0000"> *</font>
                            Somente números
                        </td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td><input type="text" name="nome" size="40" maxlength="45"><font color="#FF0000"> *</font></td>
                    </tr>
                    <tr>
                        <td>Telefone:</td>
                        <td><input type="text" name="telefone" size="10" maxlength="10"><font color="#FF0000"> *</font>
                            Somente números
                        </td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td><input type="text" name="email" size="40" maxlength="45"><font color="#FF0000"> *</font>
                        </td>
                    </tr>
                    <tr>
                        <td>Tipo de Participante:</td>
                        <td><?php include('combo_participante.php'); ?></td>
                    </tr>
                    <tr id="docente04" style="display: none;">
                        <td>Tipo de Iniciação Científica</td>
                        <td><?php include('combo_iniciacao.php'); ?><font color="#FF0000"> *</font></td>
                    </tr>
                    <tr id="docente" style="display: none;">
                        <td>Sub Área</td>
                        <td>
                            <?php include('combo_subarea.php') ?><!--Mosta a combo de subáre semppre a que a opção docente é escolhida-->
                        </td>
                    </tr>
                    <tr>
                        <td>Curso:</td>
                        <td><?php include('combo_cursos.php'); ?></td>
                    </tr>
                    <tr id="docente01" style="display: none;">
                        <td>Área de Atuação:</td>
                        <td>
                            <select size="1" name="profdepto">
                                <option value='0'>-----</option>
                                <?php
                                $sql = "select * from departamento";
                                $resultado = mysql_query($sql);
                                while ($campos = mysql_fetch_array($resultado)) {
                                    echo "<option value='$campos[codigo_depto]'> $campos[nome_depto]</option>";
                                }
                                ?>
                            </select><font color="#FF0000"> *</font>
                        </td>
                    </tr>
                    <tr id="docente02" style="display: none;">
                        <td>Linha de Pesquisa:</td>
                        <td><input type="text" name="pesquisa" size="40" maxlength="100"></td>
                    </tr>
                    <tr id="docente03" style="display: none;">
                        <td>Visitante:</td>
                        <td>
                            <input type="radio" name="visitante" value="1">Sim
                            <input type="radio" name="visitante" value="0">Não<font color="#FF0000"> *</font>
                        </td>
                    </tr>
                    <tr>
                        <td>Senha:</td>
                        <td><input type="password" name="senha" size="10" maxlength="10"><font color="#FF0000"> *</font>
                            No máximo 10 caracteres
                        </td>
                    </tr>
                    <tr>
                        <td>Confirma Senha:</td>
                        <td><input type="password" name="confirma_senha" size="10" maxlength="10"><font color="#FF0000">
                                *</font> No máximo 10 caracteres
                        </td>
                    </tr>
                    <!--              <tr>
                                    <td>Iniciação Científica e Tecnológica:</td>
                                    <td><input type="radio" name="ic" value="S">Sim
                                      <input type="radio" name="ic" value="N">Não
                                    </td>
                                  </tr>-->
                    <tr>
                        <td colspan="2"><br><b><font size="3" color="#FF0000">* </font>Campo de preenchimento
                                obrigatório</b></td>
                    </tr>

                    <tr>
                        <!--<input type="hidden" name="arquivo2" value="inscricao.php">-->
                    </tr>
                </table>
                <br>
                <input type="submit" value="Ok">&nbsp;<input type="reset" value="Limpar">
            </form>
            <br>
            <center>


    </div>

    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>