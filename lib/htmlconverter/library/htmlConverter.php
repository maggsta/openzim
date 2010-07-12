<?php
class htmlConverter {

	private $isZimInput;

	public function __construct($input=false) {
		$this->isZimInput = $input;	
	}

	public function getIsZimInput() {
		return $this->isZimInput;
	}	

	public function convertFromArray($array,$text) {
		foreach( $array as $key => $value )
                	$text = str_replace($key, $value, $text);
                return $text;
        }

	function translation_table_to_utf8($arTranslationtable)
	{
	    foreach($arTranslationtable as $charkey => $char)
	    {
		$charkey = utf8_encode($charkey);
		$arUTFchars[$charkey]= utf8_encode($char);
	    } 
	     return $arUTFchars;
	}

	public function removeSpecialChars($text) {
	
		$htmlTable = get_html_translation_table(HTML_ENTITIES);
		$htmlTable = $this->translation_table_to_utf8($htmlTable);
		$htmlTable = array_flip($htmlTable);
		unset($htmlTable['&quot;']);
                unset($htmlTable['&amp;']); 
                unset($htmlTable['&lt;']); 
                unset($htmlTable['&gt;']); 
		$result = strtr($text, $htmlTable); 
		return $result;

	}

	public function getODF($text) {
        
		$commonArray = array(
                          '&ldquo;'  => '“',
                          '&bdquo;'  => '„',
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
			  '"'	     => '&quot;',
			  '\''       => '&apos;');
	
		$anlageArray = array(
			  '<strong>'  => '<text:span text:style-name="T5">',
                          '</strong>' => '</text:span>',
                          '<em>'      => '<text:span text:style-name="T1">',
                          '</em>'     => '</text:span>');

		$zimArray = array(
                          '<strong>'  => '<text:span text:style-name="T4">',
                          '</strong>' => '</text:span>',
                          '<em>'      => '<text:span text:style-name="T13">',
                          '</em>'     => '</text:span>');

		if( $this->getIsZimInput()) {
                       $convertArray = array_merge( $commonArray, $zimArray );
		} else {
			$convertArray = array_merge( $commonArray, $anlageArray );  
		}

		$result = strip_tags($text, '<strong><em>');
                $result = $this->convertFromArray($convertArray,$result);
		$result = $this->removeSpecialChars($result);
		return $result;
	}

}
?>
