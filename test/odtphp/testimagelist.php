<?php

require_once('../../lib/odtphp/library/odf.php');


$odf = new odf('./Anlage_templatelist.odt');
$odf->setVars('zeit', 5, false);
$odf->setVars('ziel', 'Ziel', false,'UTF-8');
$odf->setVars('tip', 'Tip', false,'UTF-8');
$odf->setVars('Inhalt', 'Inhalt',false,'UTF-8');
$odf->setVars('methode', 'Methode', false,'UTF-8');
$odf->setVars('material', 'Material', false,'UTF-8');
$bilder = $odf->setSegment('bilder');
$dir='../../web/uploads/bilder/';

$files = scandir($dir) ;
foreach ( $files as $bild ){
  $pos = strpos($bild,'.jpg');
    if($pos === false) 
	continue;
//      print($bild);
  $bilder->setImage('bild',$dir.'/'.$bild);
  $bilder->titel($bild);  
  $bilder->merge();
}
$odf->mergeSegment($bilder);
$odf->saveToDisk ('result.odt');  
?>
