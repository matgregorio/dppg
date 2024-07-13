<?php
include('subsistemas/cursos/pesquisa_vetor_cursos.php');
$resultado = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
$resultado_dois = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

if ($resultado || $resultado_dois) {
  ?>
  <div id="menu">
    <ul>
      <li><a href=index.php?arquivo=subsistemas/cursos/form_listar_colaborador.php>Listar Avaliadores</a></li>
      <li><a href=index.php?arquivo=subsistemas/cursos/form_cad_curso.php>Cadastrar Curso</a></li>				
      <li><a href=index.php?arquivo=subsistemas/cursos/listagem_cursos.php>Listar Cursos</a></li>
      <li><a href=index.php?arquivo=subsistemas/cursos/form_cad_participante_interno.php>Cadastrar Participante</a></li>
      <li><a href=index.php?arquivo=subsistemas/cursos/form_insc_interno.php>Inscrever em Curso</a></li>
      <li><a href=index.php?arquivo=subsistemas/cursos/presenca.php>Presença</a></li>
      <li><a href=index.php?arquivo=subsistemas/cursos/form_listar_participantes.php>Listar Participantes/Curso</a></li>
      <li><a href=index.php?arquivo=subsistemas/cursos/form_pesquisar_participantes.php>Pesquisar Participantes</a></li>
      <li><a href=index.php?arquivo=subsistemas/cursos/lista_participantes.php>Certificado Palestrantes</a></li>
      <li><a href=index.php?arquivo=subsistemas/cursos/form_validar_certificado.php>Validar Certificado</a></li>
      <li><a href=index.php?arquivo=subsistemas/cursos/form_cad_iniciacao.php>Cadastrar Iniciação</a></li>
      <!--<li><a href=index.php?arquivo=subsistemas/cursos/form_listar_iniciacao.php>Editar Iniciação</a></li>-->
      <li><a href=index.php?arquivo=subsistemas/cursos/form_liberar_iniciacao.php>Liberar Certificado Iniciação</a></li>
      <!--<li><a target='_blank' href=certificado_palestrantes.php>Certificado Palestrantes</a></li>-->
      <li><a href=index.php?arquivo=subsistemas/cursos/listaAluno.php>Editar Dados Iniciação</a></li>

    </ul>
  </div>
  <?php
}
?>
