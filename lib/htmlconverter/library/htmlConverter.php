<?php
class htmlConverter {

	public function __construct() {
		
	}	

	public function convertFromArray($array,$text) {
		foreach( $array as $key => $value )
                	$text = str_replace($key, $value, $text);
                return $text;
        }

	public function removeSpecialChars($text) {
		
		$result = html_entity_decode($text, ENT_QUOTES, 'UTF-8');		   	     return $result;
	}

	function cleanRemainingString($in,$offset=null) 
	{ 
	    $out = trim($in); 
	    if (!empty($out)) 
	    { 
		$entity_start = strpos($out,'&',$offset); 
		// nichts weiter gefunden
		if ($entity_start === false) 
		{ 
		    return $out;    
		} 
		else 
		{ 
		    $entity_end = strpos($out,';',$entity_start); 
		    if ($entity_end === false) 
		    { 
			 return $out; 
		    } 
		    // gefunden, aber zu lang um eine entity zu sein 
		    else if ($entity_end > $entity_start+7) 
		    { 
			 $out = cleanString($out,$entity_start+1); 
		    } 
		    // weiteres vorkommen gefunden 
		    else 
		    { 
			 $clean = substr($out,0,$entity_start); 
			 $subst = substr($out,$entity_start+1,1); 
			 
			 $clean .= ($subst != "#") ? $subst : "_"; 
			 $clean .= substr($out,$entity_end+1); 
			 
			 $out = cleanString($clean,$entity_start+1); 
		    } 
		} 
	    } 
	    return $out; 
	} 

	public function getODF($text) {
                $convertArray = array( 
                  '&ldquo;'  => '“', 
		  '&bdquo;'  => '„', 
	          '&quot;'   => '"',
		  '&uuml;'   => 'ü', 
	          '&Uuml;'   => 'Ü', 
                  '&ouml;'   => 'ö', 
                  '&Ouml;'   => 'Ö', 
                  '&auml;'   => 'ä', 
                  '&Auml;'   => 'Ä', 
                  '&szlig;'  => 'ß',
		  '&egrave;' => 'è',
		  '&eacute;' => 'é',
		  '&ecirc;'  => 'ê',
                  '&ntilde;' => 'ñ',
		  '&nbsp;'   => ' ', 
                  '&acute;'  => '´',
                  '&gt;'     => '>',
                  '&lt;'     => '<', 
		  '<strong>'  => '<text:span text:style-name="T5">',
		  '</strong>' => '</text:span>',
                  '<em>'     => '<text:span text:style-name="T1">',
                  '</em>'    => '</text:span>',
                  '<p>'      => '', 
                  '</p>'     => "\n");
		$result = strip_tags($text, '<strong><em><p>');
                $result = $this->convertFromArray($convertArray,$result);
		$result = $this->removeSpecialChars($result);
		$result = $this->cleanRemainingString($result,null);
		return $result;
	}

}
?>
