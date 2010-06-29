<?php

require_once('../../lib/odtphp/library/odf.php');


$odf = new odf('./Anlage_template.odt');
$odf->setVars('zeit', 5, false);
$odf->setVars('ziel', 'Ziel', false,'UTF-8');
$odf->setVars('tip', 'Tip', false,'UTF-8');
$odf->setVars('Inhalt', 'Inhalt',false,'UTF-8');
$odf->setVars('methode', 'Methode', false,'UTF-8');
$odf->setVars('material', 'Material', false,'UTF-8');

$bild='./test.jpg';
$odf->setImage('bild',$bild);
$odf->setVars('titel',$bild);  
$odf->saveToDisk ('result.odt');  
?>
