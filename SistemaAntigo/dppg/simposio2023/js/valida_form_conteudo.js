function checkcontatos() {
    with (document.form_altera_conteudo) {
        if (conteudo.value == "") {
            alert("Preencha o Campo Conteudo!");
            conteudo.focus();
            return false;
        }

        submit();
    }
}