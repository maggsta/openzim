<?php
require 'Segment.php';
class OdfException extends Exception
{}
/**
 * Templating class for odt file
 * You need PHP 5.2 at least
 * You need Zip Extension or PclZip library
 * Encoding : ISO-8859-1
 * Last commit by $Author: eldy $
 * Date - $Date: 2010-05-12 17:39:43 +0200 (Mi, 12 Mai 2010) $
 * SVN Revision - $Rev: 56 $
 * Id : $Id: odf.php 56 2010-05-12 15:39:43Z eldy $
 *
 * @copyright  GPL License 2008 - Julien Pauli - Cyril PIERRE de GEYER - Anaska (http://www.anaska.com)
 * @copyright  GPL License 2010 - Laurent Destailleur - eldy@users.sourceforge.net
 * @license    http://www.gnu.org/copyleft/gpl.html  GPL License
 * @version 1.4
 */
class Odf
{
	protected $config = array(
    	'ZIP_PROXY' => 'PclZipProxy',	// PclZipProxy, PhpZipProxy
    	'DELIMITER_LEFT' => '{',
    	'DELIMITER_RIGHT' => '}',
		'PATH_TO_TMP' => '/tmp'
		);
		protected $file;
		protected $contentXml;			// To store content of content.xml file
		protected $stylesXml;			// To store content of styles.xml file
		protected $manifestXml;			// To store content of META-INF/manifest.xml file
		protected $tmpfile;
		protected $tmpdir='';
		protected $images = array();
		protected $vars = array();
		protected $styleVars = array();
		protected $segments = array();
		protected $styles = array();		// odf style identifiers
		protected $lastStyles = array();	// odf style identifiers ( first free style )
		const PIXEL_TO_CM = 0.026458333;
		/**
		 * Class constructor
		 *
		 * @param string $filename the name of the odt file
		 * @throws OdfException
		 */
		public function __construct($filename, $config = array())
		{
			clearstatcache();

			if (! is_array($config)) {
				throw new OdfException('Configuration data must be provided as array');
			}
			foreach ($config as $configKey => $configValue) {
				if (array_key_exists($configKey, $this->config)) {
					$this->config[$configKey] = $configValue;
				}
			}

			$md5uniqid = md5(uniqid());
			if ($this->config['PATH_TO_TMP']) $this->tmpdir = preg_replace('|[\/]$|','',$this->config['PATH_TO_TMP']);	// Remove last \ or /
			$this->tmpdir .= ($this->tmpdir?'/':'').$md5uniqid;
			$this->tmpfile = $this->tmpdir.'/'.$md5uniqid.'.odt';	// We keep .odt extension to allow OpenOffice usage during debug.

			// A working directory is required for some zip proxy like PclZipProxy
			if (in_array($this->config['ZIP_PROXY'],array('PclZipProxy')) && ! is_dir($this->config['PATH_TO_TMP'])) {
				throw new OdfException('Temporary directory '.$this->config['PATH_TO_TMP'].' must exists');
			}

			// Create tmp direcoty (will be deleted in destructor)
			if (!file_exists($this->tmpdir)) {
				$result=mkdir($this->tmpdir);
			}

			// Load zip proxy
			$zipHandler = $this->config['ZIP_PROXY'];
			if (!defined('PCLZIP_TEMPORARY_DIR')) define('PCLZIP_TEMPORARY_DIR',$this->tmpdir);
			include_once('zip/'.$zipHandler.'.php');
			if (! class_exists($this->config['ZIP_PROXY'])) {
				throw new OdfException($this->config['ZIP_PROXY'] . ' class not found - check your php settings');
			}
			$this->file = new $zipHandler($this->tmpdir);


			if ($this->file->open($filename) !== true) {	// This also create the tmpdir directory
				throw new OdfException("Error while Opening the file '$filename' - Check your odt filename");
			}
			if (($this->contentXml = $this->file->getFromName('content.xml')) === false) {
				throw new OdfException("Nothing to parse - Check that the content.xml file is correctly formed in source file '$filename'");
			}
			if (($this->stylesXml = $this->file->getFromName('styles.xml')) === false) {
				throw new OdfException("Nothing to parse - Check that the styles.xml file is correctly formed in source file '$filename'");
			}
			if (($this->manifestXml = $this->file->getFromName('META-INF/manifest.xml')) === false) {
 				throw new OdfException("Something is wrong with META-INF/manifest.xm in source file '$filename'");
			}
			$this->file->close();


			//print "tmpdir=".$tmpdir;
			//print "filename=".$filename;
			//print "tmpfile=".$tmpfile;

			copy($filename, $this->tmpfile);
			$this->_moveRowSegments();
			$this->_moveListSegments();
		}

		
		private function getStyles(){
			$reg = '#<style:style[^>]*>(.*)</style:style>#smU';
			preg_match_all($reg, $this->contentXml, $matches);
			
			// inititalize length to maximum
			foreach( $this->styles as $key => $style ){
				$oldLen[$key] = strlen($this->contentXml);
			}
			$bestmatch = array();	
			$this->lastStyles['T']['num'] = '1';
			$this->lastStyles['P']['num'] = '1';
			$lastStyleReg = '#style:name="%s(.*)"#smU';
			foreach( $matches[0] as $match ){

				// heuristic: use matching style with shortest length
				foreach( $this->styles as $key => $style ){
					if (preg_match($style['reg'], $match, $matches2)) {
						$len = strlen($match);
						if ( $len < $oldLen[$key] ){
							$oldLen[$key] = $len;
							$bestmatch[$key] = $match;
						}
					}
				}
				// find last styles
				foreach( $this->lastStyles as $key => $lastStyle ){
					$reg = sprintf($lastStyleReg,$key);
					if ( preg_match($reg, $match, $styleMatch) != 0 ){
						$lastStyle = intval($styleMatch[1]);
						if ( $lastStyle >= $this->lastStyles[$key]['num'] ){
							$this->lastStyles[$key]['num'] = $lastStyle+1;
							$this->lastStyles[$key]['style'] = $match;
						}
					}
				}
			}
		
			// set style names 
			foreach( $bestmatch as $key => $match ){
				$reg = '#style:name="(.*)"#smU';
				preg_match($reg, $bestmatch[$key], $match);
				$this->styles[$key]['name'] = $match[1];
			}
		}


		public function getStyleNames(){
			$this->styles['bold']['style'] = '<style:style style:name="T%u" style:family="text"><style:text-properties fo:font-weight="bold" style:font-weight-asian="bold"/></style:style>';
			$this->styles['italic']['style'] = '<style:style style:name="T%u" style:family="text"><style:text-properties fo:font-style="italic" style:font-style-asian="italic" style:font-style-complex="italic"/></style:style>';
			$this->styles['underline']['style'] = '<style:style style:name="T%u" style:family="text"><style:text-properties style:text-underline-style="solid" style:text-underline-width="auto" style:text-underline-color="font-color"/></style:style>';
			
			$this->styles['bold']['reg'] = '#name="T.*font-weight="bold"#';
			$this->styles['italic']['reg'] = '#name="T.*italic#';
			$this->styles['underline']['reg'] = '#name="T.*underline.*solid#';
			$this->styles['bold']['type'] = 'T';
			$this->styles['italic']['type'] = 'T';
			$this->styles['underline']['type'] = 'T';

			$this->getStyles();
			foreach( $this->styles as $key => $style ){
				if ( !array_key_exists('name',$style) ){
					// use first free style number
					$lastStyle = $this->lastStyles[$style['type']];
					$newStyle = sprintf($style['style'],$lastStyle['num']);
					// insert new style
 					$pos = strpos($this->contentXml,$lastStyle['style']) + strlen($lastStyle['style']);
					$this->contentXml = substr($this->contentXml,0,$pos).$newStyle.substr($this->contentXml,$pos);
					$this->lastStyles[$style['type']]['style'] = $newStyle;	
					$this->styles[$key]['name'] = $style['type'].$lastStyle['num'];
					$this->lastStyles[$style['type']]['num']++;
				}
				$styleNames[$key] = $this->styles[$key]['name'];
			}
/*			foreach( $styleNames as $key => $style ){
				print("Key:".$key." Style:".$style."\n");
			}
			foreach( $this->lastStyles as $key => $style ){
				print("Laststyle: Key:".$key." Num:".$style['num']." Style:".$style['style']."\n");
			}*/
			return $styleNames;
		}

		/**
		 * Assing a template variable
		 *
		 * @param string $key name of the variable within the template
		 * @param string $value replacement value
		 * @param bool $encode if true, special XML characters are encoded
		 * @throws OdfException
		 * @return odf
		 */
		private function setVarsPrivate($key, $value, $encode = true,
			$charset = 'ISO-8859',$file,&$vars)
		{
			if (strpos($file, $this->config['DELIMITER_LEFT'] . $key . $this->config['DELIMITER_RIGHT']) === false) {
				throw new OdfException("var $key not found in the document");
			}
			$value = $encode ? htmlspecialchars($value) : $value;
			$value = ($charset == 'ISO-8859') ? utf8_encode($value) : $value;
			$vars[$this->config['DELIMITER_LEFT'] . $key . $this->config['DELIMITER_RIGHT']] = str_replace("\n", "<text:line-break/>", $value);
			return $this;
		}

		public function setVars($key, $value, $encode = true, $charset = 'ISO-8859')
		{
			$this->setVarsPrivate($key,$value,$encode,$charset,$this->contentXml,$this->vars);
			return $this;
		}

		public function setStyleVars($key, $value, $encode = true, $charset = 'ISO-8859')
		{
			$this->setVarsPrivate($key,$value,$encode,$charset,$this->stylesXml,$this->styleVars);
			return $this;
		}

		/**
		 * Assign a template variable as a picture
		 *
		 * @param string $key name of the variable within the template
		 * @param string $value path to the picture
		 * @throws OdfException
		 * @return odf
		 */
		public function setImage($key, $value)
		{
			$filename = strtok(strrchr($value, '/'), '/.');
			$file = substr(strrchr($value, '/'), 1);
			$size = @getimagesize($value);
			if ($size === false) {
				throw new OdfException("Invalid image");
			}
			list ($width, $height) = $size;
			$width *= self::PIXEL_TO_CM;
			$height *= self::PIXEL_TO_CM;
			$xml = <<<IMG
			<draw:frame draw:style-name="fr1" draw:name="$filename" text:anchor-type="char" svg:width="{$width}cm" svg:height="{$height}cm" draw:z-index="3"><draw:image xlink:href="Pictures/$file" xlink:type="simple" xlink:show="embed" xlink:actuate="onLoad"/></draw:frame>
IMG;
			$this->images[$value] = $file;
			$this->setVars($key, $xml, false);
			return $this;
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
	
		/**
		 * Move segment tags for lines of tables
		 * Called automatically within the constructor
		 *
		 * @return void
		 */
	private function _moveRowSegments(){
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
			}
		}
	}

		/**
		 * Move segment tags for lines of lists
		 * Called automatically within the constructor
		 *
		 * @return void
		 */
		private function _moveListSegments()
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
					'<text:list-item'							=> '[!-- BEGIN ' . $balise . ' --]<text:list-item',
					'</text:list-item>'						=> '</text:list-item>[!-- END ' . $balise . ' --]'
					);
					$replacedXML = str_replace(array_keys($replace), array_values($replace), $matches[0][$i]);
					$this->contentXml = str_replace($matches[0][$i], $replacedXML, $this->contentXml);
				}
			}
		}

		/**
		 * Merge template variables
		 * Called automatically for a save
		 *
		 * @return void
		 */
		private function _parse()
		{
			$this->contentXml = str_replace(array_keys($this->vars), array_values($this->vars), $this->contentXml);
			$this->stylesXml = str_replace(array_keys($this->styleVars), array_values($this->styleVars),$this->stylesXml);
		}

		/**
		 * Add the merged segment to the document
		 *
		 * @param Segment $segment
		 * @throws OdfException
		 * @return odf
		 */
		public function mergeSegment(Segment $segment)
		{
			if (! array_key_exists($segment->getName(), $this->segments)) {
				throw new OdfException($segment->getName() . 'cannot be parsed, has it been set yet ?');
			}
			$string = $segment->getName();
			// $reg = '@<text:p[^>]*>\[!--\sBEGIN\s' . $string . '\s--\](.*)\[!--.+END\s' . $string . '\s--\]<\/text:p>@smU';
			$reg = '@\[!--\sBEGIN\s' . $string . '\s--\](.*)\[!--.+END\s' . $string . '\s--\]@smU';
			$this->contentXml = preg_replace($reg, $segment->getXmlParsed(), $this->contentXml);
			return $this;
		}

		/**
		 * Display all the current template variables
		 *
		 * @return string
		 */
		public function printVars()
		{
			return print_r('<pre>' . print_r($this->vars, true) . '</pre>', true);
		}

		/**
		 * Display the XML content of the file from odt document
		 * as it is at the moment
		 *
		 * @return string
		 */
		public function __toString()
		{
			return $this->contentXml;
		}

		/**
		 * Display loop segments declared with setSegment()
		 *
		 * @return string
		 */
		public function printDeclaredSegments()
		{
			return '<pre>' . print_r(implode(' ', array_keys($this->segments)), true) . '</pre>';
		}

		/**
		 * Declare a segment in order to use it in a loop
		 *
		 * @param string $segment
		 * @throws OdfException
		 * @return Segment
		 */
		public function setSegment($segment)
		{
			if (array_key_exists($segment, $this->segments)) {
				return $this->segments[$segment];
			}
			// $reg = "#\[!--\sBEGIN\s$segment\s--\]<\/text:p>(.*)<text:p\s.*>\[!--\sEND\s$segment\s--\]#sm";
			$reg = "#\[!--\sBEGIN\s$segment\s--\](.*)\[!--\sEND\s$segment\s--\]#sm";
			if (preg_match($reg, html_entity_decode($this->contentXml), $m) == 0) {
				throw new OdfException("'$segment' segment not found in the document");
			}
			$this->segments[$segment] = new Segment($segment, $m[1], $this);
			return $this->segments[$segment];
		}
		/**
		 * Save the odt file on the disk
		 *
		 * @param string $file name of the desired file
		 * @throws OdfException
		 * @return void
		 */
		public function saveToDisk($file = null)
		{
			if ($file !== null && is_string($file)) {
				if (file_exists($file) && !(is_file($file) && is_writable($file))) {
					throw new OdfException('Permission denied : can\'t create ' . $file);
				}
				$this->_save();
				copy($this->tmpfile, $file);
			} else {
				$this->_save();
			}
		}

		/**
		 * Write output file onto disk
		 *
		 * @throws OdfException
		 * @return void
		 */
		private function _save()
		{
			$res=$this->file->open($this->tmpfile);
			$this->_parse();
			if (! $this->file->addFromString('content.xml', $this->contentXml)) {
				throw new OdfException('Error during file export addFromString');
			}
			if (! $this->file->addFromString('styles.xml',$this->stylesXml)) {
				throw new OdfException('Error during file export addFromString');
			}
			foreach ($this->images as $imageKey => $imageValue) {
				$this->file->addFile($imageKey, 'Pictures/' . $imageValue);
            	$this->addImageToManifest($imageValue);
			}
        	if (! $this->file->addFromString('./META-INF/manifest.xml', $this->manifestXml)) {
            	throw new OdfException('Error during file export: manifest.xml');
        	}
			$this->file->close();
		}

		/**
		 * Update Manifest file according to added image files
		 *
		 * @param string	$file		Image file to add into manifest content
		 */
		public function addImageToManifest($file)
		{
		        $extension = explode('.', $file);
		        $add = ' <manifest:file-entry manifest:media-type="image/'.$extension[1].'" manifest:full-path="Pictures/'.$file.'"/>'."\n";
		        $this->manifestXml = str_replace('</manifest:manifest>', $add.'</manifest:manifest>', $this->manifestXml);
		}

		/**
		 * Export the file as attached file by HTTP
		 *
		 * @param string $name (optionnal)
		 * @throws OdfException
		 * @return void
		 */
		public function exportAsAttachedFile($name="")
		{
			$this->_save();
			if (headers_sent($filename, $linenum)) {
				throw new OdfException("headers already sent ($filename at $linenum)");
			}

			if( $name == "" )
			{
				$name = md5(uniqid()) . ".odt";
			}

			header('Content-type: application/vnd.oasis.opendocument.text');
			header('Content-Disposition: attachment; filename="'.$name.'"');
			readfile($this->tmpfile);
		}
		/**
		 * Returns a variable of configuration
		 *
		 * @return string The requested variable of configuration
		 */
		public function getConfig($configKey)
		{
			if (array_key_exists($configKey, $this->config)) {
				return $this->config[$configKey];
			}
			return false;
		}
		/**
		 * Returns the temporary working file
		 *
		 * @return string le chemin vers le fichier temporaire de travail
		 */
		public function getTmpfile()
		{
			return $this->tmpfile;
		}

		/**
		 * Delete the temporary file when the object is destroyed
		 */
		public function __destruct()
		{
			if (file_exists($this->tmpfile)) {
				unlink($this->tmpfile);
			}

			if (file_exists($this->tmpdir)) {
				$this->_rrmdir($this->tmpdir);
				rmdir($this->tmpdir);
			}
		}

		/**
		 * Empty the temporary working directory recursively
		 * @param $dir the temporary working directory
		 * @return void
		 */
		private function _rrmdir($dir)
		{
			if ($handle = opendir($dir)) {
				while (false !== ($file = readdir($handle))) {
					if ($file != '.' && $file != '..') {
						if (is_dir($dir . '/' . $file)) {
							$this->_rrmdir($dir . '/' . $file);
							rmdir($dir . '/' . $file);
						} else {
							unlink($dir . '/' . $file);
						}
					}
				}
				closedir($handle);
			}
		}
}

?>
