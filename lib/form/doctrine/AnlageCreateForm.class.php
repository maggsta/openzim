<?php

/**
 * Anlage form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnlageCreateForm extends BaseAnlageForm
{
  public function configure()
  {
    $query = null;
    if ($zim = $this->getOption('zim'))
    {
	$query = StundeTable::getZimStundenQuery($zim);
    }
    $this->useFields(array('stunde_id','kuerzel', 'lnr'));
    $this->widgetSchema['stunde_id']  = new sfWidgetFormDoctrineChoice(array(
	'model' => $this->getRelatedModelName('Stunde'), 
	'query' => $query ));
    
    $this->validatorSchema['stunde_id'] = new sfValidatorDoctrineChoice(array(
	'model' => $this->getRelatedModelName('Stunde'), 
	'query' => $query ));
  }
}
