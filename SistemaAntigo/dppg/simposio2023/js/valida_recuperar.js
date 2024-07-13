function checkcontatos() {
    with (document.form_recuperar) {
        if (arquivo.value == "") {
            alert("Preencha o Campo arquivo Banco de Dados!");
            arquivo.focus();
            return false;
        }

        submit();
    }
}