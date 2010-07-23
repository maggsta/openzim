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

  public function validateUser($anlage){
    	return  $this->getUser()->hasCredential('admin') ||
		$anlage->ownedByUser($this->getUser());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->anlage = $this->getRoute()->getObject();
    $this->forward404Unless($this->validateUser($this->anlage));
  }

  private function getAnlageCreateForm()
  {
    if($this->getUser()->hasCredential('admin')) {
    	return new AnlageCreateForm();
    }
    $this->forward404Unless($this->getUser()->hasZim());
    return new AnlageCreateForm(null,array(
		'zims' => $this->getUser()->getZims()));
  }

  public function executeNew(sfWebRequest $request)
  {
      $this->form = $this->getAnlageCreateForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = $this->getAnlageCreateForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $anlage = $this->getRoute()->getObject();
    $this->forward404Unless($this->validateUser($anlage));  
    $this->form = new AnlageEditForm($anlage);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $anlage = $this->getRoute()->getObject();
    $this->forward404Unless($this->validateUser($anlage));  
    $this->form = new AnlageEditForm($anlage);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $anlage = $this->getRoute()->getObject();
    $this->forward404Unless($this->validateUser($anlage));  
    $anlage->delete();

    $this->redirect('anlage/index');
  }

  public function executeExport(sfWebRequest $request)
  {
    $anlage = $this->getRoute()->getObject();
    $this->forward404Unless($this->validateUser($anlage));  

    $anlage->generateOdf();
    throw new sfStopException();        
  }

  public function executeRemoveStunde(sfWebRequest $request)
  {
    $anlage = $this->getRoute()->getObject();
    $this->forward404Unless($this->validateUser($anlage));  
    $zim = $anlage->getStunde()->getZim();
    $anlage->setStunde(null);
    $anlage->save();

    $this->redirect($this->generateUrl('zim_edit', $zim));
  }

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
    // save query string in user session for paginator
    $query =  $request->getParameter('query');
    $user = $this->getUser();
    if ( $query )
	$user['query'] = $query;
    else if ( ! $query = $user['query'] )
	$query = '*';
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
