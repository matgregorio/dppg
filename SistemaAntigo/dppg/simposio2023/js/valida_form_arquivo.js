function checkcontatos() {
    with (document.form_altera_arquivo) {

        if (nome.value == "") {
            alert("Preencha o Campo Nome Arquivo!");
            nome.focus();
            return false;
        }

        submit();
    }
}