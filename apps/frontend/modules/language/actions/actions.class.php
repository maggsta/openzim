<?php

/**
 * language actions.
 *
 * @package    openZIM
 * @subpackage language
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class languageActions extends sfActions
{

  public function executeChangeLanguage(sfWebRequest $request)
  {
    $form = new sfFormLanguage(
      $this->getUser(),
      array('languages' => array('en', 'de', 'fr'))
    );
    
    $from = $request->getReferer(); 

    $form->process($request);
 
    return $this->redirect($from);
  }

}
