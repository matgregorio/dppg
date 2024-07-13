function checkcontatos() {
    with (document.avaliacao) {
        if (observacao1.value == "") {
            alert("Descreva a Observação!");
            observacao1.focus();
            return false;
        }

        submit();
    }
}	
