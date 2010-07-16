<?php

/**
 * Anlage form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnlageCreateForm extends AnlageForm
{
  public function configure()
  {
    parent::configure();
    if (!$zims = $this->getOption('zims'))
    {
       $zims = ZimTable::getInstance()->findAll();
    }
    $choices = array();
    foreach( $zims as $zim ){
	$choices[$zim->getName()] = array();
    	foreach( $zim->getStunden() as $stunde )
		$choices[$zim->getName()][$stunde->getId()] = $stunde->getName();
    }
	
    $this->useFields(array('stunde_id','kuerzel', 'lnr'));
    $this->widgetSchema['stunde_id']  = new sfWidgetFormChoice(array(
	'choices' => $choices));
    
    $this->validatorSchema['stunde_id'] = new sfValidatorDoctrineChoice(array(
	'model' => $this->getRelatedModelName('Stunde')));
  }
}
