<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
      <!-- <script src="js/jquery-1.3.2.min.js" type="text/javascript"></script> -->

    <script type="text/javascript">
      $(document).ready(function () {
        $('#combo_categoria').change(function () {
          $('#posicao').load('gerencia_permissoes.php?codigo=' + $('#combo_categoria').val());

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
        $cor_tr = '#7CCD7C';
        $cor_td1 = '#E0EEE0';
        $cor_td2 = '#C1FFC1';

        echo '<center><br><br><b>&nbsp&nbsp Gerência de Permissões de Usuários</b><br><br>';

        if ($pesquisa_adm) {
          $sqlADM = mysql_query("select * from usuarios u, participa_grupos pg where u.cpf=pg.cpf and codigo_grupo=1");
//          $cpfADM = mysql_fetch_array($sqlADM);
          $a = "";
          while ($cpfADM = mysql_fetch_array($sqlADM)) {
            if ($a == "") {
              $a = "p.cpf!='$cpfADM[cpf]'";
            } else {
              $a = $a . "and p.cpf!='$cpfADM[cpf]'";
            }
          }
          //não lista permissoes relacionadas ao adm
          $sql = "select * from usuarios u, participa_grupos p where u.cpf=p.cpf order by nome asc";
//          $sql = "select * from usuarios u, participa_grupos p where u.cpf=p.cpf and p.cpf!='$cpfADM[cpf]' order by nome asc";

          $resultado = mysql_query($sql);
          echo "<table border=0 width='98%' id='borda2'>
			<tr align=center bgcolor=$cor_tr height='30px'>
					<td><b>Nome<b></td>
					<td><b>Nível<b></td>
					<td><b>Subsitema<b></td>
					<td><b>Excluir<b></td>
			</tr>";
          $i = 0;
          while ($campos = mysql_fetch_array($resultado)) {
            //selecionar nome do nivel
            $sqlTres = mysql_query("select * from grupo_usuario where codigo_grupo=$campos[codigo_grupo]");
            $campoN = mysql_fetch_array($sqlTres);

            //selecionar nome do subsistema			
            $sqlDois = mysql_query("select * from menu_sistemas where codigo_menu=$campos[codigo_sistema]");
            $campoS = mysql_fetch_array($sqlDois);
            if ($i % 2 == 0) {
              echo"
                  <tr align=center bgcolor=$cor_td1 height='30px'>
                          <td width='35%'>$campos[nome]</td>
                          <td width='30%' >$campoN[nome_grupo]</td>
                          <td width='30%'>$campoS[nome_menu]</td>
                          <td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_permissao.php&cpf=$campos[cpf]&codigo_grupo=$campos[codigo_grupo]\"  onClick=\"return confirm('Retirar permissão de $campos[nome] do subsistema $campoS[nome_menu]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
                  </tr>";
            } else {
              echo"
                  <tr align=center bgcolor=$cor_td2 height='30px'>
                          <td width='35%'>$campos[nome]</td>
                          <td width='30%' >$campoN[nome_grupo]</td>
                          <td width='30%'>$campoS[nome_menu]</td>

                          <td width='5%'><a href=\"index.php?arquivo=subsistemas/usuario/excluir_permissao.php&cpf=$campos[cpf]&codigo_grupo=$campos[codigo_grupo]\"  onClick=\"return confirm('Retirar permissão de $campos[nome] do subsistema $campoS[nome_menu]?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
                  </tr>";
            }
            $i++;
          }
          echo "
				<tr align=right bgcolor=$cor_td2 height='30px'>
					<td colspan=4>
					<table border=0>
					<tr>					
						<td><a href=index.php?arquivo=subsistemas/usuario/form_permissao.php><b>Nova Permissão</b></a></td>
						<td><a href=index.php?arquivo=subsistemas/usuario/form_permissao.php><img src=images/cadastrar.png width=16 height=16 border=0 alt=Cadastrar></td></a>
					</tr>
					</table>
				<tr>	
			</table>";
        } elseif ($pesquisa_subadm) {
          echo "
						<tr>
							<td>";
          $cpf = $_SESSION[cpf];
          $sql = "select * from menu_sistemas s, participa_grupos p where s.codigo_menu=p.codigo_sistema and p.cpf=$cpf";
          $resultado = mysql_query($sql);
          echo "
								<select id='combo_categoria' name='combo_categoria' size='1'>
								<option selected value='0'>Selecione um subsistema</option>";
          while ($campos = mysql_fetch_array($resultado)) {
            echo"<option value=$campos[codigo_menu]> $campos[nome_menu] </option> ";
          }
          echo "</select>
							</td>
						</tr>
						<tr>
							<td><div id=posicao></div></td>
						</tr>					
					";
        }
      }
      mysql_close($conexao);
    }
    ?>
  </body>
</html>
