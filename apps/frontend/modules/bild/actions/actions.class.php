<?php

/**
 * bild actions.
 *
 * @package    openZIM
 * @subpackage bild
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bildActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->bilds = Doctrine::getTable('Bild')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->bild = Doctrine::getTable('Bild')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->bild);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new BildForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new BildForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($bild = Doctrine::getTable('Bild')->find(array($request->getParameter('id'))), sprintf('Object bild does not exist (%s).', $request->getParameter('id')));
    $this->form = new BildForm($bild);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($bild = Doctrine::getTable('Bild')->find(array($request->getParameter('id'))), sprintf('Object bild does not exist (%s).', $request->getParameter('id')));
    $this->form = new BildForm($bild);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($bild = Doctrine::getTable('Bild')->find(array($request->getParameter('id'))), sprintf('Object bild does not exist (%s).', $request->getParameter('id')));
    $bild->delete();

    $this->redirect('bild/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $bild = $form->save();

      $this->redirect('bild/edit?id='.$bild->getId());
    }
  }
}
