function checkcontatos() {
    with (document.form_submissao) {
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
        if (palavrachave01.value == false) {
            alert("Informe as Palavras Chave.");
            palavrachave01.focus();
            return false;
        }
        if (palavrachave02.value == false) {
            alert("Informe as Palavras Chave.");
            palavrachave02.focus();
            return false;
        }
        if (palavrachave03.value == false) {
            alert("Informe as Palavras Chave.");
            palavrachave03.focus();
            return false;
        }
        if (acordo.checked == false) {
            alert("É necessário concordar com as normas de submissão!");
            acordo.focus();
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