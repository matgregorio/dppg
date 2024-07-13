function checkcontatos() {
    with (document.form_altera_banner) {
        if (caminho.value == "") {
            alert("Preencha o Campo Link Banner!");
            caminho.focus();
            return false;
        }

        submit();
    }
}