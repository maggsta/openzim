#!/usr/bin/php
<?php

class Odftest
{

	public function __construct($contentXML)
	{
		$this->contentXml = $contentXML; 
	}

	private static function str_replace_once($needle , $replace , $haystack){
	    // Looks for the first occurence of $needle in $haystack
	    // and replaces it with $replace.
	    $pos = strpos($haystack, $needle);
	    if ($pos === false) {
	        // Nothing found
		return $haystack;
	    }
	    return substr_replace($haystack, $replace, $pos, strlen($needle));
	}  

	private static function replaceLastMatch($search, $replace, $text)
	{
	    $arr = explode($search, $text);
	    if(count($arr) > 1) {
	        $return = $arr[0];
	        for($i=1; $i<=count($arr)-2; $i++) {
	            $return .= $search.$arr[$i];
	        }
	        $return .= $replace.$arr[count($arr)-1];
	        return $return;
	    }
	    else {
	        return $text;
	    }
	} 
		public function _moveListSegments()
		{
			// Search all possible lists in the document
			$reg1 = "#<text:list-item[^>]*>(.*)</text:list-item>#smU";
			preg_match_all($reg1, $this->contentXml, $matches);
			for ($i = 0, $size = count($matches[0]); $i < $size; $i++) {
				// Check if the current list item contains a segment list.*
				$reg2 = '#\[!--\sBEGIN\s(list.[\S]*)\s--\](.*)\[!--\sEND\s\\1\s--\]#sm';
				if (preg_match($reg2, $matches[0][$i], $matches2)) {
					$balise = str_replace('list.', '', $matches2[1]);
					// Move segment tags around the list item
					$replace = array(
					'[!-- BEGIN ' . $matches2[1] . ' --]'	=> '',
					'[!-- END ' . $matches2[1] . ' --]'		=> '',
					'<text:list-item'	=> '[!-- BEGIN ' . $balise . ' --]<text:list-item',
					'</text:list-item>' => '</text:list-item>[!-- END ' . $balise . ' --]'
					);
					$replacedXML = str_replace(array_keys($replace), array_values($replace), $matches[0][$i]);
					$this->contentXml = str_replace($matches[0][$i], $replacedXML, $this->contentXml);
				}
			}
		}


	public function _moveRowSegments(){
		$found = true;
		while ( $found ){
			$found = false;
			$subreg = '(.*)\[!--\sBEGIN\s(row.[\S]*)\s--\](.*)\[!--\sEND\s\\2\s--\]';
			$reg = "#<table:table-row[^>]*>$subreg(.*)</table:table-row>#smU";
			preg_match_all($reg, $this->contentXml, $matches);
	
			foreach( $matches[0] as $i => $match ){
				$found = true;
				// only the first part 
				preg_match("#$subreg#smU",$match,$matches2 );
				$match = substr($match,strrpos($matches2[1],'<table:table-row'));
				$balise = str_replace('row.', '', $matches[2][$i]);
				// Move segment tags around the row
				$replace = array(
					'[!-- BEGIN ' . $matches[2][$i] . ' --]'	=> '',
					'[!-- END ' . $matches[2][$i] . ' --]'	=> ''
				);
				$replacedXML = str_replace(array_keys($replace), array_values($replace), $match);
				$key = '<table:table-row'; $value = '[!-- BEGIN ' . $balise . ' --]<table:table-row';
				$replacedXML = self::str_replace_once($key, $value, $replacedXML);
				$key = '</table:table-row>'; $value = '</table:table-row>[!-- END ' . $balise . ' --]';
				$replacedXML = self::replaceLastMatch($key, $value, $replacedXML);
				$this->contentXml = str_replace($match, $replacedXML, $this->contentXml);
			//	echo "$match\n";
			}
		}
	}

}


if ( $argc < 2 ){
	echo "Must give template argument!\n";;
	exit(1);
}

$dir = '/tmp/chktmpl'. date('dmjgis');
system('mkdir '.$dir);
system('unzip '.$argv[1].' -d '.$dir.' >/dev/null');

$contentXML = file_get_contents($dir.'/content.xml');
//echo $contentXML;

$odftest = new Odftest($contentXML);
$odftest->_moveRowSegments();
$odftest->_moveListSegments();
$contentXML = $odftest->contentXml;


echo "$contentXML\n";


system('rm -rf '.$dir);

