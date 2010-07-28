<?php

class toolsActions extends sfActions
{

public function executeIndex(sfWebRequest $request)
{
}

public function executeDownload(sfWebRequest $request)
{
	$this->setLayout(false);

	if($this->getRequestParameter('formsend')) {

		$type = 'application/octet-stream';

		switch($this->getRequestParameter('backuptype')) {
			case "datenbank":
				$file = "openZIM.db";
				$dir = '../data/';
				break;
			case "anlagen":
				include_once("../lib/zip/pclzip.lib.php");
				$zip_file="openZim_Archive.zip";
				$verzeichnisse=array("uploads/");
				$archive = new PclZip($zip_file);
				$archive->create($verzeichnisse);
				$file = $zip_file;
				$dir = './';
				break;
			case "all":
				include_once("../lib/zip/pclzip.lib.php");
				$zip_file="openZim_FullArchive.zip";
				$verzeichnisse=array("uploads/", "../data");
				$archive = new PclZip($zip_file);
				$archive->create($verzeichnisse);
				$file = $zip_file;
				$dir = './';
				break;
		}

		if(file_exists ($dir.$file)) {
			$filename = substr($file, 0, strrpos($file, '.'));
			$ext = substr($file, strrpos($file, '.')+1);
			$filename = $filename."_".date('h-i_j-m-y').".".$ext;

			$this->forward404Unless(file_exists($dir.$file));

			$this->getResponse()->clearHttpHeaders();
			$this->getResponse()->setHttpHeader('Pragma: public', true);
			$this->getResponse()->setContentType('\''.$type.'\'');
			$this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="'.$filename.'"');
			$this->getResponse()->sendHttpHeaders();
			$this->getResponse()->setContent(readfile($dir.$file));
			return sfView::NONE; 
		}
	
	}
}

}
?>
