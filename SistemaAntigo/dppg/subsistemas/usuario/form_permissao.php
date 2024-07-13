<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
      <!-- <script src="js/jquery-1.3.2.min.js" type="text/javascript"></script> -->

    <script type="text/javascript">
      $(document).ready(function () {
        $('#combo_nivel').change(function () {
          $('#combo_sistema').load('combo_nivel.php?codigo_grupo=' + $('#combo_nivel').val());
//alert('subsistemas/usuario/combo_nivel.php?codigo_grupo=' + $('#combo_nivel').val());
        });
      });

    </script> 
  </head>

  <body>

    <?php
    session_start();

    if ($_SESSION['logado_site_dppg']) {
      if (($pesquisa_adm) or ( $pesquisa_subadm)) {
        include("includes/config2.php");

        $cpf_logado = $_SESSION['cpf'];
        ?>
        <script src="subsistemas/usuario/valida_forms/valida_permissao.js" type="text/javascript"></script>
        <center><br><h2>Cadastrar Permissões aos Usuários</h2><br>
              <form name="form_permissao" method="POST" onsubmit="javascript: return checkpermissao()" action="index.php">
                <table border="0" align=center>
                  <tr>
                    <td height=30><b>Nome usuário</b></td>
                    <td>
                      <select name=combo_nome style="width:200px">
                        <?php
                        //seleciona usuarios excluindo o administrador geral - ADM logado 
                        //seleciona usuarios excluindo o administrador geral e sub administrador - SUB AMD logado
                        if ($pesquisa_adm) {
                          $sqlUm = mysql_query("select * from usuarios");
                        } elseif ($pesquisa_subadm) {
                          $sqlUm = mysql_query("select * from usuarios where nome not in (select distinct nome from usuarios u, participa_grupos pg where u.cpf=pg.cpf and codigo_grupo=1) and cpf!=$cpf_logado");
                        }
                        echo "<option selected value=0>Selecione uma opção</option>";
                        while ($camposUm = mysql_fetch_array($sqlUm)) {
                          echo "<option value=$camposUm[cpf]>$camposUm[nome]</option>";
                        }
                        ?>
                      </select>		
                      <font color="#FF0000"> *</font>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=2 height=30><b>Nivel que o usuario terá acesso</b></td>			
                  </tr>
                  <tr>
                    <td><b>Nível Usuário</b></td>
                    <td>
                      <select name="combo_nivel" id="combo_nivel" style="width:200px">
                        <?php
                        if ($pesquisa_adm) {
                          $s = "select * from grupo_usuario";
                          $sqlDois = mysql_query("select * from grupo_usuario");
                        } elseif ($pesquisa_subadm) {
                          $s = "select * from grupo_usuario where codigo_grupo!=1 and codigo_grupo!=2";
                          $sqlDois = mysql_query("select * from grupo_usuario where codigo_grupo!=1 and codigo_grupo!=2");
                        }
                        echo "<option selected value=0>Selecione uma opção</option>";
                        while ($camposDois = mysql_fetch_array($sqlDois)) {
                          echo "<option value=$camposDois[codigo_grupo]>$camposDois[nome_grupo]</option>";
                        }
                        ?>
                      </select>

                      <font color="#FF0000"> *</font>
                    </td>
                  </tr>
                  <tr>
                    <td colspan=2 height=30><b>Subsitema que o usuario terá acesso</b></td>			
                  </tr>
                  <tr>
                    <td><b>Subsistema</b></td>
                    <td>

                      <select name="combo_sistema" id="combo_sistema" style="width:200px">';
                        <?php
                        /* if($pesquisa_adm)
                          {
                          $sqlTres = mysql_query("select distinct nome_menu from menu_sistemas where codigo_menu>1");
                          }
                          elseif($pesquisa_subadm) {
                          $sqlTres = mysql_query("select distinct nome_menu from menu_sistemas s, participa_grupos p where s.codigo_menu=p.codigo_sistema and cpf='$cpf_logado' and codigo_grupo='2'");
                          }
                         */
                        echo '<option selected value="0">Selecione uma opção</option>';

                        echo '				   	
					   	</select>
					   				   	
					   <font color="#FF0000"> *</font>
					   </td>
					</tr>
					
				</table>
		  				<input type="hidden" name="arquivo" value="subsistemas/usuario/cadastrar_permissao.php">
						<br>
						<input type="submit" value="Enviar" class="submitVerde"><input type="reset" value="Limpar" class="submitVerde"><a href="index.php?arquivo=subsistemas/usuario/listar_ger_permissoes.php"><input type="button" value="Voltar"></a>
			</form>
			
			<br></center>';
                      }
                      mysql_close($conexao);
                    }
                    ?>
