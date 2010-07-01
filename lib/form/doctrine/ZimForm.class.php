<?php

/**
 * Zim form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ZimForm extends BaseZimForm
{
  public function configure()
  {
	$this->embedRelation('Anlagen');
	$values = array();
	foreach($this->getObject()->getAnlagen() as $anlage) {
		$values[$anlage->getId()] = $anlage->__toString();
	}
	$this->widgetSchema['Anlagen'] = new sfWidgetFormChoice(array(
		'choices' => $values,
        	'renderer_class' => 'sfWidgetFormSelectDoubleList'));
  }
}
