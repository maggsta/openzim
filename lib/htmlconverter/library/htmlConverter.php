<?php
class htmlConverter {

	public function __construct() {
		
	}	

	public function replaceDoubleQuotes($text) {

                return str_replace('&ldquo;', '"', str_replace('&bdquo;', '"', $text));

        }

        public function replaceUmlaute($text) {

                $text = str_replace('&uuml;', 'ü', $text);
                $text = str_replace('&ouml;', 'ö', $text);
                $text = str_replace('&auml;', 'ä', $text);
                $text = str_replace('&szlig;', 'ß', $text);
                $text = str_replace('&nbsp;', ' ', $text);
		return $text;

        }

	public function convertBold($text) {
	
		$text = str_replace('<strong>', '<text:span text:style-name="T5">', $text);
		$text = str_replace('</strong>', '</text:span>', $text);
		return $text;
	}

	public function convertItalic($text) {

                $text = str_replace('<em>', '<text:span text:style-name="T1">', $text);
                $text = str_replace('</em>', '</text:span>', $text);
		return $text;
        
	}

	public function convertParagraph($text) {

                $text = str_replace('<p>', '', $text);
                $text = str_replace('</p>', "\n", $text);
                return $text;

        }

	public function convertOuterList($text) {

                $text = str_replace('<li>', '<text:list><text:list-item>', $text);
                $text = str_replace('</li>', '</text:list-item></text:list>', $text);
                return $text;

        }

	public function getODF($text) {
		$result = strip_tags($text, '<strong><em><p>');
		$result = $this->replaceDoubleQuotes($result);
		$result = $this->replaceUmlaute($result);
		$result = $this->convertBold($result);	
		$result = $this->convertItalic($result);
		$result = $this->convertParagraph($result);
		return $result;
	}

}
?>
