<?php

/**
 * Stunde form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StundeForm extends BaseStundeForm
{
  public function configure()
  {
    unset(
      $this['zim_id']
    );
    $this->validatorSchema['lnr'] = new sfValidatorPass();
    $this->validatorSchema['name'] = new sfValidatorString(array(
	'max_length' => 255, 'required' => !$this->isNew() ));

    $this->embedRelation('Anlagen','AnlageAdminEditForm');
    $this->widgetSchema['neueAnlage'] = new sfWidgetFormDoctrineChoice(array(
	'add_empty' => true,
	'model' => 'Anlage',
	'query' => AnlageTable::getAllFreeQuery(),
	'label' => 'Anlage hinzufügen'));

    $this->validatorSchema['neueAnlage'] = new sfValidatorDoctrineChoice(array(
	'model' => 'Anlage', 
	'query' => AnlageTable::getAllFreeQuery(),
	'required' => false));
  }
  
  public function updateObject($values = null)
  {
    if ( $values['neueAnlage'] ){
    	$anlage = Doctrine::getTable('Anlage')->find(array($values['neueAnlage']));
	$anlage->setStunde($this->getObject());
        $anlage->save();
    }
    return parent::updateObject($values); 
  }
}
