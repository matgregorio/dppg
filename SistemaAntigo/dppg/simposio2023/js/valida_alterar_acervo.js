function checkalter(form_alterar_acervo) {
    if (form_alterar_acervo.titulo.value == "") {
        alert("Digite o titulo!");
        form_alterar_acervo.titulo.focus();
        return false;
    }

    if (form_alterar_acervo.autores.value == "") {
        alert("Digite os autores!");
        form_alterar_acervo.autores.focus();
        return false;
    }

    if (form_alterar_acervo.palavra.value == "") {
        alert("Digite a Palavra Chave!");
        form_alterar_acervo.palavra.focus();
        return false;
    }
}