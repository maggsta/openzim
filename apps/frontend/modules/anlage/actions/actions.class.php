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
  public function executeIndex(sfWebRequest $request)
  {
    $this->anlagen = Doctrine::getTable('Anlage')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->anlage = Doctrine::getTable('Anlage')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->anlage);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AnlageForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AnlageForm();

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

  // apps/frontend/modules/job/actions/actions.class.php
  public function executeSearch(sfWebRequest $request)
  {
    $this->forwardUnless($query = $request->getParameter('query'), 'anlage','index');
    if ('*' == $query )
    {
        $this->anlagen = Doctrine::getTable('Anlage')
          ->createQuery('a')
          ->execute();
      } 
      else 
        $this->anlagen = Doctrine_Core::getTable('Anlage')->getForLuceneQuery($query);
    $this->setTemplate('index');
    if ($request->isXmlHttpRequest())
    {
      if ( !$this->anlagen)
      {
        return $this->renderText('No results.');
      }

      return $this->renderPartial('anlage/list', array('anlagen' => $this->anlagen));
    }
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
