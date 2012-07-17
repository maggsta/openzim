<?php

/**
 * Section form base class.
 *
 * @method Section getObject() Returns the current form's model object
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSectionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'lnr'        => new sfWidgetFormInputText(),
      'anlage_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Anlage'), 'add_empty' => true)),
      'inhalt'     => new sfWidgetFormTextarea(),
      'tip'        => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'lnr'        => new sfValidatorInteger(),
      'anlage_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Anlage'), 'required' => false)),
      'inhalt'     => new sfValidatorString(array('max_length' => 100000, 'required' => false)),
      'tip'        => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Section', 'column' => array('anlage_id', 'lnr')))
    );

    $this->widgetSchema->setNameFormat('section[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Section';
  }

}
