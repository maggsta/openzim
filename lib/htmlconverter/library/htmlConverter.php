<?php
class htmlConverter {

	public function __construct() {
		
	}	

	public function convertFromArray($array,$text) {
		foreach( $array as $key => $value )
                	$text = str_replace($key, $value, $text);
                return $text;
        }

	public function getODF($text) {
                $convertArray = array( 
                  '&ldquo;' => '“', 
		  '&bdquo;' => '„', 
	          '&uuml;'  => 'ü', 
	          '&Uuml;'  => 'Ü', 
                  '&ouml;'  => 'ö', 
                  '&Ouml;'  => 'Ö', 
                  '&auml;'  => 'ä', 
                  '&Auml;'  => 'Ä', 
                  '&szlig;' => 'ß', 
                  '&nbsp;'  => ' ', 
		  '<strong>'  => '<text:span text:style-name="T5">',
		  '</strong>' => '</text:span>',
                  '<em>'    => '<text:span text:style-name="T1">',
                  '</em>'   => '</text:span>',
//	   	  '<li>' => '<text:list><text:list-item>',
//                '</li>' => '</text:list-item></text:list>',
                  '<p>'     => '', 
                  '</p>'    => "\n");
		$result = strip_tags($text, '<strong><em><p>');
                $result = $this->convertFromArray($convertArray,$result);
		return $result;
	}

}
?>
