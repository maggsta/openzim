<?php

/**
 * zim actions.
 *
 * @package    openZIM
 * @subpackage zim
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class zimActions extends ozActions
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
    $zim = $this->getRoute()->getObject();
    $stunde = Doctrine::getTable('Stunde')->getLastZimStunde($zim->getId());
    $this->forward404Unless($stunde, sprintf('Zim (%s) has no stunden.', $request->getParameter('id')));
    $lnr = $stunde->getFirst()->getLnr();
    $stunde->delete();

    if ( $request->isXmlHttpRequest() ){
    	$json_data['method'] = 'remove';
    	$json_data['actions'] = array('stunde_'. $lnr );
    	if ( $zim->getStunden()->count() == 0 )
    		$json_data['actions'][] = 'delete_stunde_link';
    	return $this->renderText(json_encode(array($json_data)));
    }
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
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $zim = $this->getRoute()->getObject();
    $this->form = new ZimForm($zim);

    $oldStundenCnt = $zim->getStunden()->count();

    // remember anlage ordering
    $anlage_order = array();
   	foreach ($zim->getStunden() as $stunde ){
    	foreach ($stunde->getAnlagen() as $anlage)
    		$anlage_order[] = $anlage->getId();
    }

  	if (($zim = $this->processForm($request, $this->form)) ){
		if ( $request->isXmlHttpRequest() ){
			$isValid = $this->resetValid();
			ZimTable::getInstance()->getConnection()->clear();
			$zim = ZimTable::getInstance()->find($zim->getId());
			$this->form = new ZimForm($zim);

			// check if order of anlagen changed
			$order_changed = false;
			$i = 0;
			foreach ($zim->getStunden() as $stunde ){
				foreach ($stunde->getAnlagen() as $anlage){
					if ( !isset($anlage_order[$i]) ||
						  $anlage_order[$i] != $anlage->getId() ){
						$order_changed = true;
						break;
					}
					$i++;
				}
			}

			if ( !$order_changed &&
				  $oldStundenCnt == $zim->getStunden()->count() &&
				  $isValid) {
				$json_data['method'] = 'set';
				$json_data['actions'] = array('zim_name' => $zim->__toString());
 				foreach ($zim->getStunden() as $stunde ){
 					$json_data['actions']['stunde_'.$stunde->getLnr().'_name'] = $stunde->getName();
 				}
				return $this->renderText(json_encode(array($json_data)));
			}

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
}
