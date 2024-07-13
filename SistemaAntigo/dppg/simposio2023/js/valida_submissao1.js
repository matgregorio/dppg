function checkcontatos() {
    with (document.observacao) {
        if (arq_trabalho.value == "") {
            alert("Escolha um arquivo!");
            arq_trabalho.focus();
            return false;
        }

        submit();
    }
}	
