<?php

/**
 * zimAnlage actions.
 *
 * @package    openZIM
 * @subpackage zimAnlage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class zimAnlageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->zim_anlages = Doctrine::getTable('ZimAnlage')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->zim_anlage = Doctrine::getTable('ZimAnlage')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->zim_anlage);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ZimAnlageForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ZimAnlageForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($zim_anlage = Doctrine::getTable('ZimAnlage')->find(array($request->getParameter('id'))), sprintf('Object zim_anlage does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZimAnlageForm($zim_anlage);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($zim_anlage = Doctrine::getTable('ZimAnlage')->find(array($request->getParameter('id'))), sprintf('Object zim_anlage does not exist (%s).', $request->getParameter('id')));
    $this->form = new ZimAnlageForm($zim_anlage);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($zim_anlage = Doctrine::getTable('ZimAnlage')->find(array($request->getParameter('id'))), sprintf('Object zim_anlage does not exist (%s).', $request->getParameter('id')));
    $zim_anlage->delete();

    $this->redirect('zimAnlage/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $zim_anlage = $form->save();

      $this->redirect('zimAnlage/edit?id='.$zim_anlage->getId());
    }
  }
}
