<?php
class htmlConverter {

	private $styles;

	public function __construct($styles) {
		$this->styles = $styles;
	}

	public function convertFromArray($array,$text) {
		return str_replace(array_keys($array), array_values($array), $text);
        }

	public function getODF($text) {
		$styleArray = array(
		  '<strong>'  => '<text:span text:style-name="'.$this->styles['bold'].'">',
                  '</strong>' => '</text:span>',
                  '<em>'      => '<text:span text:style-name="'.$this->styles['italic'].'">',
                  '</em>'     => '</text:span>',
                  '<ol>'      => '</text:p><text:list text:style-name="L1">',
                  '<ul>'      => '</text:p><text:list text:style-name="L2">',
		  '</ol>'     => '</text:list><text:p>',
		  '</ul>'     => '</text:list><text:p>',
		  '<li>'      => '<text:list-item><text:p>',	
		  '</li>'     => '</text:p></text:list-item>',
                  '<br />'    => "\n"
		);
		$pregArray = array(
			  '#<span style="text-decoration: underline;">(.*)</span>#U' => 
			  '<text:span text:style-name="'.$this->styles['underline'].'">$1</text:span>'
		);

		// 1. convert styles special to template
                $result = $this->convertFromArray($styleArray,$text);	
		// 2. convert regular expressions
		$result = preg_replace(array_keys($pregArray), array_values($pregArray), $result);
		// 3. remove all but the odf tags
		$result = strip_tags($result, '<text:span><text:p><text:list><text:list-item>');
		return $result;
	}

}
?>
