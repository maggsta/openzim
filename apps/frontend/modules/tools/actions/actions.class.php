<?php


class toolsActions extends sfActions
{

public function executeIndex(sfWebRequest $request)
{
}


private function createArchive($dirs,$name){
	function preAddCallback($p_event, &$p_header)
	{
		$info = pathinfo($p_header['filename']);
		// hidden files ( like .gitignore ) have no filename
		if ( !$info['filename'] )
			return 0;	
		return 1;
	} 
	$archive = new PclZip($name);
	$archive->create($dirs,PCLZIP_CB_PRE_ADD, 'preAddCallback');
}

public function executeDownload(sfWebRequest $request)
{
	$this->setLayout(false);

	$this->forwardUnless($this->getRequestParameter('formsend'),'tools','index');

	$type = 'application/octet-stream';

	switch($this->getRequestParameter('backuptype')) {
		case "datenbank":
			$file = "openZIM.db";
			$dir = '../data/';
			break;
		case "anlagen":
			$type = 'application/zip';
			$file="openZim_Archive.zip";
			$verzeichnisse=array("uploads/");
			self::createArchive($verzeichnisse,$file);	
			$dir = './';
			break;
		case "all":
			$type = 'application/zip';
			$file="openZim_FullArchive.zip";
			$verzeichnisse=array("uploads/", "../data");
			self::createArchive($verzeichnisse,$file);	
			$dir = './';
			break;
	}

	$this->forwardUnless(file_exists ($dir.$file),'tools','index');

	$filename = substr($file, 0, strrpos($file, '.'));
	$ext = substr($file, strrpos($file, '.')+1);
	$filename = $filename."_".date('h-i_j-m-y').".".$ext;
	$this->getResponse()->clearHttpHeaders();
	$this->getResponse()->setHttpHeader('Pragma: public', true);
	$this->getResponse()->setContentType($type);
	$this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="'.$filename.'"');
	$this->getResponse()->sendHttpHeaders();
	$this->getResponse()->setContent(readfile($dir.$file));
	return sfView::NONE; 
}

}
?>
