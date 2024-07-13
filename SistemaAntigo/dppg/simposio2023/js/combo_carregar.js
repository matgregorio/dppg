function getStates(what) {
    if (what.selectedIndex != '') {
        var estado = what.value;
        document.location = ('exemplo.php?estado=' + estado);
    }
} 