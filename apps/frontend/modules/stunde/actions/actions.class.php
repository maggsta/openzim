<?php

/**
 * stunde actions.
 *
 * @package    openZIM
 * @subpackage stunde
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stundeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->stundes = Doctrine::getTable('Stunde')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->stunde = Doctrine::getTable('Stunde')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->stunde);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new StundeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new StundeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($stunde = Doctrine::getTable('Stunde')->find(array($request->getParameter('id'))), sprintf('Object stunde does not exist (%s).', $request->getParameter('id')));
    $this->form = new StundeForm($stunde);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($stunde = Doctrine::getTable('Stunde')->find(array($request->getParameter('id'))), sprintf('Object stunde does not exist (%s).', $request->getParameter('id')));
    $this->form = new StundeForm($stunde);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($stunde = Doctrine::getTable('Stunde')->find(array($request->getParameter('id'))), sprintf('Object stunde does not exist (%s).', $request->getParameter('id')));
    $stunde->delete();

    $this->redirect('stunde/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $stunde = $form->save();

      $this->redirect('stunde/edit?id='.$stunde->getId());
    }
  }
}
