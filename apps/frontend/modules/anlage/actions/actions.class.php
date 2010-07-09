<?php

/**
 * anlage actions.
 *
 * @package    openZIM
 * @subpackage anlage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class anlageActions extends sfActions
{
  private function getAnlagenQuery($query = '*'){
    $anlage = Doctrine::getTable('Anlage');
    if($this->getUser()->hasCredential('admin')) {
	$q = $anlage->getAllQuery($query);
    }
    else {
	$q = $anlage->getAllQuery($query,$this->getUser());
    }
    return $q;
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->initPager($request, $this->getAnlagenQuery());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->anlage = Doctrine::getTable('Anlage')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->anlage);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AnlageCreateForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AnlageCreateForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($anlage = Doctrine::getTable('Anlage')->find(array($request->getParameter('id'))), sprintf('Object anlage does not exist (%s).', $request->getParameter('id')));
    $this->form = new AnlageForm($anlage);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($anlage = Doctrine::getTable('Anlage')->find(array($request->getParameter('id'))), sprintf('Object anlage does not exist (%s).', $request->getParameter('id')));
    $this->form = new AnlageForm($anlage);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($anlage = Doctrine::getTable('Anlage')->find(array($request->getParameter('id'))), sprintf('Object anlage does not exist (%s).', $request->getParameter('id')));
    $anlage->delete();

    $this->redirect('anlage/index');
  }

  public function executeExport(sfWebRequest $request)
  {
    $this->forward404Unless($anlage = Doctrine::getTable('Anlage')->find(array($request->getParameter('id'))), sprintf('Object anlage does not exist (%s).', $request->getParameter('id')));

    $this->anlage = Doctrine::getTable('Anlage')->find(array($request->getParameter('id')));
    $this->anlage->generateOdf();
    throw new sfStopException();        
    
   // $this->getUser()->setFlash('notice', 'Die anlage wurde exportiert.');
   // $this->setTemplate('show');
   // $this->redirect('anlage/show/id/'.$request->getParameter('id'));
  }

  // apps/frontend/modules/job/actions/actions.class.php
 
  private function initPager(sfWebRequest $request, $query){
    $this->pager = new sfDoctrinePager(
    	'Anlage',
        sfConfig::get('app_max_anlagen')
    );
    $this->pager->setQuery($query);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();	
  }

  public function executeSearch(sfWebRequest $request)
  {
    $this->forwardUnless($query = $request->getParameter('query'), 'anlage','index');
    if ( strlen($query) <= 2 )
	$query = '*';
    elseif ( $query[strlen($query)-1] != '*' )
	$query = $query.'*';
    $q = $this->getAnlagenQuery($query);
    
    $this->setTemplate('index');
    $this->initPager($request, $q);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $anlage = $form->save();

      $this->redirect('anlage/edit?id='.$anlage->getId());
    }
  }
}
