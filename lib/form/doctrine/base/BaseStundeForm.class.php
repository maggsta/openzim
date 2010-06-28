<?php

/**
 * Stunde form base class.
 *
 * @method Stunde getObject() Returns the current form's model object
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStundeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'description'     => new sfWidgetFormInputText(),
      'zim_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zim'), 'add_empty' => false)),
      'start_anlage_id' => new sfWidgetFormInputText(),
      'end_anlage_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Anlage'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'description'     => new sfValidatorString(array('max_length' => 255)),
      'zim_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zim'))),
      'start_anlage_id' => new sfValidatorInteger(array('required' => false)),
      'end_anlage_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Anlage'), 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('stunde[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stunde';
  }

}
