<?php

/**
 * anhang actions.
 *
 * @package    openZIM
 * @subpackage anhang
 * @author     Christoph Herbst
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class anhangActions extends sfActions
{
 /**
  * Executes download action
  *
  * @param sfRequest $request A request object
  */
  public function executeDownload(sfWebRequest $request)
  {
	// being sure no other content wil be output
	  $this->setLayout(false);
	  sfConfig::set('sf_web_debug', false);
    	  $anhang = $this->getRoute()->getObject();
	  $filepath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'anhaenge'
        	               	.DIRECTORY_SEPARATOR
               	        	.$anhang->getPath();

	  // check if the file exists
	  $this->forward404Unless(file_exists($filepath));

	  // Adding the file to the Response object
	  $this->getResponse()->clearHttpHeaders();
	  $this->getResponse()->setHttpHeader('Pragma: public', true);
//	  $this->getResponse()->setContentType('application/doc');
	  $this->getResponse()->setHttpHeader('Content-Disposition',
                            'attachment; filename="'.
                            $anhang->getName().'"');
	  $this->getResponse()->sendHttpHeaders();
	  $this->getResponse()->setContent(readfile($filepath));

	  return sfView::NONE;
  }
}
