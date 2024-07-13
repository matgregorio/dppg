<?php
// inclui a classe TTranslation
include_once 'app.widgets/TTranslation.class.php';
// define a linguagem como portugu�s
TTranslation::setLanguage('pt');
echo "Em Portugu�s:<br>\n";
// imprime palavras traduzidas
echo _t('Function') . "<br>\n";
echo _t('Table') . "<br>\n";
echo _t('Tool') . "<br>\n";
// define a linguagem como italiano
TTranslation::setLanguage('it');
echo "Em Italiano:<br>\n";
// imprime palavras traduzidas
echo _t('Function') . "<br>\n";
echo _t('Table') . "<br>\n";
echo _t('Tool') . "<br>\n";
?>

