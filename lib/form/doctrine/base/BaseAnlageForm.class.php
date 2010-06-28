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
      'name'       => new sfWidgetFormInputText(),
      'zeit'       => new sfWidgetFormInputText(),
      'ziel'       => new sfWidgetFormInputText(),
      'methode'    => new sfWidgetFormInputText(),
      'material'   => new sfWidgetFormTextarea(),
      'tip'        => new sfWidgetFormInputText(),
      'kurzinhalt' => new sfWidgetFormTextarea(),
      'inhalt'     => new sfWidgetFormTextarea(),
      'rolle_tm'   => new sfWidgetFormInputText(),
      'zim_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zim'), 'add_empty' => true)),
      'lnr'        => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'zeit'       => new sfValidatorInteger(array('required' => false)),
      'ziel'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'methode'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'material'   => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'tip'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'kurzinhalt' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'inhalt'     => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'rolle_tm'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'zim_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zim'), 'required' => false)),
      'lnr'        => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Anlage', 'column' => array('name'))),
        new sfValidatorDoctrineUnique(array('model' => 'Anlage', 'column' => array('lnr'))),
      ))
    );

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
