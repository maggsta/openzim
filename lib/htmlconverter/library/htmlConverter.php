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
		return str_replace(array_keys($array), array_values($array), $text);
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

	public function convertSpecialChars($text) {
	
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
	
		$styles['anlage']['bold'] = "T5";
		$styles['anlage']['italic'] = "T1";
		$styles['anlage']['underline'] = "T13";
		$styles['zim']['bold'] = "T4";
		$styles['zim']['italic'] = "T13";
		$styles['zim']['underline'] = "T15";
	
		if( $this->getIsZimInput()) 
			$template = 'zim';
		else
			$template = 'anlage';

		$styleArray = array(
			  '<strong>'  => '<text:span text:style-name="'.$styles[$template]['bold'].'">',
                          '</strong>' => '</text:span>',
                          '<em>'      => '<text:span text:style-name="'.$styles[$template]['italic'].'">',
                          '</em>'     => '</text:span>',
			  '<span style=&quot;text-decoration: underline;&quot;>' => '<text:span text:style-name="'.$styles[$template]['underline'].'">',
                          '</span>'     => '</text:span>'
		);

		// 1. convert our own table
                $result = $this->convertFromArray($commonArray,$text);
		// 2. convert styles special to template
                $result = $this->convertFromArray($styleArray,$result);	
		// 3. remove all but the odf tags
		$result = strip_tags($result, '<text:span>');
		// 4. convert leftover special chars
		$result = $this->convertSpecialChars($result);
		return $result;
	}

}
?>
