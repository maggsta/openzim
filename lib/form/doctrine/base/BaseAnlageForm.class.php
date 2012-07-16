<?php

/**
 * Anlage form base class.
 *
 * @method Anlage getObject() Returns the current form's model object
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAnlageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'longname'   => new sfWidgetFormInputText(),
      'kuerzel'    => new sfWidgetFormInputText(),
      'zeit'       => new sfWidgetFormInputText(),
      'ziel'       => new sfWidgetFormTextarea(),
      'methode'    => new sfWidgetFormTextarea(),
      'material'   => new sfWidgetFormTextarea(),
      'kurzinhalt' => new sfWidgetFormTextarea(),
      'kofferinfo' => new sfWidgetFormTextarea(),
      'rolle_tm'   => new sfWidgetFormTextarea(),
      'stunde_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Stunde'), 'add_empty' => true)),
      'lnr'        => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'longname'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'kuerzel'    => new sfValidatorString(array('max_length' => 255)),
      'zeit'       => new sfValidatorInteger(array('required' => false)),
      'ziel'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'methode'    => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'material'   => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'kurzinhalt' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'kofferinfo' => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'rolle_tm'   => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'stunde_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Stunde'), 'required' => false)),
      'lnr'        => new sfValidatorInteger(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('anlage[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Anlage';
  }

}
