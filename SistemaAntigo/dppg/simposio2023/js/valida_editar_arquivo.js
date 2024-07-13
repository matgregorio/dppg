function checkcontatos() {
    with (document.form_editar_trabalho) {
        if (titulo.value == "") {
            alert("Digite o título do trabalho!");
            titulo.focus();
            return false;
        }
        if (autor1.value == "") {
            alert("Digite o nome do Autor 1!");
            autor1.focus();
            return false;
        }
        if (orientador.value == 0) {
            alert("Escolha o Orientador!");
            orientador.focus();
            return false;
        }
//    if (resumo.value == "") {
//      alert("Digite o resumo");
//      resumo.focus();
//      return false;
//    }
        if (palavra_chave.value == false) {
            alert("Informe as Palavras Chave.");
            palavra_chave.focus();
            return false;
        }
        submit();
    }
}

function confirmar() {
    // só permitirá o envio se o usuário responder OK
    alert("RESUMOS QUE NÃO ESTEJAM ENTRE 250 E 400 PALAVRAS PODERÃO SER REPROVADOS");
    var resposta = window.confirm("As informações inseridas no formulário de Submissão estão corretas?");
    if (resposta) {
        return true;
    } else {
        return false;
    }
}