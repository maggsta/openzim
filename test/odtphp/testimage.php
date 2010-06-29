<?php

require_once('../../lib/odtphp/library/odf.php');


$odf = new odf('./test_template.odt');

$bild='./test.jpg';
$odf->setVars('titel',$bild);  
$odf->setVars('message', 'Material', false,'UTF-8');
$odf->setImage('image',$bild);
$odf->saveToDisk ('result.odt');  
?>
