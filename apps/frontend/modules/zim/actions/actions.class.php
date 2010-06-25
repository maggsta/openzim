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

  public function executeShow(sfWebRequest $request)
  {
    $this->zim = Doctrine::getTable('Zim')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->zim);
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
    $this->forward404Unless($zim = Doctrine::getTable('Zim')->find(array($request->getParameter('id'))), sprintf('Object zim does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZimForm($zim);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($zim = Doctrine::getTable('Zim')->find(array($request->getParameter('id'))), sprintf('Object zim does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZimForm($zim);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($zim = Doctrine::getTable('Zim')->find(array($request->getParameter('id'))), sprintf('Object zim does not exist (%s).', $request->getParameter('id')));
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
