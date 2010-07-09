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
    $this->zims = Doctrine::getTable('Zim')
      ->createQuery('a')
      ->execute();
  }

  public function executeDeleteStunde(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($zim = Doctrine::getTable('Zim')->find(array($request->getParameter('id'))), sprintf('Object zim does not exist (%s).', $request->getParameter('id')));
    $stunde = Doctrine::getTable('Stunde')->getLastZimStunde($zim->getId());
    $this->forward404Unless($stunde, sprintf('Zim (%s) has no stunden.', $request->getParameter('id')));
    $stunde->delete();

    $this->redirect('zim/edit?id='.$zim->getId());
  }

  public function executeExport(sfWebRequest $request)
  {
    $this->forward404Unless($zim =
	Doctrine::getTable('Zim')->find(array($request->getParameter('id'))),
	sprintf('Object zim does not exist (%s).', $request->getParameter('id')));

    $zim->generateOdf();
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

    $this->processForm($request, $this->form);

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

    $this->processForm($request, $this->form);

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
    {
      $zim = $form->save();

      $this->redirect('zim/edit?id='.$zim->getId());
    }
  }
}
