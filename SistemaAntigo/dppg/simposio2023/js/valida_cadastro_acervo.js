function checkcontatos() {
    with (document.form_cadastro_acervo) {
        if (ano.value >= 6) {
            if (tipo[0].checked) {
                if (titulo.value == "") {
                    alert("Digite o título do trabalho!");
                    titulo.focus();
                    return false;
                }
                if (autor1.value == 0) {
                    alert("Digite o nome do Autor 1!");
                    autor1.focus();
                    return false;
                }
                if (tipo_submissao.value == 0) {
                    alert("Escolha o Tipo de Submissão.");
                    tipo_submissao.focus();
                    return false;
                }
                if (orientador.value == -1) {
                    alert("Escolha o Orientador!");
                    orientador.focus();
                    return false;
                }
                //    if (resumo.value == "") {
                //      alert("Digite o resumo");
                //      resumo.focus();
                //      return false;
                //    }
                if (palavrachave.value == false) {
                    alert("Informe as Palavras Chave.");
                    palavrachave.focus();
                    return false;
                }
                if (acordo.checked == false) {
                    alert("É necessário concordar com as normas de submissão!");
                    acordo.focus();
                    return false;
                }
            }
        } else {
            if (titulo_old.value == "") {
                alert("Digite o titulo!");
                titulo_old.focus();
                return false;
            }
            if (autores.value == "") {
                alert("Digite os autores!");
                autores.focus();
                return false;
            }
            if (arq.value == "") {
                alert("Selecione o Arquivo!");
                arq.focus();
                return false;
            }
            if (palavra.value == "") {
                alert("Digite a Palavra Chave!");
                palavra.focus();
                return false;
            }
        }
        submit();
    }
}

function confirmar() {
    // só permitirá o envio se o usuário responder OK


    var resposta = window.confirm("As informações inseridas no formulário de Submissão estão corretas?");
    if (resposta) {
        return true;
    } else {
        return false;
    }
}
