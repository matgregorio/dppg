function checkcontatos() {
    with (document.form_altera_topo) {
        if (arquivo.value == "") {
            alert("Preencha o Campo Imagem Topo!");
            arquivo.focus();
            return false;
        }

        submit();
    }
}