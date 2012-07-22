<?php

/**
 * zim actions.
 *
 * @package    openZIM
 * @subpackage zim
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class zimActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $q = $this->zims = Doctrine::getTable('Zim')
      ->createQuery('a');
    $this->initPager($request,$q);
  }

  private function initPager(sfWebRequest $request, $query){
    $this->pager = new sfDoctrinePager(
    	'Zim',
        sfConfig::get('app_max_zims')
    );
    $this->pager->setQuery($query);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();	
  }

  public function executeDeleteStunde(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $zim = $this->getRoute()->getObject();
    $stunde = Doctrine::getTable('Stunde')->getLastZimStunde($zim->getId());
    $this->forward404Unless($stunde, sprintf('Zim (%s) has no stunden.', $request->getParameter('id')));
    $stunde->delete();

    $this->redirect($this->generateUrl('zim_edit',$zim));
  }

  public function executeExport(sfWebRequest $request)
  {
    $zim = $this->getRoute()->getObject();
    $odf = $zim->generateOdf();
    $odf->exportAsAttachedFile ($zim->getFilename());
    throw new sfStopException();        
  }

  public function executeExportPreview(sfWebRequest $request)
  {
  	$zim = $this->getRoute()->getObject();
  	$odf = $zim->generateOdf();
  	$odf->exportAsHtml("zim_preview.css");
  	throw new sfStopException();
  }
 
  public function executeShow(sfWebRequest $request)
  {
    $this->zim = $this->getRoute()->getObject();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ZimForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ZimForm();

    if ( ($zim = $this->processForm($request, $this->form) ) )
   		$this->redirect($this->generateUrl('zim_edit',$zim));

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $zim = $this->getRoute()->getObject();
    $this->form = new ZimForm($zim);
    $this->getResponse()->addJavaScript('zimremoveanlage');
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $zim = $this->getRoute()->getObject();
    $this->form = new ZimForm($zim);

    $oldCnt = AnlageTable::getAllFreeCount();
  	if (($zim = $this->processForm($request, $this->form)) ){
		if ( $request->isXmlHttpRequest() ){
			ZimTable::getInstance()->getConnection()->clear();
			$this->form = new ZimForm(ZimTable::getInstance()->find($zim->getId()));
			if ( $oldCnt == AnlageTable::getAllFreeCount() )
				return $this->renderText("OK");
		}else
			$this->redirect($this->generateUrl('anlage_edit', $anlage));
	}

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $zim = $this->getRoute()->getObject();
    $zim->delete();

    $this->redirect('zim/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
      return $form->save();
  }
}
