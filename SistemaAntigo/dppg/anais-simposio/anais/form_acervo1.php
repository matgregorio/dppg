<!-- Este arquivo recebe e processa o ano da edicao do simposio e o departamento (sub_area) buscada pelo usuario, para posterior exibicao dos pdf's dos anais-->

<head>
  <script type="text/javascript">
    function Acionar(ano) 
    {
      if (ano > 0 || ano =='a')//Se o ano escolhido for maior que 0 ou ano escolhido for igual aos anteriores de 2013
      {
        document.form_acervo1.submit();
      }
    }
  </script>
  
  <script type="text/javascript">
    function GetXmlHttpObject() {
      var xmlHttp = null;
      try {
        xmlHttp = new XMLHttpRequest();
      } catch (e) {
        try {
          xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
          xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
      }
      return xmlHttp;
    }

    function listarCampos(cSA) { //L
      xmlHttp = GetXmlHttpObject();
      if (xmlHttp == null) {
        alert("Este Browser não suporta HTTP Request");
        return;
      }

      if (cSA != 0 && cSA != 'a') 
      {
        var ano = document.getElementById('ano').value;
        if (ano == 6) {
          var url = "anais/simposio2013/selecionar_titulo.php";
        } else if (ano == 7) {
          var url = "anais/simposio2014/selecionar_titulo.php";
        } else if(ano == 8){
          var url = "anais/simposio2015/selecionar_titulo.php";
        }else if(ano == 9){
          var url = "anais/simposio2016/selecionar_titulo.php";
        }
        else if(ano == 10)
        { /*Nao houve simposio em 2017*/ }
        else if(ano == 11)
        { var url = "anais/simposio2018/selecionar_titulo.php";}
        else if(ano == 12)
        { var url = "anais/simposio2019/selecionar_titulo.php";}
        else if(ano == 13)
        { var url = "anais/simposio2020/selecionar_titulo.php";}
        else if(ano == 14)
        { var url = "anais/simposio2021/selecionar_titulo.php";}
        else if(ano == 15)
        { var url = "anais/simposio2022/selecionar_titulo.php";}
        else if(ano == 16)
        { var url = "anais/simposio2023/selecionar_titulo.php";}
        else if(ano == 17)
        { var url = "anais/simposio2024/selecionar_titulo.php";}
        else if(ano == 18)
        { var url = "anais/simposio2025/selecionar_titulo.php";}
        else if(ano == 19)
        { var url = "anais/simposio2026/selecionar_titulo.php";}








        url = url + "?sa=" + cSA;

        xmlHttp.open("GET", url);
        xmlHttp.onreadystatechange = mostrarCampos;
        xmlHttp.send(null);
      } else if (CSA == 'a') {
        document.getElementById("titulo").innerHTML = "<a href='https://dppg.riopomba.ifsudestemg.edu.br/simposio2012/simposio.php?arquivo2=form_acervo.php' taget='_blank'>Ir para o Sistema de 2012</a>";
      } else {
        document.getElementById("titulo").innerHTML = "";
      }
    }

    function mostrarCampos() {
      if (xmlHttp.readyState == 4) {
        document.getElementById("titulo").innerHTML = xmlHttp.responseText;
      }
    }
  </script>
  
</head>

<?php
include('/var/www/html/simposio2021/includes/config.php');

$ano = mysql_real_escape_string($_POST[ano]);

if ($ano == 'a')//**** Anos anteriores a 2013 ****
{
  ?>
  <section id="content" class="primary" role="main">
      <div id="post-5" class="post-5 page type-page status-publish hentry">
        <h2 class="page-title"><b>Consultar Sumário de <?php echo $campo_ano[ano]; ?></b></h2>
        <div class="entry clearfix">
          <center>
            <form name="form_acervo1_new" method="post" action="index.php">
              <?php echo"<input id='ano' type='hidden' name='ano' value='$campo_ano[codigo_ano]'"; ?>
              <h6>
                <b>Ir para o Sistema de 2012:</b>
                <br>
                <br>
                <a href="https://dppg.riopomba.ifsudestemg.edu.br/simposio2012/simposio.php?arquivo2=form_acervo.php" target="_blank"> =>Clique aqui<=</a>
              </h6>
              <br>
              <div id="titulo"></div>
            </form>
            <br>
            <a href="?data/anais/form_acervo1">Voltar</a>
            <br><br>
          </center>
        </div>
      </div>
    </section>
    <?php
} 
else //**** Anos apos 2012 ****
{
  $sql = "SELECT * FROM ano WHERE codigo_ano=$ano";
  $resultado = mysql_query($sql);
  $campo_ano = mysql_fetch_array($resultado);
  
  if ($ano > 5)//Se o ano selecionado for superior a 2012
  {
    //Seleciona o codigo da sub area
    $query_sa = mysql_query("SELECT codigo_sa, nome_sa FROM sub_area ORDER BY nome_sa ASC"); 
    
    /*  Dicionario das sub areas
       20 Agronomia, Agricultura e Ambiente
       36 Artes
       9 Ci�ncia da Computa��o
       21 Ci�ncia e Tecnologia de Alimentos
       4 Ci�ncias Biol�gicas e Biotecnologia
       5 Ci�ncias da Sa�de
       12 Ci�ncias gerenciais
       34 Ci�ncias Sociais, Humanas, Lingu�stica e Letras
       35 Educa��o
       18 Engenharias
       11 Matem�tica, f�sica e estat�stica
       29 Qu�mica
       22 Zootecnia
    */
    
    /* Dicionario dos anos
    
     1 2008
     2 2009
     3 2010
       .
       .
       .
    11 2018
    12 2019
    13 2020
    14 2021
   */
    
    ?>
    <section id="content" class="primary" role="main">
      <div id="post-5" class="post-5 page type-page status-publish hentry">
        
        <!--Inicio do sumario-->  
        <h2 class="page-title"><b>Consultar Sumário de <?php echo $campo_ano[ano]; ?></b></h2>
        <div class="entry clearfix">
          <center>
            <form name="form_acervo1_new" method="post" action="index.php">
                <?php echo "<input id='ano' type='hidden' name='ano' value='$campo_ano[codigo_ano]'>";?>
              <h6><b>Departamento:</b>
                <br>
                
                <!--Listagem dos departamentos-->
                <select id="sa" name="sa" style='width: 450px' onchange="script : listarCampos(this.value)" onclick="script : listarCampos(this.value)"><!--Chama a funcao que lista os campos titulo, autor1, palavra chave(a listagem destes arquivos esta no arquivo selecionar_titulo.php)-->
                  <option value="0"></option>
                  <option value="t">Todas</option>
                  <?php
                  //Exibe os departamentos (o sistema trata isso como sub_areas)
                  while ($campos_sa = mysql_fetch_array($query_sa)) 
                  {
                    echo"<option value='$campos_sa[codigo_sa]'>$campos_sa[nome_sa]</option>";
                  }
                  ?>
                </select>
                <!--Fim listagem dos departamentos-->
                
              </h6>
              <br>
              <div id="titulo"></div>
            </form>
            <br>
            <a href="?data/anais/form_acervo1">Voltar</a>
            <br><br>
          </center>
        </div>
      </div>
    </section>
    <?php
  }
  else //Se o ano escolhido pelo usuario for anterior ao ano atual
  {
    $sql = "SELECT * FROM ano WHERE codigo_ano>5 AND codigo_ano<100 ORDER BY ano ASC"; //Olhar no simposio20XX na tabela ano para ver o codigo do ano atual

    $resultado = mysql_query($sql);
    $result_participantes = mysql_query("SELECT cpf, nome FROM participantes WHERE cpf!='admin' ORDER BY nome");
    ?>
    <center>
      <br><br>
      <form name="form_acervo1" method="POST" action="?data=anais/form_acervo1">
        <h6>Primeiro, selecione o ano.
          <br>
          <select name="ano" size="1" onclick="script : Acionar(this.value)">
            <option value="0"></option>
            <option value="a">Anteriores a 2013</option>
            <?php
            while ($campos = mysql_fetch_array($resultado))
            {
              if($campos[codigo_ano] == 10)
                  echo "<option value=''>Não houve edição em 2017</option>";
              else
                echo "<option value='$campos[codigo_ano]'>$campos[ano]</option>";
            }
            ?>
          </select><font color="#FF0000"> *</font>
        </h6>
        <br>
        <font size="3" color="#FF0000">* </font>Campo de preenchimento obrigatório</b>
        <!--<input type="hidden" name="arquivo2" value="form_acervo1.php">-->
      </form>
    </center>

    <?php
      echo "ano-> $campo_ano[ano]";
  }
}
?>
