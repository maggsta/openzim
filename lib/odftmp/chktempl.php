#!/usr/bin/php
<?php

if ( $argc < 2 ){
	echo "Must give template argument!\n";;
	exit(1);
}

$dir = '/tmp/chktmpl'. date('dmjgis');
system('mkdir '.$dir);
system('unzip '.$argv[1].' -d '.$dir.' >/dev/null');

$contentXML = file_get_contents($dir.'/content.xml');
//echo $contentXML;

$reg = '#<style:style[^>]*>(.*)</style:style>#smU';
preg_match_all($reg, $contentXML, $matches);

$regs['bold'] = '#bold#';
$regs['italic'] = '#italic#';
$regs['underline'] = '#underline.*solid#';

foreach( $regs as $key => $reg ){
	$oldLen[$key] = strlen($contentXML);
}

foreach( $matches[0] as $match ){
		
	foreach( $regs as $key => $reg ){
		if (preg_match($reg, $match, $matches2)) {
			$len = strlen($match);
			if ( $len < $oldLen[$key] ){
				$oldLen[$key] = $len;
				$bestMatch[$key] = $match;
			}
		}
	}
}
foreach( $regs as $key => $reg ){
	if ( array_key_exists($key,$bestMatch) ){
		echo "Best style for $key:\n";
		echo $bestMatch[$key]."\n";
	}else
		echo "No style for $key found.\n";
}


system('rm -rf '.$dir);

